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

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>

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
				Content Event Gallery
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>perpetrator/photo/<?php echo $dataperpetrator['perpetrator_id']; ?>">
				Foto Event Gallery
			</a>
		</li>
	</ul>
</div>
<h3 class="page-title">
	Form Tambah Foto Event Gallery
</h3>
<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">	
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
				<!-- BEGIN FORM-->
				<div class="form-body">
					<?php
						echo form_open_multipart('perpetrator/process-add-photo',array('id' => 'myform', 'class' => 'horizontal-form', 'role' => 'form'));

						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');

						$unique	= $this->session->userdata('unique');
						$auth	= $this->session->userdata('auth');
						$perpetrator_photo_token 	= $this->session->userdata('DataPerpetratorPhotoToken-'.$unique['unique']);

						print_r("dataperpetrator ");
						print_r($dataperpetrator);
					?>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="perpetrator_name" id="perpetrator_name" value="<?php echo set_value('perpetrator_name',$dataperpetrator['perpetrator_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<input type="hidden" class="form-control" name="vendor_code" id="vendor_code" value="<?php echo set_value('vendor_code',$dataperpetrator['vendor_code']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<input type="hidden" class="form-control" name="perpetrator_id" id="perpetrator_id" value="<?php echo set_value('perpetrator_id',$dataperpetrator['perpetrator_id']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<input type="hidden" class="form-control" name="perpetrator_photo_token" id="perpetrator_photo_token" value="<?php echo set_value('perpetrator_photo_token', $perpetrator_photo_token);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<label class="control-label">Nama Pelaku<span class="required">*</span></label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="perpetrator_date_of_birth" id="perpetrator_date_of_birth" value="<?php echo set_value('perpetrator_date_of_birth', tgltoview($dataperpetrator['perpetrator_date_of_birth']));?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>
								<label class="control-label">Tanggal Lahir</label>
								
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">	
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="perpetrator_address" id="perpetrator_address" onChange="function_elements_add(this.name, this.value);" class="form-control" disabled><?php echo $dataperpetrator['perpetrator_address'];?></textarea>
								<label class="control-label">Alamat Pelaku<span class="required">*</span></label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="province_name" id="province_name" value="<?php echo set_value('province_name',$dataperpetrator['province_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<label class="control-label">Nama Provinsi<span class="required">*</span></label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="city_name" id="city_name" value="<?php echo set_value('province_name',$dataperpetrator['city_name']);?>" onChange="function_elements_add(this.name, this.value);" autocomplete="off" readonly/>

								<label class="control-label">Nama Kota<span class="required">*</span></label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="perpetrator_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('perpetrator_mobile_phone',$dataperpetrator['perpetrator_mobile_phone']);?>" autocomplete="off" readonly/>
								<label class="control-label">Telepon Pelaku</label>
							</div>
						</div>

						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" name="perpetrator_id_number" onChange="function_elements_add(this.name, this.value);" value="<?php echo set_value('perpetrator_id_number',$dataperpetrator['perpetrator_id_number']);?>" autocomplete="off" readonly/>
								<label class="control-label">No KTP Pelaku</label>
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

					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Ulang</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					Daftar
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<table class="table table-bordered table-advance table-hover">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="80%">Foto Pelaku</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(!is_array($dataperpetratorphoto)){
									echo "<tr><th colspan='2'>Data Masih Kosong</th></tr>";
								} else {
									foreach ($dataperpetratorphoto as $key => $val){		
										echo"
											<tr>									
												<td>".$no."</td>
												<td>";
													echo "<div class=\"fileinput-new thumbnail\" style=\"width: 400px; height: 400px;\">
													<img src=".base_url()."img/".$val['perpetrator_photo_path']."/".$val['perpetrator_photo_name']." alt=\"\"/>
													</div>";
												echo "</td>
												<td>
													<a href='".$this->config->item('base_url').'perpetrator/delete-photo/'.$val['perpetrator_photo_id']."/".$val['perpetrator_id']."' onClick='javascript:return confirm(\"Hapus Data Ini ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
													</a>	
												</td>
											</tr>
										";
										$no++;
									} 
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>