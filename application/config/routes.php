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
$route['default_controller']        = 'home';
$route['404_override'] 		        = '';
$route['translate_uri_dashes']      = FALSE;
$route['currentstock']              = 'inventory/currentstock';
$route['stockreport']               = 'inventory/stockreport';

$route['rawmaterial']               = 'inventory/rawmaterial';
$route['rawmaterial/create']        = 'inventory/rawmaterial_create';
$route['rawmaterial/edit']          = 'inventory/rawmaterial_edit';

$route['rawmaterialused']           = 'inventory/rawmaterialused';
$route['rawmaterialused/create']    = 'inventory/rawmaterialused_create';
$route['rawmaterialused/edit']      = 'inventory/rawmaterialused_edit';

$route['purchase']                  = 'inventory/purchase';
$route['purchase/create']           = 'inventory/purchase_create';
$route['purchase/edit']             = 'inventory/purchase_edit';

$route['wastage']                   = 'inventory/wastage';
$route['wastage/create']            = 'inventory/wastage_create';
$route['wastage/edit']              = 'inventory/wastage_edit';
$route['indent']                    = 'inventory/indent';
$route['non-consumable']                = 'inventory/nonConsumable';
$route['fixed-assets']                = 'inventory/fixedassets';

// $route['rawmaterial-used']	    = 'rawmaterial/usedlist';
// $route['rawmaterial/used-edit']  = 'rawmaterial/used';


// for Reports
$route['category-report']           = 'reports/category';
$route['item-report']               = 'reports/item';
$route['sales-report']              = 'reports/sales';
$route['order-report']              = 'reports/order';
$route['employee-report']           = 'reports/employee';
$route['item-details-report']       = 'reports/group';
$route['payment-report']            = 'reports/counter';
$route['kitchen-report']            = 'reports/kitchen';
$route['ordertime-report']          = 'reports/ordertime';
$route['tip-report']                = 'reports/tip';
$route['employee-tip-report']       = 'reports/employeetip';

$route['balance-sheet']                = 'reports/balancesheet';
$route['profit-loss-sheet']            = 'reports/profitloosssheet';
$route['ledger-sheet']                 = 'reports/ledgersheet';

$route['managebill-report']         = 'reports/managebill';

// for creditpayment 

$route['creditpayment-pending']     = 'creditpayment/creditpaymentPending';
$route['creditpayment-paid']        = 'creditpayment/creditpaymentPaid';