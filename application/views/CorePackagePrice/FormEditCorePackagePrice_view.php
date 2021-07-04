<script>
	base_url = '<?= base_url()?>';

	function reset_edit(){
		document.location = "<?php echo base_url();?>package-price/reset-edit/<?php echo $corepackageprice['package_price_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('package-price/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

</script>

<?php 
	echo form_open('package-price/process-edit',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
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
			<a href="<?php echo base_url();?>package-price">
				Daftar Harga Paket
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>package-price/edit/"<?php echo $corepackageprice['package_price_id'] ?>">
				Edit Harga Paket 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Harga Paket 
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
							<a href="<?php echo base_url();?>package-price" class="btn btn-default btn-sm">
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
											echo form_dropdown('package_id', $corepackage ,set_value('package_id', $corepackageprice['package_id']), 'id="package_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Paket
											<span class="required">
												*
											</span>
										</label>
									</div>	
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="package_price_month" id="package_price_month" value="<?php echo set_value('package_price_month',$corepackageprice['package_price_month']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<label class="control-label">Total Bulan Harga Paket<span class="required">*</span></label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="package_price_amount" id="package_price_amount" value="<?php echo set_value('package_price_amount',$corepackageprice['package_price_amount']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<label class="control-label">Harga Paket<span class="required">*</span></label>
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

<input type="hidden" name="package_price_id" id="package_price_id" value="<?php echo $corepackageprice['package_price_id'];?>">
<?php echo form_close(); ?>

