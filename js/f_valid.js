

		$( "form" ).submit(function( event ) {
		var x = document.forms["create"]["cname"].value;
			if ( x == null || x== "" ){
				$('#cname').tooltip('show')
				event.preventDefault();			
			}			
		});