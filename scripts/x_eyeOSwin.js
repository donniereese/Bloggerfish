var maxZ;
var topapp = null;

function Setup (win)
{	
   topapp = xGetElementById (win);
   if (ele = xGetElementById (win + 'DBar')) {
      xEnableDrag (ele, toTop, onDrag, endOp);
      if (ele = xGetElementById (win + 'DDow'))
         xEnableDrag (ele, toTop, onDrag, endOp);
      if (ele = xGetElementById (win + 'RBtn'))
         xEnableDrag (ele, toTop, onResize, endOp);
      if (ele = xGetElementById (win + 'MBtn'))
         xGetElementById (ele).onclick = MBtnOnClick;;
   } else
      xEnableDrag (win, toTop, null, endOp);
   xShow (win);
   dbgMessage (win + ' at '+xLeft(win)+', '+xTop(win) + ' z = ' + xZIndex(win));
}

function ico (win)
{	
   topapp = xGetElementById (win);
   if (ele = xGetElementById (win + '.ico')) {
      xEnableDrag (ele, toTop, onDrag, endOp);
   } else
      xEnableDrag (win, toTop, null, endOp);
   xShow (win);
   dbgMessage (win + ' at '+xLeft(win)+', '+xTop(win) + ' z = ' + xZIndex(win));
}


function register_button (win, target)
{	
   topapp = xGetElementById (win);
   if (ele = xGetElementById (win)) {
      xEnableDrag (ele, xVisibility(target, 'true'), xVisibility(target, 'false'));
   } else
      xEnableDrag (win, toTop, null, endOp);
   xShow (win);
   dbgMessage (win + ' at '+xLeft(win)+', '+xTop(win) + ' z = ' + xZIndex(win));
}

function showorhide(id) {
if (document.getElementById(id).style.visibility == "hidden") {
document.getElementById(id).style.visibility = "visible";
} else {
document.getElementById(id).style.visibility = "hidden";
}
}

function slide(id,dir,dist) {
	var slideid = xGetElementById(id);
	if(dir == 'up') {
		for (i = 0; i <= dist; i++) {
			setcss(id,top,20);
		}
	}
}

function setcss(id,ccsrule,value) {
	var elemid = xGetElementById(id);
	elemid.style.cssrule = value;
}


// --- End User Functions --- //


function toTop (ele, mx, my)
{
   var e1 = xGetElementById (ele.id.substring (0, ele.id.length-4));
   ele = e1 ? e1 : ele;
  
   if (topapp != ele) {
      xZIndex (topapp = ele, ++maxZ);
      dbgMessage ("toTop ("+ ele.id+") = " + maxZ);
   }
   
}

function onDrag (ele, dx, dy)
{
   var e1 = xGetElementById (ele.id.substring (0, ele.id.length-4));
   ele = e1 ? e1 : ele;
   
   xLeft (ele, xLeft(ele) + dx);
   xTop (ele, xTop(ele) + dy);
}


function endOp (ele)
{
   var e1 = xGetElementById (ele.id.substring (0, ele.id.length-4));
   ele = e1 ? e1 : ele;

   dbgMessage ("endOp ("+ele.id + ") at "+ xLeft(ele) + ', ' + xTop(ele));	
   sendWindowPos (ele.id, xLeft (ele), xTop (ele), xWidth (ele), xHeight (ele), xZIndex (ele));
}


function onResize (ele, mdx, mdy)
{
   var e1 = xGetElementById (ele.id.substring (0, ele.id.length-4));
   ele = e1 ? e1 : ele;

   if (xWidth (ele) > 100 && xHeight (ele) > 50)
    xResizeTo (ele, xWidth (ele) + mdx, xHeight (ele) + mdy);
  else
    xResizeTo (ele, 105, 55);
}

function MBtnOnClick (ev)
{
//  fixE (ev);
  var id = xGetElementById (ev.currentTarget.id.substring (0, ev.currentTarget.id.length-4));
  
  if (id.maximized) {
    id.maximized = false;
    xResizeTo(id, id.prevW, id.prevH);
    xMoveTo(id, id.prevX, id.prevY);
  }
  else {
    id.prevW = xWidth(id);
    id.prevH = xHeight(id);
    id.prevX = xLeft(id);
    id.prevY = xTop(id);
    xMoveTo(id, xScrollLeft(), 5);
    id.maximized = true;
    xResizeTo(id, xClientWidth(), xClientHeight() - 80);
  }
}


function dbgMessage (msg) {
   if (dbg = xGetElementById ('eyeOSdbg')) {
      dbg.innerHTML = msg + '<br />' + dbg.innerHTML;
   }
}

function newReq () {
   var req = false;
   if (window.XMLHttpRequest) {
      try {
         req = new XMLHttpRequest();
      } catch(e) {
         req = false;
      }
   } else if(window.ActiveXObject) {
      try {
         req = new ActiveXObject("Msxml2.XMLHTTP");
      } catch(e) {
	 alert (e)     
         try {
            req = new ActiveXObject("Microsoft.XMLHTTP");
         } catch(e) {
            alert (e)		 
            req = false;
         }
      }
   }
   return req;
}

var movereport = false;
function sendWindowPos (app, x, y, w, h, z) {
   while (movereport) {
   
   }

   if (movereport = newReq ()) {  
      movereport.onreadystatechange = clearMoveReq;
      movereport.open ("GET", "desktop.php?pos="+app+"&x="+x+"&y="+y+"&w="+w+"&h="+h+"&z="+z, true);
      movereport.send ("");
   } else
      alert ('Cannot create movereport Request');
}

function clearMoveReq () {
   if (movereport.readyState == 4)
      movereport = false;
}


var syscallreq = false;
function sysCall (module, action,  msg) {
   if (syscallreq = newReq ()) {
      syscallreq.onreadystatechange = clearSysCallReq;
      syscallreq.open ("GET", "desktop.php?syscall=["+module+"]["+action + "][" + msg + "]", true);
      syscallreq.send ("");
   }
}

function clearSysCallReq () {
   if (syscallreq.readyState == 4)
      syscallreq = false;
}


function addEvent(obj, evType, fn, useCapture){
  if (obj.addEventListener){
    obj.addEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.attachEvent){
    var r = obj.attachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be attached");
  }
}

function removeEvent(obj, evType, fn, useCapture){
  if (obj.removeEventListener){
    obj.removeEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.detachEvent){
    var r = obj.detachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
}

function getElementsByClass (node, searchClass, tag) {
   var classElements = new Array();
   var els = node.getElementsByTagName(tag); // use "*" for all elements
   var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
   for (i = 0, j = 0; i < els.length; i++)
      if (pattern.test(els[i].className))
         classElements[j++] = els[i];
   return classElements;
}


