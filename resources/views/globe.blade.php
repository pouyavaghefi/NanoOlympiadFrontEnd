<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Globe - Company Location</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cesium/1.90/cesium.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cesium/1.90/Cesium/Widgets/widgets.css" rel="stylesheet">
</head>
<body style="margin: 0; overflow: hidden;">
<div id="cesiumContainer" style="width: 100%; height: 100vh;"></div>

<script>
    // Initialize the Cesium Viewer with the world terrain
    var viewer = new Cesium.Viewer('cesiumContainer', {
        terrainProvider: Cesium.createWorldTerrain()
    });

    // Company location coordinates (for example: San Francisco)
    var companyLat = 37.7749; // Latitude of San Francisco
    var companyLon = -122.4194; // Longitude of San Francisco
    var companyHeight = 1000; // Optional: Height to zoom more into the location

    // Add a pin to represent the company's location on the globe
    viewer.entities.add({
        position: Cesium.Cartesian3.fromDegrees(companyLon, companyLat, companyHeight),
        point: { pixelSize: 10, color: Cesium.Color.RED }
    });

    // Zoom to the company's location
    viewer.camera.flyTo({
        destination: Cesium.Cartesian3.fromDegrees(companyLon, companyLat, companyHeight * 2), // Adjust zoom
        duration: 3 // Smooth zoom effect
    });

    // Optional: Interactivity to click on locations
    viewer.screenSpaceEventHandler.setInputAction(function (movement) {
        var ray = viewer.camera.getPickRay(movement.endPosition);
        var location = viewer.scene.globe.pick(ray, viewer.scene);
        if (Cesium.defined(location)) {
            var cartographic = Cesium.Cartographic.fromCartesian(location);
            var longitude = Cesium.Math.toDegrees(cartographic.longitude);
            var latitude = Cesium.Math.toDegrees(cartographic.latitude);
            alert("You clicked on location: Latitude: " + latitude + ", Longitude: " + longitude);
        }
    }, Cesium.ScreenSpaceEventType.LEFT_CLICK);
</script>
</body>
</html>
