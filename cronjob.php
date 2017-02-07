<?php
$daftar_target = array("1513484758685910","1240398659341515");
foreach($daftar_target as $val){
    $curl = curl_init();
    curl_setopt ($curl, CURLOPT_URL, "http://rezabot-ppabcd.c9users.io/?q=".$val);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec ($curl);
    curl_close ($curl);
    print $result;
}