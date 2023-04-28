<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapper;
use App\Models\Album;
use DB;

class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
	
    public function index()
    {
		$rappers = Rapper::where('user_id', \Auth::user()->id)->latest()->take(5)->get();
		$albums = Album::where('user_id', \Auth::user()->id)->latest()->take(5)->get();
		
		$udate = strtotime(\Auth::user()->created_at);
		$tdate = time();
		$datedays = round((($tdate - $udate) / (60 * 60 * 24)), 2);
		
		$tracks = 0;
		foreach(DB::table('albums')->where('user_id', \Auth::user()->id)->pluck('id') as $a_id)
		{
			$tracks += DB::table('album_tracks')->where('album_id', $a_id)->count();
		}
		
		return view('account', ['rappers' => $rappers, 'albums' => $albums, 'datedays' => $datedays." dni", 'tracks' => $tracks]);
    }
}
