
var curURL = 0;
var toolVault = new Array();
var errorLoadingToolTip = "Error loading tooltip";
var tLoading = "Loading";

$(document).ready(function(){

	//create the tooltip
	$("body").append('<div id="globalToolTip"><table><tbody><tr><td class="tl"><em></em></td><td class="tm"></td><td class="tr"><em></em></td></tr><tr><td class="ml"></td><td class="mm" valign="top"><div id="globalToolTip_text"></div></td><td class="mr"></td></tr><tr><td class="bl"><em></em></td><td class="bm"></td><td class="br"><em></em></td></tr></tbody></table></div>');

	//store reference to the tooltip
	theGlobalToolTip = $("#globalToolTip");	
	
	//bind mouseover function for objects with class='tooltip'
	$(".hasToolTip").mouseover(function (e){
		//need ajax call for tooltip text for items
		if($(this).attr("tturl"))
		{	
				//set current item id to prevent async mixups (and clean the id)
				currURL = $(this).attr("tturl");
				
				//get the html to put in the div
				getTipHTML(currURL, this, e);
				
				//show the tooltip
				if($(theGlobalToolTip).css("display") != "block")
					$(theGlobalToolTip).show();

		}else if($(this).attr("tttext")){
			//normal tooltips (static text)
			setTipText($(this).attr("tttext"));
			setToolTipPosition(this,e); //set the position of the tooltip			
			$(theGlobalToolTip).show();
		}		
	});
	//mouseout event for objects with class='tooltip' (hide the tooltip)
	$(".hasToolTip").mouseout(function (){
		$(theGlobalToolTip).hide();	
		currURL = null; //set itemid to null (for preventing async messups)
	});
});


function getTipHTML(ajaxURL, itemWithTip, mouseEvent)
{
	
	//get the "pretty-html" for the tooltip
	if(toolVault[ajaxURL] == null)
	{		
		//set loading text  
		setTipText(tLoading+"...");
		setToolTipPosition(itemWithTip,mouseEvent);
		
		$.ajax({
			type: "GET",
			url: ajaxURL,
			success: function(msg){				
				toolVault[ajaxURL] = msg;
				
				if(toolVault[ajaxURL].length <= 4)
					toolVault[ajaxURL] = errorLoadingToolTip;
				
				//prevent showing the wrong item or an empty tooltip
				if(currURL == ajaxURL){					
					setTipText(toolVault[ajaxURL]);
					setToolTipPosition(itemWithTip,mouseEvent); //set the position of the tooltip	
				}
			},
			error: function(msg){				
				setTipText(errorLoadingToolTip);
			}
		});
	}else{
		setTipText(toolVault[ajaxURL]);
		setToolTipPosition(itemWithTip,mouseEvent); //set the position of the tooltip	
	}
}

function setToolTipPosition(tooltipObj,e)
{
	var tipPosition = getXYCoords(tooltipObj,e);
	
	//set the position
	$(theGlobalToolTip).css("left",tipPosition[0]);
	$(theGlobalToolTip).css("top",tipPosition[1]);
	$(theGlobalToolTip).show();
}
//finds the best (x,y) position to put the tooltip
function getXYCoords(tooltipObj,e)
{	
	//boolean to see if we use mouse position or not
	var useMousePosition = false;
	
	//find current x,y position
	var xPos = $(tooltipObj).offset().left;
	var yPos = $(tooltipObj).offset().top;
	
	//if the position comes back as (0,0) use the mouse position instead
	//(also adjust for scrolling!)
	if(((xPos - $(window).scrollLeft()) <= 0) && ((yPos - $(window).scrollTop()) <= 0)){
		useMousePosition =  true;
	}
	
	//get the width of the tooltip box and item we are adding tooltip to
	var tooltipWidth = -1;
	var tooltipHeight = -1;
	var itemWidth 	 = $(tooltipObj).outerWidth();
	var itemHeight 	 = $(tooltipObj).outerHeight();

	tooltipWidth = $(theGlobalToolTip).outerWidth();
	tooltipHeight = $(theGlobalToolTip).outerHeight();
	
	//if we didnt get good coordinates, use the mouse position
	if(useMousePosition == true){
		xPos = e.pageX + 7;
		yPos = e.pageY + 15;
	}
	
	//if tooltip is going to cause horizontal scrolling,
	//put it to the left of the link instead
	if((itemWidth + xPos + tooltipWidth + 5) > $(window).width()){
		xPos = xPos - tooltipWidth - 5;			
	}else{
		xPos = xPos + itemWidth + 5;
	}
	
	yPos = yPos - (tooltipHeight/2);
	//check y position
	
	//(below the fold)
	if((yPos + tooltipHeight) > $(window).height() + $(window).scrollTop()){			
		yPos = $(window).height() - tooltipHeight + $(window).scrollTop();			
	}
	
	//above fold
	if(yPos < $(window).scrollTop()){
		yPos =  $(window).scrollTop();
	}
		
	return [xPos,yPos];
}

//sets the html of thetooltip (div)
function setTipText(tipStr)
{
	//store scoped reference
	var tooltipTxt = $("#globalToolTip_text");	
	
	$(tooltipTxt).html("");
	$(tooltipTxt).append(tipStr);	
	
	if(($.browser.msie) && ($.browser.version == "6.0")){
		if($(tooltipTxt).outerWidth() > 300){
			$(tooltipTxt).css("width","300px");	
		}
	}else{
		//set max width to avoid huge tooltips
		$(theGlobalToolTip).css("max-width","400px");
		$(tooltipTxt).css("max-width","400px");			
	}
	
	//hide 2nd and 3rd column
	//$(tooltipTxt).find("td:eq(1)").css("display","none");
	//$(tooltipTxt).find("td:eq(2)").css("display","none");

	
}