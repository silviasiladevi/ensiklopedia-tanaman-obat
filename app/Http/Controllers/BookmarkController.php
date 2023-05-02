<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

use Illuminate\Support\Facades\DB;

class BookmarkController extends Controller
{

    public function index()
    {

        $bookmarks = Bookmark::select('tanaman_id', DB::raw('COUNT(*) as total'))
            ->groupBy('tanaman_id')
            ->get();

        return view('admin/kelolaBookmark',  [
            "bookmarks" => $bookmarks,
            "page" => "Kelola Bookmark",

            "title" => "bookmark"
        ]);
    }
}
