<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.60.0/maps/maps.css">
  <link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/5.x/5.60.0//examples/pages/examples/assets/ui-library/index.css">
  <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.60.0/maps/maps-web.min.js"></script>
  <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/5.x/5.60.0//examples/pages/examples/assets/js/mobile-or-tablet.js"></script>
  <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/5.x/5.60.0//examples/pages/examples/assets/js/formatters.js"></script>

</head>
<body>
    <div style="height: 100%;" id='map' class='map'></div>
    <input type="hidden" name="iloc" id="iloc">
    
   
</body>



<script type="text/javascript">
      // Define your product name and version
tt.setProductInfo('Codepen Examples', '${analytics.productVersion}');
var center = [35.945819, 31.958064];
var roundLatLng = Formatters.roundLatLng;
// Create map
var map = tt.map({
    key: 'hoedKdHwWklJgEXA02AJKHOpViRzDOu5',
    container: 'map',
    style: 'tomtom://vector/1/basic-main',
    zoom: 8,
    center: center,
    dragPan: !isMobileOrTablet()
});
map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());
new tt.Popup({ className: 'tt-popup'})
    .setLngLat(center)
    .setHTML('Please pin your address')
    .addTo(map);
map.on('click', function(event) {
    var lngLat = new tt.LngLat(roundLatLng(event.lngLat.lng), roundLatLng(event.lngLat.lat));
    document.getElementById("iloc").value = lngLat;
    new tt.Popup({ className: 'tt-popup'})
        .setLngLat(lngLat)
        .setHTML(lngLat.toString())
        .addTo(map);

});

    </script>
</html>
