<?php
	Class SystemUserGroup extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'user-group';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('SystemUserGroup_model');
			$this->load->helper('sistem');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->helper('url');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$data['main_view']['systemusergroup']		= $this->SystemUserGroup_model->getSystemUserGroup();
			$data['main_view']['content']				= 'SystemUserGroup/ListSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addSystemUserGroup(){
			$data['main_view']['content']				= 'SystemUserGroup/FormAddSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddSystemUserGroup(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'user_group_name' 		=> str_replace(";","",$this->input->post('user_group_name',true))
			);
			$this->form_validation->set_rules('user_group_name', 'Group Name', 'required|is_unique[system_user_group.user_group_name]|max_length[50]');

			if($this->form_validation->run()==true){
				if($this->SystemUserGroup_model->insertSystemUserGroup($data)){

					$this->fungsi->set_log($auth['user_id'],  $auth['username'],'1006','SystemUserGroup.processAddSystemUserGroup', 'Add New User Group');

					$level = $this->SystemUserGroup_model->getMenuID($data['user_group_name']);

					foreach($_POST as $key=>$val){
						$tmp = explode("_",$key);
						if($tmp[1]=="FT"){
							$MM[$tmp[0]] = 1;
						}
					}
					
					if(count($MM)>0){
						$this->SystemUserGroup_model->deleteMapping($level);
						foreach($MM as $key=>$val){
							$data2 = array(
								'user_group_level' 	=> $level,
								'id_menu'			=> $key
							);
							$this->SystemUserGroup_model->saveMapping($data2);
						}
					
						$msg = "<div class='alert alert-success alert-dismissable'>                  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Tambah Group User Berhasil
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('user-group/add');
					} else {
						$msg = "<div class='alert alert-danger alert-dismissable'>    
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>						
									New Group Created successfully, but menu privileges doesn't set. Please set menu privileges !!!

									Tambah Group User Berhasil. Hak Akses Menu Belum Di Buat 
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('user-group/add');
					}
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Tambah Group User Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('user-group/add');
				}
			}else{
				$this->session->set_userdata('AddSystemUserGroup',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('user-group/add');
			}
		}
		
		public function editSystemUserGroup(){
			$user_group_id 							= $this->uri->segment(3);

			$data['main_view']['systemusergroup']	= $this->SystemUserGroup_model->getSystemUserGroup_Detail($user_group_id);

			$data['main_view']['content']			= 'SystemUserGroup/FormEditSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditSystemUserGroup(){
			$auth 						= $this->session->userdata('auth');

			$old_user_group_name 		= $this->input->post('old_user_group_name', true);

			$data = array(
				'user_group_id' 		=> $this->input->post('user_group_id',true),
				'user_group_name' 		=> str_replace(";","",$this->input->post('user_group_name',true))
			);
			$old_data = $this->SystemUserGroup_model->getSystemUserGroup_Detail($data['user_group_id']);

			$this->form_validation->set_rules('user_group_id', 'Group ID', 'required');
			$this->form_validation->set_rules('user_group_name', 'Group Name', 'required|max_length[50]');

			if($this->form_validation->run()==true){
				if($this->SystemUserGroup_model->cekGroupName($data['user_group_name']) || $old_user_group_name==$data['user_group_name']){
					foreach($_POST as $key=>$val){
						$tmp = explode("_",$key);
						if($tmp[1]=="FT"){
							$MM[$tmp[0]] = 1;
						}
					}
					if(count($MM)>0 && $this->SystemUserGroup_model->UpdateGroup($data)){
						$this->SystemUserGroup_model->deleteMapping($data['user_group_id']);
						foreach($MM as $key=>$val){
							$data2 = array(
								'user_group_level' 	=> $data['user_group_id'],
								'id_menu'			=> $key
							);
							$this->SystemUserGroup_model->saveMapping($data2);
						}
						

						$this->fungsi->set_log($auth['user_id'], $data['user_group_id'], '2141', 'SystemUserGroup.processEditSystemUserGroup', 'Edit System User Group');

						$this->fungsi->set_change_log($auth['user_id'], $data['user_group_id'], '2143', 'SystemUserGroup.processEditSystemUserGroup', 'Edit System User Group', $old_data, $data);

						$msg = "<div class='alert alert-success alert-dismissable'>                  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Edit Group User Berhasil
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('user-group/edit/'.$data['user_group_id']);
					} else {
						$msg = "<div class='alert alert-danger alert-dismissable'>                
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Edit Group User Gagal, Menu Belum Di Input
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('user-group/edit/'.$data['user_group_id']);
					}
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>                
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
								Maaf Group Name dengan Nama $data[user_group_name] sudah ada !!!
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('user-group/edit/'.$data['user_group_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('user-group/edit/'.$data['user_group_id']);
			}
		}
		
		public function deleteSystemUserGroup(){
			$auth 			= $this->session->userdata('auth');
			$user_group_id 	= $this->uri->segment(3);

			if($this->SystemUserGroup_model->deleteSystemUserGroup($user_group_id)){
				$this->fungsi->set_log($auth['user_id'], $user_group_id, '2141', 'SystemUserGroup.deleteSystemUserGroup', 'Delete System User Group');

				$msg = "<div class='alert alert-success alert-dismissable'>                  
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
							Delete Data User Group Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user-group');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Delete Data User Group UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user-group');
			}
		}
	}
?>