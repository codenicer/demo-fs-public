<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' =>'admin', 'middleware' => ['auth', 'admin']], function(){
    //done
    Route::resource('categories','CategoryController');
	Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
	Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');
    Route::get('/categories/priority_product/{id}', 'CategoryController@priority_product')->name('categories.priority_product');
    Route::post('/categories/priority/product', 'CategoryController@priority')->name('categories.product_priorities');
    Route::post('/categories/priority/category_priority', 'CategoryController@category_priority')->name('category_priority');

    Route::resource('subcategories','SubCategoryController');
    Route::get('/subcategories/destroy/{id}', 'SubCategoryController@destroy')->name('subcategories.destroy');

    Route::get('/products/admin','ProductController@admin_products')->name('products.admin');
    Route::get('/products/admin/addons/{id}','AddonController@index')->name('addons.index');
    Route::post('/products/admin/addons/update','ProductController@updateAddon')->name('addons.update');
	Route::get('/products/admin/priority_addon/{id}', 'ProductController@priority_addon')->name('products.priority_addon');
	Route::post('/products/admin/priority/product', 'ProductController@priority')->name('products.addon_priorities');

    Route::resource('product_types','ProductTypeController');
    Route::get('/product_types/create','ProductTypeController@create')->name('product_types.create');
    Route::get('/product_types/destroy/{id}', 'ProductTypeController@destroy')->name('product_types.destroy');



   //not done

//	Route::resource('subsubcategories','SubSubCategoryController');
//	Route::get('/subsubcategories/destroy/{id}', 'SubSubCategoryController@destroy')->name('subsubcategories.destroy');
//
//	Route::resource('brands','BrandController');
//	Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');


	//Route::get('/products/seller','ProductController@seller_products')->name('products.seller');
    //Route::get('/products/seller/{id}/edit','ProductController@seller_product_edit')->name('products.seller.edit');
	Route::get('/products/create','ProductController@create')->name('products.create');
	Route::get('/products/admin/{product_id}/edit','ProductController@admin_product_edit')->name('products.admin.edit');

	Route::post('/products/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
	Route::post('/products/get_products_by_subsubcategory', 'ProductController@get_products_by_subsubcategory')->name('products.get_products_by_subsubcategory');

//	Route::resource('sellers','SellerController');
//	Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
//	Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
//	Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
//	Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
//	Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
//	Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
//	Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');

	Route::resource('customers','CustomerController');
	Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');

	Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
	Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');

	Route::resource('profile','ProfileController');


	Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
	Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
	Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
	Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
	Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
	Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
	Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
	Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
	Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
	Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
	Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
	Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
	Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
	Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
	Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
	Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
	Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

	Route::resource('/languages', 'LanguageController');
	Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
	Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
	Route::get('/languages/{id}/edit', 'LanguageController@edit')->name('languages.edit');
	Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
	Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

	Route::get('/frontend_settings/home', 'HomeController@home_settings')->name('home_settings.index');
	Route::post('/frontend_settings/home/top_10', 'HomeController@top_10_settings')->name('top_10_settings.store');
	Route::get('/sellerpolicy/{type}', 'PolicyController@index')->name('sellerpolicy.index');
	Route::get('/returnpolicy/{type}', 'PolicyController@index')->name('returnpolicy.index');
	Route::get('/supportpolicy/{type}', 'PolicyController@index')->name('supportpolicy.index');
	Route::get('/terms/{type}', 'PolicyController@index')->name('terms.index');
	Route::get('/privacypolicy/{type}', 'PolicyController@index')->name('privacypolicy.index');

	//Policy Controller
	Route::post('/policies/store', 'PolicyController@store')->name('policies.store');

	Route::group(['prefix' => 'frontend_settings'], function(){
		Route::resource('sliders','SliderController');
	    Route::get('/sliders/destroy/{id}', 'SliderController@destroy')->name('sliders.destroy');
        Route::post('/sliders/edit', 'SliderController@edit')->name('sliders.edit');
        Route::patch('/sliders/sliders/update', 'SliderController@update_slider')->name('sliders.update_slider');

        Route::post('/sliders/priority', 'SliderController@priority')->name('sliders.priority');


        Route::resource('home_banners','BannerController');
		Route::get('/home_banners/create/{position}', 'BannerController@create')->name('home_banners.create');
		Route::post('/home_banners/update_status', 'BannerController@update_status')->name('home_banners.update_status');
	    Route::get('/home_banners/destroy/{id}', 'BannerController@destroy')->name('home_banners.destroy');
		Route::resource('home_categories','HomeCategoryController');
        Route::get('/home_categories/destroy/{id}', 'HomeCategoryController@destroy')->name('home_categories.destroy');
		Route::post('/home_categories/update_status', 'HomeCategoryController@update_status')->name('home_categories.update_status');
		Route::post('/home_categories/get_subsubcategories_by_category', 'HomeCategoryController@getSubSubCategories')->name('home_categories.get_subsubcategories_by_category');
        Route::post('/home_categories/priority', 'HomeCategoryController@priority')->name('home_categories.priority');


    });

	Route::resource('roles','RoleController');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs','StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

	Route::resource('flash_deals','FlashDealController');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');


	Route::resource('pages','PagesController');
	Route::get('/pages/create','PagesController@create')->name('pages.create');
	Route::get('/pages/edit/{id}','PagesController@edit')->name('pages.edit');
	Route::post('/pages/update','PagesController@update')->name('pages.update');
	Route::get('/pages/destroy/{id}', 'PagesController@destroy')->name('pages.destroy');
	Route::post('/pages/update_published_status', 'PagesController@update_published_status')->name('pages.update_published_status');
	

	Route::resource('collections','CollectionController');
    Route::get('/collections/create', 'CollectionController@create')->name('collections.create');
    Route::get('/collections/edit_collection/{id}', 'CollectionController@edit_collection')->name('collections.edit_collection');
    Route::patch('/collections/store_collection/edit', 'CollectionController@store_collection')->name('collections.store_collection');
    Route::get('/collections/addon/{id}', 'CollectionController@addon')->name('collections.addon');
    Route::get('/collections/priority_product/{id}', 'CollectionController@priority_product')->name('collections.priority_product');
    Route::post('/collections/priority/product', 'CollectionController@priority')->name('collections.product_priorities');

    Route::get('/collections/destroy/{id}', 'CollectionController@destroy')->name('collections.destroy');
    Route::post('/collections/update_status', 'CollectionController@update_status')->name('collections.update_status');
    Route::post('/collections/update_collection_status', 'CollectionController@update_collection_status')->name('collections.update_collection_status');
    Route::post('/collections/add_addOn', 'CollectionController@edit_addOn')->name('collections.edit_addOn');
    Route::post('/collections/product_discount', 'CollectionController@product_discount')->name('collections.product_discount');
    Route::post('/collections/product_discount_edit','CollectionController@product_discount_edit')->name('collections.product_discount_edit');

	Route::resource('campaigns','CampaignScheduleController');
	Route::get('/campaigns/products/{id}','CampaignScheduleController@products')->name('campaigns.products');
	Route::post('/campaigns/products/update','CampaignScheduleController@update')->name('campaigns.update');
	Route::post('/campaigns/update_enable','CampaignScheduleController@update_enable')->name('campaigns.update_enable');
	Route::post('/campaigns/update_active','CampaignScheduleController@update_active')->name('campaigns.update_active');
	Route::get('/campaigns/destroy/{id}', 'CampaignScheduleController@destroy')->name('campaigns.destroy');
	Route::get('/campaigns/edit/{id}', 'CampaignScheduleController@edit')->name('campaigns.edit');
	Route::put('/campaigns/update_campaign/{id}', 'CampaignScheduleController@update_campaign')->name('campaigns.update_campaign');
	Route::get('/campaigns/priority_product/{id}', 'CampaignScheduleController@priority_product')->name('campaigns.priority_product');
	Route::post('/campaigns/priority/product', 'CampaignScheduleController@priority')->name('campaigns.product_priorities');

    Route::resource('home_collections','HomeCollectionController');
    Route::post('/home_collections/update_status', 'HomeCollectionController@update_status')->name('home_collections.update_status');
    Route::get('/home_collections/delete/{id}', 'HomeCollectionController@delete')->name('home_collections.delete');
    Route::get('/home_collections/edit/{id}', 'HomeCollectionController@edit')->name('home_collections.edit');
    Route::post('/home_collections/priority', 'HomeCollectionController@priority')->name('home_collections.priority');

	Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
	Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
	Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
	Route::get('/sales', 'OrderController@sales')->name('sales.index');

	Route::resource('links','LinkController');
	Route::get('/links/destroy/{id}', 'LinkController@destroy')->name('links.destroy');

	Route::resource('generalsettings','GeneralSettingController');
	Route::get('/logo','GeneralSettingController@logo')->name('generalsettings.logo');
	Route::post('/logo','GeneralSettingController@storeLogo')->name('generalsettings.logo.store');
	Route::get('/color','GeneralSettingController@color')->name('generalsettings.color');
	Route::post('/color','GeneralSettingController@storeColor')->name('generalsettings.color.store');

	Route::resource('seosetting','SEOController');

	Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

	//Reports
	Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
	Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
	Route::get('/seller_report', 'ReportController@seller_report')->name('seller_report.index');
	Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
	Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');

	//Coupons
	Route::resource('coupon','CouponController');
	Route::post('/coupon/get_form', 'CouponController@get_coupon_form')->name('coupon.get_coupon_form');
	Route::post('/coupon/get_form_edit', 'CouponController@get_coupon_form_edit')->name('coupon.get_coupon_form_edit');
	Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');
	Route::post('/coupon/search', 'CouponController@search')->name('coupon.search');

	//Reviews
	Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
	Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

	//Support_Ticket
	Route::get('support_ticket/','SupportTicketController@admin_index')->name('support_ticket.admin_index');
	Route::get('support_ticket/{id}/show','SupportTicketController@admin_show')->name('support_ticket.admin_show');
	Route::post('support_ticket/reply','SupportTicketController@admin_store')->name('support_ticket.admin_store');

    Route::resource('popups','PopupsController');
    Route::post('popups/update_enabled','PopupsController@update_enabled')->name('popups.update_enabled');
    Route::get('popups/destroy/{id}','PopupsController@destroy')->name('popups.destroy');
    Route::post('popups/update/','PopupsController@updates')->name('popups.updates');

    Route::post('popups/update_active','PopupsController@update_active')->name('popups.update_active');

    // For Blogs

    Route::resource('blog','BlogController');
    Route::patch('blog/edit/{id}','BlogController@update')->name('blog.update');
	Route::get('blog/delete/{id}','BlogController@destroy')->name('blog.delete');
	

	//For Batch upload

	Route::get('import', 'BatchUploadController@batchUpload')->name('batch-upload');
	Route::post('import/product-addon', 'BatchUploadController@importProductAddon')->name('import-product-addon');
	Route::post('import/collection-hub', 'BatchUploadController@importCollectionPerHub')->name('import-collection-hub');
	Route::post('import/product-pricing', 'BatchUploadController@importProductPricing')->name('import-product-pricing');
	Route::post('import/product-disable', 'BatchUploadController@importOnandOffProduct')->name('import-product-disable');



});


