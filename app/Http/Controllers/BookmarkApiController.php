<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class BookmarkApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $bookmarks = Bookmark::where('username', $user->username)->get();

        $tanaman = [];

        foreach ($bookmarks as $bookmark) {
            $tanaman[] = [
                'id' => $bookmark->tanaman->id,
                'latin' => $bookmark->tanaman->latin,
                'username' => $bookmark->tanaman->username,
                'fullname' => $bookmark->tanaman->user->fullname,
                'nama_tanaman' => $bookmark->tanaman->nama_tanaman,
                'khasiat' => $bookmark->tanaman->khasiat,
                'gambar' => $bookmark->tanaman->gambar,
                'kategori' => $bookmark->tanaman->kategori,
                'desk' => $bookmark->tanaman->desk,
                'created_at' => $bookmark->tanaman->created_at,
                'like_count' => $bookmark->tanaman->like()->where('tanaman_id', $bookmark->tanaman->id)->count(),
                'isBookmarked' => true,
            ];
        }


        $totalBookmark = $bookmarks->count();
        $response = [

            'total_bookmark' => $totalBookmark,
            'data_tanaman' => $tanaman,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
    }


    public function store(Request $request)
    {
        $bookmark = new Bookmark();


        if (Bookmark::where('tanaman_id', '=', $request->tanaman_id)->where('username', '=', $request->username)->exists()) {
            $bookmark = Bookmark::where('tanaman_id', '=', $request->tanaman_id)->where('username', '=', $request->username)->get();
            $response = response()->json([
                'message' => 'Bookmark sudah ada',
                'data' => $bookmark,
            ], 200);
            $response->header('Status-Code', 200);
            return $response;
        } else {
            $bookmark = new Bookmark();
            $bookmark->tanaman_id = $request->tanaman_id;
            $bookmark->username = $request->username;
            $bookmark->save();
            $response = response()->json([
                'message' => 'Success',
                'data' => $bookmark,
            ], 200);
            $response->header('Status-Code', 200);
            return $response;
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $bookmark = Bookmark::where('tanaman_id', '=', $id)->where('username', '=', $user->username);
        $bookmark->delete();
        return response()->json(['message' => 'Success', 'data' => null]);
    }

    public function show($id)
    {
        $tanaman = Tanaman::find($id);
        return response()->json(['message' => 'Success', 'data' => $tanaman]);
    }

    public function checkBookmark(Request $request)
    {
        $username = $request->username;
        $tanamanId = $request->tanaman_id;

        $bookmark = Bookmark::where('username', $username)
            ->where('tanaman_id', $tanamanId)
            ->first();

        if ($bookmark) {
            return response()->json(['is_bookmarked' => true,]);
        } else {
            return response()->json(['is_bookmarked' => false]);
        }
    }
}
