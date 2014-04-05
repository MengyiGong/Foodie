<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places,weather&language=en-us"></script>
    
<?php
$keyword=" ";  

if (isset($_GET["keyword"])) {
   $word=$_GET["keyword"];
}

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("foodie", $con);


$result = mysql_query("SELECT * FROM business WHERE Busi_Name='".$word."'");


while($row = mysql_fetch_array($result))
  {
  ?>
	
  </script>
<script type="text/javascript">
var geocoder;
var map;
var query = "<?php echo $row['Busi_Address']?> <?php echo $row['Busi_City']?>"


function codeAddress() {
  geocoder = new google.maps.Geocoder();
  var myOptions = {
   zoom: 17,
   mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
  var address = query;
  geocoder.geocode({
   'address': address
  }, function(results, status) {
   if (status == google.maps.GeocoderStatus.OK) {
    map.setCenter(results[0].geometry.location);
    var marker = new google.maps.Marker({
     map: map,
     position: results[0].geometry.location
    });
    var infowindow = new google.maps.InfoWindow({
     content:address
    });
    infowindow.open(map, marker);
   } else {
    alert("Error reason: " + status);
   }
  });
}

</script>
</head>

<body onload="codeAddress()">
  <div id="map_canvas" style="width:325px; height:325px"></div>
</body>

<?php  }

mysql_close($con);
?>
