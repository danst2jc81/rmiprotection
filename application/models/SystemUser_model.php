<?php
	class SystemUser_model extends CI_Model {
		var $table = "system_user";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getSystemUser($region_id, $branch_id, $vendor_id, $user_group_id)
		{
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.user_group_id, system_user_group.user_group_name, system_user.region_id, core_region.region_name, system_user.branch_id, core_branch.branch_name, system_user.vendor_id, core_vendor.vendor_name');
			$this->db->from('system_user');
			$this->db->join('system_user_group', 'system_user.user_group_id = system_user_group.user_group_id');
			$this->db->join('core_region', 'system_user.region_id = core_region.region_id');
			$this->db->join('core_branch', 'system_user.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'system_user.vendor_id = core_vendor.vendor_id');
			$this->db->where('system_user.data_state', 0);

			if ($region_id != ''){
				$this->db->where('system_user.region_id', $region_id);
			}
			
			if ($branch_id != ''){
				$this->db->where('system_user.branch_id', $branch_id);
			}

			if ($vendor_id != ''){
				$this->db->where('system_user.vendor_id', $vendor_id);
			}

			if ($user_group_id != ''){
				$this->db->where('system_user.user_group_id', $user_group_id);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreRegion(){
			$this->db->select('core_region.region_id, core_region.region_name');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBranch($region_id){
			$this->db->select('core_branch.branch_id, core_branch.branch_name');
			$this->db->from('core_branch');
			$this->db->where('core_branch.data_state', 0);
			$this->db->where('core_branch.region_id', $region_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreVendor($branch_id){
			$this->db->select('core_vendor.vendor_id, core_vendor.vendor_name');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.data_state', 0);
			$this->db->where('core_vendor.branch_id', $branch_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getGroupName($id){
			$this->db->select('user_group_name')->from('system_user_group');
			$this->db->where('user_group_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['user_group_name'])){
				return 'Not Set';
			}else{
				return $result['user_group_name'];
			}
		}
		
		public function getSystemUserGroup(){
			$this->db->select('system_user_group.user_group_level, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getUserToken($user_token){
			$this->db->select('system_user.user_token');
			$this->db->from('system_user');
			$this->db->where('system_user.user_token', $user_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}
		
		public function insertSystemUser($data){
			return $this->db->insert('system_user', $data);
		}

		public function getUserID($created_id){
			$this->db->select('system_user.user_id');
			$this->db->from('system_user');
			$this->db->where('system_user.created_id', $created_id);
			$this->db->order_by('system_user.user_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['user_id'];
		}

		public function getSystemUser_Detail($user_id){
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.user_group_id, system_user_group.user_group_name, system_user.region_id, core_region.region_name, system_user.branch_id, core_branch.branch_name, system_user.vendor_id, core_vendor.vendor_name, system_user.user_level');
			$this->db->from('system_user');
			$this->db->join('system_user_group', 'system_user.user_group_id = system_user_group.user_group_id');
			$this->db->join('core_region', 'system_user.region_id = core_region.region_id');
			$this->db->join('core_branch', 'system_user.branch_id = core_branch.branch_id');
			$this->db->join('core_vendor', 'system_user.vendor_id = core_vendor.vendor_id');
			$this->db->where('system_user.user_id', $user_id);
			return $this->db->get()->row_array();
		}

		public function checkUsername($username){
			$this->db->select('system_user.username');
			$this->db->from('system_user');
			$this->db->where('system_user.username', $username);
			$result = $this->db->get()->row_array();
			if(count($result) > 0){
				return false;
			}else{
				return true;
			}
		}

		public function updateSystemUser($data){
			$this->db->where("system_user.user_id", $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteSystemUser($data){
			$this->db->where("system_user.user_id", $data['user_id']);
			$query = $this->db->update('system_user', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		
	}
?>