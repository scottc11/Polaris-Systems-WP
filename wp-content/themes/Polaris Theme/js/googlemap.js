function initMap() {

  var mapDiv = document.getElementById('google-maps');

  var myLongLat = {lat: 43.59709, lng: -79.74604};

  var map = new google.maps.Map(mapDiv, {
      center: {lat: 43.59709, lng: -79.74604},
      zoom: 11,
      styles: [
        {
          featureType: 'all',
          stylers: [
            { saturation: -80 }
          ]
        },{
          featureType: 'road.arterial',
          elementType: 'geometry',
          stylers: [
            { hue: '#00ffee' },
            { saturation: 50 }
          ]
        },{
          featureType: 'poi.business',
          elementType: 'labels',
          stylers: [
            { visibility: 'off' }
          ]
        }
      ]
  });

  var marker = new google.maps.Marker({
    position: myLongLat,
    map: map,
  });
}
