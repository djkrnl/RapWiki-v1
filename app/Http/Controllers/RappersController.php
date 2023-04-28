<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapper;
use Illuminate\Support\Facades\Config;
use DB;

class RappersController extends Controller
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
			$rappers = Rapper::where('user_id', \Auth::user()->id)->latest()->get();
			return view('rappers', ['rappers' => $rappers]);
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
			$rapper = new Rapper;
			return view('addrapper', ['rapper' => $rapper]);
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
			'rapper_name' => 'required|max:255',
			'full_name' => 'required|max:255',
			'birth_date' => 'required|date|date_format:Y-m-d|before_or_equal:today',
			'birth_city' => 'nullable',
			'birth_country' => 'required|not_in:AA',
			'death_date' => 'nullable|date|date_format:Y-m-d|before_or_equal:today|after_or_equal:birth_date|required_with:death_city|required_unless:death_country,AA',
			'death_city' => 'nullable',
			'death_country' => 'required',
			'country' => 'required|not_in:AA',
			'occupation' => 'required_without_all',
			'genre' => 'required_without_all',
			'status' => 'required',
			'website' => 'nullable|regex:/^(https?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
			'description' => 'required',
			'picture' => 'mimes:jpg,png|max:1024'
		]);
		if(\Auth::user() == null)
		{
			return view('home');
		}
		$rapper = new Rapper();
		
		$rapper->user_id = \Auth::user()->id;
		$rapper->rapper_name = $request->rapper_name;
		$rapper->full_name = $request->full_name;
		$rapper->birth_date = $request->birth_date;
		$rapper->birth_city = $request->birth_city;
		$rapper->birth_country = DB::table('countries')->where('code', $request->birth_country)->first()->id;
		$rapper->death_date = $request->death_date;
		$rapper->death_city = $request->death_city;
		$rapper->death_country = DB::table('countries')->where('code', $request->death_country)->first()->id;
		$rapper->country = DB::table('countries')->where('code', $request->country)->first()->id;
		
		$occupation = $request->input('occupation');
		$occupation_str = "";
		foreach($occupation as $val)
		{
			$occupation_str .= $val.",";
		}
		$occupation_str = substr($occupation_str, 0, -1);
		$rapper->occupation = $occupation_str;
		
		$genre = $request->input('genre');
		$genre_str = "";
		foreach($genre as $val)
		{
			$genre_str .= $val.",";
		}
		$genre_str = substr($genre_str, 0, -1);
		$rapper->genre = $genre_str;
		
		$rapper->status = $request->status;
		$rapper->website = $request->website;
		$rapper->description = $request->description;
		if($rapper->save())
		{
			if($request->hasFile('picture'))
			{
				$picture = $request->file('picture');
				$path = $picture->storeAs('public/rappers', $rapper->id.'.'.$picture->extension());
			}
			return redirect()->route('rshow', ['id' => $rapper->id]);
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
        if($rapper = Rapper::find($id))
		{
			$occupations = '';
			foreach(Config::get('constants.occupations') as $occ_id => $occ_tr)
			{
				if(str_contains($rapper->occupation, $occ_id))
				{
					$occupations .= $occ_tr.', ';
				}
			}
			$occupations = substr($occupations, 0, -2);
			
			$genres = '';
			foreach(Config::get('constants.genres') as $gen_id => $gen_tr)
			{
				if(str_contains($rapper->genre, $gen_id))
				{
					$genres .= $gen_tr.', ';
				}
			}
			$genres = substr($genres, 0, -2);
			
			return view('showrapper', ['rapper' => $rapper, 'occupations' => $occupations, 'genres' => $genres]);
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
		if($rapper = Rapper::find($id))
		{
			if(\Auth::user() == null)
			{
				return view('guest');
			}
			/*if(\Auth::user()->id != $rapper->user_id)
			{
				return back();
			}*/
			return view('editrapper', ['rapper' => $rapper]);
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
			'rapper_name' => 'required|max:255',
			'full_name' => 'required|max:255',
			'birth_date' => 'required|date|date_format:Y-m-d|before_or_equal:today',
			'birth_city' => 'nullable',
			'birth_country' => 'required|not_in:AA',
			'death_date' => 'nullable|date|date_format:Y-m-d|before_or_equal:today|after_or_equal:birth_date|required_with:death_city|required_unless:death_country,AA',
			'death_city' => 'nullable',
			'death_country' => 'required',
			'country' => 'required|not_in:AA',
			'occupation' => 'required_without_all',
			'genre' => 'required_without_all',
			'status' => 'required',
			'website' => 'nullable|regex:/^(https?:\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
			'description' => 'required',
			'picture' => 'mimes:jpg,png|max:1024'
		]);
        $rapper = Rapper::find($id); 
		if(\Auth::user() == null)
		{
			return view('editrapper');
		}
		/*if(\Auth::user()->id != $rapper->user_id)
		{
			return back();
		}*/
		
		$rapper->rapper_name = $request->rapper_name;
		$rapper->full_name = $request->full_name;
		$rapper->birth_date = $request->birth_date;
		$rapper->birth_city = $request->birth_city;
		$rapper->birth_country = DB::table('countries')->where('code', $request->birth_country)->first()->id;
		$rapper->death_date = $request->death_date;
		$rapper->death_city = $request->death_city;
		$rapper->death_country = DB::table('countries')->where('code', $request->death_country)->first()->id;
		$rapper->country = DB::table('countries')->where('code', $request->country)->first()->id;
		
		$occupation = $request->input('occupation');
		$occupation_str = "";
		foreach($occupation as $val)
		{
			$occupation_str .= $val.",";
		}
		$occupation_str = substr($occupation_str, 0, -1);
		$rapper->occupation = $occupation_str;
		
		$genre = $request->input('genre');
		$genre_str = "";
		foreach($genre as $val)
		{
			$genre_str .= $val.",";
		}
		$genre_str = substr($genre_str, 0, -1);
		$rapper->genre = $genre_str;
		
		$rapper->status = $request->status;
		$rapper->website = $request->website;
		$rapper->description = $request->description;
		
		if($rapper->save())
		{
			$path = storage_path().'/app/public/rappers/'.$rapper->id;
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
					$path = $picture->storeAs('public/rappers', $rapper->id.'.'.$picture->extension());
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
			
			return redirect()->route('rshow', ['id' => $rapper->id]);
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
        $rapper = Rapper::find($id);
		if(\Auth::user()->id != $rapper->user_id)
		{
			return back();
		}
		if($rapper->delete())
		{
			$path = storage_path().'/app/public/rappers/'.$id;
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
