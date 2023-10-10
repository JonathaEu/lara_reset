<?php

namespace App\Http\Controllers;

use App\Http\Requests\frigobarRequest;
use App\Http\Resources\frigobarResource;
use App\Models\frigobar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaFrigobar extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return frigobarResource::collection(frigobar::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $quartos_id = $request->quartos_id;
            $ativo = $request->atvo;
            $numero = $request->numero;

            frigobar::create([
                "quartos_id" => $quartos_id,
                "numero" => $numero,
                "ativo" => $ativo,
            ]);
            return response()->json(["success" => true, "mensagem" => 'Frigobar registrado'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => "Erro no servidor", "error" => $e], 400);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $frigobar = frigobar::where('id', $id)
                ->get()
                ->toArray();
            return $frigobar;

        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $quartos_id = $request->quartos_id;
            $ativo = $request->atvo;
            $numero = $request->numero;

            $frigobar = DB::table('frigobar')
                ->where('id', $id);
            $frigobar->update([
                "quartos_id" => $quartos_id,
                "numero" => $numero,
                "ativo" => $ativo,
            ]);
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