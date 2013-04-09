<!DOCTYPE HTML>
<html>
  <head>
    <title>OpenLayers Demo</title>
    <style type="text/css">
      html, body, #basicMap {
          width: 100%;
          height: 100%;
          margin: 0;
      }
    </style>
    <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
     <script type="text/javascript" src="./MapTesting.js"></script>
    <script>
      var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
      var toProjection  = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
     
      var button = new OpenLayers.Control.Button({
     displayClass: "MyButton", trigger: myFunction
     });
    panel.addControls([button]);
     
   /*  trigger: function(e) {
                    var thebox =  map.getExtent().transform(toProjection, fromProjection);
                    alert("The boundaries of the box are " + thebox);
                }*/
     
     /*OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {                
                defaultHandlerOptions: {
                    'single': true,
                    'double': false,
                    'pixelTolerance': 0,
                    'stopSingle': false,
                    'stopDouble': false
                },

                initialize: function(options) {
                    this.handlerOptions = OpenLayers.Util.extend(
                        {}, this.defaultHandlerOptions
                    );
                    OpenLayers.Control.prototype.initialize.apply(
                        this, arguments
                    ); 
                    this.handler = new OpenLayers.Handler.Click(
                        this, {
                            'click': this.trigger
                        }, this.handlerOptions
                    );
                }, 

                trigger: function(e) {
                    var thebox =  map.getExtent().transform(toProjection, fromProjection);
                    alert("The boundaries of the box are " + thebox);
                }

            });*/
     
     
     
     
     function init() {
        map = new OpenLayers.Map("basicMap");
        var mapnik         = new OpenLayers.Layer.OSM();
        var position       = new OpenLayers.LonLat(13.41,52.52).transform( fromProjection, toProjection);
        var zoom           = 15; 
 
        map.addLayer(mapnik);
        map.setCenter(position, zoom );
        
        var click = new OpenLayers.Control.Click();
                map.addControl(click);
                click.activate();
      }
      
    </script>
  </head>
  <body onload="init();">
    <div id="basicMap"></div>
     <input type="button" value="Return Box" 
                   onclick="returnbox();"
                    id="bbox">
  </body>
</html>