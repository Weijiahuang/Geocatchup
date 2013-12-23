<div id='profilemenu'>
   <div id= "brandname" >
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage">
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a id="logout" href='/users/logout'>Logout</a>
            <a id ="profile"  href='/users/profile'>Profile</a>            
			<a  class="navigation" href='/posts/index'>View post<a>
			<a class="navigation" href='/posts/users'>Users<a>
			<a class="navigation" href ='/posts/followers'> Followers <a>
			<a class="navigation" href ='/posts/following'> Following <a>
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
<center><h1> These are your followers </h1></center> 
<br>
<br>
<br>

<div id ='windows' >
<br>
<center><table cellpadding="10">
  <tr>
    <th> <a class="menu_top" href="/groups/all">All </a></th>
    <th><a class="menu_top" href="/groups/friends">Friends </a</th>
    <th><a class="menu_top" href="/groups/family"> Family </a> </th>
    <th><a class="menu_top" href="/groups/acquaintances">Acquaintances </a> </th>
  </tr>
<table>
</center>
<hr>

<div id="content_area"></div>

<script type="text/javascript" src="/js/jquery.js"> </script>
<script type="text/javascript" src="/js/nav.js"> </script>


</div>
