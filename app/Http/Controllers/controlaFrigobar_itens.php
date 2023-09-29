<?php

namespace App\Http\Controllers;

use App\Http\Requests\frigobar_itensRequest;
use App\Http\Resources\frigobar_itensResource;
use App\Models\frigobar;
use App\Models\frigobar_iten;
use App\Models\iten;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // try {
        $frigobar = $request->frigobar_id;
        $itens = $request->iten_id;
        $quantidade = $request->quantidade;
        $success = 0;
        $error = 0;
        $msg = '';
        $check_already_exist = DB::table('frigobar_iten')
            ->select('quantidade')
            ->where('frigobar_id', $frigobar)
            ->where('iten_id', $itens)
            ->pluck('quantidade');
        // ->get();
        // ->toArray();
        if ($check_already_exist->isNotEmpty()) {
            foreach ($check_already_exist as $cae) {

                if ($cae > 0 && !null) {
                    try {
                        if (
                            DB::table('frigobar_iten')
                                ->where('frigobar_id', $frigobar)
                                ->where('iten_id', $itens)
                                ->increment('quantidade', $quantidade)
                        ) {
                            $success++;
                            $msg = 'Item(S) adicionado(s) com sucesso';

                            DB::table('itens')
                                ->where('id', $itens)
                                ->decrement('estoque', $quantidade);
                        } else {
                            $error++;
                            $msg = 'Erro ao adicionar item(s)';
                        }
                        return response()->json([
                            'success' => true,
                            'msg' => $msg
                        ], 200);

                    } catch (Exception $e) {
                        return response()->json([
                            "success" => false,
                            "mensagem" => $msg,
                            "error" => $e
                        ], 400);
                    }
                }
            }
        } else {
            try {
                if (
                    frigobar_iten::create([
                        'frigobar_id' => $frigobar,
                        'iten_id' => $itens,
                        'quantidade' => $quantidade
                    ])
                ) {
                    $success++;
                    $msg = 'Item(S) adicionado(s) com sucesso';
                } else {
                    $error++;
                    $msg = 'Erro ao adicionar item(s)';
                }
                return response()->json([
                    'success' => true,
                    'msg' => $msg
                ], 200);

            } catch (Exception $e) {
                return response()->json([
                    "success" => false,
                    "mensagem" => $msg,
                    "error" => $e
                ], 400);
            }
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
    public function destroy(Request $request)
    {
        $frigobar = $request->frigobar_id;
        $itens = $request->iten_id;
        $quantidade = $request->quantidade;
        $success = 0;
        $error = 0;
        $msg = '';
        $check_already_exist = DB::table('frigobar_iten')
            ->select('quantidade')
            ->where('frigobar_id', $frigobar)
            ->where('iten_id', $itens)
            ->pluck('quantidade');
        // ->get();
        // ->toArray();
        if ($check_already_exist->isNotEmpty()) {
            foreach ($check_already_exist as $cae) {

                if ($cae > 0 && !null) {
                    try {
                        if (
                            DB::table('frigobar_iten')
                                ->where('frigobar_id', $frigobar)
                                ->where('iten_id', $itens)
                                ->decrement('quantidade', $quantidade)
                        ) {
                            $success++;
                            $msg = 'Item(S) adicionado(s) com sucesso';
                        } else {
                            $error++;
                            $msg = 'Erro ao adicionar item(s)';
                        }
                        return response()->json([
                            'success' => true,
                            'msg' => $msg
                        ], 200);

                    } catch (Exception $e) {
                        return response()->json([
                            "success" => false,
                            "mensagem" => $msg,
                            "error" => $e
                        ], 400);
                    }
                }
            }
        }
    }
    public function estoque(frigobar_iten $frigobar_iten)
    {
        try {
            $armazenamento = DB::table('frigobar_iten AS fi')
                ->select(
                    'fi.quantidade',
                    'itens.nome'
                )
                ->join('itens', 'itens.id', '=', 'fi.iten_id')
                ->where('frigobar_id', 5)
                ->groupBy('itens.nome', 'fi.quantidade')
                ->get();
            // ->toArray();
            return response()->json([
                'armazenamento' => $armazenamento,
                'success' => true
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e
            ]);
        }
    }
}