<?php
Auth::routes();

Route::group(['middleware' => 'auth'],function(){
    //Dashboard
    Route::get('/', 'HomeController@index')->name('home');
    //Enquiry
    Route::group(['middleware' => 'enquiryAuth'], function() {
        Route::resource('/enquiry', 'EnquiryController');
        Route::get('/enquiryData','EnquiryController@get_data');
        Route::POST('/enquiry/sendEnquiryReply','EnquiryController@sendEnquiryReply');
        Route::get('/api/update_enquiry_status','AjaxController@update_enquiry_status');
        Route::get('/api/faqs','AjaxController@faqs');
    });
    //Student
    Route::group(['middleware' => 'studentListAuth'], function() {
         Route::resource('/student-list', 'StudentListController');
         Route::resource('/agent-student-list', 'AgentStudentListController');
    });
    //Registration Form
    Route::group(['middleware' => 'regFormAuth'], function() {
        Route::get('/registration-form/step1/{student_id}','RegistrationFormController@showRegOneForm');
        Route::get('/registration-form/step1/edit/{student_id}','RegistrationFormController@editRegOneForm');
        Route::put('/registration-form/step1/edit','RegistrationFormController@updateRegOneForm');
        Route::post('/registration-form/step1','RegistrationFormController@submitRegOneForm');
        Route::get('/registration-form/step2/{student_id}','RegistrationFormController@showRegTwoForm');
        Route::post('/registration-form/step2','RegistrationFormController@submitRegTwoForm');
        Route::put('/registration-form/step2/edit','RegistrationFormController@updateRegTwoForm');
        Route::get('/registration-form/step3/{student_id}','RegistrationFormController@showRegThreeForm');
        Route::post('/registration-form/step3','RegistrationFormController@updateRegThreeForm');
        Route::post('/registration-form/form','RegistrationFormController@submitForm');
        Route::resource('/registration-form','RegistrationFormController');


        Route::get('/agent-registration-form/step1/{student_id}','AgentRegistrationFormController@showRegOneForm');
        Route::get('/agent-registration-form/step1/edit/{student_id}','AgentRegistrationFormController@editRegOneForm');
        Route::put('/agent-registration-form/step1/edit','AgentRegistrationFormController@updateRegOneForm');
        Route::post('/agent-registration-form/step1','AgentRegistrationFormController@submitRegOneForm');
        Route::get('/agent-registration-form/step2/{student_id}','AgentRegistrationFormController@showRegTwoForm');
        Route::post('/agent-registration-form/step2','AgentRegistrationFormController@submitRegTwoForm');
        Route::put('/agent-registration-form/step2/edit','AgentRegistrationFormController@updateRegTwoForm');
        Route::get('/agent-registration-form/step3/{student_id}','AgentRegistrationFormController@showRegThreeForm');
        Route::post('/agent-registration-form/step3','AgentRegistrationFormController@updateRegThreeForm');
        Route::post('/agent-registration-form/form','AgentRegistrationFormController@submitForm');
        Route::resource('/agent-registration-form','AgentRegistrationFormController');
    });
    //Blogs
    Route::group(['middleware' => 'blogsAuth'], function() {
        Route::get('/delete/banner/{id}','BlogsController@deleteBannerImage');
        Route::get('/articles/edit/{id}','ArticleController@get_data');
        Route::post('/articles/update/{id}','ArticleController@update');
        Route::resource('/blogs','BlogsController');
        Route::resource('/articles','ArticleController');
        Route::post('/statistics/category','StatisticsController@createCategory');
        Route::resource('statistics','StatisticsController');
    });
    //settings
    Route::group(['middleware' => 'settingsAuth'], function() {
      Route::resource('/users','settings\usersController');
      Route::resource('/settings','settings\departmentController');
      Route::get('/api/user/statusUpdate/{id}','settings\usersController@update');
    });
    //course-list
    Route::group(['middleware' => 'courseListAuth'],function(){
        Route::resource("stage","StageController");
        Route::post('/course/shortlist','CourseController@shortlist');
        Route::resource('/course-list','CourseController');
        Route::resource('/agent-course-list','AgentCourseController');
        Route::get('/api/remarks/details/course-list','CourseController@remarks');
        Route::post('/api/remarks/course-list','CourseController@Submitremarks');
        Route::post('/api/course/sendmail','CourseController@sendmail');
        Route::get('/api/course/sendmail','CourseController@sendmail');
        Route::post('/course-list/assign-course','CourseController@assign_course');
        Route::get('course/withdrawl/{id}','CourseController@confirm_withdrawl');
    });

    Route::group(['middleware' => 'courseListAuth'],function(){
        Route::resource('/downloads','DownloadController');
    });
     //request free info
    Route::resource('request-free-info','RequestFreeInfoController');
    //application
    Route::get('/application/status-documents/','applicationController@getApplicationStatusDocumentOfStudent');
    Route::get('/application/student/status/{id}','applicationController@getApplicationStatusOfStudent');
    
    Route::get('/agentapplication/student/status/{id}','agentapplicationController@getApplicationStatusOfStudent');

    Route::post('/application/status-documents/add','applicationController@AddApplicationStatusDocumentOfStudent');
    Route::post('application/update-student-status','applicationController@updateApplicationStatusOfStudent');
    Route::post('application/agent-update-student-status','agentapplicationController@updateApplicationStatusOfStudent');

    Route::delete('/application/status-documents/delete/{id}','applicationController@deleteApplicationStatusOfStudent');

    Route::get('/api/remarks/details/application-list','applicationController@remarks');
    Route::post('/api/remarks/application-list','applicationController@submitRemarks');

    Route::resource('application','applicationController');
    Route::resource('agentapplication','agentapplicationController');
    Route::get('/documents/category-based-on-behalfOf','AjaxController@get_category_based_on_behalf_of');
    Route::get('/documents/documents-base-on-category','AjaxController@documents_base_on_category');
    Route::get('/documents/course-based-on-student-id','AjaxController@course_based_on_student_id');
    Route::resource('/documents','DocumentController');

    //visa
    Route::post('/visa/processed-by','VisaController@updateProcessBy');
    Route::post('/visa/withdraw','VisaController@updateWithdrawnStatus');
    Route::post('/visa/dependent','VisaController@updateDependent');
    Route::post('/visa/status','VisaController@statusUpdate');
    Route::resource('/visa','VisaController');
    // send email
    Route::post('/send-email','HomeController@send_email');



//    Route::post('application/assign','applicationController@assign');
//    Route::post('application/send_email','applicationController@send_mail');
//    Route::post('application/update_status','applicationController@update_status');
//    Route::post('application/document','applicationController@document_upload');
//
//    Route::get('/api/university_based_on_country_id','applicationController@university_based_on_country_id');
//    Route::get('/api/department_based_on_university_id','applicationController@department_based_on_university_id');
//    Route::get('/api/get_email_of_application_university_agent','AjaxController@get_email_of_application_university_agent');


    Route::get('/notifications','HomeController@notifications');
    Route::get('/notifications/{id}','HomeController@notificationsMarkAsRead');
    Route::get('/student','StudentController@index');
    Route::get('/agentstudent','AgentStudentController@index');







});
