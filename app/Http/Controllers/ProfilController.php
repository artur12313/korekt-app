<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function showChangePasswordForm(){
        return view('/changepassword');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Twoje obecne hasło nie pasuje do podanego hasła. Proszę spróbuj ponownie.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Nowe hasło nie może być takie samo, jak aktualne hasło. Wybierz inne hasło.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Hasło zostało zmienione pomyślnie!");
    }
    
    /*

    public function changeEmail(Request $request)
    {
        //if(Auth::user()->email = )
    }
    
    */
    public function profile()
    {
        $user = Auth::user();
        return view('profil',compact('user',$user));
    }

    public function update_avatar(Request $request){

        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();

        $request->avatar->storeAs('avatars',$avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return view('profil')->with('success','Pomyślnie wysłano zdjęcie.', ['user' => $user]);

    }
} 
