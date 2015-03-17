<?php include 'funcs.php';
		
		if (!isset($_GET["id"]))
			header("Location: /index.php");
		
		$con=mysqli_connect("localhost","root","plokij","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$result = mysqli_query($con, "SELECT * FROM users
								WHERE hid_token='".$_GET["id"]."'");
		$row = mysqli_fetch_array($result);
		
		if ($row == FALSE){
			mysqli_close($con);
			header("Location: /index.php");
		}
		else {
			$sql = "UPDATE users SET active=".$_GET["active"]." WHERE hid_token='".$_GET["id"]."'";
			mysqli_query($con,$sql);
			mysqli_close($con);
		}

 ?>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Happy New Year - Create Your Own</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-rtl.min.css" rel="stylesheet">
		<link href="css/bubble.css" rel="stylesheet">
		<link rel="shortcut icon" href="/favicon.ico">
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
				<div align=center>
					<div class="col-sm-6 col-sm-offset-3">
						<div class="alert alert-success" role="alert" align=center>
							<h3><span class="glyphicon glyphicon-ok-circle"></span><br><?php if ($_GET["active"]) echo "המאחלומט אושר, ניתן להגיע אליו דרך הקישור שקיבלת במייל. תודה!"; else echo "המאחלומט בוטל וכעת לא ניתן לצפות בו." ?></h3><br>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class=row align=center>
				<font size=2>
					ראש השנה תשע"ה, ספטמבר 2014. נכתב ע"י <a href="mailto:eilongal@gmail.com">אילון גל </a>
				</font>
			</div>
	</body>
</html>