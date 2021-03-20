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

			$data = array (
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
					$registrationtenant = $this->RegistrationTenant_model->getRegistrationTenant_DetailNIK($data['tenant_nik']);

					if (empty($registrationtenant)){
						if($this->RegistrationTenant_model->insertRegistrationTenant($data)){
							$vendor_id 		= $data['vendor_id'];
							$tenant_status 	= 0;
							$tenant_id 		= $this->RegistrationTenant_model->getTenantID($data['tenant_token']);
	
							$this->fungsi->set_log($auth['user_id'], $tenant_id, '2141', 'RegistrationTenant.processAddRegistrationTenant', 'Add New Registration Tenant');
	
							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Data Penyewa Berhasil Di Simpan
									</div> ";
							$this->session->unset_userdata('addRegistrationTenant-'.$unique['unique']);
							$this->session->unset_userdata('RegistrationTenantToken-'.$unique['unique']);
							$this->session->set_userdata('message',$msg);
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
						$tenant_status 	= $registrationtenant['tenant_status'];
						$tenant_id 		= $registrationtenant['tenant_id'];
						$vendor_id 		= $registrationtenant['vendor_id'];	
					}

					$data_rental = array(
						'vendor_id'				=> $vendor_id,
						'tenant_id'				=> $tenant_id,
						'vehicle_rental_date'	=> date("Y-m-d"),
						'vehicle_rental_token'	=> $data['tenant_token'].$tenant_id,
						'created_id'			=> $tenant_id,
						'created_on'			=> date("Y-m-d H:i:s"),
					);

					$vehicle_rental_token 		= $this->RegistrationTenant_model->getVehicleRentalToken($data_rental['vehicle_rental_token']);

					if ($vehicle_rental_token == 0){
						if ($this->RegistrationTenant_model->insertTransVehicleRental($data_rental)){
							$vehicle_rental_id = $this->RegistrationTenant_model->getVehicleRentalID($data_rental['tenant_id']);

							redirect('registrasi/notif/'.$tenant_status.'/'.$tenant_id.'/'.$vendor_id.'/'.$vehicle_rental_id);
						}
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

		public function sendRegistrationTenantNotification(){
			$tenant_status 		= $this->uri->segment(3);
			$tenant_id 			= $this->uri->segment(4);
			$vendor_id 			= $this->uri->segment(5);
			$vehicle_rental_id	= $this->uri->segment(6);

			$registrationtenant = $this->RegistrationTenant_model->getRegistrationTenant_Detail($tenant_id);
			$tenantstatus 		= $this->configuration->TenantStatus();

			$tenant_status		= $registrationtenant['tenant_status'];
			$tenant_status_name	= $tenantstatus[$tenant_status];

			$system_user 		= $this->RegistrationTenant_model->getSystemUser($vendor_id);

			if (!empty($system_user)){
				foreach ($system_user as $keyUser => $valUser) {
					$token 		= $valUser['user_token'];
					$message 	= 'Ada Penyewa Baru Atas Nama '.$registrationtenant['tenant_name'].' Handphone '.$registrationtenant['tenant_mobile_phone'].' No KTP '.$registrationtenant['tenant_nik'].' Dengan Status '.$tenant_status_name;

					if (!empty($token)){
						$res = array();
						$res['body'] = $message;

						$data['tenant_id'] = array(
							'tenant_id'			=> $tenant_id,
							'tenant_status'		=> $tenant_status,
							'vehicle_rental_id'	=> $vehicle_rental_id,
						);

						
						$fields = array(
							'to' => $token,
							'notification' => $res,
							'data' => $data,
						);

						$url 		= 'https://fcm.googleapis.com/fcm/send';
						$server_key = "AAAALRBPTYE:APA91bFVxYuldBENrPeIDk-XTEdTz03unSUUxZj6p4LdIdLS4GIXdULe_xGQhsY-zMKuWcjz6jFGV1399OTzL5o-pGIjspBz0aSFqVJOh4IhUO9nMBUyBoPsYg80ObY_i_oCrDI8msY1";
						
						$headers = array(
							'Authorization: key=' . $server_key,
							'Content-Type: application/json'
						);
						// Open connection
						$ch = curl_init();
					
						// Set the url, number of POST vars, POST data
						curl_setopt($ch, CURLOPT_URL, $url);
					
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					
						// Disabling SSL Certificate support temporarly
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
					
						// Execute post
						$result = curl_exec($ch);
						if ($result === FALSE) {
							echo 'Curl failed: ' . curl_error($ch);
						}
					
						// Close connection
						curl_close($ch);
					}
				}
				

				redirect('registrasi/baru/'.$vendor_id);
			}
		}
	}
?>