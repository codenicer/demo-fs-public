<?php

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
//Route::feeds('/feeds');

/*test route
*/

//Route::get('/home','HomeController@home');

/* MUCH FRIENDLY URL */
Route::get('/donate', 'HomeController@muchFriendlyURL')->name('donate');
Route::get('/help-hospitals', 'HomeController@muchFriendlyURL')->name('muchFriendlyURL');

/* REDIRECTS TO OLD URLS*/
Route::get('/delivery-to/{city}', 'HomeController@friendlyURL')->name('friendlyURL');

Route::get('/pages/flower-delivery-makati/', function(){
    return redirect('/');
});
Route::get('/collections/affordable-blooms', function(){
    return redirect('/');
});
Route::get('/collections/birthdays', function(){
    return redirect('/');
});
Route::get('/collections/romance', function(){
    return redirect('/');
});
Route::get('/page/payment-method-DZdcd', function(){
    return redirect('/page/payment-methods');
});
Route::get('/page/faqs-qSW2j', function(){
    return redirect('/page/faqs');
});
Route::get('/collections/bundle-deals', function(){
    return redirect('/collection/Bundle+Deals');
});
Route::get('/collections/roses', function(){
    return redirect('/collection/Roses');
});
Route::get('/collections/roses', function(){
    return redirect('/page/Terms--Conditions');
});
Route::get('/pages/faqs', function(){
    return redirect('/page/faqs');
});


Route::get('/collections/{collection}/products/{product}', 'HomeController@collectionRedirect');
Route::get('/collections/{collection}/{subcat}', 'HomeController@collectionSubCatRedirect');

Route::get('/pages/{title}', 'HomeController@pageRedirect');
Route::get('/collections/{collection}', 'HomeController@collectionRedirect');
Route::get('/products/{product}', 'HomeController@productRedirect');



Auth::routes(['verify' => true]);
Route::get('/verifiedemail', '\App\Http\Controllers\Auth\LoginController@verified');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
 Route::post('/language', 'LanguageController@changeLanguage')->name('language.change');
 Route::post('/currency', 'CurrencyController@changeCurrency')->name('currency.change');
Route::post('/hub', 'HubController@changeHub')->name('hub.change');
Route::get('/hub', 'HubController@changeHub')->name('hub.change');

Route::post('/forgotpassword/email', 'ForgotPasswordController@sendResetLinkEmail');


Route::get('/social-login/redirect/{provider}', 'Auth\LoginController@redirectToProvider')->name('social.login');
Route::get('/social-login/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('social.callback');
Route::get('/users/login', 'HomeController@login')->name('user.login');
Route::get('/users/registration', 'HomeController@registration')->name('user.registration');
Route::get('/users/registration_cart', 'HomeController@registration_cart')->name('user.registration_cart');
//Route::post('/users/login', 'HomeController@user_login')->name('user.login.submit');
Route::post('/users/login/cart', 'HomeController@cart_login')->name('cart.login.submit');

Route::post('/subcategories/get_subcategories_by_category', 'SubCategoryController@get_subcategories_by_category')->name('subcategories.get_subcategories_by_category');
Route::post('/subsubcategories/get_subsubcategories_by_subcategory', 'SubSubCategoryController@get_subsubcategories_by_subcategory')->name('subsubcategories.get_subsubcategories_by_subcategory');
Route::post('/subsubcategories/get_brands_by_subsubcategory', 'SubSubCategoryController@get_brands_by_subsubcategory')->name('subsubcategories.get_brands_by_subsubcategory');


Route::get('/', 'HomeController@index')->name('home');

Route::get('/sitemap.xml', function(){
	return base_path('sitemap.xml');
});

Route::get('vcard/create/','VcardController@init')->name('vcard.create');
Route::get('vcard/create/{card_id}','VcardController@init')->name('vcard.create');
Route::get('vcard/reply','VcardController@init')->name('vcard.reply');
Route::post('vcard','VcardController@send')->name('vcard.send');
Route::get('vcard/show','VcardController@show')->name('vcard.show');
Route::get('vcard/test','VcardController@test_rote')->name('vcard.test_route');



Route::get('product/reviews/{product_id}','ReviewController@viewall')->name('review.all');
//Page View

Route::get('/page/{title}', 'PagesController@viewpage')->name('pages.view');

//contact us
Route::get('/contact-us', 'ContactUsController@index')->name('contactus.view');
Route::post('/contact-us/sendmail', 'ContactUsController@sendmail')->name('contactus.sendmail');
Route::get('/contact-us/refresh_captcha', 'ContactUsController@refreshCaptcha')->name('contactus.refreshcaptcha');


Route::get('/product/{handle}', 'HomeController@product')->name('product');
Route::post('product_listing/loadmore','HomeController@loadmore')->name('loadmore');

Route::get('/products', 'HomeController@listing')->name('products');
Route::get('/flashdeals', 'HomeController@flashdealProducts')->name('flashdeals');
Route::get('/campaign/{title}', 'HomeController@campaignProducts')->name('products.campaign');
Route::post('/campaign/{title}/sortBy', 'HomeController@campaignProductsSort')->name('products.campaign1');
Route::get('/collection/{title}', 'HomeController@collectionProducts')->name('products.collection');
Route::post('/collection/{title}/sortBy', 'HomeController@collectionProductsSort')->name('products.collection1');
Route::get('/category/{category_slug}', 'HomeController@category')->name('products.category');
Route::get('/subcategory/{subcategory_slug}', 'HomeController@subcategory')->name('products.subcategory');

//Route::get('/search?category={category_slug}', 'HomeController@search')->name('products.category');
//Route::get('/search?subcategory={subcategory_slug}', 'HomeController@search')->name('products.subcategory');

Route::get('/search?subsubcategory={subsubcategory_slug}', 'HomeController@search')->name('products.subsubcategory');
Route::get('/search?brand={brand_slug}', 'HomeController@search')->name('products.brand');
Route::post('/product/variant_price', 'HomeController@variant_price')->name('products.variant_price');
Route::get('/shops/visit/{slug}', 'HomeController@shop')->name('shop.visit');
Route::get('/shops/visit/{slug}/{type}', 'HomeController@filter_shop')->name('shop.visit.type');

Route::get('/cart', 'CartController@index')->name('cart');
Route::post('/cart/nav-cart-items', 'CartController@updateNavCart')->name('cart.nav_cart');
Route::post('/cart/cart/set_link', 'CartController@set_link')->name('cart.set_link');
Route::post('/cart/show-cart-modal', 'CartController@showCartModal')->name('cart.showCartModal');
Route::post('/cart/addtocart', 'CartController@addToCart')->name('cart.addToCart');
Route::post('/cart/setguestcheckout', 'CartController@setGuestCheckout')->name('cart.setGuestCheckout');
Route::post('/cart/removeFromCart', 'CartController@removeFromCart')->name('cart.removeFromCart');
Route::post('/cart/updateQuantity', 'CartController@updateQuantity')->name('cart.updateQuantity');
Route::post('/cart/removeCoupon', 'CartController@removeCoupon')->name('cart.removeCoupon');
Route::post('/cart/proceedToCheckout', 'CartController@proceedToCheckout')->name('cart.proceedToCheckout');
Route::post('/cart/proceedToGiftCheckout', 'CartController@proceedToGiftCheckout')->name('cart.proceedToGiftCheckout');
Route::post('/cart/campaignValidator', 'CartController@campaignValidator')->name('cart.campaignValidator');
Route::post('/cart/restofphilCampaign', 'CartController@RestOfPhilCampaignPrice')->name('cart.restofphilCampaign');






//user profile
Route::get('/information', 'CartController@information')->name('information');
Route::post('/information', 'CartController@store_user_info')->name('information.saveUserInfo');
Route::post('/information/set_billing_address', 'CartController@set_billing_address')->name('information.set_billing_address');
Route::post('/information/set_shipping_address', 'CartController@set_shipping_address')->name('information.set_shipping_address');

// for checkout
Route::get('/checkout', 'CheckoutController@get_shipping_info')->name('checkout.shipping_info');
Route::post('/checkout/store_shipping_info', 'CheckoutController@store_shipping_info')->name('checkout.store_shipping_info');

//for payment
Route::get('/checkout/payment_method', 'CheckoutController@select_payment_method')->name('checkout.select_payment_method');
Route::post('/checkout/payment_method', 'CheckoutController@payment_selected')->name('checkout.payment_selected');
Route::get('/checkout/gift_payment_method', 'CheckoutController@select_gift_give_payment_method')->name('checkout.giftgive_select');
Route::post('/checkout/gift_payment_method', 'CheckoutController@gift_give_payment_selected')->name('checkout.gift_give_payment_selected');

//GRABPAY
Route::get('/grabpay/payment_error', 'GrabPayController@payment_error')->name('grabpay.payment_error');
Route::get('/grabpay/callback', 'GrabPayController@callback')->name('grabpay.callback');
Route::post('/grabpay/listener', 'GrabPayController@receiveNotification')->name('grabpay.postnotification');


Route::post('/checkout/payment', 'CheckoutController@checkout')->name('payment.checkout');
Route::post('/checkout/give_gift_payment', 'CheckoutController@give_gift_checkout')->name('payment.give_gift_checkout');
Route::post('/checkout/deliver_from', 'CheckoutController@store_shipping_info')->name('checkout.deliver_from');

Route::get('/checkout/deliver_to', 'CheckoutController@get_delivery_to')->name('checkout.delivery_to');


Route::post('/checkout/confirm_info', 'CheckoutController@store_delivery_info')->name('checkout.confirm_info');
Route::get('/checkout/confirm_info/{id}', 'CheckoutController@confirm_info')->name('checkout.confirm_info_get');
Route::get('/checkout/edit_confirm_info/{id}', 'CheckoutController@edit_confirm_info')->name('checkout.edit_confirm_info');
Route::patch('/checkout/update_confirm_info/{id}', 'CheckoutController@update_confirm_info')->name('checkout.update_confirm_info');


Route::post('/checkout/payment_select', 'CheckoutController@payment_select')->name('checkout.payment_select');

Route::get('/checkout/payment_select/{id}', 'CheckoutController@get_payment_info')->name('checkout.payment_info');

Route::post('/checkout/apply_coupon_code', 'CheckoutController@apply_coupon_code')->name('checkout.apply_coupon_code');

Route::post('/checkout/remove_coupon_code', 'CheckoutController@remove_coupon_code')->name('checkout.remove_coupon_code');
Route::post('/checkout/payment_confirm', 'CheckoutController@payment_confirm')->name('checkout.payment_confirm');

Route::get('/checkout/order_confirm_page/{id}/thankyou/{billease?}', 'CheckoutController@order_confirm_page')->name('checkout.order_confirm_page');
Route::get('/checkout/order_confirm_page/{id}/processing', 'CheckoutController@order_process_page')->name('checkout.order_process_page');

Route::resource('/checkout/payment/paymongo', 'PaymongoController');

//Billease
Route::get('/billease/payment/approved/{id}', 'BilleaseController@confirm')->name('billease.confirm');
Route::post('/billease/payment/update', 'BilleaseController@update')->name('billease.confirm');
Route::post('/billease/ajax-payment/update','BilleaseController@order_payment_update')->name('billease.ajax');

//eGHL
Route::match(array('GET', 'POST'),'/eghl/payment/cancelled/{payment_id}', 'EghlController@cancelledPayment')->name('eghl.cancel');
Route::match(array('GET', 'POST'),'/eghl/payment/approved/{payment_id}', 'EghlController@confirmedPayment')->name('eghl.confirm');
Route::match(array('GET', 'POST'),'/eghl/payment/declined/{payment_id}', 'EghlController@declinedPayment')->name('eghl.decline');
Route::get('/eghl/payment/done', 'EghlController@getDone')->name('eghl.done');


//Paypal START

Route::get('/paypal/payment/done', 'PaypalController@getDone')->name('payment.done');
Route::get('/paypal/payment/cancel', 'PaypalController@getCancel')->name('payment.cancel');
Route::post('/paypal/checkout', 'PaypalController@createPayment')->name('create-payment');
Route::get('/paypal/confirm', 'PaypalController@confirmPayment')->name('confirm-payment');
//Paypal END

// SSLCOMMERZ Start
Route::get('/sslcommerz/pay', 'PublicSslCommerzPaymentController@index');
Route::POST('/sslcommerz/success', 'PublicSslCommerzPaymentController@success');
Route::POST('/sslcommerz/fail', 'PublicSslCommerzPaymentController@fail');
Route::POST('/sslcommerz/cancel', 'PublicSslCommerzPaymentController@cancel');
Route::POST('/sslcommerz/ipn', 'PublicSslCommerzPaymentController@ipn');
//SSLCOMMERZ END

//Stipe Start
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');
//Stripe END

Route::get('/compare', 'CompareController@index')->name('compare');
Route::get('/compare/reset', 'CompareController@reset')->name('compare.reset');
Route::post('/compare/addToCompare', 'CompareController@addToCompare')->name('compare.addToCompare');

Route::resource('subscribers','SubscriberController');

Route::get('/brands', 'HomeController@all_brands')->name('brands.all');
Route::get('/categories/{name}', 'HomeController@all_categories')->name('categories.all');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/search?q={search}', 'HomeController@search')->name('suggestion.search');
Route::get('/flashdeals?q={search}', 'HomeController@flashdeals')->name('flashdeals.search');
// Route::post('/ajax-search', 'HomeController@ajax_search')->name('search.ajax');
Route::post('/config_content', 'HomeController@product_content')->name('configs.update_status');

Route::get('/sellerpolicy', 'HomeController@sellerpolicy')->name('sellerpolicy');
Route::get('/returnpolicy', 'HomeController@returnpolicy')->name('returnpolicy');
Route::get('/supportpolicy', 'HomeController@supportpolicy')->name('supportpolicy');
Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/privacypolicy', 'HomeController@privacypolicy')->name('privacypolicy');

//abandoned cart
Route::get('/abandoned-cart', 'AbandonedController@index')->name('abandoned.cart');

Route::group(['middleware' => ['user', 'verified']], function(){

	Route::get('/myreviews', 'CustomerReviewController@index')->name('myreview');
	Route::get('/myreviews-history', 'CustomerReviewController@history')->name('myreview.history');
	Route::get('/myreviews/write-review', 'CustomerReviewController@write_review')->name('myreview.write_review');

	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
	Route::get('/profile', 'HomeController@profile')->name('profile');
    Route::get('/add-address', 'HomeController@add_address')->name('addAddress');
    Route::post('/add-address', 'HomeController@create_new_address')->name('add.new.address');
    Route::get('/delete-address/{id}', 'HomeController@delete_address')->name('address.destroy');
    Route::get('/edit-address/{id}', 'HomeController@edit_address')->name('address.edit');
    Route::patch('/edit-address/', 'HomeController@edit_address_update')->name('address.edit.update');





    Route::post('/customer/update-profile', 'HomeController@customer_update_profile')->name('customer.profile.update');
	Route::post('/seller/update-profile', 'HomeController@seller_update_profile')->name('seller.profile.update');

	Route::resource('purchase_history','PurchaseHistoryController');
	Route::post('/purchase_history/details', 'PurchaseHistoryController@purchase_history_details')->name('purchase_history.details');
	Route::get('/purchase_history/destroy/{id}', 'PurchaseHistoryController@destroy')->name('purchase_history.destroy');

	Route::resource('wishlists','WishlistController');
	Route::post('/wishlists/remove', 'WishlistController@remove')->name('wishlists.remove');

	Route::get('/wallet', 'WalletController@index')->name('wallet.index');
	Route::post('/recharge', 'WalletController@recharge')->name('wallet.recharge');

	Route::resource('support_ticket','SupportTicketController');
	Route::post('support_ticket/reply','SupportTicketController@seller_store')->name('support_ticket.seller_store');
});
Route::post('/add-address/get_region_id', 'HomeController@get_region_id')->name('address.get_region_id');
Route::post('/add-address/get_province_id', 'HomeController@get_province_id')->name('address.get_province_id');
Route::post('/add-address/get_city_id', 'HomeController@get_city_id')->name('address.get_city_id');


Route::group(['prefix' =>'seller', 'middleware' => ['seller', 'verified']], function(){
	Route::get('/products', 'HomeController@seller_product_list')->name('seller.products');
	Route::get('/product/upload', 'HomeController@show_product_upload_form')->name('seller.products.upload');
	Route::get('/product/{id}/edit', 'HomeController@show_product_edit_form')->name('seller.products.edit');
	Route::resource('payments','PaymentController');

	Route::get('/shop/apply_for_verification', 'ShopController@verify_form')->name('shop.verify');
	Route::post('/shop/apply_for_verification', 'ShopController@verify_form_store')->name('shop.verify.store');

	Route::get('/reviews', 'ReviewController@seller_reviews')->name('reviews.seller');
});

Route::group(['middleware' => ['auth']], function(){
	Route::post('/products/store/','ProductController@store')->name('products.store');
	Route::post('/products/update/{id}','ProductController@update')->name('products.update');
	Route::get('/products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
	Route::get('/products/duplicate/{id}', 'ProductController@duplicate')->name('products.duplicate');
	Route::post('/products/sku_combination', 'ProductController@sku_combination')->name('products.sku_combination');
	Route::post('/products/sku_combination_edit', 'ProductController@sku_combination_edit')->name('products.sku_combination_edit');
	Route::post('/products/featured', 'ProductController@updateFeatured')->name('products.featured');
	Route::post('/products/published', 'ProductController@updatePublished')->name('products.published');

	Route::get('invoice/customer/{order_id}', 'InvoiceController@customer_invoice_download')->name('customer.invoice.download');
	Route::get('invoice/seller/{order_id}', 'InvoiceController@seller_invoice_download')->name('seller.invoice.download');

	Route::resource('orders','OrderController');
	Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
	Route::post('/orders/details', 'OrderController@order_details')->name('orders.details');
	Route::post('/orders/update_delivery_status', 'OrderController@update_delivery_status')->name('orders.update_delivery_status');
	Route::post('/orders/update_payment_status', 'OrderController@update_payment_status')->name('orders.update_payment_status');

	Route::resource('/reviews', 'ReviewController');
});

Route::resource('shops', 'ShopController');
Route::get('/track_your_order', 'HomeController@trackOrder')->name('orders.track');

Route::get('/instamojo/payment/pay-success', 'InstamojoController@success')->name('instamojo.success');

Route::post('rozer/payment/pay-success', 'RazorpayController@payment')->name('payment.rozer');

Route::get('/paystack/payment/callback', 'PaystackController@handleGatewayCallback');
Route::get('/popup/image/{id}', 'PopupsController@popup_image')->name('popup.image');
Route::get('/page/construction', function(){
	return view('frontend.construction');
})->name('page.construction');

Route::get('/blogs/news', 'BlogController@home')->name('blogs.home');
Route::get('/blogs/pressrelease', 'BlogController@press_release')->name('blogs.press_release');
Route::get('/blogs/{slug}', 'BlogController@blog')->name('blogs.find');

Route::post('/users/register', 'Auth\RegisterController@register_user')->name('register.user');
Route::post('blog/upload_html_pic','BlogController@upload_html_pic')->name('blog.upload_html_pic');

Route::get('/products', function(){
    return redirect()->route('home');
});

