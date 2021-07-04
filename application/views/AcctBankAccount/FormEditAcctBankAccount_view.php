<script>
	base_url = '<?= base_url()?>';

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('bank-account/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
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
			<a href="<?php echo base_url();?>bank-account">
				Daftar Akun Bank
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>bank-account/edit/<?php echo $acctbankaccount['bank_account_id'] ?>">
				Edit Akun Bank 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Akun Bank 
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
							<a href="<?php echo base_url();?>bank-account" class="btn btn-default btn-sm">
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

								echo form_open('bank-account/process-edit',array('id' => 'myform', 'class' => 'horizontal-form'));
								$unique 			= $this->session->userdata('unique');
							?>

							<div class="row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('bank_id', $corebank ,set_value('bank_id', $acctbankaccount['bank_id']),'id="bank_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
										?>
										<label class="control-label">Nama Bank
											<span class="required">
												*
											</span>
										</label>

										<input type="hidden" class="form-control" name="bank_account_id" id="bank_account_id" value="<?php echo set_value('bank_account_id', $acctbankaccount['bank_account_id']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									</div>	
								</div>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="bank_account_no" id="bank_account_no" value="<?php echo set_value('bank_account_no', $acctbankaccount['bank_account_no']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<label class="control-label">No Akun Bank<span class="required">*</span></label>
									</div>	
								</div>

								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="bank_account_name" id="bank_account_name" value="<?php echo set_value('bank_account_name', $acctbankaccount['bank_account_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<label class="control-label">Nama Akun Bank<span class="required">*</span></label>
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
<?php echo form_close(); ?>

