<?php
class MyFunctionBehavior extends ModelBehavior{
    function seo_title(Model $model, $s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;  
    }
    function seo_gambar(&$Model, $s){
      $a = array(' ');
      $b = array ('/','\\',',','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
      
      $s = str_replace($b, '',$s);
      $s = strtolower(str_replace($a, '-',$s));
      
      return $s;
    }
}
?>
