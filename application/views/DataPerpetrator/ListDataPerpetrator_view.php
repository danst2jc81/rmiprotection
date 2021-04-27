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
		document.location = base_url+"perpetrator/reset-search";
	}

	$(document).ready(function(){
        $("#province_perpetrator_id").change(function(){
            var province_id 			= $("#province_perpetrator_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>perpetrator/get-city",
               data : {province_id: province_id},
               success: function(data){
                   $("#city_perpetrator_id").html(data);
               }
            });
        });
    });
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
			<a href="<?php echo base_url();?>perpetrator">
				Daftar Pelaku
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Daftar Pelaku
</h3>
<?php 
	echo form_open('perpetrator/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-DataPerpetrator');

	if(!is_array($data)){
		$data['vendor_id']					= '';
		$data['province_perpetrator_id']	= '';
		$data['city_perpetrator_id']		= '';
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
						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('vendor_id', $corevendor ,set_value('vendor_id',$data['vendor_id']),'id="vendor_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Vendor
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('province_perpetrator_id', $coreprovinceperpetrator, set_value('province_perpetrator_id',$data['province_perpetrator_id']),'id="province_perpetrator_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Propinsi
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-4">
							<div class="form-group">
								<div class="form-group form-md-line-input">
									<?php 
										if ($data['section_id'] != ''){
											$corecity = create_double($this->DataPerpetrator_model->getCoreCity($data['province_perpetrator_id']), 'city_id', 'city_name');

											echo form_dropdown('city_perpetrator_id', $corecity, set_value('city_perpetrator_id', $data['city_perpetrator_id']),'id="city_perpetrator_id" class="form-control select2me"');
										} else {
									?>
										<select name="city_perpetrator_id" id="city_perpetrator_id" class="form-control select2me">
											<option value="">--Choose One--</option>
										</select>
									<?php 
										}
									?>

									<label class="control-label">Kota</label>
								</div>
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
					<a href="<?php echo base_url();?>perpetrator/add" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							Pelaku Baru
						</span>
					</a>
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
								<th width="10%">Nama Vendor</th>
								<th width="15%">Nama Pelaku</th>
								<th width="15%">Alamat Pelaku</th>
								<th width="10%">Telepon Pelaku</th>
								<th width="10%">Tanggal Lahir</th>
								<th width="10%">No KTP</th>
								<th width="10%">Status</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($dataperpetrator)){
									echo "<tr><th colspan='9'>Data Masih Kosong</th></tr>";
								} else {
									foreach($dataperpetrator as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".$val['vendor_name']."</td>	
												<td>".$val['perpetrator_name']."</td>
												<td>".$val['perpetrator_address']."</td>
												<td>".$val['perpetrator_mobile_phone']."</td>	
												<td>".tgltoview($val['perpetrator_date_of_birth'])."</td>	
												<td>".$val['perpetrator_id_number']."</td>	
												<td>".$perpetratorstatus[$val['perpetrator_status']]."</td>
												<td>
													<a href='".$this->config->item('base_url').'perpetrator/edit/'.$val['perpetrator_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'perpetrator/delete/'.$val['perpetrator_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
													<a href='".$this->config->item('base_url').'perpetrator/chronology/'.$val['perpetrator_id']."' class='btn default btn-xs blue'>
														<i class='fa fa-plus'></i> Kronologi
													</a>
													<a href='".$this->config->item('base_url').'perpetrator/photo/'.$val['perpetrator_id']."' class='btn default btn-xs grey-gallery'>
														<i class='fa fa-photo'></i> Edit
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
		