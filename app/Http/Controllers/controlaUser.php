<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\userResource;
use App\Models\user;
use Exception;
use Illuminate\Http\Request;

class controlaUser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  userResource::collection(user::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public  function store(StoreUserRequest  $request)
    {
        try {
            user::create($request->validated());
            return response()->json(["success" => true, "mensagem" => 'cliente registrado'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public  function show(user  $user)
    {
        try {
            return new userResource($user);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public  function Update(StoreUserRequest  $request, user $user)
    {
        try {
            $user->update($request->validated());
            return response()->json(["success" => true, "mensagem" => 'Registro atualizado com sucesso'], 200);
        } catch (Exception $e) {
            return response()->json(["success" => false, "error" => $e], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        try {
            $user->delete();
            return response()->json("Usuário deletado com sucesso!");
        } catch (Exception $e) {
            return response()->json(["sucess" => false, "mensagem" => "Usuário não encontrado", "error" => $e], 400);
        }
    }
}
