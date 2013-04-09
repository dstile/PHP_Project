<!DOCTYPE HTML>

<?php
require_once 'classes/membership.php';
require_once 'classes/contentgenerator.php';
require_once 'includes/constants.php';
$membership = new Membership();
$membership->confirm_member();
?>
	
<html lang="en">
<head>
    <title>StileLog Home</title>
    <meta charset="utf-8">
    <style type="text/css" media="all">@import "css/master.css";</style> 
	
	<script src="jquery.js"></script> 
	<script type="text/javascript" src="htmldomgenerator.js"></script>
	<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
		
</head>

<body onload="init();">
	
 <div id="page-container">

	<div id="header-box">
		<div id="logo">
			<img src="images/pics/stilelog_logo.png" alt="StileLog Logo"/>
		</div>
		
		<div id="options"> 
			<a href="login.php?status=logout">Log Out</a>
				<div id="project-creation"> 
					<a href="createproj.php"><img src="images/pics/button.jpg" alt="Project Creatino Button" style="margin:auto;display:block"/></a>	
				</div>
		</div>
		<div id="title">
			<p><font size="8" COLOR="#000000" face="segoe print">StileLog</font></p>
			<p><font size="4" COLOR="#000000" face="segoe print">Take the First Step and Get Lost in it!</font></p>
		</div>
	</div>
	<div id="spacer1">
	<p></p>
	</div>
	<div id="selection-box">		
		<!--Child Div and Parent Div control the coloring of tabs-->
                <div id="spout-selector" class="parentDiv">
                    <div id="spout-selector-button" class="childDiv" style="background-color: #D94E67">
                    Explore
                    </div>
                    <div id="spout-selector-button" class="childDiv">
                    User Spout
                    </div>
			
		</div>	
		
		<div id="community-selector"> 
			<div id="community-selector-button">
			Region Selector
			</div>
                            
                        <div id="test" class="hidden">
                            
                            <div id="Map" style="height:400px; width: 100%" alt="citymap"></div>
                        </div>    
                </div>   
		
	
		<div id="navigation-selector" class="parentDiv"> 
			
				<div id="tabtest" class="childDiv" style="background-color: #D94E67">
					My Projects
				</div>
			
				
				<div id="tabtest" class="childDiv">
					Research
				</div>
			
			
				<div id="tabtest" class="childDiv">
					Events
				</div>
		</div>
	</div>	
	<div id="spacer2">
	<p></P>
	</div>
	<div id="topic-container" class="parentDiv">
		
		<div id="topic-right">		
			<div id="topic-tabs" class="childDiv" style="background-color: #D94E67">
				<div id="cell" >
					<p class="css-vertical-text">ALL</p>	
				</div>
			</div>	
	
			<div id="topic-tabs"  class="childDiv">
				<div id="cell">
					<p class="css-vertical-text">Visual Arts</p>		
				</div>
			</div>

			<div id="topic-tabs" class="childDiv">
				<div id="cell" >
					<p class="css-vertical-text">Media</p>	
				</div>
			</div>
		</div>	
	</div>
	<div id="project-content">	
		<div id="topic-sum"> 

				<h2><strong>StileLog HIGHLIGHTS</strong> </h2>
				
		</div>
		
		<script type="text/javascript">
			var topicnumber = <?php echo topicnumber; ?> //passing php results into javascript code.  Topic number is defined in global constants
			var topicorderArray = new Array();
			var topicnameArrayjs = new Array();
			var projinfoArrayjs = new Array();
			var artistpicArrayjs = new Array();
			
			//This function generates all of the project content and places it in arrays
			<?php
			$congen = new Congen();
			$congen->proj_highlight_box_content();
			?>
			//This function generates the DOM structure and links it to the project content generated above
			document.show(gen_all_boxes(topicnumber, topicorderArrayjs, topicnameArrayjs, projinfoArrayjs, artistpicArrayjs));
		</script>	
	</div>
		
	
		 
	<div id="footer">
		<div id="altnav">
			<a href="CreateProj">About</a> - 
			<a href="#">Contact Us</a> - 
			<a href="#">Terms and Conditions (Legal)</a>
		</div>
		Copyright © StileLog
	</div>
</div>


	<script>
		$(document).ready(function(){
		$('#community-selector-button').click(function() {
			if($("#test").is(":hidden")) 
			{
				$("#test").slideDown("#test");
                                
			} else{
				$("#test").slideUp("slow");
			}	
			});
			});
        
                $('.childDiv').click(function(){
                
                $(this).parent().find('.childDiv').css('background-color','#DCDCDC');
                $(this).css('background-color','#D94E67');
                });
        </script>
        <script>
	
        // Determine support for Geolocation
        if (navigator.geolocation) {
         // Locate position
         navigator.geolocation.getCurrentPosition(displayPosition, errorFunction);
        } else {
         alert('It seems like Geolocation, which is required for this page, is not enabled in your browser. Please use a browser which supports it.');
        }
        
        // Success callback function
        function displayPosition(pos) {
        var map, layer;
        var mylat = pos.coords.latitude;
        var mylong = pos.coords.longitude;
  
        //Load OSM Maps
        var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
        var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection

        var position = new OpenLayers.LonLat(mylong,mylat).transform(fromProjection,toProjection);
        var boundoff = 0.002;
        var maxboundoff = 1;
        var bounds = new OpenLayers.Bounds(mylong-boundoff, mylat-boundoff, mylong+boundoff, mylat+boundoff).transform(fromProjection,toProjection);
        //var maxbounds = new OpenLayers.Bounds(mylong-maxboundoff, mylat-maxboundoff, mylong+maxboundoff, mylat+maxboundoff).transform(fromProjection,toProjection);
        var options = {
          maxScale: 10000000
        };
       
       map = new OpenLayers.Map("Map", options);
       // var layer = new OpenLayers.Layer.MapServer( "OpenLayers WMS",
       //"http://labs.metacarta.com/wms/vmap0", {layers: 'basic'} );
        layer = new OpenLayers.Layer.OSM("Denver View");
        map.addLayer(layer);
   
        map.setCenter(position);
        map.zoomToExtent(bounds);

      //Add Marker  
        var markersLayer = new OpenLayers.Layer.Markers("My Current Location");
        var iconSize =  new OpenLayers.Size(20,20);
        var iconOffset = new OpenLayers.Pixel(-(iconSize.w/2), -iconSize.h);
        var marker = new OpenLayers.Marker(position);
        markersLayer.setVisibility(true);
        markersLayer.addMarker(marker);
        map.addLayer(markersLayer);
      }

    var positionTimer = navigator.geolocation.watchPosition(
    function( position ){
 
    // Log that a newer, perhaps more accurate
    // position has been found.
    console.log( "Newer Position Found" );

    // Set the new position of the existing marker.
    updateMarker(locationMarker,position.coords.latitude,position.coords.longitude,"Updated / Accurate Position");

    }
    );


    // If the position hasn't updated within 5 minutes, stop
    // monitoring the position for changes.
    setTimeout(function(){
    // Clear the position watcher.
    navigator.geolocation.clearWatch( positionTimer );
    },
    (1000 * 60 * 5)
    );
    // Error callback function
    function errorFunction(pos) {
        alert('Error!');
    }
    


</script>
</body>
</html>
