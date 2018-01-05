function liveText(e) {
	var code;
	if (!e) var e = window.event;
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);
	if(!line)
		var line = character;
	else
		line = line + character;
	contentid = xGetElementById("content");
	contentid.innerHTML = line;
}

function checkKey(e) {
	var key=e.keyCode || e.which;
	contentid = xGetElementById("content");
	contentid.innerHTML = key;
}
