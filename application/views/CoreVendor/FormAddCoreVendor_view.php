<script>
	base_url = '<?= base_url()?>';
	
	function reset_add(){
		document.location = "<?php echo base_url();?>CoreVendor/reset_add";
	}

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
</script>

<?php 
	echo form_open('vendor/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data 			= $this->session->userdata('addCoreVendor-'.$unique['unique']);
	$vendor_token 	= $this->session->userdata('CoreVendorToken-'.$unique['unique']);
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
			<a href="<?php echo base_url();?>vendor">
				Daftar Vendor
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>vendor/add">
				VendorBaru
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Vendor
</h3>
<!-- END PAGE TITLE & BREADCRUMB-->
			
<div class="row">
	<div class="col-md-12">
		<div class="portlet"> 
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						Form Tambah
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
										echo form_dropdown('region_id', $coreregion ,set_value('region_id',$data['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
										if ($data['region_id'] != ''){
											$corebranch = create_double($this->CoreVendor_model->getCoreBranch($data['region_id']), 'branch_id', 'branch_name');

											echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
										echo form_dropdown('province_id', $coreprovince ,set_value('province_id',$data['province_id']),'id="province_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
										if ($data['province_id'] != ''){
											$corecity = create_double($this->CoreVendor_model->getCoreCity($data['province_id']), 'city_id', 'city_name');

											echo form_dropdown('city_id', $corecity, set_value('city_id', $data['city_id']), 'id="city_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
									<input type="text" class="form-control" name="vendor_code" id="vendor_code" value="<?php echo set_value('vendor_code',$data['vendor_code']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<label class="control-label">Kode Vendor<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="vendor_name" id="vendor_name" value="<?php echo set_value('vendor_name',$data['vendor_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<input type="hidden" class="form-control" name="vendor_token" id="vendor_token" value="<?php echo set_value('vendor_token',$vendor_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Nama Vendor<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">	
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="vendor_address" id="vendor_address" onChange="function_elements_add(this.name, this.value);" class="form-control" ><?php echo $data['vendor_address'];?></textarea>
									<label class="control-label">Alamat Vendor<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="vendor_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_contact_person',$data['vendor_contact_person']);?>" autocomplete="off"/>
									<label class="control-label">Kontak Vendor</label>
								</div>
							</div>	
							
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="vendor_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('vendor_phone',$data['vendor_phone']);?>" autocomplete="off"/>
									<label class="control-label">Telepon Vendor</label>
								</div>
							</div>
						</div>

						<div style='text-align:right'>	
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Ulang</button>
							<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save" data-toggle='modal'><i class="fa fa-check"></i> Simpan</button>	
						</div>		
						
					</div>
				</div>
			</div> 
		</div>
	</div>
</div>	
<?php echo form_close(); ?>