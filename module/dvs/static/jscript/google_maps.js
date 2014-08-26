$(document).ready(function() {
	if (!bPreview && bIsDvs) {
		var geoMap;
		var bounds = new google.maps.LatLngBounds();
	}

	function initializeGeoMap()
	{
		var mapOptions = {
			zoom: parseInt(window.aSettings['zoom'], 5),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		geoMap = new google.maps.Map(document.getElementById("dvs_geomap_container"), mapOptions);

		infoWindow = new google.maps.InfoWindow({
			maxWidth: 230,
			maxHeight: 210
		});

	}

	function createMarker(myLatLng, infoWindowHtml)
	{
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
			if (geoMap.getZoom() == 21 && parseInt(window.aSettings['zoom'], 10) != 21) {
				geoMap.setZoom(parseInt(window.aSettings['zoom'], 10));
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

	if (!bPreview && bIsDvs) {
		initializeGeoMap();

		var latlng = new google.maps.LatLng(window.aSettings['latitude'], window.aSettings['longitude']);

		createMarker(latlng, window.aSettings['infoWindow']);
	}
});