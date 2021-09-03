<?php
	Class AndroidRMIProtection extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('AndroidRMIProtection_model');
			$this->load->library('configuration');
			$this->load->helper('sistem');
			$this->load->database("default");
			$this->load->helper('url');
		}
		
		public function getRegistrationTenant(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'registrationtenant'			=> "",
			);

			$data = array(
				'region_id'			=> $this->input->post('region_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
				'vendor_id'			=> $this->input->post('vendor_id',true),
				'tenant_status'		=> $this->input->post('tenant_status',true),
			);

			if($response["error"] == FALSE){
				$registrationtenantlist 	= $this->AndroidRMIProtection_model->getRegistrationTenant($data['region_id'], $data['branch_id'], $data['vendor_id'], $data['tenant_status']);

				if(!$registrationtenantlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($registrationtenantlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($registrationtenantlist)){
							foreach ($registrationtenantlist as $key => $val) {
								$tenantstatus 		= $this->configuration->TenantStatus();
								$tenant_status_name = $tenantstatus[$val['tenant_status']];

								$registrationtenant[$key]['tenant_id'] 					= $val['tenant_id'];
								$registrationtenant[$key]['region_id'] 					= $val['region_id'];
								$registrationtenant[$key]['region_name'] 				= $val['region_name'];
								$registrationtenant[$key]['branch_id'] 					= $val['branch_id'];
								$registrationtenant[$key]['branch_name'] 				= $val['branch_name'];
								$registrationtenant[$key]['province_id'] 				= $val['province_id'];
								$registrationtenant[$key]['province_name'] 				= $val['province_name'];
								$registrationtenant[$key]['city_id'] 					= $val['city_id'];
								$registrationtenant[$key]['city_name'] 					= $val['city_name'];
								$registrationtenant[$key]['tenant_name'] 				= $val['tenant_name'];
								$registrationtenant[$key]['tenant_registration_date'] 	= $val['tenant_registration_date'];
								$registrationtenant[$key]['tenant_address'] 			= $val['tenant_address'];
								$registrationtenant[$key]['tenant_mobile_phone'] 		= $val['tenant_mobile_phone'];
								$registrationtenant[$key]['tenant_nik'] 				= $val['tenant_nik'];
								$registrationtenant[$key]['tenant_profile_photo'] 		= $val['tenant_profile_photo'];
								$registrationtenant[$key]['tenant_nik_photo'] 			= $val['tenant_nik_photo'];
								$registrationtenant[$key]['tenant_status_name'] 		= $tenant_status_name;
								$registrationtenant[$key]['tenant_status_id'] 			= $val['tenant_status_id'];
								$registrationtenant[$key]['tenant_status_on'] 			= $val['tenant_status_on'];
								$registrationtenant[$key]['tenant_status_remark'] 		= $val['tenant_status_remark'];
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['registrationtenant'] 			= $registrationtenant;
					}
				}
			}
			echo json_encode($response);
		}

		public function getCoreVehicle(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'corevehicle'			=> "",
			);

			$data = array(
				'vendor_id'			=> $this->input->post('vendor_id',true),
			);

			if($response["error"] == FALSE){
				$corevehiclelist = $this->AndroidRMIProtection_model->getCoreVehicle($data['vendor_id']);

				if(!$corevehiclelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($corevehiclelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($corevehiclelist as $key => $val) {
							$corevehicle[$key]['vehicle_id']				= $val['vehicle_id'];
							$corevehicle[$key]['vehicle_police_number'] 	= $val['vehicle_police_number'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['corevehicle'] 			= $corevehicle;
					}
				}
			}
			echo json_encode($response);
		}

		public function getTransVehicleRental_DetailUpdate(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'transvehiclerentaldetail'		=> "",
			);

			$data = array(
				'vendor_id'			=> $this->input->post('vendor_id',true),
				'vehicle_rental_id'	=> $this->input->post('vehicle_rental_id',true),
			);


			if($response["error"] == FALSE){
				$transvehiclerentallist 	= $this->AndroidRMIProtection_model->getTransVehicleRental_DetailUpdate($data['vehicle_rental_id']);

				if(!$transvehiclerentallist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($transvehiclerentallist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($transvehiclerentallist)){
							$tenantstatus 		= $this->configuration->TenantStatus();
							$tenant_status_name = $tenantstatus[$transvehiclerentallist['tenant_status']];

							$transvehiclerentaldetail[0]['vehicle_rental_id'] 				= $transvehiclerentallist['vehicle_rental_id'];
							$transvehiclerentaldetail[0]['tenant_id'] 						= $transvehiclerentallist['tenant_id'];
							$transvehiclerentaldetail[0]['tenant_name'] 					= $transvehiclerentallist['tenant_name'];
							$transvehiclerentaldetail[0]['tenant_mobile_phone'] 			= $transvehiclerentallist['tenant_mobile_phone'];
							$transvehiclerentaldetail[0]['tenant_address'] 					= $transvehiclerentallist['tenant_address'];
							$transvehiclerentaldetail[0]['tenant_nik'] 						= $transvehiclerentallist['tenant_nik'];
							$transvehiclerentaldetail[0]['tenant_status_name']				= $tenant_status_name;
							$transvehiclerentaldetail[0]['vehicle_rental_date'] 			= tgltoview($transvehiclerentallist['vehicle_rental_date']);
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['transvehiclerentaldetail'] 		= $transvehiclerentaldetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function processUpdateTransVehicleRental(){
					
			$data = array (
				'vehicle_rental_id'				=> $this->input->post('vehicle_rental_id',true),
				'vendor_id'						=> $this->input->post('vendor_id',true),
				'vehicle_id'					=> $this->input->post('vehicle_id',true),
				'tenant_id'						=> $this->input->post('tenant_id',true),
				'vehicle_rental_return_date'	=> tgltodb($this->input->post('vehicle_rental_return_date',true)),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg_title'			=> "",
				'error_msg'					=> "",
			);
			
			if($response["error"] == FALSE){
				if ($this->AndroidRMIProtection_model->updateTransVehicleRental($data)){
					
				}

				$response['error']		 					= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}

		public function getTransVehicleRental(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'transvehiclerental'			=> "",
			);

			$data = array(
				'vendor_id'			=> $this->input->post('vendor_id',true),
			);

			if($response["error"] == FALSE){
				$transvehiclerentallist 	= $this->AndroidRMIProtection_model->getTransVehicleRental($data['vendor_id']);

				if(!$transvehiclerentallist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($transvehiclerentallist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($transvehiclerentallist)){
							foreach ($transvehiclerentallist as $key => $val) {
								$tenantstatus 		= $this->configuration->TenantStatus();
								$tenant_status_name = $tenantstatus[$val['tenant_status']];

								$transvehiclerental[$key]['vehicle_rental_id'] 				= $val['vehicle_rental_id'];
								$transvehiclerental[$key]['vehicle_id'] 					= $val['vehicle_id'];
								$transvehiclerental[$key]['vehicle_police_number'] 			= $val['vehicle_police_number'];
								$transvehiclerental[$key]['tenant_id'] 						= $val['tenant_id'];
								$transvehiclerental[$key]['tenant_name'] 					= $val['tenant_name'];
								$transvehiclerental[$key]['tenant_mobile_phone'] 			= $val['tenant_mobile_phone'];
								$transvehiclerental[$key]['tenant_address'] 				= $val['tenant_address'];
								$transvehiclerental[$key]['tenant_nik'] 					= $val['tenant_nik'];
								$transvehiclerental[$key]['tenant_status_name']				= $tenant_status_name;
								$transvehiclerental[$key]['vehicle_rental_date'] 			= tgltoview($val['vehicle_rental_date']);
								$transvehiclerental[$key]['vehicle_rental_return_date'] 	= tgltoview($val['vehicle_rental_return_date']);
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['transvehiclerental'] 			= $transvehiclerental;
					}
				}
			}
			echo json_encode($response);
		}

		public function processUpdateRegistrationTenant(){
			$vehicle_rental_date 		= date("Y-m-d");
			$vehicle_rental_return_date	= date("Y-m-d");

			$data = array (
				'vendor_id'						=> $this->input->post('vendor_id',true),
				'tenant_id'						=> $this->input->post('tenant_id',true),
				'tenant_status'					=> 9,
				'tenant_status_id'				=> $this->input->post('vendor_id',true),
				'tenant_status_on'				=> date("Y-m-d H:i:s"),
				'tenant_status_remark'			=> $this->input->post('tenant_status_remark',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg_title'			=> "",
				'error_msg'					=> "",
			);
			
			if($response["error"] == FALSE){
				if ($this->AndroidRMIProtection_model->updateRegistrationTenant($data)){
					redirect('AndroidRMIProtection/sendRegistrationTenantNotification/'.$data['tenant_status'].'/'.$data['tenant_id'].'/'.$data['vendor_id']);
				}

				$response['error']		 					= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}

		public function processUpdateSystemUserToken(){

			$data = array(
				'customer_id'						=> $this->input->post('customer_id',true),
				'customer_token'					=> $this->input->post('customer_token',true),
			);
		
			$response = array(
				'error'				=> FALSE,
				'error_msg_title'	=> "",
				'error_msg'			=> "",
			);

			if($response["error"] == FALSE){
				if(!empty($data)){
					
					if ($this->AndroidRMIProtection_model->updateSystemUser($data)){
						$response['error'] 				= FALSE;
						$response['error_msg_title'] 	= "Update Data Token User";
						$response['error_msg'] 			= "Update Data Token User Berhasil";			
					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "Update Data Token User";
						$response['error_msg'] 			= "Update Data Token User Gagal";
					}
				}

			} 
			
			echo json_encode($response);
		}

		public function getRegistrationTenantDetail(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'registrationtenantdetail'		=> "",
			);

			$data = array(
				'tenant_id'			=> $this->input->post('tenant_id',true),
			);

			if($response["error"] == FALSE){
				$registrationtenantdetaillist 	= $this->AndroidRMIProtection_model->getRegistrationTenant_Detail($data['tenant_id']);

				if(!$registrationtenantdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($registrationtenantdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($registrationtenantdetaillist)){
							$tenantstatus 		= $this->configuration->TenantStatus();
							$tenant_status_name = $tenantstatus[$registrationtenantdetaillist['tenant_status']];

							$registrationtenantdetail[0]['tenant_id'] 					= $registrationtenantdetaillist['tenant_id'];
							$registrationtenantdetail[0]['region_id'] 					= $registrationtenantdetaillist['region_id'];
							$registrationtenantdetail[0]['region_name'] 				= $registrationtenantdetaillist['region_name'];
							$registrationtenantdetail[0]['branch_id'] 					= $registrationtenantdetaillist['branch_id'];
							$registrationtenantdetail[0]['branch_name'] 				= $registrationtenantdetaillist['branch_name'];
							$registrationtenantdetail[0]['vendor_id'] 					= $registrationtenantdetaillist['vendor_id'];
							$registrationtenantdetail[0]['vendor_name'] 				= $registrationtenantdetaillist['vendor_name'];
							$registrationtenantdetail[0]['province_id'] 				= $registrationtenantdetaillist['province_id'];
							$registrationtenantdetail[0]['province_name'] 				= $registrationtenantdetaillist['province_name'];
							$registrationtenantdetail[0]['city_id'] 					= $registrationtenantdetaillist['city_id'];
							$registrationtenantdetail[0]['city_name'] 					= $registrationtenantdetaillist['city_name'];
							$registrationtenantdetail[0]['tenant_name'] 				= $registrationtenantdetaillist['tenant_name'];
							$registrationtenantdetail[0]['tenant_registration_date'] 	= $registrationtenantdetaillist['tenant_registration_date'];
							$registrationtenantdetail[0]['tenant_address'] 				= $registrationtenantdetaillist['tenant_address'];
							$registrationtenantdetail[0]['tenant_mobile_phone'] 		= $registrationtenantdetaillist['tenant_mobile_phone'];
							$registrationtenantdetail[0]['tenant_nik'] 					= $registrationtenantdetaillist['tenant_nik'];
							$registrationtenantdetail[0]['tenant_profile_photo'] 		= $registrationtenantdetaillist['tenant_profile_photo'];
							$registrationtenantdetail[0]['tenant_nik_photo'] 			= $registrationtenantdetaillist['tenant_nik_photo'];
							$registrationtenantdetail[0]['tenant_status_name'] 			= $tenant_status_name;
							$registrationtenantdetail[0]['tenant_status_id'] 			= $registrationtenantdetaillist['tenant_status_id'];
							$registrationtenantdetail[0]['tenant_status_on'] 			= $registrationtenantdetaillist['tenant_status_on'];
							$registrationtenantdetail[0]['tenant_status_remark'] 		= $registrationtenantdetaillist['tenant_status_remark'];
							
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['registrationtenantdetail'] 		= $registrationtenantdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function sendRegistrationTenantNotification(){
			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
			);

			$tenant_status 		= $this->uri->segment(3);
			$tenant_id 			= $this->uri->segment(4);
			$vendor_id 			= $this->uri->segment(5);

			$registrationtenant = $this->AndroidRMIProtection_model->getRegistrationTenant_Detail($tenant_id);
			$tenantstatus 		= $this->configuration->TenantStatus();

			$tenant_status		= $registrationtenant['tenant_status'];
			$tenant_status_name	= $tenantstatus[$tenant_status];

			$system_user 		= $this->AndroidRMIProtection_model->getSystemUser();

			if (!empty($system_user)){
				foreach ($system_user as $keyUser => $valUser) {
					$token 		= $valUser['user_token'];
					$message 	= 'BLACKLIST Penyewa Atas Nama '.$registrationtenant['tenant_name'].' Handphone '.$registrationtenant['tenant_mobile_phone'].' No KTP '.$registrationtenant['tenant_nik'];

					if (!empty($token)){
						$res = array();
						$res['body'] = $message;

						$data['tenant_id'] = array(
							'tenant_id'			=> $tenant_id,
							'tenant_status'		=> $tenant_status,
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
				
				echo json_encode($response);	
				
			}
		}

		public function getTransVehicleRental_Update(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'transvehiclerentalupdate'		=> "",
			);

			$data = array(
				'vendor_id'			=> $this->input->post('vendor_id',true),
			);

			if($response["error"] == FALSE){
				$transvehiclerentallist 	= $this->AndroidRMIProtection_model->getTransVehicleRental_Update($data['vendor_id']);

				if(!$transvehiclerentallist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($transvehiclerentallist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($transvehiclerentallist)){
							foreach ($transvehiclerentallist as $key => $val) {
								$tenantstatus 		= $this->configuration->TenantStatus();
								$tenant_status_name = $tenantstatus[$val['tenant_status']];

								$transvehiclerentalupdate[$key]['vehicle_rental_id'] 			= $val['vehicle_rental_id'];
								$transvehiclerentalupdate[$key]['vehicle_id'] 					= 0;
								$transvehiclerentalupdate[$key]['vehicle_police_number'] 		= "Belum Ada Motor";
								$transvehiclerentalupdate[$key]['tenant_id'] 					= $val['tenant_id'];
								$transvehiclerentalupdate[$key]['tenant_name'] 					= $val['tenant_name'];
								$transvehiclerentalupdate[$key]['tenant_mobile_phone'] 			= $val['tenant_mobile_phone'];
								$transvehiclerentalupdate[$key]['tenant_address'] 				= $val['tenant_address'];
								$transvehiclerentalupdate[$key]['tenant_nik'] 					= $val['tenant_nik'];
								$transvehiclerentalupdate[$key]['tenant_status_name'] 			= $tenant_status_name;
								$transvehiclerentalupdate[$key]['vehicle_rental_date'] 			= tgltoview($val['vehicle_rental_date']);
								$transvehiclerentalupdate[$key]['vehicle_rental_return_date'] 	= tgltoview($val['vehicle_rental_return_date']);
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['transvehiclerentalupdate'] 		= $transvehiclerentalupdate;
					}
				}
			}
			echo json_encode($response);
		}


		public function getDataPerpetrator2(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetrator'				=> "",
			);

			$data = array(
				'region_id'			=> $this->input->post('region_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
				'vendor_id'			=> $this->input->post('vendor_id',true),
			);

			$perpetratorstatus 		= $this->configuration->PerpetratorStatus();

			if($response["error"] == FALSE){
				$dataperpetratorlist 	= $this->AndroidRMIProtection_model->getDataPerpetrator();

				if(!$dataperpetratorlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($dataperpetratorlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($dataperpetratorlist)){
							foreach ($dataperpetratorlist as $key => $val) {
								$dataperpetratorchronology 	= $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Perpetrator($val['perpetrator_id']);

								$dataperpetratorphoto 		= $this->AndroidRMIProtection_model->getDataPerpetratorPhoto_Perpetrator($val['perpetrator_id']);

								$perpetrator_status_name	= $perpetratorstatus[$val['perpetrator_status']];
								
								$dataperpetrator[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$dataperpetrator[$key]['region_id'] 							= $val['region_id'];
								$dataperpetrator[$key]['region_name'] 							= $val['region_name'];
								$dataperpetrator[$key]['branch_id'] 							= $val['branch_id'];
								$dataperpetrator[$key]['branch_name'] 							= $val['branch_name'];
								$dataperpetrator[$key]['vendor_id'] 							= $val['vendor_id'];
								$dataperpetrator[$key]['vendor_name'] 							= $val['vendor_name'];
								$dataperpetrator[$key]['vendor_contact_person'] 				= $val['vendor_contact_person'];
								$dataperpetrator[$key]['vendor_phone'] 							= $val['vendor_phone'];
								$dataperpetrator[$key]['province_id'] 							= $val['province_id'];
								$dataperpetrator[$key]['province_name'] 						= $val['province_name'];
								$dataperpetrator[$key]['city_id'] 								= $val['city_id'];
								$dataperpetrator[$key]['city_name'] 							= $val['city_name'];
								$dataperpetrator[$key]['perpetrator_name'] 						= $val['perpetrator_name'];
								$dataperpetrator[$key]['perpetrator_address'] 					= $val['perpetrator_address'];
								$dataperpetrator[$key]['perpetrator_mobile_phone'] 				= $val['perpetrator_mobile_phone'];
								$dataperpetrator[$key]['perpetrator_id_number'] 				= $val['perpetrator_id_number'];
								$dataperpetrator[$key]['perpetrator_age'] 						= $val['perpetrator_age'];
								$dataperpetrator[$key]['perpetrator_status_name'] 				= $perpetrator_status_name;
								$dataperpetrator[$key]['perpetrator_chronology_id'] 			= $dataperpetratorchronology['perpetrator_chronology_id'];
								$dataperpetrator[$key]['province_name_chronology'] 				= $dataperpetratorchronology['province_name'];
								$dataperpetrator[$key]['city_name_chronology'] 					= $dataperpetratorchronology['city_name'];
								$dataperpetrator[$key]['vendor_name_chronology'] 				= $dataperpetratorchronology['vendor_name'];
								$dataperpetrator[$key]['perpetrator_chronology_date'] 			= $dataperpetratorchronology['perpetrator_chronology_date'];
								$dataperpetrator[$key]['perpetrator_chronology_description'] 	= $dataperpetratorchronology['perpetrator_chronology_description'];
								$dataperpetrator[$key]['perpetrator_chronology_created'] 		= $dataperpetratorchronology['created_on'];
								$dataperpetrator[$key]['perpetrator_photo_url'] 				= $base_url.'img/'.$dataperpetratorphoto['perpetrator_photo_path'].'/'.$dataperpetratorphoto['perpetrator_photo_name'];
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['dataperpetrator'] 				= $dataperpetrator;
					}
				}
			}
			echo json_encode($response);
		}

		public function getCoreProvince(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'coreprovince'			=> "",
			);

			if($response["error"] == FALSE){
				$coreprovincelist = $this->AndroidRMIProtection_model->getCoreProvince();

				if(!$coreprovincelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($coreprovincelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($coreprovincelist as $key => $val) {
							$coreprovince[$key]['province_id']		= $val['province_id'];
							$coreprovince[$key]['province_name'] 	= $val['province_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['coreprovince'] 			= $coreprovince;
					}
				}
			}
			echo json_encode($response);
		}


		public function getCoreCity(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'corecity'				=> "",
			);

			$data = array(
				'province_id'			=> $this->input->post('province_id',true),
			);

			if($response["error"] == FALSE){
				$corecitylist = $this->AndroidRMIProtection_model->getCoreCity($data['province_id']);

				if(!$corecitylist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($corecitylist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($corecitylist as $key => $val) {
							$corecity[$key]['province_id']		= $val['province_id'];
							$corecity[$key]['province_name'] 	= $val['province_name'];
							$corecity[$key]['city_id']			= $val['city_id'];
							$corecity[$key]['city_name'] 		= $val['city_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['corecity'] 				= $corecity;
					}
				}
			}
			echo json_encode($response);
		}

		public function processAddDataPerpetrator(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'dataperpetrator'		=> "",
			);

			$perpetrator_chronology_description	= $this->input->post('perpetrator_chronology_description',true);
			$vendor_id							= $this->input->post('vendor_id',true);
			
			$data = array(
				'customer_id'					=> $this->input->post('customer_id',true),
				'province_id'					=> $this->input->post('province_id',true),
				'city_id'						=> $this->input->post('city_id',true),
				'province_id_perpetrator'		=> $this->input->post('province_id_perpetrator',true),
				'city_id_perpetrator'			=> $this->input->post('city_id_perpetrator',true),
				'gender_id'						=> $this->input->post('gender_id',true),
				'perpetrator_name'				=> $this->input->post('perpetrator_name',true),
				'perpetrator_mobile_phone'		=> $this->input->post('perpetrator_mobile_phone',true),
				'perpetrator_id_number'			=> $this->input->post('perpetrator_id_number',true),
				'perpetrator_date_of_birth' 	=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_address'			=> $this->input->post('perpetrator_address',true),
				'perpetrator_status'			=> $this->input->post('perpetrator_status',true),
				'data_state' 					=> 0,
				'created_id' 					=> $this->input->post('user_id',true),
				'created_on' 					=> date('Y-m-d H:i:s'),
			);

			/* $data = array(
				'customer_id'					=> 12,
				'province_id'					=> 1,
				'city_id'						=> 218,
				'province_id_perpetrator'		=> 1,
				'city_id_perpetrator'			=> 218,
				'gender_id'						=> $this->input->post('gender_id',true),
				'perpetrator_name'				=> $this->input->post('perpetrator_name',true),
				'perpetrator_mobile_phone'		=> $this->input->post('perpetrator_mobile_phone',true),
				'perpetrator_id_number'			=> $this->input->post('perpetrator_id_number',true),
				'perpetrator_date_of_birth' 	=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_address'			=> $this->input->post('perpetrator_address',true),
				'data_state' 					=> 0,
				'created_id' 					=> $this->input->post('user_id',true),
				'created_on' 					=> date('Y-m-d H:i:s'),
			); */

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Jemaat is Empty";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->insertDataPerpetrator($data)){
						$perpetrator_id = $this->AndroidRMIProtection_model->getPerpetratorID($data['created_id']);

						$data_perpetratorchronology = array (
							'perpetrator_id'						=> $perpetrator_id,
							'province_id'							=> $data['province_id'],
							'city_id'								=> $data['city_id'],
							'customer_id'							=> $data['customer_id'],
							'perpetrator_status'					=> $data['perpetrator_status'],
							'perpetrator_chronology_description' 	=> $perpetrator_chronology_description,
							'perpetrator_chronology_date'			=> date("Y-m-d"),
							'data_state'							=> 0,
							'created_id'							=> $data['created_id'],
							'created_on'							=> date("Y-m-d H:i:s")
						);

						if ($this->AndroidRMIProtection_model->insertDataPerpetratorChronology($data_perpetratorchronology)){
							$customer_package_opening_balance 	= $this->AndroidRMIProtection_model->getCustomerPackageAddBalance($data['customer_id']);

							$customer_package_last_balance		= $customer_package_opening_balance - 1;
							
							$data_customerpackage = array(
								'customer_id'									=> $data['customer_id'],
								'package_id'									=> $data['package_id'],
								'package_price_id'								=> $data['package_price_id'],
								'customer_package_history_status'				=> 1,
								'customer_package_history_date'					=> date("Y-m-d"),
								'customer_package_history_opening_balance'		=> $customer_package_opening_balance,
								'customer_package_history_last_balance'			=> $customer_package_last_balance,
							);

							if ($this->AndroidRMIProtection_model->insertSalesCustomerPackageHistory($data_customerpackage)){
								$data_updatecustomer = array(
									'customer_id'								=> $data['customer_id'],
									'customer_package_add_balance'				=> $customer_package_last_balance
								);

								if ($this->AndroidRMIProtection_model->updateSalesCustomer($data_updatecustomer)){

								}
							}
						}

						$dataperpetrator[0]['perpetrator_id']				= $perpetrator_id;

						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['dataperpetrator'] 		= $dataperpetrator;

					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}
				}
			}

			echo json_encode($response);
		}

		public function processUploadDataPerpetratorPhoto(){
			$base_url = base_url();
			
			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetratorphoto'			=> "",
			);

			$data = array(
				'perpetrator_id'				=> $this->input->post('perpetrator_id',true),
				'vendor_id'						=> $this->input->post('vendor_id',true),
			);

			$vendor_code 						= $this->AndroidRMIProtection_model->getVendorCode($data['vendor_id']);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Photo is Empty";
			} else {
				if($response["error"] == FALSE){
					$dataperpetratorphoto		= json_decode($this->input->post('data_perpetrator_photo',true),true);
						
					$no = 1;
					if(!empty($dataperpetratorphoto)){
						foreach($dataperpetratorphoto as $keyPhoto => $valPhoto){	
							$decodedData 			= base64_decode($valPhoto['perpetrator_photo_image']);

							$perpetrator_photo_name	= 'perpetrator_photo_'.date("YmdHis").'_'.$no.'.jpg';

							file_put_contents(APPPATH .'../img/V333372001/'.$perpetrator_photo_name, $decodedData);

							$data_photo = array(
								'perpetrator_id'			=> $data['perpetrator_id'],
								'perpetrator_photo_path'	=> 'V333372001',
								'perpetrator_photo_name'	=> $perpetrator_photo_name,
								'created_on'				=> date("Y-m-d H:i:s"),
							);

							$this->AndroidRMIProtection_model->insertDataPerpetratorPhoto($data_photo);

							$no++;
						}
					}

					$response['error'] 					= FALSE;
					$response['error_msg_title'] 		= "Success";
					$response['error_msg'] 				= "Data Exist";
				}
			}

			echo json_encode($response);
		}

		/*DATA PERPETRATOR PHOTO*/
		public function getDataPerpetratorPhoto(){
			$base_url = base_url();

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'dataperpetratorphoto'		=> "",
			);

			$data = array(
				'perpetrator_id'				=> $this->input->post('perpetrator_id',true),
			);

			
			if($response["error"] == FALSE){
				$dataperpetratorphotolist = $this->AndroidRMIProtection_model->getDataPerpetratorPhoto_Detail($data['perpetrator_id']);


				if(!$dataperpetratorphotolist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($dataperpetratorphotolist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($dataperpetratorphotolist as $key => $val) {
							$dataperpetratorphoto[$key]['perpetrator_photo_name'] 		= $val['perpetrator_photo_name'];
							$dataperpetratorphoto[$key]['perpetrator_photo_name_url']	= $base_url.'img/'.$val['perpetrator_photo_path'].'/'.$val['perpetrator_photo_name'];
						}
						
						/*print_r("salespromotion ");
						print_r($salespromotion);*/
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['dataperpetratorphoto'] 	= $dataperpetratorphoto;
					}
				}
			}
			

			echo json_encode($response);
		}


		/*DATA PERPETRATOR CHRONOLOGY*/
		public function getDataPerpetratorChronology(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetratorchronology'		=> "",
			);

			$data = array(
				'perpetrator_id'				=> $this->input->post('perpetrator_id',true),
			);

			
			if($response["error"] == FALSE){
				$dataperpetratorchronologylist 	= $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Detail($data['perpetrator_id']);

				$perpetratorstatus 				= $this->configuration->PerpetratorStatus();

				if(!$dataperpetratorchronologylist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($dataperpetratorchronologylist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($dataperpetratorchronologylist as $key => $val) {


							$dataperpetratorchronology[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
							$dataperpetratorchronology[$key]['perpetrator_status']					= $val['perpetrator_status'];
							$dataperpetratorchronology[$key]['perpetrator_status_name']				= $perpetratorstatus[$val['perpetrator_status']];
							$dataperpetratorchronology[$key]['perpetrator_chronology_id'] 			= $val['perpetrator_chronology_id'];
							$dataperpetratorchronology[$key]['perpetrator_chronology_description']	= $val['perpetrator_chronology_description'];
							$dataperpetratorchronology[$key]['created_on']							= simpledatetime($val['created_on']);
							$dataperpetratorchronology[$key]['created_name']						= $val['customer_name'];
						}
						
						/*print_r("salespromotion ");
						print_r($salespromotion);*/
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['dataperpetratorchronology'] 	= $dataperpetratorchronology;
					}
				}
			}
			

			echo json_encode($response);
		}

		public function processAddDataPerpetratorChronology(){
			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetratorchronology'		=> "",
			);

			$customer_id						= $this->input->post('customer_id',true);

			$salescustomer 						= $this->AndroidRMIProtection_model->getSalesCustomer_Detail($customer_id);
			
			$data = array(
				'perpetrator_id'						=> $this->input->post('perpetrator_id',true),
				'customer_id'							=> $this->input->post('customer_id',true),
				'province_id'							=> $salescustomer['province_id'],
				'city_id'								=> $salescustomer['city_id'],
				'perpetrator_chronology_description'	=> $this->input->post('perpetrator_chronology_description',true),
				'perpetrator_chronology_date'			=> date("Y-m-d"),
				'perpetrator_status'					=> $this->input->post('perpetrator_status',true),
				'data_state' 							=> 0,
				'created_id' 							=> $this->input->post('user_id',true),
				'created_on' 							=> date('Y-m-d H:i:s'),
			);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Kronologi Kosong";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->insertDataPerpetratorChronology($data)){
						$data_update = array(
							'perpetrator_id'		=> $data['perpetrator_id'],
							'perpetrator_status'	=> $data['perpetrator_status'],
						);

						$this->AndroidRMIProtection_model->updateDataPerpetrator($data_update);
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						/* $response['dataperpetratorchronology'] 		= $dataperpetratorchronology; */

					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}
				}
			}

			echo json_encode($response);
		}

		public function getSearchDataPerpetrator(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'datasearchperpetrator'			=> "",
			);

		/* 	perpetrator_name=null&province_id=&city_id=&province_id_perpetrator=&city_id_perpetrator=&sort_status=&perpetrator_not_caught=&perpetrator_already_caught=&perpetrator_been_processed=&province_perpetrator_id=&province_customer_id=&bundle_status=0 */

		/* customer_id=12&perpetrator_name=&province_id=&city_id=&province_id_perpetrator=&city_id_perpetrator=&sort_status=&perpetrator_not_caught=&perpetrator_already_caught=&perpetrator_been_processed=&province_perpetrator_id=&province_customer_id=&bundle_status=0&package_id=3&package_price_id=4 */

			$data = array(
				'customer_id'					=> $this->input->post('customer_id',true),
				'package_id'					=> $this->input->post('package_id',true),
				'package_price_id'				=> $this->input->post('package_price_id',true),
				'perpetrator_name'				=> $this->input->post('perpetrator_name',true),
				'province_id'					=> $this->input->post('province_id',true),
				'city_id'						=> $this->input->post('city_id',true),
				'province_id_perpetrator'		=> $this->input->post('province_id_perpetrator',true),
				'city_id_perpetrator'			=> $this->input->post('city_id_perpetrator',true),
				'sort_status'					=> $this->input->post('sort_status',true),
				'province_perpetrator_id'		=> $this->input->post('province_perpetrator_id',true),
				'province_customer_id'			=> $this->input->post('province_customer_id',true),
				'bundle_status'					=> $this->input->post('bundle_status',true),
			);

			/* $data = array(
				'customer_id'					=> 12,
				'package_id'					=> 3,
				'package_price_id'				=> 4,
				'perpetrator_name'				=> "",
				'province_id'					=> "",
				'city_id'						=> "",
				'province_id_perpetrator'		=> "",
				'city_id_perpetrator'			=> "",
				'sort_status'					=> "",
				'province_perpetrator_id'		=> "",
				'province_customer_id'			=> "",
				'bundle_status'					=> 0,
			); */

			$perpetratorstatus 		= $this->configuration->PerpetratorStatus();

			$data_status = array(
				'perpetrator_not_caught'		=> "",
				'perpetrator_already_caught'	=> "",
				'perpetrator_been_processed'	=> "",
			);

			/* perpetrator_name=&province_id=1&city_id=7&province_id_perpetrator=1&city_id_perpetrator=7&sort_status=3&perpetrator_not_caught=&perpetrator_already_caught=&perpetrator_been_processed=&province_perpetrator_id=0&province_customer_id=0&bundle_status=1 */

			/* $data = array(
				'perpetrator_name'				=> "",
				'province_id'					=> 1,
				'city_id'						=> 7,
				'province_id_perpetrator'		=> 1,
				'city_id_perpetrator'			=> 7,
				'sort_status'					=> 3,
				'province_perpetrator_id'		=> 0,
				'province_customer_id'			=> 0,
				'bundle_status'					=> 1,
			); */

			$perpetratorstatus 		= $this->configuration->PerpetratorStatus();

			/* $data_status = array(
				'perpetrator_not_caught'		=> "",
				'perpetrator_already_caught'	=> "",
				'perpetrator_been_processed'	=> "",
			); */

			/* $data_status = array(
				'perpetrator_not_caught'		=> 1,
				'perpetrator_already_caught'	=> 2,
				'perpetrator_been_processed'	=> "",
			); */

			$perpetrator_status1 				= array_values($data_status);

			$perpetrator_status 				= array_filter($perpetrator_status1);

			/* $data['bundle_status']				= 1;

			$data['perpetrator_name']			= "doe"; */

			/* $datasearchperpetratorlist 			= $this->AndroidRMIProtection_model->getSearchDataPerpetrator($data['perpetrator_name'], $data['province_id'], $data['city_id'], $data['province_id_perpetrator'], $data['city_id_perpetrator'], $data['sort_status'], $data['province_perpetrator_id'], $data['province_customer_id'], $data['bundle_status'], $perpetrator_status); */

			/* print_r("data_status ");
			print_r($data_status);
			print_r("<BR>");
			print_r("<BR>");
			print_r("perpetrator_status1 ");
			print_r($perpetrator_status1);
			print_r("<BR>");
			print_r("<BR>");
			print_r("perpetrator_status ");
			print_r($perpetrator_status);
			print_r("<BR>");
			print_r("<BR>");
			print_r("datasearchperpetratorlist 2 ");
			print_r($datasearchperpetratorlist);
			print_r("<BR>");
			print_r("<BR>");
			exit; */

			if($response["error"] == FALSE){
				/* $perpetrator_status = array(

				); */

				$datasearchperpetratorlist 			= $this->AndroidRMIProtection_model->getSearchDataPerpetrator($data['perpetrator_name'], $data['province_id'], $data['city_id'], $data['province_id_perpetrator'], $data['city_id_perpetrator'], $data['sort_status'], $data['province_perpetrator_id'], $data['province_customer_id'], $data['bundle_status'], $perpetrator_status);

				if(!$datasearchperpetratorlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($datasearchperpetratorlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($datasearchperpetratorlist)){
							$customer_package_opening_balance 	= $this->AndroidRMIProtection_model->getCustomerPackageSearchBalance($data['customer_id']);

							if ($data['bundle_status'] == 1){
								$customer_package_last_balance		= $customer_package_opening_balance - 1;
								
								$data_customerpackage = array(
									'customer_id'									=> $data['customer_id'],
									'package_id'									=> $data['package_id'],
									'package_price_id'								=> $data['package_price_id'],
									'customer_package_history_status'				=> 2,
									'customer_package_history_date'					=> date("Y-m-d"),
									'customer_package_history_opening_balance'		=> $customer_package_opening_balance,
									'customer_package_history_last_balance'			=> $customer_package_last_balance,
								);

								if ($this->AndroidRMIProtection_model->insertSalesCustomerPackageHistory($data_customerpackage)){
									$data_updatecustomer = array(
										'customer_id'								=> $data['customer_id'],
										'customer_package_search_balance'			=> $customer_package_last_balance
									);

									if ($this->AndroidRMIProtection_model->updateSalesCustomer($data_updatecustomer)){

									}
								}
							} else {
								$customer_package_last_balance	= $customer_package_opening_balance;
							}


							foreach ($datasearchperpetratorlist as $key => $val) {

								$dataperpetratorphoto 		= $this->AndroidRMIProtection_model->getDataPerpetratorPhoto_Perpetrator($val['perpetrator_id']);

								$perpetrator_status_name	= $perpetratorstatus[$val['perpetrator_status']];

								$province_name_perpetrator	= $this->AndroidRMIProtection_model->getProvinceName($val['province_id_perpetrator']);

								$city_name_perpetrator		= $this->AndroidRMIProtection_model->getCityName($val['city_id_perpetrator']);

								$perpetrator_date_of_birth 	= new DateTime($val['perpetrator_date_of_birth']);

								$today 		 				= new DateTime(date("Y-m-d"));

								$diff 						= $perpetrator_date_of_birth->diff($today);		

								$perpetrator_age			= $diff->y;

								$perpetrator_chronology_description = $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Perpetrator($val['perpetrator_id']);
								
								$datasearchperpetrator[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$datasearchperpetrator[$key]['customer_id'] 						= $val['customer_id'];
								$datasearchperpetrator[$key]['customer_name'] 						= $val['customer_name'];
								$datasearchperpetrator[$key]['customer_contact_person'] 			= $val['customer_contact_person'];
								$datasearchperpetrator[$key]['customer_mobile_phone'] 				= $val['customer_mobile_phone'];
								$datasearchperpetrator[$key]['province_id'] 						= $val['province_id'];
								$datasearchperpetrator[$key]['province_name'] 						= $val['province_name'];
								$datasearchperpetrator[$key]['city_id'] 							= $val['city_id'];
								$datasearchperpetrator[$key]['city_name'] 							= $val['city_name'];
								$datasearchperpetrator[$key]['perpetrator_name'] 					= $val['perpetrator_name'];
								$datasearchperpetrator[$key]['perpetrator_address'] 				= $val['perpetrator_address'];
								$datasearchperpetrator[$key]['perpetrator_mobile_phone'] 			= $val['perpetrator_mobile_phone'];
								$datasearchperpetrator[$key]['perpetrator_id_number'] 				= $val['perpetrator_id_number'];
								$datasearchperpetrator[$key]['perpetrator_age'] 					= $perpetrator_age;
								$datasearchperpetrator[$key]['perpetrator_gender'] 					= $val['gender_name'];
								$datasearchperpetrator[$key]['perpetrator_status'] 					= $val['perpetrator_status'];
								$datasearchperpetrator[$key]['perpetrator_status_name'] 			= $perpetrator_status_name;
								$datasearchperpetrator[$key]['province_id_perpetrator'] 			= $val['province_id_perpetrator'];
								$datasearchperpetrator[$key]['city_id_perpetrator'] 				= $val['city_id_perpetrator'];
								$datasearchperpetrator[$key]['province_name_perpetrator'] 			= $province_name_perpetrator;
								$datasearchperpetrator[$key]['city_name_perpetrator'] 				= $city_name_perpetrator;
								$datasearchperpetrator[$key]['perpetrator_photo_url'] 				= $base_url.'img/'.$dataperpetratorphoto['perpetrator_photo_path'].'/'.$dataperpetratorphoto['perpetrator_photo_name'];
								$datasearchperpetrator[$key]['customer_package_search_balance'] 	= $customer_package_last_balance;
								$datasearchperpetrator[$key]['created_on'] 							= simpledatetime($val['created_on']);
								$datasearchperpetrator[$key]['perpetrator_chronology_description'] 	= $perpetrator_chronology_description;

								
								
							}

							
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['datasearchperpetrator'] 			= $datasearchperpetrator;
					}
				}
			}
			echo json_encode($response);
		}

		/*CONTENT EVENT*/
		public function getContentEvent(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'contentevent'			=> "",
			);

			
			if($response["error"] == FALSE){
				$contenteventlist = $this->AndroidRMIProtection_model->getContentEventList();


				if(!$contenteventlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($contenteventlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($contenteventlist as $key => $val) {
							$contentevent[$key]['event_id'] 			= $val['event_id'];
							$contentevent[$key]['event_title']			= $val['event_title'];
							$contentevent[$key]['event_description']	= $val['event_description'];
							$contentevent[$key]['event_image_url']		= $base_url.'img/event/'.$val['event_image'];
						}

						
						$response['error'] 				= FALSE;
						$response['error_msg_title'] 	= "Success";
						$response['error_msg'] 			= "Data Exist";
						$response['contentevent'] 		= $contentevent;
					}
				}
			}
			

			echo json_encode($response);
		}

		/* SCHEDULE WORSHIP WEEKLY */
		public function getContentNews(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'contentnews'			=> "",
			);

			
			if($response["error"] == FALSE){
				$contentnewslist = $this->AndroidRMIProtection_model->getContentNewsList();


				if(!$contentnewslist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($contentnewslist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($contentnewslist as $key => $val) {

							$created_name 								= $this->AndroidRMIProtection_model->getCreatedName($val['created_id']);

							$contentnews[$key]['news_id']				= $val['news_id'];
							$contentnews[$key]['news_title']			= $val['news_title'];
							$contentnews[$key]['news_description']		= $val['news_description'];
							$contentnews[$key]['created_on']			= simpledatetime($val['created_on']);
							$contentnews[$key]['created_name']			= $created_name;
							$contentnews[$key]['news_image_url']		= $base_url.'img/news/'.$val['news_image'];
						}
						
						/*print_r("contentintro ");
						print_r($contentintro);*/
						
						$response['error'] 				= FALSE;
						$response['error_msg_title'] 	= "Success";
						$response['error_msg'] 			= "Data Exist";
						$response['contentnews'] 		= $contentnews;
					}
				}
			}
			

			echo json_encode($response);
		}

		public function getDataPerpetratorUpdate(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetrator'				=> "",
			);

			if($response["error"] == FALSE){
				$dataperpetratorupdatelist 	= $this->AndroidRMIProtection_model->getDataPerpetratorUpdateList();

				if(!$dataperpetratorupdatelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($dataperpetratorupdatelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($dataperpetratorupdatelist)){
							foreach ($dataperpetratorupdatelist as $key => $val) {
								$city_name_perpetrator 	= $val['city_name'];

								$city_name_perpetrator 	= str_replace("KOTA", "", $city_name_perpetrator);

								$city_name_perpetrator 	= str_replace("KABUPATEN", "", $city_name_perpetrator);

								$city_name_perpetrator 	= ucwords(strtolower($city_name_perpetrator));

								$len_perpetrator_name	= strlen($val['perpetrator_name']);

								if ($len_perpetrator_name > 18){
									$perpetrator_name_list 	= substr(trim($val['perpetrator_name']), 0, 15).'...';
								} else {
									$perpetrator_name_list 	= substr(trim($val['perpetrator_name']), 0, 18);
								}


								$perpetratorstatus 			= $this->configuration->PerpetratorStatus();

								$perpetrator_status_name	= $perpetratorstatus[$val['perpetrator_status']];

								$perpetrator_date_of_birth 	= new DateTime($val['perpetrator_date_of_birth']);

								$today 		 				= new DateTime(date("Y-m-d"));

								$diff 						= $perpetrator_date_of_birth->diff($today);		

								$province_name				= $this->AndroidRMIProtection_model->getProvinceName($val['province_id']);

								$city_name 					= $this->AndroidRMIProtection_model->getCityName($val['city_id']);

								$city_name 					= str_replace("KOTA", "", $city_name);

								$city_name 					= str_replace("KABUPATEN", "", $city_name);

								$city_name				 	= ucwords(strtolower($city_name));

								/* print_r("perpetrator_date_of_birth ");
								print_r($perpetrator_date_of_birth);
								print_r("<BR> ");
								print_r("<BR> ");

								print_r("today ");
								print_r($today);
								print_r("<BR> ");
								print_r("<BR> ");
								
								print_r("diff ");
								print_r($diff);
								print_r("<BR> ");
								print_r("<BR> "); */

								$perpetrator_age			= $diff->y;

								/* print_r("perpetrator_age ");
								print_r($perpetrator_age);
								print_r("<BR> ");
								print_r("<BR> "); */

								$perpetrator_chronology_description = $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Perpetrator($val['perpetrator_id']);

								
								$dataperpetratorupdate[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$dataperpetratorupdate[$key]['perpetrator_name'] 					= $val['perpetrator_name'];
								$dataperpetratorupdate[$key]['perpetrator_name_list'] 				= $val['perpetrator_name'];
								$dataperpetratorupdate[$key]['perpetrator_status'] 					= $val['perpetrator_status'];
								$dataperpetratorupdate[$key]['perpetrator_status_name'] 			= $perpetrator_status_name;
								$dataperpetratorupdate[$key]['perpetrator_address'] 				= $val['perpetrator_address'];
								$dataperpetratorupdate[$key]['province_id'] 						= $val['province_id'];
								$dataperpetratorupdate[$key]['province_name'] 						= $province_name;
								$dataperpetratorupdate[$key]['city_id'] 							= $val['city_id'];
								$dataperpetratorupdate[$key]['city_name'] 							= $city_name;
								$dataperpetratorupdate[$key]['perpetrator_mobile_phone'] 			= $val['perpetrator_mobile_phone'];
								$dataperpetratorupdate[$key]['province_id_perpetrator'] 			= $val['province_id_perpetrator'];
								$dataperpetratorupdate[$key]['province_name_perpetrator'] 			= ucwords(strtolower($val['province_name']));
								$dataperpetratorupdate[$key]['city_id_perpetrator'] 				= $val['city_id_perpetrator'];
								$dataperpetratorupdate[$key]['city_name_perpetrator'] 				= $city_name_perpetrator;
								$dataperpetratorupdate[$key]['perpetrator_id_number'] 				= $val['perpetrator_id_number'];
								$dataperpetratorupdate[$key]['perpetrator_age'] 					= $perpetrator_age;
								$dataperpetratorupdate[$key]['perpetrator_gender'] 					= $val['gender_name'];
								$dataperpetratorupdate[$key]['customer_name'] 						= $val['customer_name'];
								$dataperpetratorupdate[$key]['customer_contact_person'] 			= $val['customer_contact_person'];
								$dataperpetratorupdate[$key]['customer_mobile_phone'] 				= $val['customer_mobile_phone'];
								$dataperpetratorupdate[$key]['created_on'] 							= tgltoview($val['created_on']);
								$dataperpetratorupdate[$key]['perpetrator_chronology_description']	= $perpetrator_chronology_description;
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['dataperpetratorupdate'] 			= $dataperpetratorupdate;
					}
				}
			}
			echo json_encode($response);
		}

		public function getCoreGender(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'coregender'			=> "",
			);

			if($response["error"] == FALSE){
				$coregenderlist = $this->AndroidRMIProtection_model->getCoreGender();

				if(!$coregenderlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($coregenderlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($coregenderlist as $key => $val) {
							$coregender[$key]['gender_id']		= $val['gender_id'];
							$coregender[$key]['gender_name'] 	= $val['gender_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['coregender'] 			= $coregender;
					}
				}
			}
			echo json_encode($response);
		}

		/*SALES CUSTOMER*/
		public function processAddSalesCustomer(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'data_salescustomer'	=> "",
			);

			$unique 					= $this->session->userdata('unique');
			$auth						= $this->session->userdata('auth');	
			$customer_verification_code = rand(100001, 999999);
			/* $customer_verification_code = "123456"; */

			/* $package_status							= $this->input->post('package_price_status',true); */
			$package_status							= 1;

			$data_package = array(
				'package_price_month'				=> $this->input->post('package_price_month',true),
				'package_price_amount'				=> $this->input->post('package_price_amount',true),
				'package_price_status'				=> $this->input->post('package_price_status',true),
			);

			/* $data_package = array(
				'package_price_month'				=> 7,
				'package_price_amount'				=> 0,
				'package_price_status'				=> 1,
			); */

			if ($package_status == 1){
				$customer_package_date 		= date("Y-m-d");
				$customer_last_date 		= date('Y-m-d', strtotime($customer_package_date. ' + '. $data_package['package_price_month'].'days'));

				$data = array(
					'province_id'						=> $this->input->post('province_id',true),
					'city_id'							=> $this->input->post('city_id',true),
					'package_id'						=> $this->input->post('package_id',true),
					'package_price_id'					=> $this->input->post('package_price_id',true),
					'customer_name'						=> $this->input->post('customer_name',true),
					'customer_email'					=> $this->input->post('customer_email',true),
					'customer_mobile_phone'				=> $this->input->post('customer_mobile_phone',true),
					'customer_password'					=> md5($this->input->post('customer_password',true)),
					'customer_token'					=> $this->input->post('customer_token',true),
					'customer_verification_code'		=> $customer_verification_code,
					'package_status'					=> $this->input->post('package_status',true),
					'customer_last_date'				=> $customer_last_date,
					'customer_package_status'			=> 1,
					'customer_package_date'				=> $customer_package_date,
					'verified'							=> 0,
					'data_state' 						=> 0,
					'created_id' 						=> date("YmdHis"),
					'created_on' 						=> date('Y-m-d H:i:s'),
				);

				/* $data = array(
					'province_id'						=> 13,
					'city_id'							=> 218,
					'package_id'						=> 1,
					'package_price_id'					=> 1,
					'customer_name'						=> 'Daniel Setiawan',
					'customer_email'					=> 'daniel@gmail.com',
					'customer_mobile_phone'				=> '0873984675403',
					'customer_password'					=> md5('123456'),
					'customer_token'					=> md5('1q2w3e4r'),
					'customer_verification_code'		=> $customer_verification_code,
					'package_status'					=> 1,
					'customer_last_date'				=> $customer_last_date,
					'customer_package_status'			=> 1,
					'customer_package_date'				=> $customer_package_date,
					'verified'							=> 0,
					'data_state' 						=> 0,
					'created_id' 						=> date("YmdHis"),
					'created_on' 						=> date('Y-m-d H:i:s'),
				); */
			} else {
				/* $data = array(
					'province_id'						=> 13,
					'city_id'							=> 218,
					'package_id'						=> 1,
					'package_price_id'					=> 1,
					'customer_name'						=> 'Daniel Setiawan',
					'customer_email'					=> 'daniel@gmail.com',
					'customer_mobile_phone'				=> '02342384237423423',
					'customer_password'					=> md5('123456'),
					'customer_token'					=> md5('1q2w3e4r'),
					'customer_verification_code'		=> $customer_verification_code,
					'package_status'					=> 1,
					'customer_package_status'			=> 0,
					'verified'							=> 0,
					'data_state' 						=> 0,
					'created_id' 						=> date("YmdHis"),
					'created_on' 						=> date('Y-m-d H:i:s'),
				); */

				$data = array(
					'province_id'						=> $this->input->post('province_id',true),
					'city_id'							=> $this->input->post('city_id',true),
					'package_id'						=> $this->input->post('package_id',true),
					'package_price_id'					=> $this->input->post('package_price_id',true),
					'customer_name'						=> $this->input->post('customer_name',true),
					'customer_email'					=> $this->input->post('customer_email',true),
					'customer_mobile_phone'				=> $this->input->post('customer_mobile_phone',true),
					'customer_password'					=> md5($this->input->post('customer_password',true)),
					'customer_token'					=> $this->input->post('customer_token',true),
					'customer_verification_code'		=> $customer_verification_code,
					'package_status'					=> $this->input->post('package_status',true),
					'customer_package_status'			=> 1,
					'verified'							=> 0,
					'data_state' 						=> 0,
					'created_id' 						=> date("YmdHis"),
					'created_on' 						=> date('Y-m-d H:i:s'),
				);
			}
			
			

			/* $data = array(
				'customer_name'						=> 'Daniel Setiawan',
				'customer_email'					=> 'danst2jc@gmail.com',
				'customer_mobile_phone'				=> '808181311311',
				'customer_password'					=> md5('123456'),
				'customer_token'					=> 'cY2Z_mF9shM%3AAPA91bF30JQN1_tee3ijtHtOsmxDCLbxHfd2KyFg2qRR4_sC1zZ0Kcq6Km6Da40hEhpGi8GzFLZ9YmpKjWBbIU2HkgK-BFGgLwbwGKdLL39AYoiDQ7TGSjF74tUiJwc8ChZlOtN7eRkP',
				'customer_verification_code'		=> $customer_verification_code,
				'verified'							=> 0,
				'data_state' 						=> 0,
				'created_id' 						=> date("YmdHis"),
				'created_on' 						=> date('Y-m-d H:i:s'),
			); */

			/*print_r("data_salescustomer ");
			print_r($data);
			print_r("<BR>");
			print_r("user_level ");
			print_r($user_level);
			print_r("<BR>");
			exit;*/

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Pelanggan is Empty";
			} else {
				if($response["error"] == FALSE){
					
					if ($this->AndroidRMIProtection_model->getCustomerMobilePhone($data['customer_mobile_phone'])){
						if ($this->AndroidRMIProtection_model->getCustomerEmail($data['customer_email'])){
							$data_customer = array (
								'province_id'						=> $data['province_id'],
								'city_id'							=> $data['city_id'],
								'package_id'						=> $data['package_id'],
								'package_price_id'					=> $data['package_price_id'],
								'customer_name'						=> $data['customer_name'],
								'customer_email'					=> $data['customer_email'],
								'customer_mobile_phone'				=> $data['customer_mobile_phone'],
								'customer_password'					=> $data['customer_password'],
								'customer_token'					=> $data['customer_token'],
								'customer_verification_code'		=> $customer_verification_code,
								'customer_address'					=> "",
								'customer_registration_date'		=> date('Y-m-d'),
								'package_status'					=> $data['package_status'],
								'customer_last_date'				=> $data['customer_last_date'],
								'customer_package_status'			=> $data['customer_package_status'],
								'customer_package_date'				=> $data['customer_package_date'],
								'customer_status'					=> 1,
								'verified'							=> 0,
								'data_state' 						=> 0,
								'created_id' 						=> date("YmdHis"),
								'created_on' 						=> date('Y-m-d H:i:s'),
							);

							
							if ($this->AndroidRMIProtection_model->insertSalesCustomer($data_customer)){
								$salescustomer = $this->AndroidRMIProtection_model->getSalesCustomer_Last($data_customer['created_id']);

								/*print_r("salescustomer ");
								print_r($salescustomer);*/

								$data_systemuser = array (
									'user_group_id'					=> 2,
									'customer_id'					=> $salescustomer['customer_id'],
									'package_id'					=> $data['package_id'],
									'package_price_id'				=> $data['package_price_id'],
									'customer_name'					=> $data_customer['customer_name'],
									'customer_email'				=> $data_customer['customer_email'],
									'customer_mobile_phone'			=> $data_customer['customer_mobile_phone'],
									'customer_password'				=> $data_customer['customer_password'],
									'customer_token'				=> $data_customer['customer_token'],
									'customer_verification_code'	=> $data_customer['customer_verification_code'],
									'user_level'					=> 0,
									'verified'						=> 0,
								);

								if ($this->AndroidRMIProtection_model->insertSystemUser($data_systemuser)){
									$data_salescustomer[0]['customer_id']					= $salescustomer['customer_id'];
									$data_salescustomer[0]['customer_name']					= $salescustomer['customer_name'];
									$data_salescustomer[0]['customer_email']				= $salescustomer['customer_email'];
									$data_salescustomer[0]['customer_mobile_phone']			= $salescustomer['customer_mobile_phone'];
									$data_salescustomer[0]['customer_verification_code']	= $salescustomer['customer_verification_code'];
									$data_salescustomer[0]['customer_status']				= $salescustomer['customer_status'];
									$data_salescustomer[0]['province_id']					= $salescustomer['province_id'];
									$data_salescustomer[0]['city_id']						= $salescustomer['city_id'];
									
									$data_customerpackage = array(
										'customer_id'				=> $salescustomer['customer_id'],
										'package_id'				=> $data_customer['package_id'],
										'package_price_id'			=> $data_customer['package_price_id'],
										'package_status'			=> $data_customer['package_status'],
										'package_price_month'		=> $data_customer['package_price_month'],
										'package_price_amount'		=> $data_customer['package_price_amount'],
										'customer_last_date'		=> $data_customer['customer_last_date'],
										'customer_package_date'		=> $data_customer['customer_package_date'],
										'customer_package_status'	=> $data_customer['customer_package_status'],
									);

									if ($this->AndroidRMIProtection_model->insertSalesCustomerPackage($data_customerpackage)){
										$response['error'] 					= FALSE;
										$response['error_msg_title'] 		= "Success";
										$response['error_msg'] 				= "Registrasi Berhasil";
										$response['data_salescustomer'] 	= $data_salescustomer;
									}

									
								} else {
									$response['error'] 					= TRUE;
									$response['error_msg_title'] 		= "No Data";
									$response['error_msg'] 				= "Error Query Data";
								}

							} else {
								$response['error'] 				= TRUE;
								$response['error_msg_title'] 	= "No Data";
								$response['error_msg'] 			= "Error Query Data";
							}
						} else {
							$response['error'] 				= TRUE;
							$response['error_msg_title'] 	= "Registrasi Gagal";
							$response['error_msg'] 			= "Data Email Pelanggan Sudah Ada";
						}
					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "Registrasi Gagal";
						$response['error_msg'] 			= "Data No Handphone Pelanggan Sudah Ada";
					}
				}
			}

			echo json_encode($response);
		}

		public function processUpdateCustomerVerificationCode(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'verificationcode'		=> "",
			);

			$user_level 				= $this->input->post('user_level',true);

			$data = array(
				'customer_id'					=> $this->input->post('customer_id',true),
				'customer_verification_code'	=> $this->input->post('customer_verification_code',true),
			);

			/*$data = array(
				'customer_id'					=> 1,
				'customer_verification_code'	=> '123456',
			);	*/		

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data is Empty";
			} else {
				if($response["error"] == FALSE){
					
					$customerverificationcode 	= $this->AndroidRMIProtection_model->getCustomerVerificationCode($data);	
					

					if($customerverificationcode == false){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}else{
						if (empty($customerverificationcode)){
							$response['error'] 				= TRUE;
							$response['error_msg_title'] 	= "No Data";
							$response['error_msg'] 			= "Data Does Not Exist";
						} else {
							
							$verificationcode[0]['customer_id'] 				= $customerverificationcode['customer_id'];
							$verificationcode[0]['customer_verification_code']	= $customerverificationcode['customer_verification_code'];

							$dataupdate = array (
								'customer_id'		=> $data['customer_id'],
								'verified'			=> 1,
								'verified_on'		=> date("Y-m-d H:i:s"),
								'customer_status'	=> 1,
							);

							if ($this->AndroidRMIProtection_model->updateSalesCustomer($dataupdate)){
								$dataupdate = array (
									'customer_id'		=> $data['customer_id'],
									'verified'			=> 1,
									'verified_on'		=> date("Y-m-d H:i:s"),
									'customer_status'	=> 1,
								);
								$this->AndroidRMIProtection_model->updateSystemUser($dataupdate);
							}
							
							
							$response['error'] 				= FALSE;
							$response['error_msg_title'] 	= "Success";
							$response['error_msg'] 			= "Data Exist";
							$response['verificationcode'] 	= $verificationcode;
						}
					}
				}
			}

			echo json_encode($response);
		}

		public function processUpdateCustomerEmail(){
			$data = array(
				'customer_email'				=> $this->input->post('customer_email', true),
				'customer_id'					=> $this->input->post('customer_id', true),
				'customer_name'					=> $this->input->post('customer_name', true),
			);

			$user_level 	= $this->input->post('user_level', true);

			/*print_r("data ");
			print_r($data);
			print_r("<BR> ");*/
			
			$customer_verification_code = rand(100001, 999999);
		
			$response = array(
				'error'								=> FALSE,
				'error_customeremail'				=> FALSE,
				'error_msg_title_customeremail'		=> "",
				'error_msg_customeremail'			=> "",
			);

			if($response["error_customeremail"] == FALSE){
				if(!empty($data)){
					
					$dataupdate = array(
						'customer_id'					=>	$data['customer_id'],
						'customer_email'				=>	$data['customer_email'],
						'customer_verification_code'	=>	$customer_verification_code,
					);

					if ($this->AndroidRMIProtection_model->updateSalesCustomer($dataupdate)){
						if ($this->AndroidRMIProtection_model->updateSystemUser($dataupdate)){
							$this->sendEmailFirst($data['customer_id'], $data['customer_email'], $data['customer_name'], $customer_verification_code);
						}

						$response['error'] 				= FALSE;
						$response['error_msg_title'] 	= "Ganti Email Verifikasi Berhasil";
						$response['error_msg'] 			= "Data Berhasil";		
					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "Ganti Email Verifikasi Gagal";
						$response['error_msg'] 			= "Data Gagal";		
					}
				}

			} 
			
			echo json_encode($response);
		}

		public function sendEmailFirst($customer_id, $customer_email, $customer_name, $customer_verification_code){
			/*public function sendEmailFirst(){*/
			$config['protocol'] = 'sendmail';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] 	= 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';

			/*$customer_email = "danst2jc@gmail.com";
			$customer_name = "Daniel Setiawan";
			$customer_verification_code = "123456";*/

			$this->email->initialize($config);
			$this->email->from('no-reply@oasisindo.org', 'Loker Sukses');
			$this->email->to($customer_email);
			
			$this->email->subject('Halo '.$customer_name.' Berikut Kode Verifikasi Anda');
			$base_url = base_url();

			$body = "
				<!DOCTYPE html>
				<html>
					<head>
							<meta charset=\"utf-8\" />
							<title>Loker Sukses</title>
							<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
					</head>
					<body>
						<div>
							div align=\"center\" >
								<img src=\"".$base_url."assets/img/logo_loker_sukses.png\" alt=\"\" width=\"50%\" height=\"50%\" alt=\"\">
							</div>
							<hr>
							<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\">Halo	".$customer_name.",
							</p>
							<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\"> Berikut ini adalah kode verifikasi Anda </a> 
							</p>
							<div align=\"center\" >
								<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 48px;line-height: 25px;Margin-bottom: 25px\"> ".$customer_verification_code." </a> 
								</p>
							</div>
							<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\">Jika Anda memiliki pertanyaan mengenai kode verifikasi, silakan mengirimkan surel ke <a href=\"mailto:info@oasisindo.org\">info@oasisindo.org</a>.
							</p>
						</div>
					</body>
				</html>
			";

			$this->email->message($body);



			if ($this->email->send()){
				return true;
			} else {
				return false;
			}
		}

		public function getCorePackage(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'corepackage'			=> "",
			);

			if($response["error"] == FALSE){
				$corepackagelist = $this->AndroidRMIProtection_model->getCorePackage();

				if(!$corepackagelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($corepackagelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($corepackagelist as $key => $val) {
							$corepackage[$key]['package_id']		= $val['package_id'];
							$corepackage[$key]['package_name'] 		= $val['package_name'];
							$corepackage[$key]['package_status'] 	= $val['package_status'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['corepackage'] 			= $corepackage;
					}
				}
			}
			echo json_encode($response);
		}


		public function getCorePackagePrice(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'corepackageprice'		=> "",
			);

			$data = array(
				'package_id'			=> $this->input->post('package_id',true),
			);

			if($response["error"] == FALSE){
				$corepackagepricelist = $this->AndroidRMIProtection_model->getCorePackagePrice($data['package_id']);

				if(!$corepackagepricelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($corepackagepricelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($corepackagepricelist as $key => $val) {
							$corepackageprice[$key]['package_id']			= $val['package_id'];
							$corepackageprice[$key]['package_price_id'] 	= $val['package_price_id'];
							$corepackageprice[$key]['package_price_name']	= $val['package_price_name'];
							$corepackageprice[$key]['package_price_amount']	= $val['package_price_amount'];
							$corepackageprice[$key]['package_price_month']	= $val['package_price_month'];
							$corepackageprice[$key]['package_price_status']	= $val['package_price_status'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['corepackageprice'] 		= $corepackageprice;
					}
				}
			}
			echo json_encode($response);
		}
	

		public function getCustomerPackage(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'customerpackage'		=> "",
			);

			$data = array(
				'customer_id'			=> $this->input->post('customer_id',true),
			);

			/* $data = array(
				'customer_id'			=> 12,
			); */

			if($response["error"] == FALSE){
				$customerpackagelist = $this->AndroidRMIProtection_model->getCustomerPackage($data['customer_id']);

				/* print_r("customerpackagelist ");
				print_r($customerpackagelist);
				print_r("<BR> ");
				print_r("<BR> "); */

				if(!$customerpackagelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($customerpackagelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$today 								= date("Y-m-d");
						$package_status 					= $customerpackagelist['package_status'];
						$customer_last_date					= $customerpackagelist['customer_last_date'];
						$customer_package_search_balance	= $customerpackagelist['customer_package_search_balance'];
						$customer_package_add_balance		= $customerpackagelist['customer_package_add_balance'];

						/* print_r("package_status ");
						print_r($package_status);
						print_r("<BR> ");
						print_r("<BR> ");

						print_r("customer_last_date ");
						print_r($customer_last_date);
						print_r("<BR> ");
						print_r("<BR> "); */

						if ($package_status == 1){
							if ($customer_last_date < $today){
								$customer_package_search_status 	= 0;
								$customer_package_add_status 		= 0;
							} else {
								$customer_package_search_status 	= 1;
								$customer_package_add_status 		= 1;
							}
						} else {
							if ($customer_last_date < $today){
								$customer_package_search_status 	= 0;
								$customer_package_add_status 		= 0;
							} else {
								if($customer_package_search_balance <= 0 && $customer_package_add_balance > 0){
									$customer_package_search_status 	= 0;
									$customer_package_add_status 		= 1;
								} else if($customer_package_search_balance > 0 && $customer_package_add_balance <= 0){
									$customer_package_search_status 	= 1;
									$customer_package_add_status 		= 0;
								} else if($customer_package_search_balance > 0 && $customer_package_add_balance > 0){
									$customer_package_search_status 	= 1;
									$customer_package_add_status 		= 1;
								}
							} 
						}
						
						$customerpackage[0]['customer_id']						= $customerpackagelist['customer_id'];
						$customerpackage[0]['package_id']						= $customerpackagelist['package_id'];
						$customerpackage[0]['package_price_id']					= $customerpackagelist['package_price_id'];
						$customerpackage[0]['customer_last_date'] 				= $customerpackagelist['customer_last_date'];
						$customerpackage[0]['customer_package_search_balance']	= $customer_package_search_balance;
						$customerpackage[0]['customer_package_add_balance']		= $customer_package_add_balance;
						$customerpackage[0]['package_status']					= $customerpackagelist['package_status'];
						$customerpackage[0]['customer_package_search_status']	= $customer_package_search_status;
						$customerpackage[0]['customer_package_add_status']		= $customer_package_add_status;

						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['customerpackage'] 		= $customerpackage;
					}
				}
			}
			echo json_encode($response);
		}


		/*SALES CUSTOMER*/
		public function processAddSalesCustomerPackage(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'data_salescustomer'	=> "",
			);

			$unique 					= $this->session->userdata('unique');
			$auth						= $this->session->userdata('auth');	

			$data = array(
				'customer_id'						=> $this->input->post('customer_id',true),
				'package_id'						=> $this->input->post('package_id',true),
				'package_price_id'					=> $this->input->post('package_price_id',true),
				'customer_package_date'				=> date("Y-m-d"),
				'package_status'					=> $this->input->post('package_status',true),
				'package_price_month'				=> $this->input->post('package_price_month',true),
				'package_price_amount'				=> $this->input->post('package_price_amount',true),
				'package_price_status'				=> $this->input->post('package_price_status',true),
				'data_state' 						=> 0,
				'created_id' 						=> date("YmdHis"),
				'created_on' 						=> date('Y-m-d H:i:s'),
			);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Pelanggan is Empty";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->insertSalesCustomerPackage($data)){
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Top Up Berhasil";
					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}
				}
			}

			echo json_encode($response);
		}

		public function processUpdateSalesCustomerPassword(){
			$data = array(
				'salescustomerpassword'		=> $this->input->post('salescustomerpassword', true),
				'user_id'					=> $this->input->post('user_id', true),
				'user_level'				=> $this->input->post('user_level', true),
			);

			/*print_r("data ");
			print_r($data);
			print_r("<BR> ");*/
			
		
			$response = array(
				'error'									=> FALSE,
				'error_salescustomerpassword'			=> FALSE,
				'error_msg_title_salescustomerpassword'	=> "",
				'error_msg_salescustomerpassword'		=> "",
			);
			
			if($response["error"] == FALSE){


				## Sales Customer Password

				$data_salescustomerpassword = array();
				$raw = json_decode($this->input->post('salescustomerpassword', true), true);
				if(empty($raw)){
					$response['error_salescustomerpassword'] 				= TRUE;
					$response['error_msg_title_salescustomerpassword'] 		= "Kesalahan";
					$response['error_msg_salescustomerpassword'] 			= "Anda harus memasukkan minimal 1 Customer";
				}else{
					foreach($raw as $k=>$v){					
						$data_salescustomerpassword = array(
							'customer_id'					=>	$v['customer_id'],
							'customer_password'				=>	md5($v['customer_password']),
							'customer_new_password'			=>	md5($v['customer_new_password']),
						);	
					}
				}
			}

			if($response["error_salescustomerpassword"] == FALSE){
				if(!empty($data_salescustomerpassword)){
					if ($this->AndroidRMIProtection_model->getCustomerPassword($data_salescustomerpassword)){

						$dataupdate = array(
							'customer_id'				=>	$data_salescustomerpassword['customer_id'],
							'customer_password'			=>	$data_salescustomerpassword['customer_new_password'],
						);

						if ($this->AndroidRMIProtection_model->updateSalesCustomer($dataupdate)){

							$this->AndroidRMIProtection_model->updateSystemUser($dataupdate);

							$response['error'] 				= FALSE;
							$response['error_msg_title'] 	= "Ganti Password Berhasil";
							$response['error_msg'] 			= "Data Berhasil";		
						} else {
							$response['error'] 				= TRUE;
							$response['error_msg_title'] 	= "Ganti Password Gagal";
							$response['error_msg'] 			= "Data Gagal";		
						}
					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "Ganti Password Gagal";
						$response['error_msg'] 			= "Password Pelanggan Salah";		
					}
				}

			} 
			
			echo json_encode($response);
		}

		public function getDataPerpetratorList(){
			$base_url = base_url();

			$data = array(
				'customer_id'					=> $this->input->post('customer_id', true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'dataperpetratorlist'			=> "",
			);

			if($response["error"] == FALSE){
				$dataperpetratorupdatelist 	= $this->AndroidRMIProtection_model->getDataPerpetratorListList($data['customer_id']);

				if(!$dataperpetratorupdatelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($dataperpetratorupdatelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($dataperpetratorupdatelist)){
							foreach ($dataperpetratorupdatelist as $key => $val) {
								$city_name_perpetrator 	= $val['city_name'];

								$city_name_perpetrator 	= str_replace("KOTA", "", $city_name_perpetrator);

								$city_name_perpetrator 	= str_replace("KABUPATEN", "", $city_name_perpetrator);

								$city_name_perpetrator 	= ucwords(strtolower($city_name_perpetrator));

								$len_perpetrator_name	= strlen($val['perpetrator_name']);

								if ($len_perpetrator_name > 18){
									$perpetrator_name_list 	= substr(trim($val['perpetrator_name']), 0, 15).'...';
								} else {
									$perpetrator_name_list 	= substr(trim($val['perpetrator_name']), 0, 18);
								}


								$perpetratorstatus 			= $this->configuration->PerpetratorStatus();

								$perpetrator_status_name	= $perpetratorstatus[$val['perpetrator_status']];

								$perpetrator_date_of_birth 	= new DateTime($val['perpetrator_date_of_birth']);

								$today 		 				= new DateTime(date("Y-m-d"));

								$diff 						= $perpetrator_date_of_birth->diff($today);

								$perpetrator_age			= $diff->y;


								$perpetrator_chronology_description = $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Perpetrator($val['perpetrator_id']);

								
								$dataperpetratorlist[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$dataperpetratorlist[$key]['perpetrator_name'] 						= $val['perpetrator_name'];
								$dataperpetratorlist[$key]['perpetrator_name_list'] 				= $val['perpetrator_name'];
								$dataperpetratorlist[$key]['perpetrator_status'] 					= $val['perpetrator_status'];
								$dataperpetratorlist[$key]['perpetrator_status_name'] 				= $perpetrator_status_name;
								$dataperpetratorlist[$key]['perpetrator_address'] 					= $val['perpetrator_address'];
								$dataperpetratorlist[$key]['perpetrator_mobile_phone'] 				= $val['perpetrator_mobile_phone'];
								$dataperpetratorlist[$key]['province_id_perpetrator'] 				= $val['province_id_perpetrator'];
								$dataperpetratorlist[$key]['province_name_perpetrator'] 			= ucwords(strtolower($val['province_name']));
								$dataperpetratorlist[$key]['city_id_perpetrator'] 					= $val['city_id_perpetrator'];
								$dataperpetratorlist[$key]['city_name_perpetrator'] 				= $city_name_perpetrator;
								$dataperpetratorlist[$key]['perpetrator_id_number'] 				= $val['perpetrator_id_number'];
								$dataperpetratorlist[$key]['perpetrator_date_of_birth'] 			= tgltoview($val['perpetrator_date_of_birth']);
								$dataperpetratorlist[$key]['perpetrator_age'] 						= $perpetrator_age;
								$dataperpetratorlist[$key]['gender_id'] 							= $val['gender_id'];
								$dataperpetratorlist[$key]['perpetrator_gender'] 					= $val['gender_name'];
								$dataperpetratorlist[$key]['customer_name'] 						= $val['customer_name'];
								$dataperpetratorlist[$key]['customer_contact_person'] 				= $val['customer_contact_person'];
								$dataperpetratorlist[$key]['customer_mobile_phone'] 				= $val['customer_mobile_phone'];
								$dataperpetratorlist[$key]['created_on'] 							= tgltoview($val['created_on']);
								$dataperpetratorlist[$key]['perpetrator_chronology_description']	= $perpetrator_chronology_description;
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['dataperpetratorlist'] 			= $dataperpetratorlist;
					}
				}
			}
			echo json_encode($response);
		}

		public function processUpdateDataPerpetrator(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'dataperpetrator'		=> "",
			);

			$perpetrator_chronology_description	= $this->input->post('perpetrator_chronology_description',true);
			
			$data = array(
				'perpetrator_id'				=> $this->input->post('perpetrator_id',true),
				'province_id_perpetrator'		=> $this->input->post('province_id_perpetrator',true),
				'city_id_perpetrator'			=> $this->input->post('city_id_perpetrator',true),
				'gender_id'						=> $this->input->post('gender_id',true),
				'perpetrator_name'				=> $this->input->post('perpetrator_name',true),
				'perpetrator_mobile_phone'		=> $this->input->post('perpetrator_mobile_phone',true),
				'perpetrator_id_number'			=> $this->input->post('perpetrator_id_number',true),
				'perpetrator_date_of_birth' 	=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_address'			=> $this->input->post('perpetrator_address',true),
				'perpetrator_status'			=> $this->input->post('perpetrator_status',true),
				'data_state' 					=> 0,
				'updated_id' 					=> $this->input->post('user_id',true),
				'updated_on' 					=> date('Y-m-d H:i:s'),
			);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Jemaat is Empty";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->updateDataPerpetrator($data)){

						$perpetrator_chronology_id = $this->AndroidRMIProtection_model->getPerpetratorChronologyID($data['perpetrator_id']);

						$data_perpetratorchronology = array (
							'perpetrator_chronology_id'				=> $perpetrator_chronology_id,
							'perpetrator_id'						=> $data['perpetrator_id'],
							'perpetrator_status'					=> $data['perpetrator_status'],
							'perpetrator_chronology_description' 	=> $perpetrator_chronology_description,
						);

						if ($this->AndroidRMIProtection_model->updateDataPerpetratorChronology($data_perpetratorchronology)){
							
						}

						$dataperpetrator[0]['perpetrator_id']				= $data['perpetrator_id'];

						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['dataperpetrator'] 		= $dataperpetrator;

					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}
				}
			}

			echo json_encode($response);
		}


		public function processDeleteDataPerpetrator(){
			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'dataperpetrator'		=> "",
			);
			
			$data = array(
				'perpetrator_id'				=> $this->input->post('perpetrator_id',true),
				'data_state' 					=> 2,
				'deleted_id' 					=> $this->input->post('user_id',true),
				'deleted_on' 					=> date('Y-m-d H:i:s'),
			);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Jemaat is Empty";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->deleteDataPerpetrator($data)){

						$dataperpetrator[0]['perpetrator_id']				= $data['perpetrator_id'];

						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['dataperpetrator'] 		= $dataperpetrator;

					} else {
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Error Query Data";
					}
				}
			}

			echo json_encode($response);
		}
	}
?>