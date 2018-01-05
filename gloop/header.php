<html>
<head>
<STYLE>
body {
	background: url(system/images/tile.png);
	color:#CCFF33;
	}
.opaque-back {
	visibility: hidden;
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	background-color: #363042;
	filter:alpha(opacity=60);
	-moz-opacity:.60;
	opacity:.60;
	}

.opaque-back:hover {
	visibility: hidden;
	position: absolute;
	top: 0px;
	left: 0px;
	width: 100%;
	height: 100%;
	background-color: #363042;
	filter:alpha(opacity=100);
	-moz-opacity:.100;
	opacity:.100;
	}

.window-save-container {
	visibility: hidden;
	position: absolute;
	top:30%;
	left:25%;
	width:50%;
	height:40%;
	color: #99CC33;
	padding:8px;
	}

.window-save-back {
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height:100%;
	background-color: #ffffff;
	filter:alpha(opacity=20);
	-moz-opacity:.20;
	opacity:.20;
	}

.window-save-box {
	position: relative;
	width:100%;
	height:100%;
	background-color: #F0F4F8;
	}
</STYLE>

<script type='text/javascript' src='system/scripts/gclock.js'></script>
<script type='text/javascript' src='system/scripts/x_core.js'></script>
<script type='text/javascript' src='system/scripts/x_event.js'></script>
<script type='text/javascript' src='system/scripts/x_drag.js'></script>
<script type='text/javascript' src='system/scripts/x_eyeOSwin.js'></script>


<script language="javascript">

    function createRequestObject() { 

       var req; 
    
       if(window.XMLHttpRequest){ 
          // Firefox, Safari, Opera... 
          req = new XMLHttpRequest(); 
       } else if(window.ActiveXObject) { 
          // Internet Explorer 5+ 
          req = new ActiveXObject("Microsoft.XMLHTTP"); 
       } else { 
          // There is an error creating the object, 
          // just as an old browser is being used. 
          alert('Problem creating the XMLHttpRequest object'); 
       } 
    
       return req; 
    
    } 
    
    // Make the XMLHttpRequest object 
    var http = createRequestObject(); 
    
    function sendRequest(q) { 
    
       // Open PHP script for requests 
       http.open('get', 'fetch.php?q='+q); 
       http.onreadystatechange = handleResponse; 
       http.send(null); 
    
    } 
    
	function handleResponse() { 
    	if(http.readyState == 4 && http.status == 200){ 
          // Text returned FROM the PHP script 
          var response = http.responseText; 
    
          if(response) { 
             // UPDATE ajaxTest content
			 if(response == "")
			 	document.getElementById("test").style.height = "0px";
			else 
             document.getElementById("test").innerHTML = response; 
          } 
    
       } 
    
    } 

</script>


</head>
<body>
