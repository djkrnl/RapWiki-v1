<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapper;
use App\Models\Album;
use Illuminate\Support\Facades\File;
use DB;

class WelcomeController extends Controller
{
    public function index()
    {
		$random = rand(0, 1);
		if($random == 0) $article = Rapper::inRandomOrder()->first();
		else $article = Album::inRandomOrder()->first();
		
		$rappers = Rapper::latest()->take(5)->get();
		$albums = Album::latest()->take(5)->get();
		
		$files = File::files(storage_path('app/public/videos'));
		$videocount = count($files);
		
        return view('welcome', ['article' => $article, 'rappers' => $rappers, 'albums' => $albums, 'videocount' => $videocount]);
    }
}
