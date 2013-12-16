<div id size="fontsize" style=" color:red; font-size:40px; position:absolute; flow:left; margin-left:10px;">
			<strong>Geohangout</strong>
		</div>

<div id='profilemenu'>
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a href='/users/logout'>Logout</a>
            <a href='/users/profile'>Profile</a>
			<a href='/posts/add'>Add a post<a>
			<a href='/posts/index'>View post<a>
			<a href='/posts/users'>Users<a>
			
			
        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign up</a>
            <a href='/users/index'>Log in</a>
        <?php endif; ?>      
        
</div>
<br>
<br>
<br>
<div id ='windows'>
<h4> Say something!</h4>
<form method='POST' action='/posts/p_add'>
    <textarea name='content' id='content' style= ";height:100px;width:400px;"></textarea>
    <input type='Submit' value='New post'>

</form> 

</div>