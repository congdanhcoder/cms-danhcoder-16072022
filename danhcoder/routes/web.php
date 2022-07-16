<?php

use Illuminate\Support\Facades\Route;

use App\Models\CatPost;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;

use App\Helper\Recusive;
use App\Helper\FomatSlug;

use Illuminate\Support\Facades\Auth;
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
/* ------------ Route Test ------------ */

Route::get(
    '/m-n',
    function () {
        $product = Product::find(1);
        return  $product->imgProducts;
    }
);
Route::get('/lk-nn', function () {
    $post =  User::find(1);

    return $post->roles[0]['id'];
});
Route::get('/test-link', function () {
    $post =  Post::paginate(10);
    echo $post->links();
});
Route::get('/slug-test', function () {
    $fm = new FomatSlug;
    return $fm->slug('tin tức tổng hợp');
});

/* ----------_ End Route Test ------------- */

Route::get('/', function () {
    return view('home');
})->name('indexFrontend');


/*
|--------------------------------------------------------------------------
| ROUTE BACKEND
|--------------------------------------------------------------------------
|
*/

Route::group(['middleware' => ['auth', 'CheckCustomer']], function () {

    Route::get('dashboard', [App\Http\Controllers\BackEnd\DashboardController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => 'CheckRoles:1,2'], function () {
        /* Route User */
        Route::get('list-user', [App\Http\Controllers\BackEnd\UserController::class, 'listUser'])->name('listUser');
        Route::get('add-user', [App\Http\Controllers\BackEnd\UserController::class, 'addUser'])->name('addUser');
        Route::post('insert-user', [App\Http\Controllers\BackEnd\UserController::class, 'insertUser'])->name('insertUser');
        Route::get('edit-user/{id?}', [App\Http\Controllers\BackEnd\UserController::class, 'editUser'])->name('editUser');
        Route::post('update-user', [App\Http\Controllers\BackEnd\UserController::class, 'updateUser'])->name('updateUser');
        Route::get('delete-user/{id?}', [App\Http\Controllers\BackEnd\UserController::class, 'deleteUser'])->name('deleteUser');
    });
    Route::group(['middleware' => 'CheckRoles:1, 2, 3, 4, 5'], function () {
        /* Gallery Route /*/
        Route::get('gallery', [App\Http\Controllers\BackEnd\GalleryController::class, 'listGallery'])->name('listGallery')->middleware('CheckRoles:1,2');
        Route::post('upload-ajax-gallery', [App\Http\Controllers\BackEnd\GalleryController::class, 'uploadAjaxImg'])->name('uploadAjaxImg');
        Route::post('delete-ajax-gallery', [App\Http\Controllers\BackEnd\GalleryController::class, 'deleteAjaxImg'])->name('deleteAjaxImg');
        Route::post('load-ajax-gallery', [App\Http\Controllers\BackEnd\GalleryController::class, 'loadAjaxImg'])->name('loadAjaxImg');
    });
    Route::group(['middleware' => 'CheckRoles:1, 2, 3, 4'], function () {
        /* Post Route */
        Route::get('cat-posts', [App\Http\Controllers\BackEnd\PostController::class, 'listCatPost'])->name('listCatPost');
        Route::post('add-cat-post', [App\Http\Controllers\BackEnd\PostController::class, 'addCatPost'])->name('addCatPost');
        Route::get('edit-cat-post/{id?}', [App\Http\Controllers\BackEnd\PostController::class, 'editCatPost'])->name('editCatPost');
        Route::post('update-cat-post', [App\Http\Controllers\BackEnd\PostController::class, 'updateCatPost'])->name('updateCatPost');
        Route::get('delete-cat-post/{id?}', [App\Http\Controllers\BackEnd\PostController::class, 'deleteCatPost'])->name('deleteCatPost');

        Route::get('list-posts', [App\Http\Controllers\BackEnd\PostController::class, 'listPost'])->name('listPost');
        Route::get('add-posts', [App\Http\Controllers\BackEnd\PostController::class, 'AddPost'])->name('addPost');
        Route::post('insert-posts', [App\Http\Controllers\BackEnd\PostController::class, 'insertPost'])->name('insertPost');
        Route::get('edit-post/{id?}', [App\Http\Controllers\BackEnd\PostController::class, 'editPost'])->name('editpost');
        Route::post('update-post', [App\Http\Controllers\BackEnd\PostController::class, 'updatePost'])->name('updatePost');
        Route::get('delete-post/{id?}', [App\Http\Controllers\BackEnd\PostController::class, 'deletePost'])->name('deletePost');
        Route::post('seach-post', [App\Http\Controllers\BackEnd\PostController::class, 'seachPost'])->name('seachPost');
    });
    Route::group(['middleware' => 'CheckRoles:1, 2, 3, 5'], function () {
        /* Product Route */
        Route::get('cat-products', [App\Http\Controllers\BackEnd\ProductController::class, 'listCatProduct'])->name('listCatProduct');
        Route::post('add-cat-product', [App\Http\Controllers\BackEnd\ProductController::class, 'addCatProduct'])->name('addCatProduct');
        Route::get('edit-cat-product/{id?}', [App\Http\Controllers\BackEnd\ProductController::class, 'editCatProduct'])->name('editCatProduct');
        Route::post('update-cat-Product', [App\Http\Controllers\BackEnd\ProductController::class, 'updateCatProduct'])->name('updateCatProduct');
        Route::get('delete-cat-product/{id?}', [App\Http\Controllers\BackEnd\ProductController::class, 'deleteCatProduct'])->name('deleteCatProduct');

        Route::get('list-products', [App\Http\Controllers\BackEnd\ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('add-product', [App\Http\Controllers\BackEnd\ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('insert-product', [App\Http\Controllers\BackEnd\ProductController::class, 'insertProduct'])->name('insertProduct');
        Route::get('edit-product/{id?}', [App\Http\Controllers\BackEnd\ProductController::class, 'editProduct'])->name('editProduct');
        Route::post('update-product', [App\Http\Controllers\BackEnd\ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::get('delete-product/{id?}', [App\Http\Controllers\BackEnd\ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::post('seach-product', [App\Http\Controllers\BackEnd\ProductController::class, 'seachProduct'])->name('seachProduct');
    });
});
