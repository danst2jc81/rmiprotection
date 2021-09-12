<?php
	Class RegistrationCustomer_model extends CI_Model{
		
		public function RegistrationCustomer_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getCoreProvince()
		{
			$this->db->select('core_province.province_id, core_province.province_name');
			$this->db->from('core_province');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreCity($province_id)
		{
			$this->db->select('core_city.city_id, core_city.city_name');
			$this->db->from('core_city');
	
			$this->db->where('core_city.province_id', $province_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
		
		public function getCustomerToken($customer_token){
			$this->db->select('sales_customer.customer_token');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_token', $customer_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function getRegistrationCustomer_Email($customer_email){
			$this->db->select('sales_customer.customer_id');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_email', $customer_email);
			$result = $this->db->get()->num_rows();
			if ($result == 0){
				return true;
			} else {
				return false;
			}
		}

		public function getRegistrationCustomer_Phone($customer_mobile_phone){
			$this->db->select('sales_customer.customer_id');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.customer_mobile_phone', $customer_mobile_phone);
			$result = $this->db->get()->num_rows();
			if ($result == 0){
				return true;
			} else {
				return false;
			}
		}

		public function insertSalesCustomer($data){
			return $this->db->insert('sales_customer',$data);
		}

		public function getCustomerId($created_id){
			$this->db->select('sales_customer.customer_id');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.created_id', $created_id);
			$this->db->order_by('sales_customer.customer_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['customer_id'];
		}

		public function insertSystemUser($data){
			return $this->db->insert('system_user',$data);
		}		
	}
?>