<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
	
	label {
		display: inline !important;
		width:50% !important;
		margin:0 !important;
		padding:0 !important;
		vertical-align:middle !important;
	}
</style>

<script>
	base_url = '<?= base_url()?>';

	

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
			<a href="<?php echo base_url();?>content-event">
				Daftar Event
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>content-event/edit/<?php echo $contentevent['event_id'] ?>">
				Edit Event 
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Edit Event 
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
							<a href="<?php echo base_url();?>content-event" class="btn btn-default btn-sm">
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

								echo form_open_multipart('content-event/process-edit',array('id' => 'myform', 'class' => 'horizontal-form'));
							
							?>

							<div class = "row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="event_title" id="event_title" value="<?php echo set_value('event_title',$contentevent['event_title']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

										<input type="hidden" class="form-control" name="event_id" id="event_id" value="<?php echo set_value('event_id',$contentevent['event_id']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
										<label class="control-label">Tema Event<span class="required">*</span></label>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="event_date" id="event_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($contentevent['event_date']);?>" autocomplete="off"/>
										<label class="control-label">Tanggal Event</label>
										
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group form-md-line-input">
										<textarea rows="45" name="event_description" id="event_description" class="ckeditor form-control" placeholder="" onChange="function_elements_add(this.name, this.value);"><?php echo $contentevent['event_description'];?></textarea>
										<label class="control-label">Deskripsi Event</label>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<label class="control-label">Gambar Event<span class="required">*</span></label>
									<div class="form-group">
										<div class="fileinput-new thumbnail" style="width: 400px; height: 400px;">
											<img src="<?php echo base_url();?>/img/event/<?php echo set_value('event_image', $contentevent['event_image']); ?>" alt=""/>
										</div>
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
													<input type="file" name="event_image">
												</span>
												<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													Remove
												</a>
											</div>
										</div>
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

