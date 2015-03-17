<?php include 'funcs.php';

	if (isset($_GET["id"])){
		$_SESSION['id'] = $_GET["id"];
		if ( get_id_data() ){
			$id = "id";
			if ($_SESSION['user_data']['image'] && ($_SESSION['stage'] == 3) )
				$has_image = "im";
			user_defines();
		}
	}
	else {
		unset ($_SESSION['id']);
		unset ($_SESSION['user_data']);
	}
	
	$rowcount = get_rows();
 ?>
<html>
<head>
   <meta charset="utf-8"/>
 	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<meta name="description" content="המאחלומט הוא מאחל שנה טובה אוטומטי, אינטראקטיבי ואישי. מחפשים ברכת שנה טובה חדשנית ומקורית לשלוח לכולם? הגעתם למקום הנכון - צרו לכם מאחלומט!">
	<meta property="og:title" content="המאחלומט רוצה לאחל לך שנה טובה!"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="http://eilon.me/<?php if (isset($_GET["id"])) echo '?id='.$_SESSION['user_data']['id'] ?>"/>
	<meta property="og:image" content="http://eilon.me/newyear2.png"/>
	<meta property="og:site_name" content="המאחלומט"/>
	<meta property="og:description" content=" <?php if (isset($_GET["id"])) echo $_SESSION['user_data']['name']." רוצה לאחל לך שנה טובה!"; ?> המאחלומט הוא מאחל שנה טובה אוטומטי, אינטראקטיבי ואישי - הברכה הכי מקורית שתראו השנה! רוצים מאחלומט משלכם? הכנסו!"/>
	<meta property="fb:admins" content="1051129099"/>
	<style>
	@import url(http://fonts.googleapis.com/earlyaccess/alefhebrew.css);
	</style>
    <title>המאחלומט - שנה טובה! Happy New Year!</title>
	<?php 
		if ($lang == "h"){
			echo "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">";
			echo "<link href=\"css/bootstrap-rtl.min.css\" rel=\"stylesheet\">";
		}
		else	
			echo "<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\">";
			?>
	<link href="css/bubble.css" rel="stylesheet">
	<link href="web/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="favicon.ico">
	<script type="text/javascript" src="jquery.js"></script>
</head>
<body scroll="no" style="overflow-x: hidden">
<?php

?>
<!-- Modal -->
<div class="modal fade" id="youtube" tabindex="-1" role="dialog" aria-labelledby="Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<center>
				<div class="btn-group">
					<button class="btn btn-primary" onclick="vid(video1)">
						 Dip Your Apple
					</button>
					<button class="btn btn-primary" onclick="vid(video2)">
						 Call Me Maybe
					</button>
					<button class="btn btn-primary" onclick="vid(video3)">
						 Get Clarity
					</button>
				</div>
			</center>
      </div>
      <div class="modal-body">
        <center>
			<div class="embed-responsive embed-responsive-16by9" id="modadiv">
				<iframe width="560" height="315" class="embed-responsive-item" src="//www.youtube.com/embed/FlcxEDy-lr0?rel=0" allowfullscreen></iframe>
			</div>
		</center>
      </div>
    </div>
  </div>
</div>
<!-- End of Modal -->

	<div class="container-fluid">
	  <div  class="row" align=center>
		<div>
			<img src="anim_apple.gif" class="img-responsive" name="logo" id="logo" data-toggle="popover" data-placement="right" data-html="true" data-content="<span class='text123'><center>רוצים מְאַחֵלוֹמַט משלכם? מותאם אישית עם שמכם והברכה שלכם? אני מציע את שירותיי!<br><a href='create.php'><b><button type='button' class='btn btn-success btn-sm' style='font-size: 15px;'>כן! תעשה לי מְאַחֵלוֹמַט!</button></b></a></center></span>">
		</div>
				<div align=center>
			<div align=left class="bubble" style="height: 430px; margin-top: 15px; -webkit-box-shadow: 0px 0px 19px 2px rgba(79,129,255,0.72); -moz-box-shadow: 0px 0px 19px 2px rgba(79,129,255,0.72); box-shadow: 0px 0px 19px 2px rgba(79,129,255,0.72); <?php if ($_SESSION['stage']==3)	echo "<!--"; ?> background-image: url('honey1.png'); background-repeat: no-repeat; background-position: center;<?php if ($_SESSION['stage']==3)	echo "-->"; ?>">
			<?php 
				if ($_SESSION['stage'] == 3){
					echo "<center>";
					echo show_ascii();
					echo "</center>";
				}
			?>
				<div id="twriter" <?php if ($lang == "h") echo "align=right "; if ($_SESSION['stage'] == 3 && (! $_SESSION['user_data']['image']) ) echo " style=\"margin-top:-30px\"" ?>>
			
				</div>
			</div>
		</div>
	</div>

	</div>
	<div class="container-fluid">
	<div class="row" align="center" style="margin-top:30px">
		<div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-3">
			<form action="<?php if ($lang != "h") echo "?lang=eng"; if ($id=="id") echo "?id=".$_SESSION['user_data']['id'] ?>" method="post" name="f_input">
				<div class="input-group input-group-lg">
					<span class="input-group-addon"><?php if ($lang == "h") echo "<span class=\"glyphicon glyphicon-chevron-left\">"; else echo "<span class=\"glyphicon glyphicon-chevron-right\">" ?></span></span>
					<input <?php if ( $_SESSION['stage'] == 4 ) echo "disabled"; ?> type="text" class="form-control" name="f_input" id="f_input" autocomplete="off" data-toggle="tooltip" data-placement="bottom" title="<?php if ($lang == "h") echo "סליחה, אני עוד מדבר! מאוד לא מנומס.. שלחו שוב כשאסיים."; else  echo "Hey, be polite! Please wait until I finish talking..."; ?>">
					<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
					<span class="input-group-btn">
						<button class="btn btn-primary" type="submit" id="f_button" name="f_button" data-toggle="tooltip" data-placement="bottom" title="<?php if ($lang == "h") echo "אי אפשר לשלוח הודעה ריקה."; else echo "Can't send an empty message." ?>" disabled="disabled"><?php if ($lang == "h") echo "שלח"; else echo "Send" ?></button>
					</span>
				</div>
			</form>
		</div>
	</div>
	</div>
<footer>
	<div class="container">
		<div class="row" align="center">

				<?php 
			if ($lang == "h") 
				echo "<button type=\"button\" class=\"btn btn-primary active\">עבר</button>
					  <a href=\"/?lang=eng\"><button type=\"button\" class=\"btn btn-primary\">Eng</button></a>";
			
			else 
				echo "<button type=\"button\" class=\"btn btn-primary active\">Eng</button>
					  <a href='/'><button type=\"button\" class=\"btn btn-primary\">עבר</button></a>";
				?>
			</div>
		<div class="row" align="center" style="margin-top:30px" dir="ltr">
			<font size=2>
		<?php if ($lang == "h") echo "ראש השנה תשע\"ה, ספטמבר 2014. נוצר ע\"י אילון גל<br>קיימים כרגע ".$rowcount." מאחלומטים במערכת";
				else echo "Rosh Hashana, September 2014. Created by Eilon Gal";
					?>
			</font><br>
			<center>
			<ul class="list-inline social-buttons">
				<a onClick="window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/<?php if (isset($_GET["id"])) echo '?id='.$_SESSION['user_data']['id'] ?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-square fa-stack-2x"></i>
					  <i class="fa fa-share-alt fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<a href="mailto:eilongal@gmail.com">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-square fa-stack-2x"></i>
					  <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<a href="https://www.facebook.com/eilongal/" target="_blank">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-square fa-stack-2x"></i>
					  <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
					</span>
				</a>
				<a href="http://web.eilongal.com/" target="_blank">
					<span class="fa-stack fa-lg">
					  <i class="fa fa-square fa-stack-2x"></i>
					  <i class="fa fa-desktop fa-stack-1x fa-inverse"></i>
					</span>
				</a>
			</ul>
			</center>
		</div>
	</div>
</footer>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/vid.js"></script>
	<script>
			function modal(){
			$('#logo').popover('hide');
			$('#youtube').modal('show');
			preventDefault();
		};
	</script>
	<script>
		var prnt_active = true;
		
		var str = <?php echo constant("MESSAGE".$_SESSION['stage'].$ismsg.$lang.$id.$has_image); ?>,
			i = 0,
			isTag,
			text;
		
	function scrolltotop() {		
		var completeCalled = false;
		$("html, body").animate(
			{ scrollTop: "0px" },
			{
				complete : function(){
					if(!completeCalled){
						completeCalled = true;
						setTimeout(popshow, 100);
					}	
				}
			}
		);
	};
	
	function popshow() {
		$('#logo').popover('show');
	};
			
		function type() {
			
			text = str.slice(0, ++i);
			if (text === str) {
			$('#f_input').tooltip('destroy');
			<?php
			if ($_SESSION['stage'] == 3 || $_SESSION['stage'] == 1){
				echo "scrolltotop();";
			}
			?>
			prnt_active = false;
			return;
			}
			if (prnt_active === false) return;

			document.getElementById('twriter').innerHTML = text;

			var char = text.slice(-1);
			if( char === '<' ) isTag = true;
			if( char === '>' ) isTag = false;

			if (isTag) return type();
			setTimeout(type, <?php echo $type_timer; ?>);
		};
		type();
	</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-53443194-1', 'auto');
  ga('send', 'pageview');

</script>

<script>
		$( document ).ready(function() {
			if ( <?php echo $_SESSION['stage'] ?> == 4 )
				$("button").prop("disabled", true);
		});
</script>

 </body>
</html>