<script>
	base_url = '<?= base_url()?>';
	
	function reset_edit(){
		document.location = "<?php echo base_url();?>package/reset-edit/<?php echo $corepackage['package_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('package/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

</script>

<?php 
	echo form_open('package/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
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
			<a href="<?php echo base_url();?>package">
				Daftar Paket
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>package/edit/"<?php echo $corepackage['package_id'] ?>">
				Edit Paket 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Paket 
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
						<a href="<?php echo base_url();?>package" class="btn btn-default btn-sm">
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
						?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="package_name" id="package_name"  onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_name', $corepackage['package_name']);?>" autocomplete="off"/>
									<label class="control-label">Nama Paket<span class="required">*</span></label>
								</div>
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('package_status', $packagestatus ,set_value('package_status', $corepackage['package_status']),'id="package_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label class="control-label">Status Paket
										<span class="required">
											*
										</span>
									</label>
								</div>	
							</div>
						</div>

						<div class="form-group">
							<div class="form-actions" style="text-align  : right !important;">
								<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_edit()"><i class="fa fa-times"></i> Reset</button>
								<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save" data-toggle='modal'><i class="fa fa-check"></i> Save</button>	
							</div>	
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

<input type="hidden" name="package_id" id="package_id" value="<?php echo $corepackage['package_id'];?>">
<?php echo form_close(); ?>

