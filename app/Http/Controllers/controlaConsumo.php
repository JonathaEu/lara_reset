<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Http\Requests\StoreconsumoRequest;
use App\Http\Resources\consumoResource;
use Exception;
use Illuminate\Http\Request;

class controlaConsumo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return consumoResource::collection(consumo::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $item = $request->itens_id;
            $valor_total = $request->valor_total;
            $reservas_id = $request->reservas_id;
            $quantidade = $request->quantidade;
            consumo::create([
                'itens_id' => $item,
                'reservas_id' => $reservas_id,
                'quantidade' => $quantidade,
                'valor_total' => $valor_total
            ]);
            // $valor_total = DB::table('consumo')
            // ->where('itens_id',$item)
            // ->where('quartos_id',$quarto)

            return response()->json(["success" => true, "mensagem" => 'Consumo Registrado Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(consumo $consumo)
    {

        try {
            return new consumoResource($consumo);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreconsumoRequest $request, consumo $consumo)
    {
        try {
            $consumo->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(consumo $consumo)
    {
        //
    }
}