<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requestss;
use App\User;

class LoginController extends Controller
{
	public function getAdminLogin() {
		return view('login');
	}
	public function getAdminLogout() {
		Auth::logout();
		return view('login');
	}
	
	public function postAdminLogin(Request $request) {
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required|min:3|max:32',
			'level' => 'numeric'
		]);
		$array = ['username'=>$request->username,'password'=>$request->password];
		if(Auth::attempt($array)){
			return redirect('manager');
		} else {
			return back()->withErrors("");
		}
	}

}
