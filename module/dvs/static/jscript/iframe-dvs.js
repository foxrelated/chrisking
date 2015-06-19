function menuHome(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Home');
	mixpanel.track("Home Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});
}

function menuInventory(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Show Inventory');
	mixpanel.track("View Inventory Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});
}

function menuOffers(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Special Offers');
		mixpanel.track("Special Offers Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});

}

function menuContact(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Contact Dealer');
		mixpanel.track("Contact Dealer Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});;

}

function menuEmail(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Email Menu Link');
		mixpanel.track("Email Menu Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});

}

function menuFooter(sSource) {
	sendToGoogle('DVS iFrame', sSource, 'Footer Link Clicked');
		mixpanel.track("Footer Clicked", {
		"Category": "DVS iFrame",
		"Source": sSource
	});
}

function facebookShareClick(sSource) {
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
				value: sCurrentCuePoint
			}
		};

		sendToGoogle('DVS iFrame', sSource, 'Facebook Share Clicked', oCustomVars);
		mixpanel.track("Facebook Share Clicked", {
			"Category": "DVS iFrame",
			"Source": sSource,
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			});
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

function googleShareClick(sSource) {
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
				value: sCurrentCuePoint
			}
		};

		sendToGoogle('DVS iFrame', sSource, 'Google Share Clicked', oCustomVars);
		mixpanel.track("Google Share Clicked", {
				"Category": "DVS iFrame",
				"Source": sSource,
				"Video ID": aCurrentVideoMetaData.referenceId,
				"Year": aCurrentVideoMetaData.year,
				"Make": aCurrentVideoMetaData.make,
				"Model": aCurrentVideoMetaData.model,
				"Chapter": sCurrentCuePoint
				}
		);
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

function showEmailShare(iDvsId) {
	if (aCurrentVideoMetaData) {
		//$.ajaxCall('dvs.showShareEmail', 'iDvsId=' + iDvsId + '&sRefId=' + aCurrentVideoMetaData['referenceId']);
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

		sendToGoogle('DVS iFrame', 'Share Links', 'Email Share Clicked', oCustomVars);
		mixpanel.track("Email Share Clicked", {
			"Category": "DVS iFrame",
			"Source": "Share Links",
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			}
		);	
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

function shareEmailSent() {
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
				value: sCurrentCuePoint
			}
		};

		sendToGoogle('DVS iFrame', 'Share Links', 'Email Share Sent', oCustomVars);
		mixpanel.track("Email Share Sent", {
			"Category": "DVS iFrame",
			"Source": "Share Links",
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			}
		);
	}
}

function getPriceEmailSent() {
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
				value: sCurrentCuePoint
			}
		};

		sendToGoogle('DVS iFrame', 'Dealer Contact', 'Lead Sent', oCustomVars);
		mixpanel.track("Lead Sent", {
			"Category": "DVS iFrame",
			"Source": "Dealer Contact",
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			}
		);
	}
}

$Behavior.dvs = function() {

	// Make sure old browsers are using the new html5 placeholder functionality
	if (!Modernizr.input.placeholder) {
		$("input").each(function() {
			if ($(this).val() == "" && $(this).attr("placeholder") != "") {
				$(this).val($(this).attr("placeholder"));
				$(this).focus(function() {
					if ($(this).val() == $(this).attr("placeholder"))
						$(this).val("");
				});
				$(this).blur(function() {
					if ($(this).val() == "")
						$(this).val($(this).attr("placeholder"));
				});
			}
		});
	}

	$('.twitter_popup').click(function(event) {
		var width = 575,
			height = 400,
			left = ($(window).width() - width) / 2,
			top = ($(window).height() - height) / 2,
			url = this.href,
			opts = 'status=1' +
			',width=' + width +
			',height=' + height +
			',top=' + top +
			',left=' + left;

		window.open(url, 'twitter', opts);

		return false;
	});



	// Log any kind of Web Intent event to Google Analytics
	// Category: "twitter_web_intents"
	// Action: Intent Event Type
	// Label: Identifier for action taken: tweet_id, screen_name/user_id, click region

	// First, load the widgets.js file asynchronously

	window.twttr = (function(d, s, id) {

		var t, js, fjs = d.getElementsByTagName(s)[0];

		if (d.getElementById(id))
			return;
		js = d.createElement(s);
		js.id = id;

		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		return window.twttr || (t = {
			_e: [
			],
			ready: function(f) {
				t._e.push(f)
			}
		});

	}(document, "script", "twitter-wjs"));


	// Define our custom event handlers
	function clickEventToAnalytics(intentEvent) {
		if (!intentEvent)
			return;
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

		sendToGoogle('DVS iFrame', 'Share Links', 'Twitter Share Clicked', oCustomVars);
		mixpanel.track("Twitter Share Clicked", {
			"Category": "DVS iFrame",
			"Source": "Share Links",
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			}
		);
	}


	function tweetIntentToAnalytics(intentEvent) {
		if (!intentEvent)
			return;
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

		sendToGoogle('DVS iFrame', 'Share Links', 'Tweet Posted', oCustomVars);
		mixpanel.track("Tweet Posted", {
			"Category": "DVS iFrame",
			"Source": "Share Links",
			"Video ID": aCurrentVideoMetaData.referenceId,
			"Year": aCurrentVideoMetaData.year,
			"Make": aCurrentVideoMetaData.make,
			"Model": aCurrentVideoMetaData.model,
			"Chapter": sCurrentCuePoint
			}
		);
	}

	function favIntentToAnalytics(intentEvent) {
		tweetIntentToAnalytics(intentEvent);
	}

	function retweetIntentToAnalytics(intentEvent) {
		if (!intentEvent)
			return;
		var label = intentEvent.data.source_tweet_id;
		pageTracker._trackEvent('twitter_web_intents', intentEvent.type, label);
	}

	function followIntentToAnalytics(intentEvent) {
		if (!intentEvent)
			return;
		var label = intentEvent.data.user_id + " (" + intentEvent.data.screen_name + ")";
		pageTracker._trackEvent('twitter_web_intents', intentEvent.type, label);
	}

// Wait for the asynchronous resources to load

	twttr.ready(function(twttr) {
		// Now bind our custom intent events
		twttr.events.bind('click', clickEventToAnalytics);
		twttr.events.bind('tweet', tweetIntentToAnalytics);
		twttr.events.bind('retweet', retweetIntentToAnalytics);
		twttr.events.bind('favorite', favIntentToAnalytics);
		twttr.events.bind('follow', followIntentToAnalytics);

	});
}

function resetGetPriceForm() {
	$('#dvs_contact_success').hide();
	$('#dvs_contact_form').show();
	$('#contact_name').val('');
	$('#contact_email').val('');
	$('#contact_phone').val('');
	$('#contact_zip').val('');
	$('#comments').val('');
}