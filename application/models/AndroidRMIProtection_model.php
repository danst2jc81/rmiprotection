<?php
	class AndroidRMIProtection_model extends CI_Model {
		var $table 			= "acct_account";
		var $column_search 	= array('perpetrator_name', 'perpetrator_address', 'perpetrator_id_number');
		
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
			$this->db->where('system_user.customer_id', $data['customer_id']);
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
			$this->db->select('data_perpetrator_chronology.perpetrator_chronology_description');
			$this->db->from('data_perpetrator_chronology');
			$this->db->where('data_perpetrator_chronology.data_state', 0);
			$this->db->where('data_perpetrator_chronology.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_chronology.perpetrator_chronology_id', 'ASC');
			$this->db->limit('1');
			$result = $this->db->get()->row_array();
			return $result['perpetrator_chronology_description'];
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

		public function getSalesCustomer_Detail($customer_id){
			$this->db->select('sales_customer.province_id, sales_customer.city_id');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_id', $customer_id);
			$result = $this->db->get()->row_array();
			return $result;
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
			$this->db->select('data_perpetrator_chronology.perpetrator_chronology_id, data_perpetrator_chronology.perpetrator_id, data_perpetrator_chronology.perpetrator_status, data_perpetrator_chronology.perpetrator_chronology_description, data_perpetrator_chronology.created_on, sales_customer.customer_name');
			$this->db->from('data_perpetrator_chronology');
			$this->db->join('sales_customer', 'data_perpetrator_chronology.customer_id = sales_customer.customer_id');
			$this->db->where('data_perpetrator_chronology.perpetrator_id', $perpetrator_id);
			$this->db->order_by('data_perpetrator_chronology.perpetrator_chronology_id', 'DESC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getSearchDataPerpetrator($perpetrator_name, $province_id, $city_id, $province_id_perpetrator, $city_id_perpetrator, $sort_status, $province_perpetrator_id, $province_customer_id, $bundle_status, $perpetrator_status){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.customer_id, sales_customer.customer_name, sales_customer.customer_contact_person, sales_customer.customer_mobile_phone, data_perpetrator.province_id, core_province.province_name, data_perpetrator.city_id, core_city.city_name, data_perpetrator.gender_id, core_gender.gender_name, data_perpetrator.province_id_perpetrator, data_perpetrator.city_id_perpetrator, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_mobile_phone, data_perpetrator.perpetrator_id_number, data_perpetrator.perpetrator_date_of_birth, data_perpetrator.perpetrator_status, data_perpetrator.created_on');
			$this->db->from('data_perpetrator');
			$this->db->join('sales_customer', 'data_perpetrator.customer_id = sales_customer.customer_id');
			$this->db->join('core_province', 'data_perpetrator.province_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_id = core_city.city_id');
			$this->db->join('core_gender', 'data_perpetrator.gender_id = core_gender.gender_id');

			if ($bundle_status == 1){
				if ($province_customer_id == 1){
					$this->db->where('data_perpetrator.province_id', $province_id);	
					$this->db->where('data_perpetrator.city_id', $city_id);	
				}
	
				if ($province_perpetrator_id == 1){
					$this->db->where('data_perpetrator.province_id_perpetrator', $province_id_perpetrator);	
					$this->db->where('data_perpetrator.city_id_perpetrator', $city_id_perpetrator);	
				}

				if (!empty($perpetrator_status)){
					$this->db->where_in('data_perpetrator.perpetrator_status', $perpetrator_status);
				}
			}
			
			$this->db->where('data_perpetrator.data_state', 0);

			$i = 0;


			foreach ($this->column_search as $item) // looping awal
			{
				if($perpetrator_name) // jika datatable mengirimkan pencarian dengan metode POST
				{
					
					if($i===0) // looping awal
					{
						$this->db->group_start(); 
						$this->db->like($item, $perpetrator_name);
					}
					else
					{
						$this->db->or_like($item, $perpetrator_name);
					}
	
					if(count($this->column_search) - 1 == $i) 
						$this->db->group_end(); 
				}
				$i++;
			}


			if ($bundle_status == 1){
				if ($sort_status == 1){
					$this->db->order_by('data_perpetrator.province_id_perpetrator', 'ASC');
					$this->db->order_by('data_perpetrator.city_id_perpetrator', 'ASC');
				} else if ($sort_status == 2){
					$this->db->order_by('data_perpetrator.province_id', 'ASC');
					$this->db->order_by('data_perpetrator.city_id', 'ASC');
				} else if ($sort_status == 3){
					$this->db->order_by('data_perpetrator.perpetrator_name', 'ASC');
				}
			}

			if ($bundle_status == 0){
				$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			}

			$result = $this->db->get()->result_array();
			/* print_r($this->db->last_query());
			print_r("<BR>");
			print_r("<BR>"); */
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
			$this->db->select('content_news.news_id, content_news.news_title, content_news.news_description, content_news.news_image, content_news.news_date, content_news.created_on, content_news.created_id');
			$this->db->from('content_news');
			$this->db->where('content_news.data_state', 0);
			$this->db->order_by('content_news.news_id', 'DESC');
			$this->db->limit(10);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getDataPerpetratorUpdateList(){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.customer_id, sales_customer.customer_name, sales_customer.customer_contact_person, sales_customer.customer_mobile_phone, data_perpetrator.gender_id, core_gender.gender_name, data_perpetrator.province_id_perpetrator, core_province.province_name, data_perpetrator.city_id_perpetrator, core_city.city_name, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_status, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_mobile_phone, data_perpetrator.perpetrator_id_number, data_perpetrator.perpetrator_date_of_birth, data_perpetrator.created_on');
			$this->db->from('data_perpetrator');
			$this->db->join('core_province', 'data_perpetrator.province_id_perpetrator = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_id_perpetrator = core_city.city_id');
			$this->db->join('sales_customer', 'data_perpetrator.customer_id = sales_customer.customer_id');
			$this->db->join('core_gender', 'data_perpetrator.gender_id = core_gender.gender_id');
			$this->db->where('data_perpetrator.data_state', 0);
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$this->db->limit('10');
			$result = $this->db->get()->result_array();
			return $result;
		}

		/*CORE GENDER*/
		public function getCoreGender(){
			$this->db->select('core_gender.gender_id, core_gender.gender_name');
			$this->db->from('core_gender');
			$this->db->where('core_gender.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		/*SALES CUSTOMER*/
		public function getCustomerMobilePhone($customer_mobile_phone){
			$this->db->select('system_user.customer_id');
			$this->db->from('system_user');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.customer_mobile_phone', $customer_mobile_phone);
			$result = $this->db->get()->num_rows();
			if ($result == 0){
				return true;
			} else {
				return false;
			}
		}

		public function getCustomerEmail($customer_email){
			$this->db->select('system_user.customer_id');
			$this->db->from('system_user');
			$this->db->where('system_user.data_state', 0);
			$this->db->where('system_user.customer_email', $customer_email);
			$result = $this->db->get()->num_rows();
			if ($result == 0){
				return true;
			} else {
				return false;
			}
		}

		public function insertSalesCustomer($data){
			if($this->db->insert('sales_customer', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getSalesCustomer_Last($created_id){
			$this->db->select('sales_customer.customer_id, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_verification_code, sales_customer.verified, sales_customer.customer_status, sales_customer.province_id, sales_customer.city_id');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.data_state', 0);
			$this->db->where('sales_customer.created_id', $created_id);
			$this->db->order_by('sales_customer.customer_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function insertSystemUser($data){
			if($this->db->insert('system_user', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function insertSalesCustomerPackage($data){
			if($this->db->insert('sales_customer_package', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getCustomerVerificationCode($data){
			$this->db->select('sales_customer.customer_id, sales_customer.customer_verification_code');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.data_state', 0);
			$this->db->where('sales_customer.customer_id', $data['customer_id']);
			$this->db->where('sales_customer.customer_verification_code', $data['customer_verification_code']);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function updateSalesCustomer($data){
			$this->db->where('sales_customer.customer_id', $data['customer_id']);
			$query = $this->db->update('sales_customer', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getCorePackage(){
			$this->db->select('core_package.package_id, core_package.package_name, core_package.package_status');
			$this->db->from('core_package');
			$this->db->order_by('core_package.package_name', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getCorePackagePrice($package_id){
			$this->db->select('core_package_price.package_id, core_package_price.package_price_id, core_package_price.package_price_name, core_package_price.package_price_amount, core_package_price.package_price_month, core_package_price.package_price_status');
			$this->db->from('core_package_price');
			$this->db->where('core_package_price.package_id', $package_id);
			$this->db->order_by('core_package_price.package_price_name', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}	

		public function getCustomerPackage($customer_id){
			$this->db->select('sales_customer.customer_id, sales_customer.package_id, sales_customer.package_price_id, sales_customer.package_status, sales_customer.customer_last_date, sales_customer.customer_package_search_balance, sales_customer.customer_package_add_balance, sales_customer.package_status, sales_customer.customer_last_date');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_id', $customer_id);
			$result = $this->db->get()->row_array();
			return $result;
		}	

		public function getCustomerPackageAddBalance($customer_id){
			$this->db->select('sales_customer.customer_package_add_balance');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_id', $customer_id);
			$result = $this->db->get()->row_array();
			return $result['customer_package_add_balance'];
		}	

		public function insertSalesCustomerPackageHistory($data){
			if($this->db->insert('sales_customer_package_history', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getCustomerPackageSearchBalance($customer_id){
			$this->db->select('sales_customer.customer_package_search_balance');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_id', $customer_id);
			$result = $this->db->get()->row_array();
			return $result['customer_package_search_balance'];
		}	
		
		public function getProvinceName($province_id){
			$this->db->select('core_province.province_name');
			$this->db->from('core_province');
			$this->db->where('core_province.province_id', $province_id);
			$result = $this->db->get()->row_array();
			return $result['province_name'];
		}	

		public function getCityName($city_id){
			$this->db->select('core_city.city_name');
			$this->db->from('core_city');
			$this->db->where('core_city.city_id', $city_id);
			$result = $this->db->get()->row_array();
			return $result['city_name'];
		}	

		public function getCreatedName($created_id){
			$this->db->select('system_user.customer_email');
			$this->db->from('system_user');
			$this->db->where('system_user.user_id', $created_id);
			$result = $this->db->get()->row_array();
			return $result['customer_email'];
		}	

		
		
	}
?>