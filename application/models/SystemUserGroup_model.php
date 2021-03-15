<?php
	class SystemUserGroup_model extends CI_Model {
		var $table = "system_user_group";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getSystemUserGroup() 
		{
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_level, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.data_state', '0');
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getMenuList($char){
			$result = $this->db->query("SELECT system_menu_new.id_menu, system_menu_new.text, system_menu_new.type FROM system_menu_new WHERE system_menu_new.id_menu LIKE '$char' ORDER BY system_menu_new.id_menu ASC ");
			$result = $result->result_array();
			return $result;
		}
		
		public function insertSystemUserGroup($data){
			$this->db->set('user_group_id', 'getNewUserGroupID()', FALSE);
			$this->db->set('user_group_level', 'getNewUserGroupID()', FALSE);
			if($this->db->insert("system_user_group", $data)){
				return true;
			}else{
				return false;
			}
		}
		
		public function getMenuID($name){
			$this->db->select('user_group_level');
			$this->db->from($this->table);
			$this->db->where('user_group_name',$name);
			$hasil = $this->db->get()->row_array();
			return $hasil['user_group_level'];
		}
		
		public function saveMapping($data){
			return $this->db->insert("system_menu_mapping", $data);
		}
		
		public function deleteMapping($level){
			$this->db->delete('system_menu_mapping', array('user_group_level' => $level)); 
		}
		
		public function getSystemUserGroup_Detail($user_group_level){
			$this->db->select('system_user_group.user_group_id, system_user_group.user_group_name');
			$this->db->from('system_user_group');
			$this->db->where('system_user_group.user_group_level', $user_group_level);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function isThisMenuInGroup($level, $id_menu){
			$result = $this->db->query("SELECT * FROM system_menu_mapping WHERE user_group_level='$level' AND id_menu='$id_menu'");
			$result = $result->row_array();
			if(is_array($result)){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteSystemUserGroup($id){
			$this->deleteMapping($id);
			if($this->db->delete('system_user_group',array('user_group_id' => $id))){
				return true;
			}else{
				return false;
			}
		}
		
		public function cekGroupName($name){
			$this->db->select('user_group_id,user_group_name')->from('system_user_group');
			$this->db->where('user_group_name',$name);
			$hasil = $this->db->get()->row_array();
			if(count($hasil)>0){
				return false;
			}else{
				return true;
			}
		}
		
		public function UpdateGroup($data){
			$this->db->where('user_group_id',$data['user_group_id']);
			$query = $this->db->update('system_user_group', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>