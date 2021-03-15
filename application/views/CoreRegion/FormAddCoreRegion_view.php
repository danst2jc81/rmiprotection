<script>
	base_url = '<?= base_url()?>';
	
	function reset_add(){
		document.location = "<?php echo base_url();?>CoreRegion/reset_add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreRegion/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreRegion/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>

<?php 
	echo form_open('region/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data 			= $this->session->userdata('addCoreRegion-'.$unique['unique']);
	$region_token 	= $this->session->userdata('CoreRegionToken-'.$unique['unique']);
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
			<a href="<?php echo base_url();?>region">
				Daftar Koordinator Wilayah 
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>region/add">
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
						<a href="<?php echo base_url();?>region" class="btn btn-default btn-sm">
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
									<input type="text" class="form-control" name="region_code" id="region_code" value="<?php echo set_value('region_code',$data['region_code']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<label class="control-label">Kode Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="region_name" id="region_name" value="<?php echo set_value('region_name',$data['region_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<input type="hidden" class="form-control" name="region_token" id="region_token" value="<?php echo set_value('region_token',$region_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Nama Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">	
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="region_address" id="region_address" onChange="function_elements_add(this.name, this.value);" class="form-control" ><?php echo $data['region_address'];?></textarea>
									<label class="control-label">Alamat Koordinator Wilayah<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="region_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('region_contact_person',$data['region_contact_person']);?>" autocomplete="off"/>
									<label class="control-label">Kontak Koordinator Wilayah</label>
								</div>
							</div>	
							
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="region_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('region_phone',$data['region_phone']);?>" autocomplete="off"/>
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