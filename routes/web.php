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

Route::get('/', 'UserController@index'); 
Route::get('about','UserController@about');
Route::get('contact','profileController@contact');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function () {
 

Route::get('profile/{id?}','profileController@show');
Route::get('post/','postController@index');
Route::get('post/{id}','postController@show');
Route::get('reg','registerController@index');
Route::post('reg','registerController@save');
Route::get('register_delete/{id?}','registerController@delete');
Route::get('register_edit/{id?}','registerController@edit');
Route::post('register_edit','registerController@update');

Route::get('mylogin','registerController@login_index');
Route::post('mylogin','registerController@login');
Route::get('mylogout','registerController@logout');
Route::get('sites','siteController@index');
Route::get('myapi/{id?}','apiController@index');
Route::get('/super_admin','SuperController@index');
Route::get('/super_admin/register','SuperController@register');
Route::get('/super_admin/publisher','SuperController@publisher');
Route::post('/publisher/add_publisher','PublisherController@add_publisher');
Route::post('/publisher/edit_publisher','PublisherController@edit_publisher');
Route::get('/publisher/delete_publisher/{id}/{user_id}','PublisherController@delete_publisher');
Route::get('/publisher/profile','PublisherController@profile');
Route::get('/publisher/activate_publisher/{id}','PublisherController@activate_publisher');
Route::post('/publisher/change_password','PublisherController@change_password');


Route::post('/publisher/update_publisher','PublisherController@update_publisher');
Route::get('/school','SchoolController@index');
Route::post('/school/add_school','SchoolController@add_school');

Route::get('/html_templat/{?}/{?}/{?}','SchoolController@show_e_book');
Route::get('/html_templat/{first_att}/{second_att}/{third_att}','SchoolController@show_e_book');
Route::post('/school/edit_school','SchoolController@edit_school');
Route::get('/school/delete_school/{id}','SchoolController@delete_school');
Route::get('/school/activate_school/{id}','SchoolController@activate_school');
Route::get('/files/basic_html','SchoolController@basic_html');
Route::get('/files/mobile_html','SchoolController@mobile_html');
Route::get('/accesscode','BookController@index');
Route::post('/accesscode/add_book','BookController@add_book');
Route::post('/accesscode/edit_book','BookController@edit_book');
Route::get('/accesscode/delete_book/{id}','BookController@delete_book');
Route::get('/accesscode/activate_book/{id}/{status}','BookController@activate_book');
Route::post('accesscode/fetch','BookController@fetchcode');
Route::post('/series/fetch','BookController@fetch_series');

Route::post('teacher/fetch','TeacherController@fetchteacher');

Route::get('/accesscode/assign','BookController@assign_accesscode');
Route::post('/assign/assign_code','AssignController@assign_code');
Route::get('/assign/delete_assign/{id}','AssignController@delete_assign');
Route::get('/assign/activate_assign/{id}/{status}','AssignController@activate_assign');

Route::get('/series','SeriesController@index');
Route::post('/series/add_series','SeriesController@add_series');
Route::post('/series/edit_series','SeriesController@edit_series');
Route::get('/series/delete_series/{id}','SeriesController@delete_series');
Route::get('/series/activate_series/{id}/{status}','SeriesController@activate_series');


Route::get('/class_master','ClassController@index');
Route::post('/class_master/add_class','ClassController@add_class');
Route::post('/class_master/edit_class','ClassController@edit_class');
Route::get('/class_master/delete_class/{id}','ClassController@delete_class');
Route::get('/class_master/activate_class/{id}/{status}','ClassController@activate_class');


Route::get('/subject_master','SubjectController@index');
Route::post('/subject_master/add_subject','SubjectController@add_subject');
Route::post('/subject_master/edit_subject','SubjectController@edit_subject');
Route::get('/subject_master/delete_subject/{id}','SubjectController@delete_subject');
Route::get('/subject_master/activate_subject/{id}/{status}','SubjectController@activate_subject');

Route::get('/chapter/chapter_list','ChapterController@index');
Route::post('/chapter/add_chapter','ChapterController@add_chapter');
Route::get('/chapter/delete_chapter/{id}','ChapterController@delete_chapter');
Route::get('/chapter/activate_chapter/{id}/{status}','ChapterController@activate_chapter');

Route::post('/chapter/fetch','ChapterController@fetch');
Route::post('/class/fetch','ClassController@fetchClass');


Route::post('school/fetch','SchoolController@fetch');

Route::get('/send/send_feedback', 'EmailController@sendFeedback');


Route::get('/sendEmail','EmailController@sendEmail');

Route::post('ebook_licence/save','EbookLicenceController@store_licence_record');

Route::get('/replace_matching_string/{slug}/{book_title}','UserController@replace_matching_string');

Route::get('ebook_licence','EbookLicenceController@ebook_licence_list');
Route::post('/ebook_licence/update','EbookLicenceController@update');
Route::get('/ebook_licence/delete/{id}','EbookLicenceController@delete');
Route::get('/schools','SchoolController@list');
Route::post('/school/add_school','SchoolController@save');
Route::post('/school/update','SchoolController@update');
Route::get('/school/delete/{id}','SchoolController@delete');
Route::post('/school/ebook_licence','SchoolController@ebook_licence');
Route::post('/school/ebook_licence_new','SchoolController@ebook_licence2');
Route::post('/school/e_book_licence_verification','SchoolController@e_book_verify');
Route::get('/schools/profile','SchoolController@profile');
Route::get('/ebook_licence/assign/{id}','SchoolController@assign_licence');

Route::get('/ebook_link/{id}/{ebook_id}','EbookLicenceController@ebook_link');

Route::get('/school/genrate_test/{assess_code_id}','SchoolController@genrate_test');
Route::get('/school/school_profile','SchoolController@profile');
Route::get('/school/view_test_paper','SchoolController@view_test_paper');
Route::get('school/contact_us','SchoolController@contact_us');
Route::get('/school/services','ServicesController@school_services_list');
Route::get('/school/licence_info/{id}','SchoolController@licence_info');

Route::get('/school/start_reading/{id}','SchoolController@start_reading');
Route::get('/school/new_school_list','SchoolController@new_school_list');
Route::post('/school/reader_start_reading','SchoolController@reader_start_reading');

Route::get('/book_readers','SuperController@total_book_reader');
Route::get('/school/on_closetab','SchoolController@on_closetab');
Route::post('/school/send_otp','SchoolController@send_otp');

Route::post('/school/change_password','SchoolController@change_password');

Route::get('/reset_password','SuperController@reset_password');
Route::post('/change_password','SuperController@change_password');
Route::get('school/my_profile','SchoolController@my_profile');
Route::post('/school/update_profile','SchoolController@update_profile');
Route::get('/teacher/services','ServicesController@teacher_services_list');
Route::post('/chapter/edit_chapter','ChapterController@edit_chapter');
Route::get('/chapter_list/{id}','ChapterController@chapter_list');
Route::get('/provided_licence_list/{id}','EbookAssignedController@provided_licence_list');
Route::post('/bulk_import/add_bulk_question','QuestionController@bulk_import');
Route::get('bulk_question_delete','QuestionController@bulk_question_delete');
Route::post('//bulk_delete/question_bulk_delete','QuestionController@question_bulk_delete');
Route::get('/my_books','EbookAssignedController@my_books');
Route::get('/issue_ebooks','EbookAssignedController@issue_ebooks');
Route::post('/member/fetch','EbookAssignedController@fetch');
Route::post('/ebook/issue_to_member','EbookAssignedController@issue_to_member');

});
Route::post('accesscode/fetch2','BookController@fetchcode');
Route::post('/test/email','TestController@emailtest');
Route::post('/school/join_schools','SchoolController@join_schools');


Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');