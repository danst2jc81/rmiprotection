<?php
	class SalesCustomerPackage_model extends CI_Model {
		var $table = "data_perpetrator";
		
		public function SalesCustomerPackage_model(){
			parent::__construct();
			$this->CI = get_instance();
		} 

		public function getSalesCustomerPackage($start_date, $end_date, $customer_status, $package_id)
		{
			$this->db->select('sales_customer_package.customer_id, sales_customer_package.package_id, core_package.package_name, sales_customer_package.customer_name, sales_customer_package.customer_email, sales_customer_package.customer_mobile_phone, sales_customer_package.customer_status, sales_customer_package.customer_registration_date');
			$this->db->from('sales_customer_package');
			$this->db->join('core_package', 'sales_customer_package.package_id = core_package.package_id');
			$this->db->where('sales_customer_package.data_state', 0);
			$this->db->where('sales_customer_package.customer_registration_date >=', $start_date);
			$this->db->where('sales_customer_package.customer_registration_date <=', $end_date);
			
			if ($customer_status != 9){
				$this->db->where('sales_customer_package.customer_status', $customer_status);
			}

			if ($package_id != ""){
				$this->db->where('sales_customer_package.package_id', $package_id);
			}

			$this->db->order_by('sales_customer_package.customer_id', 'ASC');
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

		public function getSalesCustomerPackage_Detail($customer_package_id)
		{
			$this->db->select('sales_customer_package.customer_package_id, sales_customer_package.customer_id, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_status, sales_customer_package.package_id, core_package.package_name, core_package.package_search_balance, core_package.package_add_balance, core_package.package_balance_status, sales_customer_package.package_status, sales_customer_package.package_price_id, core_package_price.package_price_name, sales_customer_package.package_price_month, sales_customer_package.package_price_amount, sales_customer_package.package_price_status');
			$this->db->from('sales_customer_package');
			$this->db->join('sales_customer', 'sales_customer_package.customer_id = sales_customer.customer_id');
			$this->db->join('core_package', 'sales_customer_package.package_id = core_package.package_id');
			$this->db->join('core_package_price', 'sales_customer_package.package_price_id = core_package_price.package_price_id');
			$this->db->where('sales_customer_package.customer_package_id', $customer_package_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getSalesCustomerPackage_UnPaid()
		{
			$this->db->select('sales_customer_package.customer_package_id, sales_customer_package.customer_id, sales_customer.customer_name, sales_customer.customer_email, sales_customer.customer_mobile_phone, sales_customer.customer_status, sales_customer_package.package_id, core_package.package_name, sales_customer_package.package_price_id, core_package_price.package_price_name, core_package_price.package_price_month, core_package_price.package_price_amount, core_package_price.package_price_status');
			$this->db->from('sales_customer_package');
			$this->db->join('sales_customer', 'sales_customer_package.customer_id = sales_customer.customer_id');
			$this->db->join('core_package', 'sales_customer_package.package_id = core_package.package_id');
			$this->db->join('core_package_price', 'sales_customer_package.package_price_id = core_package_price.package_price_id');
			$this->db->where('sales_customer_package.data_state', 0);
			$this->db->where('sales_customer_package.customer_package_status', 0);
			$this->db->order_by('sales_customer_package.customer_package_id', 'ASC');
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function updateSalesCustomerPackage_Collection($data){
			$this->db->where('sales_customer_package.customer_package_id', $data['customer_package_id']);
			if($this->db->update('sales_customer_package', $data)){
				return true;
			} else {
				return false;
			}
		}

		public function updateSalesCustomer($data){
			$this->db->where('sales_customer.customer_id', $data['customer_id']);
			if($this->db->update('sales_customer', $data)){
				return true;
			} else {
				return false;
			}
		}
	}
?>