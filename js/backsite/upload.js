$(function () {
    var maxWidth = $('#preview').width();
    var maxHeight = $('#preview').height();
    var ratio = maxWidth / maxHeight
    var horizontal = true;
    var targetParent;

    function resizeImage(image, rotated) {
        
        image.height = maxHeight;
        image.width = maxWidth;

        targetParent.find('.popupImage').css('width', maxWidth).css('height', maxHeight);
    }

    function initImagePosition(image, rotated) {
        var width = rotated ? image.height : image.width;
        var height = rotated ? image.width : image.height;
        var container = $('#container');
        if (rotated) {
            var adjustment = (image.width - image.height) / 2;
            $(image).css('left', -adjustment).css('top', adjustment);
        }
        if (width / height > ratio || (width / height <= ratio && rotated)) {
            var initPosition = maxWidth - width;
            targetParent.find('.popupImage').css('left', -initPosition/2);
            container.css('width', (width * 2 - maxWidth) + 'px');
            container.css('height', maxHeight + 'px');
            container.css('left', initPosition + 'px');
            container.css('top', '0');
            horizontal = true;
            $('input#dragLeft').attr('value', Math.round(-initPosition / 2));
            $('input#dragTop').attr('value', 0);
        }
        else {
            var initPosition = maxHeight - height;
            targetParent.find('.popupImage').css('top', -initPosition/2);
            container.css('height', (height * 2 - maxHeight) + 'px');
            container.css('width', maxWidth + 'px');
            container.css('top', initPosition + 'px');
            container.css('left', '0');
            targetParent.find('input#dragTop').attr('value', Math.round(-initPosition / 2));
            $('input#dragLeft').attr('value', 0);
            horizontal = false;
        }
    }

    function loadImage(e) {
        var image = new Image();
        image.onload = function (e) {

            var bin = atob(e.target.src.split(',')[1]);
            var exif = EXIF.readFromBinaryFile(new BinaryFile(bin));
            var rotated = false;
            switch (exif.Orientation) {
                case 8:
                    $(this).removeClass().addClass('rotate-90');
                    rotated = true;
                    break;
                case 3:
                    $(this).removeClass().addClass('rotate180');
                    break;
                case 6:
                    $(this).removeClass().addClass('rotate90');
                    rotated = true;
                    break;
                default:
                    break;
            }
            
            var originalImage = $(this).clone();
            targetParent.find('.originalImage').empty();
            $(originalImage).appendTo(targetParent.find('.originalImage'));
            targetParent.find('.popupImage').empty();
            targetParent.find('#container').removeAttr('style');
            targetParent.find('.popupImage').removeAttr('style');
            resizeImage(this, rotated);
            initImagePosition(this, rotated);
            $(image).appendTo(targetParent.find('.popupImage'));
        };
        image.src = e.target.result;
    }


    function previewImage(e) {
        var reader = new FileReader();
        var file = $("#" + e.target.id)[0].files[0];
        targetParent = $("#" + e.target.id).parent().parent();
        reader.readAsDataURL(file);
        reader.onload = loadImage;
    }

    $('#id_image_large, #ar_image, #ar_cv_image').change(previewImage);
    
    $('.popupImage').on('click', function(){
        
        var targetDom = $(this).closest('div.row').find('.originalImage');
    	targetDom.show();
    	$('html').removeClass('app');
    	$('body').css({'overflow': 'auto'});
        
    	$.blockUI({ 
            message: targetDom, 
            css: { 
                top:  '30px', 
                left: ($(window).width() - targetDom.width() / 2) /2 + 'px', 
            	width: targetDom.find('img').width() + 6,
            	cursor: '',
            	position: 'absolute'
            },
            onOverlayClick: $.unblockUI,
            onUnblock: function(){ targetDom.hide();$('html').addClass('app');$('body').css({'overflow': 'hidden'}); },
            draggable: true
        });
    });
});