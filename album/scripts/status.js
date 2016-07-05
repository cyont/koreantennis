
function addLoadEvent(loadEvent)
{
	var oldonload = window.onload;
	
   	if (typeof window.onload != 'function')
       		window.onload = loadEvent;
	
	else
	{
     		window.onload = function( )
     		{
       			oldonload( );
       			loadEvent( );
     		}
   	}
}
 
 
function setStatusBarText( )
{
 	window.status = ":: TechMynd PHP Photo Album ::";
}

addLoadEvent(setStatusBarText); 
 
window.onmouseout  = setStatusBarText( );
window.onmousemove = setStatusBarText( );
window.onmouseover = setStatusBarText( );