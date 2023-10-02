<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Resources\clienteResource;
use App\Models\cliente;
use Exception;
use Illuminate\Http\Request;

class controlaCliente extends Controller
{
    public function index()
    {
        return clienteResource::collection(cliente::all());
    }

    public function store(StoreClienteRequest $request)
    {
        try {
            cliente::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'cliente registrado'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }
    public function Update(StoreClienteRequest $request, cliente $cliente)
    {
        try {
            $cliente->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }
    public function show($id)
    {
        try {
            $cliente = cliente::where('id', $id)
                ->get()
                ->toArray();

            return response()->json([
                'data' => $cliente,
                'success' => true
            ], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    public function destroy(cliente $cliente)
    {
        try {
            $cliente->delete();
            return response()->json("Usuário deletado com sucesso!");
        } catch (Exception $e) {
            return response()->json(["sucess" => false, "mensagem" => "Usuário não encontrado", "error" => $e], 400);
        }
    }
}