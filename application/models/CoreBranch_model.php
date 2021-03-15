<?php
	class CoreBranch_model extends CI_Model {
		var $table = "core_branch";
		
		public function CoreBranch_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCoreBranch($region_id, $province_id, $city_id)
		{
			$this->db->select('core_branch.branch_id, core_branch.region_id, core_region.region_name, core_branch.province_id, core_province.province_name, core_branch.city_id, core_city.city_name, core_branch.branch_code, core_branch.branch_name, core_branch.branch_address, core_branch.branch_contact_person, core_branch.branch_phone');
			$this->db->from('core_branch');
			$this->db->join('core_region', 'core_branch.region_id = core_region.region_id');
			$this->db->join('core_province', 'core_branch.province_id = core_province.province_id');
			$this->db->join('core_city', 'core_branch.city_id = core_city.city_id');
			$this->db->where('core_branch.data_state', 0);

			if ($region_id != ''){
				$this->db->where('core_branch.region_id', $region_id);
			}

			if ($province_id != ''){
				$this->db->where('core_branch.province_id', $province_id);
			}

			if ($city_id != ''){
				$this->db->where('core_branch.city_id', $city_id);
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

		public function getCoreProvince(){
			$this->db->select('core_province.province_id, core_province.province_name');
			$this->db->from('core_province');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreCity($province_id){
			$this->db->select('core_city.city_id, core_city.city_name');
			$this->db->from('core_city');
			$this->db->where('core_city.province_id', $province_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getBranchToken($branch_token){
			$this->db->select('core_branch.branch_token');
			$this->db->from('core_branch');
			$this->db->where('core_branch.branch_token', $branch_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCoreBranch($data){
			return $this->db->insert('core_branch',$data);
		}

		public function getBranchID(){
			$this->db->select('core_branch.branch_id');
			$this->db->from('core_branch');
			$this->db->order_by('core_branch.branch_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['branch_id'];
		}

		public function getCorebranch_Detail($branch_id){
			$this->db->select('core_branch.branch_id, core_branch.region_id, core_region.region_name, core_branch.province_id, core_province.province_name, core_branch.city_id, core_city.city_name, core_branch.branch_code, core_branch.branch_name, core_branch.branch_address, core_branch.branch_contact_person, core_branch.branch_phone');
			$this->db->from('core_branch');
			$this->db->join('core_region', 'core_branch.region_id = core_region.region_id');
			$this->db->join('core_province', 'core_branch.province_id = core_province.province_id');
			$this->db->join('core_city', 'core_branch.city_id = core_city.city_id');
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCoreBranch($data){
			$this->db->where('core_branch.branch_id', $data['branch_id']);
			$query = $this->db->update('core_branch', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreBranch($data){
			$this->db->where("core_branch.branch_id", $data['branch_id']);
			$query = $this->db->update('core_branch', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>