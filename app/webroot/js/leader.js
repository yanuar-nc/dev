jQuery(document).ready(function() {

	//$( "#InboxMessage" ).
    //var target = jQuery( '#memberOutput' );

    /*
     * CHECK DIPOSISI
     */
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
   	window.setInterval( inboxMessage, 5000 );

   	/*
   	 * CHECK Surat Keluar
   	 */
    var Message = $( "#OutboxMessage" );
    var MessageUrl = Message.attr( 'url' );
   	function outboxMessage()
   	{
	    jQuery.ajax({

	        type: 'GET',
	        url: MessageUrl,
	        dataType: 'html',
	        beforeSend: function() {
	            //jQuery( loader ).fadeIn();
	        },
	        success: function( res ) {
	            jQuery( Message ).html( res );
	        }
	   	});	

   	}
   	outboxMessage();
   	window.setInterval( outboxMessage, 5000 );
});