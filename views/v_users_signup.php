<h2> Sign up </h2>
<div id="signupbox">
<form method = 'POST' action = '/users/p_signup'>
	First Name <input type = 'text' name = 'first_name' style="width:200px; height:20px;" placeholder="First name"> <br> <br>
	Last Name <input type ='text' name = 'last_name' style="width:200px; height:20px;" placeholder="Last name"><br><br>
	Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ='text' name = 'email' style="width:200px; height:20px;" placeholder="Email"><br><br>
	<?php if($unique==false):?>
		<div class = "error">
			Signup failed, you already have an account.
		</div>
		
	
	Password &nbsp; <input type ='password' name = 'password' style="width:200px; height:20px;"  placeholder="Passwords"><br><br>
	<?php if(isset($error)):?>
	<div class ='error'>
		Please fill in all fields!.
	</div>
<?php endif; ?>	
	<input type = 'submit' value = 'Sign Up' style="width:60px; height:30px;"> <br>
</form>
<div>

