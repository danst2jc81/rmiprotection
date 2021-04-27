<?php
	class DataPerpetrator_model extends CI_Model {
		var $table = "data_perpetrator";
		
		public function DataPerpetrator_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getDataPerpetrator($vendor_id, $province_perpetrator_id, $city_perpetrator_id)
		{
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.region_id, data_perpetrator.branch_id, data_perpetrator.vendor_id, core_vendor.vendor_name, data_perpetrator.province_id, data_perpetrator.city_id, data_perpetrator.province_perpetrator_id, core_province.province_name, data_perpetrator.city_perpetrator_id, core_city.city_name, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_mobile_phone, data_perpetrator.perpetrator_id_number, data_perpetrator.perpetrator_date_of_birth, data_perpetrator.perpetrator_status');
			$this->db->from('data_perpetrator');
			$this->db->join('core_province', 'data_perpetrator.province_perpetrator_id = core_province.province_id');
			$this->db->join('core_city', 'data_perpetrator.city_perpetrator_id = core_city.city_id');
			$this->db->join('core_vendor', 'data_perpetrator.vendor_id = core_vendor.vendor_id');
			$this->db->where('data_perpetrator.data_state', 0);
			$this->db->where('data_perpetrator.vendor_id', $vendor_id);
			
			if ($province_perpetrator_id != ''){
				$this->db->where('data_perpetrator.province_perpetrator_id', $province_perpetrator_id);
			}

			if ($city_perpetrator_id != ''){
				$this->db->where('data_perpetrator.city_perpetrator_id', $city_perpetrator_id);
			}

			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreVendor(){
			$this->db->select('core_vendor.vendor_id, core_vendor.vendor_name');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.data_state', 0);
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

		public function getCoreVendor_Detail($vendor_id){
			$this->db->select('core_vendor.vendor_id, core_vendor.vendor_name, core_vendor.vendor_code');
			$this->db->from('core_vendor');
			$this->db->where('core_vendor.data_state', 0);
			$this->db->where('core_vendor.vendor_id', $vendor_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getPerpetratorToken($perpetrator_token){
			$this->db->select('data_perpetrator.perpetrator_token');
			$this->db->from('data_perpetrator');
			$this->db->where('data_perpetrator.perpetrator_token', $perpetrator_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertDataPerpetrator($data){
			return $this->db->insert('data_perpetrator',$data);
		}

		public function getPerpetratorChronologyToken($perpetrator_chronology_token){
			$this->db->select('data_perpetrator_chronology.perpetrator_chronology_token');
			$this->db->from('data_perpetrator_chronology');
			$this->db->where('data_perpetrator_chronology.perpetrator_chronology_token', $perpetrator_chronology_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertDataPerpetratorChronology($data){
			return $this->db->insert('data_perpetrator_chronology',$data);
		}

		public function getPerpetratorPhotoToken($perpetrator_photo_token){
			$this->db->select('data_perpetrator_photo.perpetrator_photo_token');
			$this->db->from('data_perpetrator_photo');
			$this->db->where('data_perpetrator_photo.perpetrator_photo_token', $perpetrator_photo_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertDataPerpetratorPhoto($data){
			return $this->db->insert('data_perpetrator_photo',$data);
		}







		

		public function getCellGroupName($cell_group_id){
			$this->db->select('core_cell_group.cell_group_name');
			$this->db->from('core_cell_group');
			$this->db->where('core_cell_group.cell_group_id', $cell_group_id);
			$result = $this->db->get()->row_array();
			return $result['cell_group_name'];
		}

		public function getPerpetratorID(){
			$this->db->select('data_perpetrator.perpetrator_id');
			$this->db->from('data_perpetrator');
			$this->db->order_by('data_perpetrator.perpetrator_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['perpetrator_id'];
		}

		public function getPerpetratorHistoryToken($perpetrator_history_token){
			$this->db->select('church_perpetrator_history.perpetrator_history_token');
			$this->db->from('church_perpetrator_history');
			$this->db->where('church_perpetrator_history.perpetrator_history_token', $perpetrator_history_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertDataPerpetratorHistory($data){
			return $this->db->insert('church_perpetrator_history',$data);
		}

		public function getDataPerpetrator_Detail($perpetrator_id){
			$this->db->select('data_perpetrator.perpetrator_id, data_perpetrator.cell_group_id, data_perpetrator.perpetrator_name, data_perpetrator.perpetrator_address, data_perpetrator.perpetrator_phone, data_perpetrator.perpetrator_email, data_perpetrator.perpetrator_date_of_birth, data_perpetrator.perpetrator_registration_date, data_perpetrator.perpetrator_status');
			$this->db->from('data_perpetrator');
			$this->db->where('data_perpetrator.perpetrator_id', $perpetrator_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateDataPerpetrator($data){
			$this->db->where('data_perpetrator.perpetrator_id', $data['perpetrator_id']);
			$query = $this->db->update('data_perpetrator', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteDataPerpetrator($data){
			$this->db->where("data_perpetrator.perpetrator_id", $data['perpetrator_id']);
			$query = $this->db->update('data_perpetrator', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>