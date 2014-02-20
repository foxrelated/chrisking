var iCustomOverlayActive = 0;

function showOverlay(iOverlayId) {
	if (bDebug) {
		console.log('Overlay: Showing overlay: ' + iOverlayId);
	}
	resetOverlays();

	$("#dvs_overlay_" + iOverlayId).animate({
		bottom: 0
	},
	{
		duration: 1000,
		specialEasing: {
			bottom: "easeOutBack"
		},
		complete: function() {
		}
	});
}

function hideOverlay(iOverlayId) {
	if (bDebug) {
		console.log('Overlay: Hiding overlay: ' + iOverlayId);
	}
	$('#dvs_overlay_' + iOverlayId).css('bottom', 415);
	$("#dvs_overlay_" + iOverlayId).animate({
		bottom: 415
	},
	{
		duration: 500,
		specialEasing: {
			bottom: "easeOutBack"
		},
		complete: function() {
		}
	});
}

function resetOverlays() {
	// Make sure all overlays are hidden
	$('.dvs_overlay').css('bottom', 415);
	iCustomOverlayActive = 0;
	bOverlayHold = true;
}

function onProgress(oProgress) {
	// Overlay 1
	if (
		bCustomOverlay1 &&
		!bOverlayHold &&
		!iCustomOverlayActive &&
		oProgress.position >= iCustomOverlay1Start &&
		oProgress.position < (iCustomOverlay1Start + iCustomOverlay1Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		showOverlay(1);
		iCustomOverlayActive = 1;
	}

	if (
		bCustomOverlay1 &&
		!bOverlayHold &&
		iCustomOverlayActive == 1 &&
		oProgress.position > (iCustomOverlay1Start + iCustomOverlay1Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		hideOverlay(1);
		iCustomOverlayActive = 0;
	}

	// Overlay 2
	if (
		bCustomOverlay2 &&
		!bOverlayHold &&
		!iCustomOverlayActive &&
		oProgress.position >= iCustomOverlay2Start &&
		oProgress.position < (iCustomOverlay2Start + iCustomOverlay2Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		showOverlay(2);
		iCustomOverlayActive = 2;
	}

	if (
		bCustomOverlay2 &&
		!bOverlayHold &&
		iCustomOverlayActive == 2 &&
		oProgress.position > (iCustomOverlay2Start + iCustomOverlay2Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		hideOverlay(2);
		iCustomOverlayActive = 0;
	}

	// Overlay 3
	if (
		bCustomOverlay3 &&
		!bOverlayHold &&
		!iCustomOverlayActive &&
		oProgress.position >= iCustomOverlay3Start &&
		oProgress.position < (iCustomOverlay3Start + iCustomOverlay3Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		showOverlay(3);
		iCustomOverlayActive = 3;
	}

	if (
		bCustomOverlay3 &&
		!bOverlayHold &&
		iCustomOverlayActive == 3 &&
		oProgress.position > (iCustomOverlay3Start + iCustomOverlay3Duration)
		)
	{
		if (bDebug) {
			console.log('Overlay: Position: ' + oProgress.position);
		}
		hideOverlay(3);
		iCustomOverlayActive = 0;
	}

}