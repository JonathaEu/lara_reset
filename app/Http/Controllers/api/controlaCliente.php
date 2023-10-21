<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Resources\clienteResource;
use App\Models\cliente;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaCliente extends Controller
{
    public function index()
    {
        return clienteResource::collection(cliente::all());
    }

    public function store(StoreClienteRequest $request)
    {
        try {
            $nome = $request->nome;
            $cpf = $request->cpf;
            $email = $request->email;
            $nascimento = $request->nascimento;
            $telefone = $request->telefone;
            $cidade = $request->cidade;
            $estado = $request->estado;
            $genero = $request->genero;

            cliente::create([
                'nome' => $nome,
                'cpf' => $cpf,
                'email' => $email,
                'nascimento' => $nascimento,
                'telefone' => $telefone,
                'cidade' => $cidade,
                'estado' => $estado,
                'genero' => $genero,
            ]);

            return response()->json([
                "success" => true,
                "mensagem" => 'cliente registrado'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "mensagem" => "erro no servidor",
                "error" => $e
            ], 400);
        }
    }
    public function Update(Request $request, $id)
    {
        try {
            $nome = $request->nome;
            $cpf = $request->cpf;
            $email = $request->email;
            $nascimento = $request->nascimento;
            $telefone = $request->telefone;
            $cidade = $request->cidade;
            $estado = $request->estado;
            $genero = $request->genero;

            $cliente = cliente::where('id', $id);
            $cliente->update([
                'nome' => $nome,
                'cpf' => $cpf,
                'email' => $email,
                'nascimento' => $nascimento,
                'telefone' => $telefone,
                'cidade' => $cidade,
                'estado' => $estado,
                'genero' => $genero,
            ]);
            return response()->json([
                "success" => true,
                "mensagem" => 'Registro atualizado com sucesso'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "mensagem" => "Erro no servidor",
                "error" => $e
            ], 400);
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
            return response()->json([
                "success" => false,
                "error" => $e
            ], 400);
        }
    }

    public function client_list()
    {
        try {
            $clientes = DB::table('clientes')
                ->select(
                    'id',
                    'nome'
                )
                ->get()
                ->toArray();

            $listaClientes = [];
            foreach ($clientes as $client) {

                $listaClientes[] = [
                    "label" => $client->nome,
                    "value" => $client->id
                ];
            }
            return response()->json([
                'success' => true,
                'listaClientes' => $listaClientes
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'mensagem' => 'Erro no servidor',
                'error' => $e,
            ], 400);
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
