
/**
 * 通知訊息
 * @param  string inTitle 標頭
 * @param  string inType  狀態
 * @param  string inContent  內容
 * @param  string inExec  要執行的
 * @return void resulut
 */
function notication(inTitle, inType, inContent, inRedirect, inExec)
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
                inExec;
                location.href = inRedirect;
            }else{
                inExec;
                location.reload();
            }
        }
    });
}