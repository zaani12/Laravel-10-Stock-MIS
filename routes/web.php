<?php

use App\Http\Controllers\accountController;
use App\Http\Controllers\AddController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserControllers;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\supplierController;
use GuzzleHttp\Middleware;

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
Route::controller(AuthController::class)->group(function(){
    Route::get('/registers','register')->name('registers');
    Route::post('/registers','registerSave')->name('register.save');
    Route::get('logins','login')->name('login.action');
    Route::post('logins','loginAction')->name('login.action');

    Route::get('logout','logout')->middleware('auth')->name('logout');
});
Route::middleware('auth')->group(function () {
    Route::get('AdminDashboard', function () {
        return view('dashboard');
    })->name('AdminDashboard');

    Route::view('changePassword','sign-in/changePassword');
    Route::post('changePassword', [AuthController::class, 'changePassword'])->name('changePassword');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profileSetting/{id} ', [AuthController::class, 'profileSetting'])->name('profileSetting');

    Route::controller(ProductController::class)->prefix('products')->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');

        Route::get('search', 'search')->name('search');
    });

    Route::controller(accountController::class)->group(function(){
        Route::get('userAccounts' ,'display');
        Route::post('addAccount' ,'addAccount');
        Route::get('delete/{id}' ,'deleteAccount');
        Route::get('edit/{id}' ,'editAccount');
        Route::post('edit' ,'editInfo');
        Route::get('joinExample','joinExample');
    });
    Route::controller(supplierController::class)->group(function(){
        Route::get('','index')->name('suppliers/index');
        Route::get('create','create')->name('suppliers/create');
        Route::post('store','store')->name('suppliers/store');
        Route::get('edit/{id}','edit')->name('suppliers/edit');
        Route::put('update/{id}','update')->name('suppliers/update');
        Route::get('destroy/{id}','destroy')->name('suppliers/delete');
    });
    
    Route::get('fetchEmployees',[EmployeeController::class, 'fetchData']);
});

// Route::get("/users/{userName}",function($userName){
//     return view('users',['userName'=> $userName]);
// });

// Route::view('about', 'about')->Middleware('protectedPages');


Route:: post('users',[UsersController::class, 'getData']);

// Route::get("users/{userName}",[UserController::class,'index']);
// Route::group(['middleware'=>['protectedPages']],function(){
//     Route:: view('about','about');
// });

Route::get('fetchUsers',[UserControllers::class, 'fetchUserData']);
Route::post('formLogin',[loginController::class, 'userLogin']);
// Route::view('logins','login');

// Route::get('/logins', function(){
//     if(session()->has('user')){
        
//         return redirect('fetchEmployees');
//     }
//     return view('login');
// });
// Route::get('/logout', function(){
//     if(session()->has('user')){
//         session()->pull('user');
//     }
//     return redirect('logins');
// });

Route::view('add','add');
Route::post('addMember',[AddController::class ,'addUser']);

Route::view('addAccount','addUser');


// ------------------------------------------------
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
