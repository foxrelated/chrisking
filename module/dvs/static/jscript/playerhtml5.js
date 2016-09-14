//bDebug = false;
var myPlayer;
var sPlayerName = "DVS Player";
var bVideoChanged=false,
urlChanged=false,
queuedTime,
currentPoster,
currentVideo,
currentVideoKey,
cuePointName,
tt = [],
trackIndex,
watchVideoSelect,
getPriceOverlayClick,
textOverlayClick,
customImageOverlayClick,
sCurrentCuePoint,
thumbkey = -1,
timeOut,
clicked = 0,
media_begin = 0,
inventory_new,
oChapterDivs = {};
$(document).ready(function(){
    

videojs("bcv2").ready(function(){
      myPlayer = this;
      
     
      
      var cuePointArr=[];
      var allCuePointData,
      
      currentCuePoint;
      
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
    if ( typeof sendToGoogle == 'function' ) { 
     sendToGoogle(sPlayerName, 'Player', 'Player Loaded');   
    }
     
     if(bPreRoll){
         
         
         if(aPoster != ''){
         jQuery(".vjs-poster").removeClass('vjs-hidden');
         jQuery(".vjs-poster").css('background-image','url("'+aPoster+'")');    
         }
         
         var preRollPlayed = false;
         var preRollAdvance = true;
     }else{
         var preRollPlayed = true;
     } 
     
    
     if(preRollPlayed){
     if (bDebug) 
     {
        console.log('Media: No Preroll Set');
     }
         
     playVideo(0,bAutoplay);    
     }else{
    
        
     playPreroll(bAutoplay);    
     } 
     
//       myPlayer.one("loadedmetadata",function(){
       myPlayer.on("loadedmetadata",function(){
         
      if(preRollPlayed){
          
          $("#chapter_buttons").children().removeClass('selected').addClass('active');
          $("#chapter_buttons").children().removeClass('display').addClass('no_display');
          trackIndex = myPlayer.textTracks().length -1;
          tt = myPlayer.textTracks()[trackIndex];
          cuePointArr = myPlayer.mediainfo.cue_points;
          
           var i, totalItems = cuePointArr.length
            for (i = 0; i < totalItems; i++) {
              $("#chapter_container_"+cuePointArr[i]['name']).removeClass('no_display').addClass('display');
            }
            $("#chapter_container_Get_Price").removeClass('no_display').addClass('display');
          
          
      }else{
          //preRollPlayed = true;
      }    
         tt.oncuechange = function() {
           if((!myPlayer.paused()) && (media_begin == 0))
           {//alert('zz');
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
                if ( typeof sendToGoogle == 'function' ) { 
                sendToGoogle(sPlayerName, 'Player', 'Media Begin', oCustomVars);
                }
                mixpanel.track("Media Begin", {
                    "Category": sPlayerName,
                    "Action": "Player",
                    "Video ID": aCurrentVideoMetaData.referenceId,
                    "Year": aCurrentVideoMetaData.year,
                    "Make": aCurrentVideoMetaData.make,
                    "Model": aCurrentVideoMetaData.model,
                    }
                );
               media_begin = 1;
           } 
           if(tt.activeCues[0]){
               var startTime = tt.activeCues[0].startTime;
           }
           if(tt.activeCues[1]){
               var firstStartTime = tt.activeCues[1].startTime;
           }
           
           
           
           if(myPlayer.mediainfo.cue_points[0].time == startTime){
           
           if(firstStartTime){
               
           allCuePointData = getSubArray(cuePointArr,'time',firstStartTime);        
           }    
           }else{
           
           allCuePointData = getSubArray(cuePointArr,'time',startTime);    
           }
           
           if(allCuePointData){
           if(allCuePointData[0]){
              $(".vjs-overlay").hide();
           cuePointName = allCuePointData[0].name;    
           }
           }
           
           if(allCuePointData){
           if(allCuePointData[0]){
           if(clicked != 1){
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
                value: currentCuePoint
            }
        };

        if ( typeof sendToGoogle == 'function' ) { 
        sendToGoogle(sPlayerName, 'Player', 'Chapter Watched: ' + currentCuePoint, oCustomVars);
        }
        mixpanel.track("Chapter Watched", {
            "Category": sPlayerName,
            "Action": "Player",
            "Chapter": currentCuePoint,
            "Video ID": aCurrentVideoMetaData.referenceId,
            "Year": aCurrentVideoMetaData.year,
            "Make": aCurrentVideoMetaData.make,
            "Model": aCurrentVideoMetaData.model,
            }
        );
           }else{
               clicked = 0;
           }
        }
         }
           
           cueChange(cuePointName);
           //$('#chapter_container_' + cuePointName).addClass('display selected');
          }    
       
//       alert('asd'+inventory_new);
       }); 
       
       if(!bAutoAdvance && inventory_btn){
           
       myPlayer.customEndscreen({
        "content": "<a href="+inventory_btn+" class='dvs_inventory_link' id='dvs_inventory_link' onclick='menuInventory('Top Menu Clicks');' rel='nofollow' target='_parent'>"+inventory_text+"</a>"
      })    
       }
       
      
        myPlayer.overlay({
            //content: bCustomOverlay1Content,
            overlays: [{
              content: ((bCustomOverlay1) ? bCustomOverlay1Content : ""),
              start: ((bCustomOverlay1) ? iCustomOverlay1Start : ""),
              end: ((bCustomOverlay1) ? iCustomOverlay1Start + iCustomOverlay1Duration : ""),
              align: 'top-middle'
            }, {
              content: ((bCustomOverlay2) ? bCustomOverlay2Content : ""),
              start: ((bCustomOverlay2) ? iCustomOverlay2Start : ""),
              end: ((bCustomOverlay2) ? iCustomOverlay2Start + iCustomOverlay2Duration : ""),
              align: 'top-middle'
            }, {
              content : ((bCustomOverlay3) ? bCustomOverlay3Content : ""),  
              start: ((bCustomOverlay3) ? iCustomOverlay3Start : ""),
              end: ((bCustomOverlay3) ? iCustomOverlay3Start + iCustomOverlay3Duration : ""),
              align: 'top-middle'
            }]
          });

      //myPlayer.on("timeupdate",function(){
         // if(!preRollPlayed){
          //    myPlayer.addClass("testClass");
              //$(".vjs-text-track-display")
      //})   
      if(!preRollPlayed && preRollUrl != ''){ 
      $("#bcv2 > :not(.vjs-control-bar):not(.vjs-big-play-button)").on("click",function(){
        window.open(preRollUrl, '_blank');
       });
      } 
      
      myPlayer.on("userinactive",function(){
         // myPlayer.controls(false);
      });
      myPlayer.on("useractive",function(){
          //window.clearTimeout(timeOut);  
          //$("#bcv2").removeClass("vjs-user-inactive");
          //myPlayer.removeClass("vjs-user-inactive");
          //myPlayer.addClass("vjs-user-active");
          
          
        // timeOut = window.setTimeout(function(){
              //myPlayer.removeClass("vjs-user-active");
            //  myPlayer.addClass("vjs-user-inactive");
              
             // myPlayer.trigger("userinactive");
             // myPlayer.controls(false);
            //myPlayer.addClass('vjs-controls-disabled'); 
           // console.log('inactive');
       //   }, 1000);
          
      }); 
      
       
       myPlayer.on("ended",function(){
       
           if (navigator.userAgent.match(/(\(iPhone)/)) {
            if(!preRollPlayed){
                $('video').get(0).webkitExitFullscreen();
            }
           }
           $(".vjs-overlay").hide();
           if (bAutoAdvance || preRollAdvance) {
               
             
               if(preRollAdvance){
                   preRollAdvance = false;
                  
                   if(thumbkey >= 0){
                   currentVideoKey = thumbkey;                       
                   thumbkey = -1;
                   }else{
                   currentVideoKey = 0;    
                   }
                   
                   $("#bcv2> :not(.vjs-control-bar):not(.vjs-big-play-button)").off();
                   preRollPlayed = true;
               }else{
                currentVideoKey++; 
                  if (bDebug) {
                    console.log('Player: Auto Advance enabled. Advancing to Video key: ' + currentVideoKey);
                }
  
               }
                

              
                if (aMediaIds[currentVideoKey]) {
                    if (bDebug) {
                        console.log('Media: Playing next video');
                    }
                        resetChapters('');
                        
                        thumbnailClick(currentVideoKey);
                        thumbnailClickDvs();
                  
                }
            }//else{
//            seek(0);
//           myPlayer.pause();
//           resetChapters('disabled');
//            }
//           
       
       }); 
       
       $("#chapter_buttons button").not("#chapter_container_Get_Price").on('click',function(){
           $(".vjs-custom-overlay").remove();
           var cueName = this.id;
           cueName = cueName.replace('chapter_container_','');
           changeCuePoint(cueName);
       });
       //$(".playlist_carousel_image_link").on('click',function(){
       $(document).on('click',".playlist_carousel_image_link",function(){
           $(".vjs-overlay").hide();
           var currentVidId = this.id;
           currentVideo =  currentVidId.replace('thumbnail_link_','');
            //if(cuePointName != "Intro"){
               resetChapters('');
           //}
           thumbnailClick(currentVideo);
           thumbnailClickDvs();
          
           
       })
       $("#chapter_container_Get_Price").on('click',function(){
           getPrice();
       });
      
 //function clearoverlays(tm){
//     if(bCustomOverlay1){
//         if(iCustomOverlay1Start != tm){
//             $(".vjs-overlay").hide();
//         }
//     }
//     if(bCustomOverlay2){
//         if(iCustomOverlay2Start != tm){
//             $(".vjs-overlay").hide();
//         }
//     }if(bCustomOverlay3){
//         if(iCustomOverlay3Start != tm){
//             $(".vjs-overlay").hide();
//         }
//     }
// }      
       
 //function watchVideoSelect(aVideoSelectMediaIds) {alert('called');alert('called');
 watchVideoSelect = function(aVideoSelectMediaIds) {
    //bIgnoreAutoPlaySetting = true;
    bVideoChanged = true;
    aMediaIds = aVideoSelectMediaIds;
    $(".vjs-overlay").hide();
    $(".vjs-custom-overlay").hide();
    resetChapters('');
    
    if(preRollPlayed){
    playVideo(0,true);
    }else{
        $(".vjs-loading-spinner").hide();
        myPlayer.play();
    }
    
    if (bDebug) {
        console.log("Player: Switching to Video Select");
    }
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle('DVS Site', 'Menu', 'Video Select');
    }
    mixpanel.track("Video Selector", {
        "Category": "DVS Site",
        "Action": "Menu",
    });
    if (bIsDvs) {
        resetOverlays();
    }
}      
       
function resetChapters(className){
    $.each(oChapterDivs, function(sChapter, sHtml) {
            // Is the chapter button we are setting to display shown before the video ended?
            if ($('#chapter_container_' + sChapter).hasClass('display'))
            {
                if(className == ''){
                 $('#chapter_container_' + sChapter).attr('class', 'display active');   
                }else{
                $('#chapter_container_' + sChapter).attr('class', 'display '+className);    
                }
                
            }
    });
}       
       
function getSubArray(targetArray, objProperty, value) {
    var i, totalItems = targetArray.length,
      objFound = false,
      idxArr = [];
    for (i = 0; i < totalItems; i++) {
      if (targetArray[i][objProperty] === value) {
        objFound = true;
        idxArr.push(targetArray[i]);
      }
    }
    return idxArr;
  };

 //function hideControls(){
//     myPlayer.controls(false);
// }
      
function cueChange(sCuePoint) {
    //if (currentCuePoint !== sCuePoint || bVideoChanged) {
    //if (bVideoChanged) {
        //console.log('hello');
        currentCuePoint = sCuePoint;
        sCurrentCuePoint = currentCuePoint;
        changeLights(sCuePoint);
    //}
    //else
//    {
//        if (bDebug) {
//            console.log('Media: Cuepoint already set: ' + sCuePoint);
//        }
//    }

    if (!bVideoChanged && !urlChanged && !bPreview && bIsDvs) {
        window.parent.history.pushState("string", "", sFirstVideoTitleUrl);
        urlChanged = true;
 }

    //if (sCuePoint === 'Post-roll') {
//        // Handle chapter light states
//        // Mediaevent "complete" doesn't fire on replays, so we need to make sure chapter lights are reset on a video replay here
//        if (bDebug) {
//            console.log('Player: Resetting chapter lights');
//        }
//
//        $.each(oChapterDivs, function(sChapter, sHtml) {
//            // Is the chapter button we are setting to display shown before the video ended?
//            if ($('#chapter_container_' + sChapter).hasClass('display'))
//            {
//                $('#chapter_container_' + sChapter).attr('class', 'display disabled');
//            }
//
//        });
//    }
}

function changeLights(sCuePoint) {
    
    
    if(bVideoChanged){
        $('#chapter_buttons button.selected').removeClass('selected').attr('class', 'display active');
    }else{
        $('#chapter_buttons button.selected').attr('class', 'watched display');    
    }
    

    if (sCuePoint === 'Intro' || sCuePoint === 'Overview')
    {
        $('#chapter_buttons button.disabled').addClass('active').removeClass('disabled');
        bVideoChanged = false;
    }
    //$('#chapter_container_' + sCuePoint).addClass('display selected');
    
    $('#chapter_container_' + sCuePoint).attr('class', 'display selected');        
    
    
}      
         
function changeCuePoint(sCuePoint) {
    //if (currentCuePoint !== sCuePoint && !$('#chapter_container_' + sCuePoint).hasClass('disabled')) {
    if (!$('#chapter_container_' + sCuePoint).hasClass('disabled')) {
        var seekTimeArr = getSubArray(cuePointArr,'name',sCuePoint);
        var seekTime = seekTimeArr[0].time;
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
                value: sCuePoint
            }
        };
        if ( typeof sendToGoogle == 'function' ) {
        clicked = 1; 
       sendToGoogle(sPlayerName, 'Player', 'Chapter Clicked: ' + sCuePoint, oCustomVars);
        }
        mixpanel.track("Chapter Clicked", {
            "Category": sPlayerName,
            "Action": "Player",
            "Chapter": currentCuePoint,
            "Video ID": aCurrentVideoMetaData.referenceId,
            "Year": aCurrentVideoMetaData.year,
            "Make": aCurrentVideoMetaData.make,
            "Model": aCurrentVideoMetaData.model,
            }
        );
        if (bDebug) {
            console.log('Media: Cuepoint Manually Changed to ' + sCuePoint);
        }
        //seek(oCuePoints[sCuePoint]);
        seek(seekTime);
        cueChange(sCuePoint);
    }
    else
    {
        if (bDebug) {
            console.log('Media: Cuepoint already set: ' + sCuePoint);
        }
    }
}


function seek(time)
{
    if (bDebug) {
        console.log('Media: Seeking to time: ' + time);
    }

    if (sBrowser === 'mobile' || sBrowser === 'ipad' || bIsHtml5) {
//         if the video is not playing, start it and function calls itself again
        if(myPlayer.paused()){
            myPlayer.play();
            seek(time);
        }else{
            myPlayer.currentTime(time);
        }

    }   
    else
    {
        
         if(myPlayer.paused()){
            myPlayer.play();
            seek(time);
        }else{
            myPlayer.currentTime(time);
        }
        
        //if (modVid.isPlaying())
//        {
//           modVid.seek(time);
//        }
//        else
//        {
//           queuedTime = time;
//            modVid.play();
//        }
    }
}

function getPrice() {
    if (aCurrentVideoMetaData) {

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
                value: currentCuePoint
            }
        };

       if ( typeof sendToGoogle == 'function' ) { 
        sendToGoogle('DVS Site', 'Call To Action Menu Clicks', 'Get Price Clicked', oCustomVars);
       }
        mixpanel.track("Get Price Clicked", {
            "Category": "DVS Site",
            "Action": "Calls to Action",
            "Chapter": currentCuePoint,
            "Video ID": aCurrentVideoMetaData.referenceId,
            "Year": aCurrentVideoMetaData.year,
            "Make": aCurrentVideoMetaData.make,
            "Model": aCurrentVideoMetaData.model,
            }
        );
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

function playPreroll(ap){
   // alert('hello');
    if (bDebug) {
            console.log('Media: Preroll Set');
        }

   // var oCustomVars = {
//        1: {
//            name: 'Video Reference ID',
//            value: 'Pre-roll'
//        }
//    };
//
//    if ( typeof sendToGoogle == 'function' ) { 
//    sendToGoogle(sPlayerName, 'Player', 'Media Begin', oCustomVars);
//    }
//    mixpanel.track("Media Begin", {
//        "Category": sPlayerName,
//        "Action": "Player",
//        "Video ID": "Pre-roll",
//        "Year": aCurrentVideoMetaData.year,
//        "Make": aCurrentVideoMetaData.make,
//        "Model": aCurrentVideoMetaData.model,
//        }
//    );    
        
   myPlayer.src({"type":"video/mp4", "src":bPreRollUrl});
   if(ap){
    myPlayer.play();   
   }
    
}

function loadVideo(iKey){
    aCurrentVideoMetaData = myPlayer.mediainfo.custom_fields;
    aCurrentVideoMetaData.referenceId = myPlayer.mediainfo.reference_id;
    if (bDebug) {
        console.log('Media: Current Video Meta Data Follows:');
        console.log(aCurrentVideoMetaData);
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
    
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle(sPlayerName, 'Player', 'Video Load', oCustomVars);
    }
    mixpanel.track("Video Loaded", {
        "Category": sPlayerName,
        "Action": "Player",
        "Video ID": aCurrentVideoMetaData.referenceId,
        "Year": aCurrentVideoMetaData.year,
        "Make": aCurrentVideoMetaData.make,
        "Model": aCurrentVideoMetaData.model,
        }
    );
    
    $.ajaxCall('dvs.changehtml5Video', 'bVideoChanged=' + bVideoChanged + '&sRefId=' + aCurrentVideoMetaData.referenceId + '&iDvsId=' + iDvsId);
    
}
function playVideo(mkey,autoplay){
    //var oCustomVars = {
//        1: {
//            name: 'Video Reference ID',
//            value: aCurrentVideoMetaData.referenceId
//        },
//        2: {
//            name: 'Vehicle Year',
//            value: aCurrentVideoMetaData.year
//        },
//        3: {
//            name: 'Vehicle Make',
//            value: aCurrentVideoMetaData.make
//        },
//        4: {
//            name: 'Vehicle Model',
//            value: aCurrentVideoMetaData.model
//        }
//    };
//    if ( typeof sendToGoogle == 'function' ) { 
//    sendToGoogle(sPlayerName, 'Player', 'Media Begin', oCustomVars);
//    }
//    mixpanel.track("Media Begin", {
//        "Category": sPlayerName,
//        "Action": "Player",
//        "Video ID": aCurrentVideoMetaData.referenceId,
//        "Year": aCurrentVideoMetaData.year,
//        "Make": aCurrentVideoMetaData.make,
//        "Model": aCurrentVideoMetaData.model,
//        }
//    );


     //playVideo(myPlayer,0);
      myPlayer.catalog.getVideo(aMediaIds[mkey], function(error,video) {
        //deal with error
        myPlayer.catalog.load(video);
        $(".vjs-loading-spinner").hide();
        loadVideo(mkey);
        //seek(0);
       if(autoplay){
        myPlayer.play();
       }
       // currentPoster = myPlayer.poster();
        //console.log(aMediaIds[0]);
        //currentVideoKey = myPlayer.mediainfo.id;
        currentVideoKey = mkey;
        $(".vjs-loading-spinner").hide();
        
        });
}      
function thumbnailClick(iKey) {
   
    if (bDebug) {
        console.log('Player: Playlist Thumbnail Click: #' + iKey);
    }
    $(".vjs-custom-overlay").hide();

    if (bIsDvs) {

       // resetOverlays();
    }

    bVideoChanged = true;

   // iCurrentVideo = iKey;
//
//    bIgnoreAutoPlaySetting = true;
//
//
//    if (sBrowser === 'mobile' || sBrowser === 'ipad' || bIsHtml5) {
//        modVid.loadVideoByID(aMediaIds[iKey]);
//    }
//    else
//    {
//        modCon.getMediaAsynch(aMediaIds[iKey]);
//    }
if(preRollPlayed){
playVideo(iKey,true);
}else{
    thumbkey = iKey;
    myPlayer.play();
}
    return false;
}

function thumbnailClickDvs(iDvsId) {
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle('DVS Site', 'Playlist', 'Thumbnail Clicked');
    }
    mixpanel.track("Thumbnail Clicked", {
        "Category": "DVS Site",
        "Action": "Playlist"
    });
}
textOverlayClick = function() {
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle('DVS Site', 'Overlay Banner', 'Text Overlay Clicked');
    }
    mixpanel.track("Text Overlay Clicked", {
        "Category": "DVS Site",
        "Action": "Overlay Banner"
        });
}

customImageOverlayClick = function() {
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle('DVS Site', 'Overlay Banner', 'Custom Image Overlay Clicked');
    }
    mixpanel.track("Custom Image Overlay Clicked", {
        "Category": "DVS Site",
        "Action": "Overlay Banner"
        });
}
//function getPriceOverlayClick() {
getPriceOverlayClick = function() {
    if ( typeof sendToGoogle == 'function' ) { 
    sendToGoogle('DVS Site', 'Overlay Banner', 'Get Price Overlay Clicked');
    }
    mixpanel.track("Get Price Overlay Clicked", {
        "Category": "DVS Site",
        "Action": "Overlay Banner"
    });
}    

});
$(document).on('DOMNodeInserted', '.vjs-custom-overlay', function () {
    jQuery(".vjs-custom-overlay .vjs-endscreen-overlay-content a").attr('href',inventory_new);
});    
})
function showspinner(){
      $(".vjs-loading-spinner").show();
  }  


       
            