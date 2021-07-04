<?php
	class CorePackage_model extends CI_Model {
		var $table = "core_package";
		
		public function CorePackage_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCorePackage()
		{
			$this->db->select('core_package.package_id, core_package.package_name, core_package.package_status');
			$this->db->from('core_package');
			$this->db->where('core_package.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPackageToken($package_token){
			$this->db->select('core_package.package_token');
			$this->db->from('core_package');
			$this->db->where('core_package.package_token', $package_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCorePackage($data){
			return $this->db->insert('core_package',$data);
		}

		public function getPackageID(){
			$this->db->select('core_package.package_id');
			$this->db->from('core_package');
			$this->db->order_by('core_package.package_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['package_id'];
		}

		public function getCorepackage_Detail($package_id){
			$this->db->select('core_package.package_id, core_package.package_name, core_package.package_status');
			$this->db->from('core_package');
			$this->db->where('core_package.package_id', $package_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCorePackage($data){
			$this->db->where('core_package.package_id', $data['package_id']);
			$query = $this->db->update('core_package', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCorePackage($data){
			$this->db->where("core_package.package_id", $data['package_id']);
			$query = $this->db->update('core_package', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>