<?php

namespace App\Http\Controllers;

use App\Models\reserva;
use App\Http\Requests\StorereservaRequest;
// use App\Http\Requests\UpdatereservaRequest;
use App\Http\Resources\reservaResource;
use Exception;

class controlaReserva extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return reservaResource::collection(reserva::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservaRequest $request)
    {
        try {
            reserva::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Reserva Realizada Com Sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(reserva $reserva)
    {
        try {
            return new reservaResource($reserva);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(reserva $reserva)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */

    public function Update(StoreReservaRequest $request, reserva $reserva)
    {
        try {
            $reserva->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }


    // public function CheckOut()

    /**
     * Remove the specified resource from storage.
     */
    //     public function destroy(reserva $reserva)
    //     {
    //         //
    //     }
}