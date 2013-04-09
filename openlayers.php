<html>
<head>
  <title>OpenLayers Example</title>
    <script src='http://dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=6.1'></script>
    <script src="http://openlayers.org/api/OpenLayers.js"></script>
    </head>
    <body>
      <div style="width:100%; height:100%" id="map"></div>
      <script defer='defer' type='text/javascript'>
        var map = new OpenLayers.Map('map');
var layer = new OpenLayers.Layer.VirtualEarth("Virtual Earth",
 {
     sphericalMercator: true,
     maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34)
 });
map.addLayer(layer);
map.zoomToMaxExtent();
var proj = new OpenLayers.Projection("EPSG:4326");
var point = new OpenLayers.LonLat(-71, 42);
map.setCenter(point.transform(proj, map.getProjectionObject()));
      </script>
    </body>
</html>