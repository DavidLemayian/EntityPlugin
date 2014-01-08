@extends('dashboard')

@section('sub-content')
	<h3>Projects</h3>
		
	<table class="table table-hover">
		<tbody>
			@foreach ($dc_projects as $key => $dc_project)
				<tr><td><h4>{{ $key+1 }}</h4></td>
				<td>
					<h4>{{ $dc_project->{'title'} }}</h4>
					<p>{{ $dc_project->{'description'} }}</p>
					<p>Number of Documents: {{ count($dc_project->{'document_ids'}) }}</p>
				</td></tr>
			@endforeach
		</tbody>
	</table>
@stop