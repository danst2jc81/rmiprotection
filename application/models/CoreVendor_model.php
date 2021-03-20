<?php
	class CoreVendor_model extends CI_Model {
		var $table = "core_vendor";
		
		public function CoreVendor_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCoreVendor($region_id, $branch_id, $province_id, $city_id)
		{
			$this->db->select('core_vendor.vendor_id, core_vendor.region_id, core_region.region_name, core_vendor.branch_id, core_branch.branch_name, core_vendor.province_id, core_province.province_name, core_vendor.city_id, core_city.city_name, core_vendor.vendor_code, core_vendor.vendor_name, core_vendor.vendor_address, core_vendor.vendor_contact_person, core_vendor.vendor_phone');
			$this->db->from('core_vendor');
			$this->db->join('core_region', 'core_vendor.region_id = core_region.region_id');
			$this->db->join('core_branch', 'core_vendor.branch_id = core_branch.branch_id');
			$this->db->join('core_province', 'core_vendor.province_id = core_province.province_id');
			$this->db->join('core_city', 'core_vendor.city_id = core_city.city_id');
			$this->db->where('core_vendor.data_state', 0);

			if ($region_id != ''){
				$this->db->where('core_vendor.region_id', $region_id);
			}

			if ($branch_id != ''){
				$this->db->where('core_vendor.branch_id', $branch_id);
			}

			if ($province_id != ''){
				$this->db->where('core_vendor.province_id', $province_id);
			}

			if ($city_id != ''){
				$this->db->where('core_vendor.city_id', $city_id);
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
			$this->db->where('core_branch.region_id', $region_id);
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

		public function getVendorToken($vendor_token){
			$this->db->select('core_vendor.vendor_token');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.vendor_token', $vendor_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCoreVendor($data){
			return $this->db->insert('core_vendor',$data);
		}

		public function getVendorID(){
			$this->db->select('core_vendor.vendor_id');
			$this->db->from('core_vendor');
			$this->db->order_by('core_vendor.vendor_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['vendor_id'];
		}

		public function getCorevendor_Detail($vendor_id){
			$this->db->select('core_vendor.vendor_id, core_vendor.region_id, core_region.region_name, core_vendor.branch_id, core_branch.branch_name, core_vendor.province_id, core_province.province_name, core_vendor.city_id, core_city.city_name, core_vendor.vendor_code, core_vendor.vendor_name, core_vendor.vendor_address, core_vendor.vendor_contact_person, core_vendor.vendor_phone');
			$this->db->from('core_vendor');
			$this->db->join('core_region', 'core_vendor.region_id = core_region.region_id');
			$this->db->join('core_branch', 'core_vendor.branch_id = core_branch.branch_id');
			$this->db->join('core_province', 'core_vendor.province_id = core_province.province_id');
			$this->db->join('core_city', 'core_vendor.city_id = core_city.city_id');
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCoreVendor($data){
			$this->db->where('core_vendor.vendor_id', $data['vendor_id']);
			$query = $this->db->update('core_vendor', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreVendor($data){
			$this->db->where("core_vendor.vendor_id", $data['vendor_id']);
			$query = $this->db->update('core_vendor', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>