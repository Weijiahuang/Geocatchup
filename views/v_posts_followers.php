<style type="text/css">
.button {
	-moz-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	-webkit-box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	box-shadow:inset 0px 1px 0px 0px #c1ed9c;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #9dce2c), color-stop(1, #8cb82b) );
	background:-moz-linear-gradient( center top, #9dce2c 5%, #8cb82b 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#9dce2c', endColorstr='#8cb82b');
	background-color:#9dce2c;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #83c41a;
	display:inline-block;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
</style>

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
<center><h1> These are your followers </h1></center>
<br>

<br>
<br>

<div id ='windows' style="height:80%; width:60%; background-color:white;">
<br>


<?php foreach($users as $user): ?>	
    	
    		<?php if(isset($following[$user['user_id']])): ?>

    		<div class = "box">
    		<img src= "/uploads/<?=$user['picture'];?>" style = "position:relative; float:left; height:100px; width:100px;"><br>
    		 <strong style="color:#000000"><?=$user['first_name']?> <?=$user['last_name']?></strong>  
			<div style="position:relative; text-align:center; margin-top:10%;"> 
						
			<?php if(isset($connections[$user['user_id']])): ?>
				
        <div id="<?=$user['user_id']?>" class="jr-btn-container">
	     <a class = "participation fol-btn" style="background:#459dcd;" href='<?=$user['user_id']?>' >Unfollow</a>
	    </div>
    		
    		<?php else: ?>
        		
        <div id="<?=$user['user_id']?>" class="jr-btn-container">
	     <a class = "participation fol-btn" href='<?=$user['user_id']?>' >Follow</a>
	    </div>
	        	       		
   			<?php endif; ?>
   			</div>
   	</div>
	<?php endif; ?>
	
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
