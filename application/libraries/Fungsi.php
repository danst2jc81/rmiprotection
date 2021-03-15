<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
// session_start();
Class Fungsi extends CI_Model {
	public function Fungsi(){
		parent::__construct();
		$this->CI = get_instance();
	}

	public function set_log($user_id, $transaction_id, $transaction_code, $transaction_name, $transaction_remark){

		date_default_timezone_set("Asia/Jakarta");

		$log = array(
			'user_id'				=>	$user_id,
			'transaction_id'		=> 	$transaction_id,
			'transaction_code'		=>	$transaction_code,
			'transaction_name'		=>	$transaction_name,
			'transaction_remark'	=> 	$transaction_remark,
			'transaction_date'		=> 	date("Y-m-d"),
		);
		return $this->db->insert('system_activity_log',$log);
	}

	

	public function countUserLogin(){
		$hasil = $this->db->query("SELECT COUNT(username) as juser FROM system_user WHERE log_stat='on' AND data_state='0' AND user_group_id!='1' AND user_group_id!='2'");
		$hasil = $hasil->row_array();
		return $hasil['juser'];
	}

	public function set_change_log($user_id, $transaction_id, $transaction_code, $transaction_name, $transaction_remark , $old_data, $new_data){

		$data = array(
			'user_id' 					=> $user_id,
			'transaction_id'			=> $transaction_id,
			'transaction_code'			=> $transaction_code,
			'transaction_name'			=> $transaction_name,
			'transaction_remark'		=> $transaction_remark,
			'transaction_old_data'		=> str_replace(';','-',$this->_serialize($old_data)),
			'transaction_new_data'		=> str_replace(';','-',$this->_serialize($new_data)),
			'transaction_date'			=> 	date("Y-m-d"),
		);
		return $this->db->insert('system_update_log',$data);
	}
	
	public function getLastOpnameHistory(){
		$this->db->select('month,year')->from('system_opname_history');
		$this->db->order_by('last_update','desc');
		$this->db->limit(1,0);
		$result = $this->db->get()->row_array();
		return $result;
	}
	
	function _serialize($data)
	{
		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('\\', '{{slash}}', $val);
				}
			}
		}
		else
		{
			if (is_string($data))
			{
				$data = str_replace('\\', '{{slash}}', $data);
			}
		}

		return serialize($data);
	}

	// --------------------------------------------------------------------

	/**
	 * Unserialize
	 *
	 * This function unserializes a data string, then converts any
	 * temporary slash markers back to actual slashes
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	function _unserialize($data)
	{
		$data = @unserialize(strip_slashes($data));

		if (is_array($data))
		{
			foreach ($data as $key => $val)
			{
				if (is_string($val))
				{
					$data[$key] = str_replace('{{slash}}', '\\', $val);
				}
			}

			return $data;
		}

		return (is_string($data)) ? str_replace('{{slash}}', '\\', $data) : $data;
	}
}