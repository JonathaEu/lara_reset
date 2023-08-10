<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\itensResource;
use App\Models\iten;
use Exception;
use Illuminate\Http\Request;

class controlaItens extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  itensResource::collection(iten::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public  function store(StoreItemRequest  $request)
    {
        try {
            iten::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Item Registrado Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public  function show(iten  $iten)
    {
        try {
            return new itensResource($iten);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public  function Update(StoreitemRequest  $request, iten $iten)
    {
        try {
            $iten->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(iten $iten)
    {
        //
    }
}
