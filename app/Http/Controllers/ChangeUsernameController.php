<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class ChangeUsernameController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('changeusername');
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
		$user = User::find(\Auth::user()->id);
        $request->validate([
            'username' => ['required', Rule::in([$user->name])],
            'new_username' => 'required|alpha_dash|max:255|unique:users,name',
            'username_confirmation' => 'same:new_username',
        ]);
   
        if($user->update(['name' => $request->new_username]))
		{
			return redirect()->route('account');
		}
		return "Wystąpił błąd.";
    }
}
