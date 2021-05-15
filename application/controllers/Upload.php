<?php
	Class Upload extends MY_Controller{
		public function __construct(){
			parent::__construct();

			/* $menu = 'branch';

			$this->cekLogin();
			$this->accessMenu($menu); */

			$this->load->model('MainPage_model');
			/* $this->load->model('Upload_model');
			$this->load->helper('sistem');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->helper('url');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory')); */
		}
		
		public function index(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');
			$sesi		= $this->session->userdata('filter-Upload');

			if(!is_array($sesi)){
				$sesi['region_id']		= '';
				$sesi['province_id']	= '';
				$sesi['city_id']		= '';
			}

			$this->session->unset_userdata('addUpload-'.$unique['unique']);
			$this->session->unset_userdata('UploadToken-'.$unique['unique']);

			$data['main_view']['Upload']		= $this->Upload_model->getUpload($sesi['region_id'], $sesi['province_id'], $sesi['city_id']);

			$data['main_view']['coreregion']		= create_double($this->Upload_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->Upload_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'Upload/ListUpload_view';
			$this->load->view('MainPage_view',$data);
		}

		public function uploadFiles(){
			if(isset($_FILES['upload']['name']))
			{
				$file = $_FILES['upload']['tmp_name'];
				$file_name = $_FILES['upload']['name'];
				$file_name_array = explode(".", $file_name);
				$extension = end($file_name_array);
				$new_image_name = rand() . '.' . $extension;
				$allowed_extension = array("jpg", "jpeg", "png","PNG","JPEG","JPG");
				if(in_array($extension, $allowed_extension))
					{
					move_uploaded_file($file, './assets/images/' . $new_image_name);
					$function_number = $_GET['CKEditorFuncNum'];
					$url = base_url().'assets/images/' . $new_image_name;
					$message = '';
					echo"";

					}
			}
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'region_id'				=> $this->input->post('region_id'),
				'province_id'			=> $this->input->post('province_id',true),
				'city_id'				=> $this->input->post('city_id',true),
			);
			$this->session->set_userdata('filter-Upload',$data);
			redirect('branch');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-Upload');
			redirect('branch');
		}

		public function getCoreCity(){
			$province_id = $this->input->post('province_id');
			
			$item = $this->Upload_model->getCoreCity($province_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[city_id]'>$mp[city_name]</option>\n";	
			}
			echo $data;
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addUpload-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addUpload-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addUpload-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addUpload-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addUpload-'.$unique['unique']);
			redirect('branch/add');
		}

		public function addUpload(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('UploadToken-'.$unique['unique']);

			$token		= $this->session->userdata('UploadToken-'.$unique['unique']);

			if(empty($token)){
				$branch_token = md5(rand());
				$this->session->set_userdata('UploadToken-'.$unique['unique'], $branch_token);
			}

			$data['main_view']['coreregion']		= create_double($this->Upload_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->Upload_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'Upload/FormAddUpload_view';
			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddUpload(){
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


			$branch_token 					= $this->Upload_model->getBranchToken($data['branch_token']);
			
			if($this->form_validation->run()==true){
				if ($branch_token == 0){
					if($this->Upload_model->insertUpload($data)){
						$auth = $this->session->userdata('auth');

						$branch_id = $this->Upload_model->getBranchID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $branch_id, '2141', 'Upload.processAddUpload', 'Add New Core Branch');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Cabang Berhasil
								</div> ";
						$this->session->unset_userdata('addUpload-'.$unique['unique']);
						$this->session->unset_userdata('UploadToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('branch/add');
					}else{
						$this->session->set_userdata('addUpload',$data);
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
				$this->session->set_userdata('addUpload',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('branch/add');
			}
		}
		
		public function editUpload(){
			$branch_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');

			$data['main_view']['Upload']		= $this->Upload_model->getUpload_Detail($branch_id);

			$data['main_view']['coreregion']		= create_double($this->Upload_model->getCoreRegion(), 'region_id', 'region_name');

			$data['main_view']['coreprovince']		= create_double($this->Upload_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']			= 'Upload/FormEditUpload_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditUpload(){
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
		
			$old_data	= $this->Upload_model->getUpload_Detail($data['branch_id']);
			
			if($this->form_validation->run()==true){
				if($this->Upload_model->updateUpload($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['branch_id'], '2141', 'Upload.processEditUpload', 'Edit Core Branch');

					$this->fungsi->set_change_log($auth['user_id'], $data['branch_id'], '2143', 'Upload.processEditUpload', 'Edit Core Branch', $old_data, $data);

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
				$this->session->set_userdata('EditUpload',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('branch/edit/'.$data['branch_id']);
			}
		}

		public function deleteUpload(){
			$auth 				= $this->session->userdata('auth');
			$branch_id 			= $this->uri->segment(3);

			$data = array(
				'branch_id'				=> $branch_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->Upload_model->deleteUpload($data)){
				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.Upload.deleteUpload', $branch_id,'Delete Core Branch');

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