


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
					<div class="form-body">
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_name" id="customer_name" value="<?php echo set_value('customer_name',$salescustomer['customer_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

									<label class="control-label">Nama Customer<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_registration_date" id="customer_registration_date" value="<?php echo set_value('customer_registration_date', tgltoview($salescustomer['customer_registration_date']));?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Tanggal Daftar<span class="required">*</span></label>
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

						<div class = "row">
							<div class="col-md-6">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_status" id="customer_status" value="<?php echo set_value('customer_status', $customerstatus[$salescustomer['customer_status']]);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Status Customer<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">	
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="customer_collection_status" id="customer_collection_status" value="<?php echo set_value('customer_collection_status', $collectionstatus[$salescustomer['customer_collection_status']]);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
									<label class="control-label">Status Bayar<span class="required">*</span></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

