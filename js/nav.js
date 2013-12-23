$('.menu_top').click(function()
{
	var href = $(this).attr('href');
	$('#content_area').hide().load(href).fadeIn('normal');
	
	return false;	
});
