
/**
 * 通知訊息
 * @param  string inTitle 標頭
 * @param  string inType  狀態
 * @param  string inContent  內容
 * @return void resulut
 */
function notication(inTitle, inType, inContent, inRedirect)
{
    var content = inContent || '';

	new PNotify({
        title: inTitle,
	    text: content,
        type: inType,
	    delay: 1000,
        before_close: function(){
            if(inRedirect != undefined)
            {
                location.href = inRedirect;
            }else{
                location.reload();
            }
        }
    });
}