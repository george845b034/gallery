$(function(){

	//menu click event
	$('#aboutClick').on("click", function(){
		window.location.href = 'about';
	});
	$('.exhibitionsClick').on("click", function(){
		window.location.href = 'exhibitions_list';
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

	//schedule select event
	$('.select-schedule').on("change", function(){
		window.location.href = 'schedule?id=' + $(this).val();
	});

	$('form').on("submit", function(e){
		e.preventDefault();
		var buttomLoading = Ladda.create($(this).find('button')[0]);
	 	buttomLoading.start();
	 	$.ajax({
			type: "POST",
			url: "main/email",
			dataType: "json",
			data: $('form').serialize()
		}).done(function( result ){
			if(result.indexOf("Success") > -1)
			{
				new PNotify({
				    title: 'Success',
				    text: result,
				    type: 'success'
				});
			}else{
				new PNotify({
				    title: 'Fail',
				    text: result,
				    type: 'error'
				});
			}
		}).fail(function(jqXHR, textStatus) {
			console.log(textStatus);
		}).always(function() {
			buttomLoading.stop();
		});
	});


	$("form button").prop('disabled', true);
	$('form input, form textarea').blur(function(){
		var i = 0;
		$("form input, form textarea").each(function()
		{
			if( $(this).val().length === 0 ) {
				$(this).closest('div').addClass('has-error');
				i++;
			}else{
				$(this).closest('div').removeClass('has-error');
			}
		});

		if(i == 0)
		{
			$("form button").prop('disabled', false);
			$("form button").addClass('enableButton');
		}else{
			$("form button").prop('disabled', true);
			$("form button").removeClass('enableButton');
		}
	});
	
})