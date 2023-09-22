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
        try {
            $frigobar = $request->frigobar_id;
            $itens = $request->iten_id;
            $quantidade = $request->quantidade;
            $success = 0;
            $error = 0;

            // $itens = array();
            // $quantidade = array();
            // $itens = [1, 2];
            // $quantidade = [3, 6];

            $counter = 0;
            $negative = -1;
            // $itens = array();
            // $quantidade = array();
            // $itens = [1, 2];
            // $quantidade = [3, 6];

            foreach ($itens as $idx => $item) {
                for ($i = 0; $i < $quantidade[$idx]; $i++) {

                    // dd($quantidade[$idx]);
                    if (is_array($itens)) {

                        if (
                            frigobar_iten::create([
                                "iten_id" => $item,
                                "frigobar_id" => $frigobar
                            ])

                        ) {
                            $success++;
                            $counter++;
                            $calc = $counter * $negative;
                            $total = $quantidade[$idx] + $calc;
                            dd($total);
                            // dd($counter);
                            // DB::table('itens')
                            //     ->whereIn('id', $itens)
                            //     ->decrement('quantidade', $quantidade[$idx]);
                        } else {
                            $error++;
                        }
                    } else {
                        // if (
                        //     frigobar_iten::create([
                        //         "iten_id" => $itens,
                        //         "frigobar_id" => $frigobar
                        //     ])
                        // ) {
                        //     $success++;
                        //     // DB::table('itens')
                        //     //     ->whereIn('id', $itens)
                        //     //     ->decrement('quantidade', $quantidade);

                        // } else {
                        //     $error++;
                        // }
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
    public function estoque(frigobar_iten $frigobar_iten)
    {
        $qtdItem = 0;

        // $sql = "select id, frigobar_id, iten_id, count(iten_id) as count from frigobar_iten group by iten_id";
        // // $frigobar = DB::select($sql);
        // $frigobar = frigobar_iten::select(['id', 'frigobar_id', 'iten_id'])
        //     ->with('itens')
        //     ->select('iten.id')
        //     ->where('frigobar_id', 6)
        //     // ->groupBy(['iten_id'])
        //     ->get()
        //     // ->toArray();
        // ;
        // $frigobar = DB::table('frigobar_iten')->selectRaw('*, count(*)')->groupBy('iten_id')->get();
        // dd($frigobar);
        // $frigobar = frigobar_iten::withCount
        // ->get();

        $itensIntoFrig = DB::table('frigobar_iten AS fi')
            ->select(
                'fi.id as frigobar_item_id',
                'fi.frigobar_id',
                // 'fi.iten_id',
                // 'itens.nome',
                // 'itens.quantidade as quantidade_estoque'
            )
            ->join('itens', 'itens.id', '=', 'fi.iten_id')
            ->select(
                'itens.nome',
                'itens.quantidade as quantidade_estoque',
                'fi.id as frigobar_item_id',
                'fi.frigobar_id',
                'itens.id as id_do_item'
            )
            ->where('fi.frigobar_id', 6)
            ->get()
            ->toArray();
        $itensCountInFrigobar = DB::table('frigobar_iten AS fi')
            ->select(
                'itens.nome',
                'itens.quantidade as quantidade_estoque',
                DB::raw('COUNT(fi.id) as quantidade_no_frigobar')
            )
            ->join('itens', 'itens.id', '=', 'fi.iten_id')
            ->where('fi.frigobar_id', 6)
            ->groupBy('itens.nome', 'itens.quantidade')
            ->get();
        // $itensIntoFrig = [];

        // $frigobarItens = $itensIntoFrig->select('nome');
        // $itensIntoFrig = DB::table('frigobar_iten as fi')
        //     ->selectRaw(
        //         'fi.id as frigobar_item_id,
        //         fi.frigobar_id,
        //         it.nome,
        //         it.quantidade as quantidade_estoque,
        //         it.id,
        //         count(fi.id) as quantidade_frigobar'
        //     )
        //     ->join('itens as it', 'it.id', '=', 'fi.iten_id')
        //     ->where('fi.frigobar_id', '=', 6)
        //     ->groupBy('it.id')
        //     ->get();

        // $itensIntoFrig = DB::select("
        //     SELECT 
        //         fi.id AS frigobar_item_id,
        //         fi.frigobar_id,
        //         it.nome,
        //         it.quantidade AS quantidade_estoque,
        //         COUNT(fi.id) AS quantidade_frigobar
        //     FROM
        //         frigobar_iten AS fi
        //     INNER JOIN
        //         itens AS it ON it.id = fi.iten_id
        //     WHERE
        //         fi.frigobar_id = 6
        //     GROUP BY
        //         it.id
        // ");
        return response()->json(['data' => $itensCountInFrigobar]);

        // return $itensIntoFrig;

    }
}