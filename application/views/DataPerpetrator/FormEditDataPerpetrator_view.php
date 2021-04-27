
<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreCellGroup/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreCellGroup/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}	

</script>


<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li class="btn-group">
			
		</li>
		<li>
			<a href="<?php echo base_url();?>">
				Home
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>congregation">
				Daftar Jemaat
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>congregation/edit/<?php echo $churchcongregation['congregation_id'] ?>">
				Edit Jemaat 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Jemaat 
</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet"> 
			   	<div class="portlet box red">
					<div class="portlet-title">
						<div class="caption">
							Form Edit
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>congregation" class="btn btn-default btn-sm">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									Kembali
								</span>
							</a>
						</div>
					</div>
					<div class="portlet-body ">
						<div class="form-body">
							<?php
								echo $this->session->userdata('message');
								$this->session->unset_userdata('message');

								echo form_open('congregation/process-edit',array('id' => 'myform', 'class' => 'horizontal-form'));
								$unique 				= $this->session->userdata('unique');
								$congregation_token 	= $this->session->userdata('ChurchCongregationToken-'.$unique['unique']);
							?>

							<div class="row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('cell_group_id', $corecellgroup ,set_value('cell_group_id',$churchcongregation['cell_group_id']),'id="cell_group_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Komsel
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>

								<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="congregation_registration_date" id="congregation_registration_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($churchcongregation['congregation_registration_date']);?>" autocomplete="off"/>
									<label class="control-label">Tanggal Daftar</label>
									
								</div>
							</div>
							</div>

							<div class = "row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="congregation_name" id="congregation_name" value="<?php echo set_value('congregation_name',$churchcongregation['congregation_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<input type="hidden" class="form-control" name="congregation_token" id="congregation_token" value="<?php echo set_value('congregation_token',$congregation_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<input type="hidden" class="form-control" name="congregation_id" id="congregation_id" value="<?php echo set_value('congregation_id',$churchcongregation['congregation_id']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
										<label class="control-label">Nama Jemaat<span class="required">*</span></label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="congregation_date_of_birth" id="congregation_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($churchcongregation['congregation_date_of_birth']);?>" autocomplete="off"/>
										<label class="control-label">Tanggal Lahir</label>
										
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">	
									<div class="form-group form-md-line-input">
										<textarea rows="3" name="congregation_address" id="congregation_address" onChange="function_elements_add(this.name, this.value);" class="form-control" ><?php echo $churchcongregation['congregation_address'];?></textarea>
										<label class="control-label">Alamat Jemaat<span class="required">*</span></label>
									</div>
								</div>
							</div>

							<div class = "row">
								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="congregation_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('congregation_phone',$churchcongregation['congregation_phone']);?>" autocomplete="off"/>
										<label class="control-label">Telepon Jemaat</label>
									</div>
								</div>

								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="congregation_email" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('congregation_email',$churchcongregation['congregation_email']);?>" autocomplete="off"/>
										<label class="control-label">Email Jemaat</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="form-actions" style="text-align  : right !important;">
									<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_all()"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save" data-toggle='modal'><i class="fa fa-check"></i> Save</button>	
								</div>	
							</div>	
						</div>
					</div>
			   </div>
			</div>
		</div>
	</div>	
<?php echo form_close(); ?>

