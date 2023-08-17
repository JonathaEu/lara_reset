<?php

namespace App\Http\Controllers;

use App\Http\Requests\frigobar_itensRequest;
use App\Http\Resources\frigobar_itensResource;
use App\Models\frigobar_iten;
use Exception;
use Illuminate\Http\Request;

class controlaFrigobar_itens extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  frigobar_itensResource::collection(frigobar_iten::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(frigobar_itensRequest $request)
    {
        try {
            frigobar_iten::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Item Registrado Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(frigobar_iten $frigobar_iten)
    {
        try {
            return new frigobar_itensResource($frigobar_iten);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(frigobar_itensRequest $request, frigobar_iten $frigobar_iten)
    {
        try {
            $frigobar_iten->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(frigobar_iten $frigobar_iten)
    {
        //
    }
}
