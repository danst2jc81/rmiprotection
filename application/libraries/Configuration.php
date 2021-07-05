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

	public function TenantStatus(){
		$tenantstatus = array ( 0 => 'New', 1 => 'Active', 9 => 'Blacklist');

		return $tenantstatus;
	}

	public function UserLevel(){
		$tenantstatus = array ( 1 => 'Admin', 2 => 'Administrator', 9 => 'Super Admin');

		return $tenantstatus;
	}

	public function PerpetratorStatus(){
		$perpetratorstatus = array ( 1 => 'Belum Tertangkap', 2 => 'Sudah Tertangkap', 3 => 'Sudah Di Proses');

		return $perpetratorstatus;
	}

	public function PackageStatus(){
		$packagestatus = array ( 1 => 'Gratis', 2 => 'Berbayar');

		return $packagestatus;
	}

	public function CustomerStatus(){
		$customerstatus = array ( 9 => 'All', 0 => 'Non Aktif', 1 => 'Aktif');

		return $customerstatus;
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