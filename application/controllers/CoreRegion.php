<?php
	Class CoreRegion extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'region';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreRegion_model');
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
			$sesi		= $this->session->userdata('filter-CoreRegion');

			$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
			$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);

			$data['main_view']['coreregion']		= $this->CoreRegion_model->getCoreRegion();

			$data['main_view']['content']			= 'CoreRegion/ListCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreRegion-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreRegion-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreRegion-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreRegion-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
			redirect('region/add');
		}

		public function addCoreRegion(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);

			$token		= $this->session->userdata('CoreRegionToken-'.$unique['unique']);

			if(empty($token)){
				$region_token = md5(rand());
				$this->session->set_userdata('CoreRegionToken-'.$unique['unique'], $region_token);
			}

			$data['main_view']['content']					= 'CoreRegion/FormAddCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCoreRegion(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'region_code'				=> $this->input->post('region_code',true),
				'region_name'				=> $this->input->post('region_name',true),
				'region_address'			=> $this->input->post('region_address',true),
				'region_contact_person'		=> $this->input->post('region_contact_person',true),
				'region_phone'				=> $this->input->post('region_phone',true),
				'region_token'				=> $this->input->post('region_token',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on' 				=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('region_code', 'Kode Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_name', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_address', 'Alamat Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_contact_person', 'Kontak Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_phone', 'Telepon Koordinator Wilayah', 'required');


			$region_token 					= $this->CoreRegion_model->getRegionToken($data['region_token']);
			
			if($this->form_validation->run()==true){
				if ($region_token == 0){
					if($this->CoreRegion_model->insertCoreRegion($data)){
						$auth = $this->session->userdata('auth');

						$region_id = $this->CoreRegion_model->getRegionID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $region_id, '2141', 'CoreRegion.processAddCoreRegion', 'Add New Core Region');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Koordinator Wilayah Berhasil
								</div> ";
						$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
						$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('region/add');
					}else{
						$this->session->set_userdata('addCoreRegion',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Koordinator Wilayah Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('region/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Koordinator Wilayah Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/add');
				}
			}else{
				$this->session->set_userdata('addCoreRegion',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('region/add');
			}
		}
		
		public function editCoreRegion(){
			$region_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['coreregion']	= $this->CoreRegion_model->getCoreRegion_Detail($region_id);

			$data['main_view']['content']		= 'CoreRegion/FormEditCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreRegion(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'region_id'					=> $this->input->post('region_id',true),
				'region_code'				=> $this->input->post('region_code',true),
				'region_name'				=> $this->input->post('region_name',true),
				'region_address'			=> $this->input->post('region_address',true),
				'region_contact_person'		=> $this->input->post('region_contact_person',true),
				'region_phone'				=> $this->input->post('region_phone',true),
				'updated_id'				=> $auth['user_id'],
				'updated_on' 				=> date('Ymdhis'),
			);
			
			$this->form_validation->set_rules('region_code', 'Kode Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_name', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_address', 'Alamat Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_contact_person', 'Kontak Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('region_phone', 'Telepon Koordinator Wilayah', 'required');
		
			$old_data	= $this->CoreRegion_model->getCoreRegion_Detail($data['region_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreRegion_model->updateCoreRegion($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['region_id'], '2141', 'CoreRegion.processEditCoreRegion', 'Edit Core Region');

					$this->fungsi->set_change_log($auth['user_id'], $data['region_id'], '2143', 'CoreRegion.processEditCoreRegion', 'Edit Core Region', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Koordinator Wilayah Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/edit/'.$data['region_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Koordinator Wilayah Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/edit/'.$data['region_id']);
				}
			}else{
				$this->session->set_userdata('EditCoreRegion',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('region/edit/'.$data['region_id']);
			}
		}

		public function deleteCoreRegion(){
			$auth 				= $this->session->userdata('auth');
			$region_id 			= $this->uri->segment(3);

			$data = array(
				'region_id'				=> $region_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->CoreRegion_model->deleteCoreRegion($data)){
				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CoreRegion.deleteCoreRegion', $region_id,'Delete Core Region');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Koordinator Wilayah Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('region');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Koordinator Wilayah Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('region');
			}
		}
	}
?>