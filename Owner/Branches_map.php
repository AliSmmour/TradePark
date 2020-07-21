<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.60.0/maps/maps.css">
	<link rel="stylesheet" type="text/css" href="https://api.tomtom.com/maps-sdk-for-web/5.x/5.60.0//examples/pages/examples/assets/ui-library/index.css">
	<script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.60.0/maps/maps-web.min.js"></script>
	<script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/5.x/5.60.0//examples/pages/examples/assets/js/mobile-or-tablet.js"></script>
	<style type="text/css">
		
        
        .marker {
            height: 30px;
            width: 30px;
        }
        .marker-content {
            background: #c30b82;
            border-radius: 50% 50% 50% 0;
            height: 30px;
            left: 50%;
            margin: -15px 0 0 -15px;
            position: absolute;
            top: 50%;
            transform: rotate(-45deg);
            width: 30px;
        }
        .marker-content::before {
            background: #A50E0E;
            border-radius: 50%;
            content: "";
            height: 24px;
            margin: 3px 0 0 3px;
            position: absolute;
            width: 24px;
        }
    
        html {
            height:100%;
        }
	</style>
	<title></title>
</head>
<body>
    <div id='map' class='map'></div>
    
    
    
    
   <script>
  // Define your product name and version.
tt.setProductInfo('Codepen Examples', '${analytics.productVersion}');
var map = tt.map({
    key: 'boMQLeZcpXCBtVHnAdz8v7TYLBWtiW0E',
    container: 'map',
    style: 'tomtom://vector/1/basic-main',
    dragPan: !isMobileOrTablet(),
    center: [35.945819, 31.958064],
    zoom: 6
});
map.addControl(new tt.FullscreenControl());
map.addControl(new tt.NavigationControl());
function createMarker(icon, position, color, popupText) {
    var markerElement = document.createElement('div');
    markerElement.className = 'marker';
    var markerContentElement = document.createElement('div');
    markerContentElement.className = 'marker-content';
    markerContentElement.style.backgroundColor = color;
    markerElement.appendChild(markerContentElement);
    var iconElement = document.createElement('div');
    iconElement.className = 'marker-icon';
    iconElement.style.backgroundImage =
        'url(https://api.tomtom.com/maps-sdk-for-web/5.x/assets/images/' + icon + ')';
    markerContentElement.appendChild(iconElement);
    var popup = new tt.Popup({offset: 30}).setText(popupText);
    // add marker to map
    new tt.Marker({element: markerElement, anchor: 'bottom'})
        .setLngLat(position)
        .setPopup(popup)
        .addTo(map);
}

<?php
$conn = mysqli_connect("localhost","root","","tradepark");
$sql = "SELECT * FROM `branch` where ownID='".$_SESSION['ownID']."'";
$result = mysqli_query($conn,$sql) ;
while ($row=mysqli_fetch_assoc($result))
 {
 	$Bname=$row['BName'];
 	$BLat=$row['BLat'];
 	$Blng=$row['Blng'];
	echo "createMarker('', [".$Blng.",". $BLat."], '#EA4335', '".$Bname."');";
 }
 ?>


   </script> 
    
</body>
</html>