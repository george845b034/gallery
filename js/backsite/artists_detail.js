$(function () {

    //日期選擇
    $( ".datepicker" ).datepicker({
        format: "yyyy-mm-dd",
        language: "zh-TW"
    });

    $('#submit').on('click', function(e) {
        e.preventDefault();
        var returnUrl = $(this).data('returnurl');

    	if($('input[name="ar_tw_name"]').val() == '')
    	{
    		notication('請輸入名字', '');
    		return;
    	}

        var buttomLoading = Ladda.create(this);
        buttomLoading.start();

        var serverUrl = $('form').data('serverurl') || '';
        var options = { 
            type: "POST",
            url: serverUrl,
            dataType: "json",
            success: function(result)
            {
                if(result.status == 'SUCCESS')
                {
                    notication(result.msg, result.status, '', returnUrl, buttomLoading.stop());
                }else{
                    notication(result.msg, result.status, buttomLoading.stop());
                }
            }
        };
        $('form').ajaxSubmit(options);
    });

    //選擇藝術家的作品
    $('#workSelect').on('change', function(){

        $('.imageButton').not('.workSelected').remove();
        $('.multiOriginalImage').find('img').not('.workSelected').remove();

        if(this.value != '')
        {
            $.ajax({
                type: "POST",
                url: "",
                data: "type=3&id=" + this.value,
                dataType: "json"
            }).done(function( result ){
                
                $.each(result, function(index, value){

                    var n = Math.floor(Math.random() * 11);
                    var k = Math.floor(Math.random() * 1000000);
                    var m = String.fromCharCode(n)+k;
                    $('.worksPopupImage').append('<div class="col-sm-4 imageButton text-center">'+
                                                    '<img name="'+ m +'" class="worksImage popupForWorks cursor" src="../uploads/images/works/thumb/'+ value.w_image +'">'+
                                                    '<span name="'+ value.w_id +'" type="button" class="btn btn-info btn-group-justified worksJoin" style="margin-bottom:10px">加入</span>'+
                                                '</div>');

                    var originalImage = $('<img name="'+ m +'" src="../uploads/images/works/'+ value.w_image +'">');
                    $(originalImage).appendTo($('.worksOriginalImage'));
                });

                //關閉加入按鈕
                $('.imageButton').find('span').css('visibility','hidden');
            }).fail(function(jqXHR, textStatus) {
                console.log(jqXHR, textStatus);
            });
        }
    });
    
    //作品加入的事件
    $('body').on('click', '.worksJoin', function(){
        $(this).closest('div.imageButton').addClass('workSelected');
        $(this).removeClass('btn-info worksJoin').addClass('btn-danger worksJoinDelete').html('刪除');
        $('.worksOriginalImage').find('img[name="'+ $(this).closest('div.imageButton').find('img')[0].name +'"]').addClass('workSelected');
        $('.worksOriginalImage').append('<input type="hidden" name="w_id[]" value="'+ $(this).attr('name') +'">');
    });

    //作品刪除加入的事件
    $('body').on('click', '.worksJoinDelete', function(){
        $('.worksOriginalImage').find('img[name="'+ $(this).closest('div.imageButton').find('img')[0].name +'"]').remove();
        $('.worksOriginalImage').find('input[value="'+ $(this).attr('name') +'"]').remove();
        $(this).closest('div.imageButton').remove();
    });

    //刪除上傳的圖
    $('body').on('click', '.worksDelete', function(){
        var self = this;

        bootbox.confirm({
            message: '是否確認刪除?',
            buttons: {
                'cancel': {
                    label: '取消',
                    className: 'btn-default'
                },
                'confirm': {
                    label: '確定',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if(result)
                {
                    $.ajax({
                        type: "POST",
                        url: "",
                        data: "type=3&id=" + $(self).attr('name'),
                        dataType: "json"
                    }).done(function( result ){
                        if(result.status == 'SUCCESS')
                        {
                            window.location.reload();
                        }
                    }).fail(function(jqXHR, textStatus) {
                        console.log(jqXHR, textStatus);
                    });
                }
            }
        });
    });

    //清除暫存的上傳的圖
    $('body').on('click', '.worksClear', function(){
        $('input[name="w_image[]"]').val('');
        $('.worksClear').closest('div.imageButton').remove();
    });

    //回上一頁
    $('#goBack').on('click', function(){
        window.history.back();
    });

    //hover image button
    $('.imageButton').find('span').css('visibility','hidden');
    $('body').on({
        mouseenter: function () {
            $(this).find('span').css('visibility','visible');
        },
        mouseleave: function () {
            $(this).find('span').css('visibility','hidden');
        }
    }, '.imageButton');
});
