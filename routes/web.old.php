<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

/* all routes for front start */

Route::get('/', function () {
    return view('welcome');
});



/* all routes for front end */


/* all routes for admin start */

Route::group([
	'prefix'=>'admin',
	'name'=>'admin.'
], function () {
    
	Route::group(['middleware' => 'guest'], function () {

		Route::get('/', [Controller::class, 'login'])->name('index');
		Route::get('index', [Controller::class, 'login'])->name('index');
		Route::post('login', [Controller::class, 'admin_login'])->name('login');

	});
	
	Route::group(['middleware' => 'auth'], function () {

		Route::get('signout', [Controller::class, 'signOut'])->name('signout');

		Route::get('manage-vendor', [Controller::class, 'index'])->name('manage.vendor');
		Route::get('vendor-list',[Controller::class, 'get_vendors'])->name('vendor.list');
		Route::post('remove-vandor',[Controller::class, 'remove_vandor'])->name('vendor.remove');
		Route::post('add-vandor',[Controller::class, 'add_vendor'])->name('manage_vendor.add');
		Route::get('get-specific-vendor/{id}',[Controller::class, 'get_specific_vendor'])->name('manage_vendor.getvendor');
		Route::post('update-vendor',[Controller::class, 'update_vendor'])->name('manage_vendor.update');

		Route::get('manage-orders', [Controller::class, 'orders'])->name('manage.orders');

		Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');

		Route::get('update-profile',[Controller::class, 'edit_profile'])->name('update-profile');
		Route::post('update-profile',[Controller::class,'update_profile'])->name('update.profile');
		
		Route::get('change-password',[Controller::class, 'get_password'])->name('update-password');
		Route::post('change-password',[Controller::class, 'change_password'])->name('update.password');

	});
});

/* all routes for admin end */