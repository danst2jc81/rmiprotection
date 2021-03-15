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
<?php //echo form_open('user/processAddUser',array('id' => 'myform')); ?>
	<?php
		
		$data = $this->session->userdata('AddUser');
		// $a=tgltodb('02/03/1993');
		// print_r($a); exit;
	?>
	
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
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
						</ul>
					</div>
					<h3 class="page-title">
					System User 
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
				
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								List
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>SystemUser/addSystemUser" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										User Baru
									</span>
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="form-body">
								<?php
									echo $this->session->userdata('message');
									$this->session->unset_userdata('message');
								?>
								<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
									<thead>
										<tr>
											<th width="5%">
												No.
											</th>
											<th width="25%">
												Username
											</th>
											<th width="25%">
												Group
											</th>
											<th width="25%">
												Event
											</th>
											<th width="20%">
												Action
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no = 1;
											foreach ($systemuser as $key => $val){
												echo"
													<tr>			
														<td style='text-align:center'>".$no."</td>
														<td>".$val['username']."</td>
														<td>".$val['user_group_name']."</td>
														<td>".$this->SystemUser_model->getEventsName($val['events_id'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'SystemUser/editSystemUser/'.$val['user_id']."' class='btn default btn-xs purple'>
																<i class='fa fa-edit'></i> Edit
															</a>
															<a href='".$this->config->item('base_url').'SystemUser/deleteSystemUser/'.$val['user_id']."'class='btn default btn-xs red', onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'>
																<i class='fa fa-trash-o'></i> Delete
															</a>

															<a href='".$this->config->item('base_url').'SystemUser/editSystemUserEvents/'.$val['user_id']."' class='btn default btn-xs blue'>
																	<i class='fa fa-edit'></i> Event
																</a>
														</td>
													</tr>
												";
												$no++;
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
<?php echo form_close(); ?>