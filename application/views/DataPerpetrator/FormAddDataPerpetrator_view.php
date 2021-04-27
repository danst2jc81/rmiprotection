

<script>
	base_url = '<?= base_url()?>';
	
	function reset_add(){
		document.location = "<?php echo base_url();?>perpetrator/reset-add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('perpetrator/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
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
		<li>
			<a href="<?php echo base_url();?>perpetrator/add">
				Pelaku Baru
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Pelaku
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
						<a href="<?php echo base_url();?>perpetrator" class="btn btn-default btn-sm">
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

							echo form_open_multipart('perpetrator/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							$unique 				= $this->session->userdata('unique');
							$data 					= $this->session->userdata('addDataPerpetrator-'.$unique['unique']);
							$perpetrator_token 		= $this->session->userdata('DataPerpetratorToken-'.$unique['unique']);

							if (empty($data['province_perpetrator_id'])){
								$data['province_perpetrator_id'] = 0;
							}

							if (empty($data['city_perpetrator_id'])){
								$data['city_perpetrator_id'] = 0;
							}

							if (empty($data['perpetrator_name'])){
								$data['perpetrator_name'] = '';
							}

							if (empty($data['perpetrator_date_of_birth'])){
								$data['perpetrator_date_of_birth'] = date("Y-m-d");
							}

							if (empty($data['perpetrator_address'])){
								$data['perpetrator_address'] = '';
							}

							if (empty($data['perpetrator_mobile_phone'])){
								$data['perpetrator_mobile_phone'] = '';
							}

						?>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="perpetrator_name" id="perpetrator_name" value="<?php echo set_value('perpetrator_name',$data['perpetrator_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<input type="hidden" class="form-control" name="perpetrator_token" id="perpetrator_token" value="<?php echo set_value('perpetrator_token',$perpetrator_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Nama Pelaku<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="perpetrator_date_of_birth" id="perpetrator_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['perpetrator_date_of_birth']);?>" autocomplete="off"/>
									<label class="control-label">Tanggal Lahir</label>
									
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">	
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="perpetrator_address" id="perpetrator_address" onChange="function_elements_add(this.name, this.value);" class="form-control" ><?php echo $data['perpetrator_address'];?></textarea>
									<label class="control-label">Alamat Pelaku<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php 
										echo form_dropdown('province_perpetrator_id', $coreprovinceperpetrator ,set_value('province_perpetrator_id', $data['province_perpetrator_id']),'id="province_perpetrator_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>
									<label class="control-label">Nama Provinsi
										<span class="required">
											*
										</span>
									</label>
								</div>	
							</div>

							<div class = "col-md-6">
								<div class="form-group">
									<div class="form-group form-md-line-input">
										<?php 
											if ($data['province_perpetrator_id'] != ''){
												$corecity = create_double($this->DataPerpetrator_model->getCoreCity($data['province_perpetrator_id']), 'city_id', 'city_name');

												echo form_dropdown('city_perpetrator_id', $corecity, set_value('city_perpetrator_id', $data['city_perpetrator_id']),'id="city_perpetrator_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
											} else {
										?>
											<select name="city_perpetrator_id" id="city_perpetrator_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
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

						<div class = "row">
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="perpetrator_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('perpetrator_mobile_phone',$data['perpetrator_mobile_phone']);?>" autocomplete="off"/>
									<label class="control-label">Telepon Pelaku</label>
								</div>
							</div>

							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="perpetrator_id_number" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('perpetrator_id_number',$data['perpetrator_id_number']);?>" autocomplete="off"/>
									<label class="control-label">No KTP Pelaku</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="45" name="perpetrator_chronology_description" id="perpetrator_chronology_description" class="ckeditor form-control" placeholder="" onChange="function_elements_add(this.name, this.value);"><?php echo $data['perpetrator_chronology_description'];?></textarea>
									<label class="control-label">Kronologi Kejadian</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label class="control-label">Foto Pelaku<span class="required">*</span></label>
								<div class="form-group">
									<div class="fileinput fileinput-new" data-provides="fileinput">
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 800px; max-height: 800px;">
										</div>
										<div>
											<span class="btn default btn-file">
												<span class="fileinput-new">
													Select image
												</span>
												<span class="fileinput-exists">
													Change
												</span>
												<input type="file" name="perpetrator_photo_name">
											</span>
											<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
												Remove
											</a>
										</div>
									</div>
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