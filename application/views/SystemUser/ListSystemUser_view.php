
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

<script>
	base_url = '<?php echo base_url();?>';

	function reset_search(){
		document.location = base_url+"user/reset-search";
	}

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id = $("#region_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>user/get-branch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);				   
               }
            }); 
        });
    });

	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>user/get-vendor",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#vendor_id").html(data);				   
               }
            }); 
        });
    });

</script>
	
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class = "page-bar">
		<ul class="page-breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">
					Home
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>user">
					User
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h3 class="page-title">
	System User 
	</h3>
	<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo form_open('user/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-SystemUser');

	if(!is_array($data)){
		$data['region_id']			= '';
		$data['branch_id']			= '';
		$data['vendor_id']			= '';
		$data['user_group_id']		= '';
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
									echo form_dropdown('region_id', $coreregion ,set_value('region_id',$data['region_id']),'id="region_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Korwil
									<span class="required">
										*
									</span>
								</label>
							</div>	
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									if ($data['region_id'] != ''){
										$corebranch = create_double($this->SystemUser_model->getCoreBranch($data['region_id']), 'branch_id', 'branch_name');

										echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me"');
									} else {
								?>
									<select name="branch_id" id="branch_id" class="form-control select2me">
										<option value="">--Choose One--</option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Cabang</label>
							</div>
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									if ($data['branch_id'] != ''){
										$vendor_id = create_double($this->SystemUser_model->getCoreVendor($data['branch_id']), 'vendor_id', 'vendor_name');

										echo form_dropdown('vendor_id', $vendor_id, set_value('vendor_id', $data['vendor_id']), 'id="vendor_id" class="form-control select2me"');
									} else {
								?>
									<select name="vendor_id" id="vendor_id" class="form-control select2me">
										<option value="">--Choose One--</option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Vendor</label>
							</div>
						</div>
					</div>

					<div class="row">			
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									echo form_dropdown('user_group_id', $systemusergroup ,set_value('user_group_id',$data['user_group_id']),'id="user_group_id", class="form-control select2me" ');
								?>
								<label class="control-label">Nama Group User
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
				<div class="actions">
					<a href="<?php echo base_url();?>user/add" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							User Baru
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
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
						<thead>
							<tr>
								<th width="0%"></th>
								<th width="5%">No.</th>
								<th width="15%">Username</th>
								<th width="15%">Group</th>
								<th width="15%">Nama Korwil</th>
								<th width="15%">Nama Cabang</th>
								<th width="15%">Nama Vendor</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($systemuser)){
									echo "<tr><th colspan='8'>Data Masih Kosong</th></tr>";
								} else {
									foreach ($systemuser as $key => $val){
										echo"
											<tr>
												<td style='text-align:center'></td>			
												<td style='text-align:center'>".$no."</td>
												<td>".$val['username']."</td>
												<td>".$val['user_group_name']."</td>
												<td>".$val['region_name']."</td>
												<td>".$val['branch_name']."</td>
												<td>".$val['vendor_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'user/edit/'.$val['user_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'user/delete/'.$val['user_id']."'class='btn default btn-xs red', onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'>
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
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
