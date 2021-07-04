<?php
	class SalesCustomer_model extends CI_Model {
		var $table = "data_perpetrator";
		
		public function SalesCustomer_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getSalesCustomer($start_date, $end_date, $customer_status, $package_id)
		{
			$this->db->select('sales_customer.customer_id, sales_customer.package_id, core_package.package_name, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_status, sales_customer.customer_registration_date');
			$this->db->from('sales_customer');
			$this->db->join('core_package', 'sales_customer.package_id = core_package.package_id');
			$this->db->where('sales_customer.data_state', 0);
			$this->db->where('sales_customer.customer_registration_date >=', $start_date);
			$this->db->where('sales_customer.customer_registration_date <=', $end_date);
			
			if ($customer_status != 9){
				$this->db->where('sales_customer.customer_status', $customer_status);
			}

			if ($package_id != ""){
				$this->db->where('sales_customer.package_id', $package_id);
			}

			$this->db->order_by('sales_customer.customer_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCorePackage()
		{
			$this->db->select('core_package.package_id, core_package.package_name');
			$this->db->from('core_package');
			$this->db->where('core_package.data_state', 0);
			$this->db->order_by('core_package.package_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesCustomer_Detail($customer_id)
		{
			$this->db->select('sales_customer.customer_id, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_status, sales_customer.customer_registration_date, sales_customer.customer_verification_code, sales_customer.customer_status, sales_customer.customer_collection_status');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.data_state', 0);
			$this->db->where('sales_customer.customer_id', $customer_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getSalesCustomer_UnPaid()
		{
			$this->db->select('sales_customer.customer_id, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_status, sales_customer.customer_registration_date, sales_customer.customer_collection_status');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.data_state', 0);
			$this->db->where('sales_customer.customer_collection_status', 0);
			$this->db->order_by('sales_customer.customer_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateSalesCustomer_Collection($data){
			$this->db->where('sales_customer.customer_id', $data['customer_id']);
			if($this->db->update('sales_customer', $data)){
				return true;
			} else {
				return false;
			}
		}
	}
?>