<?php

Route::group(['middleware' => 'fw-block-blacklisted'], function () 
{
    Auth::routes();

    Route::get('/', 'PageController@home')->name('home');

    Route::get('e-ticaret-paketlerimiz', 'ProductController@pack')->name('product.ecommerce.pack');
    Route::get('e-ticaret-ilave-moduller', 'ProductController@module')->name('product.ecommerce.module');

    Route::get('ozel-yazilim-gelistirme', 'ServiceController@project')->name('service.project');
    Route::get('kurumsal-web-sitesi-cozumleri', 'ServiceController@website')->name('service.website');
    Route::get('google-haritalara-kayit', 'ServiceController@google')->name('service.google');

    Route::get('referanslarimiz', 'ReferenceController@home')->name('reference');
    Route::get('online-odeme', 'PaymentController@payment')->name('payment');
    Route::get('hakkimizda', 'PageController@about')->name('about');

    Route::get('iletisim', 'MessageController@contact')->name('contact');
    Route::post('iletisim', 'MessageController@contact_save');

    Route::post('demo', 'MessageController@demo_save')->name('demo');
    Route::post('call', 'MessageController@call_save')->name('call');

    Route::get('confirm', 'Auth\RegisterController@confirm')->name('confirm');
    Route::post('order', 'MessageController@pack_order')->name('order');

    Route::group([
        'middleware' => ['auth', 'check'],
        'prefix' => 'user'
    ], function ($router) {

        Route::get('/', 'User\HomeController@index')->name('user.home');
        Route::get('solutions', 'User\HomeController@solutions')->name('user.solutions');

        Route::prefix('social')->group(function () {
            Route::get('cancel/{provider}', 'User\HomeController@social_cancel')->name('user.social.cancel');
        });

        Route::prefix('announce')->group(function () {
            Route::get('/', 'User\AnnounceController@home')->name('user.announce.home');
            Route::get('{id}/{domain}', 'User\AnnounceController@detail')->name('user.announce.detail');
        });

        Route::prefix('profile')->group(function () {
            Route::get('/', 'User\HomeController@profile')->name('user.profile');
            Route::post('/', 'User\HomeController@profile_update');
        });

        Route::prefix('password')->group(function () {
            Route::get('/', 'User\HomeController@password')->name('user.password');
            Route::post('/', 'User\HomeController@password_update');
        });

        Route::prefix('support')->group(function () {
            Route::get('/', 'User\SupportController@home')->name('user.support.home');
            Route::post('/', 'User\SupportController@home');
            Route::get('add', 'User\SupportController@add')->name('user.support.add');
            Route::post('add', 'User\SupportController@ticket_add');
            Route::get('detail/{id}', 'User\SupportController@detail')->name('user.support.detail');
            Route::post('detail/{id}', 'User\SupportController@reply_add')->name('user.support.reply');
        });

        Route::prefix('service')->group(function () {
            Route::get('/', 'User\ServiceController@home')->name('user.service.home');
            Route::post('/', 'User\ServiceController@home');
            Route::get('detail/{id}', 'User\ServiceController@detail')->name('user.service.detail');
            Route::post('cancel', 'User\ServiceController@cancel')->name('user.service.cancel');
        });

        Route::prefix('billing')->group(function () {
            Route::get('/', 'User\BillingController@home')->name('user.billing.home');
            Route::get('payment/{id}', 'User\BillingController@payment')->name('user.billing.payment');
            Route::post('payment/{id}', 'User\BillingController@payment_do');
            Route::post('paid', 'User\BillingController@is_paid')->name('user.billing.ispaid');
            Route::get('invoice/{id}', 'User\BillingController@invoice')->name('user.billing.invoice');
        });

        Route::prefix('faq')->group(function () {
            Route::get('/', 'User\FaqController@home')->name('user.faq.home');
            Route::get('category/{id}', 'User\FaqController@category')->name('user.faq.category');
            Route::get('detail/{id}', 'User\FaqController@detail')->name('user.faq.detail');
            Route::get('search', 'User\FaqController@search')->name('user.faq.search');
            Route::get('helpful/{id}/{helpful}', 'User\FaqController@helpful')->name('user.faq.helpful');
        });

        Route::prefix('partnership')->group(function () {
            Route::get('/', 'User\PartnershipController@home')->name('user.partnership.home');
            Route::get('add', 'User\PartnershipController@add')->name('user.partnership.add');
            Route::post('add', 'User\PartnershipController@store');
        });

        Route::prefix('email')->group(function () {
            Route::get('/', 'User\EmailController@home')->name('user.email.home');
            Route::get('{id}', 'User\EmailController@detail')->name('user.email.detail');
        });

    });

    Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('track/{id}', 'TrackController@ga')->name('track');

    Route::get('sitemap.xml', function(){
        $sitemap = App::make("sitemap");
        $sitemap->setCache('sitemap', 60);
        if (!$sitemap->isCached()) {
            $sitemap->add(route('home'), '2018-08-25T20:10:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('product.ecommerce.pack'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('product.ecommerce.module'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('service.project'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('service.website'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('service.google'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('reference'), '2018-08-26T12:30:00+02:00', '1.0', 'monthly');
            $sitemap->add(route('payment'), '2018-08-26T12:30:00+02:00', '0.9', 'never');        
            $sitemap->add(route('about'), '2018-08-26T12:30:00+02:00', '0.8', 'yearly');
            $sitemap->add(route('contact'), '2018-08-26T12:30:00+02:00', '0.8', 'yearly');
            $sitemap->add(URL::to('/login'), '2018-08-11T20:10:00+02:00', '1.0', 'monthly');
            $sitemap->add(URL::to('/register'), '2018-08-11T20:10:00+02:00', '0.7', 'never');
            $sitemap->add(URL::to('/password/reset'), '2018-08-11T20:10:00+02:00', '0.7', 'never');
        }
        return $sitemap->render('xml');
    });
});