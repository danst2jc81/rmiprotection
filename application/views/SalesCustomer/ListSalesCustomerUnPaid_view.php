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
		<li>
			<a href="<?php echo base_url();?>customer/customer-unpaid">
				Daftar Customer Belum Bayar
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Daftar Customer Belum Bayar
</h3>

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
								<th width="25%">Nama Customer</th>
								<th width="15%">Email Customer</th>
								<th width="20%">Telepon Customer</th>
								<th width="10%">Tgl Daftar Customer</th>
								<th width="10%">Status Customer</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($salescustomerunpaid)){
									echo "<tr><th colspan='9'>Data Masih Kosong</th></tr>";
								} else {
									foreach($salescustomerunpaid as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['customer_name']."</td>
												<td>".$val['customer_email']."</td>
												<td>".$val['customer_mobile_phone']."</td>	
												<td>".tgltoview($val['customer_registration_date'])."</td>
												<td>".$customerstatus[$val['customer_status']]."</td>
												<td>
													<a href='".$this->config->item('base_url').'customer/collection/'.$val['customer_id']."' class='btn default btn-xs green-jungle'>
														<i class='fa fa-money'></i> Bayar
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
		