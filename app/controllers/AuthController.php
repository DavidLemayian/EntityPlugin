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

}