//First lets initiate some variables

var isEditable= false;
var isIE;
var isGecko;
var isSafari;
var isKonqueror;

function initiateEditor() {
 //check what browser is in use
 var browser = navigator.userAgent.toLowerCase();
 isIE = ((browser .indexOf( "msie" ) != -1) && (browser .indexOf( "opera" ) == -1) && (browser .indexOf( "webtv" ) == -1));
 isGecko = (browser .indexOf( "gecko" ) != -1);
 isSafari = (browser .indexOf( "safari" ) != -1);
 isKonqueror = (browser.indexOf( "konqueror" ) != -1);
 
 //enable designMode if the browser is not safari or konqueror.
 if (document.getElementById && document.designMode && !isSafari && !isKonqueror) {
   isEditable= true;
 }
}
//Javascript function dislpayEditor will create the textarea.

function displayEditor(editor, html, width, height) {
   if(isEditable){
       document.writeln('<iframe id="' + editor + '" name="' + editor + '" width="' + width + 'px" height="' + height + 'px"></iframe>');
//create a hidden field that will hold everything that is typed in the textarea
       document.writeln('<input type="hidden" id="hidden' + editor + '" name="' + editor + '" value="">');
//assign html (textarea value) to hiddeneditor
      document.getElementById('hidden' + editor).value = html;
//call function designer
      designer(editor, html);
   }else{
     document.writeln('<textarea name="' + editor + '" id="' + editor + '" cols="39" rows="10">' + html + '</textarea>');
   }
}

//this is designer function that enables designMode and writes defalut text to the text area
function designer(editor, html) {
     var mainContent= "<html id=\"" + editor + "\"><head></head><body>" + html + "</body></html>";
//assign the frame(textarea) to the edit variable using that frames id
     var edit = document.getElementById(editor).contentWindow.document;
//write the content to the textarea
      edit.write(mainContent);
//enable the designMode
      edit.designMode =  "On" ;
//enable the designMode for Mozilla
     document.getElementById(content).contentDocument.designMode = "on" ;
}

//To execute command we will use javascript function execCommand.
function editorCommand(editor, command, option) {
// first we assign the content of the textarea to the variable mainField
    var mainField;
          mainField = document.getElementById(editor).contentWindow;
 // then we will use execCommand to execute the option on the textarea making sure the textarea stays in focus
   try {
          mainField.focus();
          mainField.document.execCommand(command, false, option);
          mainField.focus();
    } catch (e) { }
}

function updateEditor(editor) {
 if (!isEditable) return;
//assign the value of the textarea to the hidden field.
 var hiddenField = document.getElementById('hidden' + editor);
 if (hiddenField.value == null) hiddenField.value = "";
  hiddenField.value = document.getElementById(editor).contentWindow.document.body.innerHTML;
}