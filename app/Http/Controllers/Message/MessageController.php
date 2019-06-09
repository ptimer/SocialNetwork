<?php

namespace App\Http\Controllers\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Message;
use Auth;
use App\Events\NewMessage;

class MessageController extends Controller
{
	public function myMessages(){
		return view('message.index');
	}

	public function contacts(){

		$contacts = User::all();

		return response()->json($contacts);
	}

	public function getMessagesFor($id){

		$messages = Message::where(function($q) use ($id){
			$q->where('from', auth()->id());
			$q->where('to', $id);
		})->orWhere(function($q) use($id){
			$q->where('from', $id);
			$q->where('to', auth()->id());
		})
		->get();

		return response()->json($messages);
	}

	public function send(Request $request)
	{
		$message = Message::create([
			'from' => auth()->id(),
			'to' => $request->contact_id,
			'text' => $request->text
		]);

		broadcast(new NewMessage($message));

		return response()->json($message);
	}
}
