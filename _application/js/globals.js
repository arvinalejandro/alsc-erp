/*
|-------------------------------------------------------------
|	GLobals Declaration
|-------------------------------------------------------------
*/

	GLOBALS	=	{};

/*
|-------------------------------------------------------------
|	Mis
|-------------------------------------------------------------
*/

	GLOBALS.pr	=	function(data) 
	{  		
		try{
		$(document).ready(function() 
		{
			var varJson		=	JSON.stringify(data, null, 2);
			//$('body').html('<pre>' + varJson  + '</pre>');
			alert(varJson);
		}); 
		}
		catch(err) {alert(err)}
	}
	
	GLOBALS.setNavigation	=	function(data)
	{
		// data[main selector] = selector value
		// data[sub selector] = selector value
		for(var x in data)
		{
			var varSelectorGroup		=	'._' + data[x] + '_';			
			$(varSelectorGroup).addClass('selected');				
		}		
	}
	
	GLOBALS.error			=	{};
	
	GLOBALS.actions			=	{};

/*
|-------------------------------------------------------------
|	Jquery Plugins invoke
|-------------------------------------------------------------
*/

	GLOBALS.calendar	=	function(selector, handle, settings)
	{
		settings	=	(settings) ? settings : { dateFormat: 'M.dd.yy', changeMonth: true, changeYear: true, yearRange: '1950:2030' };
		$(selector).datepicker(settings);	
	}

	GLOBALS.mce			=	function(height)
	{
		height		=		(height) ? height : '300px';
		tinyMCE.init({
			
			// Layout
			width 									: 	"100%",
			height									: 	height,	
			
			// Mode			
			mode 									: 	"specific_textareas",
			editor_selector 						: 	"_mce_",
        	selector								:	'textarea',
        	theme_advanced_toolbar_location 		: "top",
			theme_advanced_toolbar_align 			: "left",		
			theme_advanced_resizing 				: false,	
        	
        	// Plugins			
			plugins 								: "paste", //removed 'fullscreen,code' to disable right click 
			paste_as_text							: false,
			paste_auto_cleanup_on_paste 			: false,

			menubar									: "view",
			menu									: { view: {title: 'View', items: 'fullscreen code'}	},
			style_formats							: [{title: 'Subheader', block: 'h2', classes: ''},{title: 'Paragraph', block: 'p', classes: ''}],		
			toolbar1								: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist",

			
			// Output
			content_css 							: "/_application/content/css/style.global.css",
			statusbar								: false,
			apply_source_formatting 				: true,
			convert_fonts_to_spans 					: false,
			convert_newlines_to_brs 				: false,
			invalid_elements 						: "em,img",			
           	add_unload_trigger 						: false
   			
		});
	}


/*
|-------------------------------------------------------------
|	Events
|-------------------------------------------------------------
*/

	GLOBALS.events				=	{};
	GLOBALS.events.eventList	=	{};

	GLOBALS.events.add	=	function(eventName, eventFunction)
	{
		if(GLOBALS.events.eventList[eventName])
		{
			GLOBALS.events.eventList[eventName].push(eventFunction);
		}
		else
		{
			GLOBALS.events.eventList[eventName] = [];
			GLOBALS.events.eventList[eventName].push(eventFunction);	
		}	
	}

	GLOBALS.events.trigger	=	function(eventName)
	{
		if(GLOBALS.events.eventList[eventName])
		{
			for(var x in GLOBALS.events.eventList[eventName])
			{
				GLOBALS.events.eventList[eventName][x]();
			}
		}
		else
		{
			//alert(eventName + " : this event is not yet registered");
		}
	}

/*
|-------------------------------------------------------------
|	Ajax
|-------------------------------------------------------------
*/

AJAX_ALLOW	=	true;
AJAX		=	{};
	
function global_ajax_request(p_url, p_handler, p_post) 
{
	if(AJAX_ALLOW)
	{
		AJAX_ALLOW	=	false;
		AJAX	=	$.ajax					
					({
						url 		: 	p_url,
						type 		: 	'POST',
						data 		: 	p_post,
						//beforeSend	:	_add_before_send,
						complete	: 	ajax_complete,
						success 	: 	p_handler
					});	
	}	
}

function ajax_complete()
{
	AJAX_ALLOW	=	true;
}


function cancel_ajax()
{
	if(!AJAX_ALLOW)
	{
		AJAX.abort();
		AJAX_ALLOW	=	true;
	}	
}	

function submit_form(form_name)
{
	document[form_name].submit();
}

function submit_enter(form_name, event)
{
	if(event.keyCode == 13)
	{
		submit_form(form_name);
	}
	
}

function enter_event(action, event)
{
	if(event.keyCode == 13)
	{
		action();
	}
}

function go_to(url)
{
	window.location	=	url;	
}

/*
|-------------------------------------------------------------
|	Pop Up
|-------------------------------------------------------------
*/

function popup_close()
{
	$('#popup').hide('fast');
}

function popup(popup_heading, popup_message, popup_action)
{
	$('#popup_heading').html(popup_heading);
	$('#popup_message').html(popup_message);
	
	if(popup_action)
	{
		$('#popup_button_custom').bind('click', popup_action).removeClass('display_none');
	}
	
	$('#popup').removeClass('display_none').show('fast');
	
	//$('#popup_button').focus();
	
}

function jq_toggle_class(aClass, aSelector)
{
	var jqObject	=	$(aSelector);		
	if(jqObject.hasClass(aClass))
	{
		jqObject.removeClass(aClass)
	}
	else
	{
		jqObject.addClass(aClass)
	}

}		


function jq_removeClass(selector, value)
{
    $(selector).removeClass(value);
}

function jq_addClass(selector, value)
{
    $(selector).addClass(value);
}

function bubble_stop(e)
{
	try
	{
		e.stopPropagation();
	}
	catch(err)
	{
		e.cancelBubble = true;
	}
}

function check_box_limitter(pSelector, maxCheck)
{
	var varKey		=	1;
	var varCheck	=	{};		
	
	$(pSelector + ':checked').each(function()
	{
		varCheck[varKey]	=	this;
	});
	
	$(pSelector).unbind().bind('click', function()
	{		
		var varCount 	= 	0;	
		$(pSelector+':checked').each(function(){varCount++});
		if(varCount > maxCheck)
		{		
			//alert(varCount);
			var varFirst	=	true;		
			var varNewObj	=	{};
			for(var x in varCheck)
			{					
				if(varFirst)
				{
					if(varCheck[x])
					{
						$(varCheck[x]).removeAttr('checked');
						delete varCheck[x];
					}
				}
				
				varFirst	=	false;
			}				
			varCheck[varKey]	=	this;
			varKey++;
		}
		else
		{
			if($(this).prop('checked'))
			{				
				varCheck[varKey]	=	this;
				varKey++;							
			}
			else
			{
				for(var y in varCheck)
				{						
					if(varCheck[y] === this)
					{							
						delete varCheck[y];
					}
				}	
			}
			
		}
	});	
}

/*
|-------------------------------------------------------------
|	Init
|-------------------------------------------------------------
*/

function check_error()
{
	var varErrors	=	'';
	for(var x in GLOBALS.error)
	{
		$('#' + x).parent().addClass('border_error');
		varErrors	+=	GLOBALS.error[x] + '<br/>';
	}
	GLOBALS.error	=	{};
}

function has_value(pString)
{
	pString		=	$.trim(pString);
	if(pString != '')
	{
		return true;
	}
	else
	{
		return false;
	}
}



function string_prototype()
{
	String.prototype.escape		=	function()
	{
		var varString	=	String(this);
		varString		=	varString.replace(/"/g, "_quote_").replace(/\&/g, "_amp_").replace(/\=/g, "_equal_").replace(/\?/g, "_question_").replace(/\\/g, "_bslash_").replace(/\//g, "_fslash_").replace(/\+/g, "_plus_")
		return varString;
	}
		
}


function toggle_class(aClass, aSelector)
{
	var jqObject	=	$(aSelector);		
	if(jqObject.hasClass(aClass))
	{
		jqObject.removeClass(aClass)
	}
	else
	{
		jqObject.addClass(aClass)
	}

}

//arvin added this.
function check_return(pParameter)
{
	if(pParameter == false)
	{
       	jq_cover.cover_message('Warning!', 'The system has traced that you are trying to make an invalid action.'); 		
	}

}//end functioin

function input_blur_focus(pId, pDefault, pTypeDefault, pTypeActual)
{

	$('#' + pId).bind('focus', function()
	{
		var varString	  =	 $(this).val();
			varString	  =	 varString.replace(/\s/g, ' ');
		//alert(varString+'=='+pDefault);
		var search_string =  varString.search(pDefault);
		//search_string++;
		//alert(search_string);
		if(search_string > -1)
		{
			$(this).val('');

		}
 
	});

	$('#' + pId).bind('blur', function()
	{
		var varString	=	$(this).val();
			varString	=	varString.replace(/\s/g, '');
		if(varString == pDefault || varString == '')
		{
			$(this).val(pDefault);
		}
	});
}

function string_amount(pValue, pGetString, pFixed)
{
	pFixed	=	(pFixed) ? pFixed : '2';
	pFixed	=	parseInt(pFixed);
	pValue	=	String(pValue);		
	pValue	=	(pValue) ? pValue : '0.00'; 
	pValue	=	pValue.replace(/[^\d\.]/g, '');
	pValue	=	parseFloat(pValue);		
	
	if(pGetString)
	{			
		pValue	=	pValue.toFixed(pFixed).replace(/\d(?=(\d{3})+\.)/g, '$&,');					
	}
	else
	{			
		pValue	=	pValue.toFixed(pFixed);
		pValue	=	parseFloat(pValue);
	}		
	
	return pValue;				
}


GLOBALS.events.add('ready', string_prototype);


$(document).ready(function()
{ 
	GLOBALS.events.trigger('ready');
});

window.onload	=	function()
{
	GLOBALS.events.trigger('onload');
}
	
function action_submit()
{
	alert("Call on undefined var.Angular.ajax object");
}


//---------------------------------------------- Validation--------------------------


function form_validate()
{
	// xvalidate="1" : indicates if needs to be validated
	// xrequired="1" : required - can't be blanks 
	// xtype="alphanum" : type of validation
	// xmsg="class"		: class of the placeholder of validation message
	
	$('input[xvalidate="1"]').each(function()
	{
		var p_type	=	$(this).attr('xtype');
		var p_value	=	$(this).val();
		
		var regex_alphnum	=	/^[A-Za-z\s]+$/g;
		
		if(p_type == 'text')
		{					
			valid	=	regex_text.test(value);
			if(!valid) error_array.push($(this));
		}
		
	});
	
}
	
