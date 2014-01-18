<div id='profilemenu'>
    <div id="brandname" >
		<strong>   Geocatchup</strong>
    </div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a id="logout" href="/users/logout">Logout</a>
           
            <a id ="profile" style="margin-left:30%;" href='/users/profile'>Profile</a>            
			<a  class="navigation" href='/posts/index'>View post<a>
			<a class="navigation" href='/posts/users'>Users<a>
			<a class="navigation" href ='/posts/followers'> Followers			<a>
			<a class="navigation" href ='/posts/following'> Following	<a>
			<a class="navigation" href='/posts/index'>Add a post<a>
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
<div id ='windows' style="height=100%; width:60%;">
<br>

<img src= "/uploads/<?=$user->picture;?>" id="uploadpicture">
<br>
<br><br><br><br><br><br><br><br><br><br><br>
<h1 class="uploadtitle"> Upload your profile picture here.</h1>
<form action="/users/p_upload" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="uploadfile" >

<button  type="submit" name="submit" value="Submit" id="submitbutton">Submit</button>
</form>
<br><br>

<?php foreach($eventsattendings as $eventsattending): ?>
       <hr>  
       <div id = "box" >
          <img id="postpicture" src= "/uploads/<?=$eventsattending['picture'];?>" >        
         
          <!-- activity content -->
          <div id="eventfont" >      
          	<strong id="activity">Activity:  <?=$eventsattending['interest']?> </strong><br>
		  	Time: <?=$eventsattending['date']?> at <?=$eventsattending['time']?><br>
		  	Place: <?=$eventsattending['place']?> <br>
		  	<time datetime="<?=Time::display($eventsattending['created'],'Y-m-d G:i')?>">
		  		Posted at <?=Time::display($eventsattending['created'])?>
		  	</time>
		  </div>     
          <div id="name" >
              <div id="username" ><?=$eventsattending['first_name']?> <?=$eventsattending['last_name']?> </div>&nbsp;&nbsp;&nbsp;&nbsp;           
	          </div>
	      </div>			
<?php endforeach; ?>

</div>
