<script>
	function CheckedAll () {
		// alert(document.getElementById('myform').elements.length);
		for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
		  document.getElementById('myform').elements[i].checked = true;
		}
    }
	
	function UnCheckedAll () {
		// alert(document.getElementById('myform').elements.length);
		for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
		  document.getElementById('myform').elements[i].checked = false;
		}
    }
	function ulang(){
		document.getElementById("user_group_name").value = "";
	}
	
	function warninggroupname(inputname){
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("user_group_name").value = "";	
			$('#user_group_name').focus();
			return false;
		}
	}
	
	$(document).ready(function(){        	
		$("#Save").click(function(){		 		 	
		var user_group_name = $("#user_group_name").val();		  		  		
		if(user_group_name!=''){					
		return true;				
		}else{					
		alert('Data Not Yet Complete');					
		return false;				
		}		
		});    
	});
</script>
<div class="workplace" style="padding:5px !important;"> 
<?php 
	echo form_open('user-group/process-add', array('id' => 'myform', 'class' => 'horizontal-form')); 
		
	$data = $this->session->userdata('AddUserGroup');
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
								<a href="<?php echo base_url();?>user-group">
									Group User
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>user-group/add">
									Add Group User 
								</a>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Tambah System Group User
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
							<a href="<?php echo base_url();?>user-group" class="btn btn-default btn-sm">
								<i class="fa fa-angle-left"></i>
								Kembali
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="form-body">
							<?php
								echo $this->session->userdata('message');
								$this->session->unset_userdata('message');
							?>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<label class="control-label">Nama Group
											<span class="required">
											*
											</span>
										</label>
										<input type="text" class="form-control" name="user_group_name" id="user_group_name"  value="<?php echo set_value('user_group_name',$data['user_group_name']);?>" />
									</div>	
								</div>
							</div>

							<div class = "row">
								<div class = "col-md-12">
									<div class="form-group">
										<label class="control-label">Hak Akses  Menu
											<span class="required">
												*
											</span>
										</label>
										<ul>
											<?php
												// && $auth['user_group_id']!='1' && $auth['user_group_id']!='2'
												$auth		= $this->session->userdata('auth');
												$menulist1 	= $this->SystemUserGroup_model->getMenuList("_");
												foreach($menulist1 as $key=>$val){
													if($val['type']=='folder'){
														echo "<li>";
														echo '<label>'.$val['text']."</label>";
															echo "<ul>";
																$menulist2 = $this->SystemUserGroup_model->getMenuList($val['id_menu']."_");
																foreach($menulist2 as $key2=>$val2){
																	if($val2['type']=='folder'){
																		echo "<li>";
																		echo '<label>'.$val2['text'].'</label>';
																		echo "<ul>";
																		$menulist3 = $this->SystemUserGroup_model->getMenuList($val2['id_menu']."_");
																			foreach($menulist3 as $key3=>$val3){
																				if($val3['type']=='folder'){
																					echo "<li>";
																					echo '<label>'.$val3['text'].'</label>';
																					echo "<ul>";
																					$menulist4 = $this->SystemUserGroup_model->getMenuList($val3['id_menu']."_");
																					foreach($menulist4 as $key4=>$val4){
																						if($val4['type']=='folder'){
																						echo "<li>";
																						echo '<label>'.$val3['text'].'</label>';
																						}
																						else{
																							if($val4['id_menu']!='21' && $val4['id_menu']!='22'){
																							echo "<li>";
																							echo form_checkbox($val4['id_menu']."_FT",1,'','');
																							echo "<label> ".$val4['text']."</label>";
																							echo "</li>";
																							}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																							echo "<li>";
																							echo form_checkbox($val4['id_menu']."_FT",1,'','');
																							echo "<label> ".$val4['text']."</label>";
																							echo "</li>";
																						}else {continue;}
																						}
																					}
																					echo "</ul>";
																				echo "</li>";
																				}
																				else{
																					if($val3['id_menu']!='21' && $val3['id_menu']!='22'){
																					echo "<li>";
																					echo form_checkbox($val3['id_menu']."_FT",1,'','');
																					echo "<label> ".$val3['text']."</label>";
																					echo "</li>";
																				}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																				echo "<li>";
																				echo form_checkbox($val3['id_menu']."_FT",1,'','');
																				echo "<label> ".$val3['text']."</label>";
																				echo "</li>";
																		}else {continue;}
																		}
																		}
																		echo "</ul>";
																	echo "</li>";
																	} else {
																		if($val2['id_menu']!='21' && $val2['id_menu']!='22'){
																			echo "<li>";
																			echo form_checkbox($val2['id_menu']."_FT",1,'','');
																			echo "<label> ".$val2['text']."</label>";
																			echo "</li>";
																		}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																			echo "<li>";
																			echo form_checkbox($val2['id_menu']."_FT",1,'','');
																			echo "<label> ".$val2['text']."</label>";
																			echo "</li>";
																		}else {continue;}
																	}
																}
															echo "</ul>";
														echo "</li>";
													} else {
														echo "<li>";
														echo form_checkbox($val['id_menu']."_FT",1,'','');
														echo "<label> ".$val['text']."</label>";
														echo "</li>";
													}
												}
											?>
										</ul>
										<a href="javascript:CheckedAll()" title="Check All">Check All</a> / <a href="javascript:UnCheckedAll()" title="UnCheck All">UnCheck All</a>
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