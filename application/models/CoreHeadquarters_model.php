<?php
	class CoreHeadquarters_model extends CI_Model {
		var $table = "core_headquarters";
		
		public function CoreHeadquarters_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCoreHeadquarters()
		{
			$this->db->select('core_headquarters.headquarters_id, core_headquarters.headquarters_name, core_headquarters.headquarters_address, core_headquarters.headquarters_contact_person, core_headquarters.headquarters_phone');
			$this->db->from('core_headquarters');
			$this->db->where('core_headquarters.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getHeadquartersToken($headquarters_token){
			$this->db->select('core_headquarters.headquarters_token');
			$this->db->from('core_headquarters');
			$this->db->where('core_headquarters.headquarters_token', $headquarters_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCoreHeadquarters($data){
			return $this->db->insert('core_headquarters',$data);
		}

		public function getHeadquartersID(){
			$this->db->select('core_headquarters.headquarters_id');
			$this->db->from('core_headquarters');
			$this->db->order_by('core_headquarters.headquarters_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['headquarters_id'];
		}

		public function getCoreheadquarters_Detail($headquarters_id){
			$this->db->select('core_headquarters.headquarters_id, core_headquarters.headquarters_name, core_headquarters.headquarters_address, core_headquarters.headquarters_contact_person, core_headquarters.headquarters_phone');
			$this->db->from('core_headquarters');
			$this->db->where('core_headquarters.headquarters_id', $headquarters_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCoreHeadquarters($data){
			$this->db->where('core_headquarters.headquarters_id', $data['headquarters_id']);
			$query = $this->db->update('core_headquarters', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreHeadquarters($data){
			$this->db->where("core_headquarters.headquarters_id", $data['headquarters_id']);
			$query = $this->db->update('core_headquarters', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>