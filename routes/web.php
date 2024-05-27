<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\FrontClientController;
use App\Http\Controllers\Frontend\FrontPortfolioController;
use App\Http\Controllers\Frontend\FrontProductController;
use App\Http\Controllers\Frontend\FrontServiceController;
use App\Http\Controllers\Frontend\CheckoutController;




use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\ServicesController;
use App\Http\Controllers\Backend\ServicePageController;
use App\Http\Controllers\Backend\InnerServiceController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\ClientController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\InnerPageSettingController;
use App\Http\Controllers\Backend\HeaderController;
use App\Http\Controllers\Backend\FeatureController;
use App\Http\Controllers\Backend\RatingController;
use App\Http\Controllers\Backend\GeneralConfigurationController;
use App\Http\Controllers\Backend\ProductClassController;
use App\Http\Controllers\Backend\ServiceDetailController;

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


// routes for login
Route::get('admin',[AdminController::class, 'index']);
Route::post('admin/auth',[AdminController::class, 'auth'])->name('admin.auth');
//Route::get('admin/encryptpassword',[AdminController::class, 'encryptpassword']);
Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('admin/dashboard',[AdminController::class, 'dashboard']);
    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('msg', 'Logout Successfully');
        return redirect('admin');
    });

    // routes for menu
    Route::get('admin/menu',[MenuController::class, 'index']);
    Route::get('admin/menu/manage_menu',[MenuController::class, 'manage_menu']);
    Route::get('admin/menu/manage_menu/{id}',[MenuController::class, 'manage_menu']);
    Route::post('admin/menu/manage_menu_process',[MenuController::class, 'manage_menu_process'])->name('menu.manage_menu_process');
    Route::get('admin/menu/status/{status}/{id}',[MenuController::class, 'status']);
    Route::get('admin/menu/delete/{id}',[MenuController::class, 'delete']);

    // routes for General Configuration
    Route::get('admin/general_configuration',[GeneralConfigurationController::class, 'index']);
    Route::get('admin/general_configuration/manage_general_configuration',[GeneralConfigurationController::class, 'manage_general_configuration']);
    Route::get('admin/general_configuration/manage_general_configuration/{id}',[GeneralConfigurationController::class, 'manage_general_configuration']);
    Route::post('admin/general_configuration/manage_general_configuration_process',[GeneralConfigurationController::class, 'manage_general_configuration_process'])->name('general_configuration.manage_general_configuration_process');
    Route::get('admin/general_configuration/status/{status}/{id}',[GeneralConfigurationController::class, 'status']);
    Route::get('admin/general_configuration/delete/{id}',[GeneralConfigurationController::class, 'delete']);

    // routes for services page
    Route::get('admin/services',[ServicesController::class, 'index']);
    Route::get('admin/services/manage_services',[ServicesController::class, 'manage_services']);
    Route::get('admin/services/manage_services/{id}',[ServicesController::class, 'manage_services']);
    Route::post('admin/services/manage_menu_services',[ServicesController::class, 'manage_services_process'])->name('services.manage_services_process');
    Route::get('admin/services/status/{status}/{id}',[ServicesController::class, 'status']);
    Route::get('admin/services/delete/{id}',[ServicesController::class, 'delete']);

    // routes for servicepage
    Route::get('admin/servicepage',[ServicePageController::class, 'index']);
    Route::get('admin/servicepage/manage_servicepage',[ServicePageController::class, 'manage_servicepage']);
    Route::get('admin/servicepage/manage_servicepage/{id}',[ServicePageController::class, 'manage_servicepage']);
    Route::post('admin/servicepage/manage_servicepage_process',[ServicePageController::class, 'manage_servicepage_process'])->name('servicepage.manage_servicepage_process');
    Route::get('admin/servicepage/status/{status}/{id}',[ServicePageController::class, 'status']);
    Route::get('admin/servicepage/delete/{id}',[ServicePageController::class, 'delete']);

    // routes for innerservice
    Route::get('admin/innerservice',[InnerServiceController::class, 'index']);
    Route::get('admin/innerservice/manage_innerservice',[InnerServiceController::class, 'manage_innerservice']);
    Route::get('admin/innerservice/manage_innerservice/{id}',[InnerServiceController::class, 'manage_innerservice']);
    Route::post('admin/innerservice/manage_innerservice_process',[InnerServiceController::class, 'manage_innerservice_process'])->name('innerservice.manage_innerservice_process');
    Route::get('admin/innerservice/status/{status}/{id}',[InnerServiceController::class, 'status']);
    Route::get('admin/innerservice/delete/{id}',[InnerServiceController::class, 'delete']);

    // routes for product
    Route::get('admin/product',[ProductController::class, 'index']);
    Route:: get('admin/product/manage_product',[ProductController::class, 'manage_product']);
    Route::get('admin/product/manage_product/{id}',[ProductController::class, 'manage_product']);
    Route::post('admin/product/manage_product_process',[ProductController::class, 'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/status/{status}/{id}',[ProductController::class, 'status']);
    Route::get('admin/product/delete/{id}',[ProductController::class, 'delete']);

    // routes for portfolio
    Route::get('admin/portfolio',[PortfolioController::class, 'index']);
    Route:: get('admin/portfolio/manage_portfolio',[PortfolioController::class, 'manage_portfolio']);
    Route::get('admin/portfolio/manage_portfolio/{id}',[PortfolioController::class, 'manage_portfolio']);
    Route::post('admin/portfolio/manage_portfolio_process',[PortfolioController::class, 'manage_portfolio_process'])->name('portfolio.manage_portfolio_process');
    Route::get('admin/portfolio/status/{status}/{id}',[PortfolioController::class, 'status']);
    Route::get('admin/portfolio/delete/{id}',[PortfolioController::class, 'delete']);

    // routes for blog
    Route::get('admin/blog',[BlogController::class, 'index']);
    Route:: get('admin/blog/manage_blog',[BlogController::class, 'manage_blog']);
    Route::get('admin/blog/manage_blog/{id}',[BlogController::class, 'manage_blog']);
    Route::post('admin/blog/manage_blog_process',[BlogController::class, 'manage_blog_process'])->name('blog.manage_blog_process');
    Route::get('admin/blog/status/{status}/{id}',[BlogController::class, 'status']);
    Route::get('admin/blog/delete/{id}',[BlogController::class, 'delete']);

    // routes for client
    Route::get('admin/client',[ClientController::class, 'index']);
    Route:: get('admin/client/manage_client',[ClientController::class, 'manage_client']);
    Route::get('admin/client/manage_client/{id}',[ClientController::class, 'manage_client']);
    Route::post('admin/client/manage_client_process',[ClientController::class, 'manage_client_process'])->name('client.manage_client_process');
    Route::get('admin/client/status/{status}/{id}',[ClientController::class, 'status']);
    Route::get('admin/client/delete/{id}',[ClientController::class, 'delete']);

    // routes for about
    Route::get('admin/about',[AboutController::class, 'index']);
    Route:: get('admin/about/manage_about',[AboutController::class, 'manage_about']);
    Route::get('admin/about/manage_about/{id}',[AboutController::class, 'manage_about']);
    Route::post('admin/about/manage_about_process',[AboutController::class, 'manage_about_process'])->name('about.manage_about_process');
    Route::get('admin/about/status/{status}/{id}',[AboutController::class, 'status']);
    Route::get('admin/about/delete/{id}',[AboutController::class, 'delete']);

    // routes for contact
    Route::get('admin/contact',[ContactController::class, 'index']);
    Route:: get('admin/contact/manage_contact',[ContactController::class, 'manage_contact']);
    Route::get('admin/contact/manage_contact/{id}',[ContactController::class, 'manage_contact']);
    Route::post('admin/contact/manage_contact_process',[ContactController::class, 'manage_contact_process'])->name('contact.manage_contact_process');
    Route::get('admin/contact/status/{status}/{id}',[ContactController::class, 'status']);
    Route::get('admin/contact/delete/{id}',[ContactController::class, 'delete']);

    // routes for social
    Route::get('admin/social',[SocialController::class, 'index']);
    Route:: get('admin/social/manage_social',[SocialController::class, 'manage_social']);
    Route::get('admin/social/manage_social/{id}',[SocialController::class, 'manage_social']);
    Route::post('admin/social/manage_social_process',[SocialController::class, 'manage_social_process'])->name('social.manage_social_process');
    Route::get('admin/social/status/{status}/{id}',[SocialController::class, 'status']);
    Route::get('admin/social/delete/{id}',[SocialController::class, 'delete']);

    // routes for slider
    Route::get('admin/slider',[SliderController::class, 'index']);
    Route:: get('admin/slider/manage_slider',[SliderController::class, 'manage_slider']);
    Route::get('admin/slider/manage_slider/{id}',[SliderController::class, 'manage_slider']);
    Route::post('admin/slider/manage_slider_process',[SliderController::class, 'manage_slider_process'])->name('slider.manage_slider_process');
    Route::get('admin/slider/status/{status}/{id}',[SliderController::class, 'status']);
    Route::get('admin/slider/delete/{id}',[SliderController::class, 'delete']);

    // routes for setting
    Route::get('admin/setting',[SettingController::class, 'index']);
    Route:: get('admin/setting/manage_setting',[SettingController::class, 'manage_setting'])->name('manage_setting');
    Route::get('admin/setting/manage_setting/{id}',[SettingController::class, 'manage_setting']);
    Route::post('admin/setting/manage_setting_process',[SettingController::class, 'manage_setting_process'])->name('setting.manage_setting_process');
    Route::get('admin/setting/status/{status}/{id}',[SettingController::class, 'status']);
    Route::get('admin/setting/delete/{id}',[SettingController::class, 'delete']);
    
    // routes for inner page setting
    Route::get('admin/innerpage_setting',[InnerPageSettingController::class, 'index']);
    Route:: get('admin/innerpage_setting/manage_innerpage_setting',[InnerPageSettingController::class, 'manage_innerpage_setting']);
    Route::get('admin/innerpage_setting/manage_innerpage_setting/{id}',[InnerPageSettingController::class, 'manage_innerpage_setting']);
    Route::post('admin/innerpage_setting/manage_innerpage_setting_process',[InnerPageSettingController::class, 'manage_innerpage_setting_process'])->name('setting.manage_innerpage_setting_process');
    Route::get('admin/innerpage_setting/status/{status}/{id}',[InnerPageSettingController::class, 'status']);
    Route::get('admin/innerpage_setting/delete/{id}',[InnerPageSettingController::class, 'delete']);

// routes for Header
    Route::get('admin/header',[HeaderController::class, 'index']);
    Route:: get('admin/header/manage_header',[HeaderController::class, 'manage_header']);
    Route::get('admin/header/manage_header/{id}',[HeaderController::class, 'manage_header']);
    Route::post('admin/header/manage_header_process',[HeaderController::class, 'manage_header_process'])->name('setting.manage_header_process');
    Route::get('admin/header/status/{status}/{id}',[HeaderController::class, 'status']);
    Route::get('admin/header/delete/{id}',[HeaderController::class, 'delete']);

    // routes for Features
    Route::get('admin/feature',[FeatureController::class, 'index']);
    Route:: get('admin/feature/manage_feature',[FeatureController::class, 'manage_feature']);
    Route::get('admin/feature/manage_feature/{id}',[FeatureController::class, 'manage_feature']);
    Route::post('admin/feature/manage_feature_process',[FeatureController::class, 'manage_feature_process'])->name('setting.manage_feature_process');
    Route::get('admin/feature/status/{status}/{id}',[FeatureController::class, 'status']);
    Route::get('admin/feature/delete/{id}',[FeatureController::class, 'delete']);

    // routes for Rating
    Route::get('admin/rating',[RatingController::class, 'index']);
    Route:: get('admin/rating/manage_rating',[RatingController::class, 'manage_rating']);
    Route::get('admin/rating/manage_rating/{id}',[RatingController::class, 'manage_rating']);
    Route::post('admin/rating/manage_rating_process',[RatingController::class, 'manage_rating_process'])->name('setting.manage_rating_process');
    Route::get('admin/rating/status/{status}/{id}',[RatingController::class, 'status']);
    Route::get('admin/rating/delete/{id}',[RatingController::class, 'delete']);

    // routes for Product Class
    Route::get('admin/product_class',[ProductClassController::class, 'index']);
    Route:: get('admin/product_class/manage_product_class',[ProductClassController::class, 'manage_product_class']);
    Route::get('admin/product_class/manage_product_class/{id}',[ProductClassController::class, 'manage_product_class']);
    Route::post('admin/product_class/manage_product_class_process',[ProductClassController::class, 'manage_product_class_process'])->name('setting.manage_product_class_process');
    Route::get('admin/product_class/status/{status}/{id}',[ProductClassController::class, 'status']);
    Route::get('admin/product_class/delete/{id}',[ProductClassController::class, 'delete']);

    // routes for Service Detail
    Route::get('admin/service_detail',[ServiceDetailController::class, 'index']);
    Route:: get('admin/service_detail/manage_service_detail',[ServiceDetailController::class, 'manage_service_detail']);
    Route::get('admin/service_detail/manage_service_detail/{id}',[ServiceDetailController::class, 'manage_service_detail']);
    Route::post('admin/service_detail/manage_service_detail_process',[ServiceDetailController::class, 'manage_service_detail_process'])->name('setting.manage_service_detail_process');
    Route::get('admin/service_detail/status/{status}/{id}',[ServiceDetailController::class, 'status']);
    Route::get('admin/service_detail/delete/{id}',[ServiceDetailController::class, 'delete']);

        // FrontendController
    // **************************************************************

    // routes for contact
    Route::get('frontend/contact',[ContactUsController::class, 'index']);
    Route::get('admin/contact_forms',[ContactUsController::class, 'admin_index']);
    Route::get('admin/contact_forms/manage_contact_forms',[ContactUsController::class, 'manage_contact_forms']);
    Route::post('admin/contact_forms/manage_contact_forms_process',[ContactUsController::class, 'manage_contact_forms_process'])->name('contact.manage_contact_forms_process');
    Route::get('admin/contact_forms/delete/{id}',[ContactUsController::class, 'admin_delete']);
    Route::get('admin/contact_forms/status/{status}/{id}',[ContactUsController::class, 'status']);
    Route::get('admin/contact_forms/show/{id}',[ContactUsController::class, 'view_contact_forms']);



    //route of checkout 

    Route::get('admin/checkout',[CheckOutController::class, 'admin_index']);
    Route::get('admin/checkout/delete/{id}',[CheckOutController::class, 'checkout_delete']);
    Route::get('admin/checkout/status/{status}/{id}',[CheckOutController::class, 'status']);
    Route::get('admin/checkout/show/{id}',[CheckOutController::class, 'show']);


});