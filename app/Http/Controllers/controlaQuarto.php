<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuartoRequest;
use App\Http\Resources\quartoResource;
use App\Models\quarto;
use App\Models\reserva;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaQuarto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return quartoResource::collection(quarto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $nome = $request->nome;
            $numero = $request->numero;
            $valor = $request->valor;
            $max_cap = $request->max_cap;
            $tipo_quartos_id = $request->tipo_quartos_id;

            quarto::create([
                "nome" => $nome,
                "numero" => $numero,
                "valor" => $valor,
                "max_cap" => $max_cap,
                "tipo_quartos_id" => $tipo_quartos_id,
            ]);
            return response()->json(["success" => true, "mensagem" => 'Acomodação registrada'], 200);
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
            $quarto = quarto::where('id', $id)
                ->get()
                ->toArray();

            return response()->json([
                'data' => $quarto,
                'success' => true
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e
            ], 400);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuartoRequest $request, quarto $quarto)
    {
        try {
            $quarto->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    public function MostValuableRoom()
    {
        $msg = '';
        try {
            $quartos = DB::table('reservas')
                ->pluck('quartos_id')
                ->toArray();

            $MFRcount = array_count_values($quartos);
            arsort($MFRcount);

            $MFR = (array_key_first($MFRcount));

            $quartoMaisFrequente = DB::table('quartos')
                ->select('nome')
                ->where('id', $MFRcount)
                ->get();
            return response()->json([
                'success' => true,
                'quartoMaisFrequente' => $quartoMaisFrequente
            ], 200);
            // $MVR = max($MFR);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'erro' => $e
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(quarto $quarto)
    {
        try {
            $quarto->delete();
            return response()->json("Acomodação Removida Com Sucesso!");
        } catch (Exception $e) {
            return response()->json(["sucess" => false, "mensagem" => "Usuário não encontrado", "error" => $e], 400);
        }
    }
}