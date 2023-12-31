<?php

namespace App\Http\Controllers;

use App\Http\Requests\frigobarRequest;
use App\Http\Resources\frigobarResource;
use App\Models\frigobar;
use Exception;
use Illuminate\Http\Request;

class controlaFrigobar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  frigobarResource::collection(frigobar::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(frigobarRequest $request)
    {
        try {
            frigobar::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Frigobar Registrado Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(frigobar $frigobar)
    {
        try {
            return new frigobarResource($frigobar);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(frigobarRequest $request, frigobar $frigobar)
    {
        try {
            $frigobar->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(frigobar $frigobar)
    {
        try {
            $frigobar->delete();
            return response()->json("Frigobar Inativado Com Sucesso!");
        } catch (Exception $e) {
            return response()->json(["sucess" => false, "mensagem" => "Item não encontrado não encontrado", "error" => $e], 400);
        }
    }
}
