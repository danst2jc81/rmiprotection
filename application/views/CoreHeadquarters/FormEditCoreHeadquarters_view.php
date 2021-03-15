<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreHeadquarters/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreHeadquarters/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}	
</script>

<?php 
	echo form_open('headquarters/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
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
			<a href="<?php echo base_url();?>headquarters">
				Daftar Pusat
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>headquarters/editheadquarters/"<?php echo $coreheadquarters['headquarters_id'] ?>">
				Edit Pusat 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Pusat 
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
							<a href="<?php echo base_url();?>headquarters" class="btn btn-default btn-sm">
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
										<input type="text" class="form-control" name="headquarters_name" id="headquarters_name"  onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('headquarters_name', $coreheadquarters['headquarters_name']);?>" autocomplete="off"/>
										<label class="control-label">Nama Pusat<span class="required">*</span></label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">	
									<div class="form-group form-md-line-input">
										<textarea rows="3" name="headquarters_address" id="headquarters_address" onChange="function_elements_add(this.name, this.value);"  class="form-control" ><?php echo $coreheadquarters['headquarters_address'];?></textarea>
										<label class="control-label">Alamat<span class="required">*</span></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="headquarters_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('headquarters_contact_person',$coreheadquarters['headquarters_contact_person']);?>" autocomplete="off"autocomplete="off"/>
										<label class="control-label">Kontak</label>
									</div>
								</div>	
								
								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="headquarters_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('headquarters_phone', $coreheadquarters['headquarters_phone']);?>" autocomplete="off"/>
										<label class="control-label">Telepon</label>
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

<input type="hidden" name="headquarters_id" id="headquarters_id" value="<?php echo $coreheadquarters['headquarters_id'];?>">
<?php echo form_close(); ?>

