<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Front end routes
Route::get('/', 'HomeController@showHomePage');
//get json
Route::get('/all_books','HomeController@getJson');

//new contolller databse bckup
Route::get('/admin/backup','DatabckupController@index');
Route::get('/admin/backup/do_backup','DatabckupController@do_back');

//signup page 
Route::any('/register','RegisterController@signUpUser');
//forgot password
Route::get('/forget_password', 'RegisterController@forgetPassword');
Route::get('/reset_password/{token}', 'RegisterController@getReset');
Route::get('admin/email_unverified_user', 'UsersController@emailNotVerfiefUser');

Route::controller('password', 'RemindersController');
Route::get('/all/categories','HomeController@listsAllCategories');
//it will verify requested email
Route::any('/email/verify','UsersController@verifyUser');
Route::resource('books','BooksController');
Route::get('books/manage_book/{book_id}', 'BooksController@manageBook');
//upload documents
Route::post('books/upload_book_documents/{book_id}','BooksController@uploadBookDocuments');
//delete book
Route::get('delete/{book_id}','BooksController@deleteBook');
//to verify books posted by user
Route::get('admin/verify/books','BooksController@verifyBooks');
//Route::get('books/lists/{category_id}','BooksController@listBooks');
Route::post('books/post_meta_tags','BooksController@postMetaTags');

Route::resource('admin/categories', 'CategoriesController');

Route::resource('admin/books', 'BooksController');
//for changing status of book
Route::get('admin/books/change_status/{status}/{id}','BooksController@changeStatus');
//to verify newly registered users
Route::get('admin/users/verify','UsersController@verifyUserByAdmin');
Route::resource('files', 'FilesController');
Route::resource('tags', 'TagsController');
Route::resource('book_tags', 'BookTagsController');

//recursive category
Route::get('admin/recursive/show_list','CategoriesController@recursiveList');
//shows books according to its category
Route::get('admin/category/{category_id}/books','BooksController@showBookCategoryWise');
//find books according to its tags
Route::get('admin/tagged_book/{tag}/books','BooksController@searchBookByTag');

//books by category
Route::get('items/category/{slug}','HomeController@listsBooksByCategory');
Route::get('items/browse/date','HomeController@listsBooksByDate');

//book details
Route::get('item/details/{slug}','HomeController@showBookDetails');
Route::get('admin/your_items','BooksController@showYourBooks');
Route::post('search','HomeController@handleSearchText');
Route::get('search/result/{search}','HomeController@showSearchResult');
Route::get('search/advance','HomeController@showAdvanceSearchResult');
Route::get('browse/authors','HomeController@showAuthorLists');
Route::get('browse/category/{slug}','HomeController@listsChildCategories');
Route::get('browse/author/{user_id}','HomeController@listsAuthorItems');
Route::post('adv/result','HomeController@buildAdvanceSearchUrl');
Route::get('adv-search/result','HomeController@listsAdvanceSearchUrl');
Route::get('all/publications','HomeController@listsAllPublications');
Route::get('all/subjects','HomeController@listsAllSubjects');
Route::get('browse/publication/{id}','HomeController@showPublicationBooks');
Route::get('browse/subject/{id}','HomeController@showSubjectBooks');


//ADMIN routes
Route::get('admin', 'AdminController@dashboard');

Route::resource('admin/states', 'StatesController');
Route::resource('admin/townships', 'TownshipsController');
Route::resource('admin/roles', 'RolesController');
Route::resource('admin/users', 'UsersController');
Route::resource('admin/countries', 'CountriesController');
Route::resource('admin/projects', 'ProjectsController');
Route::resource('admin/clients', 'ClientsController');
Route::resource('admin/partners', 'PartnersController');
Route::resource('admin/staffs', 'StaffsController');
Route::resource('admin/pages', 'PagesController');
Route::resource('admin/blogs', 'BlogsController');
Route::resource('admin/albums', 'AlbumsController');
Route::resource('admin/photos', 'PhotosController');
Route::resource('admin/comments', 'CommentsController');
Route::resource('admin/contacts', 'ContactsController');
Route::resource('admin/sliders', 'SlidersController');
Route::resource('admin/vacancies', 'VacanciesController');
Route::resource('admin/settings', 'SettingsController');
Route::resource('admin/permission','PermissionController');
Route::resource('admin/publications', 'PublicationsController');
Route::resource('admin/subjects', 'SubjectsController');
Route::resource('admin/publishers', 'PublishersController');
Route::any('admin/ajax/updatePermission/{module_id}/{role_module_id}/{flag}','PermissionController@updatePermission');


//book route
Route::get('admin/books/manage_book/{book_id}', 'BooksController@manageBook');
Route::post('admin/books/upload_book_documents/{book_id}','BooksController@uploadBookDocuments');
Route::get('admin/books/delete/{document_id}','BooksController@deleteBook');
Route::get('admin/book_main/delete/{book_id}','BooksController@deleteMainBook');
Route::get('admin/books/lists/{category_id}','BooksController@listBooks');
Route::post('admin/books/post_meta_tags','BooksController@postMetaTags');
Route::get('admin/books/remove_photo/{id}','BooksController@removeBookPhoto');
Route::get('admin/categories/remove_photo/{id}','CategoriesController@removePhoto');



//project route
Route::get('admin/projects/manage_project/{project_id}', 'ProjectsController@manageProject');
Route::post('admin/projects/upload_project_reports/{project_id}','ProjectsController@uploadProjectReports');
Route::post('admin/projects/upload_project_presentations/{project_id}','ProjectsController@uploadProjectPresentations');
Route::post('admin/projects/upload_project_briefs/{project_id}','ProjectsController@uploadProjectBriefs');
Route::post('admin/projects/upload_project_discussion_papers/{project_id}','ProjectsController@uploadProjectDiscussionPapers');
Route::post('admin/projects/upload_project_training_meterials/{project_id}','ProjectsController@uploadProjectTrainingMeterials');
Route::get('admin/projects/delete/{project_id}','ProjectsController@delete');
Route::get('admin/clients/delete/{id}','ClientsController@delete');
Route::get('admin/partners/delete/{id}','PartnersController@delete');
Route::get('admin/pages/delete/{id}','PagesController@delete');
Route::get('admin/vacancies/delete/{id}','VacanciesController@delete');
Route::get('admin/sliders/delete/{id}','SlidersController@delete');
Route::get('admin/projects_type/delete/{project_id}/{id}','ProjectsController@deleteReportType');
Route::get('admin/contacts/delete/{id}','ContactsController@deleteContact');
Route::get('admin/staffs/delete/{id}','StaffsController@delete');
Route::get('admin/blogs/delete/{id}','BlogsController@delete');
Route::get('admin/categories/delete/{id}','CategoriesController@delete');
Route::get('admin/contacts/set_primary/{id}','ContactsController@makePrimary');

//change status 
Route::get('admin/vacancies/change_status/{status}/{id}','VacanciesController@changeStatus');
Route::get('admin/albums/change_status/{status}/{id}','AlbumsController@changeStatus');
Route::get('admin/projects/change_status/{status}/{id}','ProjectsController@changeStatus');
Route::get('admin/clients/change_status/{status}/{id}','ClientsController@changeStatus');
Route::get('admin/partners/change_status/{status}/{id}','PartnersController@changeStatus');
Route::get('admin/blogs/change_status/{status}/{id}','BlogsController@changeStatus');
Route::get('admin/pages/change_status/{status}/{id}','PagesController@changeStatus');
Route::get('admin/sliders/change_status/{status}/{id}','SlidersController@changeStatus');
Route::get('admin/contacts/change_status/{status}/{id}','ContactsController@changeStatus');
Route::get('admin/users/change_status/{status}/{id}','UsersController@changeStatus');
Route::get('admin/publications/change_status/{status}/{id}','PublicationsController@changeStatus');
Route::get('admin/subjects/change_status/{status}/{id}','SubjectsController@changeStatus');
Route::get('admin/publishers/change_status/{status}/{id}','PublishersController@changeStatus');

//front status
Route::get('admin/projects/add_to_front/{front_status}/{id}','ProjectsController@changeFrontStatus');

Route::get('admin/blog/comments/{id}', 'BlogsController@showBlogComments');
Route::get('admin/blog/approve_comments','BlogsController@approveComments');
Route::get('admin/blog/moderate_comment/{id}','BlogsController@moderateComment');
Route::get('admin/pages/show/{id}', 'PagesController@showPage');
Route::get('admin/blogs/show/{id}', 'BlogsController@showBlogPost');
Route::get('admin/contacts/show/{id}', 'ContactsController@showContact');
Route::get('admin/album/upload_photo/{album_id}', 'PhotosController@uploadAlbumPhoto');
Route::post('admin/photo_upload/{id}','PhotosController@uploadPhotosInAlbum');
Route::get('admin/album/photos/{id}', 'PhotosController@showAlbumPhotos');
Route::post('admin/edit_album_photos/{id}','PhotosController@saveAlbumPhotos');
Route::get('admin/make_album_cover/{album_id}/{id}','PhotosController@makeAlbumCover');
Route::get('admin/photo/delete/{album_id}/{id}','PhotosController@deleteAlbumPhoto');
Route::get('admin/delete/album/{album_id}','AlbumsController@deleteAlbum');
Route::get('admin/logout', 'UsersController@logout');
Route::get('admin/change_password', 'AdminController@changePassword');
Route::post('admin/update_password', 'AdminController@updatePassword');
Route::get('admin/clients_upload', 'ClientsController@uploadClient');
Route::post('admin/clients_upload_logo', 'ClientsController@uploadClientLogo');
Route::post('admin/settings_save', 'SettingsController@updateSettings');
Route::post('admin/settings/save_constants', 'SettingsController@saveConstants');
Route::post('admin/service_settings_save', 'SettingsController@updateServiceSettings');
Route::get('admin/delete/contact/{id}','ContactsController@deleteContact');
Route::get('admin/delete/user/{id}','UsersController@delete');
Route::get('admin/users/reset/{id}','UsersController@resetPassword');
Route::post('admin/users/reset_password','UsersController@changeNewPassword');
Route::get('admin/delete/publications/{id}','PublicationsController@delete');
Route::get('admin/delete/subjects/{id}','SubjectsController@delete');
Route::get('admin/delete/publishers/{id}','PublishersController@delete');

Route::post('admin/ivc_settings_save', 'SettingsController@updateIvcSettings');
Route::post('admin/food_settings_save', 'SettingsController@updateFoodSettings');
Route::post('admin/climate_settings_save', 'SettingsController@updateClimateSettings');
Route::post('admin/company_settings_save', 'SettingsController@updateCompanySettings');

Route::get('admin/service_settings', 'SettingsController@showServiceSettingsPage');
Route::get('admin/ivc_settings', 'SettingsController@showIvcSettingsPage');
Route::get('admin/food_settings', 'SettingsController@showFoodSettingsPage');
Route::get('admin/climate_settings', 'SettingsController@showClimateSettingsPage');
Route::get('admin/company_settings', 'SettingsController@showCompanySettingsPage');

//front page 
Route::get('page/{slug}', 'NonloggedinController@showPageContent');
Route::get('team', 'FrontPageController@showTeamPage');
Route::get('opportunity', 'FrontPageController@showOppurtunity');
Route::get('opportunity/{slug}', 'FrontPageController@showOppurtunityDetails');
Route::get('contacts', 'FrontPageController@showContacts');
Route::get('blogs', 'FrontPageController@showBlogPosts');
Route::get('blog/{slug}', 'FrontPageController@showBlogDetails');
Route::post('blog/post_comment', 'FrontPageController@submitBlogComment');
Route::post('contact/post_contact', 'FrontPageController@submitContactForm');
Route::get('projects', 'FrontPageController@listProjects');
Route::get('project/maps', 'FrontPageController@showMap');
Route::get('project/country/{country_code}', 'FrontPageController@showMapProjects');
Route::get('albums', 'FrontPageController@showAlbums');
Route::get('album/{slug}', 'FrontPageController@showAlbumsPhotos');
Route::get('project/detail/{id}', 'FrontPageController@showProjectDetails');
Route::get('our-clients', 'FrontPageController@showClientPage');
Route::get('our-services', 'FrontPageController@showServicePage');
Route::get('inclusive-value-chains', 'FrontPageController@showIvcPage');
Route::get('food-security-food-safety', 'FrontPageController@showFoodPage');
Route::get('climate-smart-agriculture', 'FrontPageController@showClimatePage');
Route::get('private-company', 'FrontPageController@showCompanyPage');

//for test purpose
Route::get('gms', 'GmsController@change_date_format');

//super admin login route
Route::any("admin/login", [
 "as"   => "users/login",
 "uses" => "UsersController@login"
]);

Route::get('/logout', 'UsersController@logout');