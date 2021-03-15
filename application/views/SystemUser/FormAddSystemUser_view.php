<script>
	
</script>
<div class="workplace" style="padding:5px !important;"> 
<?php echo form_open('SystemUser/processAddSystemUser',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
	<?php
		
		$data = $this->session->userdata('AddUser');
	?>

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>SystemUser">
									User
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>SystemUser/addSystemUser">
									User Baru
								</a>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						User Baru
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
			
			
		<div class="row">
			<div class="col-md-12">
			   <div class="portlet box red">
					<div class="portlet-title">
						<div class="caption">
							Form Add
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>SystemUser" class="btn btn-default btn-sm">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									Kembali
								</span>
							</a>
						</div>
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<?php
								echo $this->session->userdata('message');
								$this->session->unset_userdata('message');
							?>
							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group">
										<label class="control-label">System User Group
											<span class="required">
												*
											</span>
										</label>
									
										<?php 
											echo form_dropdown('user_group_id', $systemusergroup, set_value('user_group_id',$data['user_group_id']), 'id="user_group_id", class="form-control select2me"');
										?>
				
									</div>
								</div>

								<div class = "col-md-6">
									<div class="form-group">
										<label class="control-label">Level User
											<span class="required">
												*
											</span>
										</label>
									
										<?php 
											echo form_dropdown('user_level', $userlevel, set_value('user_level',$data['user_level']), 'id="user_level", class="form-control select2me"');
										?>
				
									</div>
								</div>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<label class="control-label">Username
											<span class="required">
												*
											</span>
										</label>
								
										<input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $data['username']);?>"/>
								
									</div>
								</div>

								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<label class="control-label">Password
											<span class="required">
												*
											</span>
										</label>
							
										<input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password',$data['password']);?>"/>
									
									</div>
								</div>
							</div>

							
							<div class="row">
								<div class="col-md-12" style="text-align:right !important">
									<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>	
							</div>	
							
						</div>
					</div>
			   </div>
			</div>
		</div>
<?php echo form_close(); ?>
</div>