
<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('customer/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
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
			<a href="<?php echo base_url();?>customer">
				Daftar Customer
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>customer/edit/<?php echo $salescustomer['customer_id'] ?>">
				Edit Customer 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Detail Customer 
</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet"> 
			<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						Form Detail
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>customer" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i>
							<span class="hidden-480">
								Kembali
							</span>
						</a>
					</div>
				</div>
				<div class="portlet-body ">
					<div class="form-body form">
						<?php 
							echo form_open_multipart('customer/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); 
						
							$unique 				= $this->session->userdata('unique');
							$data 					= $this->session->userdata('addContentCourse-'.$unique['unique']);	

							if (empty($data['customer_collection_date'])){
								$data['customer_collection_date'] = date("Y-m-d");
							}

							if (empty($data['customer_collection_amount'])){
								$data['customer_collection_amount'] = 0;
							}

						
							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name',$salescustomer['customer_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

									<label class="control-label">Nama Customer<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-3">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_registration_date" id="customer_registration_date" value="<?php echo set_value('customer_registration_date', tgltoview($salescustomer['customer_registration_date']));?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Tanggal Daftar<span class="required">*</span></label>
								</div>
							</div>


							<div class="col-md-3">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_status" id="customer_status" value="<?php echo set_value('customer_status', $customerstatus[$salescustomer['customer_name']]);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Status Customer<span class="required">*</span></label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_email" id="customer_email" value="<?php echo set_value('customer_email',$salescustomer['customer_email']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Email Customer<span class="required">*</span></label>
								</div>
							</div>
						
							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('customer_mobile_phone', $salescustomer['customer_mobile_phone']);?>" autocomplete="off" readonly/>
									<label class="control-label">Telepon Customer</label>
								</div>
							</div>
						</div>


						<br>
						<h5>Data Pembayaran Customer</h5>
						<div class="row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="customer_collection_date" id="customer_collection_date"  value="<?php echo tgltoview($data['customer_collection_date']);?>" onChange="function_elements_add(this.name, this.value);"/>
									<label class="control-label">Tanggal Bayar<span class="required">*</span></label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_collection_amount" id="customer_collection_amount" value="<?php echo set_value('customer_collection_amount', $data['customer_collection_amount']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Total Bayar</label>
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


<input type="text" class="form-control" name="customer_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('customer_id', $salescustomer['customer_id']);?>" autocomplete="off" readonly/>
<?php echo form_close(); ?>