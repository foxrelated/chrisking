var bPreRoll = false;
var iDvsId = 6;
var bIdriveGetPrice = false;
var bPreview = false;
var bAutoplay = false;
var bAutoAdvance = false;

function enableVideoSelectCarousel() {
	if (bDebug) console.log("Player: enableVideoSelectCarousel called.");
	$("#video_select_playlist").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev",
		circular: false,
		visible: 4,
		scroll: 3,
		speed: 900
	});
}

$Behavior.overPlay = function() {
	$("#overview_playlist").jCarouselLite({
		btnNext: ".next",
		btnPrev: ".prev",
		circular: false,
		visible: 4,
		scroll: 3,
		speed: 900
	});

}

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

if (bDebug) {
	console.log('Page: ' + (bIsDvs ? 'DVS' : 'iDrive') + ' Browser Detected: ' + sBrowser);
}

//Watch overviews.  Resets MediaID array and plays video 0.
function watchOverviews() {
	aMediaIds = aOverviewMediaIds;
	playVideo(1);
	$('#test_drive_playlist').hide('slow');
	$('#video_select_playlist').hide('slow');
	$('#overview_playlist').show('slow');
	if (bDebug) {
		console.log("Player: Switching to Overviews");
	}

	sendToGoogle(sPlayerName, 'Menu', 'Watch Overviews');
}

//Watch test drives.  Resets MediaID array and plays video 0.
function watchTestDrives() {
	aMediaIds = aTestDriveMediaIds;
	playVideo(0);
	$('#overview_playlist').hide('slow');
	$('#video_select_playlist').hide('slow');
	$('#test_drive_playlist').show('slow');
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

	$('#overview_playlist').hide('slow');
	$('#test_drive_playlist').hide('slow');
	$('#video_select_playlist').show('slow');
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
	if (sCurrentCuePoint != sCuePoint) {

		sendToGoogle(sPlayerName, 'Player', 'Chapter Clicked: ' + sCuePoint);

		if (bDebug) {
			console.log('Media: Cuepoint Manually Changed to ' + sCuePoint);
		}

        if (navigator.userAgent.toLowerCase().indexOf('safari/') > -1) {
            seek(oCuePoints[sCuePoint] + 0.05);
        } else {
            seek(oCuePoints[sCuePoint] + 0.001);
        }

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
		$('#dvs_get_price_container').show('fast');

		sendToGoogle('DVS Site', 'Menu', 'Get Price');
	}
	else
	{
		if (sBrowser == 'mobile') {
			alert('Please wait for a video to start.');
		} else {
			alert('Please wait for a video to load.');
		}
	}
}

function getPriceIDrive(iIDriveId) {
	if (aCurrentVideoMetaData) {
		$('#idrive_get_price_container').show('fast');

		sendToGoogle(sPlayerName, 'Player', 'Menu', 'Get Price');
	}
	else
	{
		if (sBrowser == 'mobile') {
			alert('Please wait for a video to start.');
		} else {
			alert('Please wait for a video to load.');
		}
	}
}

function getPriceExternal(sEmail) {
	if (aCurrentVideoMetaData) {
		$('#idrive_get_price_container').show('fast');
	}
}

function resetIDriveGetPriceForm() {
	$('#idrive_contact_success').hide();
	$('#idrive_contact_form').show();
	$('#contact_name').val('');
	$('#contact_email').val('');
	$('#contact_phone').val('');
	$('#contact_zip').val('');
	$('#comments').val('');
}

//Called when clicking a chapter or when the video rolls past a chapter, sets lights.
function cueChange(sCuePoint) {
	if (sCurrentCuePoint != sCuePoint) {
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

	if (sCuePoint == 'Post-roll') {
		// Handle chapter light states
		// Mediaevent "complete" doesn't fire on replays, so we need to make sure chapter lights are reset on a video replay here
		if (bDebug) {
			console.log('Player: Resetting chapter lights');
		}

		$.each(oChapterDivs, function(sChapter, sHtml) {
			$('#chapter_light_disabled_' + sChapter).show();
			$('#chapter_light_green_' + sChapter).hide();
			$('#chapter_light_red_' + sChapter).hide();
			$('#chapter_light_yellow_' + sChapter).hide();
		});
	}
}

//Plays a new video on video end
function playVideo(iVideoKey) {
	if (bDebug) {
		console.log('Player: Playing Video RefID: ' + aMediaIds[0]);
	}

	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
		modVid.loadVideoByID(aMediaIds[0]);
	}
	else
	{
		modCon.getMediaAsynch(aMediaIds[0]);
	}

	iCurrentVideo = iVideoKey;
}

//Auto called
function onTemplateLoaded(experienceID)
{
	if (bDebug) {
		console.log('Player: Template Loaded: ' + experienceID);
	}
	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5)
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
	oChapterDivs['Setup'] = $('#chapter_container_Setup').html();
	oChapterDivs['Interactive'] = $('#chapter_container_Interactive').html();
	oChapterDivs['Your_Leads'] = $('#chapter_container_Your_Leads').html();
	oChapterDivs['Sharing'] = $('#chapter_container_Sharing').html();
	oChapterDivs['Prospecting'] = $('#chapter_container_Prospecting').html();
	oChapterDivs['Selling'] = $('#chapter_container_Selling').html();
	oChapterDivs['Traffic_Building'] = $('#chapter_container_Traffic_Building').html();
	oChapterDivs['Our_Support'] = $('#chapter_container_Our_Support').html();
	oChapterDivs['Summary'] = $('#chapter_container_Summary').html();

	$('#chapter_buttons').html('');
	templa
}

//Auto called
function onTemplateReady(oVideo) {

	if (bDebug) {
		console.log('Player: Template Ready.');
	}

	iCurrentVideo == 0;

	if (bAutoplay) {
		if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
			modVid.loadVideoByID(aMediaIds[iCurrentVideo]);
		}
		else
		{
			modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
		}

		if (bDebug) {
			console.log('Player: onTemplateReady Playing video: ' + aMediaIds[iCurrentVideo]);
		}
	}
	else
	{
		if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
			modVid.cueVideoByID(aMediaIds[iCurrentVideo]);
		}
		else
		{
			modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
		}

		if (bDebug) {
			console.log('Player: Cueing video: ' + aMediaIds[iCurrentVideo]);
		}

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Intro' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Intro'] + '</div>');
		$('#chapter_container_' + 'Intro').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Setup' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Setup'] + '</div>');
		$('#chapter_container_' + 'Setup').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Interactive' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Interactive'] + '</div>');
		$('#chapter_container_' + 'Interactive').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Your_Leads' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Your_Leads'] + '</div>');
		$('#chapter_container_' + 'Your_Leads').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Sharing' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Sharing'] + '</div>');
		$('#chapter_container_' + 'Sharing').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Prospecting' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Prospecting'] + '</div>');
		$('#chapter_container_' + 'Prospecting').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Selling' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Selling'] + '</div>');
		$('#chapter_container_' + 'Selling').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Traffic_Building' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Traffic_Building'] + '</div>');
		$('#chapter_container_' + 'Traffic_Building').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Our_Support' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Our_Support'] + '</div>');
		$('#chapter_container_' + 'Our_Support').show();

		$('#chapter_buttons').append('<div id="chapter_container_' + 'Summary' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Summary'] + '</div>');
		$('#chapter_container_' + 'Summary').show();
	}

	sPlayerName = 'Static Player';

	sendToGoogle(sPlayerName, 'Player', 'Player Loaded');

}

//Called when any video loads.
//Closes the menu, clears chapter div, gets new cuepoints, builds new chapter divs, and shows them, closes menu again if need be, and plays loaded video
function onVideoLoad(oMedia) {
	if (bDebug) {
		console.log('Media: Video Load: ' + oMedia.media.displayName);
	}

	aCurrentVideoMetaData = oMedia.media.customFields;
	aCurrentVideoMetaData.id = oMedia.media.id;
    if(oMedia.media.referenceId){
        aCurrentVideoMetaData.referenceId = oMedia.media.referenceId;
    }else{
        aCurrentVideoMetaData.referenceId = oMedia.media.referenceID;
    }
	if (bDebug) {
		console.log('Media: Current Video Meta Data Follows:');
		console.log(aCurrentVideoMetaData);
	}

	if (!bMediaBegin) {
		if (!bPreRoll) {
			if (bDebug) {
				console.log('Media: No Preroll Set');
			}

			sendToGoogle(sPlayerName, 'Player', 'Media Begin');
		}
		else
		{
			if (bDebug) {
				console.log('Media: Preroll Set');
			}

			sendToGoogle(sPlayerName, 'Player', 'Media Begin');
		}

		bMediaBegin = true;
	}

	//modMen.closeMenuPage();

	//Workaround for BC player in mobile
	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5)
	{
		seek(0);
	}

	sCurrentCuePoint = '';
	if (bDebug) {
		console.log('Player: Hiding all chapters');
	}

	$('#chapter_buttons').html('');

	//get new cue points
	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5)
	{
		modCue.getCuePoints(oMedia.media.id, cuePointsHandler);
	}
	else
	{
		cuepoints = modCue.getCuePoints(oMedia.video.id);
		cuePointsHandler(cuepoints);
	}

	sendToGoogle(sPlayerName, 'Player', 'Video Load');
    $.ajaxCall('dvs.changeVideo', 'bVideoChanged=' + bVideoChanged + '&sRefId=' + aCurrentVideoMetaData.referenceId + '&iDvsId=' + iDvsId);
	if (sBrowser != 'mobile' && sBrowser != 'ipad') {
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

}

//Auto called, fires off cueChange
function onCuePointEvent(oCuePoint) {
	if (sCurrentCuePoint !== '' && (sCurrentCuePoint !== 'Pre-roll' || bPreRoll)) {

		sendToGoogle(sPlayerName, 'Player', 'Chapter Watched: ' + sCurrentCuePoint);
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

			if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
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
			$('#chapter_light_green_' + sChapter).hide();
			$('#chapter_light_red_' + sChapter).hide();
			$('#chapter_light_yellow_' + sChapter).hide();
			$('#chapter_light_disabled_' + sChapter).show();
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

	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
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
	$.each(oCuePoints, function(sChapter, iTime) {
		if ($('#chapter_light_green_' + sChapter).is(":visible")) {
			if (bDebug) {
				console.log('Player: ' + sChapter + ' shows playing. Changing chapter light to red.');
			}
			$('#chapter_light_green_' + sChapter).hide();
			$('#chapter_light_disabled_' + sChapter).hide();
			$('#chapter_light_red_' + sChapter).show();
		}
	});

	if (bDebug) {
		console.log('Player: Showing green for ' + sCuePoint);
	}

	if (sCuePoint == 'Intro')
	{
		if ($('#chapter_light_disabled_Intro').is(":visible") || $('#chapter_light_disabled_Overview').is(":visible")) {
			if (bDebug) {
				console.log('Player: Resetting chapter buttons...');
			}

			for (var i = 0; i < cuepoints.length; i++)
			{
				if (cuepoints[i].type == 1)
				{
					oCuePoints[cuepoints[i].name] = cuepoints[i].time;
					$('#chapter_buttons').append('<div id="chapter_container_' + cuepoints[i].name + '" class="chapter_button_container" onclick="changeCuePoint(\'' + cuepoints[i].name + '\');" style="display:none;">' + oChapterDivs[cuepoints[i].name] + '</div>');
					$('#chapter_container_' + cuepoints[i].name).show();
					$('#chapter_light_disabled_' + cuepoints[i].name).hide();
					$('#chapter_light_yellow_' + cuepoints[i].name).show();
				}
			}

			//Show get price button
			if (bIsDvs && !bPreview || bIdriveGetPrice) {
				$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
				$('#chapter_container_' + 'Get_Price').show();
				$('#chapter_light_disabled_Get_Price').hide();
				$('#chapter_light_yellow_Get_Price').show();
			}
		}
		else
		{
			if (bDebug) {
				console.log('Player: Chapter buttons do not need to be reset.');
			}
		}
	}

	$('#chapter_light_disabled_' + sCuePoint).hide();
	$('#chapter_light_yellow_' + sCuePoint).hide();
	$('#chapter_light_red_' + sCuePoint).hide();
	$('#chapter_light_green_' + sCuePoint).show();
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

		if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
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
			if (cuepoints[i].type == 1)
			{
				oCuePoints[cuepoints[i].name] = cuepoints[i].time;
				$('#chapter_buttons').append('<div id="chapter_container_' + cuepoints[i].name + '" class="chapter_button_container" onclick="changeCuePoint(\'' + cuepoints[i].name + '\');" style="display:none;">' + oChapterDivs[cuepoints[i].name] + '</div>');
				$('#chapter_container_' + cuepoints[i].name).show();
				if (bIsPlaying)
				{
					$('#chapter_light_disabled_' + cuepoints[i].name).hide();
					$('#chapter_light_yellow_' + cuepoints[i].name).show();
				}
				else
				{
					$('#chapter_light_disabled_' + cuepoints[i].name).show();
					$('#chapter_light_yellow_' + cuepoints[i].name).hide();
				}
			}
		}

		//Show get price button
		if (bIsDvs && !bPreview || bIdriveGetPrice) {
			$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
			$('#chapter_container_' + 'Get_Price').show();
			if (bIsPlaying)
			{
				$('#chapter_light_disabled_Get_Price').hide();
				$('#chapter_light_yellow_Get_Price').show();
			}
			else
			{
				$('#chapter_light_disabled_Get_Price').show();
				$('#chapter_light_yellow_Get_Price').hide();
			}
		}

	}
	else
	{
		if (!bPreview && bIsDvs || bIdriveGetPrice) {
			$('#chapter_buttons').append('<div id="chapter_container_' + 'Get_Price' + '" class="chapter_button_container" style="display:none;">' + oChapterDivs['Get_Price'] + '</div>');
			$('#chapter_container_' + 'Get_Price').show();
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

	if (sBrowser == 'mobile' || sBrowser == 'ipad' || bIsHtml5) {
		modVid.loadVideoByID(aMediaIds[iKey]);
	}
	else
	{
		modCon.getMediaAsynch(aMediaIds[iKey]);
	}

	return false;
}