<?php
class AuthenController extends BaseController {

	public function postLogin(){
		$validator = Validator::make(Input::all(),
			array(
				'email' 	=> 'required|email|exists:users,email',
				'password'  => 'required|min:8'
			)
		);
		if($validator->fails()){
			return Redirect::route('home')
				   ->withErrors($validator)
				   ->withInput(Input::except('password'));
		}
		else {

			$credentials = array(
				'email'		=> Input::get('email'),
				'password'	=> Input::get('password')
			);

			$remember = (Input::has('remember')) ? true : false;

			$auth = Auth::attempt($credentials,$remember);

			if($auth) {
				//Redirect to the intended page

				// $user = User::where('email' , '=' , Input::get('email'))->first();
				// $user->active = 1;
				// $user->save();

				Session::put('user' , Auth::user() );

				return Redirect::route('orders-get')->with('success' , 'Sign in successfully');
			} else {
				return Redirect::route('home')
			   					->with('fail' , 'There was a problem signing you in. Wrong password or email ?');
			}
		}
	}
	public function getLogin(){
		return View::make('authen.login');
	}

	public function getSignOut() {
		$user = Auth::user();

		if($user) {		
			Auth::logout();
			return View::make('home')->with('success','Sign out');
		}
		return Redirect::route('home')->with('fail','You are not sign in');
	}	
}