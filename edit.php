<?php include 'funcs.php';

        $form_token = uniqid();

        $_SESSION['form_token'] = $form_token;
		
		if (!isset($_GET["id"]))
			header("Location: /create.php?error=noid");
		
		$con=mysqli_connect("localhost","root","plokij","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$result = mysqli_query($con, "SELECT * FROM users
								WHERE hid_token='".$_GET["id"]."'");
		$row = mysqli_fetch_array($result);
		
		mysqli_close($con);
		if ($row['image']){
			$image_size = getimagesize("user_images/".$row['id'].".".$row['image_ext']);
			$image_size_html = imageResize($image_size[0],$image_size[1], 80);
		}

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
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/txt.js"></script>
			<style>
		@import url(http://fonts.googleapis.com/earlyaccess/alefhebrew.css);
		small-mar {}
		@media(max-width:500px) {
			.small-mar {
				margin-top: 10px;
				font-size: 14px;
			}
		}
	</style>
		
	</head>
	<body>
<!-- Screen 1 Modal -->
<div class="modal fade" id="screen1" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<center>
				<h2>מסך פתיחה</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen1.png"><br><br>
			<button type="button" class="btn btn-primary" data-dismiss="modal">סגור</button>
		</center>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->
<!-- Screen 2 Modal -->
<div class="modal fade" id="screen2" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<center>
				<h2>ברכה</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen2.png"><br><br>
			<button type="button" class="btn btn-primary" data-dismiss="modal">סגור</button>
		</center>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->
<!-- Screen 3 Modal -->
<div class="modal fade" id="screen3" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<center>
				<h2>תמונה אישית</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen3.png"><br><br>
			<button type="button" class="btn btn-primary" data-dismiss="modal">סגור</button>
		</center>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->
		<div class="container-fluid">
			<div  class="row" align=center>
				<div class="col-md-6 col-md-offset-3">
					<img src="anim_apple.gif">				
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<div class="well" style="background-color: #e8e8e8;">
						<center><b><h3>עדכון מאחלומט קיים</h3></b></center>
						<div class="row" style="padding: 20px">
							<form name="create" id="create" class="form-horizontal" role="form" action="submit.php?edit=1&id=<?php echo $row['hid_token']; ?>" method="post" enctype="multipart/form-data">
							
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">שם פרטי:</label></center>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="cname" id="cname" placeholder="שם פרטי" value="<?php echo $row['name'] ?>" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק">
									</div>
									<div class="col-sm-4">
									
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">אימייל:</label>
									<div class="col-sm-6">
										<input disabled type="text" class="form-control" name="cemail" id="cemail" placeholder="אימייל" value="<?php echo $row['email'] ?>" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק. ודא כי האימייל שהזנת חוקי.">
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
									לא ניתן לעדכן את כתובת האימייל.
									</div>
								</div>								
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">טקסט פתיחה:<br><br><span id="c1"></span> תווים נותרו</label>
									<div class="col-sm-6">
										<textarea class="form-control" rows="5" name="m1" id="m1" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק"><?php echo $row['m1'] ?></textarea></input>
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
										טקסט הפתיחה יופיע בין הצגת המאחלומט לבין הצגת מונה הברכות ובקשת השם של המשתמש.<br><br>
										<a href="" id="mod1">לחצו כאן</a> כדי לראות את מיקום הטקסט בעמוד.<br><br>
										ניתן לכתוב אותיות, מספרים וסימני פיסוק בלבד. כל תו אחר לא יופיע, אך יגרום להפרעה בהדפסת הטקסט.<br>
										<b>שימו לב!</b> כל חריגה מהמקום המוקצה (5 שורות) תאוחד לשורה החמישית וייתכן שלא תוצג.
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">ברכה:<br><br><span id="c2"></span> תווים נותרו</label>
									<div class="col-sm-6">
										<textarea class="form-control" rows="5" name="m2" id="m2" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק"><?php echo $row['m2'] ?></textarea>
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
									כאן יש לכתוב את הברכה שלכם. לאחריה תנתן למשתמש אפשרות להשאיר לכם הודעה.<br><br>
									<a href="" id="mod2">לחצו כאן</a> כדי לראות את מיקום הברכה בעמוד.<br><br>
									ניתן לכתוב אותיות, מספרים וסימני פיסוק בלבד. כל תו אחר לא יופיע, אך יגרום להפרעה בהדפסת הטקסט.<br>
										<b>שימו לב!</b> כל חריגה מהמקום המוקצה (5 שורות) תאוחד לשורה החמישית וייתכן שלא תוצג.									
									</div>
								</div>
								<hr>
								<div class="form-group">
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">תמונה אישית:</label>
									<div class="col-sm-6">
										<input type="file" name="file"/><br>
										<?php if ($row['image']) echo "קיימת תמונה במערכת. העלאת תמונה נוספת תגרום למחיקת הנוכחית. תצוגה מקדימה:<br><img ".$image_size_html." src='/user_images/".$row['id'].".".$row['image_ext']."'><br><input type=\"checkbox\" name=\"delimage\" id=\"delimage\"> מחיקת התמונה וחזרה לברירת המחדל" ?>
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
									ניתן להעלות תמונה אישית שתופיע במסך האחרון.<br>
									<a href="" id="mod3">לחצו כאן</a> כדי לראות את מיקומה.<br>
									משקל התמונה המקסימלי - 5MB.<br>
									התמונה תעבור הקטנה אוטומטית על מנת להתאים למאחלומט.<br>
									קבצים נתמכים: jpg, jpeg, gif, png.
									</div>
								</div>
								<input type="hidden" name="form_token" id="form_token" value="<?php echo $form_token; ?>" />
								<div class="form-group">
									<div class="col-sm-offset-5">
										<button type="submit" class="btn btn-lg btn-success">עדכון המאחלומט</button>
									</div>
								</div>								
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class=row align=center>
				<font size=2>
					ראש השנה תשע"ה, ספטמבר 2014. נכתב ע"י <a href="mailto:eilongal@gmail.com">אילון גל </a>
				</font>
			</div>
		</div>
		<script>
		$( "form" ).submit(function( event ) {
		var x = document.forms["create"]["cname"].value;
			if ( x == null || x== "" ){
				$('#cname').tooltip('show');
				event.preventDefault();			
			}
		var x = document.forms["create"]["cemail"].value;
			if ( x == null || x== "" ){
				$('#cemail').tooltip('show');
				event.preventDefault();			
			}
			var atpos = x.indexOf("@");
			var dotpos = x.lastIndexOf(".");
			if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
				$('#cemail').tooltip('show');
				event.preventDefault();
			}		
		var x = document.forms["create"]["m1"].value;
			if ( x == null || x== "" ){
				$('#m1').tooltip('show')
				event.preventDefault();			
			}
		var x = document.forms["create"]["m2"].value;
			if ( x == null || x== "" ){
				$('#m2').tooltip('show')
				event.preventDefault();			
			}
		});
		
		$( "#mod1" ).click(function( event ) {
			$('#screen1').modal('show');
			event.preventDefault();
		});
		$( "#mod2" ).click(function( event ) {
			$('#screen2').modal('show');
			event.preventDefault();
		});
		$( "#mod3" ).click(function( event ) {
			$('#screen3').modal('show');
			event.preventDefault();
		});
		</script>
		<script>
			var elem = $("#c1");
			$("#m1").limiter(250, elem);
			
			var elem = $("#c2");
			$("#m2").limiter(250, elem);
		</script>
	</body>
</html>
		
	
