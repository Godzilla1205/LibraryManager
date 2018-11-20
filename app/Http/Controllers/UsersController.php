<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
	public function getManagerUsers() {
		$stt = 0;
		$users = User::all()->toArray();
		return view('layout.managerUsers',compact('users','stt'));
	}

	public function getUser() {
		$user = Auth::user();
		return view('layout.User',compact('user'));
	}

	public function Show($id) { 
		$user = User::find($id);
		return compact('user');
	}

	public function getManagerUsers_Delete($id) { 
		$user = User::find($id);
		$user->delete();
		return back();
	}
	

	public function getManagerUsers_Add() {
		return view('event.managerUser_Add');
	}

	public function postManagerUsers_Add(Request $request) {

		$user = $this->validate(request(), [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'level' => 'required|numeric',
			'username' => 'required|max:50|unique:users',
			'password' => 'required|string|min:6|confirmed'
		]
		,[
			'required' => ':attribute không được để trống',
			'email' => ':attribute không đúng email',
			'numeric' => ':attribute phải là số',
			'max' => ':attribute số ký tự không được lớn hơn :max',
			'unique' => ':attribute đã tồn tại',
			'min' => ':attribute không được nhỏ hơn :min',
			'confirmed' => 'Confirm :attribute không đúng'
		],
		[
			'name' => 'Name',
			'email' => 'Email',
			'level' => 'Level',
			'username' => 'Username',
			'password' => 'Password'
		]);
		$user['password'] = bcrypt($request->password);
		User::create($user);
		return back()->with('success', 'User has been added');

	}


}
