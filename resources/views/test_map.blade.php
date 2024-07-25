<!DOCTYPE html>
<html>
<head>
    <title>Test Leaflet Map</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; width: 100%; }
    </style>
</head>
<body>
    <div id="map"></div>
    <script>
        var map = L.map('map').setView([48.8588443, 2.2943506], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        L.marker([48.8588443, 2.2943506]).addTo(map)
            .bindPopup('Eiffel Tower')
            .openPopup();
    </script>
</body>
</html>
