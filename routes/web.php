<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ICMPController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| Created Beatific Angel
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/servicestatus', [App\Http\Controllers\ICMPController::class, 'index'])->name('servicestatus');
Route::get('/groupstatus', [App\Http\Controllers\HomeController::class, 'groupstatus'])->name('groupstatus');
Route::get('/getdevicestatus', [App\Http\Controllers\ICMPController::class, 'getstatus'])->name('getstatus');
Route::get('/downdevice', [App\Http\Controllers\HomeController::class, 'downdevice'])->name('downdevice');
Route::get('/logvisit', [App\Http\Controllers\HomeController::class, 'visitlog'])->name('visitlog');
// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

/*  Role Part */
Route::prefix('roles')->name('roles.')->middleware('auth')->group(function(){
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/create', [RoleController::class, 'create'])->name('create');
    Route::post('/store', [RoleController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
    Route::post('/update', [RoleController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
});


/*  Group Part */
Route::prefix('group')->name('group.')->middleware('auth')->group(function(){
    Route::get('/', [GroupController::class, 'index'])->name('index');
    Route::get('/create', [GroupController::class, 'create'])->name('create');
    Route::post('/store', [GroupController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('edit');
    Route::post('/update', [GroupController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [GroupController::class, 'delete'])->name('delete');
});
/*  Device Part */
Route::prefix('device')->name('device.')->middleware('auth')->group(function(){
    Route::get('/', [DeviceController::class, 'index'])->name('index');
    Route::get('/create', [DeviceController::class, 'create'])->name('create');
    Route::post('/store', [DeviceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [DeviceController::class, 'edit'])->name('edit');
    Route::post('/update', [DeviceController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [DeviceController::class, 'delete'])->name('delete');
});

/*  Ticket Part */
Route::prefix('ticket')->name('ticket.')->middleware('auth')->group(function(){
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/create', [TicketController::class, 'create'])->name('create');
    Route::post('/store', [TicketController::class, 'store'])->name('store');
    Route::get('/edit/{ticket_id}', [TicketController::class, 'edit'])->name('edit');
    Route::post('/update', [TicketController::class, 'update'])->name('update');
    Route::get('/close/{ticket_id}', [TicketController::class, 'close'])->name('close');
    Route::get('/delete/{id}', [TicketController::class, 'delete'])->name('delete');
    Route::post('/print_ticket', [TicketController::class, 'print_ticket'])->name('print_ticket');
});
/*  Customer Part */
Route::prefix('customers')->name('customers.')->middleware('auth')->group(function(){
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/store', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::post('/update', [CustomerController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
});
// Users
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
    Route::get('/update/status/{id}/{status}', [UserController::class, 'updateStatus'])->name('status');

});

