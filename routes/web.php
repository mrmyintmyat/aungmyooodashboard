<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminPanelController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'post_date'])->name('post.date');
Route::get('/reports', [HomeController::class, 'report']);
Route::get('/password-change', [HomeController::class, 'pw_change_show_form']);
Route::post('/password-change', [HomeController::class, 'pw_change'])->name('password.change');


Route::group(['middleware' => ['auth', 'checkstatus']], function () {
    Route::get('/admin/users', [AdminPanelController::class, 'showUsersPage'])->name('admin.users');
    Route::resource('/admin', AdminPanelController::class);
});

Auth::routes();
// Route::get('/register', function(){
//     return back();
// });

Route::get('/home', [HomeController::class, 'index'])->name('home');
