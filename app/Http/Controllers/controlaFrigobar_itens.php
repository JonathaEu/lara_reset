<?php

namespace App\Http\Controllers;

use App\Http\Requests\frigobar_itensRequest;
use App\Http\Resources\frigobar_itensResource;
use App\Models\frigobar;
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
        // return $itens_do_frigobar;
        return frigobar_itensResource::collection(frigobar_iten::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $frigobar = $request->frigobar_id;
            $itens = $request->iten_id;
            $success = 0;
            $error = 0;

            $itens = array();
            $quantidade = array();
            $itens = [1, 2];
            $quantidade = [3, 6];

            foreach ($itens as $idx => $item) {
                for ($i = 0; $i < $quantidade[$idx]; $i++) {
                    // dd($quantidade[$item]);
                    if (is_array($itens)) {
                        // frigobar_iten::create($request->validated());
                        // foreach ($itens as $item) {
                        if (
                            frigobar_iten::create([
                                "iten_id" => $item,
                                "frigobar_id" => $frigobar
                            ])
                        ) {
                            $success++;
                        } else {
                            $error++;
                        }
                    } else {
                        if (
                            frigobar_iten::create([
                                "iten_id" => $itens,
                                "frigobar_id" => $frigobar
                            ])
                        ) {
                            $success++;
                        } else {
                            $error++;
                        }
                    }
                }
            }

            if (!$error && $success > 0) {
                $msg = "Itens cadastrados";
            } elseif ($error > 0 && $success > 0) {
                $msg = "Alguns itens foram cadastrados";
            } else {
                $msg = "Erro ao cadastrar itens";
            }

            // $erros = !$erro ? $erro . "itens não foram salvos" : "";
            // $sucess = !$salvo ? $salvo . "itens foram gravados com sucesso" : "";
            return response()->json(['success' => true, 'msg' => $msg], 200);
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