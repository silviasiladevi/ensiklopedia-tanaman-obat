<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\About;
use App\Models\Report;
use App\Models\Tanaman;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kelolaTanaman()
    {
        // $menus = DB::table('menus')->get();
        $tanaman = Tanaman::all();

        return view('admin/kelolaTanaman', [
            'tanamen' => $tanaman,
            "title" => "tanaman",
            "page" => "Kelola Tanaman"
        ]);
    }

    public function kelolauser()
    {
        // $menus = DB::table('menus')->get();
        $users = User::all();

        return view('admin/kelolaUser', [
            'users' => $users,
            "title" => "user",
            "page" => "Kelola User"
        ]);
    }

    public function kelolaReport()
    {
        // $menus = DB::table('menus')->get();

        $reports = Report::select('tanaman_id')->distinct()->get();;
        $reportDetails = Report::all();

        foreach ($reportDetails as $reportDetail) {
            $reportDetail->created_at_formatted = Carbon::parse($reportDetail->created_at)->formatLocalized('%d %B %Y');
        }



        return view('admin/kelolaReport', [
            'reports' => $reports,
            'reportDetail' => $reportDetails,
            "title" => "report",
            "page" => "Kelola Laporan User"
        ]);
    }

    public function kelolaKategori()
    {
        // $menus = DB::table('menus')->get();

        $kategoris = Kategori::withCount('tanaman')->get();


        foreach ($kategoris as $kategori) {
            $kategori->created_at_formatted = Carbon::parse($kategori->created_at)->formatLocalized('%d %B %Y');
        }

        return view('admin/kelolaKategori', [
            'kategoris' => $kategoris,

            "title" => "kategori",
            "page" => "Kelola Kategori"
        ]);
    }

    public function kelolaAbout()
    {
        $about = About::find(1);
        return view('admin/kelolaAbout', compact('about'), [
            'about' => $about,
            "page" => "Form Edit About",
            "title" => "Kelola About"
        ]);
    }

    public function kelolaAkunAdmin()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $admin = User::where('username', $user->username)->firstOrFail();
        return view('admin/kelolaAkun', [
            'admin' => $admin,
            "page" => "Form Kelola Akun",
            "title" => "Kelola Akun"
        ]);
    }

    public function updateAkunAdmin(Request $request)
    {
        $request->validate([
            'nomor_hp' => 'required',
            'email' => 'required|email:dns',
            'fullname' => 'required',


        ]);

        $att = $request->all();

        $data =  User::where('username', 'superadmin')->firstOrFail();


        $data->update($att);
        return redirect('/homeAdmin/akun')->with('success', 'Berhasil Diedit!');
    }


    public function indexhome()
    {
        // $menus = DB::table('menus')->get();
        $tanaman = Tanaman::all();

        return view('admin/homeAdmin', [
            'tanamen' => $tanaman,
            "title" => "dashboard",
            "page" => "Dashboard"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = Tanaman::all();
        return view('admin/create', [
            'menus' => $menu,
            "title" => "Tambah Data"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
