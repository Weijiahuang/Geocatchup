<?php foreach($users as $user): ?>	
    	
    		<?php if(isset($followers[$user['user_id']])): ?>

    		<div class = "box">
    		<img src= "/uploads/<?=$user['picture'];?>"  style="height:120px; width:100px;"><br>
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
 <form action="/groups/grouping" method="post">
   <select class="group"  name='group'>   
   <option value="Everyone">Everyone</option>
   <option value="Friends">Friends</option>
   <option value="Family">Family</option>
   <option value="Acquaintances">Acquaintances</option>
   <input type="hidden" name="user_id_followed" value="<?=$user['user_id']?>"> 
   </select>
   <input type="submit" style="float:left;" value="Group me"/>	
 </form>
 <br/>
 <br/>
 Phone: <?=$user['phone']?>
 <br/>
 Email: <?=$user['email']?>
 
 </div>
   	
	<?php endif; ?>	
<?php endforeach; ?>
<script >
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