<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\OfficerController as APIOfficerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\OfficerController;

//Route::get('/user', function (Request $request) {
  //  return $request->user();
//})->middleware('auth:sanctum');
//http://localhost:8000/api/
Route::get('/', [CompanyController::class,'index']  );

//http://localhost:8000/api/staff
Route::get('/staff', function () {
    return 'Hello staff';
});

//http://localhost:8000/api/staff/3
Route::get('/staff/{id}', [CompanyController::class,'show']
    
);

Route::apiResource('/product', ProductController::class);

Route::apiResource('/department', DepartmentController::class);
//ค้นหาชื่อแผนก
//api/search/department?name=บ
Route::get('/search/department',[ DepartmentController::class, 'search']);

Route::apiResource('/officer', OfficerController::class);

//authentication
Route::post('/auth/register',[ AuthController::class, 'register']);

Route::post('/auth/login',[ AuthController::class, 'login']);

Route::post('/auth/logout',[ AuthController::class, 'logout'])->middleware('auth:sanctum');

//get user profile
Route::get('/auth/me',[ AuthController::class, 'me'])->middleware('auth:sanctum');