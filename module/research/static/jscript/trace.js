var initialized = false;

function returnCurrentTime() {
	currentDate = new Date();
	hours = currentDate.getHours();
	minutes = currentDate.getMinutes();
	seconds = currentDate.getSeconds();
	meridian = "am";
	if(hours > 11) { meridian = "pm"; }
	if(hours > 12) { hours -= 12; }
	if(hours == 0) { hours = 12; }
	if(minutes < 10) { minutes = "0" + minutes; }
	if(seconds < 10) { seconds = "0" + seconds; }
	return hours + ":" + minutes + "." + "<span style='font-size:8pt;'>" + seconds + "</span>" + meridian + " ";
	
}
function trace(eventString) {
	if(!initialized) { setupDisplay(); }
		
	eventString = eventString.toString();
	eventString = eventString.replace(/</g,"&lt;");
	eventString = eventString.replace(/>/g,"&gt;");
	eventString = eventString.replace(/"/g,"&quot;");
	document.getElementById('trace').innerHTML = returnCurrentTime() + eventString + "<br />\n" + document.getElementById('trace').innerHTML;
}

function track(eventString, position) {
	if(!initialized) { setupDisplay(); }
	
	eventString = eventString.toString();
	eventString = eventString.replace(/</g,"&lt;");
	eventString = eventString.replace(/>/g,"&gt;");
	eventString = eventString.replace(/"/g,"&quot;");
	
	if(position == 0 || position == null) { document.getElementById("es_tracker0").innerHTML = eventString; }
	if(position == 1) { document.getElementById("es_tracker1").innerHTML = eventString; }
	if(position == 2) { document.getElementById("es_tracker2").innerHTML = eventString; }
	
}

function setupDisplay() {
	var display = document.createElement("div");
	display.position = "absolute";
	display.id = "es_traceContainer";
		var trackContainer = document.createElement("div");
		trackContainer.position = "absolute";
		trackContainer.id = "track";
		display.appendChild(trackContainer);
			trackers = new Array();
			var tracker0 = document.createElement("div");
			tracker0.id = "es_tracker0";
			trackers.push(tracker0);
			trackContainer.appendChild(tracker0);
			var tracker1 = document.createElement("div");
			tracker1.id = "es_tracker1";
			trackers.push(tracker1);
			trackContainer.appendChild(tracker1);
			var tracker2 = document.createElement("div");
			tracker2.id = "es_tracker2";
			trackers.push(tracker2);
			trackContainer.appendChild(tracker2);
			for(i = 0; i < trackers.length; i++) {
				trackers[i].style.cssFloat = "left";
				trackers[i].style.fontFamily = "Arial,Helvetica,sans-serif";
				trackers[i].style.fontStyle = "italic";
				trackers[i].style.fontWeight = "bold";
				trackers[i].style.fontSize = "9pt";
				trackers[i].style.color = "#677072";
				trackers[i].style.padding = "5px";
			}
		var trace = document.createElement("div");
		trace.position = "absolute";
		trace.id = "trace";
		trace.style.clear = "both";
		trace.style.fontFamily = "Arial,Helvetica,sans-serif";
		trace.style.fontStyle = "normal";
		trace.style.fontSize = "9pt";
		trace.style.color = "#677072";
		trace.style.borderLeft = "solid";
		trace.style.borderTop = "solid";
		trace.style.borderWidth = "1px";
		trace.style.width = "800px";
		trace.style.padding = "5px";
		trace.style.marginTop = "20px";
		display.appendChild(trace);
	document.getElementsByTagName("body")[0].appendChild(display);	
	initialized = true;
}