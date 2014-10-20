<html>
<head>
	<title>PDO login</title>
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
	<div id="successful-signup"></div>
	<div id="invalidlogin"></div>
	<div id="validLogin"></div>
	<label class="register">Sign Up</label>
	<form action="process.php" method="post" id="signup">
		<input type="hidden" name="sign_up" value="sign_up">
		<div id="first-name-errors"></div>
		<input type="text" name="first_name" placeholder="First Name"><br>
		<div id="last-name-errors"></div>
		<input type="text" name="last_name" placeholder="Last Name"><br>
		<div id="email-errors"></div>
		<input type="text" name="email" placeholder="Email"><br>
		<div id="tele-errors"></div>
		<input type="text" name="tele" placeholder="Telephone Number"><br>
		<div id="pw-errors"></div>
		<input type="password" name="pw" placeholder="Password"><br>
		<div id="verify-pw-errors"></div>
		<input type="password" name="verify_pw" placeholder="Verify Password"><br>
		<input type="submit" class="submit">
	</form>

	<label class="log-in">Log In</label>
	<form action="process.php" method="post" id="login">
		<input type="hidden" name="login_log_in" value="log_in">
		<div id="login_email-errors"></div>
		<input type="text" name="login_email" placeholder="Email"><br>
		<div id="login_pw-errors"></div>
		<input type="password" name="login_pw" placeholder="Password"><br>
		<input type="submit" class="submit">
	</form>


	<style type="text/css">
		body{
			margin: 0px;
		}
		#successful-signup{
			height: 30px;
			position: absolute;
			top: 0;
			width: 100%;
			text-align: center;
			background-color: green;
			color: #fff;
			display: none;
		}
		#invalidlogin{
			height: 30px;
			position: absolute;
			top: 0;
			width: 100%;
			text-align: center;
			background-color: red;
			color: #fff;
			display: none;
		}
		#validLogin{
			height: 30px;
			position: absolute;
			top: 0;
			width: 100%;
			text-align: center;
			background-color: green;
			color: #fff;
			display: none;
		}
		#first-name-errors, #last-name-errors, #email-errors, #tele-errors, #email-errors, #pw-errors, #verify-pw-errors{
			height: 30px;
			position: relative;
		}
		#login_email-errors, #login_pw-errors{
			height: 30px;
			position: relative;
		}
		label.register, label.log-in{
			margin-top: 50px;
			display: block;
		}
		.errors, .login_errors{
			color: red;
			position: absolute;
			bottom: 0;
		}
		input.submit{
			margin-top: 30px;
		}
	</style>

	<script type="text/javascript">
		function Convertjson(data){
			var json;
			try{json = jQuery.parseJSON(data);return json;}
			catch(e){return data;}
		}
		$('form#signup').on('submit',function(){
			$('.errors').remove();
			var serialized_data = $(this).find("input").serialize();
			$.ajax({
				type: 'POST',
				url: 'process.php',
				data: serialized_data,
				dataType: 'json',
				success: function(jsonStr){
					var	json = Convertjson(jsonStr);
					// console.log(json);
					if (json.action=='error') {
						$('#'+json.id+'-errors').html('<span class="errors">'+json.message+'</span>');
					}
					else if (json.action=='success'){
						$('form#signup').trigger("reset");
						$('#successful-signup').html('<span class="success">'+json.message+'</span>').fadeIn(500).delay(3000).fadeOut(500);
					}
				}
			});
			return false;
		});


		$('form#login').on('submit',function(){
			$('.login_errors').remove();
			var serialized_data = $(this).find("input").serialize();
			$.ajax({
				type: 'POST',
				url: 'process.php',    
				data: serialized_data,
				dataType: 'json',
				success: function(jsonStr){
					var	json = Convertjson(jsonStr);
					if (json.action=='login_error') {
						$('#'+json.id+'-errors').html('<span class="login_errors">'+json.message+'</span>');
					}
					else if (json.action=='verify_error') {
						$('#invalidlogin').html('<span class="login-invalid">'+json.message+'</span>').fadeIn(500).delay(3000).fadeOut(500);
					}
					else if (json.action=='verify_success') {
						$('#validLogin').html('<span class="login-valid">'+json.message+'</span>').fadeIn(500).delay(3000).fadeOut(500);
						window.location.href = 'main.php';
					}
				}
			});
			return false;
		});
	</script>
</body>
</html>