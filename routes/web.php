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

Route::get('login','LoginController@getAdminLogin');
Route::post('login','LoginController@postAdminLogin');

Route::get('BorrowBook','BorrowBookController@getBorrowBook')->name('get.borrowBook');
Route::post('BorrowBook','BorrowBookController@postBorrowBook')->name('post.borrowBook');
Route::get('PayBook','PayBookController@getPayBookHeader')->name('get.payBook');
Route::get('PayBook/{maSoDG}','PayBookController@getPayBookContent')->name('get.payBookContent');
Route::post('PayBook/{maSoDG}','PayBookController@postPayBookContent')->name('post.payBookContent');


Route::group(['prefix'=>'manager'], function() {
	Route::get('','ManagerController@getManager')->name('get.manager');
	Route::group(['prefix'=>'Book'], function() {
		Route::get('','BookController@getManagerBook')->name('get.manager.book');
		Route::get('Add','BookController@getManagerBook_Add')->name('get.manager.book.add');
		Route::get('Edit/{id}','BookController@getManagerBook_Edit')->name('get.manager.book.edit');
		Route::get('Delete/{id}','BookController@getManagerBook_Delete')->name('get.manager.book.delete');
		Route::post('Add','BookController@postManagerBook_Add')->name('post.manager.book.add');
		Route::post('Edit/{id}','BookController@postManagerBook_Edit')->name('post.manager.book.edit');
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
		Route::get('{id}','BorrowBookController@Show')->name('get.manager.giveBack.show');
	});

	route::group(['prefix'=>'GiveBack'],function() {
		Route::get('','PayBookController@getManagerGiveBack')->name('get.manager.giveBack');
	});

	route::group(['prefix'=>'Publisher'],function() {
		Route::get('','PublisherController@getManagerPublisher')->name('get.manager.publisher');
		Route::get('Add','PublisherController@getManagerPublisher_Add')->name('get.manager.publisher.add');
		Route::get('Edit/{id}','PublisherController@getManagerPublisher_Edit')->name('get.manager.publisher.edit');
		Route::get('Delete/{id}','PublisherController@getManagerPublisher_Delete')->name('get.manager.publisher.delete');
		Route::post('Add','PublisherController@postManagerPublisher_Add')->name('post.manager.publisher.add');
		Route::post('Edit/{id}','PublisherController@postManagerPublisher_Edit')->name('post.manager.publisher.edit');
	});

	route::group(['prefix'=>'Employees'],function() {
		Route::get('','EmployeesController@getManagerEmployees')->name('get.manager.employees');
		Route::get('Add','EmployeesController@getManagerEmployees_Add')->name('get.manager.employees.add');
		Route::post('Add','EmployeesController@postManagerEmployees_Add')->name('post.manager.employees.add');
	});

	Route::get('statistical','StatisticalController@getStatistical')->name('get.manager.statistical');

});

