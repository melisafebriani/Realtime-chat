<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Image;


class UserController extends Controller
{
    public function edit(){
    	if( Auth::user()) {
    		$user = User::find(Auth::user()->id);

    		if($user) {
    			return view('user.edit')->withUser($user);
    		} else {
    			return redirect()->back();
    		}
    		
    	} else {
    		return redirect()->back();
    	}
    }

    public function update(Request $request) {
        $user = User::find(Auth::user()->id);

        if($user) {

            $validate = $request->validate([
                'name' => 'required|min:2',
                'password' => 'required|password|min:6|max:10'
            ]);

            $user->name = $request->name;
            $user->password = $request->password;

            $user->update();

            return redirect()->route('home');

        } else {
            return redirect()->back();
        }
                
    }


    public function profile()
    {
        $user = Auth::user();
        return view('user.profile',compact('user',$user));
    }


    public function update_avatar(Request $request) {
        $user = Auth::user();
        
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return redirect()->route('home');

        } else {
            return redirect()->back();
        }


    }




}


    

