window.onload = getMyLocation;

var map;
var address;
var query;
var urhere;

var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function getMyLocation() {
	if (navigator.geolocation) {
		geolocation = window.navigator.geolocation;
        geolocation.getCurrentPosition(
                        getPositionSuccess, getPositionError, {
                            timeout : 5000
                        });
	} else {
		alert("your broswer is no geolocation support"); 
	}
}

function getPositionError(error) { 
	switch (error.code) { 
		case error.PERMISSION_DENIED:
			alert("location server is refused"); 
			break; 
		case error.POSITION_UNAVAILABLE:
			alert("cannot get the location infomation"); 
			break; 
		case error.TIMEOUT:
			alert("time out"); 
			break; 
		default: 
			alert("unknow error"); 
			break; 
	} 
}

function getPositionSuccess(position) {
	//The latitude and longitude values obtained from HTML 5 API.
  	var latitude = position.coords.latitude;
  	var longitude = position.coords.longitude;

  	//Creating a new object for using latitude and longitude values with Google map.
  	var latLng = new google.maps.LatLng(latitude, longitude);

  	var mapOptions = {
    	center: latLng,
    	zoom: 18,
    	mapTypeId: google.maps.MapTypeId.ROADMAP
  	};
  	//Creating the Map instance and assigning the HTML div element to render it in.
  	map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

  	addNearByPlaces(latLng);
  	createMarker(latLng); 
}

function addNearByPlaces(latLng) {
	var nearByService = new google.maps.places.PlacesService(map);

  	var request = {
    	location: latLng,
    	radius: 1000,
    	types: ['restaurant', 'bar', 'bakery', 'cafe']
  	};
  	nearByService.nearbySearch(request, handleNearBySearchResults);
}

function handleNearBySearchResults(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      var place = results[i];
      createMarker(place.geometry.location, place);
    }
  }
}

function createMarker(latLng, placeResult) {
  	if (placeResult) {
      var markerOptions = {
      position: latLng,
      map: map,
      animation: google.maps.Animation.DROP,
      clickable: true
    }
    //Setting up the marker object to mark the location on the map canvas.
    var marker = new google.maps.Marker(markerOptions);
    	var content = placeResult.name+"<br/>"+placeResult.vicinity+"<br/>"+placeResult.types;
    	addInfoWindow(marker, latLng, content);
  	}else {
        var markerMe = {
          position: latLng,
          map: map,
          animation:google.maps.Animation.BOUNCE,
          clickable: true
        }
       
        //Setting up the marker object to mark the location on the map canvas.
        var marker1 = new google.maps.Marker(markerMe);

        urhere = latLng.lat() + ", " + latLng.lng();
        var content = "You are here: " + urhere;
        addInfoWindow(marker1, latLng, content);
  	}
}

function addInfoWindow(marker, latLng, content) {
  	var infoWindowOptions = {
    	content: content,
    	position: latLng
  	};
  	var infoWindow = new google.maps.InfoWindow(infoWindowOptions);
  	google.maps.event.addDomListener(marker, "click", function() {
    	infoWindow.open(map);
  	});
}