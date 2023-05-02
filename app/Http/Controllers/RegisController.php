<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Validation\Rules\Unique;

class RegisController extends Controller
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
        $data = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email:dns|unique:users|',
            'nomor_hp' => 'required|unique:users|digits_between:10,13',
            'username' => 'required|min:5|unique:users',
            'password' => 'required|min:4'
        ]);


        $data['password'] = Hash::make($data['password']);
        User::Create($data);
        return redirect('/login')->with('success', 'Registration successfull!, Please Login');
    }
}
