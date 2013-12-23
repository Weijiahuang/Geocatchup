
<div id='profilemenu'>
   <div id="brandname">
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <!-- Menu for users who are logged in -->
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a id="logout" href='/users/logout'>Logout</a>
            <a id ="profile" href='/users/profile'>Profile</a>            
			<a  class="navigation" href='/posts/index'>View posts				   </a>
			<a class="navigation" href='/posts/users'>Users                        </a>
			<a class="navigation" href ='/posts/followers'> Followers			   </a>
			<a class="navigation" href ='/posts/following'> Following	           </a>
			
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
<center><h1> <strong > Follow other users to see their posts.</h1></center>
<br>

<br>
<br>
<div id ='windows'>

	<!-- search bar -->	 	
	<div class="light">	 	
		<form action="/posts/searchName" method="GET">	 	
			<input type="text" name="name" class="search_rounded" placeholder="Search by name" value="<?php echo $GET_['name']?>"> 	 	 			<input type="submit" class = "participation" value="Search Now" id="userssearch" >	 
		</form>
	<br>

	<?php foreach($users as $user): ?>
		<div class = "box">	
			<img src= "/uploads/<?=$user['picture'];?>"><br>	   
    
    <!-- Print this user's name -->    
	    <strong style="color:#000000"><?=$user['first_name']?> <?=$user['last_name']?></strong>
		<div id="position">
	
    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
            
        <div id="<?=$user['user_id']?>" class="jr-btn-container">
	     <a class = "participation fol-btn" id= "unfollow" href='<?=$user['user_id']?>' >Unfollow</a>
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
<style>
#unfollow {
	background:#459dcd;
}
</style>


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