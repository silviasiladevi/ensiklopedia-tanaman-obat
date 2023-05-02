<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Report;
use App\Models\Tanaman;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TanamanApiController extends Controller
{
    public function index()
    {
        $tanamen = Tanaman::with('user')->withCount('like')->get();
        $totalTanaman = Tanaman::count();

        $response = [

            'total_tanaman' => $totalTanaman,
            'data_tanaman' => $tanamen,
        ];

        return response()->json(['message' => 'Success', 'data' => $response]);
    }



    public function tanamanUser()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tanamanUser = Tanaman::where('username', $user->username)->with('user')->get();;
        $totalTanaman = $tanamanUser->count();
        $response = [
            'total_tanaman' => $totalTanaman,
            'data_tanaman' => $tanamanUser,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
        // $tanamanUser = Tanaman::where('username', Auth::user()->username)->get();
        // return response()->json(['message' => 'Success', 'data' => $tanamanUser]);
    }


    public function show($id)
    {
        $tanaman = Tanaman::find($id);
        return response()->json(['message' => 'Success', 'data' => $tanaman]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_tanaman' => 'required',
        //     'username' => 'required',
        //     'latin' => 'required',
        //     'desk' => 'required',
        //     'lokasi' => 'required',
        //     'khasiat' => 'required',
        //     'status' => 'required',
        //     'kategori' => 'required',
        //     'gambar' => 'required|mimes:jpg,jpeg,png|max:2000',
        //     'gambar.*' => 'mimes:jpg,jpeg,png|max:2000'

        // ]);

        // $data = $request->all();
        // if ($request->hasfile('gambar')) {
        //     $data['gambar'] = $request->file('gambar')->store('assets/images', 'public');
        // }

        $tanaman = Tanaman::create($request->all());
        $response = response()->json([
            'message' => 'Success',
            'data' => $tanaman,
        ], 200);
        $response->header('Status-Code', 200);
        return $response;
    }

    public function storefile(Request $request)
    {
        $request->validate([
            'nama_tanaman' => 'required',
            'username' => 'required',
            'latin' => 'required',
            'desk' => 'required',
            'lokasi' => 'required',
            'khasiat' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:4000',
            'gambar.*' => 'mimes:jpg,jpeg,png|max:4000'

        ]);

        $data = $request->all();
        if ($request->hasfile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('assets/images', 'public');
        }

        $tanaman = Tanaman::create($data);
        $response = response()->json([
            'message' => 'Success',
            'data' => $tanaman,
        ], 200);
        $response->header('Status-Code', 200);
        return $response;
    }


    public function update(Request $request, $id)
    {
        $tanaman = Tanaman::find($id);
        $tanaman->update($request->all());
        return response()->json(['message' => 'Success', 'data' => $tanaman]);
    }


    public function updatefile(Request $request)
    {
        $request->validate([
            'id' => 'required',
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


        $tanaman =  Tanaman::findOrFail($request->id);
        $att = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            Storage::disk('local')->delete('public/' . $tanaman->gambar);
            $att['gambar'] =  $request->file('gambar')->store('assets/images', 'public');
        } else {
            $att['gambar'] = $tanaman->gambar;
        }
        $tanaman->update($att);


        return response()->json(['message' => 'Success', 'data' => $tanaman]);
    }

    public function destroy($id)
    {
        $tanaman = Tanaman::find($id);
        $bookmark = Bookmark::where('tanaman_id', $id);
        $bookmark->delete();
        $report = Report::where('tanaman_id', $id);
        $report->delete();
        $like = Like::where('tanaman_id', $id);
        $like->delete();
        $tanaman->delete();
        return response()->json(['message' => 'Success', 'data' => null]);
    }
}
