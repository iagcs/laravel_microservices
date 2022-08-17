<?php

use App\Http\Controllers\ProductsController;
use App\Models\User;
use Database\Seeders\ProductSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::get('/user', function (Request $request) {
    return User::inRandomOrder()->first('id');
});

Route::post('login', function(Request $request){

    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
        $user = Auth::user();
        $token = $user->createToken("JWT");

        return response()->json($token, 200);
    }

    return response()->json("usuario invalido.", 404);
});


Route::middleware('auth:sanctum')->apiResource('/products', ProductsController::class);
