<!-- layout -->
@extends('layout')

<!-- content -->
@section('content')
	<h2>You have successfully registered!</h2>

	<!-- get users already in the db -->
<!-- 	<h3>Here are the people that have registered with you:</h3><br>
	@foreach($users as $user)
		<p>Name: {{ $user->name }}</p>
		<p>Email: {{ $user->email }}</p><br>
	@endforeach -->

	<h3>Please Login:</h3>
	<!-- validating login -->
	{{ Form::open(array('url' => 'login')) }}
	    <?php echo Form::label('email', 'E-Mail Address'); ?><br>
		<?php echo Form::text('email'); ?><br>
		<?php echo Form::label('password', 'Password'); ?><br>
		<?php echo Form::password('password'); ?><br>
		<input type="submit">
	{{ Form::close() }}

@stop