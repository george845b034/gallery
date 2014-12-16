var app = angular.module('webApp', []);

//連線服務
app.factory('dbService', function($http, $location, $q){

    return {
        //查詢Token是否正確
        getToken: function(inToken){
            var inData = { type: 1, token: inToken };

            return $http({
                method: 'POST',
                url: '',
                data: $.param(inData),
                cache: true,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function(data, status, headers, config) {
                return data;
            }).
            error(function(data, status, headers, config) {
                console.log('error', data);
            });
        },
        //查詢Captcha是否正確
        getCaptcha: function(inCaptcha){
            var inData = { type: 2, captcha: inCaptcha };

            return $http({
                method: 'POST',
                url: '',
                data: $.param(inData),
                cache: true,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function(data, status, headers, config) {
                return data;
            }).
            error(function(data, status, headers, config) {
                console.log('error', data);
            });
        },
        //查詢帳密是否正確
        getAdmin: function(inAccount, inPassword){
            var inData = { type: 3, account: inAccount, password: inPassword };

            return $http({
                method: 'POST',
                url: '',
                data: $.param(inData),
                cache: true,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function(data, status, headers, config) {
                return data;
            }).
            error(function(data, status, headers, config) {
                console.log('error', data);
            });
        },
        //取得驗証圖片
        captchaReload: function(){
            var inData = { type: 4 };

            return $http({
                method: 'POST',
                url: '',
                data: $.param(inData),
                cache: true,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function(data, status, headers, config) {
                return data;
            }).
            error(function(data, status, headers, config) {
                console.log('error', data);
            });
        }
    }
});

//登入控制
app.controller('loginController', ['$scope', '$window', 'dbService', function($scope, $window, dbService) {

    /**
     * 送出事件
     * @return void
     */
    $scope.submit = function(){
        //防止沒有輸入
        if($scope.token.length <=0 || $scope.account.length <=0 || $scope.password.length <=0 || $scope.captcha.length <=0)return false;

        //判斷是captcha是否正確
        dbService.getCaptcha($scope.captcha).then(function( result ){
            if(result.data != 1)
            {
                errorShow('Captcha Error!');
                captchaReload();
            }else{
                //判斷帳密
                dbService.getAdmin($scope.account, $scope.password).then(function( result ){

                    if(result.data != 1)
                    {
                        errorShow();
                        captchaReload();
                    }else{
                        //判斷是token是否正確
                        dbService.getToken($scope.token).then(function( result ){
                            if(result.data != 1)
                            {
                                errorShow('Token Error!');
                                location.reload();
                            }else{
                                //redirect
                                $window.location.href = './main';
                            }
                        });
                    }
                });         
            }
        });
    }

    /**
     * 重新取得驗証圖片
     * @return void
     */
    var captchaReload = function(){
        dbService.captchaReload().then(function( result ){
            $('img:last').attr('src', result.data.image_src);
        });
    }

    /**
     * 顯示錯誤訊息
     * @return void
     */
    var errorShow = function(inMessage){

        if(inMessage != '')$('#errMessage').text(inMessage);

        $(".centerLogin").removeClass("hide").fadeIn("slow", function(){
            setTimeout(function(){
                $(".centerLogin").fadeOut('slow');
                loginReset();
            },1000);
        });
    }

    /**
     * 登入重置
     * @return void
     */
    var loginReset = function(){
        
        $scope.account = '';
        $scope.password = '';
        $scope.captcha = '';
        $scope.$apply();
        $('form input:not(":hidden"):first').focus();
    }
}]);