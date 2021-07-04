<?php
	Class CorePackagePrice extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'package-price';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CorePackagePrice_model');
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
			$sesi		= $this->session->userdata('filter-CorePackagePrice');

			if(!is_array($sesi)){
				$sesi['package_id']		= '';
			}

			$this->session->unset_userdata('addCorePackagePrice-'.$unique['unique']);
			$this->session->unset_userdata('CorePackagePriceToken-'.$unique['unique']);

			$data['main_view']['corepackageprice']		= $this->CorePackagePrice_model->getCorePackagePrice($sesi['package_id']);

			$data['main_view']['corepackage']			= create_double($this->CorePackagePrice_model->getCorePackage(), 'package_id', 'package_name');

			$data['main_view']['content']				= 'CorePackagePrice/ListCorePackagePrice_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'package_id'				=> $this->input->post('package_id'),
			);

			$this->session->set_userdata('filter-CorePackagePrice', $data);
			redirect('package-price');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-CorePackagePrice');
			redirect('package-price');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePackagePrice-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCorePackagePrice-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePackagePrice-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCorePackagePrice-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCorePackagePrice-'.$unique['unique']);
			redirect('package-price/add');
		}

		public function addCorePackagePrice(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('CorePackagePriceToken-'.$unique['unique']);

			$package_price_token		= $this->session->userdata('CorePackagePriceToken-'.$unique['unique']);

			if(empty($package_price_token)){
				$package_price_token = md5(rand());
				$this->session->set_userdata('CorePackagePriceToken-'.$unique['unique'], $package_price_token);
			}

			$data['main_view']['corepackage']		= create_double($this->CorePackagePrice_model->getCorePackage(), 'package_id', 'package_name');

			$data['main_view']['content']			= 'CorePackagePrice/FormAddCorePackagePrice_view';

			$this->load->view('MainPage_view',$data);
		}
	
		public function processAddCorePackagePrice(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data= array (
				'package_id'					=> $this->input->post('package_id',true),
				'package_price_month'			=> $this->input->post('package_price_month',true),
				'package_price_amount'			=> $this->input->post('package_price_amount',true),
				'package_price_token'			=> $this->input->post('package_price_token',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on' 					=> date('Ymdhis'),
			);

			$this->form_validation->set_rules('package_id', 'Nama Paket', 'required');
			$this->form_validation->set_rules('package_price_month', 'Total Bulan ', 'required');
			$this->form_validation->set_rules('package_price_amount', 'Harga Paket', 'required');


			$package_price_token 				= $this->CorePackagePrice_model->getPackagePriceToken($data['package_price_token']);
			
			if($this->form_validation->run()==true){
				if ($package_price_token == 0){
					if($this->CorePackagePrice_model->insertCorePackagePrice($data)){
						$auth = $this->session->userdata('auth');

						$package_price_id = $this->CorePackagePrice_model->getPackagePriceID($data['created_id']);

						$this->fungsi->set_log($auth['user_id'], $package_price_id, '2141', 'CorePackagePrice.processAddCorePackagePrice', 'Add New Core Package Price');

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Harga Paket Berhasil
								</div> ";
						$this->session->unset_userdata('addCorePackagePrice-'.$unique['unique']);
						$this->session->unset_userdata('CorePackagePriceToken-'.$unique['unique']);
						$this->session->set_userdata('message',$msg);
						redirect('package-price/add');
					}else{
						$this->session->set_userdata('addCorePackagePrice',$data);
						$msg = "<div class='alert alert-danger alert-dismissable'>
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
									Tambah Data Harga Paket Gagal
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('package-price/add');
					}
				} else {
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Data Harga Paket Sudah Ada
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package-price/add');
				}
			}else{
				$this->session->set_userdata('addCorePackagePrice',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('package-price/add');
			}
		}
		
		public function editCorePackagePrice(){
			$package_price_id 		= $this->uri->segment(3);
			$auth 					= $this->session->userdata('auth');

			$data['main_view']['corepackageprice']	= $this->CorePackagePrice_model->getCorePackagePrice_Detail($package_price_id);

			$data['main_view']['corepackage']		= create_double($this->CorePackagePrice_model->getCorePackage(), 'package_id', 'package_name');

			$data['main_view']['content']			= 'CorePackagePrice/FormEditCorePackagePrice_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCorePackagePrice(){
			$auth = $this->session->userdata('auth');

			$data = array (
				'package_price_id'			=> $this->input->post('package_price_id',true),
				'package_id'				=> $this->input->post('package_id',true),
				'package_price_month'		=> $this->input->post('package_price_month',true),
				'package_price_amount'		=> $this->input->post('package_price_amount',true),
				'updated_id'				=> $auth['user_id'],
				'updated_on' 				=> date('Ymdhis'),
			);
			
			$this->form_validation->set_rules('package_id', 'Nama Paket', 'required');
			$this->form_validation->set_rules('package_price_month', 'Total Bulan ', 'required');
			$this->form_validation->set_rules('package_price_amount', 'Harga Paket', 'required');
		
			$old_data	= $this->CorePackagePrice_model->getCorePackagePrice_Detail($data['package_price_id']);
			
			if($this->form_validation->run()==true){
				if($this->CorePackagePrice_model->updateCorePackagePrice($data)==true){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['package_price_id'], '2141', 'CorePackagePrice.processEditCorePackagePrice', 'Edit Core Package Price');

					$this->fungsi->set_change_log($auth['user_id'], $data['package_price_id'], '2143', 'CorePackagePrice.processEditCorePackagePrice', 'Edit Core PackagePrice', $old_data, $data);

					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Harga Paket Berhasil
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package-price/edit/'.$data['package_price_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Ubah Data Harga Paket Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('package-price/edit/'.$data['package_price_id']);
				}
			}else{
				$this->session->set_userdata('EditCorePackagePrice',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('package-price/edit/'.$data['package_price_id']);
			}
		}

		public function deleteCorePackagePrice(){
			$auth 				= $this->session->userdata('auth');
			$package_price_id 			= $this->uri->segment(3);

			$data = array(
				'package_price_id'		=> $package_price_id,
				'deleted_id'			=> $auth['user_id'],
				'deleted_on'			=> date("Y-m-d H:i:s"),
				'data_state'			=> 2
			);

			if($this->CorePackagePrice_model->deleteCorePackagePrice($data)){
				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3204','Application.CorePackagePrice.deleteCorePackagePrice', $package_price_id,'Delete Core Package Price');

				$msg = "<div class='alert alert-success alert-dismissable'>                 
							Hapus Data Harga Paket Berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('package-price');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>                
						Hapus Data Harga Paket Gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('package-price');
			}
		}
	}
?>