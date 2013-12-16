<script>
function remove(){

document.getElementById("remove").innerHTML="";
return;
}

function join(){

document.getElementById("join").innerHTML="";
return;
}

</script>

<?php if(isset($join_connections[$post['post_id']])): ?>
        <a class = "participation" href='/posts/join/<?=$post['post_id']?>'>join</a>
        
    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a class = "participation" href='/posts/remove/<?=$post['post_id']?>'>remove</a>
        
    <?php endif; ?>