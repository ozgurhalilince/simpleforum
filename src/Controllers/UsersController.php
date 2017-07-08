<?php

namespace Ozgurince\Simpleforum\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ozgurince\Simpleforum\Models\User;
use Ozgurince\Simpleforum\Models\Role;
use Ozgurince\Simpleforum\Requests\StoreUserRequest;
use Ozgurince\Simpleforum\Requests\UpdateUserRequest;


class UsersController extends Controller
{   

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $users = User::where('name', 'LIKE', "%$keyword%")				
                ->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }
        
        return view('simpleforum::users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('simpleforum::users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreUserRequest $request)
    {
        $requestData = $request->except('password');
        $requestData["password"] =  bcrypt($request->input('password'));
        $requestData["photo_path"] =  asset('vendor/simpleforum/img/user-avatar.png');
        $requestData["api_token"] =  str_random(60);
        $requestData["remember_token"] =  uniqid();
        $requestData["phone_number"] =  0;
        $requestData["is_active"] =  1;

        User::create($requestData);

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla eklendi!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('simpleforum::users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateUserRequest $request)
    {
        $requestData = $request->except('password');
        if($request->input("password") != null)
            $requestData["password"] =  bcrypt($request->input('password'));
        
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla güncellendi!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)    //used for banning
    {
        $user = User::findOrFail($id);
        if ($user->isBanned())  {
            $user->update(['role_id' => Role::name('member')->first()->id]);
            return redirect()->route('users.index')->with('success', 'Kullanıcının engeli başarıyla kaldırıldı!');
        }

        $user->update(['role_id' => Role::name('banned')->first()->id]);
        return redirect()->route('users.index')->with('success', 'Kullanıcı başarıyla engellendi!');
    }
}
