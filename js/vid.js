		var video1 = "<iframe width=\"560\" height=\"315\" class=\"embed-responsive-item\" src=\"//www.youtube.com/embed/FlcxEDy-lr0?rel=0\" allowfullscreen></iframe>"
		var video2 = "<iframe width=\"560\" height=\"315\" class=\"embed-responsive-item\" src=\"//www.youtube.com/embed/2gj8nUAdgMw?rel=0\" allowfullscreen></iframe>";
		var video3 = "<iframe width=\"560\" height=\"315\" class=\"embed-responsive-item\" src=\"//www.youtube.com/embed/vCYRM7KYJY4?rel=0\" allowfullscreen></iframe>";
		function vid(videonum) {
			document.getElementById('modadiv').innerHTML = videonum;
		};
		
		$( "form" ).submit(function( event ) {
		var x = document.forms["f_input"]["f_input"].value;
			if (prnt_active === true){
				$('#f_input').tooltip('show')
				event.preventDefault();
			}
			else if ( x == null || x== "" ){
				$('#f_button').tooltip('show')
				event.preventDefault();			
			}			
		});
		
		$('#youtube').on('hide.bs.modal', function (e) {
			$('#logo').popover('show');
			document.getElementById('modadiv').innerHTML = "";
			document.getElementById('modadiv').innerHTML = video1;
		});
		
		$( document ).ready(function() {
			$("button").prop("disabled", false);
		});
