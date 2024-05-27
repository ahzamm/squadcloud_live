<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\FrontClientController;
use App\Http\Controllers\Frontend\FrontPortfolioController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\Frontend\FrontServiceController;
use App\Http\Controllers\Frontend\CheckoutController;








use App\Http\Controllers\Admin\FrontMenuController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\HomeVideoController;
use App\Http\Controllers\Admin\MenusController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\SlideritemController as AdminSlideritemController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\UserMenuAccessController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\PopUpController;
use App\Http\Controllers\Admin\HomeSideMenuController;

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
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

// Route::get('/', function () {
//     return view('welcome');
// });

    // $menus = DB::table('menus')->where('status', 1)->get();
    // dd($menus);
    // $controller = '';




//Route for Frontend
Route::get('/',[HomeController::class, 'maintenance']);
Route::get('/index',[HomeController::class, 'index']);
Route::get('/about',[AboutUsController::class, 'index']);
Route::get('/contact',[ContactUsController::class, 'index']);
Route::get('/client',[FrontClientController::class, 'index']);
Route::get('/portfolio',[FrontPortfolioController::class, 'index']);
Route::get('/product',[FrontProductController::class, 'index']);
Route::get('/product_detail/{id}',[FrontProductController::class, 'ProductDetail']);
Route::get('/service_detail/{id}',[FrontServiceController::class, 'ServiceDetail']);
Route::get('/services',[FrontServiceController::class, 'index']);


Route::get('/checkout/{id}',[CheckOutController::class, 'create']);
Route::post('/submitcheckout',[CheckOutController::class, 'store']);
// foreach ($menus as $key => $item) {
//     // $controller = $item->link;
//     Route::get($item->link,[FrontServiceController::class, 'index']);
// }

Route::prefix('admin')->group(function () {
    Route::get('/','Admin\AuthController@showLoginForm')->name('admin.login');
    Route::post('/login','Admin\AuthController@login')->name('admin.login.post')->middleware('guest:admin');

    Route::middleware('auth:admin')->group(function () {
    Route::post('/passwordchange','Admin\AuthController@changePassword')->name('admin.change.password');
    Route::get('/dashboard','Admin\HomeController@dashboard')->name('admin.dashboard');
    Route::post('/logout','Admin\AuthController@logout')->name('admin.logout');
    Route::resource('allowedip','Admin\AllowedIpController');
    Route::get('maintenance','Admin\MaintenanceController@index')->name('maintenance.index');
    Route::post('maintenance/store','Admin\MaintenanceController@store')->name('maintenance.store');
    Route::get('maintenance/deactivate','Admin\MaintenanceController@deactivate')->name('maintenance.deactivate');
    Route::get('front-faqs/sort','Admin\FrontFaqController@sort')->name('faqs.sort');
    Route::post('front-faqs/sort','Admin\FrontFaqController@sortPost')->name('faqs.sort');
    Route::post('front-faqs/destroy/{id?}','Admin\FrontFaqController@destroy')->name('faq.destroy');
    Route::resource('front-faqs','Admin\FrontFaqController');
    Route::resource('employee','Admin\EmployeeController');
    Route::get('front-contact','Admin\FrontContactController@index')->name('contact.index');
    Route::delete('front-contact/{id}','Admin\FrontContactController@destroy')->name('contact.delete');
    Route::get('front-emails/edit','Admin\FrontContactController@editEmail');
    Route::post('front-emails/edit','Admin\FrontContactController@updateEmail');
    Route::resource('homeslider','Admin\HomeSliderController');
    Route::get("slider/edit/{id?}" , [HomeSliderController::class , 'edit'])->name('edit.slider');
    Route::Post("slider/delete/{id?}" , [HomeSliderController::class , 'destroy'])->name('destroy.slider');
    Route::resource('reseller','Admin\ResellerController');
    Route::resource('whychoose','Admin\WhyChooseusController');
    Route::resource('logo','Admin\FrontLogoController');

    Route::resource('aboutus','Admin\AboutUsController');
    Route::resource('message','Admin\MessageController');
    Route::resource('frontmenu','Admin\FrontMenuController');
    Route::get('frontmenu/edit/{id?}', [FrontMenuController::class , 'edit'])->name('front.edit');


    Route::resource('cities','Admin\CitiesController');
    Route::resource('coreareas','Admin\CoreAreaController');
    Route::resource('zoneareas','Admin\ZoneAreaController');

    Route::get('partner-emails/{flag}','Admin\CitiesController@partnerEmail');
    Route::post('partner-emails','Admin\CitiesController@updateEmail');
    Route::get('coveragerequest', 'Admin\CoverageRequestController@index')->name('coveragerequest.index');
    Route::get('/coveragerequest/{id}', 'Admin\CoverageRequestController@showUserDetails')->name('coveragerequest.show');
    Route::get('coverage/destroy/{id?}', 'Admin\CoverageRequestController@destroy')->name('coveragerequest.destroy');

    //Menus and Sub Menus Route -- Only Admin Access
    Route::get('menus/create', 'Admin\MenusController@create')->name('menus.create');
    Route::post('menus/create', 'Admin\MenusController@store')->name('menus.store');
    Route::get('menus/index', 'Admin\MenusController@index')->name('menus.index');
    Route::get('menus/sort', 'Admin\MenusController@sort')->name('menus.sort');
    Route::post('menus/sort', 'Admin\MenusController@sortPost')->name('menus.sortpost');
    Route::get('menu/edit/{id?}', [MenusController::class , 'edit'])->name('menu.edit');

    // Route::get('menus/show/{id}', 'Admin\MenusController@show')->name('menus.show');
    Route::get('menus/update/{id}', 'Admin\MenusController@edit')->name('menus.edit');
    Route::post('menus/update/{id}', 'Admin\MenusController@update')->name('menus.update');
    Route::post('menus/delete/{id}', 'Admin\MenusController@destroy')->name('menus.delete');
    Route::post('menus/checkroute', 'Admin\MenusController@checkroute')->name('menus.checkroute');
    Route::post('submenus/delete', 'Admin\MenusController@subMenuDelete')->name('submenus.delete');

    //User Menu Access
    // Route::get('useraccess/index', 'Admin\UserMenuAccessController@index')->name('useraccess.index');
    Route::get('useraccess/show/{id}', 'Admin\EmployeeController@showAccess')->name('useraccess.show');
    Route::post('useraccess/update/{id}', 'Admin\EmployeeController@updateAccess')->name('useraccess.update');

    //Packages
    Route::resource('packages','Admin\PackagesController');
    Route::get("/packages/destroy/{id?}" , [PackagesController::class ,"destroy"])->name("package.destroy");
    // Sorting Table Routes

    Route::post("sortFrontMenu" , [FrontMenuController::class , 'updateSorting'])->name("sort.front.menu");
    Route::post("sortMenu" , [MenusController::class , 'sortMenu'])->name("sort.menu");
    Route::post("sortSlider" , [HomeSliderController::class , 'sortSlider'])->name("sort.slider.image");
    // Social Links Routes
    Route::get('/social/' , [SocialController::class , 'index'])->name('social.index');
    Route::get('/social/create' , [SocialController::class , 'create'])->name('social.create');
    Route::get('/social/edit/{id?}' , [SocialController::class , 'edit'])->name('social.edit');
    Route::post('/social/store' , [SocialController::class , 'store'])->name('social.store');
    Route::post('/social/update/{id?}' , [SocialController::class , 'update'])->name('social.update');
    Route::get('/social/destroy/{id?}' , [SocialController::class , 'destroy'])->name('social.destroy');
    // Contact Section Data Started
    Route::get('/contact/' , [ContactController::class ,'index'])->name('contact.index');
    Route::get('/contactrequest/{id}', [ContactController::class,'showFrontContact'])->name('frontcontactrequest.show');

    // User Managment Section
    Route::get('/user/' , [UserMenuAccessController::class ,'index'])->name('user.index');
    Route::get('/user/create' , [UserMenuAccessController::class ,'create'])->name('user.create');
    Route::get('/user/edit/{id?}' , [UserMenuAccessController::class ,'edit'])->name('user.edit');
    Route::get('/user/menu_access' , [UserMenuAccessController::class ,'menu_access'])->name('user.access');
    Route::post('/user/store' , [UserMenuAccessController::class ,'store'])->name('user.store');
    Route::post('/user/update/{id?}' , [UserMenuAccessController::class ,'update'])->name('user.update');
    Route::post('/user/change/status' , [UserMenuAccessController::class , 'change_status'])->name("user.status.change");
    Route::get('/user/destroy/{id?}' , [UserMenuAccessController::class , 'destroy'])->name("user.destroy");
    // Access Managing System
    Route::get('/user/access/{id?}' , [UserMenuAccessController::class ,'menuAccess'])->name('user.menu.access');
    Route::post('/user/giveaccess/{id?}' , [UserMenuAccessController::class ,'giveAccess'])->name('menu.give.access');

    // Pop up
    Route::get("popup" , [PopUpController::class, 'index'])->name("popup.index");
    Route::get("popup/create" , [PopUpController::class, 'create'])->name("popup.create");
    Route::get('/popup/edit/{id?}' , [PopUpController::class ,'edit'])->name('popup.edit');
    Route::post('/popup/store' , [PopUpController::class ,'store'])->name('popup.store');
    Route::post('/popup/update/{id?}' , [PopUpController::class ,'update'])->name('popup.update');
    Route::get('/popup/delete/{id?}' , [PopUpController::class ,'destroy'])->name('popup.destroy');
    Route::post('/popup/change_status/{id?}' , [PopUpController::class ,'change_status'])->name('popup.status');
    // Home Side Menu
    Route::get("homeside" , [HomeSideMenuController::class, 'index'])->name("homeside.index");
    Route::get("homeside/create" , [HomeSideMenuController::class, 'create'])->name("homeside.create");
    Route::get('/homeside/edit/{id?}' , [HomeSideMenuController::class ,'edit'])->name('homeside.edit');
    Route::post('/homeside/store' , [HomeSideMenuController::class ,'store'])->name('homeside.store');
    Route::post('/homeside/update/{id?}' , [HomeSideMenuController::class ,'update'])->name('homeside.update');
    Route::get('/homeside/delete/{id?}' , [HomeSideMenuController::class ,'destroy'])->name('homeside.destroy');
    Route::post('/homeside/change_status/{id?}' , [HomeSideMenuController::class ,'change_status'])->name('homeside.status');
    // Email Routes
    Route::get('/email/' , [EmailController::class ,'index'])->name('email.index');
    Route::get('/email/create' , [EmailController::class ,'create'])->name('email.create');
    Route::get('/email/edit/{id?}' , [EmailController::class ,'edit'])->name('email.edit');
    Route::post('/email/store' , [EmailController::class ,'store'])->name('email.store');
    Route::post('/email/update/{id?}' , [EmailController::class ,'update'])->name('email.update');
    Route::get('/email/delete/{id?}' , [EmailController::class ,'destroy'])->name('email.destroy');
    Route::post('/email/change_status/{id?}' , [EmailController::class ,'change_status'])->name('email.status');


     //Header Video
     Route::get('/videoheader' , [HomeVideoController::class ,'index'])->name('video.index');

     Route::get('/videoheader/create' , [HomeVideoController::class ,'create'])->name('homevideo.create');
     Route::post('/videoheader/create' , [HomeVideoController::class ,'store'])->name('homevideo.store');

     Route::get('/videoheader/{id}', [HomeVideoController::class, 'edit'])->name('homevideo.edit');
     Route::post('/videoheader/update', [HomeVideoController::class, 'update'])->name('homevideo.update');

     Route::Post('/videoheader/delete/{id?}', [HomeVideoController::class, 'destroy'])->name('homevideo.destroy');




    //  Services Routes
    Route::get('/services',[AdminServiceController::class, 'index'])->name('admin.services');
    Route::get('/service/create',[AdminServiceController::class, 'showCreateServiceForm'])->name('service.create');
    Route::post('/service/create',[AdminServiceController::class, 'createService'])->name('service.create.post');
    Route::get("/service/destroy/{id?}" , [AdminServiceController::class ,"deleteService"])->name("service.destroy");
    Route::get('/services/{id}/edit',[AdminServiceController::class, 'showEditServiceForm'])->name('service.edit');
    Route::post('/service/edit',[AdminServiceController::class, 'editService'])->name('service.edit.post');


    Route::resource('portfolios','Admin\PortfolioController');
    Route::get("/portfolios/destroy/{id?}" , [AdminPortfolioController::class ,"destroy"])->name("portfolio.destroy");

    Route::resource('products','Admin\ProductController');
    Route::get("/products/destroy/{id?}" , [AdminProductController::class ,"destroy"])->name("product.destroy");

    Route::resource('clients','Admin\ClientController');
    Route::get("/clients/destroy/{id?}" , [AdminClientController::class ,"destroy"])->name("client.destroy");

    Route::resource('abouts','Admin\AboutController');
    Route::get("/abouts/destroy/{id?}" , [AdminAboutController::class ,"destroy"])->name("about.destroy");

    Route::resource('contacts','Admin\ContactController');
    Route::get("/contact/destroy/{id?}" , [AdminContactController::class ,"destroy"])->name("contact.destroy");
    Route::get("/contact/message-requests" , [AdminContactController::class ,"messageRequest"])->name("contacts.message_request");

    Route::resource('slideritems','Admin\SlideritemController');
    Route::get("/slideritem/destroy/{id?}" , [AdminSlideritemController::class ,"destroy"])->name("slideritem.destroy");

});
});
