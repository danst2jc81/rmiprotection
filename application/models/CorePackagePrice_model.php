<?php
	class CorePackagePrice_model extends CI_Model {
		var $table = "core_package_price";
		
		public function CorePackagePrice_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getCorePackagePrice($package_id)
		{
			$this->db->select('core_package_price.package_price_id, core_package_price.package_id, core_package.package_name, core_package_price.package_price_month, core_package_price.package_price_amount');
			$this->db->from('core_package_price');
			$this->db->join('core_package', 'core_package_price.package_id = core_package.package_id');
			$this->db->where('core_package_price.data_state', 0);

			if ($package_id != ''){
				$this->db->where('core_package_price.package_id', $package_id);
			}
			
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCorePackage(){
			$this->db->select('core_package.package_id, core_package.package_name');
			$this->db->from('core_package');
			$this->db->where('core_package.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getPackagePriceToken($package_price_token){
			$this->db->select('core_package_price.package_price_token');
			$this->db->from('core_package_price');
			$this->db->where('core_package_price.package_price_token', $package_price_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertCorePackagePrice($data){
			return $this->db->insert('core_package_price',$data);
		}

		public function getPackagePriceID(){
			$this->db->select('core_package_price.package_price_id');
			$this->db->from('core_package_price');
			$this->db->order_by('core_package_price.package_price_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['package_price_id'];
		}

		public function getCorePackagePrice_Detail($package_price_id){
			$this->db->select('core_package_price.package_price_id, core_package_price.package_id, core_package.package_name, core_package_price.package_price_month, core_package_price.package_price_amount');
			$this->db->from('core_package_price');
			$this->db->join('core_package', 'core_package_price.package_id = core_package.package_id');
			$this->db->where('core_package_price.package_price_id', $package_price_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateCorePackagePrice($data){
			$this->db->where('core_package_price.package_price_id', $data['package_price_id']);
			$query = $this->db->update('core_package_price', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCorePackagePrice($data){
			$this->db->where("core_package_price.package_price_id", $data['package_price_id']);
			$query = $this->db->update('core_package_price', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>