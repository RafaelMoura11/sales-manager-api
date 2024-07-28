<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\LogoutUserRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse {
        $users = User::orderBy('name', 'DESC')->get();
        return response()->json($users);
    }

    public function register(UserRequest $request): JsonResponse {
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
                'user' => $user,
                'message' => "Usuário cadastrado com sucesso."
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Usuário não cadastrado.",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function update(UpdateUserRequest $request): JsonResponse {
        DB::beginTransaction();
        try {
            $user = User::where('cpf', $request->cpf)->firstOrFail();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
            DB::commit();
            return response()->json([
                'user' => $user,
                'message' => "Usuário atualizado com sucesso."
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => "Usuário não atualizado.",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function delete(DeleteUserRequest $request) : JsonResponse {
        try {
            $user = User::where('cpf', $request->cpf)->firstOrFail();
            $user->delete();
            return response()->json([
                'message' => "Usuário deletado com sucesso."
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                'message' => "Usuário não apagado.",
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function login(LoginUserRequest $request) : JsonResponse {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $request->user()->createToken('api-token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'message' => "Logado :)"
            ]);
        } else {
            return response()->json([
                'message' => "Email e/ou senha incorreto(s)."
            ]);
        }
    }

    public function logout(LogoutUserRequest $request) {
        try {
            $user = User::where('cpf', $request->cpf)->firstOrFail();
            $user->tokens()->delete();
            return response()->json([
                'message' => "Usuário deslogado com sucesso.",
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                'message' => "Usuário não foi deslogado.",
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
