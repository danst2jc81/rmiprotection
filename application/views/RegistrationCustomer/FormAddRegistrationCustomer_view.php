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
        <title>Registrasi RMI Protection</title>
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
                    url : "<?php echo site_url('registrasi/elements-add');?>",
                    data : {'name' : name, 'value' : value},
                    success: function(msg){ 
            
                }
            });
        }
        


        $(document).ready(function(){
        $("#province_id").change(function(){
            var province_id = $("#province_id").val();
            $.ajax({
                type : "POST",
                url  : "<?php echo base_url(); ?>registrasi/get-city",
                data : {province_id: province_id},
                success: function(data){
                    $("#city_id").html(data);				   
                }
            }); 
        });
    });


        function reset_add(){
            var retVal = confirm("Yakin Akan Mengulangi Input ?");
            if( retVal == true ){
                document.location = "registrasi/reset-add/";
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
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="portlet-body form">
                                    <!-- <form class="horizontal-form" action="#" id="submit_form" method="POST"> -->
                                    <?php 
                                        echo form_open_multipart('registrasi/process-add', array('id' => 'submit_form', 'class' => 'horizontal-form')); 

                                        $unique 		        = $this->session->userdata('unique');
                                        $data                   = $this->session->userdata('addRegistrationCustomer-'.$unique['unique']);
                                        $customer_token 	    = $this->session->userdata('RegistrationCustomerToken-'.$unique['unique']);

                                        echo $this->session->userdata('message');
							            $this->session->unset_userdata('message');

                                    ?>
                                    
                                    <div class="form-body">
                                        <h4>Data RMI Protection Baru</h4>
                                        <BR>   
                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_contact_person" name="customer_contact_person" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_contact_person']?>" autocomplete="off"/>
                                                    <span class="help-block"> isikan Nama Anda </span>
                                                    <label class="control-label">Nama<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_name" name="customer_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_name']?>" autocomplete="off"/>
                                                    <span class="help-block"> isikan Nama Rental Anda </span>
                                                    <label class="control-label">Nama Rental<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_address" name="customer_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_address']?>" autocomplete="off"/>
                                                    <span class="help-block"> isikan Alamat Anda </span>
                                                    <label class="control-label">Alamat<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <?php 
                                                        echo form_dropdown('province_id', $coreprovince ,set_value('province_id',$data['province_id']),'id="province_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                                    ?>
                                                    <label class="control-label">Nama Propinsi
                                                        <span class="required">
                                                            *
                                                        </span>
                                                    </label>
                                                </div>	
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input">
                                                    <?php
                                                        if ($data['province_id'] != ''){
                                                            $corecity = create_double($this->RegistrationCustomer_model->getCoreCity($data['province_id']), 'city_id', 'city_name');

                                                            echo form_dropdown('city_id', $corecity, set_value('city_id', $data['city_id']), 'id="city_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                                        } else {
                                                    ?>
                                                        <select name="city_id" id="city_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
                                                            <option value="">--Choose One--</option>
                                                        </select>
                                                    <?php
                                                        }
                                                    ?>
                                                    <label class="control-label">Nama Kota</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_mobile_phone" name="customer_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_mobile_phone']?>" autocomplete="off"/>
                                                    <span class="help-block"> Isikan No Handphone Anda </span>
                                                    <label class="control-label">No Handphone<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_mobile_phone1" name="customer_mobile_phone1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_mobile_phone1']?>" autocomplete="off"/>
                                                    <span class="help-block"> Isikan No Handphone Anda </span>
                                                    <label class="control-label">No Handphone Alternatif<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_unit" name="customer_unit" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_unit']?>" autocomplete="off"/>
                                                    <span class="help-block"> Isikan Jumlah Unit Anda </span>
                                                    <label class="control-label">Jumlah Unit</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_email" name="customer_email" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_email']?>" autocomplete="off"/>
                                                    <span class="help-block"> Isikan Email Anda - email@email.com </span>
                                                    <label class="control-label">Email<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="text" class="form-control" id="customer_remark" name="customer_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_remark']?>" autocomplete="off"/>
                                                    <span class="help-block"> Isikan Harapan Anda </span>
                                                    <label class="control-label">Harapan dan Masukkan Tentang RMI Protection</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="password" class="form-control" id="customer_password" name="customer_password" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_password']?>" autocomplete="off"/>
                                                    <span class="help-block"> Minimal 6 Digit </span>
                                                    <label class="control-label">Password<span class="required">*</span></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class = "row">
                                            <div class = "col-md-12">
                                                <div class="form-group form-md-line-input"> 
                                                    <input type="password" class="form-control" id="customer_confirm_password" name="customer_confirm_password" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['customer_confirm_password']?>" autocomplete="off"/>
                                                    <span class="help-block"> Harus Sama Dengan Password Anda </span>
                                                    <label class="control-label">Konfirm Password<span class="required">*</span></label>
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


                                        <input type="hidden" class="form-control" id="customer_token" name="customer_token" onChange="function_elements_add(this.name, this.value);" value="<?php echo $customer_token?>"/>
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