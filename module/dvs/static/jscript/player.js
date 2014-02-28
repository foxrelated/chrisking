var bcExp;
var modExp;
var modCon;
var modCue;
var modVid;
var modAds;
var cuepoints;
var queuedTime;
var sCurrentCuePoint;
var oCuePoints = {};
var oChapterDivs = {};
var bMediaBegin = false;
var bVideoChanged = false;
var bUrlChanged = false;
var aCurrentVideoMetaData = [];
var sPlayerName;
var iCurrentVideo = 0;
var aVideoSelectMediaIds = [];
var bPlaying;
var sCuePoint;
var bIgnoreAutoPlaySetting = false;
var oCustomVars = [];
//var bOverlayHold = false;

if (bDebug) {
	console.log('Page: ' + (bIsDvs ? 'DVS' : 'iDrive') + ' Browser Detected: ' + sBrowser);
}

//Watch overviews.  Resets MediaID array and plays video 0.
function watchOverviews() {
	aMediaIds = aOverviewMediaIds;
	playVideo(1);
//	$('#test_drive_playlist').hide('slow');
//	$('#video_select_playlist').hide('slow');
//	$('#overview_playlist').show('slow');
	if (bDebug) {
		console.log("Player: Switching to Overviews");
	}

	sendToGoogle(sPlayerName, 'Menu', 'Watch Overviews');
}

//Watch test drives.  Resets MediaID array and plays video 0.
function watchTestDrives() {
	aMediaIds = aTestDriveMediaIds;
	playVideo(0);
//	$('#overview_playlist').hide('slow');
//	$('#video_select_playlist').hide('slow');
//	$('#test_drive_playlist').show('slow');
	if (bDebug) {
		console.log("Switching to Test Drives");
	}

	sendToGoogle(sPlayerName, 'Menu', 'Watch Test Drives');
}

//Video manually selected.  Resets MediaID array and plays video 0.
function watchVideoSelect(aVideoSelectMediaIds) {
	bIgnoreAutoPlaySetting = true;
	bVideoChanged = true;
	aMediaIds = aVideoSelectMediaIds;

	playVideo(0);

//	$('#overview_playlist').hide('slow');
//	$('#test_drive_playlist').hide('slow');
//	$('#video_select_playlist').show('slow');
	if (bDebug) {
		console.log("Player: Switching to Video Select");
	}

	sendToGoogle('DVS Site', 'Menu', 'Video Select');

	if (bIsDvs) {
		resetOverlays();
	}
}

//Seek to new cue point if it's different than the one we're in, call cueChange
function changeCuePoint(sCuePoint) {
	if (sCurrentCuePoint !== sCuePoint && !$('#chapter_container_' + sCuePoint).hasClass('disabled')) {

		var oCustomVars = {
			1: {
				name: 'Video Reference ID',
				value: aCurrentVideoMetaData.referenceId
			},
			2: {
				name: 'Vehicle Year',
				value: aCurrentVideoMetaData.year
			},
			3: {
				name: 'Vehicle Make',
				value: aCurrentVideoMetaData.make
			},
			4: {
				name: 'Vehicle Model',
				value: aCurrentVideoMetaData.model
			},
			5: {
				name: 'Video Chapter',
				value: sCurrentCuePoint
			}
		};

		sendToGoogle(sPlayerName, 'Player', 'Chapter Clicked: ' + sCuePoint, oCustomVars);

		if (bDebug) {
			console.log('Media: Cuepoint Manually Changed to ' + sCuePoint);
		}
		seek(oCuePoints[sCuePoint]);
		cueChange(sCuePoint);
	}
	else
	{
		if (bDebug) {
			console.log('Media: Cuepoint already set: ' + sCuePoint);
		}
	}
}

function getPrice(iDvsId) {
	if (aCurrentVideoMetaData) {
//		$('#dvs_get_price_container').show('fast');
		

		var oCustomVars = {
			1: {
				name: 'Video Reference ID',
				value: aCurrentVideoMetaData.referenceId
			},
			2: {
				name: 'Vehicle Year',
				value: aCurrentVideoMetaData.year
			},
			3: {
				name: 'Vehicle Make',
				value: aCurrentVideoMetaData.make
			},
			4: {
				name: 'Vehicle Model',
				value: aCurrentVideoMetaData.model
			},
			5: {
				name: 'Video Chapter',
				value: sCurrentCuePoint
			}
		};

		sendToGoogle('DVS Site', 'Menu', 'Get Price', oCustomVars);
	}
	else
	{
		if (sBrowser === 'mobile') {
			alert('Please wait for a video to start.');
		} else {
			alert('Please wait for a video to load.');
		}
	}
}

function getPriceIDrive(iIDriveId) {
	if (aCurrentVideoMetaData) {
//		$('#idrive_get_price_container').show('fast');

		var oCustomVars = {
			1: {
				name: 'Video Reference ID',
				value: aCurrentVideoMetaData.referenceId
			},
			2: {
				name: 'Vehicle Year',
				value: aCurrentVideoMetaData.year
			},
			3: {
				name: 'Vehicle Make',
				value: aCurrentVideoMetaData.make
			},
			4: {
				name: 'Vehicle Model',
				value: aCurrentVideoMetaData.model
			},
			5: {
				name: 'Video Chapter',
				value: sCurrentCuePoint
			}
		};

		sendToGoogle(sPlayerName, 'Player', 'Menu', 'Get Price', oCustomVars);
	}
	else
	{
		if (sBrowser === 'mobile') {
			alert('Please wait for a video to start.');
		} else {
			alert('Please wait for a video to load.');
		}
	}
}

function getPriceExternal(sEmail) {
	if (aCurrentVideoMetaData) {
//		$('#idrive_get_price_container').show('fast');
	}
}

//function resetIDriveGetPriceForm() {
//	$('#idrive_contact_success').hide();
//	$('#idrive_contact_form').show();
//	$('#contact_name').val('');
//	$('#contact_email').val('');
//	$('#contact_phone').val('');
//	$('#contact_zip').val('');
//	$('#comments').val('');
//}

//Called when clicking a chapter or when the video rolls past a chapter, sets lights.
function cueChange(sCuePoint) {
	if (sCurrentCuePoint !== sCuePoint) {
		sCurrentCuePoint = sCuePoint;
		changeLights(sCuePoint);
	}
	else
	{
		if (bDebug) {
			console.log('Media: Cuepoint already set: ' + sCuePoint);
		}
	}

	if (!bVideoChanged && !bUrlChanged && !bPreview && bIsDvs) {
		window.parent.history.pushState("string", "", sFirstVideoTitleUrl);
		bUrlChanged = true;
	}

	if (sCuePoint === 'Post-roll') {
		// Handle chapter light states
		// Mediaevent "complete" doesn't fire on replays, so we need to make sure chapter lights are reset on a video replay here
		if (bDebug) {
			console.log('Player: Resetting chapter lights');
		}

		$.each(oChapterDivs, function(sChapter, sHtml) {
			$('#chapter_container_' + sChapter).attr('class', 'display disabled');
//			$('#chapter_light_disabled_' + sChapter).show();
//			$('#chapter_light_green_' + sChapter).hide();
//			$('#chapter_light_red_' + sChapter).hide();
//			$('#chapter_light_yellow_' + sChapter).hide();
		});
	}
}

//Plays a new video on video end
function playVideo(iVideoKey) {
	if (bDebug) {
		console.log('Player: Playing Video 2Key: ' + iVideoKey + ' from:');
		console.log(aMediaIds);
	}

	if (bIsDvs) {
		if (sBrowser !== 'mobile' && sBrowser !== 'ipad') {
			resetOverlays();
		}
	}

	if (sBrowser === 'mobile' || sBrowser === 'ipad') {

		console.log(modVid);
		console.log(modVid);

		modVid.loadVideoByID(aMediaIds[iVideoKey]);
		if (bDebug) {
			console.log('Player: Loading video...');
		}
	}
	else
	{
		modCon.getMediaAsynch(aMediaIds[iVideoKey]);
	}

	iCurrentVideo = iVideoKey;
}

//Auto called
function onTemplateLoaded(experienceID)
{
	if (bDebug) {
		console.log('Player: Template Loaded: ' + experienceID);
	}

	if (sBrowser === 'mobile' || sBrowser === 'ipad')
	{
		if (bDebug) {
			console.log('Player: Setting up Smart Player API');
		}

		bcExp = brightcove.api.getExperience(experienceID);
		// get references to the modules we'll need
		modExp = bcExp.getModule(brightcove.api.modules.APIModules.EXPERIENCE);
		modCon = bcExp.getModule(brightcove.api.modules.APIModules.CONTENT);
		modCue = bcExp.getModule(brightcove.api.modules.APIModules.CUE_POINTS);
		modVid = bcExp.getModule(brightcove.api.modules.APIModules.VIDEO_PLAYER);

		modVid.addEventListener(brightcove.api.events.CuePointEvent.CUE, onCuePointEvent);
		modVid.addEventListener(brightcove.api.events.MediaEvent.BEGIN, onVideoLoad);
		modVid.addEventListener(brightcove.api.events.MediaEvent.COMPLETE, onVideoEnd);

	}
	else
	{
		if (bDebug) {
			console.log('Player: Setting up Flash Only API');
		}

		bcExp = brightcove.getExperience(experienceID);

		// get references to the modules we'll need
		modExp = bcExp.getModule(APIModules.EXPERIENCE);
		modCon = bcExp.getModule(APIModules.CONTENT);
		modCue = bcExp.getModule(APIModules.CUE_POINTS);
		modVid = bcExp.getModule(APIModules.VIDEO_PLAYER);
		modMen = bcExp.getModule(APIModules.MENU);
		modSoc = bcExp.getModule(APIModules.SOCIAL);

		modExp.addEventListener(BCExperienceEvent.TEMPLATE_READY, onTemplateReady);
		modVid.addEventListener(BCCuePointEvent.CUE, onCuePointEvent);
		modCon.addEventListener(BCContentEvent.VIDEO_LOAD, onVideoLoad);
		modVid.addEventListener(BCMediaEvent.COMPLETE, onVideoEnd);

		if (bIsDvs) {
			modVid.addEventListener(BCMediaEvent.PROGRESS, onProgress);
		}
		setPlayerStyle();
	}

	if (bDebug) {
		console.log('Player: Set up.');
	}
	oChapterDivs['Intro'] = $('#chapter_container_Intro').html();
	oChapterDivs['WhatsNew'] = $('#chapter_container_WhatsNew').html();
	oChapterDivs['Power'] = $('#chapter_container_Power').html();
	oChapterDivs['Fuel'] = $('#chapter_container_Fuel').html();
	oChapterDivs['Features'] = $('#chapter_container_Features').html();
	oChapterDivs['Safety'] = $('#chapter_container_Safety').html();
	oChapterDivs['Pricing'] = $('#chapter_container_Pricing').html();
	oChapterDivs['Warranty'] = $('#chapter_container_Warranty').html();
	oChapterDivs['Summary'] = $('#chapter_container_Summary').html();
	oChapterDivs['Exterior'] = $('#chapter_container_Exterior').html();
	oChapterDivs['Interior'] = $('#chapter_container_Interior').html();
	oChapterDivs['Overview'] = $('#chapter_container_Overview').html();
	oChapterDivs['Performance'] = $('#chapter_container_Performance').html();
	oChapterDivs['MPG'] = $('#chapter_container_MPG').html();
	oChapterDivs['Honors'] = $('#chapter_container_Honors').html();
	if (!bPreview && bIsDvs || bIdriveGetPrice) {
		oChapterDivs['Get_Price'] = $('#chapter_container_Get_Price').html();
	}
//	$('#chapter_buttons').html('');
}

//Auto called
function onTemplateReady(oVideo) {

	if (bDebug) {
		console.log('Player: Template Ready.');
	}

	if (!aMediaIds[iCurrentVideo])
	{
		iCurrentVideo++;
	}

	if (bAutoplay) {

		if (sBrowser === 'mobile' || sBrowser === 'ipad') {
			modVid.loadVideoByID(aMediaIds[iCurrentVideo]);
		}
		else
		{
			modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
		}

		if (bDebug) {
			console.log('Player: Playing video: ' + aMediaIds[iCurrentVideo]);
		}
	}
	else
	{
		if (sBrowser === 'mobile' || sBrowser === 'ipad') {
			modVid.cueVideoByID(aMediaIds[iCurrentVideo]);
		}
		else
		{
			modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
		}

		if (bDebug) {
			console.log('Player: Cueing video: ' + aMediaIds[iCurrentVideo]);
		}

//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Intro' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Intro'] + '</div>');
//		$('#chapter_container_Intro').attr('class', 'disabled display');
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'WhatsNew' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['WhatsNew'] + '</div>');
//		$('#chapter_container_' + 'WhatsNew').show();
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Features' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Features'] + '</div>');
//		$('#chapter_container_' + 'Features').show();
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Power' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Power'] + '</div>');
//		$('#chapter_container_' + 'Power').show();
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Fuel' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Fuel'] + '</div>');
//		$('#chapter_container_' + 'Fuel').show();
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Warranty' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Warranty'] + '</div>');
//		$('#chapter_container_' + 'Warranty').show();
//		$('#chapter_buttons').append('<div id="chapter_container_' + 'Summary' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Summary'] + '</div>');
//		$('#chapter_container_' + 'Summary').show();
	}

	if (bIsDvs) {
		sPlayerName = 'DVS Player';
	} else {
		sPlayerName = 'iDrive Player';
	}

	sendToGoogle(sPlayerName, 'Player', 'Player Loaded');
}

//Called when any video loads.
//Closes the menu, clears chapter div, gets new cuepoints, builds new chapter divs, and shows them, closes menu again if need be, and plays loaded video
function onVideoLoad(oMedia) {
	if (bDebug) {
		console.log('Media: Video Load: ' + oMedia.media.displayName);
	}

	if (bIsDvs) {
		resetOverlays();
	}

	aCurrentVideoMetaData = oMedia.media.customFields;
	aCurrentVideoMetaData.id = oMedia.media.id;
	aCurrentVideoMetaData.referenceId = oMedia.media.referenceId;
	if (bDebug) {
		console.log('Media: Current Video Meta Data Follows:');
		console.log(aCurrentVideoMetaData);
	}

	if (!bMediaBegin) {
		if (!bPreRoll) {
			if (bDebug) {
				console.log('Media: No Preroll Set');
			}

			var oCustomVars = {
				1: {
					name: 'Video Reference ID',
					value: aCurrentVideoMetaData.referenceId
				},
				2: {
					name: 'Vehicle Year',
					value: aCurrentVideoMetaData.year
				},
				3: {
					name: 'Vehicle Make',
					value: aCurrentVideoMetaData.make
				},
				4: {
					name: 'Vehicle Model',
					value: aCurrentVideoMetaData.model
				}
			};

			sendToGoogle(sPlayerName, 'Player', 'Media Begin', oCustomVars);
		}
		else
		{
			if (bDebug) {
				console.log('Media: Preroll Set');
			}

			var oCustomVars = {
				1: {
					name: 'Video Reference ID',
					value: 'Pre-roll'
				}
			};

			sendToGoogle(sPlayerName, 'Player', 'Media Begin', oCustomVars);
		}

		bMediaBegin = true;
	}

	//modMen.closeMenuPage();

	//Workaround for BC player in mobile
	if (sBrowser === 'mobile' || sBrowser === 'ipad')
	{
		seek(0);
	}

	sCurrentCuePoint = '';
	if (bDebug) {
		console.log('Player: Hiding all chapters');
	}

//	$('#chapter_buttons').html('');
	$('#chapter_buttons button').addClass('no_display').removeClass('display');

	//get new cue points
	if (sBrowser === 'mobile' || sBrowser === 'ipad')
	{
		modCue.getCuePoints(oMedia.media.id, cuePointsHandler);
	}
	else
	{
		cuepoints = modCue.getCuePoints(oMedia.video.id);
		cuePointsHandler(cuepoints);
	}

	var oCustomVars = {
		1: {
			name: 'Video Reference ID',
			value: aCurrentVideoMetaData.referenceId
		},
		2: {
			name: 'Vehicle Year',
			value: aCurrentVideoMetaData.year
		},
		3: {
			name: 'Vehicle Make',
			value: aCurrentVideoMetaData.make
		},
		4: {
			name: 'Vehicle Model',
			value: aCurrentVideoMetaData.model
		}
	};

	sendToGoogle(sPlayerName, 'Player', 'Video Load', oCustomVars);

	if (sBrowser !== 'mobile' && sBrowser !== 'ipad') {
		modMen.closeMenuPage();

		if (bAutoplay || bIgnoreAutoPlaySetting) {
			modVid.loadVideo(oMedia.video.id);

			if (bDebug && bIgnoreAutoPlaySetting && !bAutoplay) {
				console.log('Player: Ignoring auto play setting, video loaded via thumbnail click or video select');
			}
		}
		else
		{
			modVid.cueVideo(oMedia.video.id);
		}
	}

	// Change vehicle info in dealer contact form
	$.ajaxCall('dvs.changeVideo', 'bVideoChanged=' + bVideoChanged + '&sRefId=' + oMedia.media.referenceId + '&iDvsId=' + iDvsId);

//Give brightcove time to reset the position so we dont show an overlay too early.
	if (bIsDvs) {
//		$(document).ready(function() {
////			checkBackground();
//		});

//		bOverlayHold = false;
	}
}

//Auto called, fires off cueChange
function onCuePointEvent(oCuePoint) {

	if (sCurrentCuePoint !== '' && (sCurrentCuePoint !== 'Pre-roll' || bPreRoll)) {

		var oCustomVars = {
			1: {
				name: 'Video Reference ID',
				value: aCurrentVideoMetaData.referenceId
			},
			2: {
				name: 'Vehicle Year',
				value: aCurrentVideoMetaData.year
			},
			3: {
				name: 'Vehicle Make',
				value: aCurrentVideoMetaData.make
			},
			4: {
				name: 'Vehicle Model',
				value: aCurrentVideoMetaData.model
			},
			5: {
				name: 'Video Chapter',
				value: sCurrentCuePoint
			}
		};

		sendToGoogle(sPlayerName, 'Player', 'Chapter Watched: ' + sCurrentCuePoint, oCustomVars);
	}

	if (bDebug) {
		console.log('Media: Cuepoint Rollover to ' + oCuePoint.cuePoint.name);
	}

	cueChange(oCuePoint.cuePoint.name);
}

//Plays next video if there are any
function onVideoEnd(oVideo) {
	if (bDebug) {
		console.log('Player: Video End');
	}

	if (bAutoAdvance) {
		iCurrentVideo++;
		bVideoChanged = true;

		if (bDebug) {
			console.log('Player: Auto Advance enabled. Advancing to Video key: ' + iCurrentVideo);
		}

		if (aMediaIds[iCurrentVideo]) {
			if (bDebug) {
				console.log('Media: Playing next video');
			}

			if (sBrowser === 'mobile' || sBrowser === 'ipad') {
				modVid.loadVideoByID(aMediaIds[iCurrentVideo]);
			}
			else
			{
				modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
			}
		}
	}
	else
	{
		if (bDebug) {
			console.log('Player: Auto Advance disabled.');
		}
		// Handle chapter light states
		if (bDebug) {
			console.log('Player: Resetting chapter lights');
		}

		$.each(oChapterDivs, function(sChapter, sHtml) {
//			$('#chapter_light_green_' + sChapter).hide();
//			$('#chapter_light_red_' + sChapter).hide();
//			$('#chapter_light_yellow_' + sChapter).hide();
//			$('#chapter_light_disabled_' + sChapter).show();
			$('#chapter_light_disabled_' + sChapter).attr('class', 'disabled display');
		});
	}

	if (bIsDvs) {
		resetOverlays();
	}
}

//Actual cue change functions, if cued, plays
function seek(time)
{
	if (bDebug) {
		console.log('Media: Seeking to time: ' + time);
	}

	if (sBrowser === 'mobile' || sBrowser === 'ipad') {
		// if the video is not playing, start it and function calls itself again
		modVid.getIsPlaying(function(isPlaying) {
			if (isPlaying === true) {
				modVid.seek(time);
			}
			else
			{	// function recalls itself till result is true
				modVid.play();
				seek(time);
			}
		});
	}
	else
	{
		if (modVid.isPlaying())
		{
			modVid.seek(time);
		}
		else
		{
			queuedTime = time;
			modVid.play();
		}
	}
}

function isPlayingHandler(result) {
	bPlaying = result;

	if (bDebug) {
		console.log('Player: isPlayingHandler result: ' + result);
	}
}

//Changes currently playing lights to already played, and lights up currently playing light for current chapter
function changeLights(sCuePoint) {
//	$.each(oCuePoints, function(sChapter, iTime) {
////		if ($('#chapter_light_green_' + sChapter).is(":visible")) {
////			if (bDebug) {
////				console.log('Player: ' + sChapter + ' shows playing. Changing chapter light to red.');
////			}
////			$('#chapter_light_green_' + sChapter).hide();
////			$('#chapter_light_disabled_' + sChapter).hide();
////			$('#chapter_light_red_' + sChapter).show();
////		}
//		if ($('#chapter_container_' + sChapter).is(":visible")) {
//			if (bDebug) {
//				console.log('Player: ' + sChapter + ' shows playing. Changing chapter light to red.');
//			}
////			$('#chapter_light_green_' + sChapter).hide();
////			$('#chapter_light_disabled_' + sChapter).hide();
//			$('#chapter_container_' + sChapter).attr('class', 'watched display');
//		}
//	});
	
	$('#chapter_buttons button.selected').attr('class', 'watched display');

	if (bDebug) {
		console.log('Player: Showing green for ' + sCuePoint);
	}

	if (sCuePoint === 'Intro' || sCuePoint === 'Overview')
	{
//		if ($('#chapter_light_disabled_Intro').is(":visible") || $('#chapter_light_disabled_Overview').is(":visible")) {
//			if (bDebug) {
//				console.log('Player: Resetting chapter buttons...');
//			}
//
//			for (var i = 0; i < cuepoints.length; i++)
//			{
//				if (cuepoints[i].type === 1)
//				{
//					$('#chapter_container_' + sCuePoint).attr('onclick', 'changeCuePoint(\'' + cuepoints[i].name + '\');');
////					oCuePoints[cuepoints[i].name] = cuepoints[i].time;
////					$('#chapter_buttons').append('<div id="chapter_container_' + cuepoints[i].name + '" class="chapter_button_container" onclick="changeCuePoint(\'' + cuepoints[i].name + '\');" style="display:none;">' + oChapterDivs[cuepoints[i].name] + '</div>');
////					$('#chapter_container_' + cuepoints[i].name).show();
////					$('#chapter_container_' + cuepoints[i].name).attr('class','display active');
////					$('#chapter_light_disabled_' + cuepoints[i].name).hide();
////					$('#chapter_light_yellow_' + cuepoints[i].name).show();
//				}
//			}
//
//			//Show get price button
//			if (bIsDvs && !bPreview || bIdriveGetPrice) {
////				$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
//				$('#chapter_container_Get_Price').attr('class', 'display active');
////				$('#chapter_container_Get_Price').show();
////				$('#chapter_light_disabled_Get_Price').hide();
////				$('#chapter_light_yellow_Get_Price').show();
//			}
//		}
//		else
//		{
//			if (bDebug) {
//				console.log('Player: Chapter buttons do not need to be reset.');
//			}
//		}
		$('#chapter_buttons button.disabled').addClass('active').removeClass('disabled');
	}

//	$('#chapter_light_disabled_' + sCuePoint).hide();
//	$('#chapter_light_yellow_' + sCuePoint).hide();
//	$('#chapter_light_red_' + sCuePoint).hide();
//	$('#chapter_light_green_' + sCuePoint).show();
	$('#chapter_container_' + sCuePoint).attr('class', 'display selected');
}

function cuePointsHandler(cuepoints) {
	if (cuepoints) {
		if (bDebug) {
			var sCuePoints = '';
			for (var iKey in cuepoints) {
				sCuePoints += '"' + cuepoints[iKey].name + '": Time: ' + cuepoints[iKey].time + ', Type: ' + cuepoints[iKey].type + '.  ';
			}
			console.log('Media: Cuepoints: ' + sCuePoints);
		}

		if (sBrowser === 'mobile' || sBrowser === 'ipad') {
			bIsPlaying = true;
			modVid.getIsPlaying(function(isPlaying) {
				if (isPlaying === false) {
					bIsPlaying = false;
				}
			});
		}
		else
		{


			if (modVid.isPlaying())
			{
				bIsPlaying = true;
			}
			else
			{
				bIsPlaying = false;
			}
		}

		// loop over all the cuepoints
		if (bDebug) {
			if (bIsPlaying)
			{
				console.log('Media: Showing all cuepoints.');
			}
			else
			{
				console.log('Media: Cuepoint handler called. Video is not playing. Keeping chapter buttons hidden.');
			}
		}

		sHtml = '';
		for (var i = 0; i < cuepoints.length; i++)
		{
			if (cuepoints[i].type === 1)
			{
				oCuePoints[cuepoints[i].name] = cuepoints[i].time;
//				$('#chapter_buttons').append('<div id="chapter_container_' + cuepoints[i].name + '" class="chapter_button_container" onclick="changeCuePoint(\'' + cuepoints[i].name + '\');" style="display:none;">' + oChapterDivs[cuepoints[i].name] + '</div>');
				$('#chapter_container_' + cuepoints[i].name).attr('class', 'display');
				if (bIsPlaying)
				{
//					$('#chapter_light_disabled_' + cuepoints[i].name).hide();
//					$('#chapter_light_yellow_' + cuepoints[i].name).show();
					$('#chapter_container_' + cuepoints[i].name).addClass('active');
				}
				else
				{
					$('#chapter_container_' + cuepoints[i].name).addClass('disabled');
//					$('#chapter_light_disabled_' + cuepoints[i].name).show();
//					$('#chapter_light_yellow_' + cuepoints[i].name).hide();
				}
			}
		}

		//Show get price button
		if (bIsDvs && !bPreview || bIdriveGetPrice) {
//			$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
			$('#chapter_container_Get_Price').attr('class', 'display');
			if (bIsPlaying)
			{

//				$('#chapter_light_disabled_Get_Price').hide();
//				$('#chapter_light_yellow_Get_Price').show();
				$('#chapter_container_Get_Price').addClass('active');
			}
			else
			{

//				$('#chapter_light_disabled_Get_Price').show();
//				$('#chapter_light_yellow_Get_Price').hide();
				$('#chapter_container_Get_Price').addClass('disabled');
			}
		}

	}
	else
	{

		if (!bPreview && bIsDvs || bIdriveGetPrice) {
//			$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
			$('#chapter_container_Get_Price').attr('class', 'display active');
		}

		if (bDebug) {
			console.log('Media: No cuepoints found!');
		}

	}

}

function thumbnailClick(iKey) {
	if (bDebug) {
		console.log('Player: Playlist Thumbnail Click: #' + iKey);
	}

	if (bIsDvs) {
		resetOverlays();
	}

	bVideoChanged = true;

	iCurrentVideo = iKey;

	bIgnoreAutoPlaySetting = true;

	if (sBrowser === 'mobile' || sBrowser === 'ipad') {
		modVid.loadVideoByID(aMediaIds[iKey]);
	}
	else
	{
		modCon.getMediaAsynch(aMediaIds[iKey]);
	}

	return false;
}