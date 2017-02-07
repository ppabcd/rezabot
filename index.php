<?php
if (file_exists('error_log')) unlink('error_log');
if (file_exists('./class/error_log')) unlink('./class/error_log');
ini_set('display_errors',TRUE);
if(file_exists('error_log'))unlink('error_log');
//header("content-type:text/plain");
date_default_timezone_set("Asia/Jakarta");
ini_set("max_execution_time",false);
ini_set("memory_limit","3072M");
//set_time_limit(0);
//ignore_user_abort(true);
$username = "ppabcd"; // diawur, anggep ae (nickname bot) :v
$botname = "Juliandri Reza";
$email = "rezajuliandri20@gmail.com"; // email facebook bot
$pass = ""; // password facebook bot
//$gcid = urlencode("1240398659341515"); // target chat
//$gcid = "875621512565891";
//$gcid = "1513484758685910";
$gcid = urlencode("1240398659341515");
$gcid = urlencode("1513484758685910");
if(isset($_GET['q'])){
	$gcid = urlencode($q);
}
$token = ""; // kosongkan token
define("fb","fb_data");
define("cookies",fb.DIRECTORY_SEPARATOR."cookies");
define("data",fb.DIRECTORY_SEPARATOR."data");
define("list_token",data.DIRECTORY_SEPARATOR."list_token.txt");
define("new_post",data.DIRECTORY_SEPARATOR.$username."_new_post.txt");
if(!is_dir(fb)) mkdir(fb);
if(!is_dir(cookies)) mkdir(cookies);
if(!is_dir(data)) mkdir(data);
//$folder = "F:/AI2/";
$folder = "";
define("FOLDER",$folder);
require_once($folder."./class/Crayner_Machine.php");
require_once($folder."./class/Facebook.php");
require_once($folder."./class/AI.php");
//echo `rm -rf cht_saver`;
$fb = new Facebook($email,$pass,$token,$username);
$cookies = file_get_contents(getcwd()."/".cookies.DIRECTORY_SEPARATOR.$username."_".md5($pass).".txt"); // check cookie 1
if (!strpos($cookies,"c_user")!==false) {
	$content = $fb->login();
}
$content = $fb->go_to("https://m.facebook.com/messages/read/?tid=".$gcid);
//var_dump($content);exit();
$cookies = file_get_contents(getcwd()."/".cookies.DIRECTORY_SEPARATOR.$username."_".md5($pass).".txt"); // check cookie 2
if (!strpos($cookies,"c_user")!==false) {
	$content = $fb->login();
}
$cookies = file_get_contents(getcwd()."/".cookies.DIRECTORY_SEPARATOR.$username."_".md5($pass).".txt"); // check cookie 3
if (!strpos($cookies,"c_user")!==false) {
	$cookies=$content=null;
	exit("Login Failed !");
}
$filtered = preg_replace("#[^[:print:]]#",'',$content);
$filtered = explode("Lihat Pesan Sebelumnya",$filtered);
$filtered = explode("<form",$filtered[1]);
$exploder = "qwertyuiopasdfghjklzxcvbnm";
for ($i=0;$i<strlen($exploder);$i++) {
	$filtered = explode('<strong class="b'.$exploder[$i].'">',$filtered[0]);
	if (count($filtered)>1) {
		$exploder=null;
		break;
	}
}
for ($i=1;$i<count($filtered);$i++) {
	$a = explode('</strong>',$filtered[$i]);
	$name = $a[0];
	$a = explode('</a><br /><div><span>',$a[1]);
	$a = explode('<span>',$a[1]);
	for ($j=0;$j<count($a);$j++) {
		$c = explode('<abbr>',$a[$j]);
		if(count($c)>1) break;
		$c = explode('</span>',$a[$j]);
		$b[$name][] = html_entity_decode(str_replace("&shy;","",strip_tags(str_replace("<br />","\n",$c[0]))),ENT_QUOTES,'UTF-8');
	}
}
if (count($b)<2) {
	$content = $fb->go_to("https://m.facebook.com/messages/read/?tid=".$gcid);
	$filtered = preg_replace("#[^[:print:]]#",'',$content);
	$filtered = explode("Lihat Pesan Sebelumnya",$filtered);
	$filtered = explode("<form",$filtered[1]);
	$exploder = "qwertyuiopasdfghjklzxcvbnm";
	for ($i=0;$i<strlen($exploder);$i++) {
		$filtered = explode('<strong class="b'.$exploder[$i].'">',$filtered[0]);
		if (count($filtered)>1) {
			$exploder=null;
			break;
		}
	}
	for ($i=1;$i<count($filtered);$i++) {
		$a = explode('</strong>',$filtered[$i]);
		$name = $a[0];
		$a = explode('</a><br /><div><span>',$a[1]);
		$a = explode('<span>',$a[1]);
		for ($j=0;$j<count($a);$j++) {
			$c = explode('<abbr>',$a[$j]);
			if(count($c)>1) break;
			$c = explode('</span>',$a[$j]);
			$b[$name][] = html_entity_decode(str_replace("&shy;","",strip_tags(str_replace("<br />","\n",$c[0]))),ENT_QUOTES,'UTF-8');
		}
	}
}
function save($str,$actor){
	if(!is_dir("cht_saver")) mkdir('cht_saver');
	return file_put_contents(getcwd().'/cht_saver/'.md5($actor.$str.date('H')),0);
}
function check($str,$actor){
	return !file_exists(getcwd().'/cht_saver/'.md5($actor.$str.date('H')));
}
function get_photo($photo,$saveto=null){
	global $fb;
	if ($saveto===null) {
		return $fb->get_photo($photo);
	} else {
		return $fb->get_photo($photo,$saveto);
	}
}
$logic = new AI();
$content=$a=$filtered=$email=$pass=$token=null;
foreach ($b as $actor => $msg) {
	foreach ($msg as $value2) {
		$logic->get(strtolower($value2));
		$response = $logic->execute();
		if (strpos($value2,"// PHP")!==false||strpos($value2,"//PHP")||strpos($value2,"<?php")!==false) {
			if (strpos($value2,"<?php")!==false) {
				$q = explode("\n",$value2);
				if (strlen($q[0])>5&&substr($q[0],0,5)=="<?php") $q[0]=str_replace("<?php","",$q[0]);
				if (strlen($q[1])>5&&substr($q[1],0,5)=="<?php") $q[1]=str_replace("<?php","",$q[1]);
				if (strlen($q[0])<6&&substr($q[0],0,5)=="<?php") unset($q[0]);
				if (strlen($q[1])<6&&substr($q[1],0,5)=="<?php") unset($q[1]);
				$php = implode("\n",$q);
			} else {
				$php = $value2;
			}
			$action[$actor] = array(0,Crayner_Machine::php($php,$actor));
			if(strpos("logs",$php)!==false) $logs[$actor] = true;
		} else
		if ($actor==$botname) {
			$action[$actor] = false;
		} else
		if ($response!==false AND check($value2,$actor)) {
			$action[$actor] = $logic->returna($response,$actor);
			save($value2,$actor);
		}
	}
}
print_r($b);echo(str_repeat(PHP_EOL,3));
if (isset($action)) {
	foreach ($action as $key => $value) {
		if ($action[$key]!==false) {
			if ($value[0]==1) {
				if ($value[1]=='photo') {
					$action[$key] = 'photo response'.$fb->upload_photo($value[2],$value[3],$gcid);
				} else
				if ($value[1]=='text') {
					$action[$key] = 'messages response'.$fb->send_message($value[3],$gcid);
				}
			}
		} else {
			$action[$key] = 'false';
		}
	}
}
$php=$b=$a=$actor=$msg=$value2=null;
print_r($b);
if (isset($action)) {
	print_r($action);
}
die();
?>
