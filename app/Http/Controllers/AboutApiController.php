<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\About;

class AboutApiController extends Controller
{
    public function index()
    {

        $about = About::where('id', 1)->get();
        $response = [
            'data_about' => $about,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
    }
}
