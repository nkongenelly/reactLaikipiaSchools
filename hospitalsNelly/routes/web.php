<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HospitalsController@main');

Route::get('/webservice', 'HospitalsController@webservice');

Route::post('/getChat', 'HospitalsController@getChat');

Route::post('/registerBusiness', 'HospitalsController@registerBusiness');

//PAtients 

Route::get('/patients', 'PatientsController@patients');

Route::post('/savePatients', 'PatientsController@save');

Route::post('/saveVisits', 'PatientsController@saveVisits');

Route::get('/getAllPatients', 'PatientsController@gets');

Route::get('/getSinglePatient/{patient}', 'PatientsController@getSingle');

Route::post('/updatePatients', 'PatientsController@update');

Route::get('/deletePatient/{patient_id}', 'PatientsController@delete');


//for Services Tab

Route::get('/services', 'ServicesController@services');

Route::get('/servicename/{visit_id}', 'ServicesController@servicename');

Route::get('/servicenames/{service_id}', 'ServicesController@servicenames');

Route::get('/getAllServices', 'ServicesController@getServices');

Route::post('/saveServices', 'ServicesController@saveServices');

Route::get('/getSingleService/{service}', 'ServicesController@getSingle');

Route::post('/updateServices', 'ServicesController@update');

Route::get('/deleteService/{service_id}', 'ServicesController@delete');

//for Visits Tab

Route::get('/visits', 'VisitsController@visits');

Route::get('/getAllVisits', 'VisitsController@getVisits');

Route::post('/saveBills', 'VisitsController@saveBills');

Route::post('/saveBills1', 'VisitsController@saveBills1');

Route::get('/getSingleVisit/{visit_id}', 'VisitsController@getSingle');

Route::post('/updateVisits', 'VisitsController@update');

Route::get('/deleteVisits/{visit_id}', 'VisitsController@delete');

//for Visitservices Tab

Route::get('/bills', 'VisitservicesController@bills');

Route::get('/getAllBills', 'VisitservicesController@getAllBills');

Route::get('/getSingleBill/{visitservice_id}', 'VisitservicesController@getSingleBill');

Route::post('/updateBill', 'VisitservicesController@updateBill');

Route::get('/deleteBill/{visitservice_id}', 'VisitservicesController@delete');   

//Time Reports

Route::get('/time', 'VisitservicesController@time');

Route::get('/getTimeReports', 'VisitservicesController@getTimeReports');

Route::get('/revenue', 'VisitservicesController@revenue');

Route::get('/getRevenueReports', 'VisitservicesController@getRevenueReports');

//mawingu

//Route::get('/searchCustomer', 'MawingusController"searchCustomer');
Route::get('/mawingu', 'MawingusController@dynamics')->name('kaizala.mawingu');
Route::post('/searchCustomer', 'HospitalsController@searchByName', ['middleware' => ['cors']]);

