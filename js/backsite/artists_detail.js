$(function () {

    $('#submit').on('click', function() {

    	if($('input[name="ar_tw_name"]').val() == '' || $('textarea[name="ar_tw_content"]').val() == '')
    	{
    		notication('請輸入名字或傳記', '');
    		return;
    	}

        var serverUrl = $('form').data('serverurl') || '';
        var options = { 
            type: "POST",
            url: serverUrl,
            dataType: "json",
            success: function(result)
            {
                if(result.status == 'SUCCESS')
                {
                    notication(result.msg, result.status, '', 'artists');
                }else{
                    notication(result.msg, result.status);
                }
            }
        };
        $('form').ajaxSubmit(options);
    });

    $('#goBack').on('click', function(){
        window.history.back();
    });
});
