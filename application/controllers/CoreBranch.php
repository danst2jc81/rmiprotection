<?php
	Class CoreBranch extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'branch';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreBranch_model');
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
			$sesi		= $this->session->userdata('filter-CoreBranch');

			if(!is_array($sesi)){
				$sesi['region_id']		= '';
				$sesi['province_id']	= '';
				$sesi['section_id']		= '';
			}

			$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
			$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);

			$data['main_view']['corebranch']		= $this->CoreBranch_model->getCoreBranch($sesi['region_id'], $sesi['province_id'], $sesi['city_id']);

			$data['main_view']['coreregion']		= create_double($this->CoreBranch_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreBranch_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreBranch/ListCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'region_id'				=> $this->input->post('region_id'),
				'province_id'			=> $this->input->post('province_id',true),
				'city_id'				=> $this->input->post('city_id',true),
			);
			$this->session->set_userdata('filter-CoreBranch',$data);
			redirect('branch');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-CoreBranch');
			redirect('branch');
		}

		public function getCoreCity(){
			$province_id = $this->input->post('province_id');
			
			$item = $this->CoreBranch_model->getCoreCity($province_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[city_id]'>$mp[city_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreBranch-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreBranch-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreBranch-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreBranch-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
			redirect('branch/add');
		}

		public function addCoreBranch(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);

			$token		= $this->session->userdata('CoreBranchToken-'.$unique['unique']);

			if(empty($token)){
				$branch_token = md5(rand());
				$this->session->set_userdata('CoreBranchToken-'.$unique['unique'], $branch_token);
			}

			$data['main_view']['coreregion']		= create_double($this->CoreBranch_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreBranch_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreBranch/FormAddCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCoreBranch(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'region_id'					=> $this->input->post('region_id',true),
				'province_id'				=> $this->input->post('province_id',true),
				'city_id'					=> $this->input->post('city_id',true),
				'branch_code'				=> $this->input->post('branch_code',true),
				'branch_name'				=> $this->input->post('branch_name',true),
				'branch_address'			=> $this->input->post('branch_address',true),
				'branch_contact_person'		=> $this->input->post('branch_contact_person',true),
				'branch_phone'				=> $this->input->post('branch_phone',true),
				'branch_token'				=> $this->input->post('branch_token',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on' 				=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('region_id', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('province_id', 'Nama Provinsi', 'required');
			$this->form_validation->set_rules('city_id', 'Nama Kota', 'required');
			$this->form_validation->set_rules('branch_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('branch_name', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('branch_address', 'Alamat Cabang', 'required');
			$this->form_validation->set_rules('branch_contact_person', 'Kontak Cabang', 'required');
			$this->form_validation->set_rules('branch_phone', 'Telepon Cabang', 'required');


			$branch_token 					= $this->CoreBranch_model->getBranchToken($data['branch_token']);
			
			if($this->form_validation->run()==true){
				if ($branch_token == 0){
					if($this->CoreBranch_model->insertCoreBranch($data)){
						$auth = $this->session->userdata('auth');

						$branch_id = $this->CoreBranch_model->getBranchID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $branch_id, '2141', 'CoreBranch.processAddCoreBranch', 'Add New Core Branch');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Cabang Berhasil
								</div> ";
						$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
						$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('branch/add');
					}else{
						$this->session->set_userdata('addCoreBranch',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Cabang Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('branch/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Cabang Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/add');
				}
			}else{
				$this->session->set_userdata('addCoreBranch',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('branch/add');
			}
		}
		
		public function editCoreBranch(){
			$branch_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['corebranch']		= $this->CoreBranch_model->getCoreBranch_Detail($branch_id);

			$data['main_view']['coreregion']		= create_double($this->CoreBranch_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreBranch_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreBranch/FormEditCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreBranch(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'branch_id'					=> $this->input->post('branch_id',true),
				'region_id'					=> $this->input->post('region_id',true),
				'province_id'				=> $this->input->post('province_id',true),
				'city_id'					=> $this->input->post('city_id',true),
				'branch_code'				=> $this->input->post('branch_code',true),
				'branch_name'				=> $this->input->post('branch_name',true),
				'branch_address'			=> $this->input->post('branch_address',true),
				'branch_contact_person'		=> $this->input->post('branch_contact_person',true),
				'branch_phone'				=> $this->input->post('branch_phone',true),
				'updated_id'				=> $auth['user_id'],
				'updated_on' 				=> date('Ymdhis'),
			);
			
			$this->form_validation->set_rules('region_id', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('province_id', 'Nama Provinsi', 'required');
			$this->form_validation->set_rules('city_id', 'Nama Kota', 'required');
			$this->form_validation->set_rules('branch_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('branch_name', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('branch_address', 'Alamat Cabang', 'required');
			$this->form_validation->set_rules('branch_contact_person', 'Kontak Cabang', 'required');
			$this->form_validation->set_rules('branch_phone', 'Telepon Cabang', 'required');
		
			$old_data	= $this->CoreBranch_model->getCoreBranch_Detail($data['branch_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreBranch_model->updateCoreBranch($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['branch_id'], '2141', 'CoreBranch.processEditCoreBranch', 'Edit Core Branch');

					$this->fungsi->set_change_log($auth['user_id'], $data['branch_id'], '2143', 'CoreBranch.processEditCoreBranch', 'Edit Core Branch', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Cabang Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/edit/'.$data['branch_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Cabang Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/edit/'.$data['branch_id']);
				}
			}else{
				$this->session->set_userdata('EditCoreBranch',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('branch/edit/'.$data['branch_id']);
			}
		}

		public function deleteCoreBranch(){
			$auth 				= $this->session->userdata('auth');
			$branch_id 			= $this->uri->segment(3);

			$data = array(
				'branch_id'				=> $branch_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->CoreBranch_model->deleteCoreBranch($data)){
				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CoreBranch.deleteCoreBranch', $branch_id,'Delete Core Branch');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Cabang Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('branch');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Cabang Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('branch');
			}
		}
	}
?>