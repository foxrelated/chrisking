function sendToGoogle(sCategory, sAction, sLabel, oCustomVars) {

	if (typeof bGoogleAnalytics == 'undefined' || !bGoogleAnalytics) {
		return false;
	}

	var bCustom = (typeof oCustomVars != 'undefined' ? true : false);

	if (typeof window.sDvsGoogleId == 'undefined' || !window.sDvsGoogleId) {
		var sDvsGoogleId = false;
	} else {
		var sDvsGoogleId = window.sDvsGoogleId;
	}

	if (typeof window.sGlobalGoogleId == 'undefined' || !window.sGlobalGoogleId) {
		var sGlobalGoogleId = false;
	} else {
		sGlobalGoogleId = window.sGlobalGoogleId;
	}

	if (bDebug && (sDvsGoogleId || sGlobalGoogleId)) {
		console.log('Google: Custom Vars Set.');
		console.log('Google: Google Analytics Outgoing for' + (sDvsGoogleId ? ' DVS (' + sDvsGoogleId + ')' : '') + (sDvsGoogleId && sGlobalGoogleId ? ', and' : '') + (sGlobalGoogleId ? ' Global (' + sGlobalGoogleId + ')' : '') + '.');
		console.log('Google: Category: "' + sCategory + '", Action: "' + sAction + '", Label: "' + sLabel + '"');
		if (bCustom) {
			console.log('Google: Custom Vars Set.');
		} else {
			console.log('Google: No Custom Vars Set.');
		}
	}

	// Google Analytics Vars: Command, Category, Action, Opt_label, Opt_value, Opt_noninteraction
	if (sDvsGoogleId != '') {
		_gaq.push(['_setAccount', sDvsGoogleId]);

		if (bCustom) {
			for (var iVarIndex in oCustomVars) {
				if (oCustomVars.hasOwnProperty(iVarIndex)) {
					if (bDebug) {
						console.log('Google: (DVS) Setting Custom Variable #' + iVarIndex + ', "' + oCustomVars[iVarIndex].name + '" to "' + oCustomVars[iVarIndex].value + '"');
					}

					_gaq.push(['_setCustomVar', parseInt(iVarIndex), oCustomVars[iVarIndex].name, oCustomVars[iVarIndex].value]);
				}
			}
		}

		_gaq.push(['_trackEvent', sCategory, sAction, sLabel]);
	}

	if (sGlobalGoogleId) {
		_gaq.push(['_setAccount', sGlobalGoogleId]);

		if (typeof sDvsTitleUrl != 'undefined' && sDvsTitleUrl) {
			sCategory = '{' + sDvsTitleUrl + '}: ' + sCategory;

			if (bDebug) {
				console.log('Google: (Global) Modifying Category to: ' + sCategory);
			}
		}

		if (bCustom) {
			for (var iVarIndex in oCustomVars) {
				if (oCustomVars.hasOwnProperty(iVarIndex)) {
					if (bDebug) {
						console.log('Google: (Global) Setting Custom Variable #' + iVarIndex + ', "' + oCustomVars[iVarIndex].name + '" to "' + oCustomVars[iVarIndex].value + '"');
					}

					_gaq.push(['_setCustomVar', parseInt(iVarIndex), oCustomVars[iVarIndex].name, oCustomVars[iVarIndex].value]);
				}
			}
		}

		_gaq.push(['_trackEvent', sCategory, sAction, sLabel]);
	}

}