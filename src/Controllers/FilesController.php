<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\File;

class FilesController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('destroy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id) //used for deleting
    {
        File::destroy($id);

        return back()->with('success', 'Dosya silindi!');
    }
}