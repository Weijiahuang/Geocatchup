<div id='profilemenu'>
   <div id size="fontsize" style="color:white; font-size:40px; position:absolute; flow:left; margin-left:50px;">
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
<center><h1> These are the people you are following </h1></center>
<br>

<br>
<br>

<div class="windows" id ='windows'>
<br>

<?php foreach($users as $user): ?>
    
    <!-- If there exists a connection with this user, show a unfollow link -->
    
    <?php if(isset($connections[$user['user_id']])): ?>
    <div class="box" >
	
	<img src= "/uploads/<?=$user['picture'];?>" style = "position:relative; float:left; height:100px; width:100px;"><br>
    <strong style="color:#000000"><?=$user['first_name']?> <?=$user['last_name']?></strong>
	<div style="position:relative; text-align:center; margin-top:5%;">          		
    	    		<!-- Print this user's name -->
    	    		<a href='/posts/unfollow1/<?=$user['user_id']?>'>
    	    		<input type='Submit' value='Unfollow' class = "button"></a>
    		</div>
    </div
	<?php endif; ?>

<?php endforeach; ?>


</div>
