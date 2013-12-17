
<div id='profilemenu'>
   <div id size="fontsize" style="color: #ffffff; font-size:40px; position:absolute; flow:left; margin-left:50px;">
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
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
<center><h1> Follow other users to see their posts.</h1></center>
<br>

<br>
<br>
<div id ='windows'>

<!-- search bar -->	 	
<div class="light">	 	
<form action="/posts/searchName" method="GET">	 	
<input type="text" name="name" class="search_rounded" placeholder="Search by name" value="<?php echo $GET_['name']?>"> 	 	 	
<input type="submit" class = "participation" value="Search Now" style="margin-top:-40px; margin-left:0px; width:100px; height:35px;" >	 
</form>
<br>

<?php foreach($users as $user): ?>
	<div class = "box">	
	<img src= "/uploads/<?=$user['picture'];?>" style = "position:relative; float:left; height:100px; width:100px;"><br>	   
    
    <!-- Print this user's name -->    
	    <strong style="color:#000000"><?=$user['first_name']?> <?=$user['last_name']?></strong>
	<div style="position:relative; text-align:center; margin-top:9%;">
	
    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
            
        <div id="<?=$user['user_id']?>" class="jr-btn-container">
	     <a class = "participation fol-btn" style="background:#459dcd;" href='<?=$user['user_id']?>' >Unfollow</a>
	    </div>
        
         		
    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        
        <div id="<?=$user['user_id']?>" class="jr-btn-container">
	     <a class = "participation fol-btn" href='<?=$user['user_id']?>' >Follow</a>
	    </div>
        
    <?php endif; ?>
    
    </div>
    </div>
<?php endforeach; ?>
<script>

$('.fol-btn').click(function(e) {
    e.preventDefault()   
    var lnk=$(this)    
	      //alert(lnk.attr('href'))
    if(lnk.text()=='Follow') {
	    $.ajax({
	        type: 'POST',
	        data: {
	            id: lnk.attr('href')
	        },
	        url: '/posts/'+'follow',
	        success: function(response) {
	        
	          if (response == 'false') {
	            console.log('an error returns');
	            return;
	          } else {
	          	$(e.target).css('background','#459dcd');
	          		            lnk.text('Unfollow')	            
	          } 
	            
	        }
	    }); 
    }
    else {
	     $.ajax({
		        type: 'POST',
		        data: {
		            id: lnk.attr('href')
		        },
		        url: '/posts/'+'unfollow',
		        success: function(response) {
		          if (response == 'false') {
		            console.log('an error returns');
		            return;
		          } else {
		          	$(e.target).css('background','#9dce2c');
					  lnk.text('Follow')					  
		          } 
		            
		        }
		    }); 
    }
});
</script>

</div>