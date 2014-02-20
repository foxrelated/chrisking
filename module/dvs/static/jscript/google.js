$(document).ready(function() {
	var geoMap;
	var bounds = new google.maps.LatLngBounds();

	function initializeGeoMap()
	{
		var mapOptions = {
			zoom: parseInt(aSettings['zoom'], 10),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		geoMap = new google.maps.Map(document.getElementById("dvs_geomap_container"), mapOptions);

		infoWindow = new google.maps.InfoWindow({
			maxWidth: 200,
			maxHeight: 200
		});

	}

	function createMarker(myLatLng, infoWindowHtml) {

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: geoMap
		});

		google.maps.event.addListener(marker, "click", function() {
			infoWindow.setContent(infoWindowHtml);
			infoWindow.open(geoMap, marker);
		});

		bounds.extend(myLatLng);
		geoMap.fitBounds(bounds);

		zoomChangeBoundsListener = google.maps.event.addListenerOnce(geoMap, 'bounds_changed', function(event) {
			if (geoMap.getZoom() == 21 && parseInt(aSettings['zoom'], 10) != 21) {
				geoMap.setZoom(parseInt(aSettings['zoom'], 10));
			}
		});

		setTimeout(function() {
			google.maps.event.removeListener(zoomChangeBoundsListener);
		}, 2000);

		setTimeout(function() {
			infoWindow.setContent(infoWindowHtml);
			infoWindow.open(geoMap, marker);
		}, 3000);
	}

	initializeGeoMap();

	var latlng = new google.maps.LatLng(aSettings['latitude'], aSettings['longitude']);

	createMarker(latlng, aSettings['infoWindow']);
});