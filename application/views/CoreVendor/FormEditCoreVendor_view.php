<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreVendor/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreVendor/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}	

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id = $("#region_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>vendor/get-branch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);				   
               }
            }); 
        });
    });

	$(document).ready(function(){
        $("#province_id").change(function(){
            var province_id = $("#province_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>vendor/get-city",
               data : {province_id: province_id},
               success: function(data){
                   $("#city_id").html(data);				   
               }
            }); 
        });
    });
</script>

<?php 
	echo form_open('vendor/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
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
			<a href="<?php echo base_url();?>vendor">
				Daftar Cabang
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>vendor/editvendor/"<?php echo $corevendor['vendor_id'] ?>">
				Edit Cabang 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Cabang 
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
							<a href="<?php echo base_url();?>vendor" class="btn btn-default btn-sm">
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
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('region_id', $coreregion ,set_value('region_id',$corevendor['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Korwil
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>

								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php
											if ($corevendor['region_id'] != ''){
												$corebranch = create_double($this->CoreVendor_model->getCoreBranch($corevendor['region_id']), 'branch_id', 'branch_name');

												echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $corevendor['branch_id']), 'id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('province_id', $coreprovince ,set_value('province_id',$corevendor['province_id']),'id="province_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Propinsi
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>

								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php
											if ($corevendor['province_id'] != ''){
												$corecity = create_double($this->CoreVendor_model->getCoreCity($corevendor['province_id']), 'city_id', 'city_name');

												echo form_dropdown('city_id', $corecity, set_value('city_id', $corevendor['city_id']), 'id="city_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
											} else {
										?>
											<select name="city_id" id="city_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
												<option value="">--Choose One--</option>
											</select>
										<?php
											}
										?>
										<label class="control-label">Nama Kota</label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="vendor_code" id="vendor_code"  onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_code', $corevendor['vendor_code']);?>" autocomplete="off"/>
										<label class="control-label">Kode Cabang<span class="required">*</span></label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="vendor_name" id="vendor_name"  onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_name', $corevendor['vendor_name']);?>" autocomplete="off"/>
										<label class="control-label">Nama Cabang<span class="required">*</span></label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">	
									<div class="form-group form-md-line-input">
										<textarea rows="3" name="vendor_address" id="vendor_address" onChange="function_elements_add(this.name, this.value);"  class="form-control" ><?php echo $corevendor['vendor_address'];?></textarea>
										<label class="control-label">Alamat Cabang<span class="required">*</span></label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="vendor_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_contact_person',$corevendor['vendor_contact_person']);?>" autocomplete="off"autocomplete="off"/>
										<label class="control-label">Kontak Cabang</label>
									</div>
								</div>	
								
								<div class="col-md-6">							
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="vendor_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_phone', $corevendor['vendor_phone']);?>" autocomplete="off"/>
										<label class="control-label">Telepon Cabang</label>
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

<input type="hidden" name="vendor_id" id="vendor_id" value="<?php echo $corevendor['vendor_id'];?>">
<?php echo form_close(); ?>

