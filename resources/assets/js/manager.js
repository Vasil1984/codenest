$(document).ready(function() {
	


	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});


/*	--------------------------------------------------------
 * 	Updating status
 */
	$("td.flag input").click(function(e){
		
		//console.log("vasil");
		var input	= $(this);
		var value	= ( input.is(":checked") ) ? 'readed' : 'unread';
		var flag	= input.attr("data-flag");
		var url		= input.attr("data-url");
		console.log(url);
		$.ajax({
			url			: url,
			type		: "POST",
			dataType	: "json",
			data		: {
				flag	: flag,
				value	: value
			},
			success		: function( json ) {
				console.log(json);
			},
			error		: function(err) {
				console.log('error');
			}
		});
	});

	
});




