<?php
	Class CorePackage extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'package';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CorePackage_model');
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
			$sesi		= $this->session->userdata('filter-CorePackage');

			$this->session->unset_userdata('addCorePackage-'.$unique['unique']);
			$this->session->unset_userdata('CorePackageToken-'.$unique['unique']);

			$data['main_view']['corepackage']		= $this->CorePackage_model->getCorePackage();

			$data['main_view']['packagestatus']		= $this->configuration->PackageStatus();

			$data['main_view']['content']				= 'CorePackage/ListCorePackage_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePackage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCorePackage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePackage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCorePackage-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCorePackage-'.$unique['unique']);
			redirect('package/add');
		}

		public function addCorePackage(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CorePackageToken-'.$unique['unique']);

			$package_token		= $this->session->userdata('CorePackageToken-'.$unique['unique']);

			if(empty($package_token)){
				$package_token = md5(rand());
				$this->session->set_userdata('CorePackageToken-'.$unique['unique'], $package_token);
			}

			$data['main_view']['packagestatus']		= $this->configuration->PackageStatus();

			$data['main_view']['content']			= 'CorePackage/FormAddCorePackage_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCorePackage(){
			$auth		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data= array (
				'package_name'		=> $this->input->post('package_name',true),
				'package_status'	=> $this->input->post('package_address',true),
				'package_token'		=> $this->input->post('package_token',true),
				'data_state'		=> 0,
				'created_id'		=> $auth['user_id'],
				'created_on' 		=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('package_name', 'Nama Paket', 'required');

			$package_token 			= $this->CorePackage_model->getPackageToken($data['package_token']);
			
			if($this->form_validation->run()==true){
				if ($package_token == 0){
					if($this->CorePackage_model->insertCorePackage($data)){
						$auth = $this->session->userdata('auth');

						$package_id = $this->CorePackage_model->getPackageID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $package_id, '2141', 'CorePackage.processAddCorePackage', 'Add New Core Package');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Paket Berhasil
								</div> ";
						$this->session->unset_userdata('addCorePackage-'.$unique['unique']);
						$this->session->unset_userdata('CorePackageToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('package/add');
					}else{
						$this->session->set_userdata('addCorePackage',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Paket Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('package/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Paket Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package/add');
				}
			}else{
				$this->session->set_userdata('addCorePackage',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('package/add');
			}
		}

		public function reset_edit(){
			$package_id 	= $this->uri->segment(3);

			redirect('package/edit/'.$package_id);
		}
		
		public function editCorePackage(){
			$package_id 	= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['corepackage']		= $this->CorePackage_model->getCorePackage_Detail($package_id);

			$data['main_view']['packagestatus']		= $this->configuration->PackageStatus();

			$data['main_view']['content']			= 'CorePackage/FormEditCorePackage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCorePackage(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'package_id'				=> $this->input->post('package_id',true),
				'package_name'				=> $this->input->post('package_name',true),
				'package_status'			=> $this->input->post('package_status',true),
				'updated_id'				=> $auth['user_id'],
				'updated_on' 				=> date('Ymdhis'),
			);
				
			$this->form_validation->set_rules('package_name', 'Nama Paket', 'required');
			$this->form_validation->set_rules('package_status', 'Alamat', 'required');
		
			$old_data	= $this->CorePackage_model->getCorePackage_Detail($data['package_id']);
			
			if($this->form_validation->run()==true){
				if($this->CorePackage_model->updateCorePackage($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['package_id'], '2141', 'CorePackage.processEditCorePackage', 'Edit Core Package');

					$this->fungsi->set_change_log($auth['user_id'], $data['package_id'], '2143', 'CorePackage.processEditCorePackage', 'Edit Core Package', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Paket Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package/edit/'.$data['package_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Paket Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package/edit/'.$data['package_id']);
				}
			}else{
				$this->session->set_userdata('EditCorePackage',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('package/edit/'.$data['package_id']);
			}
		}

		public function deleteCorePackage(){
			$auth 				= $this->session->userdata('auth');
			$package_id 	= $this->uri->segment(3);

			$data = array(
				'package_id'		=> $package_id,
				'deleted_id'		=> $auth['user_id'],
				'deleted_on'		=> date("Y-m-d H:i:s"),
				'data_state'		=> 2
			);

			if($this->CorePackage_model->deleteCorePackage($data)){
				

				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CorePackage.deleteCorePackage', $package_id, 'Delete Core Package');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Paket Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('package');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Paket Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('package');
			}
		}
	}
?>