<?php

namespace App\Http\Controllers\Group;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;
use App\User;
use Auth;

class GroupController extends Controller
{

    public function index($id){
    	$group = Group::findOrFail($id);
    	$status_user = Group::findOrFail($id)->subscribers->where('id', auth::user()->id);

    	return view('group.index', ['group' => $group, 'status_user' => $status_user]);
    }

    public function list(){
    	$groups = Group::all();
    	return view('group.list', ['groups' => $groups]);
    }

    public function subscribe(){
    	if (request('id') && !auth::user()->groups->contains(request('id'))) {
		    auth::user()->groups()->attach(request('id'));
		    return redirect()->back();
		}
    }

    public function unsubscribe(){
    	if (request('id') && auth::user()->groups->contains(request('id'))) {
		    auth::user()->groups()->detach(request('id'));
		    return redirect()->back();
		}
    }
}
