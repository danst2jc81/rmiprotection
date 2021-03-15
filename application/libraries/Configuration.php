<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class Configuration {
	public function __construct(){
		define('SQL_HOST','localhost');
		define('SQL_USER','root');
		define('SQL_PASSWORD','');
		define('SQL_DB','ims_mitra_utama');
		define('PAGGING','10');
		define('LIMIT','E5BWpg==');

	}

	public function PackageCustomDomain(){
		$packagecustomdomian = array ( 0 => 'Tidak Custom Domain', 1 => 'Custom Domain');

		return $packagecustomdomian;
	}

	public function PackageDonation(){
		$packagedonation = array (1 => 'Bisa Donasi', 0 => 'Tidak Bisa Donasi');

		return $packagedonation;
	}

	public function PackageGift(){
		$packagegift = array (0 => 'Tidak Menerima Hadiah', 1 => 'Menerima Hadiah');

		return $packagegift;
	}




	function Unpush($pesan,$key){//$key >= 0 or <=25
		$msg = str_split($pesan);
		$dresult = '';
		for($j=1;$j<=strlen($pesan);$j++){
			if ((ord($msg[$j-1])<65) or (ord($msg[$j-1])>90)){
				$dresult = $dresult.$msg[$j-1];
			} else {
				$ord_msg[$j-1] = 65+fmod(ord($msg[$j-1])+65-$key,26);
				$dresult = $dresult.chr($ord_msg[$j-1]);
			}
		}
		return $dresult;
	}
	
	function convert($msg){
		$division	= bindec("010");
		$lenght		= strlen($msg);
		$div		= $lenght/$division;
		$ret		='';
		$block		='';
		for($i=0;$i<$div;$i++){
			$val	= substr($msg,$i*$division,$division);
			if(substr($val,1,1)=="0"){
				$val = substr($val,0,1);
			}
			$dec 	= hexdec($val);
			if(strlen($dec)==1){
				$bin='00'.$dec;
			}else if(strlen($dec)==2){
				$bin='0'.$dec;
			} else {
				$bin=$dec;
			}
			$block .= $bin;
			if (strlen($block)==6){
				$text = chr(bindec($block));
				$ret	.= $text;
				$block='';
			}
		}
		return $ret;
	}
	
	function Text($plain){
		$division	= bindec("010");
		$lenght		= strlen($plain);
		$div		= $lenght/$division;
		$ret		='';
		$block		='';
		for($i=0;$i<$div;$i++){
			$val	= substr($plain,$i*$division,$division);
			if($val=='00'){
				continue;
			} else {
				$dec 	= hexdec($val);
				if(strlen($dec)==1){
					$bin='00'.$dec;
				}else if(strlen($dec)==2){
					$bin='0'.$dec;
				} else {
					$bin=$dec;
				}
				$ret .= $bin;
			}
		}
		return chr(bindec($ret));
	}
	
	function reassembly($byte){
		$text = '';
		for($i=0;$i<(strlen($byte)/6);$i++){
			$text .= $this->Text(substr($byte,$i*6,6));
		}
		return $text;
	}
	
	function rearrange($text){
		for($i=0;$i<(strlen($text)/2);$i++){
			$arr[$i] = substr($text,$i*2,2);
		}
		$result = implode(":",$arr);
		return $result;
	}
}