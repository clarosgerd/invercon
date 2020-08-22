<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php
$conn = ew_Connect();
?>
<head>
 <title>Agregar un área</title>
 <script src="js/jquery.min.js"></script>
 <link rel="stylesheet" href="css/leaflet.css" />
 <script src="js/leaflet.js"></script>
</head>
<body>
 <div id="map" style="width: 800px; height: 600px"></div><br />
 <input type="button" onclick="drawArea();" value="Dibujar area" /> <input type="button" onclick="resetArea();" value=Limpiar Mapa" /><br />
 <p>Para agregar un punto de área, haga clic en el mapa. Para eliminar un punto de área, haga clic en él nuevamente.</p>
 <form action="addareadb.php" method="post">
  <h1>Agregar una nueva área</h1>
  <table cellpadding="5" cellspacing="0" border="0">
   <tbody>
    <tr align="left" valign="top">
     <td align="left" valign="top">Nombre area</td>
     <td align="left" valign="top"><input type="text" name="area" /></td>
    </tr>
    <tr align="left" valign="top">
     <td align="left" valign="top">Ubicaciones geográficas</td>
     <td align="left" valign="top"><textarea id="geo" name="geo"></textarea>
            <br /><input type="button" onclick="getGeoPoints();" value="Collect points" /></td>
    </tr>
	<tr align="left" valign="top">
	  <td align="left" valign="top">Palabras clave</td>
	  <td align="left" valign="top"><textarea name="keywords"></textarea></td>
	</tr>
    <tr align="left" valign="top">
     <td align="left" valign="top"></td>
     <td align="left" valign="top"><input type="submit" value="Save"></td>
    </tr>
   </tbody>
  </table>
 </form>
 <script>
 
  var map = L.map('map').setView([-17.391,-66.164], 13);
  var polygon;
  var draggableAreaMarkers = new Array();

  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZ2VyZGNsYXJvcyIsImEiOiJjazlyNnI5c3QwcHcyM2ZydHdkc2Vmc3JvIn0.O8BQWPG68qWbDXzyhxij_Q', {
		maxZoom: 21,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery  <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);
   
  function resetArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }
   for(i=0; i < draggableAreaMarkers.length; i++) {
    map.removeLayer( draggableAreaMarkers[i] );
   }
   draggableAreaMarkers = new Array();
  }
  
  function addMarkerAreaPoint(latLng) {
   var areaMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900 }).addTo(map);
   
   areaMarker.arrayId = draggableAreaMarkers.length;

   areaMarker.on('click', function() {
    map.removeLayer( draggableAreaMarkers[ this.arrayId ]);
    draggableAreaMarkers[ this.arrayId ] = "";
   });

   draggableAreaMarkers.push( areaMarker );
  }
  
  function drawArea() {
   if(polygon != null) {
    map.removeLayer( polygon );
   }

   var latLngAreas = new Array();

   for(i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[ i ]!="") {
     latLngAreas.push( L.latLng( draggableAreaMarkers[ i ].getLatLng().lat, draggableAreaMarkers[ i ].getLatLng().lng));
    }
   }

   if(latLngAreas.length > 1) {
    // create a blue polygon from an array of LatLng points
    polygon = L.polygon( latLngAreas, {color: 'blue'}).addTo(map);
   }

   if(polygon != null) {
    // zoom the map to the polygon
    map.fitBounds( polygon.getBounds() );
   }
  }
  
  function getGeoPoints() {
   var points = new Array();
   for(var i=0; i < draggableAreaMarkers.length; i++) {
    if(draggableAreaMarkers[i] != "") {
     points[i] =  draggableAreaMarkers[ i ].getLatLng().lng + "," + draggableAreaMarkers[ i ].getLatLng().lat;
    }
   }
   $('#geo').val(points.join(','));
  }
  
  $( document ).ready(function() {
   map.on('click', function(e) {
    addMarkerAreaPoint( e.latlng);
   });
  });
 </script>
