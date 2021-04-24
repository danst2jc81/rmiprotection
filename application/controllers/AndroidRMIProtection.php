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


		public function getDataPerpetrator(){
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
























		public function getInvtWarehouse(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtwarehouse'			=> "",
			);

			if($response["error"] == FALSE){
				$invtwarehouselist = $this->AndroidRMIProtection_model->getInvtWarehouse();

				if(!$invtwarehouselist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtwarehouselist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtwarehouselist as $key => $val) {
							$invtwarehouse[$key]['warehouse_id']			= $val['warehouse_id'];
							$invtwarehouse[$key]['warehouse_code'] 			= $val['warehouse_code'];
							$invtwarehouse[$key]['warehouse_name'] 			= $val['warehouse_name'];
							$invtwarehouse[$key]['warehouse_phone'] 		= $val['warehouse_phone'];
							$invtwarehouse[$key]['warehouse_address'] 		= $val['warehouse_address'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtwarehouse'] 			= $invtwarehouse;
					}
				}
			}
			echo json_encode($response);
		}

		public function getCoreMachine(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'coremachine'			=> "",
			);

			$data = array(
				'warehouse_id'		=> $this->input->post('warehouse_id',true),
			);

			$data = array(
				'warehouse_id'		=> $this->input->post('warehouse_id',true),
			);

			if($response["error"] == FALSE){
				$coremachinelist = $this->AndroidRMIProtection_model->getCoreMachine($data['warehouse_id']);

				if(!$coremachinelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($coremachinelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($coremachinelist as $key => $val) {
							$coremachine[$key]['machine_id']			= $val['machine_id'];
							$coremachine[$key]['machine_code'] 			= $val['machine_code'];
							$coremachine[$key]['machine_name'] 			= $val['machine_name'];
							$coremachine[$key]['warehouse_id'] 			= $val['warehouse_id'];
							$coremachine[$key]['warehouse_name'] 		= $val['warehouse_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['coremachine'] 			= $coremachine;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItem_All(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemall'			=> "",
			);

			if($response["error"] == FALSE){
				$invtitemlist = $this->AndroidRMIProtection_model->getInvtItem_All();

				if(!$invtitemlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemlist as $key => $val) {
							$invtitemall[$key]['item_category_id']		= $val['item_category_id'];
							$invtitemall[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitemall[$key]['item_id'] 				= $val['item_id'];
							$invtitemall[$key]['item_name'] 			= $val['item_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemall'] 			= $invtitemall;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItemCategory(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemcategory'		=> "",
			);

			if($response["error"] == FALSE){
				$invtitemcategorylist = $this->AndroidRMIProtection_model->getInvtItemCategory();

				if(!$invtitemcategorylist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemcategorylist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemcategorylist as $key => $val) {
							$invtitemcategory[$key]['item_category_id']		= $val['item_category_id'];
							$invtitemcategory[$key]['item_category_name'] 	= $val['item_category_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemcategory'] 		= $invtitemcategory;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItem(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitem'				=> "",
			);

			$data = array(
				'item_category_id'		=> $this->input->post('item_category_id',true),
			);

			if($response["error"] == FALSE){
				$invtitemlist = $this->AndroidRMIProtection_model->getInvtItem($data['item_category_id']);

				if(!$invtitemlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemlist as $key => $val) {
							$invtitem[$key]['item_category_id']		= $val['item_category_id'];
							$invtitem[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitem[$key]['item_id'] 				= $val['item_id'];
							$invtitem[$key]['item_name'] 			= $val['item_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitem'] 				= $invtitem;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItemUnit(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemunit'			=> "",
			);

			if($response["error"] == FALSE){
				$invtitemunitlist = $this->AndroidRMIProtection_model->getInvtItemUnit();

				if(!$invtitemunitlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemunitlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemunitlist as $key => $val) {
							$invtitemunit[$key]['item_unit_id'] 		= $val['item_unit_id'];
							$invtitemunit[$key]['item_unit_name'] 		= $val['item_unit_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemunit'] 			= $invtitemunit;
					}
				}
			}
			echo json_encode($response);
		}

		public function processAddProductionResult(){
			$data = array (
				'warehouse_id'				=> $this->input->post('warehouse_id',true),
				'machine_id'				=> $this->input->post('machine_id',true),
				'user_id'					=> $this->input->post('user_id',true),
				'production_result_date'	=> tgltodb($this->input->post('production_result_date',true)),
				'production_result_remark'	=> $this->input->post('production_result_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_registrationtenant = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_registrationtenant as $keyProductionResult => $valProductionResult){
				$data_item[$keyProductionResult] = array(
					'item_category_id'				=>	$valProductionResult['item_category_id'],
					'item_id'						=>	$valProductionResult['item_id'],
					'item_unit_id'					=>	$valProductionResult['item_unit_id'],
					'quantity'						=>	$valProductionResult['quantity'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					$total_item 		= $total_item + $valItem['quantity'];
				}

				$data_registrationtenant = array(
					'warehouse_id'						=> $data['warehouse_id'],
					'machine_id'						=> $data['machine_id'],
					'production_result_date'			=> $data['production_result_date'],
					'production_result_remark'			=> $this->input->post('production_result_remark',true),
					'total_item'						=> $total_item,
					'data_state'						=> 0,
					'created_id' 						=> $data['user_id'],
					'created_on' 						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidRMIProtection_model->insertProductionResult($data_registrationtenant)){
					$production_result_id = $this->AndroidRMIProtection_model->getProductionResultID($data_registrationtenant['created_id']);

					foreach($data_item as $key => $val){
						$data_registrationtenantitem = array (
							'production_result_id'				=> $production_result_id,
							'item_category_id'					=> $val['item_category_id'],
							'item_id'							=> $val['item_id'],
							'item_unit_id'						=> $val['item_unit_id'],
							'quantity'							=> $val['quantity'],
							'data_state'						=> 0,
							'created_id' 						=> $data['user_id'],
							'created_on' 						=> date("Y-m-d H:i:s"),
						);
						
						$this->AndroidRMIProtection_model->insertProductionResultItem($data_registrationtenantitem);
					}
				}

				$response['error_registrationtenant']		 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["production_result_id"] 			= $production_result_id;
			}
			
			echo json_encode($response);
		}	

		public function getAcctExpense(){
			$auth 			= $this->session->userdata('auth');
			$data = array(
				'database'			=> $this->input->post('database',true),
				'user_id'			=> $this->input->post('user_id',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'acctexpense'			=> "",
			);			

			if($response["error"] == FALSE){
				$acctexpenselist 	= $this->AndroidRMIProtection_model->getAcctExpense();

				if(!$acctexpenselist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctexpenselist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
							$acctexpense[0]['expense_id']			= 0;
							$acctexpense[0]['expense_name']			= '';
							$acctexpense[0]['account_id']			= 0;
						foreach ($acctexpenselist as $key => $val) {
							$acctexpense[$key]['expense_id']			= $val['expense_id'];
							$acctexpense[$key]['expense_name']		= $val['expense_name'];
							$acctexpense[$key]['account_id']			= $val['account_id'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['acctexpense'] 			= $acctexpense;
					}
				}
			}
			
			echo json_encode($response);
		}

		public function getAcctDisbursement(){
			$data = array(
				'user_id'		=> $this->input->post('user_id',true),
				'start_date'	=> $this->input->post('start_date',true),
				'end_date'		=> $this->input->post('end_date',true),				
			);

			/* $data = array(
				'user_id'		=> 1,
				'start_date'	=> '2020-08-01',
				'end_date'		=> '2020-08-10',				
			);

			print_r("data ");
			print_r($data);
			print_r("<BR> "); */

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'acctdisbursement'			=> "",
			);			

			if($response["error"] == FALSE){
				$acctdisbursementlist 	= $this->AndroidRMIProtection_model->getAcctDisbursement($data['start_date'], $data['end_date']);

				/* print_r("acctdisbursementlist ");
				print_r($acctdisbursementlist);
				print_r("<BR> "); */

				if(!$acctdisbursementlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($acctdisbursementlist as $key => $val) {
							$acctdisbursement[$key]['disbursement_id']				= $val['disbursement_id'];
							$acctdisbursement[$key]['disbursement_amount_total']	= nominal($val['disbursement_amount_total']);
							$acctdisbursement[$key]['expense_name']					= $val['expense_name'];
							$acctdisbursement[$key]['disbursement_date']			= tgltoview($val['disbursement_date']);

							$acctdisbursementitemlist = $this->AndroidRMIProtection_model->getAcctDisbursementItem_Detail($val['disbursement_id']);

							$acct_disbursement_item_list = "";

							foreach ($acctdisbursementitemlist as $keyItem => $valItem) {
								$acctdisbursement[$key]['detail_item'][$keyItem]['disbursement_item_title']		= $valItem['disbursement_item_title'];
								$acctdisbursement[$key]['detail_item'][$keyItem]['disbursement_item_amount']	= nominal($valItem['disbursement_item_amount']);
							}
						}
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['acctdisbursement'] 			= $acctdisbursement;
					}
				}
			}
			
			echo json_encode($response);
		}

		public function processAddAcctDisbursement(){
			$response = array(
				'error'									=> FALSE,
				'error_acctdisbursement'				=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_disbursement = array(
				'expense_id'					=> $this->input->post('expense_id', true),
				'disbursement_date'				=> tgltodb($this->input->post('disbursement_date', true)),
				'disbursement_title'			=> $this->input->post('disbursement_item_title', true),
				'disbursement_amount_total'		=> $this->input->post('disbursement_item_amount', true),
				'created_id'					=> $this->input->post('user_id', true),
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			/* $data_disbursement = array(
				'expense_id'					=> 1,
				'disbursement_date'				=> date("Y-m-d"),
				'disbursement_amount_total'		=> 100000,
				'created_id'					=> 3,
				'created_on'					=> date("Y-m-d H:i:s"),
			); */

			$data_disbursement_item = array(
				'disbursement_item_title'		=> $this->input->post('disbursement_item_title', true),
				'disbursement_item_amount'		=> $this->input->post('disbursement_item_amount', true),
			);

			/* $data_disbursement_item = array(
				'disbursement_item_title'		=> 'text',
				'disbursement_item_amount'		=> 100000,
			); */

			if($response["error_acctdisbursement"] == FALSE){
				if(!empty($data_disbursement)){					
					if ($this->AndroidRMIProtection_model->insertAcctDisbursement($data_disbursement)){
						$disbursement_id = $this->AndroidRMIProtection_model->getDisbursementID($data_disbursement['created_id']);

						$data_item = array(
							'disbursement_id'				=> $disbursement_id,
							'disbursement_item_title'		=> $data_disbursement_item['disbursement_item_title'],
							'disbursement_item_amount'		=> $data_disbursement_item['disbursement_item_amount'],
						);

						if($this->AndroidRMIProtection_model->insertAcctDisbursementItem($data_item)){
							
						}

						$response['error_acctdisbursement'] 	= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['disbursement_id']			=  $disbursement_id;
					} else {
						$response['error_acctdisbursement'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddInvtWarehouse(){
			$response = array(
				'error'									=> FALSE,
				'error_invtwarehouse'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_warehouse = array(
				'warehouse_code'		=> $this->input->post('warehouse_code', true),
				'warehouse_name'		=> $this->input->post('warehouse_name', true),
				'warehouse_phone'		=> $this->input->post('warehouse_phone', true),
				'warehouse_address'		=> $this->input->post('warehouse_address', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			if($response["error_invtwarehouse"] == FALSE){
				if(!empty($data_warehouse)){					
					if ($this->AndroidRMIProtection_model->insertInvtWarehouse($data_warehouse)){

						$response['error_invtwarehouse'] 		= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_invtwarehouse'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddCoreMachine(){
			$response = array(
				'error'									=> FALSE,
				'error_coremachine'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_machine = array(
				'warehouse_id'			=> $this->input->post('warehouse_id', true),
				'machine_code'			=> $this->input->post('machine_code', true),
				'machine_name'			=> $this->input->post('machine_name', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			/* $data_machine = array(
				'warehouse_id'			=> 2,
				'machine_code'			=> 'MESIN1',
				'machine_name'			=> 'MESIN 1',
				'created_id'			=> 1,
				'created_on'			=> date("Y-m-d H:i:s"),
			); */



			if($response["error_coremachine"] == FALSE){
				if(!empty($data_machine)){					
					if ($this->AndroidRMIProtection_model->insertCoreMachine($data_machine)){

						$response['error_coremachine'] 		= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_coremachine'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddAcctExpense(){
			$response = array(
				'error'									=> FALSE,
				'error_acctexpense'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_expense = array(
				'expense_name'			=> $this->input->post('expense_name', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			/* $data_machine = array(
				'warehouse_id'			=> 2,
				'machine_code'			=> 'MESIN1',
				'machine_name'			=> 'MESIN 1',
				'created_id'			=> 1,
				'created_on'			=> date("Y-m-d H:i:s"),
			); */



			if($response["error_acctexpense"] == FALSE){
				if(!empty($data_expense)){					
					if ($this->AndroidRMIProtection_model->insertAcctExpense($data_expense)){

						$response['error_acctexpense'] 			= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_acctexpense'] 			= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function getSalesDeliveryNote(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'salesdeliverynote'				=> "",
			);

			$data = array(
				'warehouse_check'		=> $this->input->post('warehouse_check',true),
				'machine_check'			=> $this->input->post('machine_check',true),
				'item_check'			=> $this->input->post('item_check',true),
				'period_date_check'		=> $this->input->post('period_date_check',true),
				'warehouse_id'			=> $this->input->post('warehouse_id',true),
				'machine_id'			=> $this->input->post('machine_id',true),				
				'item_id'				=> $this->input->post('item_id',true),				
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
			);

			$data['period_date_check'] = 0;

			if ($data['period_date_check'] == 0){
				$start_date 	= date("Y-m-01");
				$end_date 		= date("Y-m-d");
			} else {
				$start_date 	= $data['start_date'];
				$end_date 		= $data['end_date'];
			}

			/* print_r("start_date ");
			print_r($start_date);
			print_r("<BR>");

			print_r("end_date ");
			print_r($end_date);
			print_r("<BR>"); */

			if($response["error"] == FALSE){
				$salesdeliverynotelist 	= $this->AndroidRMIProtection_model->getSalesDeliveryNote($data, $start_date, $end_date);

				/* print_r("salesyearlymonthlylist ");
				print_r($salesyearlymonthlylist);
				print_r("<BR> "); */
				/* exit; */

				if(!$salesdeliverynotelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynotelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($salesdeliverynotelist)){
							foreach ($salesdeliverynotelist as $key => $val) {

								$salesdeliverynote[$key]['sales_delivery_note_id'] 		= $val['sales_delivery_note_id'];
								$salesdeliverynote[$key]['sales_delivery_note_no'] 		= $val['sales_delivery_note_no'];
								$salesdeliverynote[$key]['customer_id'] 				= $val['customer_id'];
								$salesdeliverynote[$key]['customer_name'] 				= $val['customer_name'];
								$salesdeliverynote[$key]['sales_delivery_note_date'] 	= tgltoview($val['sales_delivery_note_date']);
		
								$salesdeliverynoteitemlist = $this->AndroidRMIProtection_model->getSalesDeliveryNoteItem_Detail($val['sales_delivery_note_id'], $data['item_check'], $data['item_id']);

								$sales_delivery_note_item_list = "";

								foreach ($salesdeliverynoteitemlist as $keyItem => $valItem) {
									$salesdeliverynote[$key]['detail_item'][$keyItem]['item_name']			= $valItem['item_name'];
									$salesdeliverynote[$key]['detail_item'][$keyItem]['quantity']			= nominal($valItem['quantity']);
									$salesdeliverynote[$key]['detail_item'][$keyItem]['item_unit_name']			= $valItem['item_unit_name'];
								}
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['salesdeliverynote'] 				= $salesdeliverynote;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesCustomer(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'salescustomer'			=> "",
			);

			if($response["error"] == FALSE){
				$salescustomerlist = $this->AndroidRMIProtection_model->getSalesCustomer();

				if(!$salescustomerlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salescustomerlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($salescustomerlist as $key => $val) {
							$salescustomer[$key]['customer_id']			= $val['customer_id'];
							$salescustomer[$key]['customer_name'] 		= $val['customer_name'];
							$salescustomer[$key]['customer_address'] 	= $val['customer_address'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['salescustomer'] 			= $salescustomer;
					}
				}
			}
			echo json_encode($response);
		}

		public function processAddSalesDeliveryNote(){
			$data = array (
				'customer_id'					=> $this->input->post('customer_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'sales_delivery_note_date'		=> tgltodb($this->input->post('sales_delivery_note_date',true)),
				'sales_delivery_note_remark'	=> $this->input->post('sales_delivery_note_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_deliverynote = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_deliverynote as $keyDeliveryNote => $valDeliveryNote){
				$data_item[$keyDeliveryNote] = array(
					'item_category_id'				=>	$valDeliveryNote['item_category_id'],
					'item_id'						=>	$valDeliveryNote['item_id'],
					'item_unit_id'					=>	$valDeliveryNote['item_unit_id'],
					'quantity'						=>	$valDeliveryNote['quantity'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					$total_item 		= $total_item + $valItem['quantity'];
				}

				$data_deliverynote = array(
					'customer_id'						=> $data['customer_id'],
					'sales_delivery_note_date'			=> $data['sales_delivery_note_date'],
					'sales_delivery_note_remark'		=> $this->input->post('sales_delivery_note_remark',true),
					'total_item'						=> $total_item,
					'data_state'						=> 0,
					'created_id' 						=> $data['user_id'],
					'created_on' 						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidRMIProtection_model->insertSalesDeliveryNote($data_deliverynote)){
					$sales_delivery_note_id = $this->AndroidRMIProtection_model->getSalesDeliveryNoteID($data_deliverynote['created_id']);

					foreach($data_item as $key => $val){
						$data_deliverynoteitem = array (
							'sales_delivery_note_id'			=> $sales_delivery_note_id,
							'item_category_id'					=> $val['item_category_id'],
							'item_id'							=> $val['item_id'],
							'item_unit_id'						=> $val['item_unit_id'],
							'quantity'							=> $val['quantity'],
							'data_state'						=> 0,
							'created_id' 						=> $data['user_id'],
							'created_on' 						=> date("Y-m-d H:i:s"),
						);
						
						$this->AndroidRMIProtection_model->insertSalesDeliveryNoteItem($data_deliverynoteitem);
					}
				}

				$response['error_deliverynote']			 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["sales_delivery_note_id"] 		= $sales_delivery_note_id;
			}
			
			echo json_encode($response);
		}

		public function getProductionResultDetail(){
			$base_url = base_url();

			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'registrationtenantdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$registrationtenantdetaillist = $this->AndroidRMIProtection_model->getProductionResultDetail($data['production_result_id']);

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
						$registrationtenantdetail[0]['production_result_id']	= $registrationtenantdetaillist['production_result_id'];
						$registrationtenantdetail[0]['warehouse_id'] 			= $registrationtenantdetaillist['warehouse_id'];
						$registrationtenantdetail[0]['warehouse_name'] 		= $registrationtenantdetaillist['warehouse_name'];
						$registrationtenantdetail[0]['machine_id'] 			= $registrationtenantdetaillist['machine_id'];
						$registrationtenantdetail[0]['machine_name'] 			= $registrationtenantdetaillist['machine_name'];
						$registrationtenantdetail[0]['production_result_date'] = tgltoview($registrationtenantdetaillist['production_result_date']);
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['registrationtenantdetail'] = $registrationtenantdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getProductionResultItemDetail(){
			$base_url = base_url();

			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'registrationtenantitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$registrationtenantitemdetaillist = $this->AndroidRMIProtection_model->getProductionResultItemDetail($data['production_result_id']);

				if(!$registrationtenantitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($registrationtenantitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($registrationtenantitemdetaillist as $key => $val) {
							$registrationtenantitemdetail[$key]['production_result_item_id']	= $val['production_result_item_id'];
							$registrationtenantitemdetail[$key]['item_category_id'] 			= $val['item_category_id'];
							$registrationtenantitemdetail[$key]['item_category_name'] 		= $val['item_category_name'];
							$registrationtenantitemdetail[$key]['item_id'] 					= $val['item_id'];
							$registrationtenantitemdetail[$key]['item_name'] 					= $val['item_name'];
							$registrationtenantitemdetail[$key]['item_unit_id'] 				= $val['item_unit_id'];
							$registrationtenantitemdetail[$key]['item_unit_name'] 			= $val['item_unit_name'];
							$registrationtenantitemdetail[$key]['quantity'] 					= $val['quantity'];
						}
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['registrationtenantitemdetail'] = $registrationtenantitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesDeliveryNoteDetail(){
			$base_url = base_url();

			$data = array (
				'sales_delivery_note_id'			=> $this->input->post('sales_delivery_note_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'salesdeliverynotedetail'	=> "",
			);

			if($response["error"] == FALSE){
				$salesdeliverynotedetaillist = $this->AndroidRMIProtection_model->getSalesDeliveryNoteDetail($data['sales_delivery_note_id']);

				if(!$salesdeliverynotedetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynotedetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$salesdeliverynotedetail[0]['sales_delivery_note_id']		= $salesdeliverynotedetaillist['sales_delivery_note_id'];
						$salesdeliverynotedetail[0]['sales_delivery_note_no'] 		= $salesdeliverynotedetaillist['sales_delivery_note_no'];
						$salesdeliverynotedetail[0]['customer_id'] 					= $salesdeliverynotedetaillist['customer_id'];
						$salesdeliverynotedetail[0]['customer_name'] 				= $salesdeliverynotedetaillist['customer_name'];
						$salesdeliverynotedetail[0]['sales_delivery_note_date'] 	= tgltoview($salesdeliverynotedetaillist['sales_delivery_note_date']);
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['salesdeliverynotedetail'] 	= $salesdeliverynotedetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesDeliveryNoteItemDetail(){
			$base_url = base_url();

			$data = array (
				'sales_delivery_note_id'			=> $this->input->post('sales_delivery_note_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'salesdeliverynoteitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$salesdeliverynoteitemdetaillist = $this->AndroidRMIProtection_model->getSalesDeliveryNoteItemDetail($data['sales_delivery_note_id']);

				if(!$salesdeliverynoteitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynoteitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($salesdeliverynoteitemdetaillist as $key => $val) {
							$salesdeliverynoteitemdetail[$key]['sales_delivery_note_item_id']	= $val['sales_delivery_note_item_id'];
							$salesdeliverynoteitemdetail[$key]['item_category_id'] 				= $val['item_category_id'];
							$salesdeliverynoteitemdetail[$key]['item_category_name'] 			= $val['item_category_name'];
							$salesdeliverynoteitemdetail[$key]['item_id'] 						= $val['item_id'];
							$salesdeliverynoteitemdetail[$key]['item_name'] 					= $val['item_name'];
							$salesdeliverynoteitemdetail[$key]['item_unit_id'] 					= $val['item_unit_id'];
							$salesdeliverynoteitemdetail[$key]['item_unit_name'] 				= $val['item_unit_name'];
							$salesdeliverynoteitemdetail[$key]['quantity'] 						= $val['quantity'];
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['salesdeliverynoteitemdetail'] 	= $salesdeliverynoteitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getAcctDisbursementDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'acctdisbursementdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementdetaillist = $this->AndroidRMIProtection_model->getAcctDisbursementDetail($data['disbursement_id']);

				if(!$acctdisbursementdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$acctdisbursementdetail[0]['disbursement_id']		= $acctdisbursementdetaillist['disbursement_id'];
						$acctdisbursementdetail[0]['expense_id'] 			= $acctdisbursementdetaillist['expense_id'];
						$acctdisbursementdetail[0]['expense_name'] 			= $acctdisbursementdetaillist['expense_name'];
						$acctdisbursementdetail[0]['disbursement_date'] 	= tgltoview($acctdisbursementdetaillist['disbursement_date']);
						$acctdisbursementdetail[0]['disbursement_title'] 	= $acctdisbursementdetaillist['disbursement_title'];
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['acctdisbursementdetail'] 	= $acctdisbursementdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getAcctDisbursementItemDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'acctdisbursementitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementitemdetaillist = $this->AndroidRMIProtection_model->getAcctDisbursementItemDetail($data['disbursement_id']);

				if(!$acctdisbursementitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($acctdisbursementitemdetaillist as $key => $val) {
							$acctdisbursementitemdetail[$key]['disbursement_item_id']					= $val['disbursement_item_id'];
							$acctdisbursementitemdetail[$key]['disbursement_item_title'] 	= $val['disbursement_item_title'];
							$acctdisbursementitemdetail[$key]['disbursement_item_amount'] 	= number_format($val['disbursement_item_amount'], 2);
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['acctdisbursementitemdetail'] 	= $acctdisbursementitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function processVoidSalesDeliveryNote(){
			$data = array (
				'user_id'					=> $this->input->post('user_id',true),
				'sales_delivery_note_id'	=> $this->input->post('sales_delivery_note_id',true),
				'voided_remark'				=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deletesalesdeliverynote = array(
					'sales_delivery_note_id'	=> $data['sales_delivery_note_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidRMIProtection_model->voidSalesDeliveryNote($data_deletesalesdeliverynote)){
					
				}

				$response['error_deletesalesdeliverynote']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}	

		public function processVoidProductionResult(){
			$data = array (
				'user_id'					=> $this->input->post('user_id',true),
				'production_result_id'		=> $this->input->post('production_result_id',true),
				'voided_remark'				=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deleteregistrationtenant = array(
					'production_result_id'		=> $data['production_result_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidRMIProtection_model->voidProductionResult($data_deleteregistrationtenant)){
					
				}

				$response['error_deleteregistrationtenant']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}

		public function processVoidAcctDisbursement(){
			$data = array (
				'user_id'			=> $this->input->post('user_id',true),
				'disbursement_id'	=> $this->input->post('disbursement_id',true),
				'voided_remark'		=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deleteacctdisbursement = array(
					'disbursement_id'			=> $data['disbursement_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidRMIProtection_model->voidAcctDisbursement($data_deleteacctdisbursement)){
					
				}

				$response['error_deleteacctdisbursement']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}


		public function processEditSalesDeliveryNote(){
			$data = array (
				'sales_delivery_note_id'		=> $this->input->post('sales_delivery_note_id',true),
				'customer_id'					=> $this->input->post('customer_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'sales_delivery_note_date'		=> tgltodb($this->input->post('sales_delivery_note_date',true)),
				'sales_delivery_note_remark'	=> $this->input->post('sales_delivery_note_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_deliverynote = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_deliverynote as $keyDeliveryNote => $valDeliveryNote){
				$data_item[$keyDeliveryNote] = array(
					'sales_delivery_note_item_id'	=>	$valDeliveryNote['record_id'],
					'item_category_id'				=>	$valDeliveryNote['item_category_id'],
					'item_id'						=>	$valDeliveryNote['item_id'],
					'item_unit_id'					=>	$valDeliveryNote['item_unit_id'],
					'quantity'						=>	$valDeliveryNote['quantity'],
					'item_status'					=>	$valDeliveryNote['data_state'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					if ($valItem['item_status'] != 2){
						$total_item 		= $total_item + $valItem['quantity'];
					}
				}

				$data_deliverynote = array(
					'sales_delivery_note_id'			=> $data['sales_delivery_note_id'],
					'customer_id'						=> $data['customer_id'],
					'sales_delivery_note_date'			=> $data['sales_delivery_note_date'],
					'sales_delivery_note_remark'		=> $this->input->post('sales_delivery_note_remark',true),
					'total_item'						=> $total_item,
					'created_on'						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidRMIProtection_model->updateSalesDeliveryNote($data_deliverynote)){

					foreach($data_item as $key => $val){
						$data_salesdeliverynoteitem = array(
							'sales_delivery_note_id'	=> $data['sales_delivery_note_id'],
							'item_category_id'			=> $val['item_category_id'],
							'item_id'					=> $val['item_id'],
							'quantity'					=> $val['quantity'],
							'item_unit_id'				=> $val['item_unit_id'],
							'created_id'				=> $data['user_id'],
							'created_on'				=> date("Y-m-d H:i:s"),
							'item_status'				=> $val['item_status'],
						);

						if ($val['item_status'] == 1){
							if ($this->AndroidRMIProtection_model->insertSalesDeliveryNoteItem($data_salesdeliverynoteitem)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_salesdeliverynoteitem['sales_delivery_note_id'], '5111', 'SalesDeliveryNote.processAddSalesDeliveryNoteItem', 'Add New Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}

						} else if ($val['item_status'] == 2){
							$data_delete = array (
								'sales_delivery_note_item_id'	=> $val['sales_delivery_note_item_id'],
								'item_category_id'				=> $val['item_category_id'],
								'item_id'						=> $val['item_id'],
								'quantity'						=> $val['quantity'],
								'item_status'					=> $val['item_status'],
								'data_state'					=> 2,
								'voided_id'						=> $data['user_id'],
								'voided_on'						=> date("Y-m-d H:i:s"),
							);

							if ($this->AndroidRMIProtection_model->voidSalesDeliveryNoteItem($data_delete)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_delete['sales_delivery_note_item_id'], '5112', 'SalesDeliveryNoteItem.processVoidSalesDeliveryNoteItem', 'Void Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}
						} 
					}
				}

				$response['error_deliverynote']			 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["sales_delivery_note_id"] 		= $data['sales_delivery_note_id'];
			}
			
			echo json_encode($response);
		}


		public function processEditProductionResult(){
			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
				'warehouse_id'					=> $this->input->post('warehouse_id',true),
				'machine_id'					=> $this->input->post('machine_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'production_result_date'		=> tgltodb($this->input->post('production_result_date',true)),
				'production_result_remark'		=> $this->input->post('production_result_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_registrationtenant = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_registrationtenant as $keyProductionResult => $valProductionResult){
				$data_item[$keyProductionResult] = array(
					'production_result_item_id'		=>	$valProductionResult['record_id'],
					'item_category_id'				=>	$valProductionResult['item_category_id'],
					'item_id'						=>	$valProductionResult['item_id'],
					'item_unit_id'					=>	$valProductionResult['item_unit_id'],
					'quantity'						=>	$valProductionResult['quantity'],
					'item_status'					=>	$valProductionResult['data_state'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					if ($valItem['item_status'] != 2){
						$total_item 		= $total_item + $valItem['quantity'];
					}
				}

				$data_registrationtenant = array(
					'production_result_id'			=> $data['production_result_id'],
					'warehouse_id'					=> $data['warehouse_id'],
					'machine_id'					=> $data['machine_id'],
					'production_result_date'		=> $data['production_result_date'],
					'production_result_remark'		=> $this->input->post('production_result_remark',true),
					'total_item'					=> $total_item,
					'created_on'					=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidRMIProtection_model->updateProductionResult($data_registrationtenant)){

					foreach($data_item as $key => $val){
						$data_registrationtenantitem = array(
							'production_result_id'		=> $data['production_result_id'],
							'item_category_id'			=> $val['item_category_id'],
							'item_id'					=> $val['item_id'],
							'quantity'					=> $val['quantity'],
							'item_unit_id'				=> $val['item_unit_id'],
							'created_id'				=> $data['user_id'],
							'created_on'				=> date("Y-m-d H:i:s"),
							'item_status'				=> $val['item_status'],
						);

						if ($val['item_status'] == 1){
							if ($this->AndroidRMIProtection_model->insertProductionResultItem($data_registrationtenantitem)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_salesdeliverynoteitem['sales_delivery_note_id'], '5111', 'SalesDeliveryNote.processAddSalesDeliveryNoteItem', 'Add New Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}

						} else if ($val['item_status'] == 2){
							$data_delete = array (
								'production_result_item_id'		=> $val['production_result_item_id'],
								'item_category_id'				=> $val['item_category_id'],
								'item_id'						=> $val['item_id'],
								'quantity'						=> $val['quantity'],
								'item_status'					=> $val['item_status'],
								'data_state'					=> 2,
								'voided_id'						=> $data['user_id'],
								'voided_on'						=> date("Y-m-d H:i:s"),
							);

							if ($this->AndroidRMIProtection_model->voidProductionResultItem($data_delete)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_delete['sales_delivery_note_item_id'], '5112', 'SalesDeliveryNoteItem.processVoidSalesDeliveryNoteItem', 'Void Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}
						} 
					}
				}

				$response['error_registrationtenant']	 	= FALSE;
				$response['error_msg_title'] 			= "Success";
				$response['error_msg'] 					= "Data Saved";
				$response["production_result_id"] 		= $data['production_result_id'];
			}
			
			echo json_encode($response);
		}

		public function getUpdateAcctDisbursementDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'updateacctdisbursementdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementdetaillist = $this->AndroidRMIProtection_model->getUpdateAcctDisbursementDetail($data['disbursement_id']);

				if(!$acctdisbursementdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$updateacctdisbursementdetail[0]['disbursement_id']				= $acctdisbursementdetaillist['disbursement_id'];
						$updateacctdisbursementdetail[0]['expense_id'] 					= $acctdisbursementdetaillist['expense_id'];
						$updateacctdisbursementdetail[0]['expense_name'] 				= $acctdisbursementdetaillist['expense_name'];
						$updateacctdisbursementdetail[0]['disbursement_date'] 			= tgltoview($acctdisbursementdetaillist['disbursement_date']);
						$updateacctdisbursementdetail[0]['disbursement_title'] 			= $acctdisbursementdetaillist['disbursement_title'];
						$updateacctdisbursementdetail[0]['disbursement_item_title'] 	= $acctdisbursementdetaillist['disbursement_item_title'];
						$updateacctdisbursementdetail[0]['disbursement_item_amount'] 	= $acctdisbursementdetaillist['disbursement_item_amount'];
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['updateacctdisbursementdetail'] 	= $updateacctdisbursementdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function processEditAcctDisbursement(){
			$response = array(
				'error'									=> FALSE,
				'error_acctdisbursement'				=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_acctdisbursement = array(
				'disbursement_id'				=> $this->input->post('disbursement_id', true),
				'expense_id'					=> $this->input->post('expense_id', true),
				'disbursement_date'				=> tgltodb($this->input->post('disbursement_date', true)),
				'disbursement_title'			=> $this->input->post('disbursement_item_title', true),
				'disbursement_amount_total'		=> $this->input->post('disbursement_item_amount', true),
			);

			$data_acctdisbursementitem = array(
				'disbursement_id'				=> $data_acctdisbursement['disbursement_id'],
				'disbursement_item_title'		=> $this->input->post('disbursement_item_title', true),
				'disbursement_item_amount'		=> $this->input->post('disbursement_item_amount', true),
			);

			/* $data_disbursement_item = array(
				'disbursement_item_title'		=> 'text',
				'disbursement_item_amount'		=> 100000,
			); */

			if($response["error_acctdisbursement"] == FALSE){
				if(!empty($data_acctdisbursement)){					
					if ($this->AndroidRMIProtection_model->updateAcctDisbursement($data_acctdisbursement)){
						$data_item = array(
							'disbursement_id'				=> $data_acctdisbursement['disbursement_id'],
							'disbursement_item_title'		=> $data_acctdisbursementitem['disbursement_item_title'],
							'disbursement_item_amount'		=> $data_acctdisbursementitem['disbursement_item_amount'],
						);

						if($this->AndroidRMIProtection_model->updateAcctDisbursementItem($data_item)){
							
						}

						$response['error_acctdisbursement'] 	= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_acctdisbursement'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function getInvtItemStock(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemstock'			=> "",
			);

			$data = array(
				'item_category_id'				=> $this->input->post('item_category_id', true),
			);

			/* $data = array(
				'item_category_id'				=> 2,
			); */

			if($response["error"] == FALSE){
				$invtitemstocklist = $this->AndroidRMIProtection_model->getInvtItemStock($data['item_category_id']);

				/* print_r("invtitemstocklist ");
				print_r($invtitemstocklist);
				exit; */

				if(!$invtitemstocklist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemstocklist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemstocklist as $key => $val) {
							$invtitemstock[$key]['item_category_id']	= $val['item_category_id'];
							$invtitemstock[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitemstock[$key]['item_id']				= $val['item_id'];
							$invtitemstock[$key]['item_name'] 			= $val['item_name'];
							$invtitemstock[$key]['item_unit_id']		= $val['item_unit_id'];
							$invtitemstock[$key]['item_unit_code']		= $val['item_unit_code'];
							$invtitemstock[$key]['last_balance']		= $val['last_balance'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemstock'] 			= $invtitemstock;
					}
				}
			}
			echo json_encode($response);
		}

		

	}
?>