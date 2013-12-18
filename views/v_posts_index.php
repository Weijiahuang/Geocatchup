<!--------------------------------------------------------------------------------------------------------------------------------
Bing Map
--------------------------------------------------------------------------------------------------------------------------------->
<script>
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


  <style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>

<!--------------------------------------------------------------------------------------------------------------------------------
pop up windows
--------------------------------------------------------------------------------------------------------------------------------->  
  
  <script>
  $(function() {
    var 
      interest = $( "#interest" ),
      date= $('#date'),
      time=$ ('#time'),
      place = $( "#place" ),      
      allFields = $( [] ).add(interest).add(date).add(time).add(place),
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
          bValid = bValid && checkLength( date, "interest", 0, 60 );
          bValid = bValid && checkLength( time, "time", 0, 80 );
          bValid = bValid && checkLength( place, "place", 0, 80 );
          bValid = bValid && checkRegexp( interest, /^[a-z]([0-9a-z_, !A-Z"])+$/i, "Incorrect Activity Input." );
          bValid = bValid && checkRegexp(date, /^([0-9a-z-:,/ ])+$/i, "Incorrect time");
          bValid = bValid && checkRegexp(time, /^([0-9a-z-:,/ ])+$/i, "Incorrect time");
          bValid = bValid && checkRegexp( place, /^([0-9a-zA-Z,: ])+$/, "Invalid location." );
    
          if ( bValid ) 
          {
              $("form#eventForm").submit();
              $( this ).dialog( "close" );
		  }
       },
       Cancel: function() 
       {
          $( this ).dialog( "close" );
       }
   },
   close: function() 
   {
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

<!----- map  -------->
  <div id="mapContainer" ></div>



<!-- search bar -->
<div class="light">
<form action="/posts/search" method="get">
<input type="text" name="interest" class="search rounded" style="margin-left:-60px;height:20px;width:180px;" placeholder="Search by interest" autocomplete="on"> 
<input type="text" name="place" class="search square" style="margin-top:-38px; margin-left:200px; height:20px;width:180px;" placeholder="Search by Location" autocomplete="on">


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
    <img id="project-icon" src="../img/default.jpg" class="ui-state-default" alt="">
    
    <input type="text" style="width:250px;" name="interest" id="interest" class="text ui-widget-content ui-corner-all">
    <input type="hidden" id="project-id">
<p id="project-description"></p>
    
    
    
    
    <label for="date">Date</label>
    <input type="text" style="width:180px; " name="date" id="date" value="<?= date("D, M, y")?>"  class="text ui-widget-content ui-corner-all">
    <input type="text" style="width:80px; postion:absolute; margin-left:200px; margin-top:-36px;" name="time" id="time" placeholder="Time?" class="text ui-widget-content ui-corner-all">
    
    <label for="place">Location</label>
    <input type="text" style="width:300px;" name="place" id="place" placeholder="Enter the location"
             onFocus="geolocate()" class="text ui-widget-content ui-corner-all">
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
<hr style="width:90%;">

<div id = "box" >

   <img src= "/uploads/<?=$post['picture'];?>" style = "position:relative; float:left; height:65px; width:65px;">    
    
    <!-- activity content -->
    <div style="position:relative; text-align:left; margin-left:20%;">      
    <strong id="activity">Activity:  <?=$post['interest']?> </strong><br>
    Time: <?=$post['date']?> <?=$post['time']?><br>
    Place: <?=$post['place']?> <br>
    <time style="color:#BDBDBD;" datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
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
	     <a class = "participation jr-btn" style="background:#459dcd;" href='<?=$post['post_id']?>' > Remove </a>
	    </div>
             
    <!-- Otherwise, show the follow link -->
    <?php else: ?>
    	
		<div id="<?=$post['post_id']?>" class="jr-btn-container">
	     <a class = "participation jr-btn" href='<?=$post['post_id']?>' >I want to join</a>
	    </div>
	             
    <?php endif; ?>

                       
    <a style="position:relative; float:right; margin-top:-5%; margin-right:5%; " href="mailto:<?=$post['email']?>?Subject=[Spur]%20I%20want%20to%20join%20you" target="_top">Send Mail</a>
         
       </div>             
   </div>
<?php endforeach; ?>



<script>

$('.jr-btn').click(function(e) {
    e.preventDefault()
    
    var lnk=$(this)
    
	        //alert(lnk.attr('href'))
    if(lnk.text()=='I want to join') {

	    $.ajax({
	        type: 'POST',
	        data: {
	        	id: lnk.attr('href')
	        },
	        url: '/posts/'+'join',
	        success: function(response) {
	        
	          if (response == 'false') {
	            console.log('an error returns');
	            return;
	          } else {
	          	$(e.target).css('background','#459dcd');
	            lnk.text('Remove')
	            
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
		        url: '/posts/'+'remove',
		        success: function(response) {
		          if (response == 'false') {
		            console.log('an error returns');
		            return;
		          } else {
		          	$(e.target).css('background','#9dce2c');		          		    
					  lnk.text('I want to join')
					  
		          } 
		            
		        }
		    }); 
    }
})
</script>

<script>
  $(function() {
    $( "#date" ).datepicker({dateFormat: "D, M, y"});
  });
    
</script>

</div>



<!--------------------------------------------------------------------------------------------------------------------------------
Google Address autocomplete API
--------------------------------------------------------------------------------------------------------------------------------->
    
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
    
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('place')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  
}

var place = autocomplete.getPlace();

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      autocomplete.setBounds(new google.maps.LatLngBounds(geolocation,
          geolocation));
    });
  }
}
// [END region_geolocation]

</script>

<body onload="initialize()">


<style>
  #project-label {
    display: block;
    font-weight: bold;
    margin-bottom: 1em;
  }
  #project-icon {
    float: left;
    height: 32px;
    width: 32px;
  }
  #project-description {
    margin: 0;
    padding: 0;
  }
  </style>
  <script>
  $(function() {
    var projects = [
      {
        value: "Movie",
        icon: "movie.png"
      },
      {
        value: "TV",
        icon: "TV.png"
      },
      {
        value: "Beer", 
        icon: "beer.png"
      }
    ];
 
    $( "#interest" ).autocomplete({
      minLength: 0,
      source: projects,
      focus: function( event, ui ) {
        $( "#interest" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#interest" ).val( ui.item.label );
        $( "#project-id" ).val( ui.item.value );
        $( "#project-icon" ).attr( "src", "../img/" + ui.item.icon ); 
        return false;
      }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "</a>" )
        .appendTo( ul );
    };
  });
  </script> 
  













