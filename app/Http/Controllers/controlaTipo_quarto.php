<?php

namespace App\Http\Controllers;

use App\Http\Resources\tipo_quartoResource;
use App\Models\tipo_quarto;
use Illuminate\Http\Request;

class controlaTipo_quarto extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return tipo_quartoResource::collection(tipo_quarto::all());
    }

    //     /**
    //      * Store a newly created resource in storage.
    //      */
    //     public function store(Request $request)
    //     {
    //         //
    //     }

    //     /**
    //      * Display the specified resource.
    //      */
    //     public function show(tipo_quarto $tipo_quarto)
    //     {
    //         //
    //     }

    //     /**
    //      * Update the specified resource in storage.
    //      */
    //     public function update(Request $request, tipo_quarto $tipo_quarto)
    //     {
    //         //
    //     }

    //     /**
    //      * Remove the specified resource from storage.
    //      */
    //     public function destroy(tipo_quarto $tipo_quarto)
    //     {
    //         //
    //     }
}
