<?php

namespace App\Http\Controllers;

use App\Models\consumo;
use DB;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function saidaQuartoItensPorMes(Request $request)
    {
        try {
            $labelMesConsumo = [];
            $labelValorConsumo = [];
            $labelMesQuarto = [];
            $labelValorQuarto = [];
            $consumo_mes = DB::table('consumo')
                ->select(
                    DB::raw("CASE 
                     WHEN MONTH(created_at) = '01' THEN '01'
                     WHEN MONTH(created_at) = '02' THEN '02'
                     WHEN MONTH(created_at) = '03' THEN '03'
                     WHEN MONTH(created_at) = '04' THEN '04'
                     WHEN MONTH(created_at) = '05' THEN '05'
                     WHEN MONTH(created_at) = '06' THEN '06'
                     WHEN MONTH(created_at) = '07' THEN '07'
                     WHEN MONTH(created_at) = '08' THEN '08'
                     WHEN MONTH(created_at) = '09' THEN '09'
                     WHEN MONTH(created_at) = '10' THEN '10'
                     WHEN MONTH(created_at) = '11' THEN '11'
                     ELSE 'Dezembro' END as mes"),
                    DB::raw('SUM(valor_total) as valor'),
                )
                ->whereYear('created_at', '2023')
                ->groupBy('mes')
                ->orderBy('mes', 'asc')
                ->get()
                ->toArray();

            $quarto_mes = DB::table('reservas')
                ->select(
                    DB::raw("CASE 
                        WHEN MONTH(check_in) = 1 THEN '01'
                        WHEN MONTH(check_in) = 2 THEN '02'
                        WHEN MONTH(check_in) = 3 THEN '03'
                        WHEN MONTH(check_in) = 4 THEN '04'
                        WHEN MONTH(check_in) = 5 THEN '05'
                        WHEN MONTH(check_in) = 6 THEN '06'
                        WHEN MONTH(check_in) = 7 THEN '07'
                        WHEN MONTH(check_in) = 8 THEN '08'
                        WHEN MONTH(check_in) = 9 THEN '09'
                        WHEN MONTH(check_in) = 10 THEN '10'
                        WHEN MONTH(check_in) = 11 THEN '11'
                        ELSE 12 END as mes"),
                    DB::raw('SUM(quartos.valor) as valor_total')
                )
                ->whereYear('reservas.created_at', '2023')
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->where('status', 'finalizado')
                ->groupBy('mes')
                ->orderBy('mes', 'asc')
                ->get()
                ->toArray();

            foreach ($consumo_mes as $resultado) {
                array_push($labelMesConsumo, $resultado->mes);
                array_push($labelValorConsumo, number_format($resultado->valor, 2));
            }

            foreach ($quarto_mes as $resultado_quarto) {
                array_push($labelMesQuarto, $resultado_quarto->mes);
                array_push($labelValorQuarto, number_format($resultado_quarto->valor_total, 2));
            }
            return response()->json([
                'success' => true,
                'mesesConsumo' => $labelMesConsumo,
                'valoresConsumo' => $labelValorConsumo,
                'mesesQuarto' => $labelMesQuarto,
                'valoresQuarto' => $labelValorQuarto,
                // 'quarto' => $quarto_mes,
                // 'valores' => $valoresCorrespondentes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => $e->getMessage(),
            ], 500);
        }
    }
}