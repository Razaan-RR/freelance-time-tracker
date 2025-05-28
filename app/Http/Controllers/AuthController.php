<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register_user(Request $r){
        $user = new User();
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = Hash::make($r->password);
        $user->save();
        $user_token = $user->createToken('apptoken')->plainTextToken;
        return response()->json(['token' => $user_token], 201);
    }

    public function login_user(Request $r){
    $user = User::where('email', $r->email)->first();
    if (!$user || !Hash::check($r->password, $user->password)) {
        return response()->json(['error' => 'invalid'], 401);
    }

    session([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_email' => $user->email,
    ]);

    return redirect('/dashboard');
}

    public function dashboard(){
    $user_id = session('user_id');
    $clients = \App\Models\Client::where('user_id', $user_id)->with('projects')->get();

    return view('dashboard', [
        'clients' => $clients,
    ]);
}


}
