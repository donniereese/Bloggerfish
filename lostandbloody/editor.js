function active(name) { 
    eval("window.document.newpost."+name+".style.font-weight = 'bold';"); 
}

function notactive(name) { 
    eval("window.document.newpost."+name+".style.font-weight = 'normal';");
}