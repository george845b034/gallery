$(function () {

    //產生圖檔處理
    function readURL(input) {

        if (input.files && input.files[0]) {
            var leng = input.files.length;
            var tempArray = new Array();
            var imageArray = new Array();

            for (var i = 0; i < leng; i++) {

                tempArray[i] = new FileReader();
                var file = input.files[i];

                tempArray[i].onload = function (e) {

                    var n = Math.floor(Math.random() * 11);
                    var k = Math.floor(Math.random() * 1000000);
                    var m = String.fromCharCode(n)+k;
                    var newObject = $('<div class="col-sm-4 imageButton text-center">'+
                                        '<textarea name="w_description[]" cols="48" rows="10" ></textarea>'+
                                        '<span type="button" class="btn btn-danger btn-group-justified worksClear" style="margin-bottom:10px">清除</span>'+
                                    '</div>');


                    imageArray[i]= $("<img name='"+ m +"'>");
                    $(imageArray[i]).attr('src', e.target.result);

                    var originalImage = $(imageArray[i]).clone();
                    $(originalImage).appendTo($('.multiOriginalImage'));

                    // $(imageArray[i]).css('margin-right', '10px');
                    // $(imageArray[i]).css('margin-bottom', '10px');
                    // $(imageArray[i]).css({'max-width': '378px', 'max-height': '200px'});
                    $(imageArray[i]).addClass('popupImageForMulti cursor worksImage');
                    $(newObject).prepend($(imageArray[i]));
                    $(newObject).appendTo('.worksPopupImage');
                    //關閉刪除按鈕
                    $('.imageButton').find('span').css('visibility','hidden');
                }

                tempArray[i].readAsDataURL(file);
            };
        }
    }

    //選擇檔案事件
    $("#worksUpload").change(function(){
        readURL(this);
    });

    //popup事件
    $('body').on('click', '.popupImageForMulti', function(){
        
        var targetDom = $(this).closest('div.row').find('.multiOriginalImage');
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