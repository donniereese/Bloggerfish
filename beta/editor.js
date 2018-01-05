var b = 2;
var u = 2;
var i = 2;
var s = 2;
var full_count = 1500;
function tag(v, tagadd, newbut, tagclose, oldbut, name) { 
    if (eval(v)%2 == 0) { 
        eval("window.document.editform."+name+".value = newbut;"); 
        var content = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagadd; 
        window.document.editform.content.focus(); 
    } else { 
        eval("window.document.editform."+name+".value = oldbut;"); 
        var content = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagclose; 
        window.document.editform.content.focus(); 
    } 
    eval(v+"++;"); 
}

function smile(smily) { 
    var content = window.document.editform.content.value; 
    window.document.editform.content.value = content + smily; 
    window.document.editform.content.focus();
}

function txtcount(name) { 
    var count = window.document.editform.content.value.length; 
    window.document.editform.counter.value = count+1;
	window.document.editform.content.focus();
}

function refocus() { 
    window.document.editform.counter.focus();
    window.document.editform.content.focus();
}