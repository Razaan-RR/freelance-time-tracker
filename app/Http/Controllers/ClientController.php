<?php

// app/Http/Controllers/ClientController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller{
    public function add(Request $request){
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'contact' => 'required',
    ]);

    $user_id = session('user_id');

    if (!$user_id) {
        return redirect('/loginPage');
    }

    Client::create([
        'user_id' => $user_id,
        'name' => $request->name,
        'email' => $request->email,
        'contact' => $request->contact,
    ]);

    $clients = Client::where('user_id', $user_id)->get();

    return view('dashboard', compact('clients'));
}


    public function list()
    {
        $user_id = session('user_id');

        $clients = \App\Models\Client::where('user_id', $user_id)->get();

        return view('dashboard', compact('clients'));
    }
}
