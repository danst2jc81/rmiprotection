<?php
	Class ValidationProcess extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ValidationProcess_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library('session');
			$this->load->database("default");
		}
		
		public function index(){
			$posisition = str_replace('\'', '/', realpath(dirname(__FILE__))) . '/';
			$root		= str_replace('\'', '/', realpath($posisition . '../../')) . '/';
			$path		= $root."application/logs";
			if ($nuxdir = opendir($path)){     //buka direktory yang diperkenalkan
				while ($isi = readdir($nuxdir)) {
					if(is_numeric(strpos($isi, "-"))){
						$pos = explode('-',$isi);
						if(count($pos)==4){
							if($pos[2]==date('m')){
								continue;
							} else {
								unlink($path."/".$isi);
							}
						}else{
							continue;
						}
					}else{
						continue;
					}
				}
				closedir($nuxdir);
			}
			
			$now = strtotime(date("Y-m-d"));
			$filename = $root.'parameter.par';
			if (file_exists($filename)) {
				$last = strtotime(date("Y-m-d", filectime($filename)));
				if($now>$last){
					$content ='';
					for($i=0;$i<5000;$i++){
						if ($i==2500){
							$content .= "?".get_unique().";";
						} else {
							$content .= chr(rand(128,248));
						}
					}
					$file = fopen($filename, 'w');		
					fwrite($file, $content);
					fclose($file);
				}
			} else {
				$content ='';
					for($i=0;$i<5000;$i++){
						if ($i==2500){
							$content .= "?".get_unique().";";
						} else {
							$content .= chr(rand(128,248));
						}
					}
					$file = fopen($filename, 'w');		
					fwrite($file, $content);
					fclose($file);
			}
			
			$this->load->view('loginForm');
		}

		public function loginValidate(){
			$data = array(
				'customer_email' 	=> $this->input->post('customer_email',true),
				'customer_password' => md5($this->input->post('customer_password',true))
			);
			
			$this->form_validation->set_rules('customer_password', 'Password User', 'required');
			$this->form_validation->set_rules('customer_email', 'Email User', 'required');
			
			if($this->form_validation->run()==true){
				$systemuser 	= $this->ValidationProcess_model->getSystemUser($data);
				if(count($systemuser)>1){

					$this->fungsi->set_log($systemuser['user_id'], $systemuser['username'],'1001','Application.ValidationProcess.verifikasi',$systemuser['username'],'Login System');
					
					$this->session->set_userdata('auth', array(
									'user_id'					=> $systemuser['user_id'],
									'username'					=> $systemuser['username'],
									'password'					=> $systemuser['password'],
									'user_group_level'			=> $systemuser['user_group_id'],
									'user_level'				=> $systemuser['user_level'],
									'region_id'					=> $systemuser['region_id'],
									'branch_id'					=> $systemuser['branch_id'],
									'vendor_id'					=> $systemuser['vendor_id'],
								)
							);

					$_SESSION['KCFINDER']				= array();
					$_SESSION['KCFINDER']['disabled'] 	= false;
					$_SESSION['KCFINDER']['uploadURL'] 	= "";
					$_SESSION['KCFINDER']['uploadDir'] 	= "../../../../img";

					redirect('MainPage');
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Username dan Password tidak cocok !!!
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('ValidationProcess');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('ValidationProcess');
			}
		}
		
		public function logout(){
			$auth = $this->session->userdata('auth');
			$this->ValidationProcess_model->getLogout($auth);

			$this->fungsi->set_log($auth['user_id'], $auth['username'],'1002','Application.ValidationProcess.logout',$auth['username'],'Logout System');
			$this->session->unset_userdata('auth');
			$this->session->sess_destroy();
			redirect('HomePage');
		}
		
		public function warning(){
			$this->load->view('warning');
		}

		public function loginValidateCustomer(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'customerlogin'			=> "",
			);

			$data = array(
				'customer_email'		=> $this->input->post('customer_email',true),
				'customer_password'		=> md5($this->input->post('customer_password',true)),
			);

			/* $data = array(
				'customer_email'		=> "daniel@gmail.com",
				'customer_password'		=> md5("123456"),
			); */


			if (empty($data['customer_email']) || empty($data['customer_password'])){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Email or Password is Empty";
			} else {
				if($response["error"] == FALSE){
					$systemuser = $this->ValidationProcess_model->getSystemUser_Detail($data);

					/* print_r("systemuser ");
					print_r($systemuser);
					print_r("<BR> "); */

					if($systemuser == false){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}else{
						if (empty($systemuser)){
							$response['error'] 				= TRUE;
							$response['error_msg_title'] 	= "No Data";
							$response['error_msg'] 			= "Data Does Not Exist";
						} else {
							$customerlogin[0]['customer_id'] 			= $systemuser['customer_id'];
							$customerlogin[0]['customer_name']			= $systemuser['customer_name'];
							$customerlogin[0]['customer_email']			= $systemuser['customer_email'];
							$customerlogin[0]['customer_mobile_phone']	= $systemuser['customer_mobile_phone'];
							$customerlogin[0]['user_level']				= $systemuser['user_level'];
							$customerlogin[0]['customer_status']		= $systemuser['customer_status'];
							$customerlogin[0]['log_state']				= $systemuser['log_state'];
							$customerlogin[0]['province_id']			= $systemuser['province_id'];
							$customerlogin[0]['city_id']				= $systemuser['city_id'];
							

							/*if ($systemuser['log_state'] == 0){
								$dataupdate = array (
									'customer_id'		=> $systemuser['customer_id'],
									'log_state'			=> 1
								);

								$this->ValidationProcess_model->updateSystemUser_LogState($dataupdate);
							}*/

							$response['error'] 				= FALSE;
							$response['error_msg_title'] 	= "Success";
							$response['error_msg'] 			= "Data Exist";
							$response['customerlogin'] 		= $customerlogin;
						}
					}
				}
			}

			echo json_encode($response);
		}
	}
?>