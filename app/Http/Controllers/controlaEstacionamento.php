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
        return  estacionamentoResource::collection(estacionamento::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstacionamentoRequest $request)
    {
        try {
            estacionamento::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Item Registrado Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
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
