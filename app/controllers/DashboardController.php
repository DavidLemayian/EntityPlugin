<?php

class DashboardController extends BaseController {

	public function showOverview()
	{
		return View::make('hello');
	}

}