<?php
	Class RegistrationTenant extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('RegistrationTenant_model');
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->database("default");
		}
		
		public function index(){
			
		}

		public function addRegistrationTenant(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');
			$vendor_id 		= $this->uri->segment(3);

			$this->session->unset_userdata('RegistrationTenantToken-'.$unique['unique']);

			$tenant_token	= $this->session->userdata('RegistrationTenantToken-'.$unique['unique']);

			if(empty($tenant_token)){
				$tenant_token = md5(rand());
				$this->session->set_userdata('RegistrationTenantToken-'.$unique['unique'], $tenant_token);
			}

			$data['main_view']['corevendor']		= $this->RegistrationTenant_model->getCoreVendor_Detail($vendor_id);	

			$data['main_view']['content']			= 'RegistrationTenant/FormAddRegistrationTenant_view';

			$this->load->view('HomePage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addRegistrationTenant-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addRegistrationTenant-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addRegistrationTenant-'.$unique['unique']);
			redirect('registrasi/baru'.$vendor_id);
		}

		public function processAddRegistrationTenant(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'region_id'					=> $this->input->post('region_id',true),
				'branch_id'					=> $this->input->post('branch_id',true),
				'vendor_id'					=> $this->input->post('vendor_id',true),
				'province_id'				=> $this->input->post('province_id',true),
				'city_id'					=> $this->input->post('city_id',true),
				'tenant_name'				=> $this->input->post('tenant_name',true),
				'tenant_address'			=> $this->input->post('tenant_address',true),
				'tenant_nik'				=> $this->input->post('tenant_nik',true),
				'tenant_mobile_phone'		=> $this->input->post('tenant_mobile_phone',true),
				'tenant_token'				=> $this->input->post('tenant_token',true),
				'data_state'				=> 0,
				'created_id'				=> $this->input->post('vendor_id',true),
				'created_on' 				=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('tenant_name', 'Nama Penyewa', 'required');
			$this->form_validation->set_rules('tenant_address', 'Alamat Penyewa', 'required');
			$this->form_validation->set_rules('tenant_nik', 'NIK Penyewa', 'required');
			$this->form_validation->set_rules('tenant_mobile_phone', 'Handphone Penyewa', 'required');


			$tenant_token 					= $this->RegistrationTenant_model->getTenantToken($data['tenant_token']);
			
			if($this->form_validation->run()==true){
				if ($tenant_token == 0){
					if($this->RegistrationTenant_model->insertRegistrationTenant($data)){
						$auth = $this->session->userdata('auth');

						$tenant_id = $this->RegistrationTenant_model->getTenantID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $tenant_id, '2141', 'RegistrationTenant.processAddRegistrationTenant', 'Add New Registration Tenant');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Data Penyewa Berhasil Di Simpan
								</div> ";
						$this->session->unset_userdata('addRegistrationTenant-'.$unique['unique']);
						$this->session->unset_userdata('RegistrationTenantToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('registrasi/baru/'.$data['vendor_id']);
					}else{
						$this->session->set_userdata('addRegistrationTenant',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Data Penyewa Gagal Di Simpan
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('registrasi/baru/'.$data['vendor_id']);
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Penyewa Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('registrasi/baru/'.$data['vendor_id']);
				}
			}else{
				$this->session->set_userdata('addRegistrationTenant',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('registrasi/baru/'.$data['vendor_id']);
			}
		}
	}
?>