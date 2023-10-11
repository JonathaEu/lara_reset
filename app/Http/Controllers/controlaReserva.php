<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Models\reserva;
use App\Http\Requests\StorereservaRequest;
// use App\Http\Requests\UpdatereservaRequest;
use App\Http\Resources\reservaResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaReserva extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return reservaResource::collection(reserva::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $clientes_id = $request->clientes_id;
            $quartos_id = $request->quartos_id;
            $users_id = $request->users_id;
            $status = $request->status;
            $dt_inicial = $request->dt_inicial;
            $dt_final = $request->dt_final;
            $check_in = $request->check_in;

            reserva::create([
                "clientes_id" => $clientes_id,
                "quartos_id" => $quartos_id,
                "users_id" => $users_id,
                "status" => $status,
                "dt_inicial" => $dt_inicial,
                "dt_final" => $dt_final,
                "check_in" => $check_in,
            ]);
            return response()->json(["success" => true, "mensagem" => 'Reserva registrada'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => "Erro no servidor", "error" => $e], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $reserva = reserva::where('reservas.id', $id)
                ->join('clientes', 'clientes.id', '=', 'reservas.clientes_id')
                ->select(
                    'clientes.nome',
                    'reservas.clientes_id',
                    'reservas.quartos_id',
                    'reservas.check_in',
                    'reservas.check_out',
                    'reservas.dt_inicial',
                    'reservas.dt_final',
                    'reservas.status',
                )

                ->groupBy(
                    'clientes.nome',
                    'reservas.clientes_id',
                    'reservas.quartos_id',
                    'reservas.check_in',
                    'reservas.check_out',
                    'reservas.dt_inicial',
                    'reservas.dt_final',
                    'reservas.status'
                )
                ->with('quartos')
                ->get()
                ->toArray();

            $clientes = DB::table('clientes')
                ->select(
                    'id',
                    'nome'
                )
                ->get()
                ->toArray();

            $listaClientes = [];
            foreach ($clientes as $client) {

                $listaClientes[] = [
                    "label" => $client->nome,
                    "value" => $client->id
                ];
            }
            $quartos = DB::table('quartos')
                ->select(
                    'id',
                    'nome'
                )
                ->get()
                ->toArray();

            $listaQuartos = [];
            foreach ($quartos as $quarto) {

                $listaQuartos[] = [
                    "label" => $quarto->nome,
                    "value" => $quarto->id
                ];
            }
            // return $listaClientes;
            return response()->json([
                'data' => $reserva,
                'clientes' => $listaClientes,
                'quartos' => $listaQuartos,
                'success' => true
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e
            ], 400);
        }
    }

    public function checkIn($id, Request $request)
    {
        try {
            $check_in = $request->check_in;
            $reserva = reserva::find($id);
            $reserva->check_in = $check_in;
            $reserva->status = 'iniciado';
            $reserva->save();

            return response()->json([
                'mensagem' => 'Check in registrado com sucesso',
                'success' => true,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'mensagem' => 'falha no servidor',
                'success' => false,
            ], 400);
        }
    }
    public function checkOut($id, Request $request)
    {
        try {
            $check_out = $request->check_out;
            $reserva = reserva::find($id);
            $reserva->check_out = $check_out;
            $reserva->status = 'finalizado';
            $reserva->save();

            return response()->json([
                'mensagem' => 'Check out registrado com sucesso',
                'success' => true,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'mensagem' => 'falha no servidor',
                'success' => false,
            ], 400);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function Pagamento(Request $request)
    {
        try {
            $cliente = $request->clientes_id;
            $reserva = reserva::where('clientes_id', $cliente)
                ->pluck('id');

            $consumo = consumo::where('reservas_id', $reserva)
                ->join('itens', 'itens.id', '=', 'consumo.iten_id')
                ->select(
                    'itens.nome',
                    'consumo.iten_id',
                    'consumo.quantidade',
                    'consumo.valor_total',
                    'consumo.created_at',
                )
                ->get();
            $valor_total = consumo::where('reservas_id', $reserva)
                ->pluck('valor_total')
                ->toArray();

            $vt = array_sum($valor_total);
            // foreach ($valor_total as $vt) {
            //     $vt++;
            // }

            return response()->json([
                'reserva_id' => $reserva,
                'consumo' => $consumo,
                'valor_total' => $valor_total,
                'vt' => $vt
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'Success' => false,
                'mensagem' => 'Deu ruim',
                'Error' => $e
            ], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */

    public function Update(Request $request, $id)
    {
        try {
            $clientes_id = $request->clientes_id;
            $quartos_id = $request->quartos_id;
            $users_id = $request->users_id;
            $status = $request->status;
            $dt_inicial = $request->dt_inicial;
            $dt_final = $request->dt_final;
            $check_in = $request->check_in;
            $check_out = $request->check_out;

            $reserva = DB::table('reservas')
                ->where('id', $id);
            $reserva->update([
                "clientes_id" => $clientes_id,
                "quartos_id" => $quartos_id,
                "users_id" => $users_id,
                "status" => $status,
                "dt_inicial" => $dt_inicial,
                "dt_final" => $dt_final,
                "check_in" => $check_in,
                "check_out" => $check_out,
            ]);
            return response()->json([
                "success" => true,
                "mensagem" => 'Registro atualizado com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "Mensagem" => "erro no servidor",
                "error" => $e
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    //     public function destroy(reserva $reserva)
    //     {
    //         //
    //     }
}