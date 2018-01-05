
var GClockDisplay = '     ';

function GClockInit () {
   var clocks = getElementsByClass(document, 'Gclock', 'div');

   if (clocks.length) {
      var a;	   
      for (var i = 0; i < clocks.length; i++)
         if (a = clocks[i].getAttribute('GcStyle')) {
	    var html = '';	 
	    for (var j = 0 ; j < a.length; j++)	 
               html += "<span class='GC"+j+"'></span>"
	    clocks[i].innerHTML = html;
	 }
      clockId = setInterval ("GClockTick()", 500);
   }
   
   removeEvent (window, 'load', GClockInit, false);
}

function GClockTick () {
   var 
      tDate = new Date(),
      h = tDate.getHours (),
      m = tDate.getMinutes (),
      s = tDate.getSeconds ();
      
   var bdisp = ('S'+h).slice (-2) + ((1 & s) ? 'S' : 'C') + ('0'+m).slice (-2);

   if (bdisp != GClockDisplay) {     
      var clocks = getElementsByClass(document, 'Gclock', 'div');
      var avalue, fdisp;
      for (var c = 0; c < clocks.length; c++) {
         fdisp = (fdisp = clocks[c].getAttribute('GcFormat')) ? fdisp : "%G~%j";
	 fdisp = fdisp.replace ('%a', (h < 12) ? 'am' : 'pm');
	 fdisp = fdisp.replace ('%A', (h < 12) ? 'AM' : 'PM');
	 fdisp = fdisp.replace ('%g', (' '+(h % 12)).slice (-2));
	 fdisp = fdisp.replace ('%G', (' '+h).slice (-2));
	 fdisp = fdisp.replace ('%h', ('0'+((h>12)?h-12:h)).slice (-2));
	 fdisp = fdisp.replace ('%H', ('0'+h).slice (-2));
	 fdisp = fdisp.replace ('%j', ('0'+m).slice (-2));
	 fdisp = fdisp.replace ('%s', ('0'+s).slice (-2));
	      
         if (avalue = clocks[c].getAttribute('GcStyle')) {
            var chN;
            for (var i = 0; i < fdisp.length; i++) {
   	       chN = (' ' == (chN = fdisp.charAt(i))) ? 'S' : (('~' == chN) ? ((1 & s) ? 'S' : 'C') : chN);
	       var digits = getElementsByClass (clocks[c], 'GC'+i, 'span');
	       if (digits[0].className != 'GC'+i+' Gc'+chN+'_'+avalue)
                  for (var j = 0; j < digits.length; j++)
  	             digits[j].className = 'GC'+i+' Gc'+chN+'_'+avalue;
	       }
	 }
         else if (clocks[c].innerHTML != fdisp)
            clocks[c].innerHTML = fdisp.replace (/~/g, ((1 & s) ? ' ' : ':'));
		  
	 if (((s % 10) == 0) && (avalue = clocks[c].getAttribute ('GcAlarm'))) {
	    avalue = avalue.match (/^(\d\d?):(\d\d?)(:\d0)?\s+(.*)$/);
	    if (avalue.length && (avalue[1] == h) && (avalue[2] == m) && 
	       (((typeof avalue[3] == 'undefined') ? '00' : avalue[3]).slice(-2) == s)) {
               try  { eval (avalue[4]);} 
	       catch (e) { alert (avalue[4]); }
	    }
	 }
      }
   }
   GClockDisplay = bdisp;
}

if (window.addEventListener)
  window.addEventListener ('load', GClockInit, true);
else if (window.attachEvent)
  window.attachEvent ("onload", GClockInit);

