<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class ChangeEmailController extends Controller
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
        return view('changeemail');
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
            'email' => ['required', Rule::in([$user->email])],
            'new_email' => 'required|string|email|max:255|unique:users,email',
            'email_confirmation' => 'same:new_email',
        ]);
   
        if($user->update(['email' => $request->new_email]))
		{
			return redirect()->route('account');
		}
		return "Wystąpił błąd.";
    }
}
