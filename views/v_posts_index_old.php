  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  
  
  <script src="http://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.3">
</script>



<script type="text/javascript">
    var map = null;
    var pinPoint = null;
    var pinPixel = null;
 
    // All the following is only doable if we have geolocation support

    if (!navigator.geolocation) {
     alert("Geolocation API is not supported in your browser.");
     exit(0);
     }

   
    // Note this is the only thing that changes in between the Bing and Google Examples:

    function positionHandler (Position) {
        var latitude = Position.coords.latitude;
        var longitude = Position.coords.longitude;   
 
       
	// To specify coordinates, we provide latitude, longitude, and (optionally)
	// an altitudemode  - VELatLong(latitude, longitude, altitude, altitudemode)
        var myCoordinates = new VELatLong(latitude, longitude);
 
  

        // Map will be created in the DIV we specify by ID here

        map = new VEMap('mapContainer');


	// LoadMap(point, zoom, style, fixed, mode, showSwitch, tileBuffer)

        map.LoadMap(
                myCoordinates,   // Duh
                15,              // Zoom level
                VEMapStyle.Road, // Map Style - Road, Shaded, Aerial, Hybrid, Oblique, Birdseye, BirdseyeHybrid
                false,           // Static map? False means user can change
                VEMapMode.Mode2D,// 2D/3D
                true,            // showSwitch
                1                // tileBuffer
                );
 
        pinPoint = map.GetCenter();
        // Can also get exact pixel reference..
        // pinPixel = map.LatLongToPixel(pinPoint);
        var pin = map.AddPushpin(pinPoint);
        pin.SetTitle("This is the pin title");
	pin.SetDescription("This is the pin description");
	// can also set pin.SetCustomIcon
        pin.SetMoreInfoURL("http://technologeeks.com/e65/");

        };
 
    function errorHandler (err)
	{
		alert( err.message);
	}



try {
    navigator.geolocation.getCurrentPosition(positionHandler, errorHandler);
} catch (e) { alert (e);} 

function newDoc()
  {
  FB.logout(function(response) {
        // Person is now logged out
    });
  window.location.assign("http://test.geohangout.biz/facebooklogin.html")
  }

</script>
 <style > 
  #mapContainer {
    height: 220px  !important;
    width: 16% !important;
    border:5px solid black;
    position: absolute;
    top : 340px; left : 3.4%;
}
#logout{
	position: relative;
	top : 400px; left : 0px;
	
}
</style>
  
  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
  
  <script>
  $(function() {
    var 
      interest = $( "#interest" ),
      time=$ ('#time'),
      place = $( "#place" ),
      allFields = $( [] ).add(interest).add(time).add(place),
      tips = $( ".validateTips" );
 
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( o, n, min, max ) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + max + "." );
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp( o, regexp, n ) {
      if ( !( regexp.test( o.val() ) ) ) {
        o.addClass( "ui-state-error" );
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
 
    $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 350,
      width: 350,
      modal: true,
      buttons: {
        "Post": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
 
          bValid = bValid && checkLength( interest, "interest", 0, 60 );
          bValid = bValid && checkLength( time, "time", 0, 80 );
          bValid = bValid && checkLength( place, "place", 0, 50 );
          bValid = bValid && checkRegexp( interest, /^[a-z]([0-9a-z_, !A-Z"])+$/i, "Incorrect Activity Input." );
         bValid = bValid && checkRegexp(time, /^([0-9a-z-: ])+$/i, "Incorrect time frame. ");
         bValid = bValid && checkRegexp( place, /^([0-9a-zA-Z,: ])+$/, "Invalid location." );
    
          if ( bValid ) {
			$("form#eventForm").submit();
            $( this ).dialog( "close" );
          }
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
 
    $( "#create-user" )
      .button()
      .click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });
  });
  </script>
</head>
<body>
<br>
<br>

<!- map  ->
  <div id="mapContainer" ></div>

<!-- search bar -->
<div class="light">
<form action="/posts/search" method="get">
<input type="text" name="interest" class="search rounded" style="margin-left:-60px;height:20px;width:180px;" placeholder="Search by interest"> 
<input type="text" name="place" class="search square" style="margin-top:-38px; margin-left:200px; height:20px;width:180px;" placeholder="Search by Location">


<input class="participation" type="submit" name="search" value="Search Now" style= "position:absolute; margin-top:-40px; margin-left:450px; width:100px; height:35px;" >

</form>

</div>

 <!--prfoile picture  -->
<img src= "/uploads/<?=$user->picture;?>" style = "height:192px; width:16%; position:absolute; margin-top:-20px; margin-left:2.8%; border: 5px solid black; "><br>
 
 
 <!--Ajax call-->
 
 
<!- pop up windows  >
<div class="pop_windows" id="dialog-form" title="Make an event">
  <p class="validateTips">All form fields are required.</p>
  <form name="eventForm" id="eventForm" method="post" action="/posts/p_add">
  <fieldset>
    <label for="interest">Activity</label>
    <input type="text" style="width:300px;" name="interest" id="interest" placeholder="Movie,Music" class="text ui-widget-content ui-corner-all">
    <label for="Time">Data and time</label>
    <input type="text" style="width:300px;" name="Time" id="time" placeholder="11:20am-2:20pm Nov 12th" class="text ui-widget-content ui-corner-all">
    <label for="place">Location</label>
    <input type="text" style="width:300px;" name="place" id="place" placeholder="Cambridge, MA" class="text ui-widget-content ui-corner-all">
    <br>
    
    <select>
  <option value="Public">Public</option>
  <option value="Familiy">Family</option>
  <option value="Harvard">Harvard</option>
  <option value="Close Friends">Close Friends</option>
</select>
  </fieldset>
  </form>
</div>
 
 
<div id='profilemenu' >
   <div id size="fontsize" style="color:#ffffff; font-size:40px; position:absolute; flow:left; margin-left:50px;">
			<strong>   Spur!</strong>
		</div>
	<div id ="mainpage" >
        
        <!-- Menu for users who are logged in -->
        <?php if($user): ?>
            <a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; float:right; margin-right:20px;" href='/users/logout'>Logout</a>
           
            <a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:25%;" href='/users/profile'>Profile</a>
            
			<button id ="create-user" style="padding:0px; font-size:15px; font-family:Arial; position:relative; margin-left:2%; margin-top:-1px;" >Add a post</button>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href='/posts/index'>View post<a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%" href='/posts/users'>Users<a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href ='/posts/followers'> Followers			<a>
			<a style="color:white; text-decoration:none; font-size:20px; font-family:Arial; position:relative; margin-left:2%;" href ='/posts/following'> Following	<a>
        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a href='/users/signup'>Sign Up</a>
            <a href='/users/index'>Log In</a>
        <?php endif; ?>
     </div>
       
</div>

<div style= "position:absolute; height:150px; font-size:13px; background-color:white; width:16.8%; margin-left:2.8%; margin-top:383px; z-index:-1; ">
<ul >
<li ><a href="" style="text-decoration:none;">Date <a></li>
<li ><a href="" style="text-decoration:none;">All Dates (756) <a></li>
<li><a href="" style="text-decoration:none;">Today (11) <a></li>
<li><a href="" style="text-decoration:none;">Tomorrow (7) <a></li>
<li><a href="" style="text-decoration:none;">This Week(17) <a>
<li><a href="" style="text-decoration:none;">This Weekend (17)<a>
<li><a href="" style="text-decoration:none;">Next Week (136)<a>
<li ><a href="" style="text-decoration:none;">Next Month (261)<a>
</ul>
</div>

<br>

<!- bulletin board- >
<div id ='windows'>
  <h1 style="font-family:Arial; font-size:20px;">Current Posts:</h1>
<?php foreach($posts as $post): ?>

<!-- each post -->
<div id = "box" style="border: 2px solid black; background-color:e1d9da; font-size:14px; width:80%; border-radius: 8px; -moz-border-radius: 4px; -webkit-border-radius: 4px; margin-left:5%;">

   <img src= "/uploads/<?=$post['picture'];?>" style = "position:relative; float:left; height:65px; width:65px;">    
    
    <!-- activity content -->
    <div style="position:relative; text-align:center;">      
    Activity: <strong > <?=$post['interest']?> </strong><br>
    Time: <?=$post['time']?><br>
    Place: <?=$post['place']?> <br>
    <time style="margin-left:2%; color:#BDBDBD;" datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
        <?=Time::display($post['created'])?>
    </time>
    </div>
     
    <div id="name" style="postion:relative; overflow:hidden;">
    <strong style="color:#819FF7; float:bottom; float:left;"><?=$post['first_name']?> <?=$post['last_name']?> </strong>
   &nbsp;&nbsp;&nbsp;&nbsp;
    </time>
	</div>
			
    <div>

 <?php if(isset($join_connections[$post['post_id']])): ?>
    
    	<!-- If there exists a connection with this user, show a unfollow link -->		
		<div id="<?=$post['post_id']?>" class="jr-btn-container">
	     <a class = "jr-btn remove" id="<?=$post['post_id']?>"  href='/posts/remove/<?=$post['post_id']?>' >Remove</a>
	    </div>
             
    <!-- Otherwise, show the follow link -->
    <?php else: ?>
    
		<div id="<?=$post['post_id']?>" class="jr-btn-container">
	     <a class = "jr-btn join" id="<?=$post['post_id']?>"  href='/posts/join/<?=$post['post_id']?>' >Join</a>
	    </div>
	             
    <?php endif; ?>




    <?php if(isset($join_connections[$post['post_id']])): ?>
    
    	<!-- If there exists a connection with this user, show a unfollow link -->		
		<div id="<?=$post['post_id']?>" style= "position:relative; float:right; margin-top:-10%; margin-right:5%; padding:3px; color:red;">
	     <a class = "remove" style= "position:relative; float:right; margin-top:-10%; margin-right:5%; padding:3px;" id="<?=$post['post_id']?>"  href='/posts/remove/<?=$post['post_id']?>' >Remove</a>
	     </div>
             
    <!-- Otherwise, show the follow link -->
    <?php else: ?>
    
	    <div id="<?=$post['post_id']?>" style= "position:relative; float:right; margin-top:-10%; margin-right:5%; padding:3px; color:red;">
	     <a class = "join-button" style= "position:relative; float:right; margin-top:-10%; margin-right:5%; padding:3px;" id="<?=$post['post_id']?>"  href='/posts/join/<?=$post['post_id']?>' >Join</a>
	     </div>
         
    <?php endif; ?>
                       
    <a style="position:relative; float:right; margin-top:-5%; margin-right:5%; " href="mailto:<?=$post['email']?>?Subject=[Spur]%20I%20want%20to%20join%20you"" target="_top">Send Mail</a>
         
       </div>             
   </div>
<br>
<?php endforeach; ?>

<script>

$('.join-button').click(function(event) {

	event.preventDefault();
	console.log(event.target.id);
    $.ajax({
        type: 'POST',
        data: {
        	id: event.target.id
        },
        url: '/posts/join',
        success: function(response) {
          if (response == 'false') {
            console.log('an error returns');
            return;
          } else {
            console.log(response);
            var str = '<a href="/something/add/">' + response + '</a>';
			$("#" + event.target.id).html("Remove");
          } 
            
        }
    }); // end ajax setup
});

$('.remove').click(function(event) {

	event.preventDefault();
	console.log(event.target.id);
    $.ajax({
        type: 'POST',
        data: {
        	id: event.target.id
        },
        url: '/posts/remove',
        success: function(response) {
          if (response == 'false') {
            console.log('an error returns');
            return;
          } else {
            console.log(response);
            var str = '<a href="/something/add/">' + response + '</a>';
			$("#" + event.target.id).html("Join");
          } 
            
        }
    }); // end ajax setup
});


</script>


</div>
