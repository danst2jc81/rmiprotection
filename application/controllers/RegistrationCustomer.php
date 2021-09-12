<?php
	Class RegistrationCustomer extends CI_Controller{
		public function __construct(){
			parent::__construct();

			
			$this->load->model('RegistrationCustomer_model');
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->database("default");
		}
		
		public function index(){
			
		}

		public function addRegistrationCustomer(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$this->session->unset_userdata('RegistrationCustomerToken-'.$unique['unique']);

			$customer_token	= $this->session->userdata('RegistrationCustomerToken-'.$unique['unique']);

			if(empty($customer_token)){
				$customer_token = md5(date("YmdHis"));
				$this->session->set_userdata('RegistrationCustomerToken-'.$unique['unique'], $customer_token);
			}

			$data['main_view']['coreprovince']	= create_double($this->RegistrationCustomer_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']		= 'RegistrationCustomer/FormAddRegistrationCustomer_view';

			$this->load->view('HomePage_view',$data);
		}

		public function getCoreCity(){
			$province_id 		= $this->input->post('province_id');
			
			$item = $this->RegistrationCustomer_model->getCoreCity($province_id);
			$data = "";
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[city_id]'>$mp[city_name]</option>\n";	
			}
			echo $data;
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRegistrationCustomer-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addRegistrationCustomer-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addRegistrationCustomer-'.$unique['unique']);
			redirect('registrasi');
		}

		public function processAddRegistrationCustomer(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');


			$customer_password 			= $this->input->post('customer_password',true);
			$customer_confirm_password 	= $this->input->post('customer_confirm_password',true);

			$customer_last_date1 					= date_create(date("Y-m-d"));
			date_add($customer_last_date1, date_interval_create_from_date_string("1 month"));
			$customer_last_date						= date_format($customer_last_date1,"Y-m-d");

			$data = array (
				'province_id'						=> $this->input->post('province_id',true),
				'city_id'							=> $this->input->post('city_id',true),
				'package_id'						=> 1,
				'package_price_id'					=> 1,
				'customer_name'						=> $this->input->post('customer_name',true),
				'customer_email'					=> $this->input->post('customer_email',true),
				'customer_mobile_phone'				=> $this->input->post('customer_mobile_phone',true),
				'customer_mobile_phone1'			=> $this->input->post('customer_mobile_phone1',true),
				'customer_unit'						=> $this->input->post('customer_unit',true),
				'customer_registration_date'		=> date("Y-m-d"),
				'customer_status'					=> 1,
				'package_status'					=> 2,
				'customer_last_date'				=> $customer_last_date,
				'customer_package_status'			=> 1,
				'customer_package_date'				=> date("Y-m-d"),
				'customer_package_search_balance'	=> 100,
				'customer_package_add_balance'		=> 100,
				'customer_package_balance_status'	=> 1,
				'customer_contact_person'			=> $this->input->post('customer_contact_person',true),
				'customer_address'					=> $this->input->post('customer_address',true),
				'customer_remark'					=> $this->input->post('customer_remark',true),
				'customer_token'					=> $this->input->post('customer_token',true),
				'customer_password'					=> $this->input->post('customer_password',true),
				'data_state' 						=> 0,
				'created_id' 						=> date("YmdHis"),
				'created_on' 						=> date('Y-m-d H:i:s'),
			);

			/* print_r("data ");
			print_r($data);
			exit; */

			$this->form_validation->set_rules('province_id', 'Provinsi', 'required');
			$this->form_validation->set_rules('city_id', 'Kota', 'required');
			$this->form_validation->set_rules('customer_contact_person', 'Nama', 'required');
			$this->form_validation->set_rules('customer_name', 'Nama Rental', 'required');
			$this->form_validation->set_rules('customer_address', 'Alamat ', 'required');
			$this->form_validation->set_rules('customer_email', 'Email ', 'required');
			$this->form_validation->set_rules('customer_mobile_phone', 'Handphone', 'required');
			
			$customer_token 					= $this->RegistrationCustomer_model->getCustomerToken($data['customer_token']);
			
			if($this->form_validation->run()==true){
				if ($customer_password == $customer_confirm_password){
					if ($customer_token == 0){
						if ($this->RegistrationCustomer_model->getRegistrationCustomer_Email($data['customer_email'])){
							if ($this->RegistrationCustomer_model->getRegistrationCustomer_Phone($data['customer_phone'])){
								if($this->RegistrationCustomer_model->insertSalesCustomer($data)){
									$auth = $this->session->userdata('auth');

									$customer_id = $this->RegistrationCustomer_model->getCustomerID($data['created_id']);
								
									$data_systemuser = array (
										'user_group_id'				=> 2,
										'customer_id'				=> $customer_id,
										'package_id'				=> 1,
										'package_price_id'			=> 1,
										'province_id'				=> $data['province_id'],
										'city_id'					=> $data['city_id'],
										'customer_email'			=> $data['customer_email'],
										'customer_password' 		=> md5($customer_password),
										'customer_name'				=> $data['customer_name'],
										'customer_mobile_phone'		=> $data['customer_mobile_phone'],
										'customer_status'			=> 1,
									);

									if ($this->RegistrationCustomer_model->insertSystemUser($data_systemuser)){

									}
			
									$msg = "<div class='alert alert-success alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
												Data Anggota Berhasil Di Simpan
											</div> ";
									$this->session->unset_userdata('addRegistrationCustomer-'.$unique['unique']);
									$this->session->unset_userdata('RegistrationCustomerToken-'.$unique['unique']);
									$this->session->set_userdata('message',$msg);
									redirect('registrasi');
								}else{
									$this->session->set_userdata('addRegistrationCustomer',$data);
									$msg = "<div class='alert alert-danger alert-dismissable'>
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
												Data Anggota Gagal Di Simpan
											</div> ";
									$this->session->set_userdata('message',$msg);
									redirect('registrasi');
								}
										
							} else {
								$this->session->set_userdata('addRegistrationCustomer',$data);
								$msg = "<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
											Handphone Anggota Sudah Ada
										</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('registrasi');
							}
						} else {
							$this->session->set_userdata('addRegistrationCustomer',$data);
							$msg = "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Email Anggota Sudah Ada
									</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('registrasi');
						}
					} else {
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Data Anggota Sudah Ada
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('registrasi');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Password Anggota Tidak Sama
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('registrasi');
				}
			}else{
				$this->session->set_userdata('addRegistrationCustomer',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('registrasi');
			}
		}

	}
?>