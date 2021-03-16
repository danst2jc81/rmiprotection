<?php
	Class ValidationProcess_model extends CI_Model{
		var $table = "system_user";
		
		public function ValidationProcess_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getSystemUser($data){
			$this->db->select('user_id, username, password, user_group_id, log_state, user_level, region_id, branch_id, vendor_id');
			$this->db->from('system_user');
			$this->db->where('username', $data['username']);
			$this->db->where('password', $data['password']);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function getAccountLastPeriod(){
			$this->db->select('preference_company.account_last_period');
			$this->db->from('preference_company');
			$result = $this->db->get()->row_array();
			return $result['account_last_period'];
		}
		
		function getLogin($data){
			$hasil = $this->db->query("UPDATE system_user SET log_state='on' WHERE username='$data[username]' AND password='$data[password]'");
			if($hasil){
				return true;
			}else{
				return false;
			}
		}
		
		function getLogout($data){
			$hasil = $this->db->query("UPDATE system_user SET log_state = 0 WHERE username='$data[username]' AND password='$data[password]'");
			if($hasil){
				return true;
			}else{
				return false;
			}
		}
		
		function getName($id){
		
		}

		public function getCompanyName($company_id){
			$this->db->select('core_company.company_name');
			$this->db->from('core_company');
			$this->db->where('core_company.company_id', $company_id);
			$result = $this->db->get()->row_array();
			return $result['company_name'];
		}

		public function getCoreVendor_Detail($vendor_id){
			$this->db->select('core_vendor.vendor_id, core_vendor.region_id, core_vendor.branch_id, core_vendor.province_id, core_vendor.city_id, core_vendor.vendor_code, core_vendor.vendor_name, core_vendor.vendor_address, core_vendor.vendor_phone');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.vendor_id', $vendor_id);
			$result = $this->db->get()->row_array();
			return $result;
		}	
	}
?>