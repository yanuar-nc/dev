jQuery(document).ready(function() {

	//$( "#InboxMessage" ).
    //var target = jQuery( '#memberOutput' );
    var InboxMessage = $( "#InboxMessage" );
    var InboxMessageUrl = InboxMessage.attr( 'url' );
   	function inboxMessage()
   	{
	    jQuery.ajax({

	        type: 'GET',
	        url: InboxMessageUrl,
	        dataType: 'html',
	        beforeSend: function() {
	            //jQuery( loader ).fadeIn();
	        },
	        success: function( res ) {
	            jQuery( InboxMessage ).html( res );
	        }
	   	});	

   	}
   	inboxMessage();
   	window.setInterval( inboxMessage, 105000 );
});