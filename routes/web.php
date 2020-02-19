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



Auth::routes();


Route::group(['middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'category'], function () {

        Route::any('/manage', 'CategoryController@manageCategories');
        Route::any('/', 'CategoryController@index')->name('category.index');
        Route::any('/add-category', 'CategoryController@addCategory')->name('post.create');
        Route::any('/edit-category/{id}', 'CategoryController@editCategory')->name('category.destroy');
        Route::any('/delete-category/{id}', 'CategoryController@deleteCategory')->name('category.destroy');
        Route::any('/add-sub-category', 'CategoryController@addSubCategory')->name('post.create-sub');
        Route::any('/edit-sub-category/{id}', 'CategoryController@editSubCategory')->name('sub-category.destroy');
        Route::any('/delete-sub-category/{id}', 'CategoryController@deleteSubCategory')->name('sub-category.destroy');
        Route::any('/add-child-category', 'CategoryController@addChildCategory')->name('post.create-child');
        Route::any('/edit-child-category/{id}', 'CategoryController@editChildCategory')->name('child-category.destroy');
        Route::any('/delete-child-category/{id}', 'CategoryController@deleteChildCategory')->name('child-category.destroy');
        Route::any('/get-sub-category/{id}', 'CategoryController@getSubCategoryByParentId')->name('category.getsubacat');
        Route::any('/get-child-category/{id}', 'CategoryController@getChildCategoryByParentId')->name('category.getchildcat');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('manage', 'ProductController@manageProducts')->name('products');
        Route::get('/', 'ProductController@manageProducts')->name('products.index');
        Route::get('/create', 'ProductController@create')->name('products.create');
        Route::post('/store', 'ProductController@storeProduct')->name('products.store');
        Route::get('/edit/{id}', 'ProductController@editProduct')->name('products.edit');
        Route::get('/delete/{id}', 'ProductController@delete')->name('products.delete');

    });

});

