<?php
date_default_timezone_set("Asia/Jakarta");
/**
* @author Ammar F. https://www.facebook.com/ammarfaizi2 <ammarfaizi2@gmail.com>
* @license RedAngel_PHP_Concept (c) 2017
* @package Artificial Intelegence
*/
include 'Whois/Whois.php';

class AI{
	public function __construct(){
		$pika = "Jadwal Pelajaran Devika\n\n";
		$reza = "Jadwal Pelajaran Reza\n\n";
		$this->delete = TRUE;
		$this->turn = 0;
		$this->jam = array('#01','#02','#03','#04','#05','#06','#07','#08','#09','#10','#11','#12','#13','#14','#15','#16','#17','#18','#19','#20','#21','#22','#23','#24','#00',);
		$this->sapa = array('dini hari','dini hari','dini hari','dini hari','pagi','pagi','pagi','pagi','pagi','menjelang siang','siang','siang','siang','siang','sore','sore','sore','sore','malam','malam','malam','malam','malam','malam','malam');
		$this->jadwal 	= array(
			"Senin"		=>$reza."Senin\n\nSeni Budaya(2)\nBahasa Indonesia\nAgama\nMatematika(2)\nSistem Operasi\n",
			"Selasa"	=>$reza."Selasa\n\nPKN(2)\nSejarah Indonesia\nSistem Operasi\nPemograman Web/Dasar\nPenjas(2)\n",
			"Rabu"		=>$reza."Rabu\n\nSistem Operasi(2)\nBahasa Indonesia\nAgama(2)\nBahasa Indonesia\n",
			"Kamis"		=>$reza."Kamis\n\nPemograman Web / Dasar(2)\nBahasa Inggris(2)\nMTK(2)\n",
			"Jum'at"	=>$reza."Jum'at\n\nSimulasi Digital(3)\nPrakarya dan KWH(2)\nTKJ Dasar(2)\n",
			"Sabtu"		=>$reza."Sabtu\n\nSistem Komputer(2)\nPemograman Web(2)\nSejarah indonesia\nFisika\n",
			"Minggu"	=>$reza."Minggu\n\nITC B|",
		);
		$this->jadwal1 = array(
			"Senin"		=>$pika."Senin\n\nIlmu Pengetahuan Sosial\nPendidikan Kewarganegaraan\nBahasa Indonesia",
			"Selasa"	=>$pika."Selasa\n\nIlmu Pengetahuan Alam\nOlahraga\nIlmu Pengetahuan Sosial\nMatematika",
			"Rabu"		=>$pika."Rabu\n\nIlmu Pengetahuan Alam\nMatematika\nBahasa Inggris\nBimbingan Korseling\n",
			"Kamis"		=>$pika."Kamis\n\nTIK\nBimbingan Korseling\nBahasa Jawa\nIps\n",
			"Jum'at"	=>$pika."Jum'at\n\nBahasa Inggris\nSeni Budaya dan Keterampilan\n",
			"Sabtu"		=>$pika."Sabtu\n\nSeni Budaya\nAgama Islam\nBahasa Indonesia\n",
			"Minggu"	=>$pika."Minggu\n\nGk sekolah",
		);
		$this->hari 		= array("Minggu","Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu");
		$today 		= $this->hari[date("w")];
		$tanggal 	= (string)date("Y-F-d");
		$jam	 	= (string)date("h:i:s");
		$this->wordlist = array(
			// sapaan
			"assalamualaikum,asalamualaikum"		=>array(array("waalaikumsalam"),4,null,30,null),
			"hi,hy,hai"								=>array(array("hai juga ^@"),4,null,20,null),
			"halo,hallo,hello"						=>array(array("halo juga ^@"),5,null,30,null),
			"pagi"									=>array(array("selamat pagi ^@, selamat beraktifitas"),5,range(0,10),30,null),
			"siang"									=>array(array("selamat siang ^@"),5,range(11,14),30,null),
			"sore"									=>array(array("selamat sore ^@"),5,range(15,19),30,null),
			"malam,malem"							=>array(array("selamat malam ^@"),5,array_merge(range(18,24),range(0,3)),30,null),
			// pertanyaan
			"what time"								=>array(array("Time ".$jam." ".date("A")),6,null,45,null),
			"besok tanggal berapa"					=>array(array($this->hari[date('w')].date(" Y-F-d",strtotime(date("Y-m-d")."+1day"))),5,null,30,null),
			"besok ada acara apa"					=>array(array("acara PDO::FETCH_ASSOC"),5,null,30,null),
			"jam br,jam berapa,pukul berapa"		=>array(array("sekarang jam ".$jam." #".date("H").", ^@"),6,null,45,null),
			"pa kabar,pa kbr"						=>array(array("kabar baik disini"),5,null,30,null),
			"tanggal berapa,tnggl berapa"			=>array(array($today." ".$tanggal),4,null,30,null),
			"tgl brp,tanggal brp"					=>array(array($today." ".$tanggal),4,null,30,null),
			"tnggal brp,tanggl brp"					=>array(array($today." ".$tanggal),4,null,30,null),
			"waktu sekarang,waktu skrg"				=>array(array($today." ".$tanggal." ".$jam." ".date("A")),4,null,30,null),
			"wktu sekarang,wktu skrg"				=>array(array($today." ".$tanggal." ".$jam." ".date("A")),4,null,30,null),
			// other
			"lagi apa"								=>array(array("lagi jaga server :v"),3,null,15,null),
			"oh baguslah"							=>array(array("oke baiklah"),7,null,30,null),
			"baguslah"								=>array(array("oke baiklah"),4,null,15,null),
			"laper,lapar"							=>array(array("mari makan dulu, biar kenyang ^"),10,null,30,null),
			"buatkan aku makanan"					=>array(array("maaf ^@, saya sedang mengurus server ^"),5,null,50,null),
			"thank"									=>array(array("welcome"),3,null,15,null),
			"makasih,terima kasih"					=>array(array("sama sama"),3,null,30,null),
			"trims,terima kash"						=>array(array("sama sama"),3,null,30,null),
			"mkasih,trima kasih"					=>array(array("sama sama"),3,null,30,null),
			"mksih,trima ksih"						=>array(array("sama sama"),3,null,30,null),
			"jones,jon*s,j*nes"						=>array(array("ciee ^@ jones"),6,null,35,null),
			"bot itu siapa"							=>array(array("saya cuma sekedar pelayan server, ^@, salam kenal"),3,null,35,null),
			"udah makan"							=>array(array("saya tidak makan, ^@"),6,null,40,null),
			"mampus,mpos,mampos"					=>array(array("mampus lu ^@ :p"),2,null,15,null),
			"reza,rez"							=>array(array("Reza (y) T.T"),3,null,15,null),
			"vik,vika"								=>array(array("Pika (y) :)","Vika XD","Devika :)"),3,null,15,null),
			"kyla"									=>array(array("Namaku itu <3","ada apa ^@?"),3,null,15,null),
			"good"									=>array(array("good lah (y)","good (y)"),2,null,10,null),
			"test"									=>array(array("test apa kang ^@?","test sukses kang ! (y)"),3,null,8,null),
			"wkwk"									=>array(array("dilarang ketawa !"),2,null,10,null),
			"haha"									=>array(array("dilarang ketawa !"),2,null,10,null),
			"njir,jir"								=>array(array("rumahmu kebanjiran ya ^@?"),5,null,30,null),
			"oke"									=>array(array("oke (y)","oke baiklah"),3,null,15,null),
			"sip"									=>array(array("sip (y)","sip joss (y)"),2,null,15,null),
			"bot"									=>array(array("ada yang bisa saya bantu?","ada apa ^@?"),2,null,6,null),
			"kok di read, kok di read doang"		=>array(array("Maaf aku lagi sibuk"),3,null,15,null),
			"sedih"									=>array(array("Kamu kenapa sedih"),3,null,15,null),
			"kamu siapa"							=>array(array("Namaku Kyla. Aku robot buatan Reza. Namun namaku dari nama temennya yang sudah tidak pernah terlihat lagi. Dulu pembuatku sering bermain dengan dia namun kini tidak tahu keberadaannya :( . Link profile https://www.facebook.com/kyla.noelle.9?fref=ts"),3,null,15,null),
			"tinggal dmn, tinggal dimana"			=>array(array("Aku tinggal di servernya Reza ;)"),3,null,15,null),
			"error"									=>array(array("Server Status : OK"),3,null,15,null),
			"kangen dia"							=>array(array("Dia siapa ^@?"),3,null,15,null),
			"itu, ituloh"							=>array(array("Jelasin lebih rinci ^@"),3,null,15,null),
			"cantik gk,ganteng gk,aku cantik ga,aku cantik gk,aku ganteng gk,aku ganteng gk,gw cantik gk, gw cantik ga"=>array(array("Hmm iya <3","kayaknya enggak deh :P","Tanya ke yg lain aja","Banget <3"),3,null,15,null),

		);
		$this->special_words = array("photo","whois","list_photo","bot_menu","kyla_menu","hitung","jadwal","jadwalku","search","map","getimg");
	}
	/**
	* @param user_message,wordlist,
	*/
	private function messages_check($haystack,$needle,$max_words=null,$time_exec=null,$max_length=null,$word_expection=null){
		if (is_array($time_exec)&&!in_array((int)date('H'),$time_exec)) {
			return false;
		} else {
			$strlen_haystack = strlen($haystack);
			$haystack = explode(" ",$haystack);
			if ($word_expection!==null){
				$word_expection = explode(",",$word_expection);
				foreach ($word_expection as $val) {
					foreach ($haystack as $val2) {
						if (strpos($val2,$val)!==false) {
							return false;
							break;
						}
					}
				}
			}
			if ($max_length!==null AND $strlen_haystack>$max_length) return false;
			if ($max_words!==null AND count($haystack)>$max_words) return false;
			$needle = explode(",",$needle);
			foreach ($needle as $val) {
				if (strpos(implode(" ",$haystack),$val)!==false) {
					return true;
					break;
				}
			}
			foreach ($needle as $val) {
				foreach ($haystack as $val2) {
					if (strpos($val2,$val)!==false) {
						return true;
						break;
					}
				}
			}
		}
	}
	public static function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            self::deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
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
	private function grab_image($url,$saveto){
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
	private function action($key,$action=""){
		if ($key=="whois") {
			$sld = trim($action," ");
			$domain = new Whois\Whois($sld);
			if ($domain->isAvailable()) {
				$sd = "Domain is available".PHP_EOL;
			} else {
				$sd = "Domain is registered".PHP_EOL;
			}
			$c = "";
			$get = array("Domain Name:","Registrar URL:","Updated Date:","Creation Date:","Registrar Registration Expiration Date:","Registrar:","Registrant Name:","Registrant Organization:","Registrant Street:","Registrant State/Province:","Registrant Phone:","Name Server:");;
			foreach (explode("\n",$domain->info()) as $val) {
				foreach ($get as $val2) {
					if (strpos($val,$val2)!==false) {
						$c .= $val.PHP_EOL;
					}
				}
			}
			$c .= PHP_EOL.$sd;
			return array(1,'text',null,$c);
		} else
		if($key == "hitung"){
			$data = eval('return '.$action.';');
			$text = "Hasilnya adalah ".$data;
			return array(1,'text',null,$text);
		}else
		if($key == "map"){
			$text = "Klik link ini untuk membuka google map https://www.google.co.id/maps/search/".$action."/";
			return array(1,'text',null,$text);
		}
		else
		if($key == "search"){
			if(empty($action)) return false;
			$query = urlencode($action);
			$text = "Silahkan klik link ini "."https://www.google.co.id/search?q=".$query."&oq=".$query;
			return array(1,'text',null,$text);
		}
		else
		if($ket == "getimg"){
			$file = date("d-m-Y")."-".$this->generateRandomString(12).".jpg";
			$this->grab_image($action,"./class/photos/".$file);
			$text = "Berhasil menambahkan gambar dengan nama ".$file.". Gunakan command list_photo untuk melihat listnya";

			return array(1,'text',null,$text);
		}else
		if ($key=="photo") {
			$q = (file_exists("./class/photos/".$action.".jpg")||file_exists("./class/photos/".$action.".gif"));
			$photo = $q===true ? "./class/photos/".$action.".jpg" : "./class/photos/not_found.jpg";
			$caption = $q===true ? $action." (y)" : "Mohon maaf, photo $action tidak ditemukan";
			return array(1,'photo',$photo,$caption);
		} else
		if ($key=='list_photo') {
			$a = scandir("./class/photos");
			unset($a[0],$a[1]);
			$text = "";
			$jum = count($a);
			$z = 1;
			for ($i=2;$i<=$jum+1;$i++) {
				$text .= $z.". ".$a[$i].PHP_EOL;
				$z++;
			}
			$text .= PHP_EOL."Total ".$jum;
			return array(1,'text',null,$text);
		} else
		if (($key=='bot_menu')||($key == "kyla_menu")) {
			$text = "Beberapa perintah spesial yang aku ngerti\n\nphoto [nama_foto]\nwhois [domain]\nhitung [perhitungan]\nlist_photo [nama photo]\nhitung [angka]\njadwal [command]\njadwalku[command]\nsearch [seach data]\nmap [place]\nUntuk sementara baru itu ";
			return array(1,'text',null,$text);
		} else
		if ($key=='jadwal') {
			$a = explode(" ",$action);
			if (strpos($action,'besok')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+1day"))]];
			} else
			if (strpos($action,'kemarin')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."-1day"))]];
			} else
			if (strpos($action,'2 hari+')!==false||strpos($action,'2 hari kedepan')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+2day"))]];
			} else
			if (strpos($action,'3 hari+')!==false||strpos($action,'3 hari kedepan')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+3day"))]];
			} else
			if (strpos($action,'4 hari+')!==false||strpos($action,'4 hari kedepan')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+4day"))]];
			} else
			if (strpos($action,'5 hari+')!==false||strpos($action,'5 hari kedepan')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+5day"))]];
			} else
			if (strpos($action,'6 hari+')!==false||strpos($action,'6 hari kedepan')!==false) {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')."+6day"))]];
			} else {
				$text = $this->jadwal[$this->hari[date('w',strtotime(date('Y-m-d')))]];
			}
			return array(1,'text',null,$text);
		}
		else
		if ($key=='jadwalku') {
			$a = explode(" ",$action);
			if (strpos($action,'besok')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+1day"))]];
			} else
			if (strpos($action,'kemarin')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."-1day"))]];
			} else
			if (strpos($action,'2 hari+')!==false||strpos($action,'2 hari kedepan')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+2day"))]];
			} else
			if (strpos($action,'3 hari+')!==false||strpos($action,'3 hari kedepan')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+3day"))]];
			} else
			if (strpos($action,'4 hari+')!==false||strpos($action,'4 hari kedepan')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+4day"))]];
			} else
			if (strpos($action,'5 hari+')!==false||strpos($action,'5 hari kedepan')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+5day"))]];
			} else
			if (strpos($action,'6 hari+')!==false||strpos($action,'6 hari kedepan')!==false) {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')."+6day"))]];
			} else {
				$text = $this->jadwal1[$this->hari[date('w',strtotime(date('Y-m-d')))]];
			}
			return array(1,'text',null,$text);
		}
	}
	public function get($str){
		$this->messages = strtolower($str);
	}
	public function execute(){
		if (!isset($this->messages)||empty($this->messages)) return false;
		$messages = explode(" ",$this->messages);
		foreach ($this->special_words as $val) {
			if ($messages[0]==$val) {
				unset($messages[0]);
				return $this->action($val,implode(" ",$messages));
				echo $key;exit();
				break;
			}
		}
		$messages=null;
		foreach ($this->wordlist as $key => $val) {
			if ($this->messages_check($this->messages,$key,(isset($val[1])?$val[1]:null),(isset($val[2])?$val[2]:null),(isset($val[3])?$val[3]:null),(isset($val[4])?$val[4]:null))) {
				return $key;
				break;
			}
		}
		//return array(1,'text',null,'Maaf aku masih kecil. Aku gk ngerti bahasa itu.');
		return false;
	}
	public function returna($word,$actor="@"){
		if (is_array($word)){
			return $word;
		}
		if (!isset($this->wordlist[$word])) return false;
		$actor = explode(" ",$actor);
		$word = str_replace("^@",$actor[0],$this->wordlist[$word][0][rand(0,count($this->wordlist[$word][0])-1)]);
		$word = str_replace("^@",implode(" ",$actor),$word);
		$word = str_replace($this->jam,$this->sapa,$word);
		return array(1,'text',null,$word);
	}
}
?>
