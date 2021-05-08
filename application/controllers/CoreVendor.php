<?php
	Class CoreVendor extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'vendor';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreVendor_model');
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
			$sesi		= $this->session->userdata('filter-CoreVendor');

			if(!is_array($sesi)){
				$sesi['region_id']		= '';
				$sesi['branch_id']		= '';
				$sesi['province_id']	= '';
				$sesi['section_id']		= '';
			}

			$this->session->unset_userdata('addCoreVendor-'.$unique['unique']);
			$this->session->unset_userdata('CoreVendorToken-'.$unique['unique']);

			$data['main_view']['corevendor']		= $this->CoreVendor_model->getCoreVendor($sesi['region_id'], $sesi['branch_id'], $sesi['province_id'], $sesi['city_id']);

			$data['main_view']['coreregion']		= create_double($this->CoreVendor_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreVendor_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreVendor/ListCoreVendor_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'region_id'				=> $this->input->post('region_id'),
				'branch_id'				=> $this->input->post('branch_id'),
				'province_id'			=> $this->input->post('province_id',true),
				'city_id'				=> $this->input->post('city_id',true),
			);
			$this->session->set_userdata('filter-CoreVendor',$data);
			redirect('vendor');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-CoreVendor');
			redirect('vendor');
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');
			
			$item = $this->CoreVendor_model->getCoreBranch($region_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreCity(){
			$province_id = $this->input->post('province_id');
			
			$item = $this->CoreVendor_model->getCoreCity($province_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[city_id]'>$mp[city_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreVendor-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreVendor-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreVendor-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreVendor-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreVendor-'.$unique['unique']);
			redirect('vendor/add');
		}

		public function addCoreVendor(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CoreVendorToken-'.$unique['unique']);

			$token		= $this->session->userdata('CoreVendorToken-'.$unique['unique']);

			if(empty($token)){
				$vendor_token = md5(rand());
				$this->session->set_userdata('CoreVendorToken-'.$unique['unique'], $vendor_token);
			}

			$data['main_view']['coreregion']		= create_double($this->CoreVendor_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreVendor_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreVendor/FormAddCoreVendor_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCoreVendor(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'region_id'					=> $this->input->post('region_id',true),
				'branch_id'					=> $this->input->post('branch_id',true),
				'province_id'				=> $this->input->post('province_id',true),
				'city_id'					=> $this->input->post('city_id',true),
				'vendor_name'				=> $this->input->post('vendor_name',true),
				'vendor_address'			=> $this->input->post('vendor_address',true),
				'vendor_contact_person'		=> $this->input->post('vendor_contact_person',true),
				'vendor_phone'				=> $this->input->post('vendor_phone',true),
				'vendor_token'				=> $this->input->post('vendor_token',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on' 				=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('region_id', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('branch_id', 'Nama Vendor', 'required');
			$this->form_validation->set_rules('province_id', 'Nama Provinsi', 'required');
			$this->form_validation->set_rules('city_id', 'Nama Kota', 'required');
			$this->form_validation->set_rules('vendor_name', 'Nama Vendor', 'required');
			$this->form_validation->set_rules('vendor_address', 'Alamat Vendor', 'required');
			$this->form_validation->set_rules('vendor_contact_person', 'Kontak Vendor', 'required');
			$this->form_validation->set_rules('vendor_phone', 'Telepon Vendor', 'required');


			$vendor_token 					= $this->CoreVendor_model->getVendorToken($data['vendor_token']);
			
			if($this->form_validation->run()==true){
				if ($vendor_token == 0){
					if($this->CoreVendor_model->insertCoreVendor($data)){
						$auth = $this->session->userdata('auth');

						$corevendor 	= $this->CoreVendor_model->getCoreVendor_Last($data['created_id']);	

						$vendor_id 		= $corevendor['vendor_id'];

						if (!is_dir(get_root_path()."/img/".$corevendor['vendor_code'])) {
							print_r("folder tidak ada");
			
							mkdir(get_root_path()."/img/".$corevendor['vendor_code'], 0777);	

							
						}

						/* exit; */

						$this->fungsi->set_log($auth['user_id'], $vendor_id, '2141', 'CoreVendor.processAddCoreVendor', 'Add New Core Vendor');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Vendor Berhasil
								</div> ";
						$this->session->unset_userdata('addCoreVendor-'.$unique['unique']);
						$this->session->unset_userdata('CoreVendorToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('vendor/add');
					}else{
						$this->session->set_userdata('addCoreVendor',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Vendor Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('vendor/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Vendor Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('vendor/add');
				}
			}else{
				$this->session->set_userdata('addCoreVendor',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('vendor/add');
			}
		}
		
		public function editCoreVendor(){
			$vendor_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['corevendor']		= $this->CoreVendor_model->getCoreVendor_Detail($vendor_id);

			$data['main_view']['coreregion']		= create_double($this->CoreVendor_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->CoreVendor_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'CoreVendor/FormEditCoreVendor_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreVendor(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'vendor_id'					=> $this->input->post('vendor_id',true),
				'region_id'					=> $this->input->post('region_id',true),
				'branch_id'					=> $this->input->post('branch_id',true),
				'province_id'				=> $this->input->post('province_id',true),
				'city_id'					=> $this->input->post('city_id',true),
				'vendor_code'				=> $this->input->post('vendor_code',true),
				'vendor_name'				=> $this->input->post('vendor_name',true),
				'vendor_address'			=> $this->input->post('vendor_address',true),
				'vendor_contact_person'		=> $this->input->post('vendor_contact_person',true),
				'vendor_phone'				=> $this->input->post('vendor_phone',true),
				'updated_id'				=> $auth['user_id'],
				'updated_on' 				=> date('Ymdhis'),
			);
			
			$this->form_validation->set_rules('region_id', 'Nama Koordinator Wilayah', 'required');
			$this->form_validation->set_rules('branch_id', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('province_id', 'Nama Provinsi', 'required');
			$this->form_validation->set_rules('city_id', 'Nama Kota', 'required');
			$this->form_validation->set_rules('vendor_name', 'Nama Vendor', 'required');
			$this->form_validation->set_rules('vendor_address', 'Alamat Vendor', 'required');
			$this->form_validation->set_rules('vendor_contact_person', 'Kontak Vendor', 'required');
			$this->form_validation->set_rules('vendor_phone', 'Telepon Vendor', 'required');
		
			$old_data	= $this->CoreVendor_model->getCoreVendor_Detail($data['vendor_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreVendor_model->updateCoreVendor($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['vendor_id'], '2141', 'CoreVendor.processEditCoreVendor', 'Edit Core Vendor');

					$this->fungsi->set_change_log($auth['user_id'], $data['vendor_id'], '2143', 'CoreVendor.processEditCoreVendor', 'Edit Core Vendor', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Vendor Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('vendor/edit/'.$data['vendor_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Vendor Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('vendor/edit/'.$data['vendor_id']);
				}
			}else{
				$this->session->set_userdata('EditCoreVendor',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('vendor/edit/'.$data['vendor_id']);
			}
		}

		public function deleteCoreVendor(){
			$auth 				= $this->session->userdata('auth');
			$vendor_id 			= $this->uri->segment(3);

			$data = array(
				'vendor_id'				=> $vendor_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->CoreVendor_model->deleteCoreVendor($data)){
				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CoreVendor.deleteCoreVendor', $vendor_id,'Delete Core Vendor');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Vendor Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('vendor');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Vendor Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('vendor');
			}
		}
	}
?>