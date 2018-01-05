<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

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
             document.getElementById("searchResults").innerHTML = response; 
          } 
    
       } 
    
    } 

</script>

</head>
<body>

<input name="q" id="q" type="text" id="q" style="width:300px" onkeyup="sendRequest(this.value);" />
<div id="re"><div id="searchResults" style="width:292px; padding:5px; border:1px solid #000000"></div></div>

</body>
</html>
