<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Friend;
use Auth;

class PeopleController extends Controller
{
    public function people()
    {

    	return view('people', ['people' => User::where('id', '!=', auth()->id())->get()]);
    }

    public function add_friend(Request $request)
    {


    	if(!$request->id != Auth::user()->id)
    	{
    		$users = Friend::where([
                    ['user_id_1', '=', Auth::user()->id],
                    ['user_id_2', '=', $request->id]
                ])->count();

    		$friendshipExists = Friend::where([
                    ['user_id_1', '=', $request->id],
                    ['user_id_2', '=', Auth::user()->id]
             ])->count();

    		if($users < 1 && $friendshipExists == 0)
    		{
	    		$friend = new Friend;
		    	$friend->user_id_1 = Auth::user()->id;
		    	$friend->user_id_2 = $request->id;
		    	$friend->save();
	    	}
    	}

    	return redirect('people');
    }

    // Отменить заявку

    public function cancel_friend(Request $request)
    {
    	if(!$request->id != Auth::user()->id)
    	{
    		Friend::where([
                    ['user_id_1', '=', Auth::user()->id],
                    ['user_id_2', '=', $request->id]
                ])->delete();
    	}

    	return redirect('people');
    }


    public function confirm_friend(Request $request)
    {
    	if(!$request->id != Auth::user()->id)
    	{
    		$f = Friend::where([
                    ['user_id_1', '=', $request->id],
                    ['user_id_2', '=', Auth::user()->id]
                ])->first();
    		
    		$f->approved = 1;
    		$f->save();
    	}

    	return redirect('people');
    }

    // Удалить друга

    public function delete_friend(Request $request)
    {
    	if(!$request->id != Auth::user()->id)
    	{
    		Friend::where([
                    ['user_id_1', '=', Auth::user()->id],
                    ['user_id_2', '=', $request->id]
                ])->delete();

    		Friend::where([
                    ['user_id_1', '=', $request->id],
                    ['user_id_2', '=', Auth::user()->id]
                ])->delete();
    	}

    	return redirect('people');
    }
}
