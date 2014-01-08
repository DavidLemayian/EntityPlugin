<?php

class DashboardController extends BaseController {


	public function showOverview()
	{
		$dc_projects = $this->dcGetProjectsJSON();
		$dc_projects_count = count($dc_projects->{'projects'});
		
		$data = array(
			'nav_dash' => 'active',
			'dc_projects' => $dc_projects->{'projects'},
			'dc_projects_count' => $dc_projects_count
		);
		
		return View::make('dashboard.overview', $data);
	}
	
	public function showProjects()
	{
		$dc_projects = $this->dcGetProjectsJSON();
		$dc_projects_count = count($dc_projects->{'projects'});
		
		$data = array(
			'nav_proj' => 'active',
			'dc_projects' => $dc_projects->{'projects'},
			'dc_projects_count' => $dc_projects_count
		);
		
		return View::make('dashboard.projects', $data);
	}
	
	
	// Authorized API calls to sourceAFRICA.net
	function dcApiCallJSON($host)
	{
		$auth = base64_encode(Auth::user()->email.":".Crypt::decrypt(Auth::user()->pass_dc));
		$opts = array(
		  'http'=>array(
		    'method'=>"GET",
		    'header'=>"Accept-language: en\r\n" .
		              "Authorization: Basic ".$auth."\r\n"
		  )
		);
		$context = stream_context_create($opts);
		$dc_return_json = file_get_contents($host, false, $context);
		$dc_return = json_decode($dc_return_json);
		
		return $dc_return;
		
	}
	
	// Get projects
	function dcGetProjectsJSON() {
		return $this->dcApiCallJSON( 'https://sourceafrica.net/api/projects.json' );
	}
	

}