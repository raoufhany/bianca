<?php

//use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChangeMenuStatus;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DownloadTableQrCode;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemExtraController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SelectRestaurantController;
use App\Http\Controllers\Admin\TableController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\LoginController;

// Route::get('/run-migrations', function () {
//     return Artisan::call('migrate', ["--force" => true ]);
// });


//Route::get('/testNotification', [FirebaseController::class, 'index'])->name('home');
Route::post('/save-push-notification-token', function () {})->name('save-push-notification-token');
Route::post('/send-push-notification', function () {})->name('send.push-notification');


Route::get('/lite_mode/{color}', function ($color){
    session()->put('lite_mode', $color);
    return redirect()->back();
})->name('lite_mode');

Route::get('/front_language/{locale}', function ($locale){
    App::setLocale($locale);
    session()->put('front_locale', $locale);
    return redirect()->back();
})->name('front_language');

Route::get('/back_language/{locale}', function ($locale){
    App::setLocale($locale);
    session()->put('back_locale', $locale);
    return redirect()->back();
})->name('back_language');

Route::name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'role:Super Admin|Restaurant Owner'])
    ->group(function () {
        Route::post('extras', [ExtraController::class, 'store'])->name('extras.store');
    });


Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'back_language'
    ]
], function () {

//    Route::get('/', function() {
//        return view('admin.auth.login');
//    });
    // Admin Login
    Route::get('/login', [LoginController::class, 'login'])->name('admin_login');
    Route::post('/admin_check_login', [LoginController::class, 'checkLogin'])->name('admin_check_login');
    //Admin Forget Password
//    Route::get('/admin_forget_password', [LoginController::class, 'forgetPassword'])->name('admin_forget_password');
//    Route::post('/admin_forget_password_check', [LoginController::class, 'forgetPasswordCheck'])->name('admin_forget_password_check');

    Route::name('admin.')->middleware(['role:Super Admin'])->group(function () {
        Route::resource('restaurants', RestaurantController::class);
        Route::get('restaurant-select', [SelectRestaurantController::class, 'index'])->name('restaurant-select.index');
        Route::get('restaurant-select/{restaurant}', [SelectRestaurantController::class, 'select'])->name('restaurant-select');
        Route::get('restaurant-unselect', [SelectRestaurantController::class, 'unselect'])->name('restaurant-unselect');
    });

    Route::name('admin.')->middleware(['auth', 'role:Super Admin|Restaurant Owner'])->group( function () {

//    Route::post('/admin_change_password', [LoginController::class, 'changePassword'])->name('admin_change_password');
//    Route::get('/reset_password', [LoginController::class, 'resetPassword'])->name('reset_password');

        //Admin Edit and Logout
//        Route::get('/admin_profile', [LoginController::class, 'edit'])->name('edit_admin_profile');
//        Route::post('/admin_profile', [LoginController::class, 'update'])->name('update_admin_profile');
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin_logout');
        //Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        //User
        Route::resource('menus', MenuController::class);
        Route::get('menus/{menu}/change-status', ChangeMenuStatus::class)->name('menus.change-status');
        Route::resource('categories', CategoryController::class);
        Route::resource('items', ItemController::class);
//        Route::resource('item-extras', ItemExtraController::class);
        Route::resource('tables', TableController::class);
        Route::get('tables/{table}/qr-codes/download', DownloadTableQrCode::class)->name('tables.qr-codes.download');
//        Route::resource('categories', 'CategoryController');
//        Route::post('/change_category_status', 'CategoryController@changeCategoryStatus')->name('category.changeStatus');
//
//        Route::resource('users', 'UserController');
//        Route::post('/change_user_status', 'UserController@changeUserStatus')->name('user.changeStatus');
//
//        Route::resource('orders', 'OrderController');
//
//        Route::resource('families', 'FamilyController');
//
//        //reports
//        Route::get('/reports/products', 'ReportController@products')->name('reports.products');
//        Route::get('/reports/orders', 'ReportController@orders')->name('reports.orders');
//        Route::get('/reports/drivers', 'ReportController@drivers')->name('reports.drivers');
//        Route::get('/reports/users', 'ReportController@users')->name('reports.users');
//        Route::get('/reports/families', 'ReportController@families')->name('reports.families');
//
//        //roles&&admins
//        Route::resource('roles', 'RoleController');
//        Route::resource('admins', 'AdminController');
//
//        //coins
//        Route::resource('coins', 'CoinController');
//        Route::get('download/{id}', 'CoinController@downloadFiles')->name('download');

    });

});
