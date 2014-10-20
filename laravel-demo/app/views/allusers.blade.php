<!-- layout -->
@extends('layout')

<!-- content -->
@section('content')

	@if (Session::has('flash_notice'))
        <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
    @endif

    <h3>Welcome {{ Auth::user()->name ?: '' }} </h3>
    
	<!-- get users already in the db -->
	<h3>Here are the people that have registered with you:</h3><br>
	{{ Form::open(array('url' => 'logout')) }}
		<input type="submit" value="Logout">
	{{ Form::close() }}

	@foreach($users as $user)
		<p>Name: {{ $user->name }}</p>
		<p>Email: {{ $user->email }}</p><br>
	@endforeach

@stop