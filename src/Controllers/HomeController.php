<?php

namespace Ozgurince\Simpleforum\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Auth;

class HomeController extends Controller
{
    public function index()
    {    	
    	return view('simpleforum::homepage');
    }
}
