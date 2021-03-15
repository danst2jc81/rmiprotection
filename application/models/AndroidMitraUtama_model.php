<?php
	class AndroidMitraUtama_model extends CI_Model {
		var $table = "acct_account";
		
		public function AndroidMitraUtama_model(){
			parent::__construct();
			$this->CI = get_instance();
		}

		public function getProductionResult($data){
			$this->db->select('production_result.production_result_id, production_result.production_result_date, production_result.warehouse_id, invt_warehouse.warehouse_name, production_result.machine_id, core_machine.machine_name');
			$this->db->from('production_result');
			$this->db->join('production_result_item', 'production_result.production_result_id = production_result_item.production_result_id');
			$this->db->join('invt_warehouse', 'production_result.warehouse_id = invt_warehouse.warehouse_id');
			$this->db->join('core_machine', 'production_result.machine_id = core_machine.machine_id');
			$this->db->where('production_result.production_result_date >=', $data['start_date']);
			$this->db->where('production_result.production_result_date <=', $data['end_date']);
			$this->db->where('production_result.data_state', 0);

			if ($data['warehouse_check'] == 1){
				$this->db->where('production_result.warehouse_id', $data['warehouse_id']);	
			}

			if ($data['machine_check'] == 1){
				$this->db->where('production_result.machine_id', $data['machine_id']);	
			}

			if ($data['item_check'] == 1){
				$this->db->where('production_result_item.item_id', $data['item_id']);	
			}
			
			$this->db->order_by('production_result.production_result_id', 'DESC');
			$this->db->distinct();
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getProductionResultItem_Detail($production_result_id, $item_check, $item_id){
			$this->db->select('production_result_item.item_category_id, invt_item_category.item_category_name, production_result_item.item_id, invt_item.item_name, production_result_item.quantity, production_result_item.item_unit_id, invt_item_unit.item_unit_name');
			$this->db->from('production_result_item');
			$this->db->join('invt_item_category', 'production_result_item.item_category_id = invt_item_category.item_category_id');
			$this->db->join('invt_item', 'production_result_item.item_id = invt_item.item_id');
			$this->db->join('invt_item_unit', 'production_result_item.item_unit_id = invt_item_unit.item_unit_id');

			if ($item_check == 1){
				$this->db->where('production_result_item.item_id', $item_id);	
			}
			
			/* $this->db->where('production_result_item.data_state', 0); */
			$this->db->where('production_result_item.production_result_id', $production_result_id);	
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getInvtWarehouse(){
			$this->db->select('invt_warehouse.warehouse_id, invt_warehouse.warehouse_code, invt_warehouse.warehouse_name, invt_warehouse.warehouse_phone, invt_warehouse.warehouse_address');
			$this->db->from('invt_warehouse');
			$this->db->where('invt_warehouse.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreMachine($warehouse_id){
			$this->db->select('core_machine.machine_id, core_machine.machine_code, core_machine.machine_name, core_machine.warehouse_id, invt_warehouse.warehouse_name');
			$this->db->from('core_machine');
			$this->db->join('invt_warehouse', 'core_machine.warehouse_id = invt_warehouse.warehouse_id');
			$this->db->where('core_machine.data_state', 0);
			$this->db->where('core_machine.warehouse_id', $warehouse_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getInvtItemCategory(){
			$this->db->select('invt_item_category.item_category_id, invt_item_category.item_category_name');
			$this->db->from('invt_item_category');
			$this->db->where('invt_item_category.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getInvtItem_All(){
			$this->db->select('invt_item.item_category_id, invt_item_category.item_category_name, invt_item.item_id, invt_item.item_name');
			$this->db->from('invt_item');
			$this->db->join('invt_item_category', 'invt_item.item_category_id = invt_item_category.item_category_id');
			$this->db->where('invt_item.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getInvtItem($item_category_id){
			$this->db->select('invt_item.item_category_id, invt_item_category.item_category_name, invt_item.item_id, invt_item.item_name');
			$this->db->from('invt_item');
			$this->db->join('invt_item_category', 'invt_item.item_category_id = invt_item_category.item_category_id');
			$this->db->where('invt_item.data_state', 0);
			$this->db->where('invt_item.item_category_id', $item_category_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getInvtItemUnit(){
			$this->db->select('invt_item_unit.item_unit_id, invt_item_unit.item_unit_name');
			$this->db->from('invt_item_unit');
			$this->db->where('invt_item_unit.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertProductionResult($data){
			if($this->db->insert('production_result', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getProductionResultID($created_id){
			$this->db->select('production_result.production_result_id');
			$this->db->from('production_result');
			$this->db->where('production_result.created_id', $created_id);
			$this->db->order_by('production_result.production_result_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['production_result_id'];
		}

		public function insertProductionResultItem($data){
			if($this->db->insert('production_result_item', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getAcctExpense(){
			$this->db->select('acct_expense.expense_id, acct_expense.expense_name, acct_expense.account_id');
			$this->db->from('acct_expense');
			$this->db->where('acct_expense.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getAcctDisbursement($start_date, $end_date){
			$this->db->select('acct_disbursement.disbursement_id, acct_disbursement.disbursement_date, acct_disbursement.expense_id, acct_expense.expense_name, acct_disbursement.disbursement_amount_total');
			$this->db->from('acct_disbursement');
			$this->db->join('acct_expense', 'acct_disbursement.expense_id = acct_expense.expense_id');
			$this->db->where('acct_disbursement.data_state', 0);
			$this->db->where('acct_disbursement.disbursement_date >=', $start_date);
			$this->db->where('acct_disbursement.disbursement_date <=', $end_date);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertAcctDisbursement($data){
			if ($this->db->insert('acct_disbursement', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getAcctDisbursement_Last($created_id){
			$this->db->select('acct_disbursement.disbursement_id, acct_disbursement.disbursement_no');
			$this->db->from('acct_disbursement');
			$this->db->where('acct_disbursement.created_id', $created_id);
			$this->db->order_by('acct_disbursement.disbursement_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getDisbursementID($created_id){
			$this->db->select('acct_disbursement.disbursement_id');
			$this->db->from('acct_disbursement');
			$this->db->where('acct_disbursement.created_id', $created_id);
			$this->db->order_by('acct_disbursement.disbursement_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['disbursement_id'];
		}

		public function insertAcctDisbursementItem($data){
			if($this->db->insert('acct_disbursement_item', $data)){
				return true;
			}else{
				return false;
			}
		}	

		public function getAcctDisbursement_Detail($disbursement_id){
			$this->db->select('acct_disbursement.disbursement_id, acct_disbursement.disbursement_no, acct_disbursement.disbursement_date, acct_disbursement.disbursement_title, acct_disbursement.disbursement_amount_total, acct_disbursement.account_id, acct_account.account_name, acct_disbursement.created_id, acct_disbursement.created_on');
			$this->db->from('acct_disbursement');
			$this->db->join('acct_account', 'acct_disbursement.account_id = acct_account.account_id');
			$this->db->where('acct_disbursement.disbursement_id', $disbursement_id);
			return $this->db->get()->row_array();
		}

		public function getAcctDisbursementItem_Detail($disbursement_id){
			$this->db->select('acct_disbursement_item.disbursement_item_id, acct_disbursement_item.disbursement_item_title, acct_disbursement_item.disbursement_item_amount');
			$this->db->from('acct_disbursement_item');
			$this->db->where('acct_disbursement_item.disbursement_id', $disbursement_id);
			return $this->db->get()->result_array();
		}

		public function insertInvtWarehouse($data){
			if($this->db->insert('invt_warehouse', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function insertCoreMachine($data){
			if($this->db->insert('core_machine', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function insertAcctExpense($data){
			if($this->db->insert('acct_expense', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getSalesDeliveryNote($data, $start_date, $end_date){
			$this->db->select('sales_delivery_note.sales_delivery_note_id, sales_delivery_note.sales_delivery_note_date, sales_delivery_note.customer_id, sales_customer.customer_name, sales_delivery_note.sales_delivery_note_no');
			$this->db->from('sales_delivery_note');
			$this->db->join('sales_delivery_note_item', 'sales_delivery_note.sales_delivery_note_id = sales_delivery_note_item.sales_delivery_note_id');
			$this->db->join('sales_customer', 'sales_delivery_note.customer_id = sales_customer.customer_id');
			$this->db->where('sales_delivery_note.sales_delivery_note_date >=', $start_date);
			$this->db->where('sales_delivery_note.sales_delivery_note_date <=', $end_date);
			$this->db->where('sales_delivery_note.data_state', 0);

			if ($data['item_check'] == 1){
				$this->db->where('sales_delivery_note_item.item_id', $data['item_id']);	
			}
			
			$this->db->order_by('sales_delivery_note.sales_delivery_note_id', 'DESC');
			$this->db->distinct();
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesDeliveryNoteItem_Detail($sales_delivery_note_id, $item_check, $item_id){
			$this->db->select('sales_delivery_note_item.item_category_id, invt_item_category.item_category_name, sales_delivery_note_item.item_id, invt_item.item_name, sales_delivery_note_item.quantity, sales_delivery_note_item.item_unit_id, invt_item_unit.item_unit_name');
			$this->db->from('sales_delivery_note_item');
			$this->db->join('invt_item_category', 'sales_delivery_note_item.item_category_id = invt_item_category.item_category_id');
			$this->db->join('invt_item', 'sales_delivery_note_item.item_id = invt_item.item_id');
			$this->db->join('invt_item_unit', 'sales_delivery_note_item.item_unit_id = invt_item_unit.item_unit_id');

			if ($item_check == 1){
				$this->db->where('sales_delivery_note_item.item_id', $item_id);	
			}
			
			/* $this->db->where('production_result_item.data_state', 0); */
			$this->db->where('sales_delivery_note_item.sales_delivery_note_id', $sales_delivery_note_id);	
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesCustomer(){
			$this->db->select('sales_customer.customer_id, sales_customer.customer_name, sales_customer.customer_address');
			$this->db->from('sales_customer');
			$this->db->where('sales_customer.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function insertSalesDeliveryNote($data){
			if($this->db->insert('sales_delivery_note', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getSalesDeliveryNoteID($created_id){
			$this->db->select('sales_delivery_note.sales_delivery_note_id');
			$this->db->from('sales_delivery_note');
			$this->db->where('sales_delivery_note.created_id', $created_id);
			$this->db->order_by('sales_delivery_note.sales_delivery_note_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['sales_delivery_note_id'];
		}

		public function insertSalesDeliveryNoteItem($data){
			if($this->db->insert('sales_delivery_note_item', $data)){
				return true;
			}else{
				return false;
			}
		}

		public function getProductionResultDetail($production_result_id){
			$this->db->select('production_result.production_result_id, production_result.warehouse_id, invt_warehouse.warehouse_name, production_result.machine_id, core_machine.machine_name, production_result.production_result_date');
			$this->db->from('production_result');
			$this->db->join('invt_warehouse', 'production_result.warehouse_id = invt_warehouse.warehouse_id');
			$this->db->join('core_machine', 'production_result.machine_id = core_machine.machine_id');
			$this->db->where('production_result.production_result_id', $production_result_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getProductionResultItemDetail($production_result_id){
			$this->db->select('production_result_item.production_result_item_id, production_result_item.item_category_id, invt_item_category.item_category_name, production_result_item.item_id, invt_item.item_name, production_result_item.item_unit_id, invt_item_unit.item_unit_name, production_result_item.quantity');
			$this->db->from('production_result_item');
			$this->db->join('invt_item_category', 'production_result_item.item_category_id = invt_item_category.item_category_id');
			$this->db->join('invt_item', 'production_result_item.item_id = invt_item.item_id');
			$this->db->join('invt_item_unit', 'production_result_item.item_unit_id = invt_item_unit.item_unit_id');
			$this->db->where('production_result_item.production_result_id', $production_result_id);
			$this->db->where('production_result_item.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getSalesDeliveryNoteDetail($sales_delivery_note_id){
			$this->db->select('sales_delivery_note.sales_delivery_note_id, sales_delivery_note.sales_delivery_note_no, sales_delivery_note.customer_id, sales_customer.customer_name, sales_delivery_note.sales_delivery_note_date');
			$this->db->from('sales_delivery_note');
			$this->db->join('sales_customer', 'sales_delivery_note.customer_id = sales_customer.customer_id');
			$this->db->where('sales_delivery_note.sales_delivery_note_id', $sales_delivery_note_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getSalesDeliveryNoteItemDetail($sales_delivery_note_id){
			$this->db->select('sales_delivery_note_item.sales_delivery_note_item_id, sales_delivery_note_item.item_category_id, invt_item_category.item_category_name, sales_delivery_note_item.item_id, invt_item.item_name, sales_delivery_note_item.item_unit_id, invt_item_unit.item_unit_name, sales_delivery_note_item.quantity');
			$this->db->from('sales_delivery_note_item');
			$this->db->join('invt_item_category', 'sales_delivery_note_item.item_category_id = invt_item_category.item_category_id');
			$this->db->join('invt_item', 'sales_delivery_note_item.item_id = invt_item.item_id');
			$this->db->join('invt_item_unit', 'sales_delivery_note_item.item_unit_id = invt_item_unit.item_unit_id');
			$this->db->where('sales_delivery_note_item.sales_delivery_note_id', $sales_delivery_note_id);
			$this->db->where('sales_delivery_note_item.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getAcctDisbursementDetail($disbursement_id){
			$this->db->select('acct_disbursement.disbursement_id, acct_disbursement.disbursement_date, acct_disbursement.expense_id, acct_expense.expense_name, acct_disbursement.disbursement_date, acct_disbursement.disbursement_title');
			$this->db->from('acct_disbursement');
			$this->db->join('acct_expense', 'acct_disbursement.expense_id = acct_expense.expense_id');
			$this->db->where('acct_disbursement.disbursement_id', $disbursement_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function getAcctDisbursementItemDetail($disbursement_id){
			$this->db->select('acct_disbursement_item.disbursement_item_id, acct_disbursement_item.disbursement_item_title, acct_disbursement_item.disbursement_item_amount');
			$this->db->from('acct_disbursement_item');
			$this->db->where('acct_disbursement_item.disbursement_id', $disbursement_id);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function voidSalesDeliveryNote($data){
			$this->db->where("sales_delivery_note.sales_delivery_note_id", $data['sales_delivery_note_id']);
			$query = $this->db->update('sales_delivery_note', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function voidProductionResult($data){
			$this->db->where("production_result.production_result_id", $data['production_result_id']);
			$query = $this->db->update('production_result', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function voidAcctDisbursement($data){
			$this->db->where("acct_disbursement.disbursement_id", $data['disbursement_id']);
			$query = $this->db->update('acct_disbursement', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateSalesDeliveryNote($data){
			$this->db->where("sales_delivery_note.sales_delivery_note_id", $data['sales_delivery_note_id']);
			$query = $this->db->update('sales_delivery_note', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function voidSalesDeliveryNoteItem($data){
			$this->db->where("sales_delivery_note_item.sales_delivery_note_item_id", $data['sales_delivery_note_item_id']);
			$query = $this->db->update('sales_delivery_note_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function updateProductionResult($data){
			$this->db->where("production_result.production_result_id", $data['production_result_id']);
			$query = $this->db->update('production_result', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function voidProductionResultItem($data){
			$this->db->where("production_result_item.production_result_item_id", $data['production_result_item_id']);
			$query = $this->db->update('production_result_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getUpdateAcctDisbursementDetail($disbursement_id){
			$this->db->select('acct_disbursement.disbursement_id, acct_disbursement.disbursement_date, acct_disbursement.expense_id, acct_expense.expense_name, acct_disbursement.disbursement_date, acct_disbursement.disbursement_title, acct_disbursement_item.disbursement_item_amount, acct_disbursement_item.disbursement_item_title');
			$this->db->from('acct_disbursement');
			$this->db->join('acct_disbursement_item', 'acct_disbursement.disbursement_id = acct_disbursement_item.disbursement_id');
			$this->db->join('acct_expense', 'acct_disbursement.expense_id = acct_expense.expense_id');
			$this->db->where('acct_disbursement.disbursement_id', $disbursement_id);
			$result = $this->db->get()->row_array();
			return $result;
		}

		public function updateAcctDisbursement($data){
			$this->db->where("acct_disbursement.disbursement_id", $data['disbursement_id']);
			$query = $this->db->update('acct_disbursement', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function updateAcctDisbursementItem($data){
			$this->db->where("acct_disbursement_item.disbursement_id", $data['disbursement_id']);
			$query = $this->db->update('acct_disbursement_item', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function getInvtItemStock($item_category_id){
			$this->db->select('invt_item_stock.item_category_id, invt_item_category.item_category_name, invt_item_stock.item_id, invt_item.item_code, invt_item.item_name, invt_item_stock.item_unit_id, invt_item_unit.item_unit_code, invt_item_stock.last_balance');
			$this->db->from('invt_item_stock');
			$this->db->join('invt_item_category', 'invt_item_stock.item_category_id = invt_item_category.item_category_id');
			$this->db->join('invt_item', 'invt_item_stock.item_id = invt_item.item_id');
			$this->db->join('invt_item_unit', 'invt_item_stock.item_unit_id = invt_item_unit.item_unit_id');
			$this->db->where('invt_item_stock.last_balance > 0');
			$this->db->where('invt_item_stock.item_category_id', $item_category_id);
			$result = $this->db->get()->result_array();
			return $result;
		}
	}
?>