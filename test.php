<?php
function grab_image($url,$saveto){
    	$ch = curl_init ($url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    	$raw=curl_exec($ch);
    	curl_close ($ch);
    	if(file_exists($saveto)){
	        unlink($saveto);
	    }
	    $fp = fopen($saveto,'x');
	    fwrite($fp, $raw);
	    fclose($fp);
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$action = "http://www.hutterites.org/wp-content/uploads/2012/03/placeholder.jpg";
$file = date("d-m-Y")."-".generateRandomString(12).".jpg";
grab_image($action,"./class/photos/".$file);
$text = "Berhasil menambahkan gambar dengan nama ".$file.". Gunakan command list_photo untuk melihat listnya";

//return array(1,'text',null,$text);
echo $text;