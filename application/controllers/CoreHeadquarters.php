<?php
	Class CoreHeadquarters extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'headquarters';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreHeadquarters_model');
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
			$sesi		= $this->session->userdata('filter-CoreHeadquarters');

			$this->session->unset_userdata('addCoreHeadquarters-'.$unique['unique']);
			$this->session->unset_userdata('CoreHeadquartersToken-'.$unique['unique']);

			$data['main_view']['coreheadquarters']		= $this->CoreHeadquarters_model->getCoreHeadquarters();

			$data['main_view']['content']				= 'CoreHeadquarters/ListCoreHeadquarters_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHeadquarters-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreHeadquarters-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHeadquarters-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreHeadquarters-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreHeadquarters-'.$unique['unique']);
			redirect('headquarters/add');
		}

		public function addCoreHeadquarters(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CoreHeadquartersToken-'.$unique['unique']);

			$token		= $this->session->userdata('CoreHeadquartersToken-'.$unique['unique']);

			if(empty($token)){
				$headquarters_token = md5(rand());
				$this->session->set_userdata('CoreHeadquartersToken-'.$unique['unique'], $headquarters_token);
			}

			$data['main_view']['content']					= 'CoreHeadquarters/FormAddCoreHeadquarters_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCoreHeadquarters(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'headquarters_name'					=> $this->input->post('headquarters_name',true),
				'headquarters_address'				=> $this->input->post('headquarters_address',true),
				'headquarters_contact_person'		=> $this->input->post('headquarters_contact_person',true),
				'headquarters_phone'				=> $this->input->post('headquarters_phone',true),
				'headquarters_token'				=> $this->input->post('headquarters_token',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on' 						=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('headquarters_name', 'Nama Pusat', 'required');
			$this->form_validation->set_rules('headquarters_address', 'Alamat', 'required');
			$this->form_validation->set_rules('headquarters_contact_person', 'Kontat', 'required');
			$this->form_validation->set_rules('headquarters_phone', 'Telepon', 'required');


			$headquarters_token 					= $this->CoreHeadquarters_model->getHeadquartersToken($data['headquarters_token']);
			
			if($this->form_validation->run()==true){
				if ($headquarters_token == 0){
					if($this->CoreHeadquarters_model->insertCoreHeadquarters($data)){
						$auth = $this->session->userdata('auth');

						$headquarters_id = $this->CoreHeadquarters_model->getHeadquartersID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $headquarters_id, '2141', 'CoreHeadquarters.processAddCoreHeadquarters', 'Add New Core Headquarters');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Pusat Berhasil
								</div> ";
						$this->session->unset_userdata('addCoreHeadquarters-'.$unique['unique']);
						$this->session->unset_userdata('CoreHeadquartersToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('headquarters/add');
					}else{
						$this->session->set_userdata('addCoreHeadquarters',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Pusat Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('headquarters/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Pusat Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('headquarters/add');
				}
			}else{
				$this->session->set_userdata('addCoreHeadquarters',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('headquarters/add');
			}
		}
		
		public function editCoreHeadquarters(){
			$headquarters_id 	= $this->uri->segment(3);
			$auth 				= $this->session->userdata('auth');

			$data['main_view']['coreheadquarters']	= $this->CoreHeadquarters_model->getCoreHeadquarters_Detail($headquarters_id);

			$data['main_view']['content']			= 'CoreHeadquarters/FormEditCoreHeadquarters_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreHeadquarters(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'headquarters_id'				=> $this->input->post('headquarters_id',true),
				'headquarters_name'				=> $this->input->post('headquarters_name',true),
				'headquarters_address'			=> $this->input->post('headquarters_address',true),
				'headquarters_contact_person'	=> $this->input->post('headquarters_contact_person',true),
				'headquarters_phone'			=> $this->input->post('headquarters_phone',true),
				'updated_id'					=> $auth['user_id'],
				'updated_on' 					=> date('Ymdhis'),
			);
				
			$this->form_validation->set_rules('headquarters_name', 'Nama Pusat', 'required');
			$this->form_validation->set_rules('headquarters_address', 'Alamat', 'required');
			$this->form_validation->set_rules('headquarters_contact_person', 'Kontak', 'required');
			$this->form_validation->set_rules('headquarters_phone', 'Telepon', 'required');
		
			$old_data	= $this->CoreHeadquarters_model->getCoreHeadquarters_Detail($data['headquarters_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreHeadquarters_model->updateCoreHeadquarters($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['headquarters_id'], '2141', 'CoreHeadquarters.processEditCoreHeadquarters', 'Edit Core Headquarters');

					$this->fungsi->set_change_log($auth['user_id'], $data['headquarters_id'], '2143', 'CoreHeadquarters.processEditCoreHeadquarters', 'Edit Core Headquarters', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Pusat Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('headquarters/edit/'.$data['headquarters_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Pusat Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('headquarters/edit/'.$data['headquarters_id']);
				}
			}else{
				$this->session->set_userdata('EditCoreHeadquarters',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('headquarters/edit/'.$data['headquarters_id']);
			}
		}

		public function deleteCoreHeadquarters(){
			$auth 				= $this->session->userdata('auth');
			$headquarters_id 	= $this->uri->segment(3);

			$data = array(
				'headquarters_id'		=> $headquarters_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->CoreHeadquarters_model->deleteCoreHeadquarters($data)){
				

				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CoreHeadquarters.deleteCoreHeadquarters', $headquarters_id,'Delete Core Headquarters');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Pusat Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('headquarters');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Pusat Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('headquarters');
			}
		}
	}
?>