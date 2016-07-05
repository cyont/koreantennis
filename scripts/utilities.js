function addEvent(obj, evType, fn){ 
// Function addEvents
// Cross-browser method for adding an event (from: http://www.sitepoint.com/article/simple-tricks-usable-forms)
// IN: 	Object to add the event to (window, document, element, etc)
//		Event Type (Click, load, focus, etc)
//		Reference to function to be called on event
// OUT:	boolean 
 if (obj.addEventListener){ 
    obj.addEventListener(evType, fn, true); 
    return true; 
 } else if (obj.attachEvent){ 
    var r = obj.attachEvent("on"+evType, fn); 
    return r; 
 } else { 
    return false; 
 } 
} 

function toggleDisplay(calledBy, targetStr) {
	effect = new Effect.toggle(targetStr,"appear",{duration: 1});
	toggleToggle.toggle = calledBy;
	window.setTimeout(function(){toggleToggle(calledBy)}, 1000);
}

function toggleToggle(toggle) {
	toggle.innerHTML = (toggle.innerHTML == "open")?"close":"open";	
	
}


function inspect(elm){
/*
 * inspect - pass an object reference, and the function will alert
 * all of the object's properties.
*/
	var str = "";
	for (var i in elm){
		str += i + ": " + elm.getAttribute(i) + "\n";
	}
	alert(str);
}

// ------------------------------------------------------------------
// formatDate (date_object, format)
// Returns a date in the output format specified.
// The format string uses the same abbreviations as in getDateFromFormat()
// ------------------------------------------------------------------
function formatDate(date,format) {
	format=format+"";
	var result="";
	var i_format=0;
	var c="";
	var token="";
	var y=date.getYear()+"";
	var M=date.getMonth()+1;
	var d=date.getDate();
	var E=date.getDay();
	var H=date.getHours();
	var m=date.getMinutes();
	var s=date.getSeconds();
	var yyyy,yy,MMM,MM,dd,hh,h,mm,ss,ampm,HH,H,KK,K,kk,k;
	// Convert real date parts into formatted versions
	var value=new Object();
	if (y.length < 4) {y=""+(y-0+1900);}
	value["y"]=""+y;
	value["yyyy"]=y;
	value["yy"]=y.substring(2,4);
	value["M"]=M;
	value["MM"]=LZ(M);
	value["MMM"]=MONTH_NAMES[M-1];
	value["NNN"]=MONTH_NAMES[M+11];
	value["d"]=d;
	value["dd"]=LZ(d);
	value["E"]=DAY_NAMES[E+7];
	value["EE"]=DAY_NAMES[E];
	value["H"]=H;
	value["HH"]=LZ(H);
	if (H==0){value["h"]=12;}
	else if (H>12){value["h"]=H-12;}
	else {value["h"]=H;}
	value["hh"]=LZ(value["h"]);
	if (H>11){value["K"]=H-12;} else {value["K"]=H;}
	value["k"]=H+1;
	value["KK"]=LZ(value["K"]);
	value["kk"]=LZ(value["k"]);
	if (H > 11) { value["a"]="PM"; }
	else { value["a"]="AM"; }
	value["m"]=m;
	value["mm"]=LZ(m);
	value["s"]=s;
	value["ss"]=LZ(s);
	while (i_format < format.length) {
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		if (value[token] != null) { result=result + value[token]; }
		else { result=result + token; }
		}
	return result;
	}
var MONTH_NAMES=new Array('January','February','March','April','May','June','July','August','September','October','November','December','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var DAY_NAMES=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
function LZ(x) {return(x<0||x>9?"":"0")+x}

addEvent(window,"load", function() {
	if (typeof($("searchTerm")) != "undefined") {								 
		$("searchTerm").value = "Search";
		addEvent($("searchTerm"),"focus", function() {$("searchTerm").value=""});
	}
});
