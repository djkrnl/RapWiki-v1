<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Config;
use DB;

class AlbumListController extends Controller
{
    public function index()
    {
		return view('albumlist');
    }
	
	public function show($name)
    {
		$genres = Config::get('constants.genres');
		if(array_key_exists($name, $genres))
		{
			$albums = Album::where('genre', 'like', '%'.$name.'%')->orderBy('album_name')->get();
			return view('albumgenre', ['name' => $genres[$name], 'albums' => $albums]);
		}
		return view('errors.404');
    }
}
