<?php

use App\Http\Controllers\AllController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::match(["POST"], "/register", [AllController::class, "register"]);
Route::match(["POST"], "/login", [AllController::class, "login"]);
Route::match(["GET"], "/get_contact/{id}", [AllController::class, "get_contact"]);
Route::match(["POST"], "/update_contact", [AllController::class, "update_contact"]);
Route::match(["POST"], "/add_contact", [AllController::class, "add_contact"]);
Route::match(["GET"], "/update_status/{id}", [AllController::class, "update_status"]);
Route::match(["POST"], "/add_transaction", [AllController::class, "add_transaction"]);
Route::match(["GET"], "/products", [AllController::class, "products"]);
