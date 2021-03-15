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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	
	label {
		display: inline !important;
		width:50% !important;
		margin:0 !important;
		padding:0 !important;
		vertical-align:middle !important;
	}
</style>
<!-- END PAGE TITLE & BREADCRUMB-->
<script>
	base_url = '<?php echo base_url();?>';

</script>
<?php
	$data = $this->session->userdata('filter-CoreHeadquarters');
?>

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
			<a href="<?php echo base_url();?>headquarters">
				Daftar Pusat
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Daftar Pusat
</h3>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>headquarters/add" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							Pusat Baru
						</span>
					</a>
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="0%"></th>
								<th width="5%">No.</th>
								<th width="20%">Nama Pusat</th>
								<th width="20%">Alamat Pusat</th>
								<th width="20%">Kontak</th>
								<th width="20%">Telepon</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($coreheadquarters)){
									echo "<tr><th colspan='6'>Data Masih Kosong</th></tr>";
								} else {
									foreach($coreheadquarters as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['headquarters_name']."</td>		
												<td>".$val['headquarters_address']."</td>				
												<td>".$val['headquarters_contact_person']."</td>
												<td>".$val['headquarters_phone']."</td>
												<td>
													<a href='".$this->config->item('base_url').'headquarters/edit/'.$val['headquarters_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'headquarters/delete/'.$val['headquarters_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
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
		