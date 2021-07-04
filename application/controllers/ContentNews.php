<?php
	Class ContentNews extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'content-news';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('ContentNews_model');
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

			$sesi		= $this->session->userdata('filter-ContentNews');

			if(!is_array($sesi)){
				$sesi['start_date']			= "";
				$sesi['end_date']			= "";
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$this->session->unset_userdata('addContentNews-'.$unique['unique']);
			$this->session->unset_userdata('ContentNewsToken-'.$unique['unique']);

			$data['main_view']['contentnews']			= $this->ContentNews_model->getContentNews($start_date, $end_date);

			$data['main_view']['content']				= 'ContentNews/ListContentNews_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'start_date'			=> $this->input->post('start_date'),
				'end_date'				=> $this->input->post('end_date'),
			);
			$this->session->set_userdata('filter-ContentNews',$data);
			redirect('content-news');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-ContentNews');
			redirect('content-news');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addContentNews-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addContentNews-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addContentNews-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addContentNews-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addContentNews-'.$unique['unique']);
			redirect('content-news/add');
		}

		public function addContentNews(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('ContentNewsToken-'.$unique['unique']);

			$news_token		= $this->session->userdata('ContentNewsToken-'.$unique['unique']);

			if(empty($news_token)){
				$news_token = md5(rand());
				$this->session->set_userdata('ContentNewsToken-'.$unique['unique'], $news_token);
			}

			$data['main_view']['content']			= 'ContentNews/FormAddContentNews_view';

			$this->load->view('MainPage_view',$data);
		}

		function processAddContentNews(){
			$auth 				= $this->session->userdata('auth');
			$unique 			= $this->session->userdata('unique');
			
			$fileName 			= $_FILES['news_image']['name'];
			$fileSize 			= $_FILES['news_image']['size'];
			$fileError 			= $_FILES['news_image']['error'];
			
			if($fileSize > 0){
				$parse			= explode('.',$fileName);
				$image_types 	= array('jpg');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('content-news');
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('content-news');
			}
			
			$auth 								= $this->session->userdata('auth');
			$unique 							= $this->session->userdata('unique');


			$data = array (
				'news_title'			=> $this->input->post('news_title',true),
				'news_description'		=> $this->input->post('news_description',true),
				'news_date'				=> tgltodb($this->input->post('news_date',true)),
				'news_token'			=> $this->input->post('news_token',true),
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on' 			=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('news_title', 'Judul Berita', 'required');
			$this->form_validation->set_rules('news_description', 'Isi Berita', 'required');
			$this->form_validation->set_rules('news_date', 'Tanggal Berita', 'required');
			
			$news_token 				= $this->ContentNews_model->getNewsToken($data['news_token']);
			
			if($this->form_validation->run()==true){
				if ($news_token == 0){
					if($fileSize > 0 || $fileError == 0){
						try {
							$newfilename 				= $_FILES['news_image']['name'];
							$config['upload_path'] 		= get_root_path()."/img/news/";
							$config['allowed_types'] 	= 'jpg';
							$config['overwrite'] 		= false;
							$config['remove_spaces'] 	= true;
							$config['file_name'] 		= $newfilename;						
							
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload('news_image')){

								$msg = "<div class='alert alert-danger alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
										".$this->upload->display_errors('', '')."
									</div> ";
								$this->session->set_userdata('message',$msg);
								redirect('content-news/add');
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
									redirect('content-news/add');
								} else {
									$data['news_image'] = $this->upload->file_name;
									
									if($this->ContentNews_model->insertContentNews($data)){
										$auth = $this->session->userdata('auth');

										$news_id = $this->ContentNews_model->getNewsID($data['created_id']);

										$this->fungsi->set_log($auth['user_id'], $news_id, '2141', 'ContentNews.processAddContentNews', 'Add New Content News');

										$msg = "<div class='alert alert-success alert-dismissable'>  
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
													Tambah Data Berita Berhasil
												</div> ";
										$this->session->unset_userdata('addContentNews-'.$unique['unique']);
										$this->session->unset_userdata('ContentNewsToken-'.$unique['unique']);
										$this->session->set_userdata('message',$msg);
										redirect('content-news/add');
									}else{
										$msg = "<div class='alert alert-danger alert-dismissable'>
													<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
													Tambah Data Berita Gagal
												</div> ";
										$this->session->set_userdata('message',$msg);
										$this->session->set_userdata('addfleet',$data);
										redirect('content-news/add');
									}
								}
							}
						} catch (Exception $msg){
							$message = "<div class='alert alert-danger alert-dismissable'>  
										button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
									Error in uploading due".$msg->getMessage()."
								</div> ";
							$this->session->set_userdata('message',$message);
							redirect('content-news/add');
						}
					} else {
						if($this->ContentNews_model->insertContentNews($data)){
							$auth = $this->session->userdata('auth');

							$news_id = $this->ContentNews_model->getNewsID($data['created_id']);

							$this->fungsi->set_log($auth['user_id'], $news_id, '2141', 'ContentNews.processAddContentNews', 'Add New Content News');

							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
										Tambah Data Berita Berhasil
									</div> ";
							$this->session->unset_userdata('addContentNews-'.$unique['unique']);
							$this->session->unset_userdata('ContentNewsToken-'.$unique['unique']);
							$this->session->set_userdata('message',$msg);
							redirect('content-news/add');
						}else{
							$msg = "<div class='alert alert-danger alert-dismissable'>
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
										Tambah Data Berita Gagal
									</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('addfleet',$data);
							redirect('content-news/add');
						}
					}
				} else {
					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Tambah Data Berita Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('content-news/add');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('content-news/add');
			}
		}


		
		public function editContentNews(){
			$news_id 		= $this->uri->segment(3);
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');

			$data['main_view']['contentnews']	= $this->ContentNews_model->getContentNews_Detail($news_id);

			$data['main_view']['content']		= 'ContentNews/FormEditContentNews_view';
			$this->load->view('MainPage_view',$data);
		}
		
		

		function processEditContentNews(){
			$auth 				= $this->session->userdata('auth');
			
			$fileName 			= $_FILES['news_image']['name'];
			$fileSize 			= $_FILES['news_image']['size'];
			$fileError 			= $_FILES['news_image']['error'];
			
			if($fileSize > 0){
				$parse		= explode('.',$fileName);
				$image_types = array('jpg');
				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('content-news');
				}
			}
			
			if (round($fileSize / 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
						filesize not allowed, max file 1024 Kb!!!
					</div> ";
				$this->session->set_userdata('message',$message);
				redirect('content-news');
			}
			
			$auth 					= $this->session->userdata('auth');
			$unique 				= $this->session->userdata('unique');

			$data= array (
				'news_id'				=> $this->input->post('news_id',true),
				'news_title'			=> $this->input->post('news_title',true),
				'news_description'		=> $this->input->post('news_description',true),
				'news_date'				=> tgltodb($this->input->post('news_date',true)),
				'data_state'			=> 0,
				'created_id'			=> $auth['user_id'],
				'created_on' 			=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('news_title', 'Judul Berita', 'required');
			$this->form_validation->set_rules('news_description', 'Isi Berita', 'required');
			$this->form_validation->set_rules('news_date', 'Tanggal Berita', 'required');

			$old_data	= $this->ContentNews_model->getContentNews_Detail($data['news_id']);
			
			if($this->form_validation->run()==true){
				if($fileSize > 0 || $fileError == 0){
					try {
						$newfilename 				= $_FILES['news_image']['name'];
						$config['upload_path'] 		= get_root_path()."/img/news/";
						$config['allowed_types'] 	= 'jpg';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;						
						
						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload('news_image')){
						
							$msg = "<div class='alert alert-danger alert-dismissable'>  
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                   
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('content-news/edit/'.$data['news_id']);
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
								redirect('content-news/edit/'.$data['news_id']);
							} else {
								$data['news_image'] = $this->upload->file_name;
								
								if($this->ContentNews_model->updateContentNews($data)){
									$auth = $this->session->userdata('auth');

									$this->fungsi->set_log($auth['user_id'], $data['news_id'], '2141', 'ContentNews.processEditContentNews', 'Edit Content News');

									$this->fungsi->set_change_log($auth['user_id'], $data['news_id'], '2143', 'ContentNews.processEditContentNews', 'Edit Content News', $old_data, $data);

									$msg = "<div class='alert alert-success alert-dismissable'>  
											<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
												Ubah Data Berita Berhasil
											</div> ";
									$this->session->set_userdata('message',$msg);
									redirect('content-news/edit/'.$data['news_id']);
								}else{
									$msg = "<div class='alert alert-danger alert-dismissable'>
												<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
												Ubah Data Berita Gagal
											</div> ";
									$this->session->set_userdata('message',$msg);
									$this->session->set_userdata('addfleet',$data);
									redirect('content-news/edit/'.$data['news_id']);
								}
							}
						}
					} catch (Exception $msg){
						$message = "<div class='alert alert-danger alert-dismissable'>  
									button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                    
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('content-news/edit/'.$data['news_id']);
					}
				} else {
					if($this->ContentNews_model->updateContentNews($data)){
						$auth = $this->session->userdata('auth');

						$this->fungsi->set_log($auth['user_id'], $data['news_id'], '2141', 'ContentNews.processEditContentNews', 'Edit Content News');

						$this->fungsi->set_change_log($auth['user_id'], $data['news_id'], '2143', 'ContentNews.processEditContentNews', 'Edit Content News', $old_data, $data);

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
									Ubah Data Berita Berhasil
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('content-news/edit/'.$data['news_id']);
					}else{
						$msg = "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>              
									Ubah Data Berita Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addfleet',$data);
						redirect('content-news/edit/'.$data['news_id']);
					}
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('content-news/editcontent-news/'.$data['news_id']);
			}
		}

		public function deleteContentNews(){
			$auth 				= $this->session->userdata('auth');
			$news_id 	= $this->uri->segment(3);

			$data = array(
				'news_id'				=> $news_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->ContentNews_model->deleteContentNews($data)){
				$this->fungsi->set_log($auth['user_id'], $news_id, '3204','ContentNews.deleteContentNews', 'Delete Content News');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Berita Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('content-news');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Berita Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('content-news');
			}
		}

	}
?>