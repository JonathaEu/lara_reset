<?php

use App\Http\Controllers\api\controlaCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Autenticar;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => ''],    function () {
    Route::apiResource('cliente',   controlaCliente::class);
});

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/me', function () {
    return auth()->user();
});

Route::post('/logout', function () {
    auth()->logout();
    response()->json(['message' => 'Usuário desautenticado com sucesso']);
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['name', 'password']);
    // dd($credentials);
    if (!$token = auth()->attempt($credentials)) {
        abort(401, 'Unauthorized');
    }

    return response()->json([
        'data' => [
            'user' => auth()->user(),
            // 'status'=>'200',
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]
    ]);
});
