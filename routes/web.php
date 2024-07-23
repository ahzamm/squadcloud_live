<?php

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
use App\Http\Controllers\Admin\HomeSliderController as AdminHomeSlideController;
use App\Http\Controllers\Admin\BottomSliderController as AdminBottomSliderController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\GeneralConfigurationController as AdminGeneralConfigurationController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\JobApplicationController as AdminJobApplicationController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\TermController as AdminTermController;
use App\Http\Controllers\Admin\PrivacyController as AdminPrivacyController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\PortfolioRequestController;
use App\Http\Controllers\Admin\ContactRequestController;
use App\Http\Controllers\Admin\AllowedIpController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\UserMenuAccessController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\Admin\PopUpController;
use App\Http\Controllers\Admin\HomeSideMenuController;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\FrontContactController;
use App\Models\HomeSideMenu;
use App\Http\Middleware\CheckForMaintenanceMode;

// SquadCloud Site Imports
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\MaintenanceController;
use App\Http\Controllers\Site\PortfolioController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\ServiceController;
use App\Http\Controllers\Site\ClientController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Site\SubscriberController;
use App\Http\Controllers\Site\CareerController;
use App\Http\Controllers\Site\GalleryController;
use App\Http\Controllers\Site\TermsController;
use App\Http\Controllers\Site\PrivacyController;
use App\Http\Controllers\Site\FaqController;

// dd('Boot Not Found! Please Insert Media & Try Again Lator');
Cache::forget('key');
Route::get('/clear-cache', function () {
    Cache::flush();
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "<h2 style='color:red'><marquee>Your System Has been Cleared!..'['-']'...</marquee></h2>";
});

Route::get('/flush', function () {
    Session::flush();
    return 'Your System Has been Wiped!...!';
})->name('flush');

Route::middleware([CheckForMaintenanceMode::class])->group(function () {
    Route::get('/', 'App\Http\Controllers\Site\HomeController@index')->name('home');
});
// Route::get('/sendmail','Site\EmailController@sendmail')->name('home');

Route::get('site/cities/{id}', 'Site\ConsumerController@getCities')->name('getcities');
Route::get('site/cities/delete/{id?}', 'Admin\CitiesController@destroy')->name('destroy.cities');
Route::get('site/corearea/{cityId}', 'Site\ConsumerController@getcoreAreas')->name('getcoreareas');
Route::get('site/zonearea/{id}', 'Site\ConsumerController@getZoneAreas')->name('getzoneareas');
Route::post('site/becomepartner', 'Site\ConsumerController@becomePartner')->name('becompartner');
Route::post('site/becomeuser', 'Site\ConsumerController@becomeUser')->name('becomeuser');
Route::post('site/frontcontactform', 'Site\FrontContactController@store')->name('frontcontactform');
// Contact Routes From Site Section
Route::post('/AddContact', [ContactController::class, 'store'])->name('user.contact');

// SquadCloud Site Routes
Route::get('/maintenance', [MaintenanceController::class, 'index'])->name('site.maintenance');
Route::get('/services', [ServiceController::class, 'index'])->name('site.services');
Route::get('/services/{slug}', [ServiceController::class, 'serviceDetail'])
    ->where('id', '[0-9]+')
    ->name('site.service.detail');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('site.portfolio');
Route::post('/portfolio', [PortfolioController::class, 'request_demo'])->name('site.portfolio.post');
Route::get('/portfolio/{route}', [PortfolioController::class, 'detail'])->name('site.portfolio.detail');
Route::get('/client', [ClientController::class, 'index'])->name('site.client');
Route::get('/about', [AboutController::class, 'index'])->name('site.about');
Route::get('/contact', [ContactController::class, 'index'])->name('site.contact');
Route::post('/contact-request', [ContactController::class, 'store'])->name('site.contact.request');
Route::post('/manage_contacts', [ContactController::class, 'index'])->name('contact.manage_contact_forms_process');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::get('/career', [CareerController::class, 'index'])->name('site.career');
Route::post('/career', [CareerController::class, 'store'])->name('site.career.post');
Route::get('/gallery', [GalleryController::class, 'index'])->name('site.gallery');
Route::get('/terms-and-conditions', [TermsController::class, 'index'])->name('site.terms');
Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('site.privacy');
Route::get('/faqs', [FaqController::class, 'index'])->name('site.faq');

// End Of Contact Routes From Site section
Route::prefix('admin')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])
        ->name('admin.login')
        ->middleware('guest:admin');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('admin.login.post')
        ->middleware('guest:admin');
    Route::get('/verify-otp', [AuthController::class, 'showVerifyOTPForm'])
        ->name('admin.verifyOTP')
        ->middleware('guest:admin');
    Route::post('/verify-otp', [AuthController::class, 'verifyOTP'])
        ->name('admin.verifyOTP.post')
        ->middleware('guest:admin');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/passwordchange', [AuthController::class, 'changePassword'])->name('admin.change.password');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::resource('allowedip', 'App\Http\Controllers\Admin\AllowedIpController');
        Route::get('maintenance', 'App\Http\Controllers\Admin\MaintenanceController@index')->name('maintenance.index');
        Route::post('maintenance/store', 'App\Http\Controllers\Admin\MaintenanceController@store')->name('maintenance.store');
        Route::get('maintenance/deactivate', 'App\Http\Controllers\Admin\MaintenanceController@deactivate')->name('maintenance.deactivate');
        Route::get('front-faqs/sort', 'App\Http\Controllers\Admin\FrontFaqController@sort')->name('faqs.sort');
        Route::post('front-faqs/sort', 'App\Http\Controllers\Admin\FrontFaqController@sortPost')->name('faqs.sort');
        Route::post('front-faqs/destroy/{id?}', 'App\Http\Controllers\Admin\FrontFaqController@destroy')->name('faq.destroy');
        Route::resource('front-faqs', 'App\Http\Controllers\Admin\FrontFaqController');
        Route::resource('employee', 'App\Http\Controllers\Admin\EmployeeController');
        Route::get('front-contact', 'App\Http\Controllers\Admin\FrontContactController@index')->name('contact.index');
        Route::delete('front-contact/{id}', 'App\Http\Controllers\Admin\FrontContactController@destroy')->name('contact.delete');
        Route::get('front-emails/edit', 'App\Http\Controllers\Admin\FrontContactController@editEmail');
        Route::post('front-emails/edit', 'App\Http\Controllers\Admin\FrontContactController@updateEmail');
        Route::resource('homeslider', 'App\Http\Controllers\Admin\HomeSliderController');

        // Route::get("slider/edit/{id?}" , [HomeSliderController::class , 'edit'])->name('edit.slider');
        // Route::Post("slider/delete/{id?}" , [HomeSliderController::class , 'destroy'])->name('destroy.slider');
        Route::resource('reseller', 'App\Http\Controllers\Admin\ResellerController');
        Route::resource('whychoose', 'App\Http\Controllers\Admin\WhyChooseusController');
        Route::resource('logo', 'App\Http\Controllers\Admin\FrontLogoController');

        Route::resource('aboutus', 'App\Http\Controllers\Admin\AboutUsController');
        Route::resource('message', 'App\Http\Controllers\Admin\MessageController');
        Route::resource('frontmenu', 'App\Http\Controllers\Admin\FrontMenuController');
        Route::get('frontmenu/edit/{id?}', [FrontMenuController::class, 'edit'])->name('front.edit');
        Route::post('/frontmenu/change_status/{id?}', [FrontMenuController::class, 'change_status'])->name('frontmenu.status');

        Route::get('service/edit/{id?}', [AdminServiceController::class, 'edit'])->name('service.edit');
        Route::get('portfolio/edit/{id?}', [AdminPortfolioController::class, 'edit'])->name('portfolio.edit');
        Route::get('client/edit/{id?}', [AdminClientController::class, 'edit'])->name('client.edit');
        Route::get('product/edit/{id?}', [AdminProductController::class, 'edit'])->name('product.edit');
        Route::get('bottom_slider/edit/{id?}', [AdminBottomSliderController::class, 'edit'])->name('bottom_slider.edit');
        Route::get('homeslider/edit/{id?}', [HomeSliderController::class, 'edit'])->name('homeslider.edit');
        Route::get('team/edit/{id?}', [AdminTeamController::class, 'edit'])->name('team.edit');
        Route::get('job/edit/{id?}', [AdminJobController::class, 'edit'])->name('job.edit');
        Route::get('faq/edit/{id?}', [AdminFaqController::class, 'edit'])->name('faq.edit');

        Route::resource('cities', 'App\Http\Controllers\Admin\CitiesController');
        Route::resource('coreareas', 'App\Http\Controllers\Admin\CoreAreaController');
        Route::resource('zoneareas', 'App\Http\Controllers\Admin\ZoneAreaController');

        Route::get('partner-emails/{flag}', 'App\Http\Controllers\Admin\CitiesController@partnerEmail');
        Route::post('partner-emails', 'App\Http\Controllers\Admin\CitiesController@updateEmail');
        Route::get('coveragerequest', 'App\Http\Controllers\Admin\CoverageRequestController@index')->name('coveragerequest.index');
        Route::get('/coveragerequest/{id}', 'App\Http\Controllers\Admin\CoverageRequestController@showUserDetails')->name('coveragerequest.show');
        Route::get('coverage/destroy/{id?}', 'App\Http\Controllers\Admin\CoverageRequestController@destroy')->name('coveragerequest.destroy');

        //Menus and Sub Menus Route -- Only Admin Access
        Route::get('menus/create', 'App\Http\Controllers\Admin\MenusController@create')->name('menus.create');
        Route::post('menus/create', 'App\Http\Controllers\Admin\MenusController@store')->name('menus.store');
        Route::get('menus/index', 'App\Http\Controllers\Admin\MenusController@index')->name('menus.index');
        Route::get('menus/sort', 'App\Http\Controllers\Admin\MenusController@sort')->name('menus.sort');
        Route::post('menus/sort', 'App\Http\Controllers\Admin\MenusController@sortPost')->name('menus.sortpost');
        Route::get('menu/edit/{id?}', [MenusController::class, 'edit'])->name('menu.edit');

        // Route::get('menus/show/{id}', 'Admin\MenusController@show')->name('menus.show');
        Route::get('menus/update/{id}', 'App\Http\Controllers\Admin\MenusController@edit')->name('menus.edit');
        Route::post('menus/update/{id}', 'App\Http\Controllers\Admin\MenusController@update')->name('menus.update');
        Route::post('menus/delete/{id}', 'App\Http\Controllers\Admin\MenusController@destroy')->name('menus.delete');
        Route::post('menus/checkroute', 'App\Http\Controllers\Admin\MenusController@checkroute')->name('menus.checkroute');
        Route::post('submenus/delete', 'App\Http\Controllers\Admin\MenusController@subMenuDelete')->name('submenus.delete');

        //User Menu Access
        // Route::get('useraccess/index', 'Admin\UserMenuAccessController@index')->name('useraccess.index');
        Route::get('useraccess/show/{id}', 'App\Http\Controllers\Admin\EmployeeController@showAccess')->name('useraccess.show');
        Route::post('useraccess/update/{id}', 'App\Http\Controllers\Admin\EmployeeController@updateAccess')->name('useraccess.update');

        //Packages
        Route::resource('packages', 'App\Http\Controllers\Admin\PackagesController');
        Route::get('/packages/destroy/{id?}', [PackagesController::class, 'destroy'])->name('package.destroy');
        // Sorting Table Routes

        Route::post('sortFrontMenu', [FrontMenuController::class, 'updateSorting'])->name('sort.front.menu');
        Route::post('sortMenu', [MenusController::class, 'sortMenu'])->name('sort.menu');
        Route::post('sortService', [AdminServiceController::class, 'updateSorting'])->name('sort.service');
        Route::post('sortPortfolio', [AdminPortfolioController::class, 'updateSorting'])->name('sort.portfolio');
        Route::post('sortClient', [AdminClientController::class, 'updateSorting'])->name('sort.client');
        Route::post('sortProduct', [AdminProductController::class, 'updateSorting'])->name('sort.product');
        Route::post('sortBottomSlider', [AdminBottomSliderController::class, 'updateSorting'])->name('sort.bottom_slider');
        Route::post('sortSocial', [SocialController::class, 'updateSorting'])->name('sort.social');
        Route::post('sortHomeSlider', [HomeSliderController::class, 'updateSorting'])->name('sort.homeslider');
        Route::post('sortTeam', [AdminTeamController::class, 'updateSorting'])->name('sort.team');
        Route::post('sortJob', [AdminJobController::class, 'updateSorting'])->name('sort.job');
        Route::post('sortFaq', [AdminFaqController::class, 'updateSorting'])->name('sort.faq');
        Route::post('sortFaqCategory', [FaqCategoryController::class, 'updateSorting'])->name('sort.faq_category');
        Route::post('sortGallery', [AdminGalleryController::class, 'updateSorting'])->name('sort.gallery');

        // Social Links Routes
        Route::get('/social/', [SocialController::class, 'index'])->name('social.index');
        Route::get('/social/create', [SocialController::class, 'create'])->name('social.create');
        Route::get('/social/edit/{id?}', [SocialController::class, 'edit'])->name('social.edit');
        Route::post('/social/store', [SocialController::class, 'store'])->name('social.store');
        Route::post('/social/update/{id?}', [SocialController::class, 'update'])->name('social.update');
        Route::get('/social/destroy/{id?}', [SocialController::class, 'destroy'])->name('social.destroy');
        Route::post('/social/change_status/{id?}', [SocialController::class, 'change_status'])->name('social.status');

        // Contact Section Data Started
        // Route::get('/contact/' , [ContactController::class ,'index'])->name('contact.index');
        // Route::get('/contactrequest/{id}', [ContactController::class,'showFrontContact'])->name('frontcontactrequest.show');

        // User Managment Section
        Route::get('/user/', [UserMenuAccessController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserMenuAccessController::class, 'create'])->name('user.create');
        Route::get('/user/edit/{id?}', [UserMenuAccessController::class, 'edit'])->name('user.edit');
        Route::get('/user/menu_access', [UserMenuAccessController::class, 'menu_access'])->name('user.access');
        Route::post('/user/store', [UserMenuAccessController::class, 'store'])->name('user.store');
        Route::post('/user/update/{id?}', [UserMenuAccessController::class, 'update'])->name('user.update');
        Route::post('/user/change/status', [UserMenuAccessController::class, 'change_status'])->name('user.status.change');
        Route::get('/user/destroy/{id?}', [UserMenuAccessController::class, 'destroy'])->name('user.destroy');
        // Access Managing System
        Route::get('/user/access/{id?}', [UserMenuAccessController::class, 'menuAccess'])->name('user.menu.access');
        Route::post('/user/giveaccess/{id?}', [UserMenuAccessController::class, 'giveAccess'])->name('menu.give.access');

        // Pop up
        Route::get('popup', [PopUpController::class, 'index'])->name('popup.index');
        Route::get('popup/create', [PopUpController::class, 'create'])->name('popup.create');
        Route::get('/popup/edit/{id?}', [PopUpController::class, 'edit'])->name('popup.edit');
        Route::post('/popup/store', [PopUpController::class, 'store'])->name('popup.store');
        Route::post('/popup/update/{id?}', [PopUpController::class, 'update'])->name('popup.update');
        Route::get('/popup/delete/{id?}', [PopUpController::class, 'destroy'])->name('popup.destroy');
        Route::post('/popup/change_status/{id?}', [PopUpController::class, 'change_status'])->name('popup.status');
        // Home Side Menu
        Route::get('homeside', [HomeSideMenuController::class, 'index'])->name('homeside.index');
        Route::get('homeside/create', [HomeSideMenuController::class, 'create'])->name('homeside.create');
        Route::get('/homeside/edit/{id?}', [HomeSideMenuController::class, 'edit'])->name('homeside.edit');
        Route::post('/homeside/store', [HomeSideMenuController::class, 'store'])->name('homeside.store');
        Route::post('/homeside/update/{id?}', [HomeSideMenuController::class, 'update'])->name('homeside.update');
        Route::get('/homeside/delete/{id?}', [HomeSideMenuController::class, 'destroy'])->name('homeside.destroy');
        Route::post('/homeside/change_status/{id?}', [HomeSideMenuController::class, 'change_status'])->name('homeside.status');
        // Email Routes
        Route::get('/email/', [EmailController::class, 'index'])->name('email.index');
        Route::get('/email/create', [EmailController::class, 'create'])->name('email.create');
        Route::get('/email/edit/{id?}', [EmailController::class, 'edit'])->name('email.edit');
        Route::post('/email/store', [EmailController::class, 'store'])->name('email.store');
        Route::post('/email/update/{id?}', [EmailController::class, 'update'])->name('email.update');
        Route::get('/email/delete/{id?}', [EmailController::class, 'destroy'])->name('email.destroy');
        Route::post('/email/change_status/{id?}', [EmailController::class, 'change_status'])->name('email.status');

        //Header Video
        Route::get('/videoheader', [HomeVideoController::class, 'index'])->name('video.index');

        Route::get('/videoheader/create', [HomeVideoController::class, 'create'])->name('homevideo.create');
        Route::post('/videoheader/create', [HomeVideoController::class, 'store'])->name('homevideo.store');

        Route::get('/videoheader/{id}', [HomeVideoController::class, 'edit'])->name('homevideo.edit');
        Route::post('/videoheader/update', [HomeVideoController::class, 'update'])->name('homevideo.update');

        Route::Post('/videoheader/delete/{id?}', [HomeVideoController::class, 'destroy'])->name('homevideo.destroy');

        //  Squadcloud Admin Routes
        Route::resource('services', 'App\Http\Controllers\Admin\ServiceController');
        Route::get('/services/destroy/{id?}', [AdminServiceController::class, 'destroy'])->name('service.destroy');
        Route::post('/services/change_status/{id?}', [AdminServiceController::class, 'change_status'])->name('service.status');

        Route::resource('portfolios', 'App\Http\Controllers\Admin\PortfolioController');
        Route::get('/portfolios/destroy/{id?}', [AdminPortfolioController::class, 'destroy'])->name('portfolio.destroy');
        Route::post('/portfolios/change_status/{id?}', [AdminPortfolioController::class, 'change_status'])->name('portfolio.status');

        Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
        Route::get('/products/destroy/{id?}', [AdminProductController::class, 'destroy'])->name('product.destroy');

        Route::resource('clients', 'App\Http\Controllers\Admin\ClientController');
        Route::get('/clients/destroy/{id?}', [AdminClientController::class, 'destroy'])->name('client.destroy');
        Route::post('/clients/change_status/{id?}', [AdminClientController::class, 'change_status'])->name('client.status');

        Route::get('about', [AdminAboutController::class, 'index'])->name('about.index');
        Route::put('about', [AdminAboutController::class, 'update'])->name('about.update');

        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::put('/contacts', [AdminContactController::class, 'update'])->name('contacts.update');

        Route::get('/contact_requests', [ContactRequestController::class, 'index'])->name('contact_requests.index');
        Route::post('/contact_requests/', [ContactRequestController::class, 'EmailFormSubmit'])->name('emailcontact.store');
        Route::get('/contact_requests/delete/{id}', [ContactRequestController::class, 'destroyEmail'])->name('emailcontact.destroy');
        Route::get('/contact_requests/destroy/{id?}', [ContactRequestController::class, 'destroy'])->name('contact_request.destroy');

        Route::resource('homesliders', 'App\Http\Controllers\Admin\HomeSliderController');
        Route::get('/homesliders/destroy/{id?}', [AdminHomeSlideController::class, 'destroy'])->name('homeslider.destroy');
        Route::post('/homesliders/store/image', [AdminHomeSlideController::class, 'storeImages'])->name('homesliders.storeimages');
        Route::post('/homesliders/store/video', [AdminHomeSlideController::class, 'storeVideo'])->name('homesliders.storevideo');
        Route::put('/homesliders/{id}/edit/', [AdminHomeSlideController::class, 'updateVideo'])->name('homesliders.updatevideo');
        Route::post('/homesliders/change/status', [AdminHomeSlideController::class, 'change_status'])->name('homeslider.status');

        Route::get('/general_configurations', [AdminGeneralConfigurationController::class, 'index'])->name('general_configurations.index');
        Route::put('/general_configuration-update', [AdminGeneralConfigurationController::class, 'update'])->name('general-configurations.update');
        Route::post('/otp_configuration', [AdminGeneralConfigurationController::class, 'change_status'])->name('general-configurations.otp_configuration.update');

        Route::resource('bottom_sliders', 'App\Http\Controllers\Admin\BottomSliderController');
        Route::get('/bottom_sliders/destroy/{id?}', [AdminBottomSliderController::class, 'destroy'])->name('bottom_slider.destroy');
        Route::post('/bottom_sliders/change_status/{id?}', [AdminBottomSliderController::class, 'change_status'])->name('bottom_slider.status');

        Route::resource('teams', 'App\Http\Controllers\Admin\TeamController');
        Route::get('/teams/destroy/{id?}', [AdminTeamController::class, 'destroy'])->name('team.destroy');
        Route::post('/teams/change_status/{id?}', [AdminTeamController::class, 'change_status'])->name('team.status');

        Route::resource('jobs', 'App\Http\Controllers\Admin\JobController');
        Route::get('/jobs/destroy/{id?}', [AdminJobController::class, 'destroy'])->name('job.destroy');
        Route::post('/jobs/change_status/{id?}', [AdminJobController::class, 'change_status'])->name('job.status');

        Route::get('/job_applications', [AdminJobApplicationController::class, 'index'])->name('job_applications.index');
        Route::get('/job_applications/destroy/{id?}', [AdminJobApplicationController::class, 'destroy'])->name('job_application.destroy');

        Route::get('/subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('/subscribers/destroy/{id?}', [AdminSubscriberController::class, 'destroy'])->name('subscriber.destroy');

        Route::get('/career', [AdminCareerController::class, 'index'])->name('careers.index');
        Route::put('/career', [AdminCareerController::class, 'update'])->name('careers.update');

        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::get('/gallery/destroy/{id?}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');
        Route::post('/gallery/status/{id?}', [AdminGalleryController::class, 'status'])->name('gallery.status');

        Route::get('/terms-and-conditions', [AdminTermController::class, 'index'])->name('terms.index');
        Route::put('/terms-and-conditions', [AdminTermController::class, 'update'])->name('terms.update');

        Route::get('/privacy-policy', [AdminPrivacyController::class, 'index'])->name('privacy.index');
        Route::put('/privacy-policy', [AdminPrivacyController::class, 'update'])->name('privacy.update');

        Route::resource('faqs', 'App\Http\Controllers\Admin\FaqController');
        Route::get('/faqs/destroy/{id?}', [AdminFaqController::class, 'destroy'])->name('faq.destroy');
        Route::post('/faq/title-image', [AdminFaqController::class, 'uploadImage'])->name('faq.image.store');
        Route::post('/faqs/change_status/{id?}', [AdminFaqController::class, 'change_status'])->name('faq.status');

        Route::resource('faq_categories', 'App\Http\Controllers\Admin\FaqCategoryController');
        Route::get('/faq_catagory/destroy/{id?}', [FaqCategoryController::class, 'destroy'])->name('faq_category.destroy');
        Route::post('/faq_catagory/change_status/{id?}', [FaqCategoryController::class, 'change_status'])->name('faq_category.status');

        Route::get('/portfolio_demo_request', [PortfolioRequestController::class, 'index'])->name('portfolio_demo_requests.index');
        Route::get('/portfolio_demo_request/destroy/{id?}', [PortfolioRequestController::class, 'destroy'])->name('portfolio_demo_request.destroy');
    });
});
