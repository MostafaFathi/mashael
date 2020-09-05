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

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

Route::group(['namespace' => 'Admin' , 'prefix' => config('app.admin_prefix') ,'as' => 'admin::' ], function () {

    Route::group(['namespace' => 'Auth' , 'middleware' => 'guest'], function () {

        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::post('login','LoginController@login')->name('login');
        Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/reset','ResetPasswordController@reset')->name('password.request');
        Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

        Route::post('logout','LoginController@logout')->name('logout');

    });

    Route::group(['middleware' => 'adminAuth' ], function () {

        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/setting', 'HomeController@settings')->name('settings');
        Route::post('/setting', 'HomeController@settings_post');

        Route::resource('administrator', 'AdministratorController');
        Route::resource('trainer', 'TrainerController');
        Route::resource('user', 'UserController');
        Route::resource('page', 'PageController');
        Route::resource('category', 'CategoryController');
        Route::resource('course', 'CourseController');
        Route::resource('workshop', 'WorkshopController');
        Route::resource('session', 'SessionController');
        Route::resource('lesson', 'LessonController');
        Route::resource('type', 'TypeController');
        Route::resource('order', 'OrderController');
        Route::resource('testimonial', 'TestimonialController');
        Route::resource('partner', 'PartnerController');
        Route::post('order/approve/{id}', 'OrderController@approve')->name('order.approve');
        Route::post('order/cancel/{id}', 'OrderController@cancel')->name('order.cancel');
        Route::resource('contact', 'ContactController');
        Route::post('contact/reading/{id}', 'OrderController@reading')->name('contact.reading');
        Route::post('contact/cancel/{id}', 'OrderController@cancel')->name('contact.cancel');
        Route::resource('question', 'QuestionController');
        Route::resource('answer', 'AnswerController');
//        Route::resource('certificate', 'CertificateController');
        Route::resource('transaction', 'TransactionController');
        Route::resource('email', 'EmailController');
        Route::resource('myshare', 'MyshareController');

    });

});

Route::group(['namespace' => 'Site' ,'as' => 'site::' ], function () {

    Route::group(['namespace' => 'Auth' , 'middleware' => 'guest'], function () {

        Route::get('login','LoginController@showLoginForm')->name('login');
        Route::post('login','LoginController@login')->name('login');
        Route::get('register','RegisterController@showRegistrationForm')->name('register');
        Route::post('register','RegisterController@register')->name('register');
        Route::post('password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('password/reset','ResetPasswordController@reset')->name('password.request');
        Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

    });

    Route::group(['middleware' => 'auth'], function () {
        Route::post('logout','Auth\LoginController@logout')->name('logout');
        Route::get('/course/{id}/order', 'HomeController@order')->name('course_order');
        Route::post('/course/{id}/order', 'HomeController@orderPost');
        Route::get('/workshop/{id}/order', 'HomeController@workshopOrder')->name('workshop_order');
        Route::post('/workshop/{id}/order', 'HomeController@workshopOrderPost');

        Route::get('/session/{id}/order', 'HomeController@sessionOrder')->name('session_order');
        Route::post('/session/{id}/order', 'HomeController@sessionOrderPost');

        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::post('/profile', 'HomeController@postProfile');
        Route::post('/comment/{id}', 'HomeController@postComment');
        Route::get('/profile/course', 'HomeController@profileCourse')->name('profile.course');
        Route::get('/profile/question', 'HomeController@profileQuestions')->name('profile.question');
        Route::get('/profile/addQuestion', 'HomeController@addQuestion')->name('profile.addQuestion');
        Route::post('/profile/addQuestion', 'HomeController@postQuestion');
    });

    Route::get('/getSession', 'HomeController@getSession')->name('get_session');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/category/{id}', 'HomeController@category')->name('category');
    Route::get('/course', 'HomeController@courses')->name('courses');
    Route::get('/workshop', 'HomeController@workshops')->name('workshops');
    Route::get('/workshop/{id}', 'HomeController@workshop')->name('workshop');
    Route::get('/comments', 'HomeController@comments')->name('comments');
    Route::get('/course/{id}', 'HomeController@course')->name('course');
    Route::get('/comment/{id}', 'HomeController@comment')->name('comment');
    Route::get('/comment-workshop/{id}', 'HomeController@comment_workshop')->name('comment_workshop');
    Route::get('/aboutus', 'HomeController@trainer')->name('trainer');
    Route::get('/lesson/{id}', 'HomeController@lesson')->name('lesson');
    Route::get('/page/{id}', 'HomeController@page')->name('page');
    Route::post('/addEmail', 'HomeController@addEmail')->name('addEmail');
    Route::get('/contactus', 'HomeController@contactus')->name('contactus');
    Route::post('/contactus', 'HomeController@contactPost');
    Route::post('/callback', 'HomeController@callback')->name('callback');
    Route::get('/myshare', 'HomeController@myshares')->name('myshares');
    Route::get('/myshare/{id}', 'HomeController@myshare')->name('myshare');

});

Route::get('/foo', function () {
    $user =  User::where('email','kmal.alomari@gmail.com')->first();

    Mail::send('emails.register', ['user' => $user], function ($message) use ($user)
    {
        $message->from('no-reply@coachmashael.com', 'coach mashael');
        $message->to($user->email);
    });


    return $user;
});
