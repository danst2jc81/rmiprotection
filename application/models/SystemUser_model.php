<?php
	class SystemUser_model extends CI_Model {
		var $table = "system_user";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getSystemUser()
		{
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.user_group_id, system_user_group.user_group_name');
			$this->db->from('system_user');
			$this->db->join('system_user_group', 'system_user.user_group_id = system_user_group.user_group_id');
			$this->db->where('system_user_group.data_state', '0');
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

		public function getEventsName($events_id){
			$this->db->select('core_events.events_name');
			$this->db->from('core_events');
			$this->db->where('core_events.events_id', $events_id);
			$result = $this->db->get()->row_array();
			return $result['events_name'];
		}
		
		public function getSystemUserGroup(){
			$this->db->select('system_user_group.user_group_level, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_level !=', '1');
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function insertSystemUser($data){
			return $this->db->insert('system_user', $data);
		}

		public function getSystemUser_Detail($user_id){
			$this->db->select('system_user.user_id, system_user.username, system_user.password, system_user.user_group_id, system_user_group.user_group_name, system_user.log_stat, system_user.events_id');
			$this->db->from('system_user');
			$this->db->join('system_user_group', 'system_user.user_group_id = system_user_group.user_group_id');
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

		public function getCoreEvents(){
			$this->db->select('core_events.events_id, core_events.events_name');
			$this->db->from('core_events');
			$this->db->where('core_events.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
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


		
		public function deleteSystemUser($user_id){
			return $this->db->delete('system_user', array('user_id' => $user_id));
		}









		
		public function getFactory(){
			$this->db->select('factory_id,factory_name')->from('core_factory');
			$this->db->where('data_state','0');
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		
		
		
		
		
	}
?>