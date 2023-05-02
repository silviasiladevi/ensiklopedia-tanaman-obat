<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Validation\Rules\Unique;

class RegisApiController extends Controller
{
    public function index()
    {
        return view('regis', [

            'title' => 'Registrasi',
            'active' => 'Registrasi'
        ]);
    }



    public function store(Request $request)
    {
        $user = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email:dns|unique:users|',
            'nomor_hp' => 'required|unique:users|digits_between:10,13',
            'username' => 'required|min:5|unique:users',
            'password' => 'required|min:4',
            'jabatan' => 'required'
        ]);


        $user['password'] = Hash::make($user['password']);
        User::Create($user);


        return response()->json(['message' => 'Success', 'data' => $user]);
    }
}
