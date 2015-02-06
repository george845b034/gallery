$(function () {

    $('.edit_dom').click(function() {
        window.location.href = 'publications_detail?id=' +  this.name + '&type=2';
    });

    
    $('.remove_dom').click(function() {
        var inId = this.name;
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
                        data: "type=1&id=" + inId,
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
    
});
