<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomepageController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Admin Routes
$routes->get("admin", "AdminController::index", ["filter" => "adminfilter"]);
$routes->get('ManageMSO', 'AdminController::manageMSO', ["filter" => "adminfilter"]);
$routes->get('ManageInspector', 'AdminController::manageInspector', ["filter" => "adminfilter"]);
$routes->get('ManageTreasurer', 'AdminController::manageTreasurer', ["filter" => "adminfilter"]);
$routes->get('ManageProfile', 'AdminController::manageProfile', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'Register', 'AdminController::registeruser', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'UpdateName', 'AdminController::changename', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'UpdatePassword', 'AdminController::changepass', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'UpdateUsername', 'AdminController::changeusername', ["filter" => "adminfilter"]);
$routes->get('UpdateMSO/(:num)', 'AdminController::updateMSO/$1', ["filter" => "adminfilter"]);
$routes->get('UpdateTreasurer/(:num)', 'AdminController::updateTreasurer/$1', ["filter" => "adminfilter"]);
$routes->get('UpdateInspector/(:num)', 'AdminController::updateInspector/$1', ["filter" => "adminfilter"]);
$routes->get('deleteMSO/(:num)', 'AdminController::deleteMSO/$1', ["filter" => "adminfilter"]);
$routes->get('deleteTreasurer/(:num)', 'AdminController::deleteTreasurer/$1', ["filter" => "adminfilter"]);
$routes->get('deleteInspector/(:num)', 'AdminController::deleteInspector/$1', ["filter" => "adminfilter"]);
$routes->get('GenerateReport', 'AdminController::generateReport', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'GenerateDetails', 'AdminController::generateReportDetails', ["filter" => "adminfilter"]);
$routes->post('UpdateUser/(:num)', 'AdminController::updateUser/$1', ["filter" => "adminfilter"]);
$routes->get('UserTransaction', 'AdminController::viewtransactionGroup', ["filter" => "adminfilter"]);
$routes->get('Transaction', 'AdminController::viewtransaction', ["filter" => "adminfilter"]);
$routes->get('Dashboard', 'AdminController::dashboard', ["filter" => "adminfilter"]);
$routes->get('TransactionDetails/(:num)/(:num)', 'AdminController::viewtransactiondetails/$1/$2', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'activateMSO/(:num)', 'AdminController::activateMSO/$1', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'deactivateMSO/(:num)', 'AdminController::deactivateMSO/$1', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'activateInspector/(:num)', 'AdminController::activateInspector/$1', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'deactivateInspector/(:num)', 'AdminController::deactivateInspector/$1', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'activateTreasurer/(:num)', 'AdminController::activateTreasurer/$1', ["filter" => "adminfilter"]);
$routes->match(['get', 'post'], 'deactivateTreasurer/(:num)', 'AdminController::deactivateTreasurer/$1', ["filter" => "adminfilter"]);

//MSO Routes
$routes->get("mso", "MSOController::index", ["filter" => "msofilter"]);
$routes->get("ManageProfileMSO", "MSOController::msoprofile", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOUpdatename", "MSOController::changename", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOUpdateusername", "MSOController::changeusername", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOUpdatepassword", "MSOController::changepass", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOUpdatecontact", "MSOController::changecontact", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOSetSched", "MSOController::setsched", ["filter" => "msofilter"]);
$routes->match(['get', 'post'], "MSOUpdateAddress", "MSOController::changeaddress", ["filter" => "msofilter"]);
$routes->post("Setschedule", "MSOController::store", ["filter" => "msofilter"]);
$routes->get("MSOHistory", "MSOController::msohistory", ["filter" => "msofilter"]);
$routes->get("MSOHistoryDetails/(:num)", "MSOController::msohistorydetails/$1", ["filter" => "msofilter"]);
$routes->get("disable_date", "MSOController::disable_date", ["filter" => "msofilter"]);

//Inspector Routes
$routes->get("inspector", "InspectorController::index", ["filter" => "inspectorfilter"]);
$routes->get("ManageProfileInspector", "InspectorController::inspectorprofile", ["filter" => "inspectorfilter"]);
$routes->get("InspectorSchedule", "InspectorController::viewsched", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdatename", "InspectorController::changename", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdateusername", "InspectorController::changeusername", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdatecontact", "InspectorController::changecontact", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdateAddress", "InspectorController::changeaddress", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdatepassword", "InspectorController::changepassword", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "InspectorUpdateSchedule/(:num)/(:num)", "InspectorController::viewscheddetails/$1/$2", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "RejectSched/(:num)/(:num)/(:num)", "InspectorController::rejectsched/$1/$2/$3", ["filter" => "inspectorfilter"]);
$routes->match(['get', 'post'], "AcceptSched/(:num)/(:num)/(:num)", "InspectorController::acceptsched/$1/$2/$3", ["filter" => "inspectorfilter"]);
$routes->get("InspectorHistory", "InspectorController::history", ["filter" => "inspectorfilter"]);
$routes->get("InspectorSchedules", "InspectorController::viewschedDates", ["filter" => "inspectorfilter"]);
$routes->get("InspectorSchedulesperDate", "InspectorController::viewschedperDate", ["filter" => "inspectorfilter"]);
$routes->get("InspectorHistoryUsers", "InspectorController::historyGroup", ["filter" => "inspectorfilter"]);
$routes->get("history_details/(:num)/(:num)", "InspectorController::history_details/$1/$2", ["filter" => "inspectorfilter"]);
$routes->get("InspectorAcceptfirst/(:any)/(:num)/(:any)", "InspectorController::acceptSchedFirst/$1/$2/$3", ["filter" => "inspectorfilter"]);
$routes->get("InspectorRejectfirst/(:any)/(:num)/(:any)", "InspectorController::rejectSchedFirst/$1/$2/$3", ["filter" => "inspectorfilter"]);


//Treasurer Routes
$routes->get("treasurer", "TreasurerController::index", ["filter" => "treasurerfilter"]);
$routes->get("ManageProfileTreasurer", "TreasurerController::treasurerprofile", ["filter" => "treasurerfilter"]);
$routes->get("TreasurerSchedule", "TreasurerController::viewsched", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdatename", "TreasurerController::changename", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdateusername", "TreasurerController::changeusername", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdatecontact", "TreasurerController::changecontact", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdateAddress", "TreasurerController::changeaddress", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdatepassword", "TreasurerController::changepass", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerUpdateSchedule/(:num)/(:num)", "TreasurerController::payment/$1/$2", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "TreasurerPerDate", "TreasurerController::viewschedDate", ["filter" => "treasurerfilter"]);
$routes->match(['get', 'post'], "MarkASPaid", "TreasurerController::markpaid", ["filter" => "treasurerfilter"]);
$routes->get("PaymentHistory", "TreasurerController::paymenthistory", ["filter" => "treasurerfilter"]);
$routes->get("PaymentHistoryDate", "TreasurerController::paymenthistoryDate", ["filter" => "treasurerfilter"]);
$routes->get("PaymentDetails/(:num)", "TreasurerController::paymenthistorydetails/$1", ["filter" => "treasurerfilter"]);
$routes->get("PaymentHistoryAnimals/(:num)/(:num)", "TreasurerController::paymenthistoryanimals/$1/$2", ["filter" => "treasurerfilter"]);

//Login and Forgot Password Routes
$routes->match(['get', 'post'], 'login', 'LoginController::index', ['filter' => 'noauth']);
$routes->match(['get', 'post'], 'loginauth', 'LoginController::loginauthentication');
$routes->match(['get', 'post'], 'homepage', 'HomepageController::index');
$routes->match(['get', 'post'], 'forgotpassword', 'LoginController::forgotpassword');
$routes->match(['get', 'post'], 'updatepasswordforgot/(:any)/(:any)', 'LoginController::updatepassword/$1/$2');
$routes->match(['get', 'post'], 'find/(:any)/(:any)/(:any)/(:any)', 'LoginController::verifycode/$1/$2/$3/$4');


$routes->get('logout', 'LoginController::logout');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
