<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Like;
use App\Models\Report;
use App\Models\Tanaman;
use App\Models\Bookmark;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class TanamanController extends Controller
{
    public function index()
    {
        $tanamen = Tanaman::withCount('like')->paginate(6);
        $kategoris = Kategori::all();

        foreach ($tanamen as $tanaman) {
            $tanaman->created_at_formatted = Carbon::parse($tanaman->created_at)->formatLocalized('%d %B %Y');
        }


        return view('guest/tanaman', [
            "kategoris" => $kategoris,
            "kategori" => "",
            "tanamen" => $tanamen,
            "title" => "tanamanObat"
        ]);
    }

    public function filterKategori(String $kategori)
    {
        $tanamen = Tanaman::withCount('like')->where('kategori', $kategori)->paginate(6);
        $kategoris = Kategori::all();


        return view('guest/tanaman', [

            "kategoris" => $kategoris,
            "kategori" => "kategori",
            "tanamen" => $tanamen,
            "title" => $kategori
        ]);
    }



    public function search(Request $request)

    {
        $kategoris = Kategori::all();

        $query = $request->input('query');
        $tanamen = Tanaman::withCount('like')->where('nama_tanaman', 'LIKE', "%$query%")
            ->orWhere('khasiat', 'LIKE', "%$query%")
            ->orWhere('kategori', 'LIKE', "%$query%")
            ->paginate(6);
        $request->session()->put('search_query', $query);

        return view('guest/tanaman', [
            "kategoris" => $kategoris,
            "kategori" => "",

            "tanamen" => $tanamen,
            "title" => "tanamanObat"
        ]);
    }



    public function post(Tanaman $tanaman)
    {
        $kategoris = Kategori::all();

        $tanaman->created_at_formatted = Carbon::parse($tanaman->created_at)->formatLocalized('%d %B %Y');


        return view('guest/post', compact('tanaman'), [

            "kategoris" => $kategoris,
            "kategori" => "",
            "title" => "detail"
        ]);
    }


    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin/formTambahTanaman', [
            "page" => "Form Tambah Tanaman",
            'kategoris' => $kategoris,

            "title" => "Form"
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
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $request->validate([
            'nama_tanaman' => 'required',
            'latin' => 'required',
            'desk' => 'required',
            'lokasi' => 'required',
            'khasiat' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:2000',
            'gambar.*' => 'mimes:jpg,jpeg,png|max:2000'

        ]);



        $data = $request->all();
        $data['username'] = $user->username;

        if ($request->hasfile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('assets/images', 'public');
        }


        Tanaman::create($data);
        return redirect('/homeAdmin/tanaman')->with('success', 'Tanaman berhasil ditambahkan!');
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
    public function edit(Tanaman $tanaman)
    {
        $kategoris = Kategori::all();

        return view('admin/formEditTanaman', compact('tanaman'), [
            'kategoris' => $kategoris,

            "page" => "Form Edit Tanaman",
            "title" => "FormEdit"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tanaman $tanaman)
    {
        $request->validate([
            'nama_tanaman' => 'required',
            'username' => 'required',
            'latin' => 'required',
            'desk' => 'required',
            'lokasi' => 'required',
            'khasiat' => 'required',

            'kategori' => 'required',
            'gambar' => 'nullable|mimes:jpg,jpeg,png|max:2000',
            'gambar.*' => 'nullable|mimes:jpg,jpeg,png|max:2000'
        ]);





        $data =  Tanaman::findOrFail($tanaman->id);
        $att = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            Storage::disk('local')->delete('public/' . $data->gambar);
            $att['gambar'] =  $request->file('gambar')->store('assets/images', 'public');
        } else {
            $att['gambar'] = $data->gambar;
        }

        // if ($request->file('gambar')) {
        //     Storage::disk('local')->delete('public/' . $data->gambar);
        //     $att['gambar'] =  $request->file('gambar')->store('assets/images', 'public');
        // }
        $data->update($att);

        return redirect('/homeAdmin/tanaman')->with('success', 'Tanaman Berhasil Diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $data = Tanaman::findOrFail($id);
        $bookmark = Bookmark::where('tanaman_id', $id);
        $bookmark->delete();
        $report = Report::where('tanaman_id', $id);
        $report->delete();
        $like = Like::where('tanaman_id', $id);
        $like->delete();


        $data->delete();


        return redirect('/homeAdmin/tanaman')->with('success', 'Tanaman Berhasil Dihapus!');
    }

    // public function updateStatus(Request $request, $id)
    // {
    //     $tanaman = tanaman::findOrFail($id);
    //     $tanaman->status = $request->status;
    //     $tanaman->save();
    //     return redirect("/homeAdmin/tanaman")->with('toast_success', 'status berhasil diupdate');
    // }
}
