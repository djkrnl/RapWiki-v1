<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Rapper;
use App\Models\AlbumTrack;
use Illuminate\Support\Facades\Config;
use DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		if(\Auth::user() == null)
		{
			return view('guest');
		}
		else
		{
			$albums = Album::where('user_id', \Auth::user()->id)->latest()->get();
			return view('albums', ['albums' => $albums]);
		} 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(\Auth::user() == null)
		{
			return view('guest');
		}
		else
		{
			$album = new Album;
			return view('addalbum', ['album' => $album]);
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'album_name' => 'required|max:1000',
			"rapper" => "required|array",
			"rapper.*" => "required|integer|distinct",
			'release_date' => 'required|date|date_format:Y-m-d|before_or_equal:today',
			'type' => 'required',
			'genre' => 'required_without_all',
			"track_nr" => "required|array",
			"track_nr.*" => "required|integer",
			"track_name" => "required|array",
			"track_name.*" => "required|max:1000",
			"track_length" => "required|array",
			"track_length.*" => "required|regex:/^(\d)*?\d:[0-5]\d$/",
			'label' => 'required|max:255',
			'studio' => 'max:255',
			'description' => 'required',
			'picture' => 'mimes:jpg,png|max:1024'
		]);
		if(\Auth::user() == null)
		{
			return view('home');
		}
		$album = new Album;
		
		$album->user_id = \Auth::user()->id;
		$album->album_name = $request->album_name;
		$album->release_date = $request->release_date;
		$album->type = $request->type;
		
		$genre = $request->input('genre');
		$genre_str = "";
		foreach($genre as $val)
		{
			$genre_str .= $val.",";
		}
		$genre_str = substr($genre_str, 0, -1);
		$album->genre = $genre_str;
		
		$album->label = $request->label;
		$album->studio = $request->studio;
		$album->description = $request->description;
		
		if($album->save())
		{
			foreach($request->rapper as $id)
			{
				$rapper = Rapper::find($id);
				$rapper->album()->attach($album->id);
			}
			
			for($i = 0; $i < count($request->track_nr); $i++)
			{
				$albumtrack = new AlbumTrack;
				$albumtrack->track_nr = $request->track_nr[$i];
				$albumtrack->track_name = $request->track_name[$i];
				$albumtrack->track_length = $request->track_length[$i];
				$album->track()->save($albumtrack);
			}
			
			if($request->hasFile('picture'))
			{
				$picture = $request->file('picture');
				$path = $picture->storeAs('public/albums', $album->id.'.'.$picture->extension());
			}
			
			return redirect()->route('ashow', ['id' => $album->id]);
		}
		return "Wystąpił błąd.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($album = Album::find($id))
		{
			$artists = "";
			foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
			{
				$rapper = Rapper::find($r_id);
				$artists .= $rapper->rapper_name.', ';
			}
			$artists = substr($artists, 0, -2);
			
			$genres = '';
			foreach(Config::get('constants.genres') as $gen_id => $gen_tr)
			{
				if(str_contains($album->genre, $gen_id))
				{
					$genres .= $gen_tr.', ';
				}
			}
			$genres = substr($genres, 0, -2);
			
			$minutes = 0;
			$seconds = 0;
			foreach($album->track as $track)
			{
				$length = explode(":", $track->track_length);
				$minutes += $length[0];
				$seconds += $length[1];
			}
			$minutes += floor($seconds / 60);
			$seconds -= (floor($seconds / 60) * 60);
			if(strlen($seconds) == 1) $seconds = '0'.$seconds;
			$time = $minutes.":".$seconds;
			
			return view('showalbum', ['album' => $album, 'artists' => $artists, 'genres' => $genres, 'time' => $time]);
		}
		return view('errors.404');
		
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if($album = Album::find($id))
		{
			if(\Auth::user() == null)
			{
				return view('guest');
			}
			/*if(\Auth::user()->id != $album->user_id)
			{
				return back();
			}*/
			return view('editalbum', ['album' => $album]);	
		}
		else return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'album_name' => 'required|max:1000',
			"rapper" => "required|array",
			"rapper.*" => "required|integer|distinct",
			'release_date' => 'required|date|date_format:Y-m-d|before_or_equal:today',
			'type' => 'required',
			'genre' => 'required_without_all',
			"track_nr" => "required|array",
			"track_nr.*" => "required|integer",
			"track_name" => "required|array",
			"track_name.*" => "required|max:1000",
			"track_length" => "required|array",
			"track_length.*" => "required|regex:/^(\d)*?\d:[0-5]\d$/",
			'label' => 'required|max:255',
			'studio' => 'max:255',
			'description' => 'required',
			'picture' => 'mimes:jpg,png|max:1024'
		]);
		$album = Album::find($id);
		if(\Auth::user() == null)
		{
			return view('editalbum');
		}
		/*if(\Auth::user()->id != $album->user_id)
		{
			return back();
		}*/
		
		$album->album_name = $request->album_name;
		$album->release_date = $request->release_date;
		$album->type = $request->type;
		
		$genre = $request->input('genre');
		$genre_str = "";
		foreach($genre as $val)
		{
			$genre_str .= $val.",";
		}
		$genre_str = substr($genre_str, 0, -1);
		$album->genre = $genre_str;
		
		$album->label = $request->label;
		$album->studio = $request->studio;
		$album->description = $request->description;
		
		if($album->save())
		{
			$album->rapper()->detach();
			$album->track()->delete();
			
			foreach($request->rapper as $id)
			{
				$rapper = Rapper::find($id);
				$rapper->album()->attach($album->id);
			}
			
			for($i = 0; $i < count($request->track_nr); $i++)
			{
				$albumtrack = new AlbumTrack;
				$albumtrack->track_nr = $request->track_nr[$i];
				$albumtrack->track_name = $request->track_name[$i];
				$albumtrack->track_length = $request->track_length[$i];
				$album->track()->save($albumtrack);
			}
			
			$path = storage_path().'/app/public/albums/'.$album->id;
			$path_jpg = $path.'.jpg';
			$path_png = $path.'.png';
			if($request->pic_choice == "pic_edit")
			{
				if($request->hasFile('picture'))
				{
					if(file_exists($path_jpg))
					{
						unlink($path_jpg);
					}
					if(file_exists($path_png))
					{
						unlink($path_png);
					}
					$picture = $request->file('picture');
					$path = $picture->storeAs('public/albums', $album->id.'.'.$picture->extension());
				}
			}
			if($request->pic_choice == "pic_delete")
			{
				if(file_exists($path_jpg))
				{
					unlink($path_jpg);
				}
				if(file_exists($path_png))
				{
					unlink($path_png);
				}
			}
			
			return redirect()->route('ashow', ['id' => $album->id]);
		}
		return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
		if(\Auth::user()->id != $album->user_id)
		{
			return back();
		}
		if($album->delete())
		{
			$path = storage_path().'/app/public/albums/'.$id;
			$path_jpg = $path.'.jpg';
			$path_png = $path.'.png';
			if(file_exists($path_jpg))
			{
				unlink($path_jpg);
			}
			if(file_exists($path_png))
			{
				unlink($path_png);
			}
			return redirect()->route('account');
		}
		else return back();
    }
}
