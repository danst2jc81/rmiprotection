<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'HomePage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* CORE HEADQUARTERS */
$route['headquarters'] 				        = 'CoreHeadquarters';
$route['headquarters/add'] 			        = 'CoreHeadquarters/addCoreHeadquarters';
$route['headquarters/edit/(:num)']	        = 'CoreHeadquarters/editCoreHeadquarters/$1';
$route['headquarters/delete/(:num)']	    = 'CoreHeadquarters/deleteCoreHeadquarters/$1';
$route['headquarters/process-add'] 	        = 'CoreHeadquarters/processAddCoreHeadquarters';
$route['headquarters/process-edit'] 	    = 'CoreHeadquarters/processEditCoreHeadquarters';

/* CORE REGION */
$route['region'] 				            = 'CoreRegion';
$route['region/add'] 			            = 'CoreRegion/addCoreRegion';
$route['region/edit/(:num)']	            = 'CoreRegion/editCoreRegion/$1';
$route['region/delete/(:num)']	            = 'CoreRegion/deleteCoreRegion/$1';
$route['region/process-add'] 	            = 'CoreRegion/processAddCoreRegion';
$route['region/process-edit'] 	            = 'CoreRegion/processEditCoreRegion';

/* CORE BRANCH */
$route['branch'] 				            = 'CoreBranch';
$route['branch/filter'] 		            = 'CoreBranch/filter';
$route['branch/add'] 			            = 'CoreBranch/addCoreBranch';
$route['branch/edit/(:num)']	            = 'CoreBranch/editCoreBranch/$1';
$route['branch/delete/(:num)']	            = 'CoreBranch/deleteCoreBranch/$1';
$route['branch/process-add'] 	            = 'CoreBranch/processAddCoreBranch';
$route['branch/process-edit'] 	            = 'CoreBranch/processEditCoreBranch';
$route['branch/get-city']   	            = 'CoreBranch/getCoreCity';

/* REGISTRATION TENANT */
$route['registrasi/baru/(:num)']    	                = 'RegistrationTenant/AddRegistrationTenant/$1';
$route['registrasi/process-add'] 	                    = 'RegistrationTenant/processAddRegistrationTenant';
$route['registrasi/notif/(:num)/(:num)/(:num)/(:num)'] 	= 'RegistrationTenant/sendRegistrationTenantNotification/$1/$1/$1/$1';
$route['registrasi/baru/(:num)']    	                = 'RegistrationTenant/AddRegistrationTenant/$1';
$route['registrasi/process-add'] 	                    = 'RegistrationTenant/processAddRegistrationTenant';

/* CORE VENDOR */
$route['vendor'] 				        = 'CoreVendor';
$route['vendor/filter'] 		        = 'CoreVendor/filter';
$route['vendor/add'] 			        = 'CoreVendor/addCoreVendor';
$route['vendor/edit/(:num)']	        = 'CoreVendor/editCoreVendor/$1';
$route['vendor/delete/(:num)']	        = 'CoreVendor/deleteCoreVendor/$1';
$route['vendor/process-add'] 	        = 'CoreVendor/processAddCoreVendor';
$route['vendor/process-edit'] 	        = 'CoreVendor/processEditCoreVendor';
$route['vendor/get-branch']   	        = 'CoreVendor/getCoreBranch';
$route['vendor/get-city']   	        = 'CoreVendor/getCoreCity';

/* SYSTEM USER GROUP */
$route['user-group'] 				            = 'SystemUserGroup';
$route['user-group/add'] 			            = 'SystemUserGroup/addSystemUserGroup';
$route['user-group/edit/(:num)']	            = 'SystemUserGroup/editSystemUserGroup/$1';
$route['user-group/delete/(:num)']	            = 'SystemUserGroup/deleteSystemUserGroup/$1';
$route['user-group/process-add'] 	            = 'SystemUserGroup/processAddSystemUserGroup';
$route['user-group/process-edit'] 	            = 'SystemUserGroup/processEditSystemUserGroup';


/* SYSTEM USER */
$route['user'] 				            = 'SystemUser';
$route['user/filter'] 		            = 'SystemUser/filter';
$route['user/reset-search'] 		    = 'SystemUser/reset_search';
$route['user/reset-add'] 		        = 'SystemUser/reset_add';
$route['user/add'] 			            = 'SystemUser/addSystemUser';
$route['user/edit/(:num)']	            = 'SystemUser/editSystemUser/$1';
$route['user/delete/(:num)']	        = 'SystemUser/deleteSystemUser/$1';
$route['user/process-add'] 	            = 'SystemUser/processAddSystemUser';
$route['user/process-edit'] 	        = 'SystemUser/processEditSystemUser';
$route['user/get-branch']   	        = 'SystemUser/getCoreBranch';
$route['user/get-vendor']   	        = 'SystemUser/getCoreVendor';
$route['user/elements-add']   	        = 'SystemUser/function_elements_add';


/* DATA PERPETRATOR */
$route['perpetrator'] 				            = 'DataPerpetrator';
$route['perpetrator/filter'] 		            = 'DataPerpetrator/filter';
$route['perpetrator/reset-search'] 		    = 'DataPerpetrator/reset_search';
$route['perpetrator/get-city']   	        = 'DataPerpetrator/getCoreCity';

$route['perpetrator/reset-add'] 		        = 'DataPerpetrator/reset_add';
$route['perpetrator/add'] 			            = 'DataPerpetrator/addDataPerpetrator';
$route['perpetrator/process-add'] 	            = 'DataPerpetrator/processAddDataPerpetrator';

$route['perpetrator/photo/(:num)']	            = 'DataPerpetrator/addDataPerpetratorPhoto/$1';
$route['perpetrator/process-add-photo'] 	            = 'DataPerpetrator/processAddDataPerpetratorPhoto';
$route['perpetrator/delete-photo/(:num)/(:num)']	            = 'DataPerpetrator/deleteDataPerpetratorPhoto/$1/$1';
$route['perpetrator/chronology/(:num)']	            = 'DataPerpetrator/addDataPerpetratorChronology/$1';
$route['perpetrator/process-add-chronology'] 	            = 'DataPerpetrator/processAddDataPerpetratorChronology';


$route['perpetrator/edit/(:num)']	            = 'DataPerpetrator/editDataPerpetrator/$1';
$route['perpetrator/delete/(:num)']	        = 'DataPerpetrator/deleteDataPerpetrator/$1';
$route['perpetrator/process-edit'] 	        = 'DataPerpetrator/processEditDataPerpetrator';

$route['perpetrator/get-vendor']   	        = 'DataPerpetrator/getCoreVendor';
$route['perpetrator/elements-add']   	        = 'DataPerpetrator/function_elements_add';
