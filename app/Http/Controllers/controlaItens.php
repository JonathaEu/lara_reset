<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Resources\itensResource;
use App\Models\iten;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaItens extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return itensResource::collection(iten::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nome = $request->nome;
            $valor = $request->valor;
            $quantidade = $request->quantidade;

            iten::create([
                "nome" => $nome,
                "valor" => $valor,
                "quantidade" => $quantidade,
            ]);
            return response()->json(["success" => true, "mensagem" => 'Item registrado'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => "Erro no servidor", "error" => $e], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(iten $iten)
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
    public function Update(Request $request, $id)
    {
        try {
            $nome = $request->nome;
            $valor = $request->valor;
            $estoque = $request->estoque;

            $item = DB::table('itens')
                ->where('id', $id);
            $item->update([
                "nome" => $nome,
                "valor" => $valor,
                "estoque" => $estoque,
            ]);
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