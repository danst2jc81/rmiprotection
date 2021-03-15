<?php
	Class SystemUser extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('SystemUser_model');
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database("default");
			$this->load->helper('url'); 
			$this->load->library('session');
		}
		
		public function index(){
			$data['main_view']['systemuser']		= $this->SystemUser_model->getSystemUser();

			$data['main_view']['content']			= 'SystemUser/ListSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addSystemUser(){
			$data['main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(), 'user_group_level', 'user_group_name');

			$data['main_view']['userlevel']			= $this->configuration->UserLevel();

			$data['main_view']['content']			= 'SystemUser/FormAddSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddSystemUser(){
			$auth = $this->session->userdata('auth');
			$salesman_id = $this->input->post('salesman_id',true);

			$data = array(
				'user_group_id' => $this->input->post('user_group_id',true),
				'username' 		=> str_replace(";","",$this->input->post('username',true)),
				'password' 		=> md5($this->input->post('password',true)),
				'user_level'	=> $this->input->post('user_level',true),
				'log_stat'		=> 'off'
			);

			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[system_user.username]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_group_id', 'System User Group', 'required');
			$this->form_validation->set_rules('user_level', 'User Level', 'required');
			
			if($this->form_validation->run()==true){
				if($this->SystemUser_model->insertSystemUser($data)){

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'1003','Application.SystemUser.processAddSystemUser',$auth['username'],'Add New System User Account');

					$msg = "<div class='alert alert-success alert-dismissable'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
								Simpan User Baru Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/addSystemUser');
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>               
								Simpan User Baru Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/addSystemUser');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddSystemUser',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/addSystemUser');
			}
		}
		
		public function editSystemUser(){
			$user_id = $this->uri->segment(3);

			$data['main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(), 'user_group_level', 'user_group_name');

			$data['main_view']['systemuser']		= $this->SystemUser_model->getSystemUser_Detail($user_id);

			$data['main_view']['userlevel']			= $this->configuration->UserLevel();

			$data['main_view']['content']			= 'SystemUser/FormEditSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public  function processEditSystemUser(){
			$auth = $this->session->userdata('auth');
			$password 			= $this->input->post('password', true);

			$salesman_id		= $this->input->post('salesman_id', true);			
			
			$data = array(
				'user_id' 			=> $this->input->post('user_id',true),
				'username' 			=> str_replace(";","",$this->input->post('username',true)),
				'user_group_id' 	=> $this->input->post('user_group_id',true),
				'password'			=> md5($this->input->post('password',true)),
				'user_level'		=> $this->input->post('user_level',true),
			);
			
			$old_data	= $this->SystemUser_model->getSystemUser_Detail($data['user_id']);

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('user_group_id', 'User Group Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_level', 'User Level', 'required');

			if($this->form_validation->run()==true){
				
				if($this->SystemUser_model->updateSystemUser($data)){

					$this->fungsi->set_log($auth['user_id'], $auth['username'], '1004', 'Application.SystemUser.processEditSystemUser', $auth['username'], 'Add New System User Account');

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUser/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUser/'.$data['user_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/editSystemUser/'.$data['user_id']);
			}
		}
		
		public function deleteSystemUser(){
			$user_id = $this->uri->segment(3);

			if($this->SystemUser_model->deleteSystemUser($user_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'], '1005', 'Application.SystemUser.delete', $auth['username'],'Delete SystemUser Account');

				$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Hapus Data User Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Hapus Data User Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser');
			}
		}
		
		public function editSystemUserEvents(){
			$user_id = $this->uri->segment(3);

			$data['main_view']['coreevents']		= create_double($this->SystemUser_model->getCoreEvents(), 'events_id', 'events_name');

			$data['main_view']['systemuser']		= $this->SystemUser_model->getSystemUser_Detail($user_id);

			$data['main_view']['content']			= 'SystemUser/FormEditSystemUserEvents_view';
			$this->load->view('MainPage_view',$data);
		}

		public  function processEditSystemUserEvents(){
			$auth = $this->session->userdata('auth');
			
			$data = array(
				'user_id' 		=> $this->input->post('user_id',true),
				'events_id' 	=> $this->input->post('events_id',true),
			);

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('events_id', 'Nama Event ', 'required');

			if($this->form_validation->run()==true){
				
				if($this->SystemUser_model->updateSystemUser($data)){

					$this->fungsi->set_log($auth['user_id'], $auth['username'], '1004', 'Application.SystemUser.processEditSystemUser', $auth['username'], 'Edit System User Events');

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Event Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUserEvents/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Event Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUserEvents/'.$data['user_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/editSystemUserEvents/'.$data['user_id']);
			}
		}
	}
?>