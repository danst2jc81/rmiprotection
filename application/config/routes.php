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


/* CONTENT NEWS */
$route['content-news'] 				        = 'ContentNews';
$route['content-news/filter'] 		        = 'ContentNews/filter';
$route['content-news/reset-search'] 		        = 'ContentNews/reset_search';
$route['content-news/add'] 			        = 'ContentNews/addContentNews';
$route['content-news/edit/(:num)']	        = 'ContentNews/editContentNews/$1';
$route['content-news/delete/(:num)']	        = 'ContentNews/deleteContentNews/$1';
$route['content-news/process-add'] 	        = 'ContentNews/processAddContentNews';
$route['content-news/process-edit'] 	        = 'ContentNews/processEditContentNews';


/* CONTENT EVENT */
$route['content-event'] 				        = 'ContentEvent';
$route['content-event/filter'] 		        = 'ContentEvent/filter';
$route['content-event/reset-search'] 		        = 'ContentEvent/reset_search';
$route['content-event/add'] 			        = 'ContentEvent/addContentEvent';
$route['content-event/edit/(:num)']	        = 'ContentEvent/editContentEvent/$1';
$route['content-event/delete/(:num)']	        = 'ContentEvent/deleteContentEvent/$1';
$route['content-event/process-add'] 	        = 'ContentEvent/processAddContentEvent';
$route['content-event/process-edit'] 	        = 'ContentEvent/processEditContentEvent';


/* CORE PACKAGE */
$route['package'] 				        = 'CorePackage';
$route['package/add'] 			        = 'CorePackage/addCorePackage';
$route['package/reset-add'] 		        = 'CorePackage/reset_add';
$route['package/edit/(:num)']	        = 'CorePackage/editCorePackage/$1';
$route['package/reset-edit/(:num)'] 		        = 'CorePackage/reset_edit/$1';
$route['package/delete/(:num)']	    = 'CorePackage/deleteCorePackage/$1';
$route['package/process-add'] 	        = 'CorePackage/processAddCorePackage';
$route['package/process-edit'] 	    = 'CorePackage/processEditCorePackage';


/* CORE PACKAGE PRICE */
$route['package-price'] 				        = 'CorePackagePrice';
$route['package-price/filter'] 		        = 'CorePackagePrice/filter';
$route['package-price/reset-search'] 		        = 'CorePackagePrice/reset_search';
$route['package-price/add'] 			        = 'CorePackagePrice/addCorePackagePrice';
$route['package-price/reset-add'] 		        = 'CorePackagePrice/reset_add';
$route['package-price/edit/(:num)']	        = 'CorePackagePrice/editCorePackagePrice/$1';
$route['package-price/reset-edit/(:num)'] 		        = 'CorePackagePrice/reset_edit/$1';
$route['package-price/delete/(:num)']	    = 'CorePackagePrice/deleteCorePackagePrice/$1';
$route['package-price/process-add'] 	        = 'CorePackagePrice/processAddCorePackagePrice';
$route['package-price/process-edit'] 	    = 'CorePackagePrice/processEditCorePackagePrice';

/* ACCT BANK ACCOUNT*/
$route['bank-account'] 				    = 'AcctBankAccount';
$route['bank-account/add'] 			    = 'AcctBankAccount/addAcctBankAccount';
$route['bank-account/reset-add'] 			    = 'AcctBankAccount/reset_add';
$route['bank-account/edit/(:num)']	    = 'AcctBankAccount/editAcctBankAccount/$1';
$route['bank-account/delete/(:num)']	    = 'AcctBankAccount/deleteAcctBankAccount/$1';
$route['bank-account/process-add'] 	    = 'AcctBankAccount/processAddAcctBankAccount';
$route['bank-account/process-edit'] 	    = 'AcctBankAccount/processEditAcctBankAccount';
$route['bank-account/reset-add']  	    = 'AcctBankAccount/reset_add';
$route['bank-account/elements-add']  	    = 'AcctBankAccount/function_elements_add';


/* SALES CUSTOMER */
$route['customer'] 				        = 'SalesCustomer';
$route['customer/filter'] 			        = 'SalesCustomer/filter';
$route['customer/detail/(:num)']	    = 'SalesCustomer/detailSalesCustomer/$1';
$route['customer/reset-search'] 			        = 'SalesCustomer/reset_search';
$route['customer/customer-unpaid'] 			        = 'SalesCustomer/getSalesCustomerUnPaid';
$route['customer/collection/(:num)']	    = 'SalesCustomer/getSalesCustomerUnPaid_Detail/$1';
$route['customer/process-edit']	    = 'SalesCustomer/processUpdateSalesCustomer_Collection';


/* SALES CUSTOMER PACKAGE */
$route['customer-package'] 				        = 'SalesCustomerPackage';
$route['customer-package/filter'] 			        = 'SalesCustomerPackage/filter';
$route['customer-package/detail/(:num)']	    = 'SalesCustomerPackage/detailSalesCustomerPackage/$1';
$route['customer-package/reset-search'] 			        = 'SalesCustomerPackage/reset_search';
$route['customer-package/customer-package-unpaid'] 			        = 'SalesCustomerPackage/getSalesCustomerPackageUnPaid';
$route['customer-package/collection/(:num)']	    = 'SalesCustomerPackage/getSalesCustomerPackageUnPaid_Detail/$1';
$route['customer-package/process-edit']	    = 'SalesCustomerPackage/processUpdateSalesCustomerPackage_Collection';


/* REGISTRATION CONGREGATION */
$route['registrasi']    	                            = 'RegistrationCustomer/addRegistrationCustomer';
$route['registrasi/get-city'] 	                    = 'RegistrationCustomer/getCoreCity';
$route['registrasi/process-add'] 	                    = 'RegistrationCustomer/processAddRegistrationCustomer';
$route['registrasi/reset-add']  	    = 'RegistrationCustomer/reset_add';
$route['registrasi/elements-add']  	    = 'RegistrationCustomer/function_elements_add';