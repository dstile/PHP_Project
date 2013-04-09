<?php
?>
<script type="text/javascript">
// Determine support for Geolocation
if (navigator.geolocation) {
    // Locate position
    navigator.geolocation.getCurrentPosition(displayPosition, errorFunction);
} else {
    alert('It seems like Geolocation, which is required for this page, is not enabled in your browser. Please use a browser which supports it.');
}

// Success callback function
function displayPosition(pos) {
    var mylat = pos.coords.latitude;
    var mylong = pos.coords.longitude;
    var thediv = document.getElementById('locationinfo');
    thediv.innerHTML = '<p>Your longitude is :' +
        mylong + ' and your latitide is ' + mylat + '</p>';

//Load Google Map
var latlng = new google.maps.LatLng(mylat, mylong);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.HYBRID
    };
   
var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

//Add marker
var marker = new google.maps.Marker({
	     position: latlng, 
	     map: map, 
	     title:"You are here"
	 });
}

// Error callback function
function errorFunction(pos) {
    alert('Error!');
}
</script>

<head>
    <style type="text/css">
        html, body {
        width: 100%;
        height: 100%;
    }
    #map_canvas {
        height: 85%;
        width: 100%;
    }
    </style>
</head>
<body>
    <div id="map_canvas"></div>
    <div id="locationinfo"></div>
</body>