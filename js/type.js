		var prnt_active = true;
		
		var str = <?php echo constant("MESSAGE".$_SESSION['stage'].$ismsg); ?>,
			i = 0,
			isTag,
			text;
			
		function type() {
			
			text = str.slice(0, ++i);
			if (text === str) {
			$('#f_input').tooltip('destroy')
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