<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Like;
use App\Models\Tanaman;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class LikeApiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $likes = Like::where('username', $user->username)->get();

        $tanaman = [];

        foreach ($likes as $like) {
            $tanaman[] = $like->tanaman;
        }
        $totalLike = $likes->count();
        $response = [
            'total_like' => $totalLike,
            'data_tanaman' => $tanaman,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
    }


    public function favorite()
    {


        $tanamen = Tanaman::with('user')->withCount('like')
            ->orderByDesc('like_count')
            ->get();


        $response = [

            'data_tanaman' => $tanamen,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
    }


    public function favoriteWeek()
    {


        $weekAgo = Carbon::now()->subWeek();

        // mengambil 3 data tanaman dengan like terbanyak dalam 1 minggu terakhir
        $tanamen = Tanaman::with('user')->withCount(['like' => function ($query) use ($weekAgo) {
            $query->where('created_at', '>=', $weekAgo);
        }])
            ->orderByDesc('like_count')
            ->limit(3)
            ->get();

        $response = [

            'data_tanaman' => $tanamen,
        ];
        return response()->json(['message' => 'Success', 'data' => $response]);
    }


    public function store(Request $request)
    {
        $bookmark = new Like();


        if (Like::where('tanaman_id', '=', $request->tanaman_id)->where('username', '=', $request->username)->exists()) {
            $like = Like::where('tanaman_id', '=', $request->tanaman_id)->where('username', '=', $request->username)->get();
            $response = response()->json([
                'message' => 'Like sudah ada',
                'data' => $like,
            ], 200);
            $response->header('Status-Code', 200);
            return $response;
        } else {
            $like = new Like();
            $like->tanaman_id = $request->tanaman_id;
            $like->username = $request->username;
            $like->save();
            $response = response()->json([
                'message' => 'Success',
                'data' => $like,
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
        $like = Like::where('tanaman_id', '=', $id)->where('username', '=', $user->username);
        $like->delete();
        return response()->json(['message' => 'Success', 'data' => null]);
    }

    public function show($id)
    {
        $tanaman = Tanaman::find($id);
        return response()->json(['message' => 'Success', 'data' => $tanaman]);
    }

    public function checkLike(Request $request)
    {
        $username = $request->username;
        $tanamanId = $request->tanaman_id;

        $like = Like::where('username', $username)
            ->where('tanaman_id', $tanamanId)
            ->first();

        if ($like) {
            return response()->json(['is_liked' => true,]);
        } else {
            return response()->json(['is_liked' => false]);
        }
    }
}
