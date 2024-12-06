<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>KML Click Capture Sample</title>
    <style>
        html,
        body {
            height: 370px;
            padding: 0;
            margin: 0;
        }

        #map {
            height: 500px;
            width: 500px;
            overflow: hidden;
            float: left;
            border: thin solid #333;
        }

        #capture {
            height: 500px;
            width: 500px;
            overflow: hidden;
            float: left;
            background-color: #ECECFB;
            border: thin solid #333;
            border-left: none;
        }
    </style>
</head>

<body>
    <div id="map"></div>
    <div id="capture"></div>
    <script>
        var map;
        var src = 'https://beraca.mx/cdmx-demo.kml';

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(19.43558, -99.23679),
                zoom: 6,
                mapTypeId: 'terrain'
            });

            var kmlLayer = new google.maps.KmlLayer(src, {
                suppressInfoWindows: true,
                preserveViewport: false,
                map: map
            });
            kmlLayer.addListener('click', function(event) {
                var content = event.featureData.infoWindowHtml;
                var testimonial = document.getElementById('capture');
                testimonial.innerHTML = content;
            });
        }
    </script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuE_8IH3H_MvVSCOfiVImbvHVBeEp8JAM&callback=initMap">
    </script>
</body>

</html>

<!-- 
    AIzaSyDuE_8IH3H_MvVSCOfiVImbvHVBeEp8JAM
cdmx-demo.kml 
-->

<!-- <!DOCTYPE html>
<html>

<head>
    <title>Google Maps KML Example</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuE_8IH3H_MvVSCOfiVImbvHVBeEp8JAM&callback=initMap">
    </script>

    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {
                    lat: 19.4326,
                    lng: -99.1332
                } // Coordenadas de la Ciudad de México
            });

            var ctaLayer = new google.maps.KmlLayer({
                url: 'cdmx-demo.kml',
                map: map
            });
        }
    </script>

</body>

</html> -->