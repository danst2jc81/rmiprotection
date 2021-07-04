<?php
	Class ContentEvent extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'content-event';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('ContentEvent_model');
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

			$sesi		= $this->session->userdata('filter-ContentEvent');

			if(!is_array($sesi)){
				$sesi['start_date']			= "";
				$sesi['end_date']			= "";
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$this->session->unset_userdata('addContentEvent-'.$unique['unique']);
			$this->session->unset_userdata('ContentEventToken-'.$unique['unique']);

			$data['main_view']['contentevent']			= $this->ContentEvent_model->getContentEvent($start_date, $end_date);

			$data['main_view']['content']				= 'ContentEvent/ListContentEvent_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'start_date'			=> $this->input->post('start_date'),
				'end_date'				=> $this->input->post('end_date'),
			);
			$this->session->set_userdata('filter-ContentEvent',$data);
			redirect('content-event');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-ContentEvent');
			redirect('content-event');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addContentEvent-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addContentEvent-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addContentEvent-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addContentEvent-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addContentEvent-'.$unique['unique']);
			redirect('content-event/add');
		}

		public function addContentEvent(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('ContentEventToken-'.$unique['unique']);

			$event_token		= $this->session->userdata('ContentEventToken-'.$unique['unique']);

			if(empty($event_token)){
				$event_token = md5(rand());
				$this->session->set_userdata('ContentEventToken-'.$unique['unique'], $event_token);
			}

			$data['main_view']['content']			= 'ContentEvent/FormAddContentEvent_view';

			$this->load->view('MainPage_view',$data);
		}

		function processAddContentEvent(){
			$auth 				= $this->session->userdata('auth');
			$unique 			= $this->session->userdata('unique');
			
			$fileName 			= $_FILES['event_image']['name'];
			$fileSize 			= $_FILES['event_image']['size'];
			$fileError 			= $_FILES['event_image']['error'];
			
			if($fileSize > 0){
				$parse			= explode('.',$fileName);
				$image_types 	= array('jpg');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('content-event');
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('content-event');
			}
			
			$auth 								= $this->session->userdata('auth');
			$unique 							= $this->session->userdata('unique');


			$data = array (
				'event_title'			=> $this->input->post('event_title',true),
				'event_description'		=> $this->input->post('event_description',true),
				'event_date'				=> tgltodb($this->input->post('event_date',true)),
				'event_token'			=> $this->input->post('event_token',true),
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on' 			=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('event_title', 'Judul Berita', 'required');
			$this->form_validation->set_rules('event_description', 'Isi Berita', 'required');
			$this->form_validation->set_rules('event_date', 'Tanggal Berita', 'required');
			
			$event_token 				= $this->ContentEvent_model->getEventToken($data['event_token']);
			
			if($this->form_validation->run()==true){
				if ($event_token == 0){
					if($fileSize > 0 || $fileError == 0){
						try {
							$newfilename 				= $_FILES['event_image']['name'];
							$config['upload_path'] 		= get_root_path()."/img/event/";
							$config['allowed_types'] 	= 'jpg';
							$config['overwrite'] 		= false;
							$config['remove_spaces'] 	= true;
							$config['file_name'] 		= $newfilename;						
							
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('event_image')){

								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
										".$this->upload->display_errors('', '')."
									</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('content-event/add');
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
									redirect('content-event/add');
								} else {
									$data['event_image'] = $this->upload->file_name;
									
									if($this->ContentEvent_model->insertContentEvent($data)){
										$auth = $this->session->userdata('auth');

										$event_id = $this->ContentEvent_model->getEventID($data['created_id']);

										$this->fungsi->set_log($auth['user_id'], $event_id, '2141', 'ContentEvent.processAddContentEvent', 'Add New Content Event');

										$msg = "<div class='alert alert-success alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
													Tambah Data Berita Berhasil
												</div> ";
										$this->session->unset_userdata('addContentEvent-'.$unique['unique']);
										$this->session->unset_userdata('ContentEventToken-'.$unique['unique']);
										$this->session->set_userdata('message',$msg);
										redirect('content-event/add');
									}else{
										$msg = "<div class='alert alert-danger alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
													Tambah Data Berita Gagal
												</div> ";
										$this->session->set_userdata('message',$msg);
										$this->session->set_userdata('addfleet',$data);
										redirect('content-event/add');
									}
								}
							}
						} catch (Exception $msg){
							$message = "<div class='alert alert-danger alert-dismissable'>  
										button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
									Error in uploading due".$msg->getMessage()."
								</div> ";
							$this->session->set_userdata('message',$message);
							redirect('content-event/add');
						}
					} else {
						if($this->ContentEvent_model->insertContentEvent($data)){
							$auth = $this->session->userdata('auth');

							$event_id = $this->ContentEvent_model->getEventID($data['created_id']);

							$this->fungsi->set_log($auth['user_id'], $event_id, '2141', 'ContentEvent.processAddContentEvent', 'Add New Content Event');

							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Tambah Data Berita Berhasil
									</div> ";
							$this->session->unset_userdata('addContentEvent-'.$unique['unique']);
							$this->session->unset_userdata('ContentEventToken-'.$unique['unique']);
							$this->session->set_userdata('message',$msg);
							redirect('content-event/add');
						}else{
							$msg = "<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
										Tambah Data Berita Gagal
									</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('addfleet',$data);
							redirect('content-event/add');
						}
					}
				} else {
					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Tambah Data Berita Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('content-event/add');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('content-event/add');
			}
		}


		
		public function editContentEvent(){
			$event_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$data['main_view']['contentevent']	= $this->ContentEvent_model->getContentEvent_Detail($event_id);

			$data['main_view']['content']		= 'ContentEvent/FormEditContentEvent_view';
			$this->load->view('MainPage_view',$data);
		}
		
		

		function processEditContentEvent(){
			$auth 				= $this->session->userdata('auth');
			
			$fileName 			= $_FILES['event_image']['name'];
			$fileSize 			= $_FILES['event_image']['size'];
			$fileError 			= $_FILES['event_image']['error'];
			
			if($fileSize > 0){
				$parse		= explode('.',$fileName);
				$image_types = array('jpg');
				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('content-event');
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('content-event');
			}
			
			$auth 					= $this->session->userdata('auth');
			$unique 				= $this->session->userdata('unique');

			$data= array (
				'event_id'				=> $this->input->post('event_id',true),
				'event_title'			=> $this->input->post('event_title',true),
				'event_description'		=> $this->input->post('event_description',true),
				'event_date'				=> tgltodb($this->input->post('event_date',true)),
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on' 			=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('event_title', 'Judul Berita', 'required');
			$this->form_validation->set_rules('event_description', 'Isi Berita', 'required');
			$this->form_validation->set_rules('event_date', 'Tanggal Berita', 'required');

			$old_data	= $this->ContentEvent_model->getContentEvent_Detail($data['event_id']);
			
			if($this->form_validation->run()==true){
				if($fileSize > 0 || $fileError == 0){
					try {
						$newfilename 				= $_FILES['event_image']['name'];
						$config['upload_path'] 		= get_root_path()."/img/event/";
						$config['allowed_types'] 	= 'jpg';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;						
						
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('event_image')){
						
							$msg = "<div class='alert alert-danger alert-dismissable'>  
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('content-event/edit/'.$data['event_id']);
						} else {
							$config['source_image'] 	= $this->upload->upload_path.$this->upload->file_name;
							$config['maintain_ratio'] 	= TRUE;
				
							$this->load->library('image_lib', $config);

							if ( ! $this->image_lib->resize()){
								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                      
									".$this->upload->display_errors('', '')."
								</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('content-event/edit/'.$data['event_id']);
							} else {
								$data['event_image'] = $this->upload->file_name;
								
								if($this->ContentEvent_model->updateContentEvent($data)){
									$auth = $this->session->userdata('auth');

									$this->fungsi->set_log($auth['user_id'], $data['event_id'], '2141', 'ContentEvent.processEditContentEvent', 'Edit Content Event');

									$this->fungsi->set_change_log($auth['user_id'], $data['event_id'], '2143', 'ContentEvent.processEditContentEvent', 'Edit Content Event', $old_data, $data);

									$msg = "<div class='alert alert-success alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
												Ubah Data Berita Berhasil
											</div> ";
									$this->session->set_userdata('message',$msg);
									redirect('content-event/edit/'.$data['event_id']);
								}else{
									$msg = "<div class='alert alert-danger alert-dismissable'>
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
												Ubah Data Berita Gagal
											</div> ";
									$this->session->set_userdata('message',$msg);
									$this->session->set_userdata('addfleet',$data);
									redirect('content-event/edit/'.$data['event_id']);
								}
							}
						}
					} catch (Exception $msg){
						$message = "<div class='alert alert-danger alert-dismissable'>  
									button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('content-event/edit/'.$data['event_id']);
					}
				} else {
					if($this->ContentEvent_model->updateContentEvent($data)){
						$auth = $this->session->userdata('auth');

						$this->fungsi->set_log($auth['user_id'], $data['event_id'], '2141', 'ContentEvent.processEditContentEvent', 'Edit Content Event');

						$this->fungsi->set_change_log($auth['user_id'], $data['event_id'], '2143', 'ContentEvent.processEditContentEvent', 'Edit Content Event', $old_data, $data);

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
									Ubah Data Berita Berhasil
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('content-event/edit/'.$data['event_id']);
					}else{
						$msg = "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
									Ubah Data Berita Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addfleet',$data);
						redirect('content-event/edit/'.$data['event_id']);
					}
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('content-event/editcontent-event/'.$data['event_id']);
			}
		}

		public function deleteContentEvent(){
			$auth 				= $this->session->userdata('auth');
			$event_id 	= $this->uri->segment(3);

			$data = array(
				'event_id'				=> $event_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->ContentEvent_model->deleteContentEvent($data)){
				$this->fungsi->set_log($auth['user_id'], $event_id, '3204','ContentEvent.deleteContentEvent', 'Delete Content Event');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Berita Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('content-event');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Berita Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('content-event');
			}
		}

	}
?>