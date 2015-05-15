<?php
function GrabImage($url,$filename) {
 if($url==""):return false;endif;

 ob_start();
 readfile($url);
 $img = ob_get_contents();
 ob_end_clean();
 $size = strlen($img);

 //"../../images/books/"为存储目录，$filename为文件名
$fp2=@fopen("./".$filename, "a");
fwrite($fp2,$img);
fclose($fp2);

return $filename;
}
GrabImage("http://ubmcmm.baidustatic.com/media/v1/0f000DdQ94ZxaF4jGHXmEs.jpg", "1.jpg");
?>
