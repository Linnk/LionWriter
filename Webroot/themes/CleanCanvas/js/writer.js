window.addEvent('domready', function(){

	var Body = $('LionWriter');
	var screens = $$('.screen');
	
	var resize_screens = function()
	{
		var size = window.getSize();
		var width = size.x;
		var height = size.y + 'px';
		
		if(width >= 960)
		{
			Body.addClass('real');
			Body.removeClass('normal').removeClass('mobile');
		}
		else if(width < 960 && width > 500)
		{
			Body.addClass('normal');
			Body.removeClass('real').removeClass('mobile');
		}
		else
		{
			Body.addClass('mobile');
			Body.removeClass('real').removeClass('normal');
		}
	}
	
	resize_screens();
	
	var timerForResize = null;

	window.addEvent('resize', function(){

		clearTimeout(timerForResize);
		timerForResize = (function(){
   			resize_screens();
   		}).delay(1/24);
  	});
})

window.addEvent('load', function(){


})