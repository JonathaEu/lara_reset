<?php

use App\Http\Controllers\api\controlaCliente;
use App\Http\Controllers\controlaFrigobar_itens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Autenticar;
use App\Http\Controllers\controlaConsumo;
use App\Http\Controllers\controlaEstacionamento;
use App\Http\Controllers\controlaFrigobar;
use App\Http\Controllers\controlaItens;
use App\Http\Controllers\controlaQuarto;
use App\Http\Controllers\controlaReserva;
use App\Http\Controllers\controlaTipo_quarto;
use App\Models\cliente;
use App\Models\estacionamento;
use App\Models\frigobar;
use App\Models\frigobar_iten;
use App\Models\quarto;
use App\Models\reserva;
use App\Models\tipo_quarto;
use Illuminate\Support\Facades\DB;

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
Route::middleware(['api'])->group(function () {
    // dd(mid);
    Route::apiResource('cliente', controlaCliente::class);
    Route::apiResource('quarto', controlaQuarto::class);
    Route::apiResource('consumo', controlaConsumo::class);
    Route::apiResource('reserva', controlaReserva::class);
    Route::apiResource('tipo_quarto', controlaTipo_quarto::class);
    Route::apiResource('estacionamento', controlaEstacionamento::class);
    Route::apiResource('frigobar_itens', controlaFrigobar_itens::class);
    Route::apiResource('itens', controlaItens::class);
    Route::apiResource('frigobar', controlaFrigobar::class);
    // Route::middleware('api')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::get('/me', function () {
        return auth()->user();
    });

    Route::get('/frigobar_quarto', function () {
        $frigobar = frigobar::with('quarto')->get();
        return
            $frigobar;
    });

    Route::post('/showConsumo', [controlaConsumo::class, 'show']);
    Route::post('/pagamento', [controlaReserva::class, 'pagamento']);
    Route::get('/item-mais-frequente', [controlaConsumo::class, 'mostFrequentlyItem']);
    Route::get('/quarto-mais-frequente', [controlaQuarto::class, 'MostValuableRoom']);


    Route::get('/reserva_rel', function () {

        // $quartos_id = frigobar->quartos_id;
        $reservas = reserva::with('quartos')
            ->with('consumos')
            ->with('clientes')
            ->with('users')
            ->get();

        return response()->json(['data' => $reservas], 200);
    });
    Route::post('/armazenamento', [controlaFrigobar_itens::class, 'estoque']);
    Route::put('/check-in/{id}', [controlaReserva::class, 'checkIn']);
    Route::put('/check-out/{id}', [controlaReserva::class, 'checkOut']);

    Route::get('/estacionamento_quarto', function () {

        $estacionamento = estacionamento::with('quarto')->get();
        return
            $estacionamento;
    });

    // Route::post('/deleteManyItens', [controlaFrigobar_itens::class, 'destroy']);
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