<html>
<head>
	<title>User Dashboard</title>
</head>
<body>
	<h1>You have logged in!</h1>
	<?php 
		echo "you made it!"; 
	?>
	<form action="process.php" method="post">
		<input type="hidden" name="signout" value="signout">
		<input type="submit" value="Submit">
	</form>
</body>
</html>