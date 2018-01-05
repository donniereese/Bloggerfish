<?php
include("library.php");
session_start();

if($_POST['button'] == "Sign In") {
	if($_POST['name'] == "buddha" && $_POST['pass'] == "dredgeblue") {
		$_SESSION['auth'] = True;
	}
}
if($_SESSION['auth'] == True) {
	
}

if($_POST['action'] == "newCard") {
	
}

function listDef($type) {
	$def = library($type);
	print "<ul>";
	foreach($def as $d) {
		print "<li>" . $d['lat'] . " -- " . $d['en'] . "</li>";
	}
	print "</ul>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Flash</title>

<link href="style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" language="javascript">
    function makeRequest(url) {
        var httpRequest;

        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            httpRequest = new XMLHttpRequest();
            if (httpRequest.overrideMimeType) {
                httpRequest.overrideMimeType('text/xml');
                // See note below about this line
            }
        } 
        else if (window.ActiveXObject) { // IE
            try {
                httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
            } 
            catch (e) {
                try {
                    httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                } 
                catch (e) {}
            }
        }

        if (!httpRequest) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = function() { alertContents(httpRequest); };
        httpRequest.open('GET', url, true);
        httpRequest.send('');

    }

    function alertContents(httpRequest) {

        if (httpRequest.readyState == 4) {
            if (httpRequest.status == 200) {
				
                alert(httpRequest.responseText);
            } else {
                alert('There was a problem with the request.');
            }
        }

    }
	
	
	
	//Info
	var groups = new Array();
	var card = new Array();
	
	var base_url = "http://www.bloggerfish.com/development/flashcard/webget.php?";
	
	function getCard() {
		makeRequest(
	}
	
	function guessMe() {
		var gtext = document.getElementById("GuessText");
		makeRequest("http://www.bloggerfish.com/development/flashcard/webget.php?type=get&guess=" + gtext);
	}
	
	function getGroups() {
		
	}
</script>
</head>

<body>
<div id="card" class="left">
	<h1 id="definition"></h1>
	<h2 id="response"></h2>
		<div id="guessbox" class="center">
			<input name="GuessText" id="GuessText" type="text" />
			<button name="Guess" onclick="guessMe()">Guess</button>
		</div>
</div>
	
	<div id="control" class="right">
		<?php
		if($_SESSION['auth'] == True) {
			listDef();
		} else {
			print<<<SIGNIN
			<form action="index.php" method="post" name="signin">
				<input name="name" type="text" />
				<input name="pass" type="pass" />
				<input name="button" type="submit" value="Sign In" />
			</form>
SIGNIN;
		}
		?>
	</div>
</body>
</html>
