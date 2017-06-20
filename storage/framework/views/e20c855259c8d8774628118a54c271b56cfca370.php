<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 60%;
        width: 50%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      
      function initMap() {
   	
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 6
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            
        		var locations = <?php echo json_encode($makers); ?>;
      		  locations[locations.length] = ['sono qui!', pos.lat, pos.lng];
      		  
            map.setCenter(pos); //setta la posizione dell'utente al centro

            var marker, i;
            console.log(locations);
  		      for (i = 0; i < locations.length; i++) {  
  		        
              if(calculateDistance(pos,locations[i][1],locations[i][2]) <= 80){
                
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                  map: map
                
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                  return function() {
                    infoWindow.setContent(locations[i][0]);
                    infoWindow.open(map, marker);
                  }
                })(marker, i));  
              }     
  		      } 
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } 

        else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }


      function calculateDistance(position, latitude, longitude) {
        
        var lat1 = position.lat;
        var lon1 = position.lng;
 
        /*
        ** Se le coordinate sono uguali... e' inutile fare troppi calcoli!
        */
        if ((lat1 == latitude) && (lon1 == longitude))
          return 0;
 
        var DEG2RAD = Math.PI / 180.0;
        lat1 *= DEG2RAD;
        latitude *= DEG2RAD;
        lon1 *= DEG2RAD;
        longitude *= DEG2RAD;
 
        /*
        ** Calcolo la distanza in miglie nautiche
        */
        distance = (60.0 * ((Math.acos((Math.sin(lat1) * Math.sin(latitude)) + (Math.cos(lat1) * Math.cos(latitude) * Math.cos(longitude - lon1)))) / DEG2RAD));
        /*
        ** Converto le miglie nautiche in KM
        */
        distanceKM = distance / 0.5400734499891;
 
        return distanceKM;
      }

    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKE7vsMq2omJ9o5eAk9EEm2qvrInT36Ww&callback=initMap">
    </script>
  </body>
</html>

















