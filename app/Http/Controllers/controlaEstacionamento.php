<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstacionamentoRequest;
use App\Http\Resources\estacionamentoResource;
use App\Models\estacionamento;
use Exception;
use Illuminate\Http\Request;

class controlaEstacionamento extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return estacionamentoResource::collection(estacionamento::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $quartos_id = $request->quartos_id;

            estacionamento::create([
                "quartos_id" => $quartos_id,
            ]);
            return response()->json(["success" => true, "mensagem" => 'Vaga do estacionamento registrada'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => "Erro no servidor", "error" => $e], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(estacionamento $estacionamento)
    {
        try {
            return new estacionamentoResource($estacionamento);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEstacionamentoRequest $request, estacionamento $estacionamento)
    {
        try {
            $estacionamento->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(estacionamento $estacionamento)
    {
        //
    }
}