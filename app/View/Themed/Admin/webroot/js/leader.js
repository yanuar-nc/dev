
jQuery(document).ready(function( $ ) {

   var list_notif     = $( "#ListNotification69" )
   var url_list_notif = list_notif.attr( 'ajax-url' );
   var last_id        = 0;

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
                  list_notif.prepend( '<a href="' + redirect + '"><li class="media"><div class="media-body"><strong>' + from + '</strong> ' + text + ' anda.<small class="date"><i class="fa fa-calendar"></i> ' + notification.time + '</small></div></li></a>' );
                  last_id  = notification.id;
               });
               
               
            }  
      }); 

      window.setTimeout("$.fn.ambilPesan()", 5000);
   }
   $.fn.ambilPesan();

});
var param=""; // Berisi id terakhir milik pesan
function penanganPesan(data) {
    
/*   var indeks = data.indexOf("*id_akhir=");
       
   if (indeks == -1)  // Kalau
      return;
   
   var posisi = indeks + 10;
   var id_akhir = data.substr(posisi);
   var info = data.substr(0, indeks);
   
   param = id_akhir;     

   $("#pesan-masuk").prepend(info);*/
}    


 
