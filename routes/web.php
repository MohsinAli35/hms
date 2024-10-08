<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\MainMiddleware;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;


Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login',[AuthController::class,'check'])->name('login.check');

Route::get('/pdf-generate',[pdfController::class , 'index'])->name('pdf.generate');


Route::middleware(['auth',MainMiddleware::class])->group(function () {
    // routes after login
    Route::get('/',[MainController::class,'index'])->name('home');
    // Route::get('/expired', function () {
    //     return view('expired');
    // });
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    
    Route::get('/paitents/create',[TokenController::class,'addPatient'])->name('patients.create');
    Route::post('/paitents/store',[TokenController::class,'storePatient'])->name('patients.store');
    Route::get('/paitents',[PatientController::class,'index'])->name('patients.index');
    Route::get('/paitent',[PatientController::class,'reportindex'])->name('report-patient.index');
    Route::get('/paitents/view/{patient}',[PatientController::class,'show'])->name('patients.show');
    Route::get('/paitents/view/{patient}/slip',[PatientController::class,'showSlip'])->name('patients.showSlip');
    


     // search through departement
     Route::get('/paitents/search/department/{id}',[PatientController::class,'departmentSearch'])->name('departmentSearch');
     // search through date from to  
     //  search for Patients 
 
     Route::get('/patients-search',[PatientController::class,'patientsearch'])->name('search.patient');
     Route::get('/paitent-search',[PatientController::class,'dateSearch'])->name('dateSearch');
      
    Route::get('/admin/pages/user/profile/{user}/view',[ProfileController::class,'index'])->name('myprofile');
    Route::put('/admin/pages/user/profile/edit/{user}',[ProfileController::class,'update'])->name('myprofile.update');


    
});
    // only admin
Route::middleware(['auth',AdminMiddleware::class])->group(function () {
    
    Route::resource('/departments',DepartmentController::class);

    
    Route::resource('/users', UserController::class);
    
    Route::get('/users/search/{id}',[UserController::class,'searchId']);
    Route::get('/users/search/name/{name}',[UserController::class,'searchName']);
    Route::get('/users/search/role/{role}',[UserController::class,'searchRole']);

    // Route::get('/setting',[MainController::class,'setting'])
    // ->name('setting');

    Route::get('/paitents/edit/{edit}',[PatientController::class,'edit'])->name('patients.edit');
    Route::delete('/paitents/delete/{patient}',[PatientController::class,'destroy'])->name('patients.destroy');
    Route::put('/paitents/update/{id}',[PatientController::class,'update'])->name('patients.update');
    
    Route::resource('/employees',EmployeeController::class);
    Route::resource('/roles', RoleController::class);
    //  Route For Pdf files

    Route::get('/download-pdf', [PatientController::class,'downloadPdf'])->name('downloadPDF');
    Route::get('/daily-record-pdf', [PatientController::class,'dailypdf'])->name('daily.pdf');
    Route::get('/department-daily-pdf', [PatientController::class,'dailydepartpdf'])->name('dailydepart.pdf');
    Route::get('/summary-pdf', [PatientController::class,'summarypdf'])->name('summary.pdf');

    //   Route  for GETting EXCEL FILES 

    Route::get('/downloadExcel', [PatientController::class,'downloadExcel'])->name('downloadExcel');
    Route::get('/daily-record-excel', [PatientController::class,'dailyexcel'])->name('daily.excel');
    Route::get('/department-daily-excel', [PatientController::class,'dailydepartexcel'])->name('dailydepart.excel');
    Route::get('/summary-depart-excel', [PatientController::class,'summaryexcel'])->name('summary.excel');
    Route::get('/export-employees', [EmployeeController::class,'employeesexcel'])->name('empexcel');
    //  Route for Getting prints 

    Route::get('/patients/print', [PatientController::class, 'printFilteredData'])->name('patients.print');
    Route::get('/daily-record-print', [PatientController::class, 'dailyprint'])->name('daily.print');
    Route::get('/depart-daily-print', [PatientController::class, 'dailydepartprint'])->name('dailydepart.print');
    Route::get('/summary-depart-print', [PatientController::class, 'summaryprint'])->name('summary.print');

    Route::get('/patients/daily-report' ,[PatientController::class,'dailyreport'])->name('daily.report');
    Route::get('/patients/daily-depart-report' ,[PatientController::class,'dailydepartReport'])->name('dailydepart.report');
    Route::get('/patients/depart-summary' ,[PatientController::class,'departsummary'])->name('dailydepartsummary.report');
    Route::resource('/settings',SettingController::class);
});