$(document).ready(function(){
	$('#content_area').load($('.menu_top:first').attr('href'));
});

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


//pop up windows
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
      height: 500,
      width: 500,
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
 
//date picker 
  $(function() {
    $( "#date" ).datepicker({dateFormat: "D MM dd, yy"});
  });
 
  
//Bing Map

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


//  toggle between join button and remove button
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
	            alert("An email was sent");
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

//activity input auto complete

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


//Google Places API helps users fill in the information.

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