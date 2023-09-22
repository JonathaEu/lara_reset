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

Route::group(['prefix' => ''], function () {
    Route::apiResource('cliente', controlaCliente::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('quarto', controlaQuarto::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('consumo', controlaConsumo::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('reserva', controlaReserva::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('tipo_quarto', controlaTipo_quarto::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('estacionamento', controlaEstacionamento::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('frigobar_itens', controlaFrigobar_itens::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('itens', controlaItens::class);
});

Route::group(['prefix' => ''], function () {
    Route::apiResource('frigobar', controlaFrigobar::class);
});

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/me', function () {
    return auth()->user();
});

Route::get('/frigobar_quarto', function () {

    // $quartos_id = frigobar->quartos_id;
    $frigobar = frigobar::with('quarto')->get();
    return
        $frigobar;
});

Route::get('/reserva_rel', function () {

    // $quartos_id = frigobar->quartos_id;
    $reservas = reserva::with('quartos')
        ->with('consumos')
        ->with('clientes')
        ->with('users')
        ->get();
    // $rel_clientes = reserva::with('clientes')->get();
    // $rel_consumos = reserva::with('consumos')->get();
    // $rel_funcionarios = reserva::with('users')->get();

    return response()->json(['data' => $reservas], 200);

    // return response()->json([
    //     [
    //         'reserva_quartos' => $rel_quartos,
    //         'reserva_clientes' => $rel_clientes,
    //         'reserva_consumos' => $rel_consumos,
    //         'reserva_funcionarios' => $rel_funcionarios,
    //     ]
    // ]);
});
Route::get('/estoque', [controlaFrigobar_itens::class, 'estoque']);
// Route::get('/frigobar_itens_rel', function () {
//     $qtdItem = 0;
//     $frigobar = frigobar::with('itens')
//         ->where('id', 5)
//         ->count('id');
//     // ->get();

//     // $itensIntoFrig = DB::table('frigobar_iten AS fi')
//     //     ->select(
//     //         'fi.id as frigobar_item_id',
//     //         'fi.frigobar_id',
//     //         // 'fi.iten_id',
//     //         // 'itens.nome',
//     //         // 'itens.quantidade as quantidade_estoque'
//     //     )
//     //     ->join('itens', 'itens.id', '=', 'fi.iten_id')
//     //     ->select(
//     //         'itens.nome',
//     //         'itens.quantidade as quantidade_estoque',
//     //         'fi.id as frigobar_item_id',
//     //         'fi.frigobar_id',
//     //         'itens.id as id_do_item'
//     //     )
//     //     ->where('fi.frigobar_id', 6)
//     //     ->get();
//     // $itensIntoFrig = DB::table('frigobar_iten as fi')
//     //     ->select(
//     //         'fi.id as frigobar_item_id',
//     //         'fi.frigobar_id',
//     //         'it.nome',
//     //         'it.quantidade as quantidade_estoque',
//     //         'it.id',
//     //         DB::raw('COUNT(fi.id) as quantidade_frigobar')
//     //     )
//     //     ->join('itens as it', 'it.id', '=', 'fi.iten_id')
//     //     ->where('fi.frigobar_id', '=', 6)
//     //     ->groupBy('it.id')
//     //     ->get();

//     // $itensIntoFrig = DB::select("
//     //     SELECT 
//     //         fi.id AS frigobar_item_id,
//     //         fi.frigobar_id,
//     //         it.nome,
//     //         it.quantidade AS quantidade_estoque,
//     //         COUNT(fi.id) AS quantidade_frigobar
//     //     FROM
//     //         frigobar_iten AS fi
//     //     INNER JOIN
//     //         itens AS it ON it.id = fi.iten_id
//     //     WHERE
//     //         fi.frigobar_id = 6
//     //     GROUP BY
//     //         it.id
//     // ");



//     dd($itensIntoFrig);
//     return response()->json(['data' => $itensIntoFrig]);

//     // return $itensIntoFrig;
// });

Route::get('/estacionamento_quarto', function () {

    $estacionamento = estacionamento::with('quarto')->get();
    return
        $estacionamento;
});


Route::post('/deleteItemFromFrigobar', function (request $request) {
    // $itens_frigobar = DB::select(`select * from frigobar_iten where iten_id = $iten_id and frigobar_id = $frigobar_id`, [1]);
    // return response()->json([$itens_frigobar]);
    $iten_id = $request->iten_id;
    $frigobar_id = $request->frigobar_id;
    $id = frigobar_iten::select('id')
        ->where('frigobar_id', $frigobar_id)
        ->where('iten_id', $iten_id)->take(1)
        ->delete();

    return response()->json(['Mensagem' => 'Ocorrência removida com sucesso'], 200);
    // $id->pluck(id);
    // dd($id);
    // $id->;
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