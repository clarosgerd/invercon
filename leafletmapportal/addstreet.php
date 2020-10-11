<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>

<?php

// Create instance of the database helper class by DbHelper() (for main database) or DbHelper("<dbname>") (for linked databases) where <dbname> is database variable name
if (!isset($_POST["id"]))
{
    $filter = "`id_avaluo`='0'";
    $filterdoc = "avaluo.id='0'";
    $filterpago = "avaluo.id='0'";
}else{
    $filter = "`id_avaluo`='".ew_AdjustSql($_GET["id"])."'";
    $filterdoc = "avaluo.id='".ew_AdjustSql($_GET["id"])."'";
    $filterpago = "avaluo.id='".ew_AdjustSql($_GET["id"])."'";
}
?>
<title>Agregar una callet</title>
  <script src="js/jquery.min.js"></script>
  <link rel="stylesheet" href="css/leaflet.css" />
  <script src="js/leaflet.js"></script>
 </head>
 <body>
  <div id="map" style="width: 600px; height: 400px"></div><br />
  <input type="button" onclick="drawStreet();" value="Draw a street" /> <input type="button" onclick="resetStreet();" value="Clear map" /><br />
  <p>Para agregar un punto de calle, haga clic en el mapa. Para eliminar un punto de calle, haga clic en él nuevamente.</p>
  <form action="addstreetdb.php" method="post">
   <h1>Agregar una nueva calle</h1>
   <table cellpadding="5" cellspacing="0" border="0">
    <tbody>
     <tr align="left" valign="top">
      <td align="left" valign="top">nombre de la calle</td>
      <td align="left" valign="top"><input type="text" name="street" /></td>
     </tr>
     <tr align="left" valign="top">
      <td align="left" valign="top">Ubicaciones geográficas</td>
      <td align="left" valign="top">
       <textarea id="geo" name="geo"></textarea>
       <br /><input type="button" onclick="getGeoPoints();" value="Collect points" />
      </td>
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
 // var map = L.map('map').setView([51.505, -0.09], 13);
   var polyLine;
   var draggableStreetMarkers = new Array();

 var map = L.map('map').setView([-17.391,-66.164], 13);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZ2VyZGNsYXJvcyIsImEiOiJjazlyNnI5c3QwcHcyM2ZydHdkc2Vmc3JvIn0.O8BQWPG68qWbDXzyhxij_Q', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery � <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11',
		tileSize: 512,
		zoomOffset: -1
	}).addTo(map);
   
   function resetStreet() {
    if(polyLine != null) {
     map.removeLayer( polyLine );
    }
    for(i=0; i< draggableStreetMarkers.length; i++) {
     map.removeLayer( draggableStreetMarkers[i] );
    }
    draggableStreetMarkers = new Array();
   }
   
   function addMarkerStreetPoint( latLng ) {
    var streetMarker = L.marker( [latLng.lat, latLng.lng], { draggable: true, zIndexOffset: 900}).addTo(map);

    streetMarker.arrayId = draggableStreetMarkers.length;

    streetMarker.on('click', function() {
     map.removeLayer( draggableStreetMarkers[ this.arrayId ]);
     draggableStreetMarkers[ this.arrayId ] = "";
    });

    draggableStreetMarkers.push( streetMarker );
   }
   
   function drawStreet() {
    if(polyLine != null) {
     map.removeLayer( polyLine );
    }

    var latLngStreets = new Array();

    for(i=0; i < draggableStreetMarkers.length; i++) {
     if(draggableStreetMarkers[i]!="") {
      latLngStreets.push( L.latLng( draggableStreetMarkers[ i ].getLatLng().lat, draggableStreetMarkers[ i ].getLatLng().lng));
     }
    }

    if(latLngStreets.length > 1) {
     // create a red polyline from an array of LatLng points
     polyLine = L.polyline( latLngStreets, {color: 'red'} ).addTo(map);
    }

    if(polyLine != null) {
     // zoom the map to the polyline
     map.fitBounds( polyLine.getBounds() );
    }
   }
   
   function getGeoPoints() {
    var points = new Array();
    for(var i=0; i < draggableStreetMarkers.length; i++) {
     if(draggableStreetMarkers[i] != "") {
      points[i] =  draggableStreetMarkers[ i ].getLatLng().lng + "," + draggableStreetMarkers[ i ].getLatLng().lat;
     }
    }
    $('#geo').val(points.join(','));
   }
   
   $( document ).ready(function() {
    map.on('click', function(e) {
     addMarkerStreetPoint( e.latlng );
    });
   });
  </script>