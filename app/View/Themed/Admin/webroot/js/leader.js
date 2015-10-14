var url_list_notif = null;

jQuery(document).ready(function() {

   url_list_notif = $( "#ListNotification" ).attr( 'ajax-url' );
});
var param=""; // Berisi id terakhir milik pesan
function ambilPesan() {

   $.ajax({
      url: 'http://localhost:90/itpm/admin/notifications/lists',   
      type: "GET",  
      dataType: "json",
      success: function(data) {
         //penanganPesan(data);
         window.log( 's' );
      }  
   }); 
/*   
*/
       
   //alert( url_list_notif );
   window.setTimeout("ambilPesan()", 5000);
}
ambilPesan();
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


 
