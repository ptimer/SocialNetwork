<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PeopleController extends Controller
{
    public function people()
    {
    	return view('people', ['people' => User::all()]);
    }
}
