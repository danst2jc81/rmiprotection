<?php
	class AcctBankAccount_model extends CI_Model {
		var $table = "acct_bank_account";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		} 
		
		public function getAcctBankAccount()
		{
			$this->db->select('acct_bank_account.bank_account_id, core_bank.bank_id, core_bank.bank_code, core_bank.bank_name, acct_bank_account.bank_account_no, acct_bank_account.bank_account_name');
			$this->db->from('acct_bank_account');
			$this->db->join('core_bank', 'acct_bank_account.bank_id = core_bank.bank_id');
			$this->db->where('acct_bank_account.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getCoreBank(){
			$this->db->select('core_bank.bank_id, core_bank.bank_name');
			$this->db->from('core_bank');
			$this->db->where('core_bank.data_state', 0);
			$result = $this->db->get()->result_array();
			return $result;
		}

		public function getBankAccountToken($bank_account_token){
			$this->db->select('acct_bank_account.bank_account_token');
			$this->db->from('acct_bank_account');
			$this->db->where('acct_bank_account.bank_account_token', $bank_account_token);
			$result = $this->db->get()->num_rows();
			return $result;
		}

		public function insertAcctBankAccount($data){
			return $this->db->insert('acct_bank_account',$data);
		}

		public function getBankAccountID(){
			$this->db->select('acct_bank_account.bank_account_id');
			$this->db->from('acct_bank_account');
			$this->db->order_by('acct_bank_account.bank_account_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['bank_account_id'];
		}

		public function getAcctBankAccount_Detail($bank_account_id){
			$this->db->select('acct_bank_account.bank_account_id, core_bank.bank_id, core_bank.bank_code, core_bank.bank_name, acct_bank_account.bank_account_no, acct_bank_account.bank_account_name');
			$this->db->from('acct_bank_account');
			$this->db->join('core_bank', 'acct_bank_account.bank_id = core_bank.bank_id');
			$this->db->where('acct_bank_account.data_state', 0);
			$this->db->where('acct_bank_account.bank_account_id', $bank_account_id);
			$result = $this->db->get()->row_array();
			return $result;
		}
				
		public function updateAcctBankAccount($data){
			$this->db->where('acct_bank_account.bank_account_id', $data['bank_account_id']);
			$query = $this->db->update('acct_bank_account', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteAcctBankAccount($data){
			$this->db->where("acct_bank_account.bank_account_id", $data['bank_account_id']);
			$query = $this->db->update('acct_bank_account', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>