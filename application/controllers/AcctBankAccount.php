<?php
	Class AcctBankAccount extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'bank-account';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('AcctBankAccount_model');
			$this->load->helper('sistem');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->helper('url');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addAcctBankAccount-'.$unique['unique']);
			$this->session->unset_userdata('AcctBankAccountToken-'.$unique['unique']);

			$data['main_view']['acctbankaccount']	= $this->AcctBankAccount_model->getAcctBankAccount();

			$data['main_view']['content']			= 'AcctBankAccount/ListAcctBankAccount_view';

			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addAcctBankAccount-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addAcctBankAccount-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addAcctBankAccount-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addAcctBankAccount-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addAcctBankAccount-'.$unique['unique']);
			$this->session->unset_userdata('AcctBankAccountToken-'.$unique['unique']);

			redirect('bank-account/add');
		}

		public function addAcctBankAccount(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$bank_account_token		= $this->session->userdata('AcctBankAccountToken-'.$unique['unique']);

			if(empty($bank_account_token)){
				$bank_account_token = md5(rand());
				$this->session->set_userdata('AcctBankAccountToken-'.$unique['unique'], $bank_account_token);
			}

			$data['main_view']['corebank']		= create_double($this->AcctBankAccount_model->getCoreBank(), 'bank_id', 'bank_name');	

			$data['main_view']['content']		= 'AcctBankAccount/FormAddAcctBankAccount_view';
			
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddAcctBankAccount(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data= array (
				'bank_id'				=> $this->input->post('bank_id',true),
				'bank_account_no'		=> $this->input->post('bank_account_no',true),
				'bank_account_name'		=> $this->input->post('bank_account_name',true),
				'bank_account_token'	=> $this->input->post('bank_account_token',true),
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on' 			=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('bank_id', 'Nama Bank', 'required');
			$this->form_validation->set_rules('bank_account_no', 'No Akun Bank', 'required');
			$this->form_validation->set_rules('bank_account_name', 'Nama Akun Bank', 'required');

			$bank_account_token 		= $this->AcctBankAccount_model->getBankAccountToken($data['bank_account_token']);
			
			if($this->form_validation->run()==true){
				if ($bank_account_token == 0){
					if($this->AcctBankAccount_model->insertAcctBankAccount($data)){
						$bank_account_id = $this->AcctBankAccount_model->getBankAccountID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $bank_account_id, '2141', 'AcctBankAccount.processAddAcctBankAccount', 'Add New Acct Bank Account');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Akun Bank Berhasil
								</div> ";
						$this->session->unset_userdata('addAcctBankAccount-'.$unique['unique']);
						$this->session->unset_userdata('AcctBankAccountToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('bank-account/add');
					} else {
						$this->session->set_userdata('addAcctBankAccount',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Akun Bank Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('bank-account/add');
					}
				} else {
					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Akun Bank Sudah Ada
							</div> ";
					$this->session->unset_userdata('addAcctBankAccount-'.$unique['unique']);
					$this->session->unset_userdata('AcctBankAccountToken-'.$unique['unique']);
					$this->session->set_userdata('message',$msg);
					redirect('bank-account/add');
				}
			}else{
				$this->session->set_userdata('addAcctBankAccount',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('bank-account/add');
			}
		}
		
		public function editAcctBankAccount(){
			$bank_account_id 	= $this->uri->segment(3);
			$auth 				= $this->session->userdata('auth');

			$data['main_view']['acctbankaccount']		= $this->AcctBankAccount_model->getAcctBankAccount_Detail($bank_account_id);

			$data['main_view']['corebank']				= create_double($this->AcctBankAccount_model->getCoreBank(), 'bank_id', 'bank_name');

			$data['main_view']['content']				= 'AcctBankAccount/FormEditAcctBankAccount_view';

			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditAcctBankAccount(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array (
				'bank_account_id'		=> $this->input->post('bank_account_id',true),
				'bank_id'				=> $this->input->post('bank_id',true),
				'bank_account_no'		=> $this->input->post('bank_account_no',true),
				'bank_account_name'		=> $this->input->post('bank_account_name',true),
				'updated_id'			=> $auth['user_id'],
				'updated_on' 			=> date('Ymdhis'),
			);

			/* print_r("data ");
			print_r($data);
			exit; */

			$this->form_validation->set_rules('bank_id', 'Nama Bank', 'required');
			$this->form_validation->set_rules('bank_account_no', 'No Akun Bank', 'required');
			$this->form_validation->set_rules('bank_account_name', 'Nama Akun Bank', 'required');
		
			$old_data	= $this->AcctBankAccount_model->getAcctBankAccount_Detail($data['bank_id']);
			
			if($this->form_validation->run()==true){
				if($this->AcctBankAccount_model->updateAcctBankAccount($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['bank_account_id'], '2141', 'AcctBankAccount.processEditAcctBankAccount', 'Edit Acct Bank Account');

					$this->fungsi->set_change_log($auth['user_id'], $data['bank_account_id'], '2143', 'AcctBankAccount.processEditAcctBankAccount', 'Edit Acct Bank Account', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Akun Bank Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bank-account/edit/'.$data['bank_account_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Akun Bank Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bank-account/edit/'.$data['bank_account_id']);
				}
			}else{
				$this->session->set_userdata('EditAcctBankAccount',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('bank-account/edit/'.$data['bank_id']);
			}
		}

		public function deleteAcctBankAccount(){
			$auth 					= $this->session->userdata('auth');
			$bank_account_id 		= $this->uri->segment(3);

			$data = array(
				'bank_account_id'		=> $bank_account_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->AcctBankAccount_model->deleteAcctBankAccount($data)){
				$this->fungsi->set_log($auth['user_id'], $bank_account_id, '3204','AcctBankAccount.deleteAcctBankAccount', 'Delete Acct Bank Account');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Akun Bank Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bank-account');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Akun Bank Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bank-account');
			}
		}

		
	}
?>