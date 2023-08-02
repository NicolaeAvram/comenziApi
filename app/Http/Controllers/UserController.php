<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(CreateUserRequest $request)
    {
        $user = User::create($request->validated());       
        return response()->json($user, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json('Not found', 404);
        }
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateUserRequest $request, string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json('Not found', 404);
        }
        $user-> update($request->validated());
        return response()->json($user, 200);
    }
    //trebuie sa afisez erorile in json response

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json('Not found', 404);
        }
        $user->delete();
        return response()->json('', 204);
    }

    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        $user->makeVisible('password');
        if(!$user){
            return response()->json('Not found', 404);
        }
        if(!Hash::check($request->password, $user->password)){
            return response()->json('Not found password', 404);
        }
        $token = $user->createToken('token_de_autentificare');
  
        return response()->json(['token'=>$token->plainTextToken], 200);
    }

    public function logout(string $id){
        $user = User::find($id);
       
        $user->tokens()->delete();
        return response()->json('Sesiunea s-a incheiat', 200);
    }
}
