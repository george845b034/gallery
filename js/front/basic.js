$(function(){

	//menu click event
	$('#aboutClick').on("click", function(){
		window.location.href = 'about';
	});
	$('.exhibitionsClick').on("click", function(){
		window.location.href = 'exhibitions';
	});
	$('#artistsClick').on("click", function(){
		window.location.href = 'artis';
	});
	$('#publicationsClick').on("click", function(){
		window.location.href = 'publications';
	});

	//artists hover display infomation
	$('.artisname').find('li').on("mouseover", function(e){
		$('.t3').find('p').text($(this).data('content'));
	});

	//publications hover display infomation
	$('.box04, .exhi').find('img').on("mouseover", function(e){
		$('.publications_content').find('p').eq(0).text($(this).data('title'));
		$('.publications_content').find('p').eq(1).text($(this).data('content'));
	});

	//artists select event
	$('.select-artists').on("change", function(){
		window.location.href = 'artis_detail?id=' + $(this).val();
	});
})