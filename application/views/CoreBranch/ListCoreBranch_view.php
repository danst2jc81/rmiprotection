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

	function reset_search(){
		document.location = base_url+"CoreBranch/reset_search";
	}

	$(document).ready(function(){
        $("#province_id").change(function(){
            var province_id = $("#province_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>branch/get-city",
               data : {province_id: province_id},
               success: function(data){
                   $("#city_id").html(data);				   
               }
            }); 
        });
    });

</script>
<?php
	$data = $this->session->userdata('filter-CoreBranch');

	if(!is_array($data)){
		$data['region_id']		='';
		$data['province_id']	='';
		$data['city_id']	='';
	}
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
			<a href="<?php echo base_url();?>branch">
				Daftar Cabang
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Daftar Cabang
</h3>

<?php 
	echo form_open('branch/filter',array('id' => 'myform', 'class' => '')); 
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
						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('region_id', $coreregion ,set_value('region_id',$data['region_id']),'id="region_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Cabang
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('province_id', $coreprovince ,set_value('province_id',$data['province_id']),'id="province_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Propinsi
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									if ($data['province_id'] != ''){
										$corecity = create_double($this->CoreBranch_model->getCoreCity($data['province_id']), 'city_id', 'city_name');

										echo form_dropdown('city_id', $corecity, set_value('city_id', $data['city_id']), 'id="city_id" class="form-control select2me"');
									} else {
								?>
									<select name="city_id" id="city_id" class="form-control select2me">
										<option value="">--Choose One--</option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Kota</label>
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
				<div class="actions">
					<a href="<?php echo base_url();?>branch/add" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							Cabang Baru
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
								<th width="15%">Nama Korwil</th>
								<th width="10%">Provinsi</th>
								<th width="10%">Kota</th>
								<th width="10%">Kode Cabang</th>
								<th width="15%">Nama Cabang</th>
								<th width="10%">Kontak</th>
								<th width="10%">Telepon</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($corebranch)){
									echo "<tr><th colspan='6'>Data Masih Kosong</th></tr>";
								} else {
									foreach($corebranch as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['region_name']."</td>	
												<td>".$val['province_name']."</td>
												<td>".$val['city_name']."</td>
												<td>".$val['branch_code']."</td>	
												<td>".$val['branch_name']."</td>					
												<td>".$val['branch_contact_person']."</td>
												<td>".$val['branch_phone']."</td>
												<td>
													<a href='".$this->config->item('base_url').'branch/edit/'.$val['branch_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'branch/delete/'.$val['branch_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
		