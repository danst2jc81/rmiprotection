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
	
	function reset_add(){
		document.location = "<?php echo base_url();?>content-news/reset-add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('content-news/elements-add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	

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
			<a href="<?php echo base_url();?>content-news">
				Daftar Berita
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>content-news/add">
				Berita Baru
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Berita
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
						<a href="<?php echo base_url();?>content-news" class="btn btn-default btn-sm">
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

							echo form_open_multipart('content-news/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

							$unique 				= $this->session->userdata('unique');
							$data 					= $this->session->userdata('addContentNews-'.$unique['unique']);
							$news_token 			= $this->session->userdata('ContentNewsToken-'.$unique['unique']);

							if (empty($data['news_id'])){
								$data['news_id'] = 0;
							}

							if (empty($data['news_title'])){
								$data['news_title'] = '';
							}

							if (empty($data['news_date'])){
								$data['news_date'] = date("Y-m-d");
							}

							if (empty($data['news_description'])){
								$data['news_description'] = '';
							}
						?>


						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" class="form-control" name="news_title" id="news_title" value="<?php echo set_value('news_title',$data['news_title']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>

									<input type="hidden" class="form-control" name="news_token" id="news_token" value="<?php echo set_value('news_token',$news_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off"/>
									<label class="control-label">Tema Berita<span class="required">*</span></label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="news_date" id="news_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['news_date']);?>" autocomplete="off"/>
									<label class="control-label">Tanggal Berita</label>
									
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="45" name="news_description" id="news_description" class="ckeditor form-control" placeholder="" onChange="function_elements_add(this.name, this.value);"><?php echo $data['news_description'];?></textarea>
									<label class="control-label">Isi Berita</label>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label class="control-label">Gambar Berita<span class="required">*</span></label>
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
												<input type="file" name="news_image">
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