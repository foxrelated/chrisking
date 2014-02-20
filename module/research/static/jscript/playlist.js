var player;
var video, content, exp, menu, ads, social;
var videoList;

function onTemplateLoaded(pPlayer) {

	player = bcPlayer.getPlayer(pPlayer);

	video 	= player.getModule(APIModules.VIDEO_PLAYER);
	content = player.getModule(APIModules.CONTENT);
	exp 	= player.getModule(APIModules.EXPERIENCE);
	
	exp.addEventListener(BCExperienceEvent.TEMPLATE_READY, onTemplateReady);
	video.addEventListener(BCVideoEvent.VIDEO_LOAD, onVideoLoad);
	content.addEventListener(BCContentEvent.MEDIA_COLLECTION_LOAD, onMediaCollectionLoad);
}

function onMediaCollectionLoad(e) {

	if(e.mediaCollection == null) {
		console.log("Media Collection equals null");
	} else {

		var mediaDTOs = new Array();
		for(var i = 0; i < e.mediaCollection.mediaCount; i++) {
				mediaDTOs[i] = content.getMedia(e.mediaCollection.mediaIds[i]);
		}
		videoList.setData(mediaDTOs);
	} 

}