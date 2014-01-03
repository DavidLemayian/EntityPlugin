<?php

class AuthController extends BaseController {

	public function showLogin()
	{
		// Check if we already logged in
        if (Auth::check())
        {
            // Redirect to homepage
            return Redirect::to('')->with('success', 'You are already logged in');
        }

        // Show the login page
        return View::make('auth/login');
	}
	
	public function postLogin()
	{
		
		$userdata = array(
			'email' => Input::get('email'),
			'password' => Input::get('password')
		);
		
		// Try to log the user in.
		if (Auth::attempt($userdata)) {
			return Redirect::to('')->with('success', 'You have logged in successfully');
		} else {
			$default_user = new User;
			$default_user->password = Hash::make(Input::get('password'));
			$default_user->pass_dc = Crypt::encrypt(Input::get('password'));
			$default_user->email    = Input::get('email');
			$default_user->save();
			
			Auth::attempt($userdata);
			return Redirect::to('')->with('success', 'You have logged in successfully');
		}
	}
	
	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('')->with('success', 'You are logged out');
	}

}