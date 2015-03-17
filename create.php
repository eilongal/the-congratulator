<?php include 'funcs.php';

        $form_token = uniqid();

        $_SESSION['form_token'] = $form_token;

 ?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ראש השנה - שנה טובה! יצירת מאחלומט חדש</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-rtl.min.css" rel="stylesheet">
		<link href="css/bubble.css" rel="stylesheet">
		<link rel="shortcut icon" href="favicon.ico">
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/txt.js"></script>
	</head>
	<body>
	<style>
		@import url(http://fonts.googleapis.com/earlyaccess/alefhebrew.css);
		small-mar {}
		@media(max-width:500px) {
			.small-mar {
				margin-top: 10px;
				font-size: 15px;
			}
		}
	</style>
<!-- Screen 1 Modal -->
<div class="modal fade" id="screen1" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<center>
				<h2 style="font-family: 'Alef Hebrew';">מסך פתיחה</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen1.png" class="img-responsive"><br><br>
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
				<h2 style="font-family: 'Alef Hebrew';">ברכה</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen2.png" class="img-responsive"><br><br>
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
				<h2 style="font-family: 'Alef Hebrew';">תמונה אישית</h2>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<img src="/screen3.png" class="img-responsive"><br><br>
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
					<a href="http://eilon.me/"><img src="anim_apple.gif" class="img-responsive"></a>				
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-lg-8 col-lg-offset-2">
					<div class="well" style="background-color: #e8e8e8;">
						<center><b><h3 style="font-family: 'Alef Hebrew';">יצירת מְאַחֵלוֹמַט חדש</h3></b></center>
						<div class="row" style="padding: 20px">
							<form name="create" id="create" class="form-horizontal" role="form" action="submit.php" method="post" enctype="multipart/form-data">
							
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">שם פרטי:</label></center>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="cname" id="cname" placeholder="שם פרטי" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק">
									</div>
									<div class="col-sm-4">
									
									</div>
								</div>
								<hr>
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">אימייל:</label></center>
									<div class="col-sm-6">
										<input type="text" class="form-control" name="cemail" id="cemail" placeholder="אימייל" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק. ודא כי האימייל שהזנת חוקי.">
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
										כתובת זו תשמש להפעלת המאחלומט לאחר יצירתו.<br>
										במידה והמשתמש יבחר להשאיר לך הודעה דרך המאחלומט, ההודעה תשלח לכתובת זו.
									</div>
								</div>								
								<hr>
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">טקסט פתיחה:<br><br><span id="c1"></span> תווים נותרו</label></center>
									<div class="col-sm-6">
										<textarea class="form-control" rows="5" name="m1" id="m1" maxlength="250" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק"></textarea></input>
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
										טקסט הפתיחה יופיע בין הצגת המאחלומט לבין הצגת מונה הברכות ובקשת השם של המשתמש.<br><br>
										<a href="" id="mod1">לחצו כאן</a> כדי לראות את מיקום הטקסט בעמוד.<br><br>
										ניתן לכתוב אותיות, מספרים וסימני פיסוק בלבד. כל תו אחר לא יופיע, אך יגרום להפרעה בהדפסת הטקסט.<br>
										<b>שימו לב!</b> כל חריגה מהמקום המוקצה (5 שורות) תאוחד לשורה החמישית וייתכן שלא תוצג.
									</div>
								</div>
								<hr>
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">ברכה:<br><br><span id="c2"></span> תווים נותרו</label></center>
									<div class="col-sm-6">
										<textarea class="form-control" rows="5" name="m2" id="m2" maxlength="250" data-toggle="tooltip" data-placement="top" title="אין להשאיר שדה זה ריק"></textarea>
									</div>
									<div class="col-sm-4 small-mar" style="font-size:15px">
									כאן יש לכתוב את הברכה שלכם. לאחריה תנתן למשתמש אפשרות להשאיר לכם הודעה.<br><br>
									<a href="" id="mod2">לחצו כאן</a> כדי לראות את מיקום הברכה בעמוד.<br><br>
									ניתן לכתוב אותיות, מספרים וסימני פיסוק בלבד. כל תו אחר לא יופיע, אך יגרום להפרעה בהדפסת הטקסט.<br>
									<b>שימו לב!</b> כל חריגה מהמקום המוקצה (5 שורות) תאוחד לשורה החמישית וייתכן שלא תוצג.
									</div>
								</div>
								<hr>
								<div class="form-group"><center>
									<label class="col-sm-2 control-label" style="text-align:center; font-size: 16px;">תמונה אישית:</label></center>
									<div class="col-sm-6">
										<input type="file" name="file"/>אם לא תועלה תמונה, תוצג תמונת ברירת מחדל.
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
									<div>
										<center><button type="submit" class="btn btn-lg btn-success">צור מאחלומט</button></center>
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
	function scrolltotop() {		
		var completeCalled = false;
		$("html, body").animate(
			{ scrollTop: "0px" },
			{
				complete : function(){
					if(!completeCalled){
						completeCalled = true;
					}	
				}
			}
		);
	};
		
		$( "form" ).submit(function( event ) {
		var x = document.forms["create"]["cname"].value;
			if ( x == null || x== "" ){
				scrolltotop();
				$('#cname').tooltip('show');
				event.preventDefault();			
			}
		var x = document.forms["create"]["cemail"].value;
			if ( x == null || x== "" ){
				scrolltotop();
				$('#cemail').tooltip('show');
				event.preventDefault();			
			}
			var atpos = x.indexOf("@");
			var dotpos = x.lastIndexOf(".");
			if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
				scrolltotop();
				$('#cemail').tooltip('show');
				event.preventDefault();
			}		
		var x = document.forms["create"]["m1"].value;
			if ( x == null || x== "" ){
				scrolltotop();
				$('#m1').tooltip('show')
				event.preventDefault();			
			}
		var x = document.forms["create"]["m2"].value;
			if ( x == null || x== "" ){
				scrolltotop();
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
		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53443194-1', 'auto');
  ga('send', 'pageview');

</script>
	</body>
</html>
		
	
