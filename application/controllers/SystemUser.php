<?php
	Class SystemUser extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'user';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('SystemUser_model');
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
			$sesi		= $this->session->userdata('filter-SystemUser');

			if(!is_array($sesi)){
				$sesi['region_id']			= '';
				$sesi['branch_id']			= '';
				$sesi['vendor_id']			= '';
				$sesi['user_group_id']		= '';
			}

			$this->session->unset_userdata('addSystemUser-'.$unique['unique']);
			$this->session->unset_userdata('SystemUserToken-'.$unique['unique']);

			$data['main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(), 'user_group_level', 'user_group_name');

			$data['main_view']['coreregion']		= create_double($this->SystemUser_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['systemuser']		= $this->SystemUser_model->getSystemUser($sesi['region_id'], $sesi['branch_id'], $sesi['vendor_id'], $sesi['user_group_id']);

			$data['main_view']['content']			= 'SystemUser/ListSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'region_id'				=> $this->input->post('region_id'),
				'branch_id'				=> $this->input->post('branch_id'),
				'vendor_id'				=> $this->input->post('vendor_id',true),
				'user_group_id'			=> $this->input->post('user_group_id',true),
			);
			$this->session->set_userdata('filter-SystemUser',$data);
			redirect('user');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-SystemUser');
			redirect('user');
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addSystemUser-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addSystemUser-'.$unique['unique'],$sessions);
		}
		
		public function addSystemUser(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('SystemUserToken-'.$unique['unique']);

			$user_token		= $this->session->userdata('SystemUserToken-'.$unique['unique']);

			if(empty($user_token)){
				$user_token = md5(rand());
				$this->session->set_userdata('SystemUserToken-'.$unique['unique'], $user_token);
			}

			$data['main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(), 'user_group_level', 'user_group_name');

			$data['main_view']['coreregion']		= create_double($this->SystemUser_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['userlevel']			= $this->configuration->UserLevel();

			$data['main_view']['content']			= 'SystemUser/FormAddSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreVendor-'.$unique['unique']);
			redirect('user/add');
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');
			
			$item = $this->SystemUser_model->getCoreBranch($region_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreVendor(){
			$branch_id = $this->input->post('branch_id');
			
			$item = $this->SystemUser_model->getCoreVendor($branch_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[vendor_id]'>$mp[vendor_name]</option>\n";	
			}
			echo $data;
		}
		
		public function processAddSystemUser(){
			$auth = $this->session->userdata('auth');
			
			$data = array(
				'user_group_id' 	=> $this->input->post('user_group_id',true),
				'region_id' 		=> $this->input->post('region_id',true),
				'branch_id' 		=> $this->input->post('branch_id',true),
				'vendor_id' 		=> $this->input->post('vendor_id',true),
				'username' 			=> str_replace(";","",$this->input->post('username',true)),
				'password' 			=> md5($this->input->post('password',true)),
				'user_level'		=> $this->input->post('user_level',true),
				'user_token'		=> $this->input->post('user_token',true),
				'created_id'		=> $auth['user_id'],
				'created_on'		=> date("y-m-d H:i:s"),
			);

			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[system_user.username]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_group_id', 'Group User', 'required');
			$this->form_validation->set_rules('user_level', 'Level User', 'required');
			$this->form_validation->set_rules('region_id', 'Nama Korwil', 'required');
			$this->form_validation->set_rules('branch_id', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('vendor_id', 'Nama Vendor', 'required');

			$user_token 			= $this->SystemUser_model->getUserToken($data['user_token']);
			
			if($this->form_validation->run()==true){
				if ($user_token == 0){
					if($this->SystemUser_model->insertSystemUser($data)){
						$user_id = $this->SystemUser_model->getUserID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $user_id, '2141', 'SystemUser.processAddSystemUser', 'Add New System User');

						$msg = "<div class='alert alert-success alert-dismissable'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
									Simpan User Baru Berhasil
								</div> ";
						
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addSystemUser-'.$unique['unique']);
						$this->session->unset_userdata('SystemUserToken-'.$unique['unique']);
						redirect('user/add');
					}else{
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>               
									Simpan User Baru Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('user/add');
					}
				}  else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>               
								Data User Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('user/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddSystemUser',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('user/add');
			}
		}
		
		public function editSystemUser(){
			$user_id = $this->uri->segment(3);

			$data['main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(), 'user_group_level', 'user_group_name');

			$data['main_view']['coreregion']		= create_double($this->SystemUser_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['systemuser']		= $this->SystemUser_model->getSystemUser_Detail($user_id);

			$data['main_view']['userlevel']			= $this->configuration->UserLevel();

			$data['main_view']['content']			= 'SystemUser/FormEditSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public  function processEditSystemUser(){
			$auth 				= $this->session->userdata('auth');
			$password 			= $this->input->post('password', true);

			$data = array(
				'user_id' 			=> $this->input->post('user_id',true),
				'username' 			=> str_replace(";","",$this->input->post('username',true)),
				'user_group_id' 	=> $this->input->post('user_group_id',true),
				'region_id' 		=> $this->input->post('region_id',true),
				'branch_id' 		=> $this->input->post('branch_id',true),
				'vendor_id' 		=> $this->input->post('vendor_id',true),
				'password'			=> md5($this->input->post('password',true)),
				'user_level'		=> $this->input->post('user_level',true),
				'updated_id'		=> $auth['user_id'],
				'updated_on'		=> date("Y-m-d H:i:s"),
			);
			
			$old_data	= $this->SystemUser_model->getSystemUser_Detail($data['user_id']);

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_group_id', 'Group User', 'required');
			$this->form_validation->set_rules('user_level', 'Level User', 'required');
			$this->form_validation->set_rules('region_id', 'Nama Korwil', 'required');
			$this->form_validation->set_rules('branch_id', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('vendor_id', 'Nama Vendor', 'required');

			if($this->form_validation->run()==true){
				
				if($this->SystemUser_model->updateSystemUser($data)){

					$this->fungsi->set_log($auth['user_id'], $data['user_id'], '2141', 'SystemUser.processEditSystemUser', 'Edit System User');

					$this->fungsi->set_change_log($auth['user_id'], $data['user_id'], '2143', 'SystemUser.processEditSystemUser', 'Edit System User', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('user/edit/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Edit Data User Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('user/edit/'.$data['user_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('user/edit/'.$data['user_id']);
			}
		}
		
		public function deleteSystemUser(){
			$auth 				= $this->session->userdata('auth');
			$user_id 			= $this->uri->segment(3);

			$data = array(
				'user_id'		=> $user_id,
				'data_state'	=> 2,
				'deleted_id'	=> $auth['user_id'],
				'deleted_on'	=> date("Y-m-d H:i:s")
,			);

			if($this->SystemUser_model->deleteSystemUser($data)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $data['user_id'], '2141', 'SystemUser.deleteSystemUser', 'Delete System User');

				$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Hapus Data User Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Hapus Data User Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user');
			}
		}
	}
?>