<script>
	base_url = '<?php echo base_url();?>';

	function reset_add(){
		document.location = base_url+"user/reset-add";
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

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('user/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>

<div class="workplace" style="padding:5px !important;"> 

	
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
	<div class = page-bar>
		<ul class="page-breadcrumb">
			<li>
				<i class="fa fa-home"></i>
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
			<li>
				<a href="<?php echo base_url();?>user/edit/<?php echo $systemuser['user_id'];?>">
					Edit User
				</a>
			</li>
		</ul>
	</div>
	<h3 class="page-title">
	Form Edit User
	</h3>
			<!-- END PAGE TITLE & BREADCRUMB-->
	
			
				
	<div class="row">	
		<div class="col-md-12">
		   <div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>user" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i>
							<span class="hidden-480">
								Kembali
							</span>
						</a>
					</div>
				</div>
					<div class="portlet-body form">
						<div class="form-body">
							<?php 
								echo form_open('user/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); 

								$auth = $this->session->userdata('auth');
								if($this->uri->segment(3)=='Administrator'){
									$group['1'] = $auth['username'];
								}
							
								echo $this->session->userdata('message');
								$this->session->unset_userdata('message');
							?>

							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('user_group_id', $systemusergroup, set_value('user_group_id',$systemuser['user_group_id']), 'id="user_group_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Group User
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>

								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('user_level', $userlevel, set_value('user_level',$systemuser['user_level']), 'id="user_level", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Level User
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>
							</div>

							<div class="row">			
								<div class = "col-md-4">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('region_id', $coreregion ,set_value('region_id',$systemuser['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
											if ($systemuser['region_id'] != ''){
												$corebranch = create_double($this->SystemUser_model->getCoreBranch($systemuser['region_id']), 'branch_id', 'branch_name');

												echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $systemuser['branch_id']), 'id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
											} else {
										?>
											<select name="branch_id" id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
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
											if ($systemuser['branch_id'] != ''){
												$vendor_id = create_double($this->SystemUser_model->getCoreVendor($systemuser['branch_id']), 'vendor_id', 'vendor_name');

												echo form_dropdown('vendor_id', $vendor_id, set_value('vendor_id', $systemuser['vendor_id']), 'id="vendor_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
											} else {
										?>
											<select name="vendor_id" id="vendor_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
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
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username',$systemuser['username']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<label class="control-label">Username<span class="required">*</span></label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password',$systemuser['password']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', $systemuser['user_id']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
										<label class="control-label">Nama Vendor<span class="required">*</span></label>
									</div>
								</div>
							</div>

							
							<div class="row">
								<div class="col-md-12" style="text-align:right !important">
									<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>	
							</div>		
							
						</div>
					</div>
			</div>
		</div>
	</div>
	
	
	<?php echo form_close(); ?>
</div>