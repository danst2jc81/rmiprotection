<?php
	Class DataPerpetrator extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'perpetrator';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('DataPerpetrator_model');
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

			$sesi		= $this->session->userdata('filter-DataPerpetrator');

			if(!is_array($sesi)){
				$sesi['vendor_id']					= $auth['vendor_id'];
				$sesi['province_id_perpetrator']	= '';
				$sesi['city_id_perpetrator']		= '';
			}

			$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
			$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
			$this->session->unset_userdata('DataPerpetratorPhotoToken-'.$unique['unique']);

			$data['main_view']['dataperpetrator']			= $this->DataPerpetrator_model->getDataPerpetrator($sesi['province_id_perpetrator'], $sesi['city_id_perpetrator']);

			$data['main_view']['coreprovinceperpetrator']	= create_double($this->DataPerpetrator_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['corevendor']				= create_double($this->DataPerpetrator_model->getCoreVendor(), 'vendor_id', 'vendor_name');

			$data['main_view']['perpetratorstatus']			= $this->configuration->PerpetratorStatus();

			$data['main_view']['content']					= 'DataPerpetrator/ListDataPerpetrator_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'vendor_id'						=> $this->input->post('vendor_id'),
				'province_id_perpetrator'		=> $this->input->post('province_id_perpetrator'),
				'city_id_perpetrator'			=> $this->input->post('city_id_perpetrator'),
			);
			$this->session->set_userdata('filter-DataPerpetrator',$data);
			redirect('perpetrator');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-DataPerpetrator');
			redirect('perpetrator');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addDataPerpetrator-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addDataPerpetrator-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addDataPerpetrator-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addDataPerpetrator-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
			$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
			redirect('perpetrator/add');
		}

		public function getCoreCity(){
			$province_id 		= $this->input->post('province_id');
			
			$item = $this->DataPerpetrator_model->getCoreCity($province_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[city_id]'>$mp[city_name]</option>\n";	
			}
			echo $data;
		}

		public function addDataPerpetrator(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);

			$perpetrator_token		= $this->session->userdata('DataPerpetratorToken-'.$unique['unique']);

			if(empty($perpetrator_token)){
				$perpetrator_token = md5(rand());
				$this->session->set_userdata('DataPerpetratorToken-'.$unique['unique'], $perpetrator_token);
			}

			$data['main_view']['coreprovinceperpetrator']		= create_double($this->DataPerpetrator_model->getCoreProvince(), 'province_id', 'province_name');

			$data['main_view']['content']						= 'DataPerpetrator/FormAddDataPerpetrator_view';

			$this->load->view('MainPage_view',$data);
		}

		function processAddDataPerpetrator(){
			$auth 				= $this->session->userdata('auth');
			$unique 			= $this->session->userdata('unique');
			
			$fileName 			= $_FILES['perpetrator_photo_name']['name'];
			$fileSize 			= $_FILES['perpetrator_photo_name']['size'];
			$fileError 			= $_FILES['perpetrator_photo_name']['error'];
			
			if($fileSize > 0){
				$parse			= explode('.',$fileName);
				$image_types 	= array('jpg', 'jpeg');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('perpetrator');
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('perpetrator');
			}
			
			$auth 								= $this->session->userdata('auth');
			$unique 							= $this->session->userdata('unique');

			$vendor_id							= $auth['vendor_id'];

			$corevendor 						= $this->DataPerpetrator_model->getCoreVendor_Detail($vendor_id);

			$data = array (
				'region_id'							=> $auth['region_id'],
				'branch_id'							=> $auth['branch_id'],
				'vendor_id'							=> $auth['vendor_id'],
				'province_id'						=> $corevendor['province_id'],
				'city_id'							=> $corevendor['city_id'],
				'perpetrator_name'					=> $this->input->post('perpetrator_name',true),
				'perpetrator_address'				=> $this->input->post('perpetrator_address',true),
				'province_id_perpetrator'			=> $this->input->post('province_id_perpetrator',true),
				'city_id_perpetrator'				=> $this->input->post('city_id_perpetrator',true),
				'perpetrator_mobile_phone'			=> $this->input->post('perpetrator_mobile_phone',true),
				'perpetrator_id_number'				=> $this->input->post('perpetrator_id_number',true),
				'perpetrator_date_of_birth'			=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_token'					=> $this->input->post('perpetrator_token',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on' 						=> date('Ymdhis'),
			);

			/* print_r("data ");
			print_r($data);
			print_r("<BR> ");
			print_r("<BR> ");
			exit; */

			
			$this->form_validation->set_rules('perpetrator_name', 'Nama Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_address', 'Alamat Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_mobile_phone', 'Telepon Pelaku', 'required');
			$this->form_validation->set_rules('province_id_perpetrator', 'Provinsi Pelaku', 'required');
			$this->form_validation->set_rules('city_id_perpetrator', 'Kota Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_date_of_birth', 'Tanggal Lahir Pelaku', 'required');
			
			$perpetrator_token 						= $this->DataPerpetrator_model->getPerpetratorToken($data['perpetrator_token']);
			
			if($this->form_validation->run()==true){
				if ($perpetrator_token == 0){
					if($fileSize > 0 || $fileError == 0){
						try {
							$newfilename 				= $_FILES['perpetrator_photo_name']['name'];
							$config['upload_path'] 		= get_root_path()."/img/".$corevendor['vendor_code'];
							$config['allowed_types'] 	= 'jpg'|'jpeg';
							$config['overwrite'] 		= false;
							$config['remove_spaces'] 	= true;
							$config['file_name'] 		= $newfilename;		

							/* if (!is_dir(get_root_path()."/img/".$corevendor['vendor_code'])) {
								mkdir(get_root_path()."/img/".$corevendor['vendor_code'], 0777, TRUE);	
							} */

							/* print_r("vendor_code ");
							print_r($corevendor['vendor_code']);
							print_r("<BR> ");
							print_r("<BR> ");
							
							print_r("upload_path ");
							print_r($config['upload_path']);
							print_r("<BR> ");
							print_r("<BR> ");
							exit; */
							
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('perpetrator_photo_name')){

								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
										".$this->upload->display_errors('', '')."
									</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('perpetrator/add');
							} else {
							
								$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;

								$config['maintain_ratio'] = TRUE;

								$this->load->library('image_lib', $config);

								if ( ! $this->image_lib->resize()){
									$msg = "<div class='alert alert-danger alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                      
										".$this->upload->display_errors('', '')."
									</div> ";
									$this->session->set_userdata('message',$msg);
									redirect('perpetrator/add');
								} else {

									if($this->DataPerpetrator_model->insertDataPerpetrator($data)){
										$auth = $this->session->userdata('auth');

										$perpetrator_id = $this->DataPerpetrator_model->getPerpetratorID($data['created_id']);

										$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

										$data_perpetratorchronology = array (
											'perpetrator_id'						=> $perpetrator_id,
											'province_id'							=> $corevendor['province_id'],
											'city_id'								=> $corevendor['city_id'],
											'vendor_id'								=> $auth['vendor_id'],
											'perpetrator_chronology_date'			=> date("Y-m-d"),
											'perpetrator_chronology_description' 	=> $this->input->post('perpetrator_chronology_description',true),
											'perpetrator_chronology_token'			=> $data['perpetrator_token'].$perpetrator_id,
											'data_state'							=> 0,
											'created_id'							=> $auth['user_id'],
											'created_on'							=> date("Y-m-d H:i:s")
										);

										

										$perpetrator_chronology_token 				= $this->DataPerpetrator_model->getPerpetratorChronologyToken($data_perpetratorchronology['perpetrator_chronology_token']);

										if ($perpetrator_chronology_token == 0){
											$this->DataPerpetrator_model->insertDataPerpetratorChronology($data_perpetratorchronology);
										}

										$data_perpetratorphoto = array (
											'perpetrator_id'			=> $perpetrator_id,
											'perpetrator_photo_path'	=> $corevendor['vendor_code'],
											'perpetrator_photo_name'	=> $this->upload->file_name,
											'perpetrator_photo_token' 	=> $data['perpetrator_token'].$perpetrator_id,
											'data_state'				=> 0,
											'created_id'				=> $auth['user_id'],
											'created_on'				=> date("Y-m-d H:i:s")
										);

										$perpetrator_photo_token 		= $this->DataPerpetrator_model->getPerpetratorPhotoToken($data_perpetratorphoto['perpetrator_photo_token']);

										if ($perpetrator_photo_token == 0){
											$this->DataPerpetrator_model->insertDataPerpetratorPhoto($data_perpetratorphoto);
										}

										$msg = "<div class='alert alert-success alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
													Tambah Data Pelaku Berhasil
												</div> ";
										$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
										$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
										$this->session->set_userdata('message',$msg);
										redirect('perpetrator/add');
									}else{
										$msg = "<div class='alert alert-danger alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
													Tambah Data Pelaku Gagal
												</div> ";
										$this->session->set_userdata('message',$msg);
										$this->session->set_userdata('addfleet',$data);
										redirect('perpetrator/add');
									}
								}
							}
						} catch (Exception $msg){
							$message = "<div class='alert alert-danger alert-dismissable'>  
										button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
									Error in uploading due".$msg->getMessage()."
								</div> ";
							$this->session->set_userdata('message',$message);
							redirect('perpetrator/add');
						}
					} else {
						if($this->DataPerpetrator_model->insertDataPerpetrator($data)){
							$auth = $this->session->userdata('auth');

							$perpetrator_id = $this->DataPerpetrator_model->getPerpetratorID($data['created_id']);

							$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

							$data_perpetratorchronology = array (
								'perpetrator_id'						=> $perpetrator_id,
								'province_id'							=> $corevendor['province_id'],
								'city_id'								=> $corevendor['city_id'],
								'vendor_id'								=> $auth['vendor_id'],
								'perpetrator_chronology_date'			=> date("Y-m-d"),
								'perpetrator_chronology_description' 	=> $this->input->post('perpetrator_chronology_description',true),
								'perpetrator_chronology_token'			=> $data['perpetrator_token'].$perpetrator_id,
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s")
							);

							

							$perpetrator_chronology_token 				= $this->DataPerpetrator_model->getPerpetratorChronologyToken($data_perpetratorchronology['perpetrator_chronology_token']);

							if ($perpetrator_chronology_token == 0){
								$this->DataPerpetrator_model->insertDataPerpetratorChronology($data_perpetratorchronology);
							}

							$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Tambah Data Pelaku Berhasil
									</div> ";
							$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
							$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
							$this->session->set_userdata('message',$msg);
							redirect('perpetrator/add');
						}else{
							$msg = "<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
										Tambah Data Pelaku Gagal
									</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('addfleet',$data);
							redirect('perpetrator/add');
						}
					}
				} else {
					if($fileSize > 0 || $fileError == 0){
						try {
							$newfilename 				= $_FILES['perpetrator_photo_name']['name'];
							$config['upload_path'] 		= get_root_path()."/img/".$corevendor['vendor_code'];
							$config['allowed_types'] 	= 'jpg';
							$config['overwrite'] 		= false;
							$config['remove_spaces'] 	= true;
							$config['file_name'] 		= $newfilename;						
							
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('perpetrator_photo_name')){

								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
										".$this->upload->display_errors('', '')."
									</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('perpetrator/add');
							} else {
							
								$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;

								$config['maintain_ratio'] = TRUE;

								$this->load->library('image_lib', $config);

								if ( ! $this->image_lib->resize()){
									$msg = "<div class='alert alert-danger alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                      
										".$this->upload->display_errors('', '')."
									</div> ";
									$this->session->set_userdata('message',$msg);
									redirect('perpetrator/add');
								} else {

									
									$auth = $this->session->userdata('auth');

									$perpetrator_id = $this->DataPerpetrator_model->getPerpetratorID($data['created_id']);

									$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

									$data_perpetratorchronology = array (
										'perpetrator_id'						=> $perpetrator_id,
										'province_id'							=> $corevendor['province_id'],
										'city_id'								=> $corevendor['city_id'],
										'vendor_id'								=> $auth['vendor_id'],
										'perpetrator_chronology_date'			=> date("Y-m-d"),
										'perpetrator_chronology_description' 	=> $this->input->post('perpetrator_chronology_description',true),
										'perpetrator_chronology_token'			=> $data['perpetrator_token'].$perpetrator_id,
										'data_state'							=> 0,
										'created_id'							=> $auth['user_id'],
										'created_on'							=> date("Y-m-d H:i:s")
									);

									$perpetrator_chronology_token 				= $this->DataPerpetrator_model->getPerpetratorChronologyToken($data_perpetratorchronology['perpetrator_chronology_token']);

									if ($perpetrator_chronology_token == 0){
										$this->DataPerpetrator_model->insertDataPerpetratorChronology($data_perpetratorchronology);
									}

									$data_perpetratorphoto = array (
										'perpetrator_id'			=> $perpetrator_id,
										'perpetrator_photo_path'	=> $corevendor['vendor_code'],
										'perpetrator_photo_name'	=> $this->upload->file_name,
										'perpetrator_photo_token' 	=> $data['perpetrator_token'].$perpetrator_id,
										'data_state'				=> 0,
										'created_id'				=> $auth['user_id'],
										'created_on'				=> date("Y-m-d H:i:s")
									);

									$perpetrator_photo_token 		= $this->DataPerpetrator_model->getPerpetratorPhotoToken($data_perpetratorphoto['perpetrator_photo_token']);

									if ($perpetrator_photo_token == 0){
										$this->DataPerpetrator_model->insertDataPerpetratorPhoto($data_perpetratorphoto);
									}

									$msg = "<div class='alert alert-success alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
												Tambah Data Pelaku Berhasil
											</div> ";
									$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
									$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
									$this->session->set_userdata('message',$msg);
									redirect('perpetrator/add');
								}
							}
						} catch (Exception $msg){
							$message = "<div class='alert alert-danger alert-dismissable'>  
										button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
									Error in uploading due".$msg->getMessage()."
								</div> ";
							$this->session->set_userdata('message',$message);
							redirect('perpetrator/add');
						}
					} else {
						if($this->DataPerpetrator_model->insertDataPerpetrator($data)){
							$auth = $this->session->userdata('auth');

							$perpetrator_id = $this->DataPerpetrator_model->getPerpetratorID($data['created_id']);

							$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

							$data_perpetratorchronology = array (
								'perpetrator_id'						=> $perpetrator_id,
								'province_id'							=> $corevendor['province_id'],
								'city_id'								=> $corevendor['city_id'],
								'vendor_id'								=> $auth['vendor_id'],
								'perpetrator_chronology_date'			=> date("Y-m-d"),
								'perpetrator_chronology_description' 	=> $this->input->post('perpetrator_chronology_description',true),
								'perpetrator_chronology_token'			=> $data['perpetrator_token'].$perpetrator_id,
								'data_state'							=> 0,
								'created_id'							=> $auth['user_id'],
								'created_on'							=> date("Y-m-d H:i:s")
							);

							

							$perpetrator_chronology_token 				= $this->DataPerpetrator_model->getPerpetratorChronologyToken($data_perpetratorchronology['perpetrator_chronology_token']);

							if ($perpetrator_chronology_token == 0){
								$this->DataPerpetrator_model->insertDataPerpetratorChronology($data_perpetratorchronology);
							}

							$this->fungsi->set_log($auth['user_id'], $perpetrator_id, '2141', 'DataPerpetrator.processAddDataPerpetrator', 'Add New Data Perpetrator');

							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Tambah Data Pelaku Berhasil
									</div> ";
							$this->session->unset_userdata('addDataPerpetrator-'.$unique['unique']);
							$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
							$this->session->set_userdata('message',$msg);
							redirect('perpetrator/add');
						}else{
							$msg = "<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
										Tambah Data Pelaku Gagal
									</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('addfleet',$data);
							redirect('perpetrator/add');
						}
					}
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/add');
			}
		}
	
		function addDataPerpetratorPhoto(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('DataPerpetratorPhotoToken-'.$unique['unique']);

			$perpetrator_photo_token		= $this->session->userdata('DataPerpetratorPhotoToken-'.$unique['unique']);

			if(empty($perpetrator_photo_token)){
				$perpetrator_photo_token = md5(rand());
				$this->session->set_userdata('DataPerpetratorPhotoToken-'.$unique['unique'], $perpetrator_photo_token);
			}

			$perpetrator_id 								= $this->uri->segment(3);

			$data['main_view']['dataperpetrator']			= $this->DataPerpetrator_model->getDataPerpetrator_Detail($perpetrator_id);

			$data['main_view']['dataperpetratorphoto']		= $this->DataPerpetrator_model->getDataPerpetratorPhoto_Detail($perpetrator_id);

			$data['main_view']['content']					= 'DataPerpetrator/FormAddDataPerpetratorPhoto_view';		

			$this->load->view('MainPage_view',$data);
		}

		function processAddDataPerpetratorPhoto(){
			$auth 				= $this->session->userdata('auth');
			$unique 			= $this->session->userdata('unique');
			
			$fileName 			= $_FILES['perpetrator_photo_name']['name'];
			$fileSize 			= $_FILES['perpetrator_photo_name']['size'];
			$fileError 			= $_FILES['perpetrator_photo_name']['error'];

			$data = array(
				'perpetrator_id'		 	=> $this->input->post('perpetrator_id',true),
				'perpetrator_photo_path' 	=> $this->input->post('vendor_code',true),
				'perpetrator_photo_token' 	=> $this->input->post('perpetrator_photo_token',true),
				'data_state'				=> 0,
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date('Y-m-d h:i:s'),
			);
			
			if($fileSize > 0){
				$parse			= explode('.',$fileName);
				$image_types 	= array('jpg');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('perpetrator/photo/'.$data['perpetrator_id']);
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('perpetrator/photo/'.$data['perpetrator_id']);
			}
			
			$this->form_validation->set_rules('perpetrator_id', 'Nama Pelaku', 'required');

			$perpetrator_photo_token = $this->DataPerpetrator_model->getPerpetratorPhotoToken($data['perpetrator_photo_token']);
			
			if($this->form_validation->run()==true){
				if($fileSize > 0 || $fileError == 0){
					try {
						$newfilename 				= $_FILES['perpetrator_photo_name']['name'];
						$config['upload_path'] 		= get_root_path()."/img/".$data['perpetrator_photo_path'];
						$config['allowed_types'] 	= 'jpg';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;						
						
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('perpetrator_photo_name')){

							$msg = "<div class='alert alert-danger alert-dismissable'>  
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('perpetrator/photo/'.$data['perpetrator_id']);
						} else {
						
							$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;

							$config['maintain_ratio'] = TRUE;

							$this->load->library('image_lib', $config);

							if ( ! $this->image_lib->resize()){
								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                      
									".$this->upload->display_errors('', '')."
								</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('perpetrator/photo/'.$data['perpetrator_id']);
							} else {
								$data['perpetrator_photo_name']	= $this->upload->file_name;

								if ($perpetrator_photo_token == 0){
									$this->DataPerpetrator_model->insertDataPerpetratorPhoto($data);
									
									$this->fungsi->set_log($auth['user_id'], $data['perpetrator_id'], '2141', 'DataPerpetrator.processAddDataPerpetratorPhoto', 'Add New Data Perpetrator');

									$msg = "<div class='alert alert-success alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>               
												Tambah Foto Pelaku Berhasil
											</div> ";
									$this->session->set_userdata('message',$msg);
									$this->session->unset_userdata('DataPerpetratorPhotoToken-'.$unique['unique']);
									redirect('perpetrator/photo/'.$data['perpetrator_id']);
								}
							}
						}
					} catch (Exception $msg){
						$message = "<div class='alert alert-danger alert-dismissable'>  
									button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('perpetrator/photo/'.$data['perpetrator_id']);
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
								Tambah Foto Pelaku Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addfleet',$data);
					redirect('perpetrator/photo/'.$data['perpetrator_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/photo/'.$data['perpetrator_id']);
			}
		}

		public function deleteDataPerpetratorPhoto(){
			$perpetrator_photo_id 			= $this->uri->segment(3);
			$perpetrator_id 				= $this->uri->segment(4);

			$data = array(
				'perpetrator_photo_id'		=> $perpetrator_photo_id,
				'data_state'				=> 1
			);

			if($this->DataPerpetrator_model->deleteDataPerpetratorPhoto($data)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $data['perpetrator_photo_id'], '2141', 'DataPerpetrator.deleteDataPerpetratorPhoto', 'Delete Data Perpetrator Photo');

				$msg = "<div class='alert alert-success alert-dismissable'>                  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Hapus Foto Pelaku Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/photo/'.$perpetrator_id);
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>    
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
									Hapus Foto Pelaku Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/photo/'.$perpetrator_id);
			}
		}

		function addDataPerpetratorChronology(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('DataPerpetratorChronologyToken-'.$unique['unique']);

			$perpetrator_chronology_token		= $this->session->userdata('DataPerpetratorChronologyToken-'.$unique['unique']);

			if(empty($perpetrator_chronology_token)){
				$perpetrator_chronology_token = md5(rand());
				$this->session->set_userdata('DataPerpetratorChronologyToken-'.$unique['unique'], $perpetrator_chronology_token);
			}

			$perpetrator_id 									= $this->uri->segment(3);

			$data['main_view']['dataperpetrator']				= $this->DataPerpetrator_model->getDataPerpetrator_Detail($perpetrator_id);

			$data['main_view']['dataperpetratorchronology']		= $this->DataPerpetrator_model->getDataPerpetratorChronology_Detail($perpetrator_id);

			$data['main_view']['content']						= 'DataPerpetrator/FormAddDataPerpetratorChronology_view';		

			$this->load->view('MainPage_view',$data);
		}

		public function processAddDataPerpetratorChronology(){
			$auth = $this->session->userdata('auth');

			$data= array (
				'perpetrator_id'						=> $this->input->post('perpetrator_id',true),
				'province_id'							=> $this->input->post('province_id',true),
				'city_id'								=> $this->input->post('city_id',true),
				'vendor_id'								=> $this->input->post('vendor_id',true),
				'perpetrator_chronology_date'			=> tgltodb($this->input->post('perpetrator_chronology_date',true)),
				'perpetrator_chronology_description'	=> $this->input->post('perpetrator_chronology_description',true),
				'perpetrator_chronology_token'			=> $this->input->post('perpetrator_chronology_token',true),
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on' 							=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('perpetrator_chronology_date', 'Tanggal Kronologi', 'required');
			$this->form_validation->set_rules('perpetrator_chronology_description', 'Deskripsi Kronologi', 'required');

			$perpetrator_chronology_token 				= $this->DataPerpetrator_model->getPerpetratorChronologyToken($data['perpetrator_chronology_token']);
			
			if($this->form_validation->run()==true){
				if ($region_perpetrator_chronology_tokentoken == 0){
					if($this->DataPerpetrator_model->insertDataPerpetratorChronology($data)){
						$auth = $this->session->userdata('auth');

						$this->fungsi->set_log($auth['user_id'], $data['perpetrator_id'], '2141', 'DataPerpetrator.processAddDataPerpetratorChronology', 'Add New Data Perpetrator Chronology');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Kronologi Berhasil
								</div> ";
						$this->session->unset_userdata('DataPerpetratorChronologyToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('perpetrator/chronology/'.$data['perpetrator_id']);
					}else{
						$this->session->set_userdata('addCoreRegion',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Kronologi Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('perpetrator/chronology/'.$data['perpetrator_id']);
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Kronologi Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('perpetrator/chronology/'.$data['perpetrator_id']);
				}
			}else{
				$this->session->set_userdata('addCoreRegion',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/chronology/'.$data['perpetrator_id']);
			}
		}





		
		
		public function editDataPerpetrator(){
			$perpetrator_id 		= $this->uri->segment(3);
			$auth 					= $this->session->userdata('auth');
			$unique 				= $this->session->userdata('unique');

			$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);

			$perpetrator_token		= $this->session->userdata('DataPerpetratorToken-'.$unique['unique']);

			if(empty($perpetrator_token)){
				$perpetrator_token = md5(rand());
				$this->session->set_userdata('DataPerpetratorToken-'.$unique['unique'], $perpetrator_token);
			}

			$data['main_view']['dataperpetrator']	= $this->DataPerpetrator_model->getDataPerpetrator_Detail($perpetrator_id);

			$data['main_view']['corecellgroup']			= create_double($this->DataPerpetrator_model->getCoreCellGroup(), 'cell_group_id', 'cell_group_name');

			$data['main_view']['perpetratorstatus']	= $this->configuration->PerpetratorStatus();

			$data['main_view']['content']				= 'DataPerpetrator/FormEditDataPerpetrator_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditDataPerpetrator(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array (
				'cell_group_id'						=> $this->input->post('cell_group_id',true),
				'perpetrator_id'					=> $this->input->post('perpetrator_id',true),
				'perpetrator_name'					=> $this->input->post('perpetrator_name',true),
				'perpetrator_address'				=> $this->input->post('perpetrator_address',true),
				'perpetrator_phone'				=> $this->input->post('perpetrator_phone',true),
				'perpetrator_email'				=> $this->input->post('perpetrator_email',true),
				'perpetrator_date_of_birth'		=> tgltodb($this->input->post('perpetrator_date_of_birth',true)),
				'perpetrator_registration_date'	=> tgltodb($this->input->post('perpetrator_registration_date',true)),
				'perpetrator_token'				=> $this->input->post('perpetrator_token',true),
				'data_state'						=> 0,
				'updated_id'						=> $auth['user_id'],
				'updated_on' 						=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('cell_group_id', 'Nama Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_name', 'Nama Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_address', 'Alamat Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_phone', 'Telepon Pelaku', 'required');
			$this->form_validation->set_rules('perpetrator_date_of_birth', 'Tanggal Lahir Pelaku', 'required');

			$old_data	= $this->DataPerpetrator_model->getDataPerpetrator_Detail($data['perpetrator_id']);
			
			if($this->form_validation->run()==true){
				if($this->DataPerpetrator_model->updateDataPerpetrator($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['perpetrator_id'], '2141', 'DataPerpetrator.processEditDataPerpetrator', 'Edit Data Perpetrator');

					$this->fungsi->set_change_log($auth['user_id'], $data['perpetrator_id'], '2143', 'DataPerpetrator.processEditDataPerpetrator', 'Edit Data Perpetrator', $old_data, $data);

					$data_history = array(
						'perpetrator_id'				=> $data['perpetrator_id'],
						'cell_group_id'					=> $data['cell_group_id'],
						'perpetrator_history_date'		=> date("Y-m-d"),
						'perpetrator_history_token'	=> $data['perpetrator_token'],
					);

					$perpetrator_history_token 			= $this->DataPerpetrator_model->getPerpetratorHistoryToken($data_history['perpetrator_history_token']);

					if ($perpetrator_history_token == 0){
						$this->DataPerpetrator_model->insertDataPerpetratorHistory($data_history);

						$this->session->unset_userdata('DataPerpetratorToken-'.$unique['unique']);
					}

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Pelaku Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('perpetrator/edit/'.$data['perpetrator_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Pelaku Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('perpetrator/edit/'.$data['perpetrator_id']);
				}
			}else{
				$this->session->set_userdata('EditDataPerpetrator',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('perpetrator/edit/'.$data['perpetrator_id']);
			}
		}

		
	}
?>