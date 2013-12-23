<div id='profilemenu'>
   <div id="brandname">
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a id="logout">Logout</a>
           
            <a id ="profile" href='/users/profile'>Profile						</a>            
			<a  class="navigation" href='/posts/index'>View post				</a>
			<a class="navigation" href='/posts/users'>Users						</a>
			<a class="navigation" href ='/posts/followers'> Followers			</a>
			<a class="navigation" href ='/posts/following'> Following			</a>
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
	
	<img src= "/uploads/<?=$user['picture'];?>"><br>
    <strong style="color:#000000"><?=$user['first_name']?> <?=$user['last_name']?></strong>
	<div id="position">          		
    	    		<!-- Print this user's name -->
    	    		<a href='/posts/unfollow1/<?=$user['user_id']?>'>
    	    		<input type='Submit' value='Unfollow' id="unfollow1"  class = "button"></a>
    		</div>
    </div
	<?php endif; ?>
<?php endforeach; ?>
</div>

<style >
#unfollow1{
	position: absolute;
	margin-top: -25px;
	margin-left: -40px;
}
</style>
