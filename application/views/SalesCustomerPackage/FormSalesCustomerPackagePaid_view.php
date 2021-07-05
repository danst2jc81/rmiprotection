
<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('customer-package/elements-add');?>",
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
			<a href="<?php echo base_url();?>customer-package">
				Daftar Customer
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>customer-package/edit/<?php echo $salescustomerpackage['customer_package_id'] ?>">
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
						<a href="<?php echo base_url();?>customer-package/customer-package-unpaid" class="btn btn-default btn-sm">
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
							echo form_open_multipart('customer-package/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); 
						
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
									<input type="text" class="form-control" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name', $salescustomerpackage['customer_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

									<label class="control-label">Nama Customer<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('customer_mobile_phone', $salescustomerpackage['customer_mobile_phone']);?>" autocomplete="off" readonly/>
									<label class="control-label">Telepon Customer</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="package_name" id="package_name" value="<?php echo set_value('package_name', $salescustomerpackage['package_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

									<label class="control-label">Nama Paket<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">							
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="package_price_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_price_name', $salescustomerpackage['package_price_name']);?>" autocomplete="off" readonly/>
									<label class="control-label">Paket Harga</label>
								</div>
							</div>
						</div>

						<br>
						<h5>Data Pembayaran Customer</h5>
						<div class="row">
							<div class = "col-md-4">
								<div class="form-group form-md-line-input">
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="customer_package_collection_date" id="customer_package_collection_date"  value="<?php echo tgltoview($data['customer_package_collection_date']);?>" onChange="function_elements_add(this.name, this.value);"/>
									<label class="control-label">Tanggal Bayar<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-4">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="package_price_month" id="package_price_month" value="<?php echo set_value('package_price_month', $salescustomerpackage['package_price_month']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Total Bayar</label>
								</div>
							</div>																		
							
							<div class="col-md-4">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="package_price_amount" id="package_price_amount" value="<?php echo set_value('package_price_amount', $salescustomerpackage['package_price_amount']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
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


<input type="text" class="form-control" name="customer_package_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('customer_package_id', $salescustomerpackage['customer_package_id']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="customer_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('customer_id', $salescustomerpackage['customer_id']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_id', $salescustomerpackage['package_id']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_price_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_price_id', $salescustomerpackage['package_price_id']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_status" onChange="function_elements_add(this.name, this.value);" value="<?php echo 
set_value('package_status', $salescustomerpackage['package_status']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_price_month" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_price_month', $salescustomerpackage['package_price_month']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_price_status" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_price_status', $salescustomerpackage['package_price_status']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_search_balance" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_search_balance', $salescustomerpackage['package_search_balance']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_add_balance" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_add_balance', $salescustomerpackage['package_add_balance']);?>" autocomplete="off" readonly/>

<input type="text" class="form-control" name="package_balance_status" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('package_balance_status', $salescustomerpackage['package_balance_status']);?>" autocomplete="off" readonly/>

<?php echo form_close(); ?>