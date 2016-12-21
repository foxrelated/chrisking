var myPlayer;
var sPlayerName = "DVS Player";
var bVideoChanged = false,
    bHasChapterClicked = false,
    urlChanged = false,
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
    aNewVideoTitle,
    interval,
    fck = 0,
    timer,
    inventory_new,
    oChapterDivs = {};

$(document).ready(function () {
    $(document).on('click', 'a#endscr_cform', function () {
        clearInterval(interval);
        $(".vjs-endscreen-overlay-content").hide();
        $(".endscr_bottom_nvideo").hide();
        $(".vjs-endscreen-overlay-content h4,.vjs-endscreen-overlay-content p").hide();
        $(".js_box").hide();
        $(".vjs-custom-overlay").addClass('vjs_dealer_form');
        $(".vjs-custom-overlay.vjs_dealer_form").css('margin-top', '0');
        $(".vjs-custom-overlay.vjs_dealer_form").css('font-size', '14px');
        $(".js_box").appendTo(".vjs-endscreen-overlay-content");
        $(".vjs-endscreen-overlay-content").show();
        $(".vjs-endscreen-overlay-content .js_box").show();
        waitForElementToDisplay(".js_box #contact_dealer", 10);
    });

    videojs("bcv2").ready(function () {
        $(document).on('submit', '#contact_dealer', function () {
            var element = $(".vjs-endscreen-overlay-content .js_box");
            if (endscreen_player == 1) {
                timer = setInterval(function () {
                    if (element.is(':hidden')) {
                        $(".endscr_bottom_nvideo").show();
                        $(".vjs-endscreen-overlay-content h4,.vjs-endscreen-overlay-content p").show();
                        $(".js_box").remove();
                        $(".vjs-custom-overlay").removeClass('vjs_dealer_form');
                        $(".vjs-custom-overlay").removeAttr('style');
                        $(".vjs-endscreen-overlay-content").show();
                        if (bAutoAdvance) {
                            $("#nvideo_timer").html(10);
                            clearInterval(interval);
                            var counter = 10;
                            interval = setInterval(function () {
                                counter--;
                                $("#nvideo_timer").html(counter);
                                // Display 'counter' wherever you want to display it.
                                if (counter == 0) {
                                    if (bDebug) {
                                        console.log('Media: Playing next video');
                                    }
                                    resetChapters('');
                                    thumbnailClick(currentVideoKey);
                                    thumbnailClickDvs();
                                    clearInterval(interval);
                                    $(".vjs-endscreen-overlay-content").hide();
                                }
                            }, 1000);
                        }
                        clearInterval(timer);
                    }
                }, 300);
            }
        });

        $(document).on('click', '.js_box .js_box_close a', function () {
            var element = $(".vjs-endscreen-overlay-content .js_box");
            if (endscreen_player == 1) {
                $(".endscr_bottom_nvideo").show();
                $(".vjs-endscreen-overlay-content h4,.vjs-endscreen-overlay-content p").show();
                $(".vjs-custom-overlay").removeClass('vjs_dealer_form');
                $(".vjs-custom-overlay").removeAttr('style');
                $(".vjs-endscreen-overlay-content").show();
                if (bAutoAdvance) {
                    $("#nvideo_timer").html(10);
                    clearInterval(interval);
                    var counter = 10;
                    interval = setInterval(function () {
                        counter--;
                        $("#nvideo_timer").html(counter);
                        // Display 'counter' wherever you want to display it.
                        if (counter == 0) {
                            if (bDebug) {
                                console.log('Media: Playing next video');
                            }
                            resetChapters('');
                            thumbnailClick(currentVideoKey);
                            thumbnailClickDvs();
                            clearInterval(interval);
                            $(".vjs-endscreen-overlay-content").hide();
                        }
                    }, 1000);
                }
            }
        });


        myPlayer = this;
        var cuePointArr = [];
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
        if (typeof sendToGoogle == 'function') {
            sendToGoogle(sPlayerName, 'Player', 'Player Loaded');
        }
        if (bPreRoll) {
            if (aPoster != '') {
                jQuery(".vjs-poster").removeClass('vjs-hidden');
                jQuery(".vjs-poster").css('background-image', 'url("' + aPoster + '")');
            }
            var preRollPlayed = false;
            var preRollAdvance = true;
        } else {
            var preRollPlayed = true;
        }

        if (preRollPlayed) {
            if (bDebug) {
                console.log('Media: No Preroll Set');
            }
            playVideo(0, bAutoplay);
        } else {
            playPreroll(bAutoplay);
        }

        myPlayer.on("loadedmetadata", function () {
            if (preRollPlayed) {
                $("#chapter_buttons").children().removeClass('selected').addClass('active');
                $("#chapter_buttons").children().removeClass('display').addClass('no_display');
                trackIndex = myPlayer.textTracks().length - 1;
                tt = myPlayer.textTracks()[trackIndex];
                cuePointArr = myPlayer.mediainfo.cue_points;

                var i, totalItems = cuePointArr.length;
                for (i = 0; i < totalItems; i++) {
                    $("#chapter_container_" + cuePointArr[i]['name']).removeClass('no_display').addClass('display');
                }
                $("#chapter_container_Get_Price").removeClass('no_display').addClass('display');
            }

            tt.oncuechange = function () {
                if ((!myPlayer.paused()) && (media_begin == 0)) {
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
                    if (typeof sendToGoogle == 'function') {
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

                if (tt.activeCues[0]) {
                    var startTime = tt.activeCues[0].startTime;
                }

                if (tt.activeCues[1]) {
                    var firstStartTime = tt.activeCues[1].startTime;
                }

                if (myPlayer.mediainfo.cue_points[0].time == startTime) {
                    if (firstStartTime) {
                        allCuePointData = getSubArray(cuePointArr, 'time', firstStartTime);
                    }
                } else {
                    allCuePointData = getSubArray(cuePointArr, 'time', startTime);
                }

                if (allCuePointData) {
                    if (allCuePointData[0]) {
                        cuePointName = allCuePointData[0].name;
                    }
                }

                if (allCuePointData) {
                    if (allCuePointData[0]) {
                        if (clicked != 1) {
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

                            if (typeof sendToGoogle == 'function') {
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
                        } else {
                            clicked = 0;
                        }
                    }
                }

                cueChange(cuePointName);

                $('#chapter_container_' + cuePointName).addClass('display selected');
                $(".vjs-loading-spinner").hide();
            }
        });

        if (endscreen_player == 1) {
            if (bAutoAdvance) {
                var endscr_bottom_nvideo = '<h4 class="endscr_bottom_nvideo"><p>Next video starts in <span id="nvideo_timer">10</span>:</p><p id="nvideo_title"></p></h4>';
            } else {
                var endscr_bottom_nvideo = '';
            }
            if (endscreen_inventory == 1) {
                var invcontent = '<p><a href=' + inventory_btn + ' class="dvs_inventory_link endscr_btn" id="dvs_inventory_link" onclick="menuInventory(\'Top Menu Clicks\');" rel="nofollow" target="_parent">' + inventory_text + '</a></p>';
            } else {
                var invcontent = '';
            }
            if (endscreen_inventory == 1 || endscreen_cform == 1 || bAutoAdvance) {
                var endscreenTitle = '<h4 class="endscr_title">Next steps...</h4>';
            } else {
                var endscreenTitle = '';
            }
            myPlayer.customEndscreen({
                "content": endscreenTitle + '' + invcontent + '' + cdContent + '' + endscr_bottom_nvideo
            })
        }

        myPlayer.overlay({
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
                content: ((bCustomOverlay3) ? bCustomOverlay3Content : ""),
                start: ((bCustomOverlay3) ? iCustomOverlay3Start : ""),
                end: ((bCustomOverlay3) ? iCustomOverlay3Start + iCustomOverlay3Duration : ""),
                align: 'top-middle'
            }]
        });

        if (!preRollPlayed && preRollUrl != '') {
            $("#bcv2 > :not(.vjs-control-bar):not(.vjs-big-play-button)").on("click", function () {
                window.open(preRollUrl, '_blank');
            });
        }

        myPlayer.on("ended", function () {
            $(".js_box").remove();
            if (navigator.userAgent.match(/(\(iPhone)/)) {
                $('video').get(0).webkitExitFullscreen();
            }
            $(".vjs-overlay").hide();
            $(".vjs-endscreen-overlay-content").fadeIn(1000);
            if (bAutoAdvance || preRollAdvance) {
                if (preRollAdvance) {
                    preRollAdvance = false;

                    if (thumbkey >= 0) {
                        currentVideoKey = thumbkey;
                        thumbkey = -1;
                    } else {
                        currentVideoKey = 0;
                    }

                    $("#bcv2> :not(.vjs-control-bar):not(.vjs-big-play-button)").off();
                    preRollPlayed = true;
                } else {
                    if (fck == 0) {
                        currentVideoKey++;
                        fck = 1;
                    }

                    if (bDebug) {
                        console.log('Player: Auto Advance enabled. Advancing to Video key: ' + currentVideoKey);
                    }
                }

                if (aMediaIds[currentVideoKey]) {
                    if (endscreen_player == 1) {
                        myPlayer.catalog.getVideo(aMediaIds[currentVideoKey], function (error, video) {
                            aNewVideoTitle = video.custom_fields;
                            $("#nvideo_title").html(aNewVideoTitle.year + " " + aNewVideoTitle.make + " " + aNewVideoTitle.model);
                        });
                    }

                    if (bAutoAdvance && endscreen_player == 1) {
                        var counter = 1000;
                        interval = setInterval(function () {
                            counter--;
                            $("#nvideo_timer").html(counter);
                            // Display 'counter' wherever you want to display it.
                            if (counter == 0) {
                                if (bDebug) {
                                    console.log('Media: Playing next video');
                                }
                                resetChapters('');

                                thumbnailClick(currentVideoKey);
                                thumbnailClickDvs();
                                clearInterval(interval);
                                $(".vjs-endscreen-overlay-content").hide();
                            }
                        }, 1000);

                    } else {
                        if (bDebug) {
                            console.log('Media: Playing next video');
                        }
                        resetChapters('');

                        thumbnailClick(currentVideoKey);
                        thumbnailClickDvs();
                    }
                }
            }
        });

        $("#chapter_buttons button").not("#chapter_container_Get_Price").on('click', function () {
            clearInterval(interval);
            $(".js_box .js_box_close a").trigger('click');
            $(".vjs-endscreen-overlay-content").hide();
            $(".vjs-custom-overlay").remove();
            var cueName = this.id;
            cueName = cueName.replace('chapter_container_', '');
            if (currentCuePoint != cueName) {
                $(".vjs-overlay").hide();
            }
            changeCuePoint(cueName);
        });

        $(document).on('click', ".playlist_carousel_image_link", function () {
            clearInterval(interval);
            $(".js_box .js_box_close a").trigger('click');
            $(".vjs-endscreen-overlay-content").hide();
            $(".vjs-overlay").hide();
            var currentVidId = this.id;
            currentVideo = currentVidId.replace('thumbnail_link_', '');
            resetChapters('');
            thumbnailClick(currentVideo);
            thumbnailClickDvs();
        });

        $("#chapter_container_Get_Price").on('click', function () {
            clearInterval(interval);
            $(".endscr_bottom_nvideo").hide();
            getPrice();
        });

        watchVideoSelect = function (aVideoSelectMediaIds) {
            bVideoChanged = true;
            aMediaIds = aVideoSelectMediaIds;
            clearInterval(interval);
            $(".js_box .js_box_close a").trigger('click');
            $(".vjs-endscreen-overlay-content").hide();
            $(".vjs-overlay").hide();
            $(".vjs-custom-overlay").hide();
            resetChapters('');

            if (preRollPlayed) {
                playVideo(0, true);
            } else {
                $(".vjs-loading-spinner").hide();
                myPlayer.play();
            }

            if (bDebug) {
                console.log("Player: Switching to Video Select");
            }
            if (typeof sendToGoogle == 'function') {
                sendToGoogle('DVS Site', 'Menu', 'Video Select');
            }
            mixpanel.track("Video Selector", {
                "Category": "DVS Site",
                "Action": "Menu"
            });
            if (bIsDvs) {
                resetOverlays();
            }
        };

        function resetChapters(className) {
            $.each(oChapterDivs, function (sChapter, sHtml) {
                // Is the chapter button we are setting to display shown before the video ended?
                if ($('#chapter_container_' + sChapter).hasClass('display')) {
                    if (className == '') {
                        $('#chapter_container_' + sChapter).attr('class', 'display active');
                    } else {
                        $('#chapter_container_' + sChapter).attr('class', 'display ' + className);
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
        }

        function cueChange(sCuePoint) {
            currentCuePoint = sCuePoint;
            sCurrentCuePoint = currentCuePoint;
            changeLights(sCuePoint);

            if (!bVideoChanged && !urlChanged && !bPreview && bIsDvs) {
                window.parent.history.pushState("string", "", sFirstVideoTitleUrl);
                urlChanged = true;
            }
        }

        function changeLights(sCuePoint) {
            if (bVideoChanged) {
                $('#chapter_buttons button.selected').removeClass('selected').attr('class', 'display active');
            } else {
                $('#chapter_buttons button.selected').attr('class', 'watched display');
            }

            if (sCuePoint === 'Intro' || sCuePoint === 'Overview') {
                $('#chapter_buttons button.disabled').addClass('active').removeClass('disabled');
                bVideoChanged = false;
            }

            $('#chapter_container_' + sCuePoint).attr('class', 'display selected');
        }

        function changeCuePoint(sCuePoint) {
            if (!$('#chapter_container_' + sCuePoint).hasClass('disabled')) {
                var seekTimeArr = getSubArray(cuePointArr, 'name', sCuePoint);
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
                if (typeof sendToGoogle == 'function') {
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
                        "Model": aCurrentVideoMetaData.model
                    }
                );
                if (bDebug) {
                    console.log('Media: Cuepoint Manually Changed to ' + sCuePoint);
                }
                if (navigator.userAgent.toLowerCase().indexOf('safari/') > -1) {
                    seek(seekTime + 0.05);
                } else {
                    seek(seekTime + 0.001);
                }

                cueChange(sCuePoint);
            }
            else {
                if (bDebug) {
                    console.log('Media: Cuepoint already set: ' + sCuePoint);
                }
            }
        }


        function seek(time) {
            if (bDebug) {
                console.log('Media: Seeking to time: ' + time);
            }

            if (sBrowser === 'mobile' || sBrowser === 'ipad' || bIsHtml5) {
                if (myPlayer.paused()) {
                    myPlayer.play();
                    seek(time);
                } else {
                    myPlayer.currentTime(time);
                }
            } else {
                if (myPlayer.paused()) {
                    myPlayer.play();
                    seek(time);
                } else {
                    myPlayer.currentTime(time);
                }
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

                if (typeof sendToGoogle == 'function') {
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
            } else {
                if (sBrowser === 'mobile') {
                    alert('Please wait for a video to start.');
                } else {
                    alert('Please wait for a video to load.');
                }
            }
        }

        function playPreroll(ap) {
            if (bDebug) {
                console.log('Media: Preroll Set');
            }

            myPlayer.src({"type": "video/mp4", "src": bPreRollUrl});
            if (ap) {
                myPlayer.play();
            }
        }

        function loadVideo(iKey) {
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

            if (typeof sendToGoogle == 'function') {
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

        function playVideo(mkey, autoplay) {
            myPlayer.catalog.getVideo(aMediaIds[mkey], function (error, video) {
                //deal with error
                try {
                    myPlayer.catalog.load(video);
                } catch (e) {
                }

                loadVideo(mkey);
                $(".vjs-loading-spinner").hide();
                if (autoplay) {
                    myPlayer.play();
                }
                currentVideoKey = mkey;
            });
        }

        function thumbnailClick(iKey) {
            if (bDebug) {
                console.log('Player: Playlist Thumbnail Click: #' + iKey);
            }

            $(".vjs-custom-overlay").hide();

            if (bIsDvs) {
            }

            bVideoChanged = true;

            if (preRollPlayed) {
                playVideo(iKey, true);
            } else {
                thumbkey = iKey;
                myPlayer.play();
            }
            fck = 0;
            return false;
        }

        function thumbnailClickDvs(iDvsId) {
            if (typeof sendToGoogle == 'function') {
                sendToGoogle('DVS Site', 'Playlist', 'Thumbnail Clicked');
            }
            mixpanel.track("Thumbnail Clicked", {
                "Category": "DVS Site",
                "Action": "Playlist"
            });
        }

        textOverlayClick = function () {
            if (typeof sendToGoogle == 'function') {
                sendToGoogle('DVS Site', 'Overlay Banner', 'Text Overlay Clicked');
            }
            mixpanel.track("Text Overlay Clicked", {
                "Category": "DVS Site",
                "Action": "Overlay Banner"
            });
        };

        customImageOverlayClick = function () {
            if (typeof sendToGoogle == 'function') {
                sendToGoogle('DVS Site', 'Overlay Banner', 'Custom Image Overlay Clicked');
            }
            mixpanel.track("Custom Image Overlay Clicked", {
                "Category": "DVS Site",
                "Action": "Overlay Banner"
            });
        };

        getPriceOverlayClick = function () {
            if (typeof sendToGoogle == 'function') {
                sendToGoogle('DVS Site', 'Overlay Banner', 'Get Price Overlay Clicked');
            }
            mixpanel.track("Get Price Overlay Clicked", {
                "Category": "DVS Site",
                "Action": "Overlay Banner"
            });
        }

    });
    $(document).on('DOMNodeInserted', '.vjs-custom-overlay', function () {
        jQuery(".vjs-custom-overlay .vjs-endscreen-overlay-content a#dvs_inventory_link").attr('href', inventory_new);
    });
    $(document).on('DOMNodeInserted', '.vjs-custom-overlay, .vjs-overlay', function () {
        $(".gp_ov").attr("onclick", 'tb_show(\'' + contact_dealer + '\', $.ajaxBox(\'dvs.showGetPriceForm\', \'height=400&width=360&iDvsId=' + jQuery("#bc_dvs").val() + '&sRefId= ' + aCurrentVideoMetaData.referenceId + '\'));getPriceOverlayClick();');
    })
});

function showspinner() {
    $(".vjs-loading-spinner").show();
}

function waitForElementToDisplay(selector, time) {
    if ($(selector).length > 0) {
        $(".js_box #contact_dealer p").wrapAll("<div class='uleft cdtxt'></div>");
        $(".js_box #contact_dealer ul, .js_box #contact_dealer input[type='submit']").wrapAll("<div class='uleft cdfields'></div>");
    } else {
        setTimeout(function () {
            waitForElementToDisplay(selector, time);
        }, time);
    }
}