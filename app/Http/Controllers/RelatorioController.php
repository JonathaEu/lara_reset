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
            $ano = $request->ano;

            $con_jan = DB::table('consumo')
                ->whereMonth('created_at', 1)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_jan = DB::table('reservas')
                ->whereMonth('reservas.created_at', 1)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_fev = DB::table('consumo')
                ->whereMonth('created_at', 2)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_fev = DB::table('reservas')
                ->whereMonth('reservas.created_at', 2)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_mar = DB::table('consumo')
                ->whereMonth('created_at', 3)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_mar = DB::table('reservas')
                ->whereMonth('reservas.created_at', 3)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_abr = DB::table('consumo')
                ->whereMonth('created_at', 4)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_abr = DB::table('reservas')
                ->whereMonth('reservas.created_at', 4)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_mai = DB::table('consumo')
                ->whereMonth('created_at', 5)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_mai = DB::table('reservas')
                ->whereMonth('reservas.created_at', 5)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_jun = DB::table('consumo')
                ->whereMonth('created_at', 6)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_jun = DB::table('reservas')
                ->whereMonth('reservas.created_at', 6)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_jul = DB::table('consumo')
                ->whereMonth('created_at', 7)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_jul = DB::table('reservas')
                ->whereMonth('reservas.created_at', 7)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_ago = DB::table('consumo')
                ->whereMonth('created_at', 8)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_ago = DB::table('reservas')
                ->whereMonth('reservas.created_at', 8)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_set = DB::table('consumo')
                ->whereMonth('created_at', 9)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_set = DB::table('reservas')
                ->whereMonth('reservas.created_at', 9)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_out = DB::table('consumo')
                ->whereMonth('created_at', 10)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_out = DB::table('reservas')
                ->whereMonth('reservas.created_at', 10)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_nov = DB::table('consumo')
                ->whereMonth('created_at', 11)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_nov = DB::table('reservas')
                ->whereMonth('reservas.created_at', 11)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $con_dez = DB::table('consumo')
                ->whereMonth('created_at', 12)
                ->whereYear('created_at', $ano)
                ->sum('valor_total');

            $qrto_dez = DB::table('reservas')
                ->whereMonth('reservas.created_at', 12)
                ->whereYear('reservas.created_at', $ano)
                ->join('quartos', 'quartos.id', '=', 'reservas.quartos_id')
                ->sum('quartos.valor');

            $juntaMeses = [
                $con_dez + $qrto_dez,
                $con_nov + $qrto_nov,
                $con_out + $qrto_out,
                $con_set + $qrto_set,
                $con_ago + $qrto_ago,
                $con_jul + $qrto_jul,
                $con_jun + $qrto_jun,
                $con_mai + $qrto_mai,
                $con_abr + $qrto_abr,
                $con_mar + $qrto_mar,
                $con_fev + $qrto_fev,
                $con_jan + $qrto_jan
            ];
            $ordemCorretaMeses = array_reverse($juntaMeses);
            return response()->json([
                'success' => true,
                'relatorio' => $ordemCorretaMeses,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => $e->getMessage(),
            ], 500);
        }
    }
}