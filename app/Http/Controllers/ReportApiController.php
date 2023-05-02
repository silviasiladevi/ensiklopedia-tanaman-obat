<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportApiController extends Controller
{



    public function store(Request $request, $id)

    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        } else {

            $report = new report();
            $report->tanaman_id = $id;
            $report->username = $user->username;
            $report->pesan = $request->pesan;
            $report->save();
            $response = response()->json([
                'message' => 'Success',
                'data' => $report
            ], 200);
            $response->header('Status-Code', 200);
            return $response;
        }
    }
}
