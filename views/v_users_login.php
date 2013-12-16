
<div id="menu">
<div id size="fontsize" >
Geohangout
</div>
</div>

<div id ="loginbox">
<h3>Login<h3>
<form method ='POST' action = '/users/p_login'>
  <input type="text" name="email1" style="width:200px; height:20px;" placeholder="Email"><br><br>
  <input type="password" name="password1" style="width:200px; height:20px;"placeholder="Password"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="Submit" value="Log in" style="width:60px; height:30px;" background-color="green;"><br>
   
   <?php if(isset($error)): ?>
	
		<div class='error'>
            Login failed. Please double check your email and password
        </div>        
    <?php endif; ?>
    
  <input type="checkbox" name="vehicle" value="Car"> Remember-<span style="color:blue;font-weight:bold"> <a href="" style="text-decoration:none">Forget? </a></span>
</form>
</div>

<div id="signupbox">
<h3> Sign up </h3>
<form method = 'POST' action = '/users/p_signup'>
	First Name <input type = 'text' name = 'first_name' style="width:200px; height:20px;" placeholder="First name"> <br> <br>
	Last Name <input type ='text' name = 'last_name' style="width:200px; height:20px;" placeholder="Last name"><br><br>
	Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ='text' name = 'email' style="width:200px; height:20px;" placeholder="Email"><br><br>
	Password &nbsp; <input type ='password' name = 'password' style="width:200px; height:20px;"  placeholder="Passwords">
	<input type = 'submit' value = 'Sign Up' style="width:60px; height:30px;"> <br>
</form>
<div>