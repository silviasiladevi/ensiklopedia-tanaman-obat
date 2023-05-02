<?php

namespace App\Http\Controllers;

use App\Models\Kategori;

use Illuminate\Http\Request;

class KategoriApiController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();


        $response = [


            'data_kategori' => $kategori,
        ];

        return response()->json(['message' => 'Success', 'data' => $response]);
    }
}
