<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Controller;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\ManageVendorController;
use App\Http\Controllers\Admin\ManageVendorOrderController;
use App\Http\Controllers\Admin\ManageSubAdminController;
use App\Http\Controllers\Admin\ManagePermissionController;
use App\Http\Controllers\Admin\ManageQoutesController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\Admin\ManagePricesController;
use App\Http\Controllers\Admin\ManageDiscountController;
use App\Http\Controllers\Admin\ManageAffiliateController;

use App\Http\Controllers\Front\DigitizingOrderController;
use App\Http\Controllers\Front\ArtworkOrderController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\UserOrderController;
use App\Http\Controllers\Front\UserQuotesController;
use App\Http\Controllers\Front\ManageTicketsController;

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

	/* Route for users */

		Route::get('/', [HomeController::class, 'index'])->name('/');
		Route::get('user-login', [HomeController::class, 'login'])->name('user.login');
		Route::post('user-login', [HomeController::class, 'user_login'])->name('user-login');
        Route::get('user-register', [HomeController::class, 'user_register_view'])->name('user.register');
		Route::post('user-register', [HomeController::class, 'user_register'])->name('user-register');
		Route::get('contact-us',[HomeController::class,'contact_us'])->name('contact-us');
        Route::post('contact-us', [HomeController::class, 'contact'])->name('contact');
		Route::get('/test', [HomeController::class,'send']);
        Route::get('/user/verify/{token}',[HomeController::class,'verifyUser']);

        Route::get('forget-password', [HomeController::class, 'showForgetPasswordForm'])->name('forget.password.get');
        Route::post('forget-password', [HomeController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

        Route::get('reset-password/{token}', [HomeController::class, 'showResetPasswordForm'])->name('reset.password.get');
        Route::post('reset-password', [HomeController::class, 'submitResetPasswordForm'])->name('reset.password.post');

	Route::group(['middleware' => 'userlogin'],function(){

		Route::get('user-dashboard',[HomeController::class,'user_dashboard'])->name('user-dashboard');
        Route::get('logout', [HomeController::class, 'user_logout'])->name('user-logout');

		Route::get('change-user-password', [HomeController::class, 'change_get_user_password'])->name('change-get-user-password');
		Route::post('update-user-password', [HomeController::class, 'change_user_password'])->name('change-user-password');
		Route::get('update-user-profile', [HomeController::class, 'update_user_profile'])->name('update-user-profile');
		Route::post('update-user', [HomeController::class, 'update_user'])->name('update-user');

		Route::get('create-digitizing-order', [DigitizingOrderController::class, 'create_digitizing_order'])->name('create-digitizing-order');
		Route::post('digitizing-order', [DigitizingOrderController::class, 'digitizing_order'])->name('digitizing-order');

        Route::get('create-artwork-order', [ArtworkOrderController::class, 'create_artwork_order'])->name('create-artwork-order');
		Route::post('artwork-order', [ArtworkOrderController::class, 'artwork_order'])->name('artwork-order');
        Route::post('apply-coupon-code',[ArtworkOrderController::class,'apply_coupon_artwork_order'])->name('apply-coupon-code');

        Route::get('pending-order', [UserOrderController::class, 'user_pending_orders'])->name('pending-orders');
        Route::get('inprogress-orders', [UserOrderController::class, 'inprogress_orders'])->name('inprogress-orders');
        Route::get('awaiting-orders', [UserOrderController::class, 'awaiting_orders'])->name('awaiting-orders');
        Route::get('completed-orders', [UserOrderController::class, 'completed_orders'])->name('completed-orders');
        Route::get('user-order-details/{id}',[UserOrderController::class, 'user_order_details'])->name('user-order-details');
        Route::post('order-status',[UserOrderController::class, 'orders_status'])->name('order-status');

        Route::get('quotes',[UserQuotesController::class,'user_qoutes'])->name('qoutes');
        Route::get('create-qoute',[UserQuotesController::class,'create_quote'])->name('create-qoute');
        Route::get('qoute-details/{id}',[UserQuotesController::class, 'qoute_details'])->name('qoute-details');
		Route::get('download-qoute/{id}', [UserQuotesController::class,'download_qoute_file']);

		Route::post('digitizing-qoute', [UserQuotesController::class, 'digitizing_qoute'])->name('digitizing-qoute');
		Route::post('artwork-qoute', [UserQuotesController::class, 'artwork_qoute'])->name('artwork-qoute');

        Route::get('create-tickets',[ManageTicketsController::class, 'tickets_create'])->name('create.tickets');
        Route::post('create-ticket',[ManageTicketsController::class, 'create_ticket'])->name('create-ticket');
        Route::get('manage-tickets-details/{id}',[ManageTicketsController::class, 'manage_tickets_details'])->name('manage-tickets-details');
        Route::get('download-file/{id}', [ManageTicketsController::class,'downloadfile']);
        Route::get('manage-tickets',[ManageTicketsController::class, 'manage_tickets'])->name('manage-tickets');

        Route::get('open-ticket',[ManageTicketsController::class, 'open_ticket'])->name('open-ticket');
        Route::get('close-ticket',[ManageTicketsController::class, 'close_ticket'])->name('close-ticket');
        Route::post('user-ticket-update', [ManageTicketsController::class, 'user_ticket_update'])->name('user-ticket-update');
        Route::post('complete-ticket-user/{id}',[ManageTicketsController::class, 'user_ticket_close']);
    });

	/* End of user route */

    /* Route for admin */

		Route::get('admin', [Controller::class, 'login'])->name('admin');
		Route::post('login', [Controller::class, 'admin_login'])->name('login');

        Route::get('admin-forgot-password', [Controller::class, 'showAdminForgetPasswordForm'])->name('forget.password.admin.get');
        Route::post('admin-forgot-password', [Controller::class, 'submitAdminForgetPasswordForm'])->name('forget.password.admin.post');
        Route::get('admin-reset-password/{token}', [Controller::class, 'showAdminResetPasswordForm'])->name('reset.password.admin.get');
        Route::post('admin-reset-password', [Controller::class, 'submitAdminResetPasswordForm'])->name('reset.password.admin.post');

	Route::group(['prefix' => '/admin', 'middleware' => ['auth','rolecheck']],function(){

		Route::get('signout', [Controller::class, 'signout'])->name('signout');
        Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');

        Route::get('update-profile',[Controller::class, 'edit_profile'])->name('update-profile');
		Route::post('save-update-profile',[Controller::class,'update_profile'])->name('save-update-profile');

		Route::get('change-password',[Controller::class, 'get_password'])->name('update-password');
		Route::post('save-change-password',[Controller::class, 'change_password'])->name('save-change-password');

		Route::get('manage-vendor',[ManageVendorController::class, 'index'])->name('manage-vendor');
        Route::get('get-vendors',[ManageVendorController::class, 'get_vendors'])->name('get-vendors');
        Route::post('update-vendor',[ManageVendorController::class, 'update_vendor'])->name('update-vendor');
        Route::post('vendor-status',[ManageVendorController::class,'vendor_status'])->name('vendor-status');
        Route::post('add-vandor',[ManageVendorController::class, 'add_vendor'])->name('add-vendor');
        Route::post('remove-vandor',[ManageVendorController::class, 'remove_vandor'])->name('remove-vendor');
        Route::get('get-specific-vendor/{id}',[ManageVendorController::class, 'get_specific_vendor'])->name('get-vendor-details');
        Route::post('reset-vendor-password',[ManageVendorController::class,'reset_vendor_password'])->name('reset-vendor-password');

		Route::get('manage-orders',[ManageOrderController::class, 'index'])->name('manage-order');
		Route::get('get-pending-orders',[ManageOrderController::class, 'pending_orders'])->name('get-pending-order');
		Route::get('get-inprogress-ordder',[ManageOrderController::class, 'in_progress_orders'])->name('get-inprogress-order');
        Route::get('get-approval-order',[ManageOrderController::class, 'manage_approval_order'])->name('get-approval-order');
        Route::get('get-complete-order',[ManageOrderController::class, 'manage_complete_order'])->name('get-complete-order');
        Route::get('view-order-details/{id}',[ManageOrderController::class, 'get_orders_details'])->name('get-order-details');
        Route::post('assign-order-vendor',[ManageOrderController::class, 'assign_order_vendor'])->name('assign-order-vendor');
		Route::post('search-vendor',[ManageOrderController::class, 'search_vendors'])->name('search-vendor');
        Route::post('vendor-order-transfer',[ManageOrderController::class,'vendor_order_transfer'])->name('vendor-order-transfer');

        Route::get('manage-vendor-order',[ManageVendorOrderController::class, 'index'])->name('manage-vendor-order');
		Route::get('get-vendor-pending-order',[ManageVendorOrderController::class, 'vendor_pending_order'])->name('get-vendor-pending-order');
        Route::get('get-vendor-approval-order',[ManageVendorOrderController::class, 'vendor_approval_order'])->name('get-vendor-approval-order');
        Route::get('get-vendor-completed-order',[ManageVendorOrderController::class, 'vendor_complete_order'])->name('get-vendor-completed-order');
		Route::get('get-vendor-order-details/{id}',[ManageVendorOrderController::class, 'vendor_order_details'])->name('get-vendor-order-details');
        Route::post('submit-work',[ManageVendorOrderController::class,'submit_work'])->name('submit-work');
        Route::get('download-file/{id}', [ManageVendorOrderController::class,'downloadfile']);

        Route::get('manage-sub-admin', [ManageSubAdminController::class,'sub_admin'])->name('manage-sub-admin');
        Route::post('add-sub-admin',[ManageSubAdminController::class, 'add_sub_admin'])->name('add-sub-admin');
        Route::post('update-sub-admin',[ManageSubAdminController::class, 'update_sub_admin'])->name('update-sub-admin');
        Route::post('remove-sub-admin',[ManageSubAdminController::class, 'remove_sub_admin'])->name('remove-sub-admin');
        Route::post('sub-admin-status',[ManageSubAdminController::class,'sub_admin_status'])->name('sub-admin-status');
        Route::post('reset-password',[ManageSubAdminController::class,'reset_password'])->name('reset-password');

        Route::get('manage-permission',[ManagePermissionController::class,'manage_permission'])->name('manage-permission');
        Route::post('manage-permission-status',[ManagePermissionController::class,'manage_permission_update'])->name('manage-permission-status');

        Route::get('manage-qoutes', [ManageQoutesController::class,'index'])->name('manage-qoutes');
        Route::get('pending-qoutes', [ManageQoutesController::class,'pending_qoutes'])->name('pending-qoutes');
		Route::get('completed-qoutes', [ManageQoutesController::class,'completed_qoutes'])->name('completed-qoutes');
        Route::get('qoute-details/{id}',[ManageQoutesController::class, 'qoute_details'])->name('qoute-details');
        Route::get('download-qoute/{id}', [ManageQoutesController::class,'download_file']);

		Route::get('manage-ticket', [TicketsController::class,'index'])->name('manage-ticket');
        Route::get('open-tickets', [TicketsController::class,'open_tickets'])->name('open-tickets');
		Route::get('close-tickets', [TicketsController::class,'close_tickets'])->name('close-tickets');
        Route::get('ticket-details/{id}',[TicketsController::class, 'ticket_details'])->name('ticket-details');
        Route::get('download-ticket-file/{id}',[TicketsController::class, 'download_ticket_file'])->name('download-ticket-file');
        Route::post('ticket-update',[TicketsController::class, 'ticket_update'])->name('ticket-update');
        Route::post('complete-ticket/{id}',[TicketsController::class, 'ticket_close'])->name('complete-ticket');

		Route::get('manage-prices', [ManagePricesController::class,'index'])->name('manage-prices');
		Route::post('vectorizing-price',[ManagePricesController::class,'vectorizing_price'])->name('vectorizing-price');
		Route::post('digitizing-price',[ManagePricesController::class,'digitizing_price'])->name('digitizing-price');

		Route::get('manage-discount',[ManageDiscountController::class,'index'])->name('manage-discount');
		Route::get('get-coupon',[ManageDiscountController::class,'get_coupons'])->name('get-coupon');
		Route::post('add-coupon',[ManageDiscountController::class,'add_coupon'])->name('add-coupon');
		Route::post('update-coupon',[ManageDiscountController::class, 'update_coupon'])->name('update-coupon');
		Route::get('get-specific-coupon/{id}',[ManageDiscountController::class, 'get_specific_coupon'])->name('get-coupon-details');
        Route::post('remove-coupon',[ManageDiscountController::class, 'remove_coupon'])->name('remove-coupon');

        Route::get('manage-affiliate',[ManageAffiliateController::class,'index'])->name('manage-affiliate');
        Route::get('get-affiliate',[ManageAffiliateController::class, 'get_affiliate'])->name('get-affiliate');
        Route::post('add-affiliate',[ManageAffiliateController::class, 'add_affiliate'])->name('add-affiliate');
        Route::get('get-specific-affiliate/{id}',[ManageAffiliateController::class, 'get_specific_affiliate'])->name('get-affiliate-details');
        Route::post('update-affiliate',[ManageAffiliateController::class, 'update_affiliate'])->name('update-affiliate');
        Route::post('remove-affiliate',[ManageAffiliateController::class, 'remove_affiliate'])->name('remove-affiliate');

    /* Route for admin end */

});


