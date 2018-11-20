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

Route::get('/', function () {
	return view('welcome');
});

Route::get('login','LoginController@getAdminLogin')->name('get.login');
Route::get('logout','LoginController@getAdminLogout')->name('get.logout');
Route::post('login','LoginController@postAdminLogin');

Route::group(['prefix'=>'manager','middleware'=>'login'], function() {
	Route::get('','ManagerController@getManager')->name('get.manager');


	Route::group(['prefix'=>'Book'], function() {
		Route::get('','BookController@getManagerBook')->name('get.manager.book');
		Route::get('Add','BookController@getManagerBook_Add')->name('get.manager.book.add');
		Route::get('Edit/{id}','BookController@getManagerBook_Edit')->name('get.manager.book.edit');
		Route::get('Delete/{id}','BookController@getManagerBook_Delete')->name('get.manager.book.delete');
		Route::post('Add','BookController@postManagerBook_Add')->name('post.manager.book.add');
		Route::post('Edit/{id}','BookController@postManagerBook_Edit')->name('post.manager.book.edit');
		Route::post('','BookController@postManagerBook_Search')->name('post.manager.book.search');
	});

	route::group(['prefix'=>'Readers'], function() {
		Route::get('','ReadersController@getManagerReaders')->name('get.manager.readers');
		Route::get('Add','ReadersController@getManagerReaders_Add')->name('get.manager.readers.add');
		Route::post('Add','ReadersController@postManagerReaders_Add')->name('post.manager.readers.add');
		Route::get('Detail/{id}','ReadersController@getManagerReaders_Detail')->name('get.manager.readers.detail');
		Route::get('Detail/Edit/{id}','ReadersController@getManagerReaders_Edit')->name('get.manager.readers.edit');
		Route::post('Detail/Edit/{id}','ReadersController@postManagerReaders_Edit')->name('post.manager.readers.edit');
		Route::get('Detail/Delete/{id}','ReadersController@getManagerReaders_Delete')->name('get.manager.readers.delete');
	});


	route::group(['prefix'=>'BorrowBook'], function() {
		Route::get('','BorrowBookController@getManagerBorrowBook')->name('get.manager.borrowBook');
		Route::get('detail/{id}','BorrowBookController@Show')->name('get.manager.giveBack.show');

		Route::get('create','BorrowBookController@getBorrowBook')->name('get.borrowBook');
		Route::post('create','BorrowBookController@postBorrowBook')->name('post.borrowBook');
	});


	route::group(['prefix'=>'GiveBack'],function() {
		Route::get('','PayBookController@getManagerGiveBack')->name('get.manager.giveBack');
		Route::get('create','PayBookController@getPayBookHeader')->name('get.payBook');
		Route::get('create/{maSoDG}','PayBookController@getPayBookContent')->name('get.payBookContent');
		Route::post('create/{maSoDG}','PayBookController@postPayBookContent')->name('post.payBookContent');
		Route::get('delete/{id}','PayBookController@getManagerGiveBack_Delete')->name('get.manager.giveBack.delete');
	});

	route::group(['prefix'=>'Publisher'],function() {
		Route::get('','PublisherController@getManagerPublisher')->name('get.manager.publisher');
		Route::get('Add','PublisherController@getManagerPublisher_Add')->name('get.manager.publisher.add');
		Route::get('Edit/{id}','PublisherController@getManagerPublisher_Edit')->name('get.manager.publisher.edit');
		Route::get('Delete/{id}','PublisherController@getManagerPublisher_Delete')->name('get.manager.publisher.delete');
		Route::post('Add','PublisherController@postManagerPublisher_Add')->name('post.manager.publisher.add');
		Route::post('Edit/{id}','PublisherController@postManagerPublisher_Edit')->name('post.manager.publisher.edit');
	});

	route::group(['prefix'=>'admin','middleware'=>'admin'],function() {
		route::group(['prefix'=>'Employees'],function() {
			Route::get('','EmployeesController@getManagerEmployees')->name('get.manager.employees');
			Route::get('Add','EmployeesController@getManagerEmployees_Add')->name('get.manager.employees.add');
			Route::post('Add','EmployeesController@postManagerEmployees_Add')->name('post.manager.employees.add');
			Route::get('Edit/{id}','EmployeesController@getManagerEmployees_Edit')->name('get.manager.employees.edit');
			Route::post('Edit/{id}','EmployeesController@postManagerEmployees_Edit')->name('post.manager.employees.edit');
			Route::get('Delete/{id}','EmployeesController@getManagerEmployees_Delete')->name('get.manager.employees.delete');
		});

		route::group(['prefix'=>'users'],function() {
			Route::get('','UsersController@getManagerUsers')->name('get.manager.users');
			Route::get('Add','UsersController@getManagerUsers_Add')->name('get.manager.users.add');
			Route::post('Add','UsersController@postManagerUsers_Add')->name('post.manager.users.add');
			Route::get('detail/{id}','UsersController@Show')->name('get.manager.users.show');
			Route::get('Delete/{id}','UsersController@getManagerUsers_Delete')->name('get.manager.users.delete');
		});
	});


	Route::group(['prefix'=>'user'], function() {
		Route::get('','UsersController@getUser')->name('get.user');
		
	});

	Route::get('statistical','StatisticalController@getStatistical')->name('get.manager.statistical');

});

