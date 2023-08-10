<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTipo_quartoRequest;
use App\Http\Resources\tipo_quartoResource;
use App\Models\tipo_quarto;
use Exception;
use Illuminate\Http\Request;

class controlaTipo_quarto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return tipo_quartoResource::collection(tipo_quarto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipo_quartoRequest $request)
    {
        try {
            tipo_quarto::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Tipo de acomodação registrada'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tipo_quarto $tipo_quarto)
    {

        try {
            return new tipo_quartoResource($tipo_quarto);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTipo_quartoRequest $request, tipo_quarto $tipo_quarto)
    {
        try {
            $tipo_quarto->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(tipo_quarto $tipo_quarto)
    // {
    //     try {
    //         $tipo_quarto->delete();
    //         return response()->json("Usuário deletado com sucesso!");
    //     } catch (Exception $e) {
    //         return response()->json(["sucess" => false, "mensagem" => "Usuário não encontrado", "error" => $e], 400);
    //     }
    // }
}
