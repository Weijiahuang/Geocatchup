<div id='profilemenu'>
    <div id="brandname" >
		<strong>   Spur!</strong>
    </div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a id="logout">Logout</a>
           
            <a id ="profile" style="margin-left:30%;" href='/users/profile'>Profile</a>            
			<a  class="navigation" href='/posts/index'>View post<a>
			<a class="navigation" href='/posts/users'>Users<a>
			<a class="navigation" href ='/posts/followers'> Followers			<a>
			<a class="navigation" href ='/posts/following'> Following	<a>
        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign Up</a>
            <a href='/users/index'>Log In</a>
        <?php endif; ?>
     </div>   
</div>

<br>
<br>
<br><br>
<br><br>
<br><br>
<br>
<div id ='windows'>
<br>

<img src= "/uploads/<?=$user->picture;?>" id="uploadpicture">
<br>
<br><br><br><br><br><br><br><br><br><br>
<h1 class="uploadtitle"> Upload your profile picture here.</h1>
<form action="/users/p_upload" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="uploadfile" >

<button  type="submit" name="submit" value="Submit" id="submitbutton">Submit</button>
</form>
</div>

