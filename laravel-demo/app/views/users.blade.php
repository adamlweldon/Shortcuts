<!-- layout -->
@extends('layout')

<!-- content -->
@section('content')
	<h2>Join the event!</h2>
	@if (Session::has('flash_notice'))
        <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
    @endif
	<?php 
		if ( isset($errors) ) {
			echo "<h2 style='color:red;'>".$errors->first('email')."</h2>";
			echo "<h2 style='color:red;'>".$errors->first('name')."</h2>";
			echo "<h2 style='color:red;'>".$errors->first('password')."</h2>";
			echo "<h2 style='color:red;'>".$errors->first('verify')."</h2>";
		} 
	?>
	<h3>Sign up:</h3>
	<!-- registering users into db -->
	{{ Form::open(array('url' => 'register')) }}
	    <?php echo Form::label('email', 'E-Mail Address'); ?><br>
		<?php echo Form::text('email'); ?><br>
		<?php echo Form::label('name', 'Name'); ?><br>
		<?php echo Form::text('name'); ?><br>
		<?php echo Form::label('password', 'Password'); ?><br>
		<?php echo Form::password('password'); ?><br>
		<?php echo Form::label('password_confirmation', 'Verify Password'); ?><br>
		<?php echo Form::password('password_confirmation'); ?><br>
		<input type="submit">
	{{ Form::close() }}

	<h3>Login:</h3>
	@if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif
	<!-- validating login -->
	{{ Form::open(array('url' => 'login')) }}
	    <?php echo Form::label('email', 'E-Mail Address'); ?><br>
		<?php echo Form::text('email'); ?><br>
		<?php echo Form::label('password', 'Password'); ?><br>
		<?php echo Form::password('password'); ?><br>
		<input type="submit">
	{{ Form::close() }}
	
@include('include')

@stop