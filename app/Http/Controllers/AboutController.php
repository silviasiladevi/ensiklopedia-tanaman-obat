<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{


    public function index()
    {
        $kategoris = Kategori::all();
        $about = About::where('id', 1)->get();
        return view('guest/about', [
            "kategoris" => $kategoris,
            "about" => $about,
            "kategori" => "",

            "title" => "about"
        ]);
    }

    public function edit(About $about)
    {
        $about = About::find(1);
        return view('admin/kelolaAbout', compact('about'), [
            'about' => $about,
            "page" => "Form Edit About",
            "title" => "Kelola About"
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|digits_between:10,13',
            'email' => 'required|email:dns',
            'instagram' => 'required',
            'facebook' => 'required',
            'info_aplikasi' => 'required',
            'tentang' => 'required',
            'gambar' => 'nullable|mimes:jpg,jpeg,png|max:2000',
            'gambar.*' => 'nullable|mimes:jpg,jpeg,png|max:2000'

        ]);
        $att = $request->except('gambar');
        $data =  About::findOrFail(1);

        if ($request->hasFile('gambar')) {
            Storage::disk('local')->delete('public/' . $data->gambar);
            $att['gambar'] =  $request->file('gambar')->store('assets/images', 'public');
        } else {
            $att['gambar'] = $data->gambar;
        }

        $data->update($att);
        return redirect('/homeAdmin/about')->with('success', 'Berhasil Diedit!');
    }
}
