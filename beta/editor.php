<html><head> 
<title>Editor</title> 
<script src="editor.js"></script> 
</head><body> 
<form action="something" method="whatever" name="editform"><p><input type="button" value="bold" name="bold" onclick="javascript:tag('b', '[b]', 'bold*', '[/b]', 'bold', 'bold');" /></p> 
<p>Title: <input type="text" name="title" size="50" /><br /> 
Author: <input type="text" name="author" size="35" /><br /> 
Post:<br /> 
<textarea rows="5" cols="75" name="post"></textarea></p> 
<input type="submit" name="preview" value="Preview" /></form> 
</body></html> 