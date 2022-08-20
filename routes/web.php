<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\TimeSlotController;
use App\Http\Controllers\CustomerController;
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
Route::get('/', function () {
    return view('auth.login');
});


//Route::get('/upload', 'FileUploadController@showUploadForm');
//Route::post('/upload', 'FileUploadController@storeUploads');
Route::get('/upload', [FileUploadController::class, 'showUploadForm']);
Route::post('/upload', [FileUploadController::class, 'storeUploads']);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', [HomeController::class,'index'])->name('home');
    
    //user permissions
    Route::get('/roles', [UserPermissionController::class,'index'])->name('role.index');
    Route::post('/create-role', [UserPermissionController::class,'roleCreate'])->name('role.add');
    Route::get('/role/create', [UserPermissionController::class,'Create'])->name('role.create');
    Route::get('/role/edit/{id}', [UserPermissionController::class,'REdit'])->name('role.edit');
    Route::post('/role/update/{id}', [UserPermissionController::class,'RoleUpdate'])->name('role.update');
    Route::post('/remove/role', [UserPermissionController::class,'RoleRemove']);

    Route::get('/create/user/roles', [UserPermissionController::class,'createUserRole'])->name('user.role.create');
    Route::get('/edit/user/roles/{id}', [UserPermissionController::class,'editUserRole'])->name('user.role.edit');
    Route::post('/update/user/roles/{id}', [UserPermissionController::class,'UpdateUserRole'])->name('user.role.update');


    Route::get('/permission', [UserPermissionController::class,'permissionIndex'])->name('permission.index');
    Route::post('/create-permission', [UserPermissionController::class,'permissionCreate'])->name('permission.add');
    Route::get('/permission/edit{id}', [UserPermissionController::class,'permissionEdit'])->name('permission.edit');
    Route::post('/permission/remove', [UserPermissionController::class,'permissionRemove']);
    Route::post('/permission/update', [UserPermissionController::class,'permissionUpdate'])->name('permission.update');
    Route::post('/remove/user/role', [UserPermissionController::class,'userRoleRemove']);

    Route::get('/give-user-permissions', [UserPermissionController::class,'permissionForUser'])->name('permission.user');
    Route::post('/create-user-role', [UserPermissionController::class,'userRoleCreate'])->name('user.role.add');

    //prescriptions
    Route::get('/prescriptions', [PrescriptionController::class,'index'])->name('prescriptions.index');
    Route::get('/add-prescriptions', [PrescriptionController::class,'create'])->name('prescriptions.add');
    Route::post('/upload-prescriptions', [PrescriptionController::class,'uploadImages'])->name('prescriptions.uploadImages');
    Route::get('/view-prescriptions/{id}', [PrescriptionController::class,'uploadPrescriptionView'])->name('prescriptions.view');

     //prescriptions
     Route::get('/my-prescriptions', [PrescriptionController::class,'cusindex'])->name('prescriptions.cus.index');
     Route::get('/view-my-prescriptions/{id}', [PrescriptionController::class,'myPrescriptionView'])->name('myprescriptions.view');
    

    //drug management
    Route::get('/drug', [DrugController::class,'index'])->name('drug.index');
    Route::post('/drug-save', [DrugController::class,'save'])->name('drug.save');
    Route::post('/drug-status-change', [DrugController::class,'changeStatus']);

    //Time Slot Management
    Route::get('/time-slot', [TimeSlotController::class,'index'])->name('time.index');
    Route::post('/time-save', [TimeSlotController::class,'save'])->name('time.save');
    Route::post('/time-status-change', [TimeSlotController::class,'changeStatus']);
    Route::post('/find/time-slot', [TimeSlotController::class,'findTimeSlot']);

    //quotations
    Route::post('/quotations-process', [QuotationController::class,'process']);
    Route::post('/quotations-send', [QuotationController::class,'send']);
    Route::post('/quotations-reject', [QuotationController::class,'reject']);

    Route::post('/add-delivery', [QuotationController::class,'delivery']);

    Route::post('/notification', [QuotationController::class,'notification']);

    //customer management
    Route::get('/customer', [CustomerController::class,'index'])->name('customer.index');
    Route::post('/customer-change', [CustomerController::class,'change']);
   
});
