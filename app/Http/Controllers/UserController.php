<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Image;

class UserController extends Controller
{

	public function upload_avatar(Request $request)
	{
		if($request->hasFile('avatar')){
			$user = Auth::user();

			if($user->avatar !== 'default.png') {
			  	\Storage::disk('avatars')->delete($user->avatar);
			}

			$avatar = $request->file('avatar');
			$filename = time() . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/'. $filename));
			$user->avatar = $filename;
			$user->save();
		}

		return view('profile', ['user' => Auth::user()]);
	}

	public function profile(Request $request)
	{

		$posts = User::find($request->id)->posts;

		if(Auth::check() && $request->id == Auth::user()->id)
		{
			return view('profile', ['user' => Auth::user(), 'posts' => $posts, 'user_id' => $request->id]);
		}else{
			return view('profile', ['user' => User::find($request->id) , 'posts' => $posts, 'user_id' => $request->id]);
		}
	}

	public function my_friends()
	{
		return view('friends');
	}


	public function subscribers()
	{
		return view('subscribers');
	}

}