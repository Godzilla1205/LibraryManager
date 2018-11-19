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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('manager','ManagerController@getManager')->name('get.manager');

/*--------------------------------------Book-----------------------------------------------------*/

Route::get('manager/Book','BookController@getManagerBook')->name('get.manager.book');
Route::get('manager/Book/Add','BookController@getManagerBook_Add')->name('get.manager.book.add');
Route::get('manager/Book/Edit/{id}','BookController@getManagerBook_Edit')->name('get.manager.book.edit');
Route::get('manager/Book/Delete/{id}','BookController@getManagerBook_Delete')->name('get.manager.book.delete');
Route::post('manager/Book/Add','BookController@postManagerBook_Add')->name('post.manager.book.add');
Route::post('manager/Book/Edit/{id}','BookController@postManagerBook_Edit')->name('post.manager.book.edit');

/*--------------------------------------Readers----------------------------------------------------*/

Route::get('manager/Readers','ReadersController@getManagerReaders')->name('get.manager.readers');
Route::get('manager/Readers/Add','ReadersController@getManagerReaders_Add')->name('get.manager.readers.add');
Route::post('manager/Readers/Add','ReadersController@postManagerReaders_Add')->name('post.manager.readers.add');
Route::get('manager/Readers/Detail/{id}','ReadersController@getManagerReaders_Detail')->name('get.manager.readers.detail');
Route::get('manager/Readers/Detail/Edit/{id}','ReadersController@getManagerReaders_Edit')->name('get.manager.readers.edit');
Route::post('manager/Readers/Detail/Edit/{id}','ReadersController@postManagerReaders_Edit')->name('post.manager.readers.edit');
Route::get('manager/Readers/Detail/Delete/{id}','ReadersController@getManagerReaders_Delete')->name('get.manager.readers.delete');


/*--------------------------------------BorrowBook-------------------------------------------------*/

Route::get('BorrowBook','BorrowBookController@getBorrowBook')->name('get.borrowBook');
Route::post('BorrowBook','BorrowBookController@postBorrowBook')->name('post.borrowBook');

Route::get('manager/BorrowBook','BorrowBookController@getManagerBorrowBook')->name('get.manager.borrowBook');
Route::get('manager/BorrowBook/{id}','BorrowBookController@Show')->name('get.manager.giveBack.show');
Route::get('manager/GiveBack','PayBookController@getManagerGiveBack')->name('get.manager.giveBack');

/*--------------------------------------Pay Book-------------------------------------------------*/

Route::get('PayBook','PayBookController@getPayBookHeader')->name('get.payBook');
Route::get('PayBook/{maSoDG}','PayBookController@getPayBookContent')->name('get.payBookContent');
Route::post('PayBook/{maSoDG}','PayBookController@postPayBookContent')->name('post.payBookContent');



/*--------------------------------------Publisher--------------------------------------------------*/


Route::get('manager/Publisher','PublisherController@getManagerPublisher')->name('get.manager.publisher');

Route::get('manager/Publisher/Add','PublisherController@getManagerPublisher_Add')->name('get.manager.publisher.add');
Route::get('manager/Publisher/Edit/{id}','PublisherController@getManagerPublisher_Edit')->name('get.manager.publisher.edit');
Route::get('manager/Publisher/Delete/{id}','PublisherController@getManagerPublisher_Delete')->name('get.manager.publisher.delete');
Route::post('manager/Publisher/Add','PublisherController@postManagerPublisher_Add')->name('post.manager.publisher.add');
Route::post('manager/Publisher/Edit/{id}','PublisherController@postManagerPublisher_Edit')->name('post.manager.publisher.edit');

/*--------------------------------------Employees-------------------------------------------------*/

Route::get('manager/Employees','EmployeesController@getManagerEmployees')->name('get.manager.employees');
Route::get('manager/Employees/Add','EmployeesController@getManagerEmployees_Add')->name('get.manager.employees.add');
Route::post('manager/Employees/Add','EmployeesController@postManagerEmployees_Add')->name('post.manager.employees.add');


/*--------------------------------------Statistical-----------------------------------------------*/
Route::get('manager/statistical','StatisticalController@getStatistical')->name('get.manager.statistical');
