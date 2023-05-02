<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AkunApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $User = User::where('username', $user->username)->get();;

        $response = [
            'data_user' => $user,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
        // $tanamanUser = Tanaman::where('username', Auth::user()->username)->get();
        // return response()->json(['message' => 'Success', 'data' => $tanamanUser]);
    }


    public function update(Request $request, String $username)
    {
        $request->validate([
            'fullname' => 'required',
            'nomor_hp' => 'required',
            'email' => 'required',
        ]);



        $user =  User::findOrFail($username);
        $att = $request->all();


        $user->update($att);



        return response()->json(['message' => 'Success', 'data' => $user]);
    }
}
