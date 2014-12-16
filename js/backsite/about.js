$(function () {

    $('#submit').click(function() {

    	if($('textarea[name="tw_introduction"]').val() == '')
    	{
    		notication('請輸入介紹', '');
    		return;
    	}

        var serverUrl = $('form').data('serverurl') || '';
        var options = { 
            type: "POST",
            url: serverUrl,
            data: { type: 1 },
            dataType: "json",
            success: function(result)
            {
                if(result.status == 'SUCCESS')
                {
                    notication(result.msg, result.status);
                }else{
                    notication(result.msg, result.status);
                }
            }
        };
        $('form').ajaxSubmit(options);
    });
});
