<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>Login - Bootstrap Admin Template</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
    <link href="<?php echo $url .'/assets/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url .'/assets/css/bootstrap-responsive.min.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="<?php echo $url .'/assets/css/style.css'; ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo $url.'/assets/css/pages/signin.css'; ?>" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#" hidden=""><!-- 
				SPK Gizi Panti Asuhan Darun Najah -->				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					
					<li class="">						
						<a href="signup.html" class="">
							<!-- Don't have an account? -->
						</a>
						
					</li>
					
					<li class="">						
						<a href="index.html" class="">
							<i class="icon-chevron-left"></i>
							<!-- Back to Homepage -->
						</a>
						<img src="">
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<div class="account-container">
	  <?php 
	   $msg = Session::get('msg');

	  if(!empty($msg)){  ?>
              <div class="alert alert-{{@$msg['code']}}">
                    <strong>{{@$msg['status']}}</strong> {{ @$msg['message']}}
               </div>
       <?php } ?>
	<div class="content clearfix">
		
		<form method="post" action="<?php echo $url .'/set_login'; ?>">
			
			<h1>Login User</h1>		
			<div class="login-fields">
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="login[username]" value="" placeholder="Username" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="password" name="login[password]" value="" placeholder="Password" class="login password-field"/>
					<input type="hidden" name="_token" value="{{csrf_token()}}">
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">

					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<button class="button btn btn-success btn-large">Sign In</button>
				
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->

<div class="login-extra">
	<a href="#">Reset Password</a>
</div> <!-- /login-extra -->



<div class="account-container" style="display: none;">
	
	<div class="content clearfix">
		
		<form action="#" method="post" action="<?php echo $url .'/set_login'; ?>">
			<h1 class="text-center">Reset Password</h1>		
			<div class="login-fields">
				<div class="field">
					<label for="email"></label>
					<input type="email" id="email" name="email" value="" placeholder="email terdaftar" class="email email-field" />
				</div> <!-- /field -->
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				<button class="button btn btn-success btn-large">Reset Password</button>
				<label class="choice" for="Field">back to login</label>
			</div> <!-- .actions -->
			
			
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<script src="<?php echo $url .'/assets/js/jquery-1.7.2.min.js'; ?>"></script>
<script src="<?php echo $url .'/assets/js/bootstrap.js'; ?>"></script>
<script src="<?php echo $url .'/assets/js/signin.js'; ?>"></script>

</body>

</html>
