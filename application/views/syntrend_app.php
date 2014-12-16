<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="keywords" content="yahoo, yahoo奇摩, yahoo奇摩首頁, yahoo首頁, yahoo搜尋, yahoo 信箱, yahoo 即時通訊, 新聞, 股市, 運動, 娛樂, 拍賣, 購物中心, 超級商城">
        <meta name="application-name" content="Yahoo奇摩首頁">
        <meta name="description" content="提供最方便的網站搜尋、即時新聞、生活資訊和Yahoo奇摩服務入口。">
        <title>Main</title>
    </head>
    <body>

        <h1>Testing</h1>
        <h1 id="fb-root"></h1>


        <ul>
            <li>availablecar: <?php echo $availablecar;?></li>
            <li>availablemotor: <?php echo $availablemotor;?></li>
        </ul>


        <script src="//connect.facebook.net/en_US/all.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '1563674517178165',
                    xfbml      : true,
                    version    : 'v2.2'
                });



            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>

    </body>
</html>