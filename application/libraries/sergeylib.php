<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class sergeylib{
	public function __construct(){
		define("CANVAS_ORDER_REQUISITION_NO", "CORN-".implode(explode(".",microtime(true))));
		define("SALES_ORDER_NO", "SO-".implode(explode(".",microtime(true))));
		error_reporting (0);
		// $this->Gender 					= array(0 =>"Female", 1=>"Male");
	}
	
	public function generateaccesstoken(){
		if(extension_loaded("openssl")){
			$random = bin2hex(openssl_random_pseudo_bytes(100));
		}else if(extension_loaded("mcrypt")){
			$random = bin2hex(mcrypt_create_iv(100, MCRYPT_DEV_URANDOM));
		}else{
			$seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789~!@#$%^&*()_+-=[]{}"|\,./<>?');
			shuffle($seed);
			$random = '';
			foreach (array_rand($seed, 100) as $k){
				$random .= $seed[$k];
			}
			$random = $random.mt_rand().uniqid()."????????? ?????? ??????";
			shuffle($random);
			bin2hex($random);
		}
		$accesstoken = strtoupper(hash("sha256",$random));
		return $accesstoken;
	}
	
	public function nominal($a){
		if(isset($a)){
			if($a==''){$a=0;}
			return number_format($a);
		}else{
			return "-";
		}
	}
}