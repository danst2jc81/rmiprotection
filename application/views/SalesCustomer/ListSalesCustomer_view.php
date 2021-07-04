<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>

<!-- END PAGE TITLE & BREADCRUMB-->
<script>
	base_url = '<?php echo base_url();?>';


	function reset_search(){
		document.location = base_url+"customer/reset-search";
	}

</script>


<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				Home
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>customer">
				Daftar Customer
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Daftar Customer
</h3>
<?php 
	echo form_open('customer/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-SalesCustomer');

	if(!is_array($data)){
		$data['start_date']				= date("Y-m-d");
		$data['end_date']				= date("Y-m-d");
		$data['customer_status']		= 9;
		$data['package_id']				= 0;
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
					
					
					<div class="row">			
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date"  value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">End Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>


					<div class="row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('package_id', $corepackage ,set_value('package_id', $data['package_id']), 'id="package_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Paket
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('customer_status', $customerstatus, set_value('customer_status',$data['customer_status']),'id="customer_status", class="form-control select2me" ');
								?>
								<label class="control-label">Status Customer
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>
					</div>
						
					<div class="form-group">
						<div class="form-action" style="text-align  : right !important;">
							<button type="button" class="btn red" onClick="reset_search();"><i class="fa fa-times"></i> Ulang</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>


<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="0%"></th>
								<th width="5%">No.</th>
								<th width="10%">Nama Paket</th>
								<th width="20%">Nama Customer</th>
								<th width="15%">Email Customer</th>
								<th width="15%">Telepon Customer</th>
								<th width="10%">Tgl Daftar Customer</th>
								<th width="10%">Status Customer</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($salescustomer)){
									echo "<tr><th colspan='9'>Data Masih Kosong</th></tr>";
								} else {
									foreach($salescustomer as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['package_name']."</td>
												<td>".$val['customer_name']."</td>
												<td>".$val['customer_email']."</td>
												<td>".$val['customer_mobile_phone']."</td>	
												<td>".tgltoview($val['customer_registration_date'])."</td>
												<td>".$customerstatus[$val['customer_status']]."</td>
												<td>
													<a href='".$this->config->item('base_url').'customer/detail/'.$val['customer_id']."' class='btn default btn-xs grey-gallery'>
														<i class='fa fa-list'></i> Detail
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
		