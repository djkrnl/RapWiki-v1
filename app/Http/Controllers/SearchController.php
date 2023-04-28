<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Rapper;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
		$query = $request->get('query');
		if(strlen($query) >= 3)
		{
			$rappers = Rapper::where('rapper_name', 'like', '%'.$query.'%')->get();
			$albums = Album::where('album_name', 'like', '%'.$query.'%')->get();
			return view('search', ['query' => $query, 'rappers' => $rappers, 'albums' => $albums]); 
		}
		else return view('nosearch');
    }
}
