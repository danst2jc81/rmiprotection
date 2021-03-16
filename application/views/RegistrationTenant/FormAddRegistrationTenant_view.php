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
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>SPMB - Universitas Veteran Bangun Nusantara</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for bootstrap form wizard demos using Twitter Bootstrap Wizard Plugin" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> -->
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 

        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
         <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <link href="<?php echo base_url();?>assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/global/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" type="text/css" />




        
    </head>
    <!-- END HEAD -->
    <script>

        function function_elements_add(name, value){
            $.ajax({
                    type: "POST",
                    url : "<?php echo site_url('RegistrationTenant/function_elements_add');?>",
                    data : {'name' : name, 'value' : value},
                    success: function(msg){ 
            
                }
            });
        }
        
        function function_state_add(value){
            // alert(value);
            $.ajax({
                    type: "POST",
                    url : "<?php echo site_url('RegistrationTenant/function_state_add');?>",
                    data : {'value' : value},
                    success: function(msg){
                }
            });
        }

       



        function reset_add(){
            var retVal = confirm("Yakin Akan Mengulangi Input ?");
            if( retVal == true ){
                document.location = "RegistrationTenant/reset_add/<?php echo $corevendor['vendor_id']?>";
            } else {

            }
        }
    </script>
    
    <body class="page-header-fixed page-content-white page-full-width page-footer-fixed page-md">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                <!-- END SIDEBAR -->
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                    
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                       
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <h1 class="page-title"> 
                            <!-- <img src="<?php echo base_url();?>assets/img/univet/headerunivet_spmb.png" alt="" width="60%" height="25%"/> -->
                        </h1>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet-body form">
                                    <!-- <form class="horizontal-form" action="#" id="submit_form" method="POST"> -->
                                    <?php 
                                        echo form_open('registrasi/process-add', array('id' => 'submit_form', 'class' => 'horizontal-form')); 

                                        $unique 		= $this->session->userdata('unique');
                                        $tenant_token 	= $this->session->userdata('RegistrationTenantToken-'.$unique['unique']);

                                        echo $this->session->userdata('message');
							            $this->session->unset_userdata('message');
                                    ?>
                                    
                                    <div class="form-body">
                                        <div class = "row">
                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="vendor_code" name="vendor_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['vendor_code']?>" readonly/>
                                                    <label class="control-label">Kode Vendor</label>
                                                </div>
                                            </div>

                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="vendor_name" name="vendor_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['vendor_name']?>" readonly/>
                                                    <label class="control-label">Nama Vendor</label>
                                                </div>
                                            </div>

                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="vendor_phone" name="vendor_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['vendor_phone']?>" readonly/>
                                                    <label class="control-label">Telepon Vendor</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="vendor_address" name="vendor_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['vendor_address']?>" readonly/>
                                                    <label class="control-label">Alamat Vendor</label>
                                                </div>
                                            </div>
                                        </div>

                                        <h4>Data Penyewa</h4>
                                        <BR>   
                                        <div class = "row">
                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="tenant_name" name="tenant_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['tenant_name']?>"/>
                                                    <span class="help-block"> Isikan Nama Anda </span>
                                                    <label class="control-label">Nama Penyewa<span class="required">*</span></label>
                                                </div>
                                            </div>

                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="tenant_mobile_phone" name="tenant_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['tenant_mobile_phone']?>"/>
                                                    <span class="help-block"> Isikan No Handphone Anda </span>
                                                    <label class="control-label">No Handphone<span class="required">*</span></label>
                                                </div>
                                            </div>

                                            <div class = "col-md-4">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="tenant_nik" name="tenant_nik" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['tenant_nik']?>"/>
                                                    <span class="help-block"> Isikan No KTP Anda </span>
                                                    <label class="control-label">No KTP<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="tenant_address" name="tenant_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['tenant_address']?>"/>
                                                    <span class="help-block"> Isikan Alamat Anda </span>
                                                    <label class="control-label">Alamat<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style='text-align:right'>	
                                                <button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Ulang</button>
                                                <button type="submit" name="Save" id="save" class="btn green-jungle" title="Save" data-toggle='modal'><i class="fa fa-check"></i> Simpan</button>	
                                            </div>	
                                        </div>
                                    </div>
                                   
                                    <input type="hidden" class="form-control" id="vendor_id" name="vendor_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['vendor_id']?>"/>

                                    <input type="hidden" class="form-control" id="region_id" name="region_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['region_id']?>"/>

                                    <input type="hidden" class="form-control" id="branch_id" name="branch_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['branch_id']?>"/>

                                    <input type="hidden" class="form-control" id="province_id" name="province_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['province_id']?>"/>

                                    <input type="hidden" class="form-control" id="city_id" name="city_id" onChange="function_elements_add(this.name, this.value);" value="<?php echo $corevendor['city_id']?>"/>

                                    <input type="hidden" class="form-control" id="tenant_token" name="tenant_token" onChange="function_elements_add(this.name, this.value);" value="<?php echo $tenant_token?>"/>
                                </div>
                                <?php 
                                    echo form_close(); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
            
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2019 &copy;  Powered by Metronic Theme
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>
        <!-- BEGIN QUICK NAV -->
        
        
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<script src="<?php echo base_url();?>assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/form-wizard.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->



        <script src="<?php echo base_url();?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
         <script src="<?php echo base_url();?>assets/global/plugins/jstree/dist/jstree.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS 
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url();?>assets/pages/scripts/form-validation.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->

        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url();?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    </body>

</html>