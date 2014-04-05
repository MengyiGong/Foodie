<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=7" />
	<meta charset="utf-8">
	<title>Foodie Searcher</title>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	<script>
		var directionsDisplay;
		var directionsService = new google.maps.DirectionsService();
		var map;
		var start;
		var currentPosition;
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
		    start = latLng.lat() + ", " + latLng.lng();
		    directionsDisplay = new google.maps.DirectionsRenderer();
			var styles = [
			  {
			    featureType: "all",
			    stylers: [
			      { saturation: -80 }
			    ]
			  },{
			    featureType: "road.arterial",
			    elementType: "geometry",
			    stylers: [
			      { hue: "#00ffee" },
			      { saturation: 50 }
			    ]
			  },{
			    featureType: "poi.business",
			    elementType: "labels",
			    stylers: [
			      { visibility: "off" }
			    ]
			  }
			];
			  
			var styledMap = new google.maps.StyledMapType(styles,
			    {name: "Styled Map"});
			  
			  var mapOptions = {
			    zoom:15,
			    center: latLng,
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
			  }
			  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
			  //map.mapTypes.set('map_style', styledMap);
			  //map.setMapTypeId('map_style');
			  directionsDisplay.setMap(map);
		}

		function calcRoute(latLng) {
		  getMyLocation();
		  var end = document.getElementById('end').value; //æŠŠè¿™é‡Œçš„æ•°æ®æ¢æˆformä¸­çš„æ•°æ®å°±å¯ä»¥äº†
		  var request = {
		      origin:start,
		      destination:end,
		      travelMode: google.maps.TravelMode.DRIVING
		  };
		  directionsService.route(request, function(response, status) {
		    if (status == google.maps.DirectionsStatus.OK) {
		      directionsDisplay.setDirections(response);
		    }
		  });
		}
		google.maps.event.addDomListener(window, 'load', getMyLocation);
	</script>
	<meta name="description" content="" /><link rel="stylesheet" type="text/css" href="/F/css_common.css" />
	<script type="text/javascript"></script>
	<style type="text/css">
	        #map-canvas {  
	            height:600px;
	            margin-top:10px;
	        }
	</style>
</head>
<body onload="getMyLocation()">
	<style type="text/css">@import url("/F/css_index.css");</style>
	<div id="header">
	    <div class="mainmenu">
	        <div class="logo">
	            <a href="#"><img src="/F/img/1.jpg" alt="Foodie" title="Foodie"></a>
	        </div>
	        <div class="charmenu">
	            <div id="login_0">
	                <span class="arrow-ico">
						<?php
				
						  if(!isset($_SESSION['customer'])){
							  echo "<a href=\"/F/Customer_login.php\">Login</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"/F/Busi_login.php?tj=customer_register\">Register</a>";
						  }
						  else{
						  	  echo "Welcome </span>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"Customer.php\">".$_SESSION['customer']."</a>";
						  }
						  ?>
					
	            </div>
	        </div>
	        <div class="clear"></div>
	    </div>
		<nav> 
			<ul class="tabmenu">
			<li><a href="/F/index.php" >Home</a></li> 
			<li><a href="/F/news.php" >News</a></li> 
			<li><a href="/F/indexMap.php" >Map</a></li> 
			<li><a href="coupon.php" >Coupon</a></li> 
			<li><a href="/F/FF/category.php" >Find your favourite</a></li> 
			<ul> 
		</nav>    
	</div>
	<div id="body">
	    <div class="ix_foo">
	    	<div id="panel">
	    <b>Place: &nbsp; </b>
		<input type="text" id="end" x-webkit-speech="x-webkit-speech"/>
		<button onclick=calcRoute()  style="position: relative; color:red ">Search</button>
	    </div>
	        <div id="map-canvas" title="route map"></div>
	    </div>
	</div>
	<div id="adv_1_content" style="display:none;">
		<div class="ix_foo"></div>
	</div>
	<div id="footer">
	    <div>
	         Powered by <span>Foodie</span>
			<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
	    </div>
	</div>
</body>
</html>