<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::middleware(['auth:api'])->group(
        function () {
            //
            Route::get(
                    '/user',
                    function (Request $request) {
                        return $request->user();
                    }
            );

            Route::get('/categorise',[CategoryController::class,'getCategoriesTree']); //дерепо категорий

                Route::prefix('product')->group(function () {
                    Route::get('/filter', [ProductController::class, 'filter']); //дерепо категорий
                    Route::get('/{slug}',[ProductController::class,'slug']);
                });


        }
);

Route::post(
        '/tokens/create',
        function (Request $request) {
            $token = $request->user()->createToken($request->token_name);

            return ['token' => $token->plainTextToken];
        }
);
