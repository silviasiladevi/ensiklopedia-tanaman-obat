<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function index()
    {

        $reports = Report::all();

        return view('admin/kelolaReport',  [
            "reports" => $reports,
            "page" => "lihat report",

            "title" => "report"
        ]);
    }

    public function destroy($id)
    {


        $reports = Report::findOrFail($id);

        $reports->delete();


        return redirect('/homeAdmin/report')->with('success', 'Report Berhasil Dihapus!');
    }
}
