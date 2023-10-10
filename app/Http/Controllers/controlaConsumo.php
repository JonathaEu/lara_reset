<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use App\Http\Requests\StoreconsumoRequest;
use App\Http\Resources\consumoResource;
use App\Models\frigobar_iten;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class controlaConsumo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return consumoResource::collection(consumo::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $itens = $request->itens_id;
            $frigobar = $request->frigobar_id;
            $valor_total = $request->valor_total;
            $reservas_id = $request->reservas_id;
            $quantidade = $request->quantidade;
            $msg = '';

            if (
                consumo::create([
                    'iten_id' => $itens,
                    'frigobar_id' => $frigobar,
                    'reservas_id' => $reservas_id,
                    'quantidade' => $quantidade,
                    'valor_total' => $valor_total
                ])

            ) {
                $itenFrigobar = frigobar_iten::where('frigobar_id', $frigobar)
                    ->where('iten_id', $itens)
                    ->select('quantidade');
                if (!$itenFrigobar->get()->isEmpty() && $itenFrigobar->get()->first()['quantidade'] > 0) {
                    $quantidadeAnterior = $itenFrigobar->get()->first()['quantidade'];
                    $novaQuantidade = $quantidadeAnterior - $quantidade;

                    $itenFrigobar->update([
                        "quantidade" => $novaQuantidade
                    ]);

                    $msg = 'consumo registrado com sucesso';

                } else {
                    $msg = 'Não há itens para serem removidos';
                }
                // return response()->json([
                //     'succes' => true,
                //     'mensagem' => $msg
                // ], 200);
            } else {
                $msg = 'Falha ao registrar consumo';
            }
            // $valor_total = DB::table('consumo')
            // ->where('itens_id',$item)
            // ->where('quartos_id',$quarto)

            return response()->json(["success" => true, "mensagem" => $msg], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "mensagem" => $msg, "error" => $e], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        try {
            $reserva = $request->reservas_id;
            $reserva_consumo = DB::table('consumo')
                ->select(
                    'itens.nome',
                    'consumo.quantidade',
                    'consumo.valor_total',
                    'consumo.created_at',
                )
                ->join('itens', 'itens.id', '=', 'consumo.iten_id')
                ->where('reservas_id', $reserva)
                ->groupBy(
                    'itens.nome',
                    'consumo.quantidade',
                    'consumo.valor_total',
                    'consumo.id',
                    'consumo.created_at',
                )
                ->get()
                ->toArray();

            return response()->json([
                'success' => true,
                'data' => $reserva_consumo,

            ], 200);

        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreconsumoRequest $request, consumo $consumo)
    {
        try {
            $consumo->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    public function mostFrequentlyItem()
    {
        try {
            $item = DB::table('consumo')
                ->pluck('iten_id')
                ->toArray();

            $MFItens = array_count_values($item);
            arsort($MFItens);
            $itens_ids = array_keys($MFItens);
            // $MFI = array_key_first($MFItens);
            $itemMaisFrequentes = DB::table('itens')
                ->select('nome')
                ->whereIn('id', $itens_ids)
                ->get()
                ->toArray();
            $num = count($item);
            $porcentagens = [];
            foreach ($MFItens as $mf) {
                $avgs = $mf / $num * 100;
                $avgs = round($avgs, 2);
                array_push($porcentagens, $avgs);
            }
            // array_push($itemMaisFrequentes, $porcentagens);
            return response()->json([
                'success' => true,
                'ItemMaisFrequente' => $itemMaisFrequentes,
                'porcentagens' => $porcentagens
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'mensagem' => 'erro no servidor',
                'Error' => $e
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(consumo $consumo)
    {
        //
    }
}