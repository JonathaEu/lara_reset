<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Models\Pagamento;
use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\reserva;
use Exception;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pagamento::collection(Pagamento::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePagamentoRequest $request)
    {
        try {
            $valor = $request->valor;
            $reservas_id = $request->reservas_id;

            Pagamento::create([
                'valor' => $valor,
                'reservas_id' => $reservas_id,
            ]);

            return response()->json([
                'success' => true,
                'mensagem' => 'Cadastro realizado com sucesso',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'Success' => false,
                'mensagem' => 'Erro no servidor',
                'Error' => $e
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pagamento $pagamento, $id)
    {
        try {
            $Pagamento = Pagamento::where('id', $id)
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'Pagamento' => $Pagamento
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'Success' => false,
                'Mensagem' => 'Erro no servidor',
                'Error' => $e,
            ], 400);
        }
    }
    public function Pendencias(Request $request)
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
            $vt = consumo::where('reservas_id', $reserva)
                ->pluck('valor_total')
                ->toArray();

            $valor_total = array_sum($vt);
            // foreach ($valor_total as $vt) {
            //     $vt++;
            // }

            return response()->json([
                // 'reserva_id' => $reserva,
                'valor_total' => $valor_total,
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
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $valor = $request->valor;
            $reservas_id = $request->reservas_id;

            $Pagamento = Pagamento::where('id', $id);
            $Pagamento->update([
                'valor' => $valor,
                'reservas_id' => $reservas_id,
            ]);

            return response()->json([
                'success' => true,
                'mensagem' => 'Atualizado com sucesso',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'Success' => false,
                'mensagem' => 'Erro no servidor',
                'Error' => $e
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {
        //
    }
}