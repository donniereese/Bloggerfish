var b = 2; 
function tag(v, tagadd, newbut, tagclose, oldbut, name) { 
    if (eval(v)%2 == 0) { 
        eval("window.document.editform."+name+".value = newbut;"); 
        var post = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagadd; 
        window.document.editform.content.focus(); 
    } else { 
        eval("window.document.editform."+name+".value = oldbut;"); 
        var post = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagclose; 
        window.document.editform.content.focus(); 
    } 
    eval(v+"++;"); 
}