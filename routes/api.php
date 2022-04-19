<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Lessons
    Route::post('lessons/media', 'LessonsApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonsApiController');

    // Tests
    Route::apiResource('tests', 'TestsApiController');

    // Questions
    Route::post('questions/media', 'QuestionsApiController@storeMedia')->name('questions.storeMedia');
    Route::apiResource('questions', 'QuestionsApiController');

    // Question Options
    Route::apiResource('question-options', 'QuestionOptionsApiController');

    // Test Results
    Route::apiResource('test-results', 'TestResultsApiController');

    // Test Answers
    Route::apiResource('test-answers', 'TestAnswersApiController');

    // Client
    Route::post('clients/media', 'ClientApiController@storeMedia')->name('clients.storeMedia');
    Route::apiResource('clients', 'ClientApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Project
    Route::post('projects/media', 'ProjectApiController@storeMedia')->name('projects.storeMedia');
    Route::apiResource('projects', 'ProjectApiController');

    // Basic Data
    Route::post('basic-datas/media', 'BasicDataApiController@storeMedia')->name('basic-datas.storeMedia');
    Route::apiResource('basic-datas', 'BasicDataApiController');

    // Contract
    Route::apiResource('contracts', 'ContractApiController');

    // Static Clause
    Route::post('static-clauses/media', 'StaticClauseApiController@storeMedia')->name('static-clauses.storeMedia');
    Route::apiResource('static-clauses', 'StaticClauseApiController');

    // Dynamic Clause
    Route::post('dynamic-clauses/media', 'DynamicClauseApiController@storeMedia')->name('dynamic-clauses.storeMedia');
    Route::apiResource('dynamic-clauses', 'DynamicClauseApiController');

    // Categories
    Route::apiResource('categories', 'CategoriesApiController');

    // Asset
    Route::post('assets/media', 'AssetApiController@storeMedia')->name('assets.storeMedia');
    Route::apiResource('assets', 'AssetApiController');

    // Rent
    Route::post('rents/media', 'RentApiController@storeMedia')->name('rents.storeMedia');
    Route::apiResource('rents', 'RentApiController');

    // Quotation
    Route::apiResource('quotations', 'QuotationApiController');

    // Rental Clause
    Route::post('rental-clauses/media', 'RentalClauseApiController@storeMedia')->name('rental-clauses.storeMedia');
    Route::apiResource('rental-clauses', 'RentalClauseApiController');

    // Approval
    Route::post('approvals/media', 'ApprovalApiController@storeMedia')->name('approvals.storeMedia');
    Route::apiResource('approvals', 'ApprovalApiController');

    // Event
    Route::apiResource('events', 'EventApiController');

    // Event Day
    Route::apiResource('event-days', 'EventDayApiController');

    // Venue
    Route::apiResource('venues', 'VenueApiController');

    // Event Witness
    Route::post('event-witnesses/media', 'EventWitnessApiController@storeMedia')->name('event-witnesses.storeMedia');
    Route::apiResource('event-witnesses', 'EventWitnessApiController');

    // Witness Category
    Route::apiResource('witness-categories', 'WitnessCategoryApiController');
});
