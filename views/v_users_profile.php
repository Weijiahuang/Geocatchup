<div id='profilemenu'>
   <div id size="fontsize" style="color:#ffffff; font-size:40px; position:absolute; flow:left; margin-left:50px;">
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; float:right; margin-right:20px;" href='/users/logout'>Logout</a>
           
            <a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:30%;" href='/users/profile'>Profile</a>
            
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href='/posts/index'><strong>View post</strong><a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%" href='/posts/users'>Users<a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href ='/posts/followers'> Followers		<a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href ='/posts/following'> Following	<a>
        <!-- Menu options for users who are not logged in -->
        <?php else: ?>
        
            <a href='/users/signup'>Sign Up</a>
            <a href='/users/index'>Log In</a>
        <?php endif; ?>
        
     </div>
        
</div>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br>
<div id ='windows'>
<br>
<img src= "/uploads/<?=$user->picture;?>" style = "height:200px; width:200px; horizontal-align:middle;">
<h1 style="font-family:Arial; font-size:20px;"> Upload your profile picture here.</h1>

<form action="/users/p_upload" method="post" enctype="multipart/form-data">

<label for="file" style="text-align:center; font-family:Arial; font-size:20px;"> File:</label> 

<input type="file" name="file" id="file">

<input class="participation" type="submit" name="submit" value="Submit">
</form>
</div>

