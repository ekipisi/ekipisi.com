<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    
    $router->get('/', 'HomeController@index');

    $router->resources([
        'messages' => MessageController::class,
        'users' => UserController::class,
        'services' => UserProductController::class,
        'billings' => BillingController::class,
        'currency' => CurrencyController::class,
        'paymenttypes' => PaymentTypeController::class,
        'periods' => PeriodController::class,
        'products' => ProductController::class,
        'tickets' => TicketController::class,
        'departments' => DepartmentController::class,
        'ticketstatus' => TicketStatusController::class,
        'ticketpriority' => TicketPriorityController::class,
        'tickettype' => TicketTypeController::class,
        'solutioncategory' => SolutionCategoryController::class,
        'solutions' => SolutionController::class,
        'faqcategory' => FaqCategoryController::class,
        'faqs' => FaqController::class,
        'announces' => AnnounceController::class,
        'features' => FeatureController::class,
        'references' => ReferenceController::class,
        'languages' => LanguageController::class,
        'partnerships' => PartnershipController::class,
        'sectors' => SectorController::class,
        'announce_sliders' => AnnounceSliderController::class,
        'firewall' => FirewallController::class,
        'tracker' => TrackerController::class,
    ]);

    $router->prefix('users/{id}/')->group(function () use ($router) {
        $router->get('detail', 'UserController@detail')->name('customer.detail');
        $router->post('addnote', 'UserController@addnote');
        $router->get('deletenote/{note_id}', 'UserController@deletenote');
        $router->get('updatenote/{note_id}', 'UserController@updatenote');
        $router->get('delete', 'UserController@deleteuser');
    });

    $router->post('messages/{id}/updatenote', 'MessageController@updatenote');

    $router->prefix('tickets/{id}/')->group(function () use ($router) {
        $router->get('delete', 'TicketController@delete');
        $router->post('update', 'TicketController@update');
        $router->get('detail', 'TicketController@detail');
        $router->post('addreply', 'TicketController@addreply');
        $router->get('deletereply/{reply_id}', 'TicketController@deletereply');
        $router->post('merge', 'TicketController@merge');
    });

    $router->prefix('tracker')->group(function () use ($router) {
        $router->get('detail/{id}', 'TrackerController@detail');
        $router->get('block/{id}', 'TrackerController@block');
        $router->get('unblock/{id}', 'TrackerController@unblock');
    });

    $router->post('tickets/close', 'TicketController@close');

    $router->get('email_activity/{id}', function ($id) {
        $email = Cache::remember('mail-activity-' . $id, 1200, function () use($id) {
            return App\Models\UserMailActivityModel::where(['id' => $id])->first();
        });
        return $email->message;
    });

    $router->get('/clearcache', function () {
        Cache::flush();
        admin_toastr('Cache Cleared.');
        return redirect()->back();
    });

    $router->prefix('api')->group(function () use ($router) {
        $router->get('make_url', 'ApiController@makeurl');
        $router->get('refresh_currency', 'ApiController@refresh_currency');
        $router->get('currency', 'ApiController@currency');
        $router->get('user', 'ApiController@user');
        $router->get('department', 'ApiController@department');
        $router->get('userproduct', 'ApiController@userproduct');
        $router->get('userservice', 'ApiController@userservice');
        $router->get('userservicedetail', 'ApiController@userservicedetail');
        $router->get('ticketstatus', 'ApiController@ticketstatus');
        $router->get('ticketpriority', 'ApiController@ticketpriority');
        $router->get('tickettype', 'ApiController@tickettype');
        $router->get('country', 'ApiController@country');
        $router->get('zone', 'ApiController@zone');
        $router->get('zone/list', 'ApiController@zone_list');
        $router->get('taxoffice', 'ApiController@taxoffice');
        $router->get('domain_user', 'ApiController@domain_user');
    });


});
