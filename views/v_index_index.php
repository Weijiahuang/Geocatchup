
<div id ="header">
<div id="logo">
Spur!
</div>
<div id="signin">
Email 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Password
<br>
<form method ='POST' action = '/users/p_login'>
  <input type="text" name="email1" style="width:200px; height:20px;" placeholder="Email">
  <input type="password" name="password1" style="width:200px; height:20px;"placeholder="Password"> &nbsp;&nbsp;
  <input class="participation" type="Submit" value="Log in" style="width:60px; height:30px;" background-color="green;">
  <br>
   
   <?php if(isset($error)): ?>	
		<div class='error'>
            Login failed. Please double check your email and password.
        </div>        
    <?php endif; ?>
    
  <input type="checkbox" name="vehicle" value="Car"> Remember<span style="color:blue;font-weight:bold">
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a href="" style="text-decoration:none; color:#000000;"> Forget your password? </a></span>
</form>
</div>
</div>
<h1 id ="head1">
Locate and connect your friends. Instantly. 
</h1>

<div id ="picture">
</div>

<div id="signupbox">
<h2> Get Started! </h2>

<!--Singup form-->

<form method = 'POST' action = '/users/p_signup'>
	First Name <input type = 'text' name = 'first_name' style="width:200px; height:20px;" placeholder="First name"> <br> <br>
	Last Name <input type ='text' name = 'last_name' style="width:200px; height:20px;" placeholder="Last name"><br><br>
	Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type ='text' name = 'email' style="width:200px; height:20px;" 		placeholder="Email"><br><br>
	Password &nbsp; <input type ='password' name = 'password' style="width:200px; height:20px;"  placeholder="Password">

	<p>
	By clicking Join Now, you agree to Spur's User <br>Agreement, Privacy Policy and Cookie Policy.
	</p>
	<?php if(isset($uniqueness)): ?>
		<div class = "error">
			You already have an account or the email is not valid.
		</div>			
<?php endif; ?>	

<?php if(isset($blankness)):?>
		<div class = "error">
			Please fill in the filed(s).
		</div>			
<?php endif; ?>	

<br/>
	<input class="participation" type = 'submit' value = 'Join now' style="width:300px; height:30px;"> <br>
</form>

<div>
