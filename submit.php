<?php
	include 'funcs.php';
	include 'image_resize.php';

		$hid_token = uniqid();
		
		if (isset($_GET['edit'])){
			$con=mysqli_connect("localhost","root","plokij","congra");

			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		
			$result = mysqli_query($con, "SELECT * FROM users
								WHERE hid_token='".$_GET["id"]."'");
			$row = mysqli_fetch_array($result);
		
			mysqli_close($con);
		}
		if (isset($_GET['edit'])){
			if(!isset($_POST['cname'], $_POST['m1'], $_POST['m2'], $_POST['form_token'], $_SESSION['form_token']))
				{
						header("Location: /index.php?error=123");
				}
		}
        /*** check all expected variables are set ***/
        elseif(!isset($_POST['cname'], $_POST['cemail'], $_POST['m1'], $_POST['m2'], $_POST['form_token'], $_SESSION['form_token']))
        {
                header("Location: /index.php");
        }
        /*** check the form tokens match ***/
        if($_POST['form_token'] != $_SESSION['form_token'])
        {
                $message = 'Access denied';
        }
		
        else
        {
                /*** sanitize the input ***/
				$id = $_POST['form_token'];
				
                $first_name = filter_var($_POST['cname'], FILTER_SANITIZE_SPECIAL_CHARS);
				
				$email = filter_var($_POST['cemail'], FILTER_SANITIZE_EMAIL);
				
				$m1 = filter_var($_POST['m1'], FILTER_SANITIZE_SPECIAL_CHARS);
				$m1 = preg_replace("/&\#13;&\#10;/", "\<br\>", $m1, 4);
				
				$m2 = filter_var($_POST['m2'], FILTER_SANITIZE_SPECIAL_CHARS);
				$m2 = preg_replace("/&\#13;&\#10;/", "\<br\>", $m2, 4);
	
				// MYSQL Connection
				$con=mysqli_connect("localhost","root","plokij","congra");
				// Check connection
				if (mysqli_connect_errno()) {
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				};
				
				if ( $_FILES["file"]["name"]) {
				
					$allowedExts = array("gif", "jpeg", "jpg", "png");
					$temp = explode(".", $_FILES["file"]["name"]);
					$extension = end($temp);

					if ((($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/jpg")
					|| ($_FILES["file"]["type"] == "image/pjpeg")
					|| ($_FILES["file"]["type"] == "image/x-png")
					|| ($_FILES["file"]["type"] == "image/png"))
					&& ($_FILES["file"]["size"] < 5300000)
					&& in_array($extension, $allowedExts)) {
						if ($_FILES["file"]["error"] > 0) {
							$user_image=0;
							$user_image_error=1;
						} 
						else {
							if (isset($_GET['edit'])){
								if ($row['image']){
									unlink("user_images/".$row['id'].".".$row['image_ext']);
								};
								move_uploaded_file($_FILES["file"]["tmp_name"], "user_images/".$row['id']."1.".$extension);
								smart_resize_image("user_images/".$row['id']."1.".$extension, null, 520, 300, true, "user_images/".$row['id'].".".$extension, true, false ,100 );
								$user_image=1;
							}
							else {
							move_uploaded_file($_FILES["file"]["tmp_name"], "user_images/".$id."1.".$extension);
							smart_resize_image("user_images/".$id."1.".$extension, null, 520, 300, true, "user_images/".$id.".".$extension, true, false ,100 );
							$user_image=1;
							}
						}
					}
				}
				
				else {
					$extension=$row['image_ext'];
					if ($row['image'])
						$user_image=1;
					if ($_POST['delimage']){
						unlink("user_images/".$row['id'].".".$row['image_ext']);
						$user_image=0;
					}
				};
				
				if (isset($_GET['edit'])) {
					$sql="UPDATE users SET name='".$first_name."', m1='".$m1."', m2='".$m2."', image='".$user_image."', image_ext='".$extension."' WHERE hid_token='".$_GET['id']."'";
				}
				else {
				$sql="INSERT INTO users (id, name, email, m1, m2, counter, hid_token, image, image_ext, active)
						VALUES ('$id', '$first_name', '$email', '$m1', '$m2', '0', '$hid_token', '$user_image', '$extension', '0')";
				}
				
				if (!mysqli_query($con,$sql)) {
					die('Error: ' . mysqli_error($con));
				}
				
				$success = TRUE;

				mysqli_close($con);
		};
		
		$short_url = json_decode(file_get_contents("http://api.bit.ly/v3/shorten?login=eilongal&apiKey=R_b7c721745a24426c9283471ac5d1c4d7&longUrl=".urlencode("http://eilon.me/?id=".$id."")."&format=json"))->data->url;
		
		$to = $email;
		$from = "sender@eilon.me";
		$subject = "אישור הפעלת המאחלומט";
		$mailmsg = "שלום, \n המאחלומט שלך נוצר בהצלחה.\n\n ראשית, עליך לאשר את הפעלתו ע\"י כניסה לכתובת: \n http://eilon.me/activation.php?id=".$hid_token."&active=1 \n\n לאחר אישורו, הכתובת של המאחלומט שלך תהיה: \n http://eilon.me/?id=".$_SESSION['form_token']." \n לנוחיותך, יש גם כתובת מקוצרת: ".$short_url." \n\n אם ברצונך לערוך את המאחלומט שיצרת, יהיה ניתן לעשות זאת בכתובת: \n http://eilon.me/edit.php?id=".$hid_token." \n כתובת זו היא אישית, פרסום של כתובת זו יכול לאפשר לאנשים אחרים לערוך את המאחלומט שיצרת. \n\n בעתיד, יהיה ניתן לבטל את המאחלומט שיצרת ע\"י כניסה לכתובת: \n http://eilon.me/activation.php?id=".$hid_token."&active=0 \n\n תודה רבה וחג שמח! \n בברכה, המאחלומט.";
		$headers = "From: 'המאחלומט'<$from> \r\n"; 
		if ( ! isset($_GET['edit']) )
			$ok = mail($to, $subject, $mailmsg, $headers, "-f " . $from);


?>

<html>
	<head>
		<meta charset="utf-8" />
		<title>Happy New Year - Create Your Own</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-rtl.min.css" rel="stylesheet">
		<link href="css/bubble.css" rel="stylesheet">
		<link rel="shortcut icon" href="favicon.ico">
		<script type="text/javascript" src="jquery.js"></script>
	<style>
		@import url(http://fonts.googleapis.com/earlyaccess/alefhebrew.css);
		html, body {font-family: 'Alef Hebrew';}
	</style>
		
	</head>
	<body>
		<div class="container-fluid">
			<div  class="row" align=center>
				<div class="col-sm-6 col-sm-offset-3">
					<img src="anim_apple.gif">				
				</div>
			</div>
			<div class="row" align=center style="padding: 20px">
				<div class="col-sm-6 col-sm-offset-3">
						<div class="alert alert-success" role="alert">
							<h3><span class="glyphicon glyphicon-ok-circle"></span><br><?php if ( $success && (isset($_GET['edit'])) ) echo "המאחלומט נערך בהצלחה והשינויים עודכנו." ; else if ($success) echo "המאחלומט נוצר. אנא בדוק את תיבת האימייל שלך על מנת לאשר ולסיים את התהליך. אם האימייל לא הגיע, אנא בדוק גם בתיבת דואר הזבל. (ספאם)"; else echo "שגיאה. ".$message; ?><br><?php if ($user_image_error) echo "התמונה שהועלתה לא עמדה בתנאים ולכן נמחקה"; ?></h3>
						</div>
				</div>
			</div>
		</div>
			<div class=row align=center>
				<font size=2>
					ראש השנה תשע"ה, ספטמבר 2014. נכתב ע"י <a href="mailto:eilongal@gmail.com">אילון גל </a>
				</font>
			</div>
		<?php                 /*** unset the form token in the session ***/
                unset( $_SESSION['form_token']);
		?>
	</body>
</html>