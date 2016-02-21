<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Book;
use App\Category;
use Illuminate\Support\Facades\Route;

Route::pattern('id', '[0-9]+');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    /**
     * User request
     */
    /************************************************************************************************************/
    Route::auth();
    Route::post('user/update', ['as' => 'user.update', 'uses' => 'Auth\AuthController@update']);
    Route::get('user/{id}', ['as' => 'user.center', 'uses' => 'HomeController@showUser']);
    /************************************************************************************************************/


    /************************************************************************************************************/
    /**
     *Page Route
     */

    Route::get('about', 'HomeController@about');

    Route::get('/', 'HomeController@index');

    Route::get('/home', 'HomeController@index');

    Route::get('listPic', 'BookController@listPic');
    /************************************************************************************************************/


    /************************************************************************************************************/

    /**
     * Book Route
     */
    Route::get('search', ['as' => 'book.search', 'uses' => 'BookController@search']);

    Route::get('book/category/{id}', ['as' => 'book.category', 'uses' => 'BookController@category']);
    Route::resource('book', 'BookController');

    /************************************************************************************************************/



    /************************************************************************************************************/

    /**
     * order Route
     */
    Route::get('order/create', ['as' => 'order.create', 'uses' => 'OrderController@create']);
    Route::resource('order', 'OrderController', ['except' => ['show', 'index', 'edit', 'create']]);
    /************************************************************************************************************/

});

/**
 * Admin Routes
 */
Route::group(['middleware' => ['web', 'auth', 'admin']], function () {

    Route::get('admin/upload', 'UploadController@index');
    Route::post('admin/upload/file', 'UploadController@uploadFile');
    Route::delete('admin/upload/file', 'UploadController@deleteFile');
    Route::post('admin/upload/folder', 'UploadController@createFolder');
    Route::delete('admin/upload/folder', 'UploadController@deleteFolder');


    Route::get('/admin', 'AdminController@index');
    Route::get('/admin/user', 'AdminController@user');
    Route::resource('/admin/category', 'CategoryController', ['except' => 'show']);
});


/**
 * API
 */


/*Route::group(['prefix' => 'api'], function () {
    Route::get('book', function () {
        return Book::paginate(10)->toJson();
    });
    Route::get('category', function () {
        return Category::paginate(10)->toJson();
    });
    Route::get('category/{id}', function ($id) {
        return Category::findOrFail($id)->books()->get()->toJson();
    });
});*/

