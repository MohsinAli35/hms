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
use App\Http\Controllers\RoleController;

Route::get('/login',[AuthController::class,'login'])->name('login');

Route::post('/login',[AuthController::class,'check'])->name('login.check');


Route::middleware(['auth',MainMiddleware::class])->group(function () {
    // routes after login
    Route::get('/',[MainController::class,'index'])->name('home');
    
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    
    Route::get('/paitents/create',[TokenController::class,'addPatient'])->name('patients.create');
    Route::post('/paitents/store',[TokenController::class,'storePatient'])->name('patients.store');
    Route::get('/paitents',[PatientController::class,'index'])->name('patients.index');
    Route::get('/paitents/view/{patient}',[PatientController::class,'show'])->name('patients.show');
    Route::get('/paitents/view/{patient}/slip',[PatientController::class,'showSlip'])->name('patients.showSlip');

     // search through departement
     Route::get('/paitents/search/department/{id}',[PatientController::class,'departmentSearch'])->name('departmentSearch');
     // search through date from to  
     Route::post('/paitents',[PatientController::class,'dateSearch'])->name('dateSearch');
      
    Route::get('/admin/pages/user/profile/{user}/view',[ProfileController::class,'index'])->name('myprofile');
    Route::put('/admin/pages/user/profile/edit/{user}',[ProfileController::class,'update'])->name('myprofile.update');


    // only admin
    Route::middleware(AdminMiddleware::class)->group(function () {
        
        Route::resource('/departments',DepartmentController::class);
        
        Route::resource('/users', UserController::class);
        
        Route::get('/users/search/{id}',[UserController::class,'searchId']);
        Route::get('/users/search/name/{name}',[UserController::class,'searchName']);
        Route::get('/users/search/role/{role}',[UserController::class,'searchRole']);

        Route::get('/setting',[MainController::class,'setting'])
        ->name('setting');

        Route::get('/paitents/edit/{edit}',[PatientController::class,'edit'])->name('patients.edit');
        Route::delete('/paitents/delete/{patient}',[PatientController::class,'destroy'])->name('patients.destroy');
        Route::put('/paitents/update/{id}',[PatientController::class,'update'])->name('patients.update');
        
        Route::resource('/employees',EmployeeController::class);
        Route::resource('/roles', RoleController::class);
    });

});