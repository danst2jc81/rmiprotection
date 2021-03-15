

<div class="workplace" style="padding:5px !important;"> 
<?php echo form_open('SystemUser/processEditSystemUserEvents',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
	<?php
		$auth = $this->session->userdata('auth');
		if($this->uri->segment(3)=='Administrator'){
			$group['1']=$auth['username'];
		}
	?>
	
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = page-bar>
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
						<a href="<?php echo base_url();?>SystemUser/editSystemUser/<?php echo $systemuser['user_id'];?>">
							Edit User
						</a>
					</li>
				</ul>
			</div>
			<h3 class="page-title">
			Form Edit User
			</h3>
			<!-- END PAGE TITLE & BREADCRUMB-->
	
			
				
	<div class="row">	
		<div class="col-md-12">
		   <div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
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
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="user_group_name" id="user_group_name" value="<?php echo set_value('user_group_name', $systemuser['user_group_name']);?>" readonly/>

										<label class="control-label">System User Group
											<span class="required">
												*
											</span>
										</label>
				
									</div>
								</div>
							
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" class="form-control" name="username" id="username" value="<?php echo set_value('username', $systemuser['username']);?>" readonly/>

										<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo set_value('user_id', $systemuser['user_id']);?>"/>

										<label class="control-label">Username
											<span class="required">
												*
											</span>
										</label>
								
									</div>
								</div>
							</div>

							<div class = "row">
								<div class = "col-md-6">
									<div class="form-group form-md-line-input">
										<?php 
											echo form_dropdown('events_id', $coreevents, set_value('events_id', $systemuser['events_id']), 'id="events_id", class="form-control select2me"');
										?>

										<label class="control-label">Event
											<span class="required">
												*
											</span>
										</label>
				
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