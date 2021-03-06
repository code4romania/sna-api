<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'v1/auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });
    
    $api->group(['prefix' => 'v1/'], function(Router $api) {
        $api->get('indicators', 'App\\Api\\V1\\Controllers\\QuestionsController@listAll');
        $api->get('indicators/{category}', 'App\\Api\\V1\\Controllers\\QuestionsController@getByStep');
        $api->get('counties', 'App\\Api\\V1\\Controllers\\CountiesController@listAll');
        $api->get('institutions/{type}', 'App\\Api\\V1\\Controllers\\InstitutionsController@getByType');
        $api->get('categories', 'App\\Api\\V1\\Controllers\\StepsController@listAll');
        $api->get('answers/{institutionType}', 'App\\Api\\V1\\Controllers\\AnswersController@listByInstitutionType');
    });

    /* $api->group(['middleware' => 'jwt.auth', 'prefix' => 'v1/'], function(Router $api) {
        $api->get('questions', 'App\\Api\\V1\\Controllers\\QuestionsController@listAll');
        $api->get('questions/{step}', 'App\\Api\\V1\\Controllers\\QuestionsController@getByStep');
        $api->get('counties', 'App\\Api\\V1\\Controllers\\CountiesController@listAll');
        $api->get('institutions/{type}', 'App\\Api\\V1\\Controllers\\InstitutionsController@getByType');
        $api->get('steps', 'App\\Api\\V1\\Controllers\\StepsController@listAll');

        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to this item is only for authenticated user. Provide a token in your request!'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    }); */

    $api->get('v1/hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
