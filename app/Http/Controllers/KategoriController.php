<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Bookmark;
use App\Models\like;
use App\Models\Report;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Alert;



class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required|max:255|unique:kategoris',

        ]);


        Kategori::Create($data);
        return redirect('/homeAdmin/kategori')->with('success', 'Kategori telah dibuat');
    }

    public function destroy(String $kategori)
    {


        $tanaman = Tanaman::where('kategori', $kategori)->exists();
        if ($tanaman) {

            return redirect()->back()->with('errors', 'Tidak bisa menghapus kategori karena masih terdapat tanaman yang terkait.');
        }


        Kategori::where('kategori', $kategori)->delete();
        return redirect('/homeAdmin/kategori')->with('success', 'Kategori telah dihapus');
    }

    // public function destroy(String $kategori)
    // {
    //     Bookmark::whereIn('tanaman_id', function ($query) use ($kategori) {
    //         $query->select('id')->from('tanamen')->where('kategori', $kategori);
    //     })->delete();

    //     Report::whereIn('tanaman_id', function ($query) use ($kategori) {
    //         $query->select('id')->from('tanamen')->where('kategori', $kategori);
    //     })->delete();

    //     Like::whereIn('tanaman_id', function ($query) use ($kategori) {
    //         $query->select('id')->from('tanamen')->where('kategori', $kategori);
    //     })->delete();


    //     Tanaman::where('kategori', $kategori)->delete();


    //     Kategori::where('kategori', $kategori)->delete();
    //     return redirect('/homeAdmin/kategori')->with('success', 'Kategori telah dihapus');
    // }
}
