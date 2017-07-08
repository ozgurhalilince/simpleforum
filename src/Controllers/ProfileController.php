<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\User;

class ProfileController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile_with_id($id)
    {
    	$user = User::findOrFail($id);

        if (!$user) abort(404); 

    	if ($user->username != "")     // if user have username
    		return redirect(route('profile_with_username', ['username' => $user->username]));

        $collection["user"] = $user;
                
        if (Auth::user()->id == $user->id) {    // profile of auth user
		    $collection["own"] = true;

            return view('simpleforum::member_pages.profile', compact('collection'));
    	}

        // profile of someone else
        return view('simpleforum::member_pages.profile', compact('collection'));
    }

    public function profile_with_username($username)
    {
    	$user = User::username($username)->first();
        
    	if (!$user) abort(404);    	

		$collection["user"] = $user;
    	
    	if (Auth::user()->id == $user->id) {   // profile of auth user
            $collection["own"] = true; 
            return view('simpleforum::member_pages.profile', compact('collection'));
    	}
    	
        // profile of someone else
            return view('simpleforum::member_pages.profile', compact('collection'));
    }
}
