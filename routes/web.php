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
    if(!Auth::user()){
        return redirect('login');
    }elseif (Auth::user()->level == 1){
        return redirect('admin');
    }else{
        if (!auth()->user()->state){
            return redirect(route('edit.profile', auth()->user()->id));
        }
        return redirect('profile');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/profile/{user}/view', 'UserController@viewProfile')->name('view.profile');
    Route::get('/profile/{user}/edit', 'UserController@editProfile')->name('edit.profile');
    Route::post('/profile/{user}/update', 'UserController@updateProfile')->name('update.profile');
    Route::post('/profile/{user}/picture', 'UserController@uploadPicture')->name('upload.picture');
    Route::get('/profile/{user}/print', 'UserController@printProfile')->name('print.profile');
});

Route::group(['middleware' => ['auth','admin']], function () {

    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/admins', 'AdminController@admins')->name('admin.admins');
    Route::get('/users', 'AdminController@usersTable')->name('users.ajax');
    Route::get('/users/export', 'AdminController@toExcel')->name('users.export');
    Route::get('/admin/{user}/view', 'AdminController@viewProfile')->name('admin.profile');
    Route::get('/admin/{user}/edit', 'AdminController@editProfile')->name('admin-edit.profile');
    Route::post('/admin/{user}/confirm', 'AdminController@confirmProfile')->name('admin.confirm');
    Route::post('/admin/{user}/destroy', 'AdminController@destroy')->name('destroy.profile');
    Route::post('/admin/restore', 'AdminController@restore')->name('restore.profile');
    Route::get('/admin/lccs', 'AdminController@lccs')->name('lccs');
    Route::get('/admin/groups', 'AdminController@groups')->name('groups');
    Route::get('/admin/images', 'AdminController@downloadZip')->name('images.download');
    Route::post('/admin/create', 'AdminController@createUser')->name('user.create');
    Route::post('/admin/upload', 'AdminController@uploadUsers')->name('user.upload');
});
