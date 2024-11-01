jQuery(document).ready(function($) {
	//navigation
	$('#search').click(function (){ $('#searchform').toggle();return false;});
	$('#login').click(function (){ $('#loginform').toggle();return false;});
	$('#pages').click(function (){ $('#pagesbox').toggle();return false;});
	$('#categories').click(function (){ $('#categoriesbox').toggle();return false;});
	
	//bookmark-it
	$('.bookmark-it').click(function (){ $('#sbookmarks').toggle();return false;});
	
	//article extra
	$('.article').each(function (){
		var ele=$(this);
		ele.find('.extra').click(function(){
			$(this).toggleClass('selected');
			ele.find('.entry').toggle();
			return false;
		} );
	});
});
