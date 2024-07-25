<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse {
        $users = User::orderBy('name', 'DESC')->get();
        return response()->json($users);
    }

    public function register(Request $request): JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::create([
                'cpf' => $request->cpf,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => "Usuário cadastrado com sucesso."
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => "Usuário não cadastrado.",
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
