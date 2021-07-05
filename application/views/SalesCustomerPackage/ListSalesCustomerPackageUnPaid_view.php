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
		document.location = base_url+"customer-package/reset-search";
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
			<a href="<?php echo base_url();?>customer-package">
				Daftar Customer
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>customer-package/customer-package-unpaid">
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
								<th width="15%">Telepon Customer</th>
								<th width="10%">Nama Paket</th>
								<th width="10%">Paket Harga</th>
								<th width="10%">Total Bulan</th>
								<th width="10%">Total Harga</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($salescustomerpackageunpaid)){
									echo "<tr><th colspan='9'>Data Masih Kosong</th></tr>";
								} else {
									foreach($salescustomerpackageunpaid as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['customer_name']."</td>
												<td>".$val['customer_mobile_phone']."</td>	
												<td>".$val['package_name']."</td>	
												<td>".$val['package_price_name']."</td>	
												<td>".$val['package_price_month']."</td>	
												<td>".nominal($val['package_price_amount'])."</td>	
												<td>
													<a href='".$this->config->item('base_url').'customer-package/collection/'.$val['customer_package_id']."' class='btn default btn-xs green-jungle'>
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
		