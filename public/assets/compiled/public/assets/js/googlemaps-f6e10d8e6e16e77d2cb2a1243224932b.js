var geocoder;
var map;
function initialize() {
  geocoder = new google.maps.Geocoder();
  address = codeAddress();
  var latlng = new google.maps.LatLng(-34.397, 150.644);
  var mapOptions = {
    zoom: 15,
    center: latlng
  }
  map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
}

function codeAddress() {
  //var address = document.getElementById('address').value;
  var address = 'Zijldijk 130, 2352 AB, Leiderdorp';
  geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location,
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);