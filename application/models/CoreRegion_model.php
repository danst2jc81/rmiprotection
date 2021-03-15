<?php
	class CoreRegion_model extends CI_Model {
		var $table = "core_region";
		
		public function CoreRegion_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCoreRegion()
		{
			$this->db->select('core_region.region_id, core_region.region_code, core_region.region_name, core_region.region_address, core_region.region_contact_person, core_region.region_phone');
			$this->db->from('core_region');
			$this->db->where('core_region.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getRegionToken($region_token){
			$this->db->select('core_region.region_token');
			$this->db->from('core_region');
			$this->db->where('core_region.region_token', $region_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCoreRegion($data){
			return $this->db->insert('core_region',$data);
		}

		public function getRegionID(){
			$this->db->select('core_region.region_id');
			$this->db->from('core_region');
			$this->db->order_by('core_region.region_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['region_id'];
		}

		public function getCoreregion_Detail($region_id){
			$this->db->select('core_region.region_id, core_region.region_code, core_region.region_name, core_region.region_address, core_region.region_contact_person, core_region.region_phone');
			$this->db->from('core_region');
			$this->db->where('core_region.region_id', $region_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCoreRegion($data){
			$this->db->where('core_region.region_id', $data['region_id']);
			$query = $this->db->update('core_region', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreRegion($data){
			$this->db->where("core_region.region_id", $data['region_id']);
			$query = $this->db->update('core_region', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>