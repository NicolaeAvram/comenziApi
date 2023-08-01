<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
   

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {
        $user = User::find($user_id);
        if(!$user){
            return response()->json('User not found', 404);
        }  
        $cart = Cart::where('user_id', '=', $user_id)->first();
        if(!$cart){
            return response()->json('Cart not found', 404);
        }    
        return response()->json($cart, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function adauga(Request $request, string $user_id)
    {
         
        $cart = Cart::where('user_id', '=', $user_id)->first();
        if(!$cart){
          $cart = new Cart();
          $cart->user_id = $user_id;
          $cart->save();
        }
        $cart->products()->attach($request->product_id);
        return response()->json('Produs adaugat cu succes', 200);
    }

   public function sterge(string $user_id, string $id)
   {
    $cart = Cart::find($user_id);
    if(!$cart){
        return response()->json('Not found', 404);
    }
    $cart->products()->detach($id);
    return response()->json('Produs sters cu succes', 200);
   }
   
}
