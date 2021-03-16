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

		public function getTenantID(){
			$this->db->select('registration_tenant.tenant_id');
			$this->db->from('registration_tenant');
			$this->db->order_by('registration_tenant.tenant_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['tenant_id'];
		}
	}
?>