<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Models\Pagamento;
use App\Http\Requests\StorePagamentoRequest;
use App\Http\Requests\UpdatePagamentoRequest;
use App\Models\quarto;
use App\Models\reserva;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\IsEmpty;

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
    public function store(Request $request)
    {
        try {
            $valor = $request->valor;
            $metodo = $request->metodo;
            $parcelas = $request->parcelas;
            $reservas_id = $request->reservas_id;

            Pagamento::create([
                'valor' => $valor,
                'metodo' => $metodo,
                'parcelas' => $parcelas,
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

            $consumo_count = consumo::where('reservas_id', $reserva)
                ->pluck('valor_total')
                ->toArray();

            $valor_consumo = array_sum($consumo_count);

            $quarto_id = reserva::where('id', $reserva)
                ->pluck('quartos_id');

            $valor_quarto = quarto::where('id', $quarto_id)
                ->pluck('valor');

            $valor_pagamento = pagamento::where('reservas_id', $reserva)
                ->pluck('valor');

            if ($valor_pagamento->IsEmpty()) {
                $valor_pagamento = 0;
            } else {
                $valor_pagamento = 1;
            }

            $valor_total = $valor_quarto[0] + $valor_consumo;

            return response()->json([
                // 'reserva_id' => $reserva,
                'pendencia' => $valor_total,
                'pagou_bool' => $valor_pagamento,
                'reservas_id' => $reserva,
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
            $metodo = $request->metodo;
            $parcelas = $request->parcelas;
            $reservas_id = $request->reservas_id;

            $Pagamento = Pagamento::where('id', $id);
            $Pagamento->update([
                'valor' => $valor,
                'metodo' => $metodo,
                'parcelas' => $parcelas,
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