$(function () {

    //產生圖檔處理
    function readURL(input) {

        if (input.files && input.files[0]) {
            var leng = input.files.length;
            var tempArray = new Array();
            var imageArray = new Array();

            $('.multiOriginalImage').html('');
            $('.multiPopupImage').find('img').remove();

            for (var i = 0; i < leng; i++) {
                tempArray[i] = new FileReader();

                var file = input.files[i];

                tempArray[i].onload = function (e) {

                    var n = Math.floor(Math.random() * 11);
                    var k = Math.floor(Math.random() * 1000000);
                    var m = String.fromCharCode(n)+k;

                    imageArray[i]= $("<img name='"+ m +"'>");
                    $(imageArray[i]).attr('src', e.target.result);

                    var originalImage = $(imageArray[i]).clone();
                    $(originalImage).appendTo($('.multiOriginalImage'));

                    $(imageArray[i]).css('padding-right', '10px');
                    $(imageArray[i]).width('80px');
                    $(imageArray[i]).height('80px');
                    $(imageArray[i]).addClass('popupImageForMulti cursor');
                    $(imageArray[i]).appendTo('.multiPopupImage');
                }

                tempArray[i].readAsDataURL(file);
            };
        }
    }

    //選擇檔案事件
    $("#multi_upload").change(function(){
        readURL(this);
    });

    //popup事件
    $('body').on('click', '.popupImageForMulti, .popupForWorks', function(){
        
        var switchName = ($(this).hasClass('popupForWorks'))?'.worksOriginalImage':'.multiOriginalImage';
        var targetDom = $(this).closest('div.row').find(switchName);
        var target = targetDom.find('img[name="'+ this.name +'"]');
        
        $('html').removeClass('app');
        $('body').css({'overflow': 'auto'});
        $.blockUI({ 
            message: target, 
            css: { 
                top:  '30px', 
                left: ($(window).width() - target[0].naturalWidth) /2 + 'px', 
                width: target[0].naturalWidth + 6,
                cursor: '',
                position: 'absolute'
            },
            onOverlayClick: $.unblockUI,
            onUnblock: function(){ targetDom.hide();$('html').addClass('app');$('body').css({'overflow': 'hidden'}); },
            draggable: true
        });
    });
});