var bDebug = true;
var bcExp;
var modExp;
var modCon;
var modCue;
var modVid;
var cuepoints;
var queuedTime;
var sCurrentCuePoint;
var oCuePoints = new Object;
var oChapterDivs = new Object;

if (bDebug){
	var iCurrentVideo=4;
}
else
{
	var iCurrentVideo=0;
}

//Seek to new cue point if it's different than the one we're in, call cueChange
function changeCuePoint(sCuePoint){
	if (sCurrentCuePoint != sCuePoint){
		if (bDebug) console.log("Seeking to: "+oCuePoints[sCuePoint])
		seek(oCuePoints[sCuePoint]);
		cueChange(sCuePoint);
	}
	else
	{
		if (bDebug) console.log('Cuepoint already set: '+sCuePoint);
	}
}

//Called when clicking a chapter or when the video rolls past a chapter, sets lights.
function cueChange(sCuePoint){
	if (sCurrentCuePoint != sCuePoint){
		if (bDebug) console.log('Cuepoint changed to  '+sCuePoint);
		sCurrentCuePoint = sCuePoint;
		changeLights(sCuePoint);
	}
	else
	{
		if (bDebug) console.log('Cuepoint already set: '+sCuePoint);
	}
}

//Plays a new video on video end
function playVideo(iVideoKey){
	modCon.getMediaAsynch(aMediaIds[iVideoKey]);
	iCurrentVideo=iVideoKey;
}

//Auto called
function onTemplateLoaded(experienceId)
{
	if (bDebug) console.log('onTemplateLoaded, id: '+experienceId);
	
	bcExp = brightcove.getExperience(experienceId);
		
	// get references to the modules we'll need
	modExp = bcExp.getModule(APIModules.EXPERIENCE);
	modCon = bcExp.getModule(APIModules.CONTENT);
	modCue = bcExp.getModule(APIModules.CUE_POINTS);
	modVid = bcExp.getModule(APIModules.VIDEO_PLAYER);
	modMen = bcExp.getModule(APIModules.MENU);

	// listen for the content load event so we can grab the videos cuepoints
	//modExp.addEventListener(BCExperienceEvent.CONTENT_LOAD, onContentLoad);
	modExp.addEventListener(BCExperienceEvent.TEMPLATE_READY, onTemplateReady);
	modVid.addEventListener(BCCuePointEvent.CUE, onCuePointEvent);
	modCon.addEventListener(BCContentEvent.VIDEO_LOAD, onVideoLoad);
	modVid.addEventListener(BCMediaEvent.COMPLETE, onVideoEnd);
	
	setPlayerStyle();
	
	oChapterDivs['Intro']=$('#chapter_container_Intro').html();
	oChapterDivs['Power']=$('#chapter_container_Power').html();
	oChapterDivs['Fuel']=$('#chapter_container_Fuel').html();
	oChapterDivs['Features']=$('#chapter_container_Features').html();
	oChapterDivs['Safety']=$('#chapter_container_Safety').html();
	oChapterDivs['Pricing']=$('#chapter_container_Pricing').html();
	oChapterDivs['Warranty']=$('#chapter_container_Warranty').html();
	oChapterDivs['Summary']=$('#chapter_container_Summary').html();
	$('#chapter_buttons').html('');
}

//Auto called
function onTemplateReady(event) {
	if (bDebug) console.log('onTemplateReady');

	if(modExp == null || !(modExp.getReady())) {
		if (bDebug) console.log("Player not initialized yet. Wait till after templateReady event.");
	} else {
		if (bDebug) console.log('modExp reports ready. Loading media. Key: '+iCurrentVideo);
		modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
	}
}

//Called when any video loads.
//Closes the menu, clears chapter div, gets new cuepoints, builds new chapter divs, and shows them, closes menu again if need be, and plays loaded video
function onVideoLoad(event) {
	if (bDebug) console.log('onVideoLoad, video id: '+event.video.id+', name: '+event.video.displayName);

	modMen.closeMenuPage();
	
	sCurrentCuePoint='';

	if (bDebug) console.log('Hiding all chapters');
	//	$.each(oCuePoints, function(sChapter, iTime){
	//		//XXXHIDE
	//		$('#chapter_container_'+sChapter).remove();
	//	});
	$('#chapter_buttons').html('');


	//get new cue points
	cuepoints = modCue.getCuePoints(event.video.id);
	
	if (bDebug) console.log(cuepoints);
	
	if (cuepoints){
		if (bDebug) console.log(cuepoints.length+' cuepoints found, Setting all lights to yellow. Intro to green.');
		$.each(oCuePoints, function(sChapter, iTime){
			if (sChapter !='Intro'){
				$('#chapter_light_green_'+sChapter).hide();
				$('#chapter_light_red_'+sChapter).hide();
				$('#chapter_light_yellow_'+sChapter).show();
			}
			else
			{
				$('#chapter_light_green_'+sChapter).show();
				$('#chapter_light_red_'+sChapter).hide();
				$('#chapter_light_yellow_'+sChapter).hide();
			}
		});
		// loop over all the cuepoints
		if (bDebug) console.log('Showing all cuepoints.');
		
		sHtml='';
		
		for (var i=0; i < cuepoints.length; i++)
		{
			if (cuepoints[i].type == 1) 
			{
				oCuePoints[cuepoints[i].name]=cuepoints[i].time;
				$('#chapter_buttons').append('<div id="chapter_container_'+cuepoints[i].name+'" class="chapter_button_container" onclick="changeCuePoint(\''+cuepoints[i].name+'\');" style="display:none;">'+oChapterDivs[cuepoints[i].name]+'</div>');
				$('#chapter_container_'+cuepoints[i].name).show('slow');
			}
		}
	}
	else
	{
		if (bDebug) console.log('No cuepoints found!');
	}
	
	//Video loaded, select first cuepoint
	//changeCuePoint('Intro');
	
	// Play video that was just loaded, close menu again to fix slow load
	modMen.closeMenuPage();
	modVid.loadVideo(event.video.id);
}

//Auto called, fires off cueChange
function onCuePointEvent(oCuePoint){
	if (bDebug) console.log('onCuePointEvent: '+oCuePoint.cuePoint.name);
	cueChange(oCuePoint.cuePoint.name);
}

//Plays next video if there are any
function onVideoEnd(event){
	if (bDebug) console.log('onVideoEnd');
	iCurrentVideo++;

	if (aMediaIds[iCurrentVideo]) {
		modCon.getMediaAsynch(aMediaIds[iCurrentVideo]);
	}
}

//Actual cue change functions, if cued, plays
function seek(time)
{
	// it's not possible to seek unless the video is playing
	// so check to see if it's playing and if it's not then
	// save the time and tell the video to play
	if (modVid.isPlaying()) 
	{
		modVid.seek(time);
	}
	else
	{
		queuedTime = time;
		modVid.addEventListener(BCMediaEvent.PROGRESS, onProgress);
		modVid.play();
	}

}
	
/**
* Called when the video starts playing.
*/
function onProgress(event)
{
	// remove the progress event listener and seek to the saved time
	modVid.removeEventListener(BCMediaEvent.PROGRESS, onProgress);
	seek(queuedTime);
}

//Changes currently playing lights to already played, and lights up currently playing light for current chapter
function changeLights(sCuePoint){
	$.each(oCuePoints, function(sChapter, iTime){
		if( $('#chapter_light_green_'+sChapter).is(":visible") ) {
			if (bDebug) console.log('#chapter_light_green_'+sChapter+' is visible. Changing to red.');
			$('#chapter_light_green_'+sChapter).hide();
			$('#chapter_light_red_'+sChapter).show();
		}
	});
	if (bDebug) console.log('Showing green for '+sCuePoint);
	$('#chapter_light_yellow_'+sCuePoint).hide();
	$('#chapter_light_red_'+sCuePoint).hide();
	$('#chapter_light_green_'+sCuePoint).show();
}