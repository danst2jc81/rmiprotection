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
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
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
			<a href="<?php echo base_url();?>usergroup">
				User Group
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>


<h3 class="page-title">
	User Group <small>Manage User Group </small>
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
						<a href="<?php echo base_url();?>SystemUserGroup/addSystemUserGroup" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i>
							Add New User Group
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-body">
						<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
							<thead>
								<tr>
									<th width="5%">
										No.
									</th>
									<th width="25%">
										Level
									</th>
									<th width="25%">
										Name
									</th>
									<th width="25%">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									foreach ($systemusergroup as $key => $val){
										echo"
											<tr>			
												<td style='text-align:center'>".$no."</td>
												<td>".$val['user_group_level']."</td>
												<td>".$val['user_group_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'SystemUserGroup/editSystemUserGroup/'.$val['user_group_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'SystemUserGroup/deleteSystemUserGroup/'.$val['user_group_id']."'class='btn default btn-xs red', onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'>
														<i class='fa fa-trash-o'></i> Delete
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