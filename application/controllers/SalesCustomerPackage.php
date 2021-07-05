<?php
	Class SalesCustomerPackage extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'customer';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('SalesCustomerPackage_model');
			$this->load->helper('sistem');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->helper('url');
			$this->load->database('default');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
			$this->load->library('email');
		}
		
		public function index(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$sesi		= $this->session->userdata('filter-SalesCustomerPackage');

			if(!is_array($sesi)){
				$sesi['start_date']					= date("Y-m-d");
				$sesi['end_date']					= date("Y-m-d");
				$sesi['customer_status']			= 9;
				$sesi['package_id']					= 0;
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['main_view']['salescustomerpackage']				= $this->SalesCustomerPackage_model->getSalesCustomerPackage($start_date, $end_date, $sesi['customer_status'], $sesi['package_id']);

			$data['main_view']['corepackage']				= create_double($this->SalesCustomerPackage_model->getCorePackage(), 'package_id', 'package_name');

			$data['main_view']['customerstatus']			= $this->configuration->CustomerStatus();

			$data['main_view']['content']					= 'SalesCustomerPackage/ListSalesCustomerPackage_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$auth 	= $this->session->userdata('auth');

			$data = array (
				'start_date'				=> $this->input->post('start_date'),
				'end_date'					=> $this->input->post('end_date'),
				'customer_status'			=> $this->input->post('customer_status'),
				'package_id'				=> $this->input->post('package_id'),
			);
			$this->session->set_userdata('filter-SalesCustomerPackage',$data);
			redirect('customer');
		}
		
		public function reset_search(){
			$this->session->unset_userdata('filter-SalesCustomerPackage');
			redirect('customer');
		}

		public function detailSalesCustomer(){
			$customer_id 		= $this->uri->segment(3);
			$unique 			= $this->session->userdata('unique');

			$data['main_view']['salescustomerpackage']			= $this->SalesCustomerPackage_model->getSalesCustomerPackage_Detail($customer_id);

			$data['main_view']['customerstatus']		= $this->configuration->CustomerStatus();

			$data['main_view']['collectionstatus']		= $this->configuration->CollectionStatus();

			$data['main_view']['content']				= 'SalesCustomerPackage/FormDetailSalesCustomerPackage_view';
			$this->load->view('MainPage_view',$data);
		}		

		public function getSalesCustomerPackageUnPaid(){

			$data['main_view']['salescustomerpackageunpaid']	= $this->SalesCustomerPackage_model->getSalesCustomerPackage_UnPaid();

			$data['main_view']['content']						= 'SalesCustomerPackage/ListSalesCustomerPackageUnPaid_view';
			$this->load->view('MainPage_view',$data);
		}

		public function getSalesCustomerPackageUnPaid_Detail(){
			$customer_package_id 	= $this->uri->segment(3);
			$unique 				= $this->session->userdata('unique');

			$data['main_view']['salescustomerpackage']	= $this->SalesCustomerPackage_model->getSalesCustomerPackage_Detail($customer_package_id);

			$data['main_view']['content']				= 'SalesCustomerPackage/FormSalesCustomerPackagePaid_view';
			$this->load->view('MainPage_view',$data);
		}	

		public function processUpdateSalesCustomerPackage_Collection(){
			$page 	= $this->uri->segment(3);
			$auth	= $this->session->userdata('auth');
			
			$data = array (
				'customer_package_id'				=> $this->input->post('customer_package_id',true),
				'customer_package_collection_date'	=> tgltodb($this->input->post('customer_collection_date',true)),
				'customer_package_status'			=> 1,
				'customer_package_collection_on'	=> date('Y-m-d H:i:s'),
				'customer_package_collection_id'	=> $auth['user_id'],
			);

			$customer_package_date 				= date("Y-m-d");
			$package_price_month				= $this->input->post('package_price_month',true);
			$package_price_status				= $this->input->post('package_price_status',true);

			
			if ($package_price_status == 1){
				$customer_last_date 				= date('Y-m-d', strtotime($customer_package_date. ' + '. $package_price_month.'days'));
			} else {
				$customer_last_date 				= date('Y-m-d', strtotime($customer_package_date. ' + '. $package_price_month.'months'));
			}
			

			$data_customer = array(
				'customer_id'						=> $this->input->post('customer_id',true),
				'package_id'						=> $this->input->post('package_id',true),
				'package_price_id'					=> $this->input->post('package_price_id',true),
				'package_status'					=> $this->input->post('package_status',true),
				'customer_package_date'				=> $customer_package_date,
				'customer_last_date'				=> $customer_last_date,
				'customer_package_search_balance'	=> $this->input->post('package_search_balance',true),
				'customer_package_add_balance'		=> $this->input->post('package_add_balance',true),
				'customer_package_balance_status'	=> $this->input->post('package_balance_status',true),
			);

			/* print_r("data ");
			print_r($data);
			exit; */

			$this->form_validation->set_rules('customer_package_collection_date', 'Tanggal Bayar', 'required');
				
			if($this->form_validation->run()==true){
				if($this->SalesCustomerPackage_model->updateSalesCustomerPackage_Collection($data)){
					$auth	= $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $data['customer_id'], '2141', 'SalesCustomerPackage.processUpdateSalesCustomerPackage_Collection', 'Update Sales Customer Collection');

					/* $salescustomerpackage = $this->SalesCustomerPackage_model->getSalesCustomerPackage_Detail($data['customer_id']);

					if ($this->sendEmailFirst($salescustomerpackage)){
						$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Edit Pembayaran Customer Berhasil
							</div>";
						$this->session->set_userdata('message',$msg);
						redirect('customer/customer-unpaid');
					} else {
						$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Kirim Email Gagal
							</div>";
						$this->session->set_userdata('message',$msg);
						redirect('customer/collection/'.$data['customer_id']);
					} */

					if ($this->SalesCustomerPackage_model->updateSalesCustomer($data_customer)){
						$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
								Edit Pembayaran Customer Berhasil
							</div>";
						$this->session->set_userdata('message',$msg);
						redirect('customer-package/customer-package-unpaid');
					}

					
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'> 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
							Edit Pembayaran Customer Gagal
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('customer/collection/'.$data['customer_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('customer/collection/'.$data['customer_id']);
			}
		}

		public function sendEmailFirst($data){
			/*public function sendEmailFirst(){*/
				$config['protocol'] = 'sendmail';
				$config['mailpath'] = '/usr/sbin/sendmail';
				$config['charset'] 	= 'iso-8859-1';
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
	
				/*$customer_email = "danst2jc@gmail.com";
				$customer_name = "Daniel Setiawan";
				$customer_verification_code = "123456";*/
	
				$this->email->initialize($config);
				$this->email->from('no-reply@superdigitalbisnis.com', 'Super Digital Bisnis');
				$this->email->to($data['customer_email']);
				
				$this->email->subject('Halo '.$data['customer_name'].' Berikut Kode Verifikasi Anda');
				$base_url = base_url();
	
				$body = "
					<!DOCTYPE html>
					<html>
						<head>
							<meta charset=\"utf-8\" />
							<title>Super Digital Bisnis</title>
							<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
						</head>
						<body>
							<div>
								<div align=\"center\" >
									<img src=\"".$base_url."img/logo_email.png\" alt=\"\" width=\"50%\" height=\"50%\" alt=\"\">
								div>
								<hr>
								<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\">Halo	".$data['customer_name'].",
								</p>
								<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\"> Berikut ini adalah kode verifikasi Anda </a> 
								</p>
								<div align=\"center\" >
									<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 48px;line-height: 25px;Margin-bottom: 25px\"> ".$data['customer_verification_code']." </a> 
									</p>
								</div>
								<p style=\"Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px\">Jika Anda memiliki pertanyaan mengenai kode verifikasi, silakan mengirimkan surel ke <a href=\"mailto:info@superdigitalbisnis.com\">info@superdigitalbisnis.com</a>.
								</p>
							</div>
						</body>
					</html>
				";
	
				$this->email->message($body);
	
	
	
				if ($this->email->send()){
					return true;
				} else {
					return false;
				}
			}

	}
?>