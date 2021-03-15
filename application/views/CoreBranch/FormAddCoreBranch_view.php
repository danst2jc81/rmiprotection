<script>
	base_url = '<?= base_url()?>';
	
	function reset_add(){
		document.location = "<?php echo base_url();?>CoreBranch/reset_add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreBranch/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreBranch/function_state_add');?>",
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
	echo form_open('branch/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data 			= $this->session->userdata('addCoreBranch-'.$unique['unique']);
	$branch_token 	= $this->session->userdata('CoreBranchToken-'.$unique['unique']);
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
				Daftar Koordinator Wilayah 
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>branch/add">
				Koordinator Wilayah Baru
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Koordinator Wilayah 
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
						<a href="<?php echo base_url();?>branch" class="btn btn-default btn-sm">
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
							<div class = "col-md-4">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('region_id', $coreregion ,set_value('region_id',$data['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
										echo form_dropdown('province_id', $coreprovince ,set_value('province_id',$data['province_id']),'id="province_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
									<input type="text" class="form-control" name="branch_code" id="branch_code" value="<?php echo set_value('branch_code',$data['branch_code']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<label class="control-label">Kode Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="branch_name" id="branch_name" value="<?php echo set_value('branch_name',$data['branch_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<input type="hidden" class="form-control" name="branch_token" id="branch_token" value="<?php echo set_value('branch_token',$branch_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Nama Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">	
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="branch_address" id="branch_address" onChange="function_elements_add(this.name, this.value);" class="form-control" ><?php echo $data['branch_address'];?></textarea>
									<label class="control-label">Alamat Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="branch_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('branch_contact_person',$data['branch_contact_person']);?>" autocomplete="off"/>
									<label class="control-label">Kontak Koordinator Wilayah</label>
								</div>
							</div>	
							
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="branch_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('branch_phone',$data['branch_phone']);?>" autocomplete="off"/>
									<label class="control-label">Telepon Koordinator Wilayah</label>
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