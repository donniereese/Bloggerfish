<html>
<head>
<title>Rich Text Editor</title>

</head>
<body>
<script language= "JavaScript" type= "text/javascript" src= "editor.js" ></script>
<table width="750">
<form action="form.php" name="edit" method="POST" id="edit" onsubmit="return submitForm();">
<tr>
<td> <a href= "javascript:editorCommand('content', 'bold', '')" ><img src="images/bold.gif" width="25" height="24" alt="Bold" title="Bold"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'underline', '')" ><img  src="images/underline.gif" width="25" height="24" alt="Underline" title="Underline"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'italic', '')" ><img  src="images/italic.gif" width="25" height="24" alt="Italic" title="Italic"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'justifyleft', '')" ><img  src="images/j_left.gif" width="25" height="24" alt="Align Left" title="Align Left"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'justifycenter', '')" ><img src="images/j_center.gif" width="25" height="24" alt="Align Center" title="Align Center"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'justifyright', '')" ><img src="images/j_right.gif" width="25" height="24" alt="Align Right" title="Align Right"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'indent', '')" ><img src="images/indent.gif" width="25" height="24" alt="Indent" title="Indent"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'outdent', '')" ><img src="images/outdent.gif" width="25" height="24" alt="Outdent" title="Outdent"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'undo', '')" ><img src="images/undo.gif" width="25" height="24" alt="Undo" title="Undo"></a> </td>

<td> <a href= "javascript:editorCommand('content', 'redo', '')" ><img src="images/redo.gif" width="25" height="24" alt="Redo" title="Redo"></a> </td>

<td width="100%" align="levt">Shift+Enter for single line spacing</td>
</tr>
<tr>
<td colspan="12">
<script language= "JavaScript" type= "text/javascript" >
<!--
function submitForm() {
 updateEditor('content');
  return true;
}

initiateEditor();
//-->
</script>
<script language= "JavaScript" type= "text/javascript" >
    //this calles displayEditor function. Parametars are (textarea name, textarea  width, textarea  height)
    displayEditor('content', '', 600, 300);
//-->
</script>
</td>
</tr>
<tr><td colspan="12"> <input type="submit" name="Submit" value="Submit"> </td></tr>
</form>
</table>

</body>
</html>