<?php
	Class AndroidMitraUtama extends CI_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('AndroidMitraUtama_model');
			$this->load->library('configuration');
			$this->load->helper('sistem');
			$this->load->database("default");
			$this->load->helper('url');
		}
		
		public function getProductionResult(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'productionresult'				=> "",
			);

			$data = array(
				'warehouse_check'		=> $this->input->post('warehouse_check',true),
				'machine_check'			=> $this->input->post('machine_check',true),
				'item_check'			=> $this->input->post('item_check',true),
				'period_date_check'		=> $this->input->post('period_date_check',true),
				'warehouse_id'			=> $this->input->post('warehouse_id',true),
				'machine_id'			=> $this->input->post('machine_id',true),				
				'item_id'				=> $this->input->post('item_id',true),				
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
			);

			if ($data['period_date_check'] == 0){
				$start_date 	= date("Y-m-d");
				$end_date 		= date("Y-m-d");
			} else {
				$start_date 	= $data['start_date'];
				$end_date 		= $data['end_date'];
			}

			if($response["error"] == FALSE){
				$productionresultlist 	= $this->AndroidMitraUtama_model->getProductionResult($data);

				/* print_r("salesyearlymonthlylist ");
				print_r($salesyearlymonthlylist);
				print_r("<BR> "); */
				/* exit; */

				if(!$productionresultlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($productionresultlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($productionresultlist)){
							foreach ($productionresultlist as $key => $val) {

								$productionresult[$key]['production_result_id'] 	= $val['production_result_id'];
								$productionresult[$key]['warehouse_id'] 			= $val['warehouse_id'];
								$productionresult[$key]['warehouse_name'] 			= $val['warehouse_name'];
								$productionresult[$key]['machine_id'] 				= $val['machine_id'];
								$productionresult[$key]['machine_name'] 			= $val['machine_name'];
								$productionresult[$key]['production_result_date'] 	= tgltoview($val['production_result_date']);
		
								$productionresultitemlist = $this->AndroidMitraUtama_model->getProductionResultItem_Detail($val['production_result_id'], $data['item_check'], $data['item_id']);

								$production_result_item_list = "";

								foreach ($productionresultitemlist as $keyItem => $valItem) {
									$productionresult[$key]['detail_item'][$keyItem]['item_name']			= $valItem['item_name'];
									$productionresult[$key]['detail_item'][$keyItem]['quantity']			= nominal($valItem['quantity']);
									$productionresult[$key]['detail_item'][$keyItem]['item_unit_name']			= $valItem['item_unit_name'];
								}
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['productionresult'] 				= $productionresult;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtWarehouse(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtwarehouse'			=> "",
			);

			if($response["error"] == FALSE){
				$invtwarehouselist = $this->AndroidMitraUtama_model->getInvtWarehouse();

				if(!$invtwarehouselist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtwarehouselist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtwarehouselist as $key => $val) {
							$invtwarehouse[$key]['warehouse_id']			= $val['warehouse_id'];
							$invtwarehouse[$key]['warehouse_code'] 			= $val['warehouse_code'];
							$invtwarehouse[$key]['warehouse_name'] 			= $val['warehouse_name'];
							$invtwarehouse[$key]['warehouse_phone'] 		= $val['warehouse_phone'];
							$invtwarehouse[$key]['warehouse_address'] 		= $val['warehouse_address'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtwarehouse'] 			= $invtwarehouse;
					}
				}
			}
			echo json_encode($response);
		}

		public function getCoreMachine(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'coremachine'			=> "",
			);

			$data = array(
				'warehouse_id'		=> $this->input->post('warehouse_id',true),
			);

			$data = array(
				'warehouse_id'		=> $this->input->post('warehouse_id',true),
			);

			if($response["error"] == FALSE){
				$coremachinelist = $this->AndroidMitraUtama_model->getCoreMachine($data['warehouse_id']);

				if(!$coremachinelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($coremachinelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($coremachinelist as $key => $val) {
							$coremachine[$key]['machine_id']			= $val['machine_id'];
							$coremachine[$key]['machine_code'] 			= $val['machine_code'];
							$coremachine[$key]['machine_name'] 			= $val['machine_name'];
							$coremachine[$key]['warehouse_id'] 			= $val['warehouse_id'];
							$coremachine[$key]['warehouse_name'] 		= $val['warehouse_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['coremachine'] 			= $coremachine;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItem_All(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemall'			=> "",
			);

			if($response["error"] == FALSE){
				$invtitemlist = $this->AndroidMitraUtama_model->getInvtItem_All();

				if(!$invtitemlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemlist as $key => $val) {
							$invtitemall[$key]['item_category_id']		= $val['item_category_id'];
							$invtitemall[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitemall[$key]['item_id'] 				= $val['item_id'];
							$invtitemall[$key]['item_name'] 			= $val['item_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemall'] 			= $invtitemall;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItemCategory(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemcategory'		=> "",
			);

			if($response["error"] == FALSE){
				$invtitemcategorylist = $this->AndroidMitraUtama_model->getInvtItemCategory();

				if(!$invtitemcategorylist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemcategorylist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemcategorylist as $key => $val) {
							$invtitemcategory[$key]['item_category_id']		= $val['item_category_id'];
							$invtitemcategory[$key]['item_category_name'] 	= $val['item_category_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemcategory'] 		= $invtitemcategory;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItem(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitem'				=> "",
			);

			$data = array(
				'item_category_id'		=> $this->input->post('item_category_id',true),
			);

			if($response["error"] == FALSE){
				$invtitemlist = $this->AndroidMitraUtama_model->getInvtItem($data['item_category_id']);

				if(!$invtitemlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemlist as $key => $val) {
							$invtitem[$key]['item_category_id']		= $val['item_category_id'];
							$invtitem[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitem[$key]['item_id'] 				= $val['item_id'];
							$invtitem[$key]['item_name'] 			= $val['item_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitem'] 				= $invtitem;
					}
				}
			}
			echo json_encode($response);
		}

		public function getInvtItemUnit(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemunit'			=> "",
			);

			if($response["error"] == FALSE){
				$invtitemunitlist = $this->AndroidMitraUtama_model->getInvtItemUnit();

				if(!$invtitemunitlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemunitlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemunitlist as $key => $val) {
							$invtitemunit[$key]['item_unit_id'] 		= $val['item_unit_id'];
							$invtitemunit[$key]['item_unit_name'] 		= $val['item_unit_name'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemunit'] 			= $invtitemunit;
					}
				}
			}
			echo json_encode($response);
		}

		public function processAddProductionResult(){
			$data = array (
				'warehouse_id'				=> $this->input->post('warehouse_id',true),
				'machine_id'				=> $this->input->post('machine_id',true),
				'user_id'					=> $this->input->post('user_id',true),
				'production_result_date'	=> tgltodb($this->input->post('production_result_date',true)),
				'production_result_remark'	=> $this->input->post('production_result_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_productionresult = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_productionresult as $keyProductionResult => $valProductionResult){
				$data_item[$keyProductionResult] = array(
					'item_category_id'				=>	$valProductionResult['item_category_id'],
					'item_id'						=>	$valProductionResult['item_id'],
					'item_unit_id'					=>	$valProductionResult['item_unit_id'],
					'quantity'						=>	$valProductionResult['quantity'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					$total_item 		= $total_item + $valItem['quantity'];
				}

				$data_productionresult = array(
					'warehouse_id'						=> $data['warehouse_id'],
					'machine_id'						=> $data['machine_id'],
					'production_result_date'			=> $data['production_result_date'],
					'production_result_remark'			=> $this->input->post('production_result_remark',true),
					'total_item'						=> $total_item,
					'data_state'						=> 0,
					'created_id' 						=> $data['user_id'],
					'created_on' 						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidMitraUtama_model->insertProductionResult($data_productionresult)){
					$production_result_id = $this->AndroidMitraUtama_model->getProductionResultID($data_productionresult['created_id']);

					foreach($data_item as $key => $val){
						$data_productionresultitem = array (
							'production_result_id'				=> $production_result_id,
							'item_category_id'					=> $val['item_category_id'],
							'item_id'							=> $val['item_id'],
							'item_unit_id'						=> $val['item_unit_id'],
							'quantity'							=> $val['quantity'],
							'data_state'						=> 0,
							'created_id' 						=> $data['user_id'],
							'created_on' 						=> date("Y-m-d H:i:s"),
						);
						
						$this->AndroidMitraUtama_model->insertProductionResultItem($data_productionresultitem);
					}
				}

				$response['error_productionresult']		 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["production_result_id"] 			= $production_result_id;
			}
			
			echo json_encode($response);
		}	

		public function getAcctExpense(){
			$auth 			= $this->session->userdata('auth');
			$data = array(
				'database'			=> $this->input->post('database',true),
				'user_id'			=> $this->input->post('user_id',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'acctexpense'			=> "",
			);			

			if($response["error"] == FALSE){
				$acctexpenselist 	= $this->AndroidMitraUtama_model->getAcctExpense();

				if(!$acctexpenselist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctexpenselist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
							$acctexpense[0]['expense_id']			= 0;
							$acctexpense[0]['expense_name']			= '';
							$acctexpense[0]['account_id']			= 0;
						foreach ($acctexpenselist as $key => $val) {
							$acctexpense[$key]['expense_id']			= $val['expense_id'];
							$acctexpense[$key]['expense_name']		= $val['expense_name'];
							$acctexpense[$key]['account_id']			= $val['account_id'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['acctexpense'] 			= $acctexpense;
					}
				}
			}
			
			echo json_encode($response);
		}

		public function getAcctDisbursement(){
			$data = array(
				'user_id'		=> $this->input->post('user_id',true),
				'start_date'	=> $this->input->post('start_date',true),
				'end_date'		=> $this->input->post('end_date',true),				
			);

			/* $data = array(
				'user_id'		=> 1,
				'start_date'	=> '2020-08-01',
				'end_date'		=> '2020-08-10',				
			);

			print_r("data ");
			print_r($data);
			print_r("<BR> "); */

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'acctdisbursement'			=> "",
			);			

			if($response["error"] == FALSE){
				$acctdisbursementlist 	= $this->AndroidMitraUtama_model->getAcctDisbursement($data['start_date'], $data['end_date']);

				/* print_r("acctdisbursementlist ");
				print_r($acctdisbursementlist);
				print_r("<BR> "); */

				if(!$acctdisbursementlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($acctdisbursementlist as $key => $val) {
							$acctdisbursement[$key]['disbursement_id']				= $val['disbursement_id'];
							$acctdisbursement[$key]['disbursement_amount_total']	= nominal($val['disbursement_amount_total']);
							$acctdisbursement[$key]['expense_name']					= $val['expense_name'];
							$acctdisbursement[$key]['disbursement_date']			= tgltoview($val['disbursement_date']);

							$acctdisbursementitemlist = $this->AndroidMitraUtama_model->getAcctDisbursementItem_Detail($val['disbursement_id']);

							$acct_disbursement_item_list = "";

							foreach ($acctdisbursementitemlist as $keyItem => $valItem) {
								$acctdisbursement[$key]['detail_item'][$keyItem]['disbursement_item_title']		= $valItem['disbursement_item_title'];
								$acctdisbursement[$key]['detail_item'][$keyItem]['disbursement_item_amount']	= nominal($valItem['disbursement_item_amount']);
							}
						}
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['acctdisbursement'] 			= $acctdisbursement;
					}
				}
			}
			
			echo json_encode($response);
		}

		public function processAddAcctDisbursement(){
			$response = array(
				'error'									=> FALSE,
				'error_acctdisbursement'				=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_disbursement = array(
				'expense_id'					=> $this->input->post('expense_id', true),
				'disbursement_date'				=> tgltodb($this->input->post('disbursement_date', true)),
				'disbursement_title'			=> $this->input->post('disbursement_item_title', true),
				'disbursement_amount_total'		=> $this->input->post('disbursement_item_amount', true),
				'created_id'					=> $this->input->post('user_id', true),
				'created_on'					=> date("Y-m-d H:i:s"),
			);

			/* $data_disbursement = array(
				'expense_id'					=> 1,
				'disbursement_date'				=> date("Y-m-d"),
				'disbursement_amount_total'		=> 100000,
				'created_id'					=> 3,
				'created_on'					=> date("Y-m-d H:i:s"),
			); */

			$data_disbursement_item = array(
				'disbursement_item_title'		=> $this->input->post('disbursement_item_title', true),
				'disbursement_item_amount'		=> $this->input->post('disbursement_item_amount', true),
			);

			/* $data_disbursement_item = array(
				'disbursement_item_title'		=> 'text',
				'disbursement_item_amount'		=> 100000,
			); */

			if($response["error_acctdisbursement"] == FALSE){
				if(!empty($data_disbursement)){					
					if ($this->AndroidMitraUtama_model->insertAcctDisbursement($data_disbursement)){
						$disbursement_id = $this->AndroidMitraUtama_model->getDisbursementID($data_disbursement['created_id']);

						$data_item = array(
							'disbursement_id'				=> $disbursement_id,
							'disbursement_item_title'		=> $data_disbursement_item['disbursement_item_title'],
							'disbursement_item_amount'		=> $data_disbursement_item['disbursement_item_amount'],
						);

						if($this->AndroidMitraUtama_model->insertAcctDisbursementItem($data_item)){
							
						}

						$response['error_acctdisbursement'] 	= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['disbursement_id']			=  $disbursement_id;
					} else {
						$response['error_acctdisbursement'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddInvtWarehouse(){
			$response = array(
				'error'									=> FALSE,
				'error_invtwarehouse'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_warehouse = array(
				'warehouse_code'		=> $this->input->post('warehouse_code', true),
				'warehouse_name'		=> $this->input->post('warehouse_name', true),
				'warehouse_phone'		=> $this->input->post('warehouse_phone', true),
				'warehouse_address'		=> $this->input->post('warehouse_address', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			if($response["error_invtwarehouse"] == FALSE){
				if(!empty($data_warehouse)){					
					if ($this->AndroidMitraUtama_model->insertInvtWarehouse($data_warehouse)){

						$response['error_invtwarehouse'] 		= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_invtwarehouse'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddCoreMachine(){
			$response = array(
				'error'									=> FALSE,
				'error_coremachine'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_machine = array(
				'warehouse_id'			=> $this->input->post('warehouse_id', true),
				'machine_code'			=> $this->input->post('machine_code', true),
				'machine_name'			=> $this->input->post('machine_name', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			/* $data_machine = array(
				'warehouse_id'			=> 2,
				'machine_code'			=> 'MESIN1',
				'machine_name'			=> 'MESIN 1',
				'created_id'			=> 1,
				'created_on'			=> date("Y-m-d H:i:s"),
			); */



			if($response["error_coremachine"] == FALSE){
				if(!empty($data_machine)){					
					if ($this->AndroidMitraUtama_model->insertCoreMachine($data_machine)){

						$response['error_coremachine'] 		= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_coremachine'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function processAddAcctExpense(){
			$response = array(
				'error'									=> FALSE,
				'error_acctexpense'					=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_expense = array(
				'expense_name'			=> $this->input->post('expense_name', true),
				'created_id'			=> $this->input->post('user_id', true),
				'created_on'			=> date("Y-m-d H:i:s"),
			);

			/* $data_machine = array(
				'warehouse_id'			=> 2,
				'machine_code'			=> 'MESIN1',
				'machine_name'			=> 'MESIN 1',
				'created_id'			=> 1,
				'created_on'			=> date("Y-m-d H:i:s"),
			); */



			if($response["error_acctexpense"] == FALSE){
				if(!empty($data_expense)){					
					if ($this->AndroidMitraUtama_model->insertAcctExpense($data_expense)){

						$response['error_acctexpense'] 			= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_acctexpense'] 			= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function getSalesDeliveryNote(){
			$base_url = base_url();

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'salesdeliverynote'				=> "",
			);

			$data = array(
				'warehouse_check'		=> $this->input->post('warehouse_check',true),
				'machine_check'			=> $this->input->post('machine_check',true),
				'item_check'			=> $this->input->post('item_check',true),
				'period_date_check'		=> $this->input->post('period_date_check',true),
				'warehouse_id'			=> $this->input->post('warehouse_id',true),
				'machine_id'			=> $this->input->post('machine_id',true),				
				'item_id'				=> $this->input->post('item_id',true),				
				'start_date'			=> $this->input->post('start_date',true),
				'end_date'				=> $this->input->post('end_date',true),
			);

			$data['period_date_check'] = 0;

			if ($data['period_date_check'] == 0){
				$start_date 	= date("Y-m-01");
				$end_date 		= date("Y-m-d");
			} else {
				$start_date 	= $data['start_date'];
				$end_date 		= $data['end_date'];
			}

			/* print_r("start_date ");
			print_r($start_date);
			print_r("<BR>");

			print_r("end_date ");
			print_r($end_date);
			print_r("<BR>"); */

			if($response["error"] == FALSE){
				$salesdeliverynotelist 	= $this->AndroidMitraUtama_model->getSalesDeliveryNote($data, $start_date, $end_date);

				/* print_r("salesyearlymonthlylist ");
				print_r($salesyearlymonthlylist);
				print_r("<BR> "); */
				/* exit; */

				if(!$salesdeliverynotelist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynotelist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						if (!empty($salesdeliverynotelist)){
							foreach ($salesdeliverynotelist as $key => $val) {

								$salesdeliverynote[$key]['sales_delivery_note_id'] 		= $val['sales_delivery_note_id'];
								$salesdeliverynote[$key]['sales_delivery_note_no'] 		= $val['sales_delivery_note_no'];
								$salesdeliverynote[$key]['customer_id'] 				= $val['customer_id'];
								$salesdeliverynote[$key]['customer_name'] 				= $val['customer_name'];
								$salesdeliverynote[$key]['sales_delivery_note_date'] 	= tgltoview($val['sales_delivery_note_date']);
		
								$salesdeliverynoteitemlist = $this->AndroidMitraUtama_model->getSalesDeliveryNoteItem_Detail($val['sales_delivery_note_id'], $data['item_check'], $data['item_id']);

								$sales_delivery_note_item_list = "";

								foreach ($salesdeliverynoteitemlist as $keyItem => $valItem) {
									$salesdeliverynote[$key]['detail_item'][$keyItem]['item_name']			= $valItem['item_name'];
									$salesdeliverynote[$key]['detail_item'][$keyItem]['quantity']			= nominal($valItem['quantity']);
									$salesdeliverynote[$key]['detail_item'][$keyItem]['item_unit_name']			= $valItem['item_unit_name'];
								}
							}
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['salesdeliverynote'] 				= $salesdeliverynote;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesCustomer(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'salescustomer'			=> "",
			);

			if($response["error"] == FALSE){
				$salescustomerlist = $this->AndroidMitraUtama_model->getSalesCustomer();

				if(!$salescustomerlist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salescustomerlist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($salescustomerlist as $key => $val) {
							$salescustomer[$key]['customer_id']			= $val['customer_id'];
							$salescustomer[$key]['customer_name'] 		= $val['customer_name'];
							$salescustomer[$key]['customer_address'] 	= $val['customer_address'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['salescustomer'] 			= $salescustomer;
					}
				}
			}
			echo json_encode($response);
		}

		public function processAddSalesDeliveryNote(){
			$data = array (
				'customer_id'					=> $this->input->post('customer_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'sales_delivery_note_date'		=> tgltodb($this->input->post('sales_delivery_note_date',true)),
				'sales_delivery_note_remark'	=> $this->input->post('sales_delivery_note_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_deliverynote = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_deliverynote as $keyDeliveryNote => $valDeliveryNote){
				$data_item[$keyDeliveryNote] = array(
					'item_category_id'				=>	$valDeliveryNote['item_category_id'],
					'item_id'						=>	$valDeliveryNote['item_id'],
					'item_unit_id'					=>	$valDeliveryNote['item_unit_id'],
					'quantity'						=>	$valDeliveryNote['quantity'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					$total_item 		= $total_item + $valItem['quantity'];
				}

				$data_deliverynote = array(
					'customer_id'						=> $data['customer_id'],
					'sales_delivery_note_date'			=> $data['sales_delivery_note_date'],
					'sales_delivery_note_remark'		=> $this->input->post('sales_delivery_note_remark',true),
					'total_item'						=> $total_item,
					'data_state'						=> 0,
					'created_id' 						=> $data['user_id'],
					'created_on' 						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidMitraUtama_model->insertSalesDeliveryNote($data_deliverynote)){
					$sales_delivery_note_id = $this->AndroidMitraUtama_model->getSalesDeliveryNoteID($data_deliverynote['created_id']);

					foreach($data_item as $key => $val){
						$data_deliverynoteitem = array (
							'sales_delivery_note_id'			=> $sales_delivery_note_id,
							'item_category_id'					=> $val['item_category_id'],
							'item_id'							=> $val['item_id'],
							'item_unit_id'						=> $val['item_unit_id'],
							'quantity'							=> $val['quantity'],
							'data_state'						=> 0,
							'created_id' 						=> $data['user_id'],
							'created_on' 						=> date("Y-m-d H:i:s"),
						);
						
						$this->AndroidMitraUtama_model->insertSalesDeliveryNoteItem($data_deliverynoteitem);
					}
				}

				$response['error_deliverynote']			 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["sales_delivery_note_id"] 		= $sales_delivery_note_id;
			}
			
			echo json_encode($response);
		}

		public function getProductionResultDetail(){
			$base_url = base_url();

			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'productionresultdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$productionresultdetaillist = $this->AndroidMitraUtama_model->getProductionResultDetail($data['production_result_id']);

				if(!$productionresultdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($productionresultdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$productionresultdetail[0]['production_result_id']	= $productionresultdetaillist['production_result_id'];
						$productionresultdetail[0]['warehouse_id'] 			= $productionresultdetaillist['warehouse_id'];
						$productionresultdetail[0]['warehouse_name'] 		= $productionresultdetaillist['warehouse_name'];
						$productionresultdetail[0]['machine_id'] 			= $productionresultdetaillist['machine_id'];
						$productionresultdetail[0]['machine_name'] 			= $productionresultdetaillist['machine_name'];
						$productionresultdetail[0]['production_result_date'] = tgltoview($productionresultdetaillist['production_result_date']);
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['productionresultdetail'] = $productionresultdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getProductionResultItemDetail(){
			$base_url = base_url();

			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'productionresultitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$productionresultitemdetaillist = $this->AndroidMitraUtama_model->getProductionResultItemDetail($data['production_result_id']);

				if(!$productionresultitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($productionresultitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($productionresultitemdetaillist as $key => $val) {
							$productionresultitemdetail[$key]['production_result_item_id']	= $val['production_result_item_id'];
							$productionresultitemdetail[$key]['item_category_id'] 			= $val['item_category_id'];
							$productionresultitemdetail[$key]['item_category_name'] 		= $val['item_category_name'];
							$productionresultitemdetail[$key]['item_id'] 					= $val['item_id'];
							$productionresultitemdetail[$key]['item_name'] 					= $val['item_name'];
							$productionresultitemdetail[$key]['item_unit_id'] 				= $val['item_unit_id'];
							$productionresultitemdetail[$key]['item_unit_name'] 			= $val['item_unit_name'];
							$productionresultitemdetail[$key]['quantity'] 					= $val['quantity'];
						}
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['productionresultitemdetail'] = $productionresultitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesDeliveryNoteDetail(){
			$base_url = base_url();

			$data = array (
				'sales_delivery_note_id'			=> $this->input->post('sales_delivery_note_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'salesdeliverynotedetail'	=> "",
			);

			if($response["error"] == FALSE){
				$salesdeliverynotedetaillist = $this->AndroidMitraUtama_model->getSalesDeliveryNoteDetail($data['sales_delivery_note_id']);

				if(!$salesdeliverynotedetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynotedetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$salesdeliverynotedetail[0]['sales_delivery_note_id']		= $salesdeliverynotedetaillist['sales_delivery_note_id'];
						$salesdeliverynotedetail[0]['sales_delivery_note_no'] 		= $salesdeliverynotedetaillist['sales_delivery_note_no'];
						$salesdeliverynotedetail[0]['customer_id'] 					= $salesdeliverynotedetaillist['customer_id'];
						$salesdeliverynotedetail[0]['customer_name'] 				= $salesdeliverynotedetaillist['customer_name'];
						$salesdeliverynotedetail[0]['sales_delivery_note_date'] 	= tgltoview($salesdeliverynotedetaillist['sales_delivery_note_date']);
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['salesdeliverynotedetail'] 	= $salesdeliverynotedetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getSalesDeliveryNoteItemDetail(){
			$base_url = base_url();

			$data = array (
				'sales_delivery_note_id'			=> $this->input->post('sales_delivery_note_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'salesdeliverynoteitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$salesdeliverynoteitemdetaillist = $this->AndroidMitraUtama_model->getSalesDeliveryNoteItemDetail($data['sales_delivery_note_id']);

				if(!$salesdeliverynoteitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($salesdeliverynoteitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($salesdeliverynoteitemdetaillist as $key => $val) {
							$salesdeliverynoteitemdetail[$key]['sales_delivery_note_item_id']	= $val['sales_delivery_note_item_id'];
							$salesdeliverynoteitemdetail[$key]['item_category_id'] 				= $val['item_category_id'];
							$salesdeliverynoteitemdetail[$key]['item_category_name'] 			= $val['item_category_name'];
							$salesdeliverynoteitemdetail[$key]['item_id'] 						= $val['item_id'];
							$salesdeliverynoteitemdetail[$key]['item_name'] 					= $val['item_name'];
							$salesdeliverynoteitemdetail[$key]['item_unit_id'] 					= $val['item_unit_id'];
							$salesdeliverynoteitemdetail[$key]['item_unit_name'] 				= $val['item_unit_name'];
							$salesdeliverynoteitemdetail[$key]['quantity'] 						= $val['quantity'];
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['salesdeliverynoteitemdetail'] 	= $salesdeliverynoteitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getAcctDisbursementDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'						=> FALSE,
				'error_msg'					=> "",
				'error_msg_title'			=> "",
				'acctdisbursementdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementdetaillist = $this->AndroidMitraUtama_model->getAcctDisbursementDetail($data['disbursement_id']);

				if(!$acctdisbursementdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$acctdisbursementdetail[0]['disbursement_id']		= $acctdisbursementdetaillist['disbursement_id'];
						$acctdisbursementdetail[0]['expense_id'] 			= $acctdisbursementdetaillist['expense_id'];
						$acctdisbursementdetail[0]['expense_name'] 			= $acctdisbursementdetaillist['expense_name'];
						$acctdisbursementdetail[0]['disbursement_date'] 	= tgltoview($acctdisbursementdetaillist['disbursement_date']);
						$acctdisbursementdetail[0]['disbursement_title'] 	= $acctdisbursementdetaillist['disbursement_title'];
						
						$response['error'] 						= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
						$response['acctdisbursementdetail'] 	= $acctdisbursementdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function getAcctDisbursementItemDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'acctdisbursementitemdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementitemdetaillist = $this->AndroidMitraUtama_model->getAcctDisbursementItemDetail($data['disbursement_id']);

				if(!$acctdisbursementitemdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementitemdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($acctdisbursementitemdetaillist as $key => $val) {
							$acctdisbursementitemdetail[$key]['disbursement_item_id']					= $val['disbursement_item_id'];
							$acctdisbursementitemdetail[$key]['disbursement_item_title'] 	= $val['disbursement_item_title'];
							$acctdisbursementitemdetail[$key]['disbursement_item_amount'] 	= number_format($val['disbursement_item_amount'], 2);
						}
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['acctdisbursementitemdetail'] 	= $acctdisbursementitemdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function processVoidSalesDeliveryNote(){
			$data = array (
				'user_id'					=> $this->input->post('user_id',true),
				'sales_delivery_note_id'	=> $this->input->post('sales_delivery_note_id',true),
				'voided_remark'				=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deletesalesdeliverynote = array(
					'sales_delivery_note_id'	=> $data['sales_delivery_note_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidMitraUtama_model->voidSalesDeliveryNote($data_deletesalesdeliverynote)){
					
				}

				$response['error_deletesalesdeliverynote']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}	

		public function processVoidProductionResult(){
			$data = array (
				'user_id'					=> $this->input->post('user_id',true),
				'production_result_id'		=> $this->input->post('production_result_id',true),
				'voided_remark'				=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deleteproductionresult = array(
					'production_result_id'		=> $data['production_result_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidMitraUtama_model->voidProductionResult($data_deleteproductionresult)){
					
				}

				$response['error_deleteproductionresult']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}

		public function processVoidAcctDisbursement(){
			$data = array (
				'user_id'			=> $this->input->post('user_id',true),
				'disbursement_id'	=> $this->input->post('disbursement_id',true),
				'voided_remark'		=> $this->input->post('voided_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			if($response["error"] == FALSE){
				$data_deleteacctdisbursement = array(
					'disbursement_id'			=> $data['disbursement_id'],
					'data_state'				=> 2,
					'voided_id'					=> $data['user_id'],
					'voided_on'					=> date("Y-m-d H:i:s"),
					'voided_remark'				=> $data['voided_remark'],
				);
			
				if ($this->AndroidMitraUtama_model->voidAcctDisbursement($data_deleteacctdisbursement)){
					
				}

				$response['error_deleteacctdisbursement']	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
			}
			
			echo json_encode($response);
		}


		public function processEditSalesDeliveryNote(){
			$data = array (
				'sales_delivery_note_id'		=> $this->input->post('sales_delivery_note_id',true),
				'customer_id'					=> $this->input->post('customer_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'sales_delivery_note_date'		=> tgltodb($this->input->post('sales_delivery_note_date',true)),
				'sales_delivery_note_remark'	=> $this->input->post('sales_delivery_note_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_deliverynote = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_deliverynote as $keyDeliveryNote => $valDeliveryNote){
				$data_item[$keyDeliveryNote] = array(
					'sales_delivery_note_item_id'	=>	$valDeliveryNote['record_id'],
					'item_category_id'				=>	$valDeliveryNote['item_category_id'],
					'item_id'						=>	$valDeliveryNote['item_id'],
					'item_unit_id'					=>	$valDeliveryNote['item_unit_id'],
					'quantity'						=>	$valDeliveryNote['quantity'],
					'item_status'					=>	$valDeliveryNote['data_state'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					if ($valItem['item_status'] != 2){
						$total_item 		= $total_item + $valItem['quantity'];
					}
				}

				$data_deliverynote = array(
					'sales_delivery_note_id'			=> $data['sales_delivery_note_id'],
					'customer_id'						=> $data['customer_id'],
					'sales_delivery_note_date'			=> $data['sales_delivery_note_date'],
					'sales_delivery_note_remark'		=> $this->input->post('sales_delivery_note_remark',true),
					'total_item'						=> $total_item,
					'created_on'						=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidMitraUtama_model->updateSalesDeliveryNote($data_deliverynote)){

					foreach($data_item as $key => $val){
						$data_salesdeliverynoteitem = array(
							'sales_delivery_note_id'	=> $data['sales_delivery_note_id'],
							'item_category_id'			=> $val['item_category_id'],
							'item_id'					=> $val['item_id'],
							'quantity'					=> $val['quantity'],
							'item_unit_id'				=> $val['item_unit_id'],
							'created_id'				=> $data['user_id'],
							'created_on'				=> date("Y-m-d H:i:s"),
							'item_status'				=> $val['item_status'],
						);

						if ($val['item_status'] == 1){
							if ($this->AndroidMitraUtama_model->insertSalesDeliveryNoteItem($data_salesdeliverynoteitem)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_salesdeliverynoteitem['sales_delivery_note_id'], '5111', 'SalesDeliveryNote.processAddSalesDeliveryNoteItem', 'Add New Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}

						} else if ($val['item_status'] == 2){
							$data_delete = array (
								'sales_delivery_note_item_id'	=> $val['sales_delivery_note_item_id'],
								'item_category_id'				=> $val['item_category_id'],
								'item_id'						=> $val['item_id'],
								'quantity'						=> $val['quantity'],
								'item_status'					=> $val['item_status'],
								'data_state'					=> 2,
								'voided_id'						=> $data['user_id'],
								'voided_on'						=> date("Y-m-d H:i:s"),
							);

							if ($this->AndroidMitraUtama_model->voidSalesDeliveryNoteItem($data_delete)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_delete['sales_delivery_note_item_id'], '5112', 'SalesDeliveryNoteItem.processVoidSalesDeliveryNoteItem', 'Void Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}
						} 
					}
				}

				$response['error_deliverynote']			 	= FALSE;
				$response['error_msg_title'] 				= "Success";
				$response['error_msg'] 						= "Data Saved";
				$response["sales_delivery_note_id"] 		= $data['sales_delivery_note_id'];
			}
			
			echo json_encode($response);
		}


		public function processEditProductionResult(){
			$data = array (
				'production_result_id'			=> $this->input->post('production_result_id',true),
				'warehouse_id'					=> $this->input->post('warehouse_id',true),
				'machine_id'					=> $this->input->post('machine_id',true),
				'user_id'						=> $this->input->post('user_id',true),
				'production_result_date'		=> tgltodb($this->input->post('production_result_date',true)),
				'production_result_remark'		=> $this->input->post('production_result_remark',true),
			);

			$response = array(
				'error'					=> FALSE,
				'error_msg_title'		=> "",
				'error_msg'				=> "",
			);
			
			$data_item = array();
			$raw_productionresult = json_decode($this->input->post('data_item',true),true);			
			foreach($raw_productionresult as $keyProductionResult => $valProductionResult){
				$data_item[$keyProductionResult] = array(
					'production_result_item_id'		=>	$valProductionResult['record_id'],
					'item_category_id'				=>	$valProductionResult['item_category_id'],
					'item_id'						=>	$valProductionResult['item_id'],
					'item_unit_id'					=>	$valProductionResult['item_unit_id'],
					'quantity'						=>	$valProductionResult['quantity'],
					'item_status'					=>	$valProductionResult['data_state'],
				);
			}
			
			if($response["error"] == FALSE){
				$total_item 	= 0;

				foreach ($data_item as $keyItem => $valItem) {
					if ($valItem['item_status'] != 2){
						$total_item 		= $total_item + $valItem['quantity'];
					}
				}

				$data_productionresult = array(
					'production_result_id'			=> $data['production_result_id'],
					'warehouse_id'					=> $data['warehouse_id'],
					'machine_id'					=> $data['machine_id'],
					'production_result_date'		=> $data['production_result_date'],
					'production_result_remark'		=> $this->input->post('production_result_remark',true),
					'total_item'					=> $total_item,
					'created_on'					=> date("Y-m-d H:i:s"),
				);
			
				if ($this->AndroidMitraUtama_model->updateProductionResult($data_productionresult)){

					foreach($data_item as $key => $val){
						$data_productionresultitem = array(
							'production_result_id'		=> $data['production_result_id'],
							'item_category_id'			=> $val['item_category_id'],
							'item_id'					=> $val['item_id'],
							'quantity'					=> $val['quantity'],
							'item_unit_id'				=> $val['item_unit_id'],
							'created_id'				=> $data['user_id'],
							'created_on'				=> date("Y-m-d H:i:s"),
							'item_status'				=> $val['item_status'],
						);

						if ($val['item_status'] == 1){
							if ($this->AndroidMitraUtama_model->insertProductionResultItem($data_productionresultitem)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_salesdeliverynoteitem['sales_delivery_note_id'], '5111', 'SalesDeliveryNote.processAddSalesDeliveryNoteItem', 'Add New Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}

						} else if ($val['item_status'] == 2){
							$data_delete = array (
								'production_result_item_id'		=> $val['production_result_item_id'],
								'item_category_id'				=> $val['item_category_id'],
								'item_id'						=> $val['item_id'],
								'quantity'						=> $val['quantity'],
								'item_status'					=> $val['item_status'],
								'data_state'					=> 2,
								'voided_id'						=> $data['user_id'],
								'voided_on'						=> date("Y-m-d H:i:s"),
							);

							if ($this->AndroidMitraUtama_model->voidProductionResultItem($data_delete)){
								$status = 1;

								/* $this->fungsi->set_log($auth['user_id'], $data_delete['sales_delivery_note_item_id'], '5112', 'SalesDeliveryNoteItem.processVoidSalesDeliveryNoteItem', 'Void Sales Delivery Note Item'); */
							} else {
								$status = 0;
								
							}
						} 
					}
				}

				$response['error_productionresult']	 	= FALSE;
				$response['error_msg_title'] 			= "Success";
				$response['error_msg'] 					= "Data Saved";
				$response["production_result_id"] 		= $data['production_result_id'];
			}
			
			echo json_encode($response);
		}

		public function getUpdateAcctDisbursementDetail(){
			$base_url = base_url();

			$data = array (
				'disbursement_id'			=> $this->input->post('disbursement_id',true),
			);

			$response = array(
				'error'							=> FALSE,
				'error_msg'						=> "",
				'error_msg_title'				=> "",
				'updateacctdisbursementdetail'	=> "",
			);

			if($response["error"] == FALSE){
				$acctdisbursementdetaillist = $this->AndroidMitraUtama_model->getUpdateAcctDisbursementDetail($data['disbursement_id']);

				if(!$acctdisbursementdetaillist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($acctdisbursementdetaillist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						$updateacctdisbursementdetail[0]['disbursement_id']				= $acctdisbursementdetaillist['disbursement_id'];
						$updateacctdisbursementdetail[0]['expense_id'] 					= $acctdisbursementdetaillist['expense_id'];
						$updateacctdisbursementdetail[0]['expense_name'] 				= $acctdisbursementdetaillist['expense_name'];
						$updateacctdisbursementdetail[0]['disbursement_date'] 			= tgltoview($acctdisbursementdetaillist['disbursement_date']);
						$updateacctdisbursementdetail[0]['disbursement_title'] 			= $acctdisbursementdetaillist['disbursement_title'];
						$updateacctdisbursementdetail[0]['disbursement_item_title'] 	= $acctdisbursementdetaillist['disbursement_item_title'];
						$updateacctdisbursementdetail[0]['disbursement_item_amount'] 	= $acctdisbursementdetaillist['disbursement_item_amount'];
						
						$response['error'] 							= FALSE;
						$response['error_msg_title'] 				= "Success";
						$response['error_msg'] 						= "Data Exist";
						$response['updateacctdisbursementdetail'] 	= $updateacctdisbursementdetail;
					}
				}
			}
			echo json_encode($response);
		}

		public function processEditAcctDisbursement(){
			$response = array(
				'error'									=> FALSE,
				'error_acctdisbursement'				=> FALSE,
				'error_msg_title'						=> "",
				'error_msg'								=> "",
			);

			$data_acctdisbursement = array(
				'disbursement_id'				=> $this->input->post('disbursement_id', true),
				'expense_id'					=> $this->input->post('expense_id', true),
				'disbursement_date'				=> tgltodb($this->input->post('disbursement_date', true)),
				'disbursement_title'			=> $this->input->post('disbursement_item_title', true),
				'disbursement_amount_total'		=> $this->input->post('disbursement_item_amount', true),
			);

			$data_acctdisbursementitem = array(
				'disbursement_id'				=> $data_acctdisbursement['disbursement_id'],
				'disbursement_item_title'		=> $this->input->post('disbursement_item_title', true),
				'disbursement_item_amount'		=> $this->input->post('disbursement_item_amount', true),
			);

			/* $data_disbursement_item = array(
				'disbursement_item_title'		=> 'text',
				'disbursement_item_amount'		=> 100000,
			); */

			if($response["error_acctdisbursement"] == FALSE){
				if(!empty($data_acctdisbursement)){					
					if ($this->AndroidMitraUtama_model->updateAcctDisbursement($data_acctdisbursement)){
						$data_item = array(
							'disbursement_id'				=> $data_acctdisbursement['disbursement_id'],
							'disbursement_item_title'		=> $data_acctdisbursementitem['disbursement_item_title'],
							'disbursement_item_amount'		=> $data_acctdisbursementitem['disbursement_item_amount'],
						);

						if($this->AndroidMitraUtama_model->updateAcctDisbursementItem($data_item)){
							
						}

						$response['error_acctdisbursement'] 	= FALSE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					} else {
						$response['error_acctdisbursement'] 	= TRUE;
						$response['error_msg_title'] 			= "Success";
						$response['error_msg'] 					= "Data Exist";
					}
				}
			} 
			
			echo json_encode($response);
		}

		public function getInvtItemStock(){
			$base_url = base_url();

			$response = array(
				'error'					=> FALSE,
				'error_msg'				=> "",
				'error_msg_title'		=> "",
				'invtitemstock'			=> "",
			);

			$data = array(
				'item_category_id'				=> $this->input->post('item_category_id', true),
			);

			/* $data = array(
				'item_category_id'				=> 2,
			); */

			if($response["error"] == FALSE){
				$invtitemstocklist = $this->AndroidMitraUtama_model->getInvtItemStock($data['item_category_id']);

				/* print_r("invtitemstocklist ");
				print_r($invtitemstocklist);
				exit; */

				if(!$invtitemstocklist){
					$response['error'] 				= TRUE;
					$response['error_msg_title'] 	= "No Data";
					$response['error_msg'] 			= "Error Query Data";
				}else{
					if (empty($invtitemstocklist)){
						$response['error'] 				= TRUE;
						$response['error_msg_title'] 	= "No Data";
						$response['error_msg'] 			= "Data Does Not Exist";
					} else {
						foreach ($invtitemstocklist as $key => $val) {
							$invtitemstock[$key]['item_category_id']	= $val['item_category_id'];
							$invtitemstock[$key]['item_category_name'] 	= $val['item_category_name'];
							$invtitemstock[$key]['item_id']				= $val['item_id'];
							$invtitemstock[$key]['item_name'] 			= $val['item_name'];
							$invtitemstock[$key]['item_unit_id']		= $val['item_unit_id'];
							$invtitemstock[$key]['item_unit_code']		= $val['item_unit_code'];
							$invtitemstock[$key]['last_balance']		= $val['last_balance'];
						}
						
						$response['error'] 					= FALSE;
						$response['error_msg_title'] 		= "Success";
						$response['error_msg'] 				= "Data Exist";
						$response['invtitemstock'] 			= $invtitemstock;
					}
				}
			}
			echo json_encode($response);
		}

	}
?>