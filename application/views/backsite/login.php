<link href="<?php echo base_url();?>css/login/login-theme-1.css" type="text/css" rel="stylesheet" >
<link href="<?php echo base_url();?>css/login/animate-custom.css" type="text/css" rel="stylesheet" >
<style>
	.centerLogin{
		margin-left: auto;
	    margin-right: auto;
	    width: 70%;
	}
	#captcha{
		display: inline-block;
		width: 41%;
		margin-left: 53px;
	}
</style>
<div class="container" id="login-block">
	<div class="row">
	    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
	    	 
	       <div class="login-box clearfix animated flipInY">
	       		<div class="page-icon animated bounceInDown">
	       			<img src="<?php echo base_url();?>images/common/user-icon.png" alt="Key icon">
	       		</div>
	        	<div class="login-logo">
	        		<a href="#"><img src="<?php echo base_url();?>images/common/login-logo.png" alt="Company Logo"></a>
	        	</div> 
	        	<hr>
	        	<div class="login-form" ng-app="webApp" ng-controller="loginController">
	        		
	        		<form method="post" class="form-inline" ng-submit="submit()">
				  		
				   		<input type="hidden" ng-model="token" ng-init="token='<?php echo $token;?>'">
				   		<input type="text" ng-model="account" placeholder="User name" class="input-field" autocomplete="off" autofocus required>
				   		<input type="password" ng-model="password" placeholder="Password" class="input-field" required>
				  		<input type="text" ng-model="captcha" placeholder="input captcha" class="input-field" id="captcha" autocomplete="off" required/>
				  		<img src="<?php echo $captcha['image_src'];?>" alt="CAPTCHA security code" width="100px" height="30px" />
				  		<div class="btn btn-danger center-block centerLogin hide"><span class="glyphicon glyphicon-remove"></span> <span id="errMessage">帳號或密碼輸入錯誤!</span></div>
				   		<button type="submit" class="btn btn-login">Login</button> 

					</form>
	        	</div> 			        	
	       </div>
	    </div>
	</div>
</div>

<script src="<?php echo base_url();?>/js/backsite/login.js"></script>