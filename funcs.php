<?php session_start();

	function inc_counter() {
		$con=mysqli_connect("localhost","root","Lkjoiu1@","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		if (isset($_SESSION['id'])) {
			$sql = "UPDATE users SET counter=counter+1 WHERE id='".$_SESSION['id']."'";
		}
		else 
			$sql = "UPDATE counter SET counter = counter+1";
		// Update counter
		mysqli_query($con,$sql);
		
		// Close connection
		mysqli_close($con);		
	}
	
	function get_rows() {
		$con=mysqli_connect("localhost","root","Lkjoiu1@","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$result = mysqli_query($con,"SELECT * FROM users WHERE active='1'");
		$rowcount = mysqli_num_rows($result);
		
		return $rowcount;
		
	}
	
	function get_counter() {
		$con=mysqli_connect("localhost","root","Lkjoiu1@","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		if (isset($_SESSION['id'])){
			$result = mysqli_query($con,"SELECT counter FROM users WHERE id='".$_SESSION['id']."'");
		}
		else{
			$result = mysqli_query($con,"SELECT counter FROM counter");
		}
			
		$counter = mysqli_fetch_array($result);
		
		// Close connection
		mysqli_close($con);	
		
		if (isset($_SESSION['id']))
			return $counter['counter'];
		else		
			return $counter[0];
	}
	
	function get_id_data(){
	
		$con=mysqli_connect("localhost","root","Lkjoiu1@","congra");

		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		$result = mysqli_query($con, "SELECT * FROM users
								WHERE id='".$_SESSION['id']."'");
		$_SESSION['user_data'] = mysqli_fetch_array($result);
		
		if ($_SESSION['user_data'] != FALSE){
			if ($_SESSION['user_data']['active'] == "0"){
			mysqli_close($con);
			unset ($_SESSION['id']);
			unset ($_SESSION['user_data']);
			return FALSE;
			}
			mysqli_close($con);
			return TRUE;
		}
		else {
			unset ($_SESSION['id']);
			unset ($_SESSION['user_data']);
			mysqli_close($con);
			return FALSE;
		}
	}
		
	
	$lang="h";
	if (isset($_GET["lang"]))
		if ($_GET["lang"] == "eng")
			unset($lang);
	
	if(isset($_POST["f_input"])){
		$_SESSION['input'][$_SESSION['stage']] = $_POST["f_input"];
		if ( $_SESSION['input'][$_SESSION['stage']] != $_SESSION['input'][($_SESSION['stage'])-1] ){
			$_SESSION['stage'] = $_SESSION['stage']+1;
			}
	}
	
	else
		$_SESSION['stage'] = 1;
	
	if ($_SESSION['stage'] == 5)
		$_SESSION['stage'] = 1;
	
	$ismsg = TRUE;
	$type_timer = 40;
	switch ($_SESSION['stage']){
		case 1:
		break;
		
		case 2:
		$u_input = filter_var($_POST["f_input"], FILTER_SANITIZE_SPECIAL_CHARS);
		$_SESSION['uname'] = $u_input;
		inc_counter();
		break;
		
		case 3:
		if ( $_POST["f_input"] == "No" || $_POST["f_input"] == "no" || $_POST["f_input"] == "No." || $_POST["f_input"] == "no." || $_POST["f_input"] == "NO" || $_POST["f_input"] == "NO." || $_POST["f_input"] == "לא" || $_POST["f_input"] == "לא." || $_POST["f_input"] == "לא.." || $_POST["f_input"] == "\'לא\'" || $_POST["f_input"] == "לט" ) {
			$ismsg = FALSE;
			break;
			}
		else {
			$ismsg = TRUE;
			$type_timer = 40;
			sendemail();
			break;
			}
		
		case 4:
		$ismsg = FALSE;
		break;
	}
	
	function sendemail() {
		if (isset($_SESSION['id']))
			$to = $_SESSION['user_data']['email'];
		else
			$to = "eilongal@gmail.com";
			
		$from = "sender@eilon.me";
		$subject = "קיבלת הודעת מאחלומט מ: ".$_SESSION['uname'];
		$mailmsg = $_POST["f_input"];
		$mailmsg = wordwrap($mailmsg, 70);
		$headers = "From: 'המאחלומט'<$from> \r\n"; 
		$ok = mail($to, $subject, $mailmsg, $headers, "-f " . $from);
	return $ok;
	
	}
	
	define("MESSAGE11", "\"<font class='text'><b>Hi There!</b><br>\
						I'm Eilon's personal interactive congratulator - הַמְאַחֵלוֹמַט.<br>\
						Eilon would like to congratulate all his family and friends<br>\
						for Rosh Hashana in a special way, using some new skills that<br>\
						he acquired in the passing year, and that's why I was created,<br>\
						to do all the hard work for my lazy creator..!<br>\
						Just Kidding! It seems like I am doing pretty good,<br>\
						I've congratulated <b>".get_counter()."</b> people so far!<br>\
						Ok, enough with the bragging, lets get to it.<br>\
						<b>Tell me, what is your name?</b></font>\"");
						
	define("MESSAGE11h", "\"<font class='text'><b>אהלן!</b><br>\
						אני הַמְאַחֵלוֹמַט, המברך האינטראקטיבי האישי של אילון. נעים להכיר!<br>\
						אילון מעוניין לברך את המשפחה והחברים לכבוד ראש השנה בדרך מיוחדת,<br>\
						ולהשתמש בכמה דברים חדשים שהוא למד בשנה האחרונה..<br>\
						וככה אני נולדתי, כדי לעשות את העבודה השחורה במקום העצלן שיצר אותי..<br>\
						סתם.. צוחק! דווקא נראה שאני מסתדר בינתיים לא רע -<br>\
						בירכתי כבר <b>".get_counter()."</b> אנשים עד עכשיו!<br>\
						טוב, דיי עם ההשתחצנות, ניגש לעניין.<br><br>\
						<b>אז.. איך קוראים לך?</b></font>\"");
						
						
	define("MESSAGE21", "\"<font class='text'>Good to see you, <b>".$_SESSION['uname']."!</b><br>\
						Eilon wishes you <b>Shana Tova!</b> I hope you'll have a great year -<br>\
						with good health, tons of happy moments and great success in<br>\
						your endeavors! May this year be as sweet as honey!<br><br>\
						If you would like to leave a message for Eilon, feel free to send it<br>\
						to me here and I'll make sure he gets it!<br>\
						If you don't wish to leave a message just send 'No'.<br>\
						Don't leave yet, I have a surprise for you!</font>\"");
						
	define("MESSAGE21h", "\"<font class='text'>טוב לראות אותך, <b>".$_SESSION['uname']."!</b><br>\
						אילון מאחל לך <b>שנה טובה!</b> כולי תקווה שתהיה לך שנה מדהימה -<br>\
						בריאות, המון רגעים מאושרים והצלחה בכל צעד וכיוון שחייך יפנו אליו בשנה הזאת! מקווה שהשנה באמת תהיה שנה של דבש,<br>\
						וכמובן - שנהיה לראש ולא לזנב!<br><br>\
						אם תרצו להשאיר ברכה עבור אילון, תרגישו חופשי לכתוב לי אותה כאן<br>\
						ותוכלו להיות בטוחים שאני אעביר לו אותה בהקדם האפשרי!<br>\
						אם אינכם מעוניינים להשאר הודעה, פשוט שלחו לי 'לא'.<br>\
						בכל מקרה, הייתי ממליץ לכם לא ללכת עדיין, יש עוד הפתעה קטנה!</font>\"");

	define("MESSAGE3", "\"<font class='text-sm'>Surprise! How do you find my drawing?<br>\
						I'm not so good with brushes and paint, but I do have letters and colors! Shana Tova!<br>\
						If you would like to watch some very nice youtube Rosh Hashana videos, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">Click Here</a>.<br>\
						It was great meeting you! Bye bye! :-) P.S. Did you like me? Then please <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"/share.png\"+\"></a> Me!\
						</font>\"");
						
	define("MESSAGE3h", "\"<font class='text-sm'>טא-דאם! מה תגידו על הציור שלי??<br>\
						אולי אין לי מברשות ומכחולים, אבל כן יש לי אותיות וצבעים!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");						

	define("MESSAGE31", "\"<font class='text-sm'>OK, message sent. Surprise! How do you find my drawing?<br>\
						I'm not so good with brushes and paint, but I do have letters and colors! Shana Tova!<br>\
						If you would like to watch some very nice youtube Rosh Hashana videos, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">Click Here</a>.<br>\
						It was great meeting you! Bye bye! :-) P.S. Did you like me? Then please <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> Me!\
						</font>\"");
						
	define("MESSAGE31h", "\"<font class='text-sm'>ההודעה נשלחה. טא-דאם! מה תגידו על הציור שלי??<br>\
						אולי אין לי מברשות ומכחולים, אבל כן יש לי אותיות וצבעים!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");						

	define("MESSAGE4", "\"<font class='text'>Hmm.. Listen, I would really love to stay here and play around..<br>\
						but I have a lot of other people to congratulate so we'll do that<br>\
						some other time. Cya! :-)\
						</font>\"");
						
	define("MESSAGE4h", "\"<font class='text'>הממ.. שמע, באמת שהייתי שמח להשאר כאן ולשחק איתך..<br>\
						אבל יש לי עוד הרבה אנשים לברך אז נאלץ לעשות את זה בפעם אחרת.<br>\
						להתראות! :-)<br>\
						נ.ב. נהנית? ספר לחבריך! אבל ששש.. שאילון לא ידע שאני מברך סתם אנשים</font>\"");
	
	function user_defines() {
	define("MESSAGE11hid", "\"<font class='text'><b>אהלן!</b><br>\
						אני הַמְאַחֵלוֹמַט, המברך האינטראקטיבי האישי של ".$_SESSION['user_data']['name'].", נעים להכיר!<br>\
						".$_SESSION['user_data']['m1']."<br><br>\
						בירכתי כבר <b>".get_counter()."</b> אנשים עד עכשיו!<br>\
						טוב, דיי עם ההשתחצנות, ניגש לעניין.<br>\
						<b>אז.. איך קוראים לך?</b></font>\"");
						
	define("MESSAGE21hid", "\"<font class='text'>טוב לראות אותך, <b>".$_SESSION['uname']."!</b><br>\
						".$_SESSION['user_data']['m2']."<br><br>\
						אם תרצו להשאיר ברכה עבור ".$_SESSION['user_data']['name'].", תרגישו חופשי לכתוב לי אותה כאן<br>\
						ותוכלו להיות בטוחים שאני אעביר לו אותה בהקדם האפשרי!<br>\
						אם אינכם מעוניינים להשאר הודעה, פשוט שלחו לי 'לא'.<br>\
						בכל מקרה, הייתי ממליץ לכם לא ללכת עדיין, יש עוד הפתעה קטנה!</font>\"");
						
	define("MESSAGE3hid", "\"<font class='text-sm'>טא-דאם! מה תגידו על הציור שלי??<br>\
						אולי אין לי מברשות ומכחולים, אבל כן יש לי אותיות וצבעים!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/?id=".$_SESSION['user_data']['id']."','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");						

	define("MESSAGE3hidim", "\"<font class='text-sm'>טא-דאם! שנה טובה!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/?id=".$_SESSION['user_data']['id']."','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");						
						
						
	define("MESSAGE31hid", "\"<font class='text-sm'>ההודעה נשלחה. טא-דאם! מה תגידו על הציור שלי??<br>\
						אולי אין לי מברשות ומכחולים, אבל כן יש לי אותיות וצבעים!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/?id=".$_SESSION['user_data']['id']."','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");						

	define("MESSAGE31hidim", "\"<font class='text-sm'>ההודעה נשלחה. טא-דאם! שנה טובה!<br>\
						אם תרצו לצפות בכמה סרטונים נחמדים של ראש השנה ביוטיוב, <a href=\"+\"#\"+\" onClick=\"+\"modal()\"+\" id=\"+\"youmod\"+\">לחצו כאן</a>.<br>\
						היה נהדר לראות אותך! להתראות! נ.ב. אהבת?? אשמח ל <a onClick=\"+\"window.open('http://www.facebook.com/sharer.php?u=http://eilon.me/?id=".$_SESSION['user_data']['id']."','sharer','toolbar=0,status=0,width=548,height=325');\"+\" href=\"+\"javascript: void(0)\"+\"><img src=\"+\"share.png\"+\"></a> !</font>\"");												
						
	define("MESSAGE4hid", "\"<font class='text'>הממ.. שמע, באמת שהייתי שמח להשאר כאן ולשחק איתך..<br>\
						אבל יש לי עוד הרבה אנשים לברך אז נאלץ לעשות את זה בפעם אחרת.<br>\
						להתראות! :-)</font>\"");						
	};
	
	function imageResize($width, $height, $target) {

		$percentage = ($target / $height);
		$width = round($width * $percentage);
		$height = round($height * $percentage);
		return "width=\"$width\" height=\"$height\"";
	};
	
	
	function show_ascii() {
		if ($_SESSION['user_data']['image']){
		
			$image_size = getimagesize("user_images/".$_SESSION['user_data']['id'].".".$_SESSION['user_data']['image_ext']);
			$image_size_html = imageResize($image_size[0],$image_size[1], 300);
			
			echo "<img ".$image_size_html." class='img-responsive' src='/user_images/".$_SESSION['user_data']['id'].".".$_SESSION['user_data']['image_ext']."'>";
		}
		else
			echo "<iframe height=\"310\" width=\"520\" frameborder=\"0\" class=\"embed-responsive-item\" src=\"try.html\"></iframe>";
	};

	
	?>