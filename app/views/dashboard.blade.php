@extends('layouts.master', array('nav_main_dash'=>'active'))

@section('content')
    <div class="container">
    	
    	<ul class="nav nav-tabs">
    		<li  class="{{ isset($nav_dash) ? 'active' : '' }}" ><a href="/dashboard">Overview</a></li>
    		<li class="{{ isset($nav_docs) ? 'active' : '' }}"><a href="#">Documents</a></li>
    		<li class="{{ isset($nav_proj) ? 'active' : '' }}"><a href="/dashboard/projects">
    			<span class="badge pull-right">{{ $dc_projects_count }}</span> 
    			Projects</a></li>
    		<li class="{{ isset($nav_ent) ? 'active' : '' }}"><a href="#">Entities</a></li>
    	</ul>
    	
    	<div class="row">
    	
    		<!-- Main content area -->
    		<div class="col-md-9">
    		
    			@yield('sub-content')
    			
    		</div><!-- /.col-md-9 /Main content area-->
    		
    		<!-- Dashboard Navigation -->
    		<div class="col-md-3">
    			
    		</div>
    		
    	</div><!-- /.row -->
    	
    </div>
@stop