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
    public function store(StoreQuartoRequest $request)
    {
        ($request->validated());
        try {
            quarto::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Acomodação registrada'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => $e, "error" => $e], 400);
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

            $MFR = array_count_values($quartos);
            arsort($MFR);

            dd(array_key_first($MFR));
            // $MVR = max($MFR);
        } catch (Exception $e) {
            $msg = 'deu ruim';
        }
        return $MFR;
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