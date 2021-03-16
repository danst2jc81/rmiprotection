<?php
	Class HomePage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('HomePage_model');
			$this->load->helper('sistem');
			$this->load->database("default");
			$this->load->library('configuration');
			$this->load->helper('url'); 
		}
		
		public function index(){
			$data['main_view']['content']				= 'HomePage/homepage_view';

			$this->load->view('HomePage_view', $data);
		}
	}
?>