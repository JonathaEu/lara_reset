<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Models\reserva;
use App\Http\Requests\StorereservaRequest;
// use App\Http\Requests\UpdatereservaRequest;
use App\Http\Resources\reservaResource;
use Exception;
use Illuminate\Http\Request;

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
    public function store(StoreReservaRequest $request)
    {
        try {
            reserva::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Reserva Realizada Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
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

            return response()->json([
                'data' => $reserva,
                'success' => true
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e
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
                'mensagem' => 'Deu ruim'
            ], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */

    public function Update(StoreReservaRequest $request, reserva $reserva)
    {
        try {
            $reserva->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }


    // public function CheckOut()

    /**
     * Remove the specified resource from storage.
     */
    //     public function destroy(reserva $reserva)
    //     {
    //         //
    //     }
}