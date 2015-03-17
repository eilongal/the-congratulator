
		var str = "<p><font size=4>"+"<b>Hi There!</b><br>I'm Eilon's personal congratulator - המאחלומט.<br>Eilon thought it'll be nice to have someone congratulating all his family and friends on his behalf, so here I am, doing all the hard work. I've congratulated "+cong_counter+" people so far!<br>Ok, enough with the bragging, lets get to the point.<br><b>Tell me, What is your name?</b>"+"</font></p>",
			i = 0,
			isTag,
			text;
		(function type() {
			text = str.slice(0, ++i);
			if (text === str) {
				type_in_prog=false;
				return;
			}
			document.getElementById('twriter').innerHTML = text;

			var char = text.slice(-1);
			if( char === '<' ) isTag = true;
			if( char === '>' ) isTag = false;

			if (isTag) return type();
			setTimeout(type, 50);
		}());