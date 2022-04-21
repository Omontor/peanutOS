<?php

Route::view('/', 'welcome');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/media', 'ClientController@storeMedia')->name('clients.storeMedia');
    Route::post('clients/ckmedia', 'ClientController@storeCKEditorImages')->name('clients.storeCKEditorImages');
    Route::resource('clients', 'ClientController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Project
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::resource('projects', 'ProjectController');

    // Basic Data
    Route::delete('basic-datas/destroy', 'BasicDataController@massDestroy')->name('basic-datas.massDestroy');
    Route::post('basic-datas/media', 'BasicDataController@storeMedia')->name('basic-datas.storeMedia');
    Route::post('basic-datas/ckmedia', 'BasicDataController@storeCKEditorImages')->name('basic-datas.storeCKEditorImages');
    Route::resource('basic-datas', 'BasicDataController');

    // Contract
    Route::delete('contracts/destroy', 'ContractController@massDestroy')->name('contracts.massDestroy');
    Route::resource('contracts', 'ContractController');

    // Static Clause
    Route::delete('static-clauses/destroy', 'StaticClauseController@massDestroy')->name('static-clauses.massDestroy');
    Route::post('static-clauses/media', 'StaticClauseController@storeMedia')->name('static-clauses.storeMedia');
    Route::post('static-clauses/ckmedia', 'StaticClauseController@storeCKEditorImages')->name('static-clauses.storeCKEditorImages');
    Route::resource('static-clauses', 'StaticClauseController');

    // Dynamic Clause
    Route::delete('dynamic-clauses/destroy', 'DynamicClauseController@massDestroy')->name('dynamic-clauses.massDestroy');
    Route::post('dynamic-clauses/media', 'DynamicClauseController@storeMedia')->name('dynamic-clauses.storeMedia');
    Route::post('dynamic-clauses/ckmedia', 'DynamicClauseController@storeCKEditorImages')->name('dynamic-clauses.storeCKEditorImages');
    Route::resource('dynamic-clauses', 'DynamicClauseController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Rent
    Route::delete('rents/destroy', 'RentController@massDestroy')->name('rents.massDestroy');
    Route::post('rents/media', 'RentController@storeMedia')->name('rents.storeMedia');
    Route::post('rents/ckmedia', 'RentController@storeCKEditorImages')->name('rents.storeCKEditorImages');
    Route::resource('rents', 'RentController');

    // Quotation
    Route::delete('quotations/destroy', 'QuotationController@massDestroy')->name('quotations.massDestroy');
    Route::resource('quotations', 'QuotationController');

    // Rental Clause
    Route::delete('rental-clauses/destroy', 'RentalClauseController@massDestroy')->name('rental-clauses.massDestroy');
    Route::post('rental-clauses/media', 'RentalClauseController@storeMedia')->name('rental-clauses.storeMedia');
    Route::post('rental-clauses/ckmedia', 'RentalClauseController@storeCKEditorImages')->name('rental-clauses.storeCKEditorImages');
    Route::resource('rental-clauses', 'RentalClauseController');

    // Approval
    Route::delete('approvals/destroy', 'ApprovalController@massDestroy')->name('approvals.massDestroy');
    Route::post('approvals/media', 'ApprovalController@storeMedia')->name('approvals.storeMedia');
    Route::post('approvals/ckmedia', 'ApprovalController@storeCKEditorImages')->name('approvals.storeCKEditorImages');
    Route::resource('approvals', 'ApprovalController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventController');

    // Event Day
    Route::delete('event-days/destroy', 'EventDayController@massDestroy')->name('event-days.massDestroy');
    Route::resource('event-days', 'EventDayController');

    // Venue
    Route::delete('venues/destroy', 'VenueController@massDestroy')->name('venues.massDestroy');
    Route::resource('venues', 'VenueController');

    // Event Witness
    Route::delete('event-witnesses/destroy', 'EventWitnessController@massDestroy')->name('event-witnesses.massDestroy');
    Route::post('event-witnesses/media', 'EventWitnessController@storeMedia')->name('event-witnesses.storeMedia');
    Route::post('event-witnesses/ckmedia', 'EventWitnessController@storeCKEditorImages')->name('event-witnesses.storeCKEditorImages');
    Route::resource('event-witnesses', 'EventWitnessController');

    // Witness Category
    Route::delete('witness-categories/destroy', 'WitnessCategoryController@massDestroy')->name('witness-categories.massDestroy');
    Route::resource('witness-categories', 'WitnessCategoryController');

    // Project Category
    Route::delete('project-categories/destroy', 'ProjectCategoryController@massDestroy')->name('project-categories.massDestroy');
    Route::resource('project-categories', 'ProjectCategoryController');

    // Project Story
    Route::delete('project-stories/destroy', 'ProjectStoryController@massDestroy')->name('project-stories.massDestroy');
    Route::post('project-stories/media', 'ProjectStoryController@storeMedia')->name('project-stories.storeMedia');
    Route::post('project-stories/ckmedia', 'ProjectStoryController@storeCKEditorImages')->name('project-stories.storeCKEditorImages');
    Route::resource('project-stories', 'ProjectStoryController');

    // Blog
    Route::delete('blogs/destroy', 'BlogController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::resource('pages', 'PageController');

    // Contact Form
    Route::delete('contact-forms/destroy', 'ContactFormController@massDestroy')->name('contact-forms.massDestroy');
    Route::resource('contact-forms', 'ContactFormController');

    // Project Documentation
    Route::delete('project-documentations/destroy', 'ProjectDocumentationController@massDestroy')->name('project-documentations.massDestroy');
    Route::post('project-documentations/media', 'ProjectDocumentationController@storeMedia')->name('project-documentations.storeMedia');
    Route::post('project-documentations/ckmedia', 'ProjectDocumentationController@storeCKEditorImages')->name('project-documentations.storeCKEditorImages');
    Route::resource('project-documentations', 'ProjectDocumentationController');

    // Documenation Chapter
    Route::delete('documenation-chapters/destroy', 'DocumenationChapterController@massDestroy')->name('documenation-chapters.massDestroy');
    Route::post('documenation-chapters/media', 'DocumenationChapterController@storeMedia')->name('documenation-chapters.storeMedia');
    Route::post('documenation-chapters/ckmedia', 'DocumenationChapterController@storeCKEditorImages')->name('documenation-chapters.storeCKEditorImages');
    Route::resource('documenation-chapters', 'DocumenationChapterController');

    // Chapter Content
    Route::delete('chapter-contents/destroy', 'ChapterContentController@massDestroy')->name('chapter-contents.massDestroy');
    Route::post('chapter-contents/media', 'ChapterContentController@storeMedia')->name('chapter-contents.storeMedia');
    Route::post('chapter-contents/ckmedia', 'ChapterContentController@storeCKEditorImages')->name('chapter-contents.storeCKEditorImages');
    Route::resource('chapter-contents', 'ChapterContentController');

    // Client Evaluation
    Route::delete('client-evaluations/destroy', 'ClientEvaluationController@massDestroy')->name('client-evaluations.massDestroy');
    Route::post('client-evaluations/media', 'ClientEvaluationController@storeMedia')->name('client-evaluations.storeMedia');
    Route::post('client-evaluations/ckmedia', 'ClientEvaluationController@storeCKEditorImages')->name('client-evaluations.storeCKEditorImages');
    Route::resource('client-evaluations', 'ClientEvaluationController');

    // Appointment
    Route::delete('appointments/destroy', 'AppointmentController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentController');

    // Asset Return
    Route::delete('asset-returns/destroy', 'AssetReturnController@massDestroy')->name('asset-returns.massDestroy');
    Route::post('asset-returns/media', 'AssetReturnController@storeMedia')->name('asset-returns.storeMedia');
    Route::post('asset-returns/ckmedia', 'AssetReturnController@storeCKEditorImages')->name('asset-returns.storeCKEditorImages');
    Route::resource('asset-returns', 'AssetReturnController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('messenger/create', 'MessengerController@createTopic')->name('messenger.createTopic');
    Route::post('messenger', 'MessengerController@storeTopic')->name('messenger.storeTopic');
    Route::get('messenger/inbox', 'MessengerController@showInbox')->name('messenger.showInbox');
    Route::get('messenger/outbox', 'MessengerController@showOutbox')->name('messenger.showOutbox');
    Route::get('messenger/{topic}', 'MessengerController@showMessages')->name('messenger.showMessages');
    Route::delete('messenger/{topic}', 'MessengerController@destroyTopic')->name('messenger.destroyTopic');
    Route::post('messenger/{topic}/reply', 'MessengerController@replyToTopic')->name('messenger.reply');
    Route::get('messenger/{topic}/reply', 'MessengerController@showReply')->name('messenger.showReply');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Team
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Tests
    Route::delete('tests/destroy', 'TestsController@massDestroy')->name('tests.massDestroy');
    Route::resource('tests', 'TestsController');

    // Questions
    Route::delete('questions/destroy', 'QuestionsController@massDestroy')->name('questions.massDestroy');
    Route::post('questions/media', 'QuestionsController@storeMedia')->name('questions.storeMedia');
    Route::post('questions/ckmedia', 'QuestionsController@storeCKEditorImages')->name('questions.storeCKEditorImages');
    Route::resource('questions', 'QuestionsController');

    // Question Options
    Route::delete('question-options/destroy', 'QuestionOptionsController@massDestroy')->name('question-options.massDestroy');
    Route::resource('question-options', 'QuestionOptionsController');

    // Test Results
    Route::delete('test-results/destroy', 'TestResultsController@massDestroy')->name('test-results.massDestroy');
    Route::resource('test-results', 'TestResultsController');

    // Test Answers
    Route::delete('test-answers/destroy', 'TestAnswersController@massDestroy')->name('test-answers.massDestroy');
    Route::resource('test-answers', 'TestAnswersController');

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Client
    Route::delete('clients/destroy', 'ClientController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/media', 'ClientController@storeMedia')->name('clients.storeMedia');
    Route::post('clients/ckmedia', 'ClientController@storeCKEditorImages')->name('clients.storeCKEditorImages');
    Route::resource('clients', 'ClientController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Project
    Route::delete('projects/destroy', 'ProjectController@massDestroy')->name('projects.massDestroy');
    Route::post('projects/media', 'ProjectController@storeMedia')->name('projects.storeMedia');
    Route::post('projects/ckmedia', 'ProjectController@storeCKEditorImages')->name('projects.storeCKEditorImages');
    Route::resource('projects', 'ProjectController');

    // Basic Data
    Route::delete('basic-datas/destroy', 'BasicDataController@massDestroy')->name('basic-datas.massDestroy');
    Route::post('basic-datas/media', 'BasicDataController@storeMedia')->name('basic-datas.storeMedia');
    Route::post('basic-datas/ckmedia', 'BasicDataController@storeCKEditorImages')->name('basic-datas.storeCKEditorImages');
    Route::resource('basic-datas', 'BasicDataController');

    // Contract
    Route::delete('contracts/destroy', 'ContractController@massDestroy')->name('contracts.massDestroy');
    Route::resource('contracts', 'ContractController');

    // Static Clause
    Route::delete('static-clauses/destroy', 'StaticClauseController@massDestroy')->name('static-clauses.massDestroy');
    Route::post('static-clauses/media', 'StaticClauseController@storeMedia')->name('static-clauses.storeMedia');
    Route::post('static-clauses/ckmedia', 'StaticClauseController@storeCKEditorImages')->name('static-clauses.storeCKEditorImages');
    Route::resource('static-clauses', 'StaticClauseController');

    // Dynamic Clause
    Route::delete('dynamic-clauses/destroy', 'DynamicClauseController@massDestroy')->name('dynamic-clauses.massDestroy');
    Route::post('dynamic-clauses/media', 'DynamicClauseController@storeMedia')->name('dynamic-clauses.storeMedia');
    Route::post('dynamic-clauses/ckmedia', 'DynamicClauseController@storeCKEditorImages')->name('dynamic-clauses.storeCKEditorImages');
    Route::resource('dynamic-clauses', 'DynamicClauseController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Rent
    Route::delete('rents/destroy', 'RentController@massDestroy')->name('rents.massDestroy');
    Route::post('rents/media', 'RentController@storeMedia')->name('rents.storeMedia');
    Route::post('rents/ckmedia', 'RentController@storeCKEditorImages')->name('rents.storeCKEditorImages');
    Route::resource('rents', 'RentController');

    // Quotation
    Route::delete('quotations/destroy', 'QuotationController@massDestroy')->name('quotations.massDestroy');
    Route::resource('quotations', 'QuotationController');

    // Rental Clause
    Route::delete('rental-clauses/destroy', 'RentalClauseController@massDestroy')->name('rental-clauses.massDestroy');
    Route::post('rental-clauses/media', 'RentalClauseController@storeMedia')->name('rental-clauses.storeMedia');
    Route::post('rental-clauses/ckmedia', 'RentalClauseController@storeCKEditorImages')->name('rental-clauses.storeCKEditorImages');
    Route::resource('rental-clauses', 'RentalClauseController');

    // Approval
    Route::delete('approvals/destroy', 'ApprovalController@massDestroy')->name('approvals.massDestroy');
    Route::post('approvals/media', 'ApprovalController@storeMedia')->name('approvals.storeMedia');
    Route::post('approvals/ckmedia', 'ApprovalController@storeCKEditorImages')->name('approvals.storeCKEditorImages');
    Route::resource('approvals', 'ApprovalController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::resource('events', 'EventController');

    // Event Day
    Route::delete('event-days/destroy', 'EventDayController@massDestroy')->name('event-days.massDestroy');
    Route::resource('event-days', 'EventDayController');

    // Venue
    Route::delete('venues/destroy', 'VenueController@massDestroy')->name('venues.massDestroy');
    Route::resource('venues', 'VenueController');

    // Event Witness
    Route::delete('event-witnesses/destroy', 'EventWitnessController@massDestroy')->name('event-witnesses.massDestroy');
    Route::post('event-witnesses/media', 'EventWitnessController@storeMedia')->name('event-witnesses.storeMedia');
    Route::post('event-witnesses/ckmedia', 'EventWitnessController@storeCKEditorImages')->name('event-witnesses.storeCKEditorImages');
    Route::resource('event-witnesses', 'EventWitnessController');

    // Witness Category
    Route::delete('witness-categories/destroy', 'WitnessCategoryController@massDestroy')->name('witness-categories.massDestroy');
    Route::resource('witness-categories', 'WitnessCategoryController');

    // Project Category
    Route::delete('project-categories/destroy', 'ProjectCategoryController@massDestroy')->name('project-categories.massDestroy');
    Route::resource('project-categories', 'ProjectCategoryController');

    // Project Story
    Route::delete('project-stories/destroy', 'ProjectStoryController@massDestroy')->name('project-stories.massDestroy');
    Route::post('project-stories/media', 'ProjectStoryController@storeMedia')->name('project-stories.storeMedia');
    Route::post('project-stories/ckmedia', 'ProjectStoryController@storeCKEditorImages')->name('project-stories.storeCKEditorImages');
    Route::resource('project-stories', 'ProjectStoryController');

    // Blog
    Route::delete('blogs/destroy', 'BlogController@massDestroy')->name('blogs.massDestroy');
    Route::post('blogs/media', 'BlogController@storeMedia')->name('blogs.storeMedia');
    Route::post('blogs/ckmedia', 'BlogController@storeCKEditorImages')->name('blogs.storeCKEditorImages');
    Route::resource('blogs', 'BlogController');

    // Page
    Route::delete('pages/destroy', 'PageController@massDestroy')->name('pages.massDestroy');
    Route::post('pages/media', 'PageController@storeMedia')->name('pages.storeMedia');
    Route::post('pages/ckmedia', 'PageController@storeCKEditorImages')->name('pages.storeCKEditorImages');
    Route::resource('pages', 'PageController');

    // Contact Form
    Route::delete('contact-forms/destroy', 'ContactFormController@massDestroy')->name('contact-forms.massDestroy');
    Route::resource('contact-forms', 'ContactFormController');

    // Project Documentation
    Route::delete('project-documentations/destroy', 'ProjectDocumentationController@massDestroy')->name('project-documentations.massDestroy');
    Route::post('project-documentations/media', 'ProjectDocumentationController@storeMedia')->name('project-documentations.storeMedia');
    Route::post('project-documentations/ckmedia', 'ProjectDocumentationController@storeCKEditorImages')->name('project-documentations.storeCKEditorImages');
    Route::resource('project-documentations', 'ProjectDocumentationController');

    // Documenation Chapter
    Route::delete('documenation-chapters/destroy', 'DocumenationChapterController@massDestroy')->name('documenation-chapters.massDestroy');
    Route::post('documenation-chapters/media', 'DocumenationChapterController@storeMedia')->name('documenation-chapters.storeMedia');
    Route::post('documenation-chapters/ckmedia', 'DocumenationChapterController@storeCKEditorImages')->name('documenation-chapters.storeCKEditorImages');
    Route::resource('documenation-chapters', 'DocumenationChapterController');

    // Chapter Content
    Route::delete('chapter-contents/destroy', 'ChapterContentController@massDestroy')->name('chapter-contents.massDestroy');
    Route::post('chapter-contents/media', 'ChapterContentController@storeMedia')->name('chapter-contents.storeMedia');
    Route::post('chapter-contents/ckmedia', 'ChapterContentController@storeCKEditorImages')->name('chapter-contents.storeCKEditorImages');
    Route::resource('chapter-contents', 'ChapterContentController');

    // Client Evaluation
    Route::delete('client-evaluations/destroy', 'ClientEvaluationController@massDestroy')->name('client-evaluations.massDestroy');
    Route::post('client-evaluations/media', 'ClientEvaluationController@storeMedia')->name('client-evaluations.storeMedia');
    Route::post('client-evaluations/ckmedia', 'ClientEvaluationController@storeCKEditorImages')->name('client-evaluations.storeCKEditorImages');
    Route::resource('client-evaluations', 'ClientEvaluationController');

    // Appointment
    Route::delete('appointments/destroy', 'AppointmentController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentController');

    // Asset Return
    Route::delete('asset-returns/destroy', 'AssetReturnController@massDestroy')->name('asset-returns.massDestroy');
    Route::post('asset-returns/media', 'AssetReturnController@storeMedia')->name('asset-returns.storeMedia');
    Route::post('asset-returns/ckmedia', 'AssetReturnController@storeCKEditorImages')->name('asset-returns.storeCKEditorImages');
    Route::resource('asset-returns', 'AssetReturnController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
