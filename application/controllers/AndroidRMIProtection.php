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
				'user_id'						=> $this->input->post('user_id',true),
				'user_token'					=> $this->input->post('user_token',true),
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

			$corevendor 						= $this->AndroidRMIProtection_model->getCoreVendor_Detail($vendor_id);
			
			$data = array(
				'region_id'						=> $this->input->post('region_id',true),
				'branch_id'						=> $this->input->post('branch_id',true),
				'vendor_id'						=> $this->input->post('vendor_id',true),
				'province_id'					=> $corevendor['province_id'],
				'city_id'						=> $corevendor['city_id'],
				'province_perpetrator_id'		=> $this->input->post('province_perpetrator_id',true),
				'city_perpetrator_id'			=> $this->input->post('city_perpetrator_id',true),
				'perpetrator_name'				=> $this->input->post('perpetrator_name',true),
				'perpetrator_mobile_phone'		=> $this->input->post('perpetrator_mobile_phone',true),
				'perpetrator_id_number'			=> $this->input->post('perpetrator_id_number',true),
				'perpetrator_date_of_birth' 	=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_address'			=> $this->input->post('perpetrator_address',true),
				'data_state' 					=> 0,
				'created_id' 					=> $this->input->post('user_id',true),
				'created_on' 					=> date('Y-m-d H:i:s'),
			);

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
							'vendor_id'								=> $data['vendor_id'],
							'perpetrator_chronology_description' 	=> $perpetrator_chronology_description,
							'perpetrator_chronology_date'			=> date("Y-m-d"),
							'data_state'							=> 0,
							'created_id'							=> $data['created_id'],
							'created_on'							=> date("Y-m-d H:i:s")
						);

						if ($this->AndroidRMIProtection_model->insertDataPerpetratorChronology($data_perpetratorchronology)){

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

							file_put_contents(APPPATH .'../img/'.$vendor_code.'/'.$perpetrator_photo_name, $decodedData);

							$data_photo = array(
								'perpetrator_id'			=> $data['perpetrator_id'],
								'perpetrator_photo_path'	=> $vendor_code,
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
				$dataperpetratorchronologylist = $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Detail($data['perpetrator_id']);


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
							$dataperpetratorchronology[$key]['perpetrator_chronology_id'] 			= $val['perpetrator_chronology_id'];
							$dataperpetratorchronology[$key]['perpetrator_chronology_description']	= $val['perpetrator_chronology_description'];
							$dataperpetratorchronology[$key]['created_on']							= $val['created_on'];
							$dataperpetratorchronology[$key]['created_name']						= $val['vendor_name'];
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

			$vendor_id							= $this->input->post('vendor_id',true);

			$corevendor 						= $this->AndroidRMIProtection_model->getCoreVendor_Detail($vendor_id);
			
			$data = array(
				'perpetrator_id'						=> $this->input->post('perpetrator_id',true),
				'vendor_id'								=> $this->input->post('vendor_id',true),
				'province_id'							=> $corevendor['province_id'],
				'city_id'								=> $corevendor['city_id'],
				'perpetrator_chronology_description'	=> $this->input->post('perpetrator_chronology_description',true),
				'perpetrator_chronology_date'			=> date("Y-m-d"),
				'data_state' 							=> 0,
				'created_id' 							=> $this->input->post('user_id',true),
				'created_on' 							=> date('Y-m-d H:i:s'),
			);

			if (empty($data)){
				$response['error'] 				= TRUE;
				$response['error_msg_title'] 	= "No Data";
				$response['error_msg'] 			= "Data Jemaat is Empty";
			} else {
				if($response["error"] == FALSE){
					if ($this->AndroidRMIProtection_model->insertDataPerpetratorChronology($data)){
						
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

			$data = array(
				'perpetrator_name'			=> $this->input->post('perpetrator_name',true),
			);

			$perpetratorstatus 		= $this->configuration->PerpetratorStatus();

			if($response["error"] == FALSE){
				$datasearchperpetratorlist 	= $this->AndroidRMIProtection_model->getSearchDataPerpetrator($data['perpetrator_name']);

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
							foreach ($datasearchperpetratorlist as $key => $val) {
								$dataperpetratorchronology 	= $this->AndroidRMIProtection_model->getDataPerpetratorChronology_Perpetrator($val['perpetrator_id']);

								$dataperpetratorphoto 		= $this->AndroidRMIProtection_model->getDataPerpetratorPhoto_Perpetrator($val['perpetrator_id']);

								$perpetrator_status_name	= $perpetratorstatus[$val['perpetrator_status']];
								
								$datasearchperpetrator[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$datasearchperpetrator[$key]['region_id'] 							= $val['region_id'];
								$datasearchperpetrator[$key]['region_name'] 						= $val['region_name'];
								$datasearchperpetrator[$key]['branch_id'] 							= $val['branch_id'];
								$datasearchperpetrator[$key]['branch_name'] 						= $val['branch_name'];
								$datasearchperpetrator[$key]['vendor_id'] 							= $val['vendor_id'];
								$datasearchperpetrator[$key]['vendor_name'] 						= $val['vendor_name'];
								$datasearchperpetrator[$key]['vendor_contact_person'] 				= $val['vendor_contact_person'];
								$datasearchperpetrator[$key]['vendor_phone'] 						= $val['vendor_phone'];
								$datasearchperpetrator[$key]['province_id'] 						= $val['province_id'];
								$datasearchperpetrator[$key]['province_name'] 						= $val['province_name'];
								$datasearchperpetrator[$key]['city_id'] 							= $val['city_id'];
								$datasearchperpetrator[$key]['city_name'] 							= $val['city_name'];
								$datasearchperpetrator[$key]['perpetrator_name'] 					= $val['perpetrator_name'];
								$datasearchperpetrator[$key]['perpetrator_address'] 				= $val['perpetrator_address'];
								$datasearchperpetrator[$key]['perpetrator_mobile_phone'] 			= $val['perpetrator_mobile_phone'];
								$datasearchperpetrator[$key]['perpetrator_id_number'] 				= $val['perpetrator_id_number'];
								$datasearchperpetrator[$key]['perpetrator_age'] 					= $val['perpetrator_age'];
								$datasearchperpetrator[$key]['perpetrator_status_name'] 			= $perpetrator_status_name;
								$datasearchperpetrator[$key]['perpetrator_chronology_id'] 			= $dataperpetratorchronology['perpetrator_chronology_id'];
								$datasearchperpetrator[$key]['province_name_chronology'] 			= $dataperpetratorchronology['province_name'];
								$datasearchperpetrator[$key]['city_name_chronology'] 				= $dataperpetratorchronology['city_name'];
								$datasearchperpetrator[$key]['vendor_name_chronology'] 				= $dataperpetratorchronology['vendor_name'];
								$datasearchperpetrator[$key]['perpetrator_chronology_date'] 		= $dataperpetratorchronology['perpetrator_chronology_date'];
								$datasearchperpetrator[$key]['perpetrator_chronology_description'] 	= $dataperpetratorchronology['perpetrator_chronology_description'];
								$datasearchperpetrator[$key]['perpetrator_chronology_created'] 		= $dataperpetratorchronology['created_on'];
								$datasearchperpetrator[$key]['perpetrator_photo_url'] 				= $base_url.'img/'.$dataperpetratorphoto['perpetrator_photo_path'].'/'.$dataperpetratorphoto['perpetrator_photo_name'];
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

							$contentnews[$key]['news_id']				= $val['news_id'];
							$contentnews[$key]['news_title']			= $val['news_title'];
							$contentnews[$key]['news_description']		= $val['news_description'];
							$contentnews[$key]['news_date']				= tgltostring($val['news_date']);
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

			$data = array(
				'region_id'			=> $this->input->post('region_id',true),
				'branch_id'			=> $this->input->post('branch_id',true),
				'vendor_id'			=> $this->input->post('vendor_id',true),
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
								$dataperpetratorupdate[$key]['perpetrator_id'] 						= $val['perpetrator_id'];
								$dataperpetratorupdate[$key]['province_id'] 						= $val['province_id'];
								$dataperpetratorupdate[$key]['province_name'] 						= $val['province_name'];
								$dataperpetratorupdate[$key]['city_id'] 							= $val['city_id'];
								$dataperpetratorupdate[$key]['city_name'] 							= $val['city_name'];
								$dataperpetratorupdate[$key]['perpetrator_name'] 					= $val['perpetrator_name'];
								$dataperpetratorupdate[$key]['perpetrator_chronology_created'] 		= datetimetoview($val['created_on']);
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










		

		

	}
?>