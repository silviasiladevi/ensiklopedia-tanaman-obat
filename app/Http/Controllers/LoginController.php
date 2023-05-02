<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login', [

            'title' => 'Login',
            'active' => 'Login'
        ]);
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);
        $remember = $request->filled('remember');
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/homeAdmin')->with('success', 'Login Berhasil  !');;
        }

        return back()->with('error', 'Login Failed  !');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    protected function LoginApi(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt($request->only('username', 'password'))) {
            /** @var \App\Models\User $user **/
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;
            $users = array_merge($user->toArray(), ['token' => $token]);
            return response()->json([
                'data' => $users,
            ], 200);
        }

        return response()->json([
            'message' => 'invalid credential'
        ], 400);
    }
}
