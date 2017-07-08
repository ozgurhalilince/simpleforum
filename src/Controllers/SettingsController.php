<?php

namespace Ozgurince\Simpleforum\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use App\Http\Controllers\Controller;
use App\Jobs\UploadPhoto;
use Ozgurince\Simpleforum\Requests\UpdateGeneralRequest;
use Ozgurince\Simpleforum\Requests\UpdateProfilePhotoRequest;
use Ozgurince\Simpleforum\Requests\UpdatePasswordRequest;
use Ozgurince\Simpleforum\Requests\UpdateUsernameRequest;

class SettingsController extends Controller
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

    public function index()
    {
        return view('simpleforum::member_pages.settings');
    }

    public function updateProfilePhoto(UpdateProfilePhotoRequest $request)
    {
        $user = Auth::User();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = $user->id ."-" . uniqid();
            $extension = $file->getClientOriginalExtension();                
            $file->move(public_path().'/uploads/profile-photos/', $name.".".$extension);

            $uploaded_photo_path = '/uploads/profile-photos/' . $name.".".$extension;
            $user->update(['photo_path' => $uploaded_photo_path]);    
        }   

        return back()->with('success', 'Profil fotoğrafınız başarıyla değiştirildi.');
    }

    public function updateGeneral(UpdateGeneralRequest $request)
    {
        $user = Auth::User();

        if (Hash::check($request->input('password'), $user->password)) 
        {
            $user->update($request->except('password'));
            return back()->with('success', 'Güncelleme işleminiz başarıyla tamamlandı.');
        }
        else
            return back()->withErrors(['Şifre Hatalı!']);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::User();

        if (Hash::check($request->old_password, $user->password)) 
        {
            $user->update(['password' => bcrypt($request->password)]);
            return back()->with('success', 'Şifreniz başarıyla değiştirildi.');
        }
        else
            return back()->withErrors(['Şifre Hatalı!']);
    }

    public function updateUsername(UpdateUsernameRequest $request)
    {
        $user = Auth::User();

        if (Hash::check($request->password, $user->password)) 
        {
            $user->update(['username' => $request->username]);
            return back()->with('success', 'Kullanıcı adınız başarıyla değiştirildi.');
        }
        else
            return back()->withErrors(['Şifre Hatalı!']);
    }
}
