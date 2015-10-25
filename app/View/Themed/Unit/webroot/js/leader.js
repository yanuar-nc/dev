jQuery(document).ready(function() {

	//$( "#InboxMessage" ).
    //var target = jQuery( '#memberOutput' );

    /*
     * CHECK DIPOSISI
     */
/*    var InboxMessage = $( "#InboxMessage" );
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
*/
   	/*
   	 * CHECK Surat Keluar
   	 */
/*    var Message = $( "#OutboxMessage" );
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
   	window.setInterval( outboxMessage, 5000 );*/

   	
   var list_notif     = $( "#ListNotification69" )
   var url_list_notif = list_notif.attr( 'ajax-url' );
   var last_id        = 0;
   var notification_count = 0;
   $.fn.ambilPesan = function() {

      jQuery.ajax({
            type: 'GET',
            url: url_list_notif + '/' + last_id,
            dataType: 'json',
            success: function(datas) {
               //penanganPesan(data);
               //window.log( 's' );
                jQuery.each( datas, function( index, data ){
					var notification = data.Notification;
					var redirect = notification.redirect;
					var from     = notification.from;
					var text     = notification.text;
					list_notif.prepend( '<a href="' + redirect + '"><li class="media"><div class="media-body"><strong>' + from + '</strong> ' + text + ' kepada anda.<small class="date"><i class="fa fa-calendar"></i> ' + notification.time + '</small></div></li></a>' );
					last_id  = notification.id;
					notification_count++;
                });
				if ( notification_count > 0 ) $( "#NotificationCount" ).text( notification_count );
				else $( "#NotificationCount" ).text();

		      	if ( datas.length > 0 )
		      	{
					var audioElement = $( "#soundNotification" );
					audioElement.html( '<audio controls autoplay style="display: none"><source src="' + audioElement.attr( 'sound-path' ) + '" type="audio/mpeg"></audio> ');
		      		
		      	}

               
               
            }  
      }); 

      window.setTimeout("$.fn.ambilPesan()", 5000);
   }
   $.fn.ambilPesan();
      	
});