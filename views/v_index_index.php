<!-- header -->
<div id ="header">
	<div id="logo">
		Spur!
    </div>

<!-- sign in part -->

<div id="signin">
  <br>
   <form method ='POST' action = '/users/p_login'>
      <label for="email1">Email</label> 
      <input class="signininput" type="text" name="email1" placeholder="Email">
      <label id="password1" for="password1">Password</label>
      <input class="signininput" type="password" name="password1" placeholder="Password"> &nbsp;&nbsp;
      <input class="participation" type="Submit" value="Log in" >
      <br>
      <?php if(isset($error)): ?>	
	    	<div class='error'>
              Login failed. Please double check your email and password.
            </div>        
      <?php endif; ?>
	  <input type="checkbox" id= "checkbox" > Remember
      <span> <a id="forget" href="" > Forget your password? </a></span>
  </form>
</div>
</div>




<h1 id ="head1">
Locate and connect your friends. Instantly. 
</h1>



<!-- Youtube video -->

<iframe width="420" height="315" src="//www.youtube.com/embed/4hlJPfq8zdw" frameborder="0" allowfullscreen></iframe>



<!--Singup form-->
<div id="signupbox">
<h2> Get Started! </h2>

<form method = 'POST' action = '/users/p_signup'>
	<input class="signupinput" type = 'text' name = 'first_name' placeholder="First name"> <br> 
	<input class="signupinput"type ='text' name = 'last_name' placeholder="Last name"><br>
	<input class="signupinput" id="email" type ='text' name = 'email' placeholder="Email"><br>
	<input class="signupinput" type ='password' name = 'password' placeholder="Password">
	<p>
	By clicking Join Now, you agree to Spur's User <br>Agreement, Privacy Policy and Cookie Policy.
	</p>
		<!--Check if the email account is already taken-->
		<?php if(isset($uniqueness)): ?>
		<div class = "error">
			You already have an account or the email is not valid.
		</div>			
		<?php endif; ?>	

		<!--Check if the any field is left blank-->
		<?php if(isset($blankness)):?>
			<div class = "error">
			Please fill in the filed(s).
			</div>			
		<?php endif; ?>	
	<br>
	<input class="participation" type = 'submit' value = 'Join now' style="width:300px; height:30px;"> <br>
</form>

<div>
