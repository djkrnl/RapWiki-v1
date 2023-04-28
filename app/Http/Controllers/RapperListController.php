<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapper;
use Illuminate\Support\Facades\Config;
use DB;

class RapperListController extends Controller
{
    public function index()
    {
		return view('rapperlist');
    }
	
	public function show($name)
    {
		$genres = Config::get('constants.genres');
		if(array_key_exists($name, $genres))
		{
			$rappers = Rapper::where('genre', 'like', '%'.$name.'%')->orderBy('rapper_name')->get();
			return view('rappergenre', ['name' => $genres[$name], 'rappers' => $rappers]);
		}
		return view('errors.404');
    }
}
