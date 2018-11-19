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

	public function postAdminLogin(Request $request) {
		$this->validate($request, [
			'email' => 'required',
			'password' => 'required|min:3|max:32'
		], [
			'email.required' => 'Ban chua nhap Email',
			'password.required' => 'Ban chua nhap Password',
			'password.min' => 'Password khong duoc nho hon 3 ky tu',
			'password.max' => 'Password khong duoc lon hon 32 ky tu'
		]);
		$array = ['email'=>$request->email,'password'=>$request->password];
		if(Auth::attempt($array)){
			return redirect('manager');
		} else {
			return back()->withErrors("");
		}
	}

}
