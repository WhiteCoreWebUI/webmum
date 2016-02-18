<?php

// If user is already logged in, redirect to start.
if(Auth::isLoggedIn()){
	redirect("private");
}

if(isset($_POST['email']) && isset($_POST['password'])){
	if(empty($_POST['email']) || empty($_POST['password'])){
		add_message('fail', 'Please fill out both email and password fields.');
	}
	else {
		// Start login
		if(Auth::login($_POST['email'], $_POST['password'])){
			redirect("private");
		}
		// If login is not successful
		else{
			//Log error message
			writeLog("WebMUM login failed for IP ".$_SERVER['REMOTE_ADDR']);
			add_message("fail", "Sorry, but we cannot log you in with this combination of email and password, there might be a typo.");
		}
	}
}

?>

<h1>Login</h1>

<?php output_messages(); ?>

<form class="form" action="" method="post">
	<div class="input-group">
		<label>Email address</label>
		<div class="input">
			<input type="text" name="email" placeholder="Your email address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" autofocus required/><br>
		</div>
	</div>

	<div class="input-group">
		<label>Password</label>
		<div class="input">
			<input type="password"  name="password" placeholder="Your password" required/>
		</div>
	</div>

	<div class="buttons">
		<button type="submit" class="button button-primary">Log in</button>
	</div>
</form>

