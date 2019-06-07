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

    public function createGroup(){
    	return view('group.create');
    }

    public function store(Request $request){
    	
    	$createdGroup = Group::create(['name' => request('name'),
    		'description' => request('description'),
    		'user_id' => auth::user()->id,
    	]);

    	if (!$createdGroup->subscribers->contains(auth::user()->id)) {
		    $createdGroup->subscribers()->attach(auth::user()->id);
		    return redirect(route('group.myGroupsAdmin'));
		}

    	return redirect(route('group.myGroupsAdmin'));
    }

    public function myGroupsAdmin(){
    	$groups = Group::where('user_id', auth::user()->id)->get();
    	return view('group.myGroupsAdmin', ['groups' => $groups]);
    }

    public function myGroups(){
    	$groups = auth::user()->groups()->get();
    	return view('group.myGroups', ['groups' => $groups]);
    }
}
