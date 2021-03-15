<?php
	Class SystemUserGroup extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('SystemUserGroup_model');
			$this->load->model('MainPage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database("default");
			$this->load->helper('url'); 
			$this->load->library('session');
		}
		
		public function index(){
			$data['main_view']['systemusergroup']		= $this->SystemUserGroup_model->getSystemUserGroup();
			$data['main_view']['content']				= 'SystemUserGroup/ListSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function AddSystemUserGroup(){
			$data['main_view']['content']				= 'SystemUserGroup/FormAddSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddSystemUserGroup(){
			$data = array(
				'user_group_name' 		=> str_replace(";","",$this->input->post('user_group_name',true))
			);
			$this->form_validation->set_rules('user_group_name', 'Group Name', 'required|is_unique[system_user_group.user_group_name]|max_length[50]');

			if($this->form_validation->run()==true){
				if($this->SystemUserGroup_model->insertSystemUserGroup($data)){

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'],  $auth['username'],'1006','Application.SystemUserGroup.processAddSystemUserGroup',$auth['username'],'Add New User Group');

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
									Add Data User Group Successfully
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUserGroup/AddSystemUserGroup');
					} else {
						$msg = "<div class='alert alert-danger alert-dismissable'>    
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>						
									New Group Created successfully, but menu privileges doesn't set. Please set menu privileges !!!
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUserGroup/AddSystemUserGroup/');
					}
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Add Data User Group UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUserGroup/AddSystemUserGroup');
				}
			}else{
				$this->session->set_userdata('AddSystemUserGroup',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUserGroup/AddSystemUserGroup');
			}
		}
		
		public function editSystemUserGroup(){
			$user_group_id 							= $this->uri->segment(3);
			$data['main_view']['systemusergroup']	= $this->SystemUserGroup_model->getSystemUserGroup_Detail($user_group_id);
			$data['main_view']['content']			= 'SystemUserGroup/FormEditSystemUserGroup_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditSystemUserGroup(){
			$old_user_group_name = $this->input->post('old_user_group_name',true);
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
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'], $auth['username'],'1007','Application.SystemUserGroup.processEditSystemUserGroup',$auth['username'],'Edit User Group');
						$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['user_group_id']);
						$msg = "<div class='alert alert-success alert-dismissable'>                  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Edited Data User Group Successfully
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUserGroup/editSystemUserGroup/'.$data['user_group_id']);
					} else {
						$msg = "<div class='alert alert-danger alert-dismissable'>                
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Failed to set menu privileges, because menu privileges doesn't set. Please set menu privileges !!!
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUserGroup/editSystemUserGroup/'.$data['user_group_id']);
					}
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>                
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
								Maaf Group Name dengan Nama $data[user_group_name] sudah ada !!!
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUserGroup/editSystemUserGroup/'.$data['user_group_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUserGroup/editSystemUserGroup/'.$data['user_group_id']);
			}
		}
		
		public function deleteSystemUserGroup(){
			$user_group_id = $this->uri->segment(3);
			if($this->SystemUserGroup_model->deleteSystemUserGroup($user_group_id)){
				
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1008','Application.SystemUserGroup.delete',$auth['username'],'Delete User Group');
				$msg = "<div class='alert alert-success alert-dismissable'>                  
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
							Delete Data User Group Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('SystemUserGroup');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Delete Data User Group UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('SystemUserGroup');
			}
		}
		
		function test(){
			echo $this->SystemUserGroup_model->isThisMenuInGroup('1','99');
		}
	}
?>