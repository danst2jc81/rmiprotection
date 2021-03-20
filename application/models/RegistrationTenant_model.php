<?php
	Class RegistrationTenant_model extends CI_Model{
		
		public function RegistrationTenant_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCoreVendor_Detail($vendor_id){
			$this->db->select('core_vendor.vendor_id, core_vendor.region_id, core_vendor.branch_id, core_vendor.province_id, core_vendor.city_id, core_vendor.vendor_code, core_vendor.vendor_name, core_vendor.vendor_address, core_vendor.vendor_phone');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.vendor_id', $vendor_id);
			$result = $this->db->get()->row_array();
			return $result;
		}	
		
		public function getTenantToken($tenant_token){
			$this->db->select('registration_tenant.tenant_token');
			$this->db->from('registration_tenant');
			$this->db->where('registration_tenant.tenant_token', $tenant_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertRegistrationTenant($data){
			return $this->db->insert('registration_tenant',$data);
		}

		public function getTenantID($tenant_token){
			$this->db->select('registration_tenant.tenant_token');
			$this->db->from('registration_tenant');
			$this->db->where('registration_tenant.tenant_token', $tenant_token);
			$this->db->order_by('registration_tenant.tenant_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['tenant_id'];
		}

		public function getRegistrationTenant_DetailNIK($tenant_nik){
			$this->db->select('registration_tenant.tenant_id, registration_tenant.region_id, core_region.region_name, registration_tenant.branch_id, core_branch.branch_name, registration_tenant.vendor_id, core_vendor.vendor_name, registration_tenant.province_id, core_province.province_name, registration_tenant.city_id, core_city.city_name, registration_tenant.tenant_name, registration_tenant.tenant_registration_date, registration_tenant.tenant_address, registration_tenant.tenant_mobile_phone, registration_tenant.tenant_nik, registration_tenant.tenant_profile_photo, registration_tenant.tenant_nik_photo, registration_tenant.tenant_status, registration_tenant.tenant_status_id, registration_tenant.tenant_status_on, registration_tenant.tenant_status_remark');
			$this->db->from('registration_tenant');
			$this->db->join('core_region', 'registration_tenant.region_id = core_region.region_id');
			$this->db->join('core_branch', 'registration_tenant.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'registration_tenant.vendor_id = core_vendor.vendor_id');
			$this->db->join('core_province', 'registration_tenant.province_id = core_province.province_id');
			$this->db->join('core_city', 'registration_tenant.city_id = core_city.city_id');
			$this->db->where('registration_tenant.tenant_nik', $tenant_nik);
			$result = $this->db->get()->row_array();
			return $result;
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

		public function getSystemUser($vendor_id){
			$this->db->select('system_user.vendor_id, system_user.user_token');
			$this->db->from('system_user');
			$this->db->where('system_user.vendor_id', $vendor_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getVehicleRentalToken($vehicle_rental_token){
			$this->db->select('trans_vehicle_rental.vehicle_rental_token');
			$this->db->from('trans_vehicle_rental');
			$this->db->where('trans_vehicle_rental.vehicle_rental_token', $vehicle_rental_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertTransVehicleRental($data){
			return $this->db->insert('trans_vehicle_rental',$data);
		}

		public function getVehicleRentalID($created_id){
			$this->db->select('trans_vehicle_rental.vehicle_rental_i');
			$this->db->from('trans_vehicle_rental');
			$this->db->from('trans_vehicle_rental.created_id', $created_id);
			$this->db->order_by('trans_vehicle_rental.vehicle_rental_i', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['vehicle_rental_i'];
		}
	}
?>