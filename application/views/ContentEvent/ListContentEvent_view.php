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
<!-- END PAGE TITLE & BREADCRUMB-->
<script>
	base_url = '<?php echo base_url();?>';


	function reset_search(){
		document.location = base_url+"content-event/reset-search";
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
			<a href="<?php echo base_url();?>content-event">
				Event
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h3 class="page-title">
	Event
</h3>
<?php 
	echo form_open('content-event/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-ContentEvent');

	if(!is_array($data)){
		$data['start_date']		= date("Y-m-d");
		$data['end_date']		= date("Y-m-d");
	}
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">End Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>
						
					<div class="form-group">
						<div class="form-action" style="text-align  : right !important;">
							<button type="button" class="btn red" onClick="reset_search();"><i class="fa fa-times"></i> Ulang</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-search"></i> Cari</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>


<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>content-event/add" class="btn btn-default btn-sm">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							Event Baru
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
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="0%"></th>
								<th width="5%">No.</th>
								<th width="10%">Tanggal Event</th>
								<th width="20%">Judul Event</th>
								<th width="30%">Isi Event</th>
								<th width="15%">Gambar Event</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;

								if(!is_array($contentevent)){
									echo "<tr><th colspan='9'>Data Masih Kosong</th></tr>";
								} else {
									foreach($contentevent as $key => $val){
										echo"
											<tr>
												<td></td>
												<td>".$no."</td>
												<td>".tgltoview($val['event_date'])."</td>	
												<td>".$val['event_title']."</td>	
												<td>".$val['event_description']."</td>
												<td>
													<div class=\"fileinput-preview fileinput-exists thumbnail\" style=\"width: 200px; height: 150px; max-width: 200px; max-height: 150px;\">
														<img src=\"".base_url().'img/event/'.$val['event_image']."\" alt=\"\"/>
													</div>
												</td>
												<td>
													<a href='".$this->config->item('base_url').'content-event/edit/'.$val['event_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'content-event/delete/'.$val['event_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
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
	</div>
</div>
		