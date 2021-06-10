<?php
	class AndroidRMIProtection_model extends CI_Model {
		var $table = "acct_account";
		
		public function AndroidRMIProtection_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getRegistrationTenant($region_id, $branch_id, $vendor_id, $tenant_status){
			$this->db->select('registration_tenant.tenant_id, registration_tenant.region_id, core_region.region_name, registration_tenant.branch_id, core_branch.branch_name, registration_tenant.vendor_id, core_vendor.vendor_name, registration_tenant.province_id, core_province.province_name, registration_tenant.city_id, core_city.city_name, registration_tenant.tenant_name, registration_tenant.tenant_registration_date, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_profile_photo, registration_tenant.tenant_nik_photo, registration_tenant.tenant_status, registration_tenant.tenant_status_id, registration_tenant.tenant_status_on, registration_tenant.tenant_status_remark');
			$this->db->from('registration_tenant');
			$this->db->join('core_region', 'registration_tenant.region_id = core_region.region_id');
			$this->db->join('core_branch', 'registration_tenant.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'registration_tenant.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'registration_tenant.province_id = core_province.province_id');
			$this->db->join('core_city', 'registration_tenant.city_id = core_city.city_id');
			$this->db->where('registration_tenant.region_id', $region_id);
			$this->db->where('registration_tenant.branch_id', $branch_id);
			$this->db->where('registration_tenant.vendor_id', $vendor_id);

			if ($tenant_status != ''){
				$this->db->where('registration_tenant.tenant_status', $tenant_status);
			}
			$this->db->order_by('registration_tenant.tenant_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreVehicle($vendor_id){
			$this->db->select('core_vehicle.vehicle_id, core_vehicle.vehicle_police_number');
			$this->db->from('core_vehicle');
			$this->db->where('core_vehicle.data_state', 0);
			$this->db->where('core_vehicle.vendor_id', $vendor_id);
			$this->db->where('core_vehicle.vehicle_status', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateTransVehicleRental($data){
			$this->db->where("trans_vehicle_rental.vehicle_rental_id", $data['vehicle_rental_id']);
			$query = $this->db->update('trans_vehicle_rental', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getTransVehicleRental($vendor_id){
			$this->db->select('trans_vehicle_rental.vehicle_rental_id, trans_vehicle_rental.vehicle_id, core_vehicle.vehicle_police_number, trans_vehicle_rental.tenant_id, registration_tenant.tenant_name, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_status, trans_vehicle_rental.vehicle_rental_date, trans_vehicle_rental.vehicle_rental_return_date');
			$this->db->from('trans_vehicle_rental');
			$this->db->join('core_vehicle', 'trans_vehicle_rental.vehicle_id = core_vehicle.vehicle_id');
			$this->db->join('registration_tenant', 'trans_vehicle_rental.tenant_id = registration_tenant.tenant_id');
			$this->db->where('trans_vehicle_rental.vendor_id', $vendor_id);
			$this->db->where('trans_vehicle_rental.vehicle_id <> ', 0);
			$this->db->order_by('trans_vehicle_rental.vehicle_rental_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateRegistrationTenant($data){
			$this->db->where("registration_tenant.tenant_id", $data['tenant_id']);
			$query = $this->db->update('registration_tenant', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateSystemUser($data){
			$this->db->where('system_user.user_id', $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getRegistrationTenant_Detail($tenant_id){
			$this->db->select('registration_tenant.tenant_id, registration_tenant.region_id, core_region.region_name, registration_tenant.branch_id, core_branch.branch_name, registration_tenant.vendor_id, core_vendor.vendor_name, registration_tenant.province_id, core_province.province_name, registration_tenant.city_id, core_city.city_name, registration_tenant.tenant_name, registration_tenant.tenant_registration_date, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_profile_photo, registration_tenant.tenant_nik_photo, registration_tenant.tenant_status, registration_tenant.tenant_status_id, registration_tenant.tenant_status_on, registration_tenant.tenant_status_remark');
			$this->db->from('registration_tenant');
			$this->db->join('core_region', 'registration_tenant.region_id = core_region.region_id');
			$this->db->join('core_branch', 'registration_tenant.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'registration_tenant.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'registration_tenant.province_id = core_province.province_id');
			$this->db->join('core_city', 'registration_tenant.city_id = core_city.city_id');
			$this->db->where('registration_tenant.tenant_id', $tenant_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getSystemUser(){
			$this->db->select('system_user.vendor_id, system_user.user_token');
			$this->db->from('system_user');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getTransVehicleRental_Update($vendor_id){
			$this->db->select('trans_vehicle_rental.vehicle_rental_id, trans_vehicle_rental.vehicle_id, trans_vehicle_rental.tenant_id, registration_tenant.tenant_name, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_status, trans_vehicle_rental.vehicle_rental_date, trans_vehicle_rental.vehicle_rental_return_date');
			$this->db->from('trans_vehicle_rental');
			$this->db->join('registration_tenant', 'trans_vehicle_rental.tenant_id = registration_tenant.tenant_id');
			$this->db->where('trans_vehicle_rental.vendor_id', $vendor_id);
			$this->db->where('trans_vehicle_rental.vehicle_id', 0);
			$this->db->order_by('trans_vehicle_rental.vehicle_rental_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getTransVehicleRental_DetailUpdate($vehicle_rental_id){
			$this->db->select('trans_vehicle_rental.vehicle_rental_id, trans_vehicle_rental.vehicle_id, trans_vehicle_rental.tenant_id, registration_tenant.tenant_name, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_status, trans_vehicle_rental.vehicle_rental_date, trans_vehicle_rental.vehicle_rental_return_date');
			$this->db->from('trans_vehicle_rental');
			$this->db->join('registration_tenant', 'trans_vehicle_rental.tenant_id = registration_tenant.tenant_id');
			$this->db->where('trans_vehicle_rental.vehicle_rental_id', $vehicle_rental_id);
			$this->db->order_by('trans_vehicle_rental.vehicle_rental_id', 'DESC');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getDataPerpetrator(){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.region_id, core_region.region_name, data_perpetrator.branch_id, core_branch.branch_name, data_perpetrator.vendor_id, core_vendor.vendor_name, core_vendor.vendor_contact_person, core_vendor.vendor_phone, data_perpetrator.province_id, core_province.province_name, data_perpetrator.city_id, core_city.city_name, data_perpetrator.province_perpetrator_id, data_perpetrator.city_perpetrator_id, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_mobile_phone, data_perpetrator.perpetrator_id_number, data_perpetrator.perpetrator_age, data_perpetrator.perpetrator_status');
			$this->db->from('data_perpetrator');
			$this->db->join('core_region', 'data_perpetrator.region_id = core_region.region_id');
			$this->db->join('core_branch', 'data_perpetrator.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'data_perpetrator.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'data_perpetrator.province_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_id = core_city.city_id');
			$this->db->where('data_perpetrator.data_state', 0);
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getDataPerpetratorChronology_Perpetrator($perpetrator_id){
			$this->db->select('data_perpetrator_chronology.perpetrator_chronology_id, data_perpetrator_chronology.province_id, core_province.province_name, data_perpetrator_chronology.city_id, core_city.city_name, data_perpetrator_chronology.vendor_id, core_vendor.vendor_name, data_perpetrator_chronology.perpetrator_id, data_perpetrator_chronology.perpetrator_chronology_date, data_perpetrator_chronology.perpetrator_chronology_description, data_perpetrator_chronology.created_on');
			$this->db->from('data_perpetrator_chronology');
			$this->db->join('core_vendor', 'data_perpetrator_chronology.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'data_perpetrator_chronology.province_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator_chronology.city_id = core_city.city_id');
			$this->db->where('data_perpetrator_chronology.data_state', 0);
			$this->db->where('data_perpetrator_chronology.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_chronology.perpetrator_chronology_id', 'ASC');
			$this->db->limit('1');
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getDataPerpetratorPhoto_Perpetrator($perpetrator_id){
			$this->db->select('data_perpetrator_photo.perpetrator_photo_id, data_perpetrator_photo.perpetrator_photo_path, data_perpetrator_photo.perpetrator_photo_name');
			$this->db->from('data_perpetrator_photo');
			$this->db->where('data_perpetrator_photo.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_photo.perpetrator_photo_id', 'ASC');
			$this->db->limit('1');
			$result = $this->db->get()->row_array();
			return $result;
		}		

		public function getCoreProvince(){
			$this->db->select('core_province.province_id, core_province.province_name');
			$this->db->from('core_province');
			$this->db->order_by('core_province.province_name', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getCoreCity($province_id){
			$this->db->select('core_city.province_id, core_province.province_name, core_city.city_id, core_city.city_name');
			$this->db->from('core_city');
			$this->db->join('core_province', 'core_city.province_id = core_province.province_id');
			$this->db->where('core_city.province_id', $province_id);
			$this->db->order_by('core_city.city_name', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getCoreVendor_Detail($vendor_id){
			$this->db->select('core_vendor.province_id, core_vendor.city_id');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.vendor_id', $vendor_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertDataPerpetrator($data){
			if($this->db->insert('data_perpetrator', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getPerpetratorID($created_id){
			$this->db->select('data_perpetrator.perpetrator_id');
			$this->db->from('data_perpetrator');
			$this->db->where('data_perpetrator.created_id', $created_id);
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['perpetrator_id'];
		}

		public function insertDataPerpetratorChronology($data){
			if($this->db->insert('data_perpetrator_chronology', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getVendorCode($vendor_id){
			$this->db->select('core_vendor.vendor_code');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.vendor_id', $vendor_id);
			$result = $this->db->get()->row_array();
			return $result['vendor_code'];
		}

		public function insertDataPerpetratorPhoto($data){
			if($this->db->insert('data_perpetrator_photo', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getDataPerpetratorPhoto_Detail($perpetrator_id){
			$this->db->select('data_perpetrator_photo.perpetrator_photo_id, data_perpetrator_photo.perpetrator_photo_path, data_perpetrator_photo.perpetrator_photo_name');
			$this->db->from('data_perpetrator_photo');
			$this->db->where('data_perpetrator_photo.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_photo.perpetrator_photo_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getDataPerpetratorChronology_Detail($perpetrator_id){
			$this->db->select('data_perpetrator_chronology.perpetrator_chronology_id, data_perpetrator_chronology.perpetrator_id, data_perpetrator_chronology.perpetrator_chronology_description, data_perpetrator_chronology.created_on, core_vendor.vendor_name');
			$this->db->from('data_perpetrator_chronology');
			$this->db->join('core_vendor', 'data_perpetrator_chronology.vendor_id = core_vendor.vendor_id');
			$this->db->where('data_perpetrator_chronology.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_chronology.perpetrator_chronology_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getSearchDataPerpetrator($perpetrator_name){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.region_id, core_region.region_name, data_perpetrator.branch_id, core_branch.branch_name, data_perpetrator.vendor_id, core_vendor.vendor_name, core_vendor.vendor_contact_person, core_vendor.vendor_phone, data_perpetrator.province_id, core_province.province_name, data_perpetrator.city_id, core_city.city_name, data_perpetrator.province_perpetrator_id, data_perpetrator.city_perpetrator_id, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_mobile_phone, data_perpetrator.perpetrator_id_number, data_perpetrator.perpetrator_age, data_perpetrator.perpetrator_status');
			$this->db->from('data_perpetrator');
			$this->db->join('core_region', 'data_perpetrator.region_id = core_region.region_id');
			$this->db->join('core_branch', 'data_perpetrator.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'data_perpetrator.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'data_perpetrator.province_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_id = core_city.city_id');
			$this->db->where('data_perpetrator.data_state', 0);
			$this->db->like('data_perpetrator.perpetrator_name', $perpetrator_name);
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		/*CONTENT EVENT*/
		public function getContentEventList(){
			$this->db->select('content_event.event_id, content_event.event_title, content_event.event_description, content_event.event_image');
			$this->db->from('content_event');
			$this->db->where('content_event.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		/*CONTENT NEWS*/
		public function getContentNewsList(){
			$this->db->select('content_news.news_id, content_news.news_title, content_news.news_description, content_news.news_image');
			$this->db->from('content_news');
			$this->db->where('content_news.data_state', 0);
			$this->db->order_by('content_news.news_id', 'DESC');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getDataPerpetratorUpdateList(){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.province_id, core_province.province_name, data_perpetrator.city_id, core_city.city_name, data_perpetrator.perpetrator_name, data_perpetrator.created_on');
			$this->db->from('data_perpetrator');
			$this->db->join('core_province', 'data_perpetrator.province_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_id = core_city.city_id');
			$this->db->where('data_perpetrator.data_state', 0);
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$this->db->limit('10');
			$result = $this->db->get()->result_array();
			return $result;
		}


















		
		
	}
?>