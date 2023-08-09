<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\TokenVerificationMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//Web API Routes
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);

//After Authentication
Route::get('/user-details', [UserController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UserUpdate'])->middleware([TokenVerificationMiddleware::class]);


//User Logout
Route::get('/userLogout', [UserController::class, 'UserLogout']);

// Page Routes
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/categoryPage', [CategoryController::class, 'CategoryPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/incomePage', [IncomeController::class, 'IncomePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/expensePage', [ExpenseController::class, 'ExpensePage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/customerPage', [CustomerController::class, 'CustomerPage'])->middleware([TokenVerificationMiddleware::class]);

//Customer Api
Route::get('/list-customer', [CustomerController::class, 'CustomerList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-customer', [CustomerController::class, 'CustomerCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/edit-customer", [CustomerController::class, 'CustomerByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-customer', [CustomerController::class, 'CustomerUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-customer', [CustomerController::class, 'CustomerDelete'])->middleware([TokenVerificationMiddleware::class]);

//Category Api
Route::get('/list-category', [CategoryController::class, 'CategoryList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-category', [CategoryController::class, 'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/edit-category", [CategoryController::class, 'CategoryByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-category', [CategoryController::class, 'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-category', [CategoryController::class, 'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);

//Income Api
Route::get('/list-income', [IncomeController::class, 'IncomeList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-income', [IncomeController::class, 'IncomeCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/edit-income", [IncomeController::class, 'IncomeByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-income', [IncomeController::class, 'IncomeUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-income', [IncomeController::class, 'IncomeDelete'])->middleware([TokenVerificationMiddleware::class]);

//Expense Api
Route::get('/list-expense', [ExpenseController::class, 'ExpenseList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-expense', [ExpenseController::class, 'ExpenseCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/edit-expense", [ExpenseController::class, 'ExpenseByID'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-expense', [ExpenseController::class, 'ExpenseUpdate'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-expense', [ExpenseController::class, 'ExpenseDelete'])->middleware([TokenVerificationMiddleware::class]);




//After Authentication
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([TokenVerificationMiddleware::class]);

