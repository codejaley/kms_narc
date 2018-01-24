<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>DMS Knowledge Base - Login</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="/admin_root/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="/admin_root/css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="/admin_root/css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="/admin_root/css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="/admin_root/css/themes.css">


	<!-- jQuery -->
	<script src="/admin_root/js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="/admin_root/js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="/admin_root/js/plugins/validation/jquery.validate.min.js"></script>
	<script src="/admin_root/js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="/admin_root/js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="/admin_root/js/bootstrap.min.js"></script>
	<script src="/admin_root/js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="/admin_root/js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<a href="{{ Request::root() }}"><img src="../frontend_root/images/logo-login.jpg" alt="" class='retina-ready'></a>				
		<div>
						@if(Session::has('message'))
							<div class="alert alert-info alert-dismissable">
								<i class="fa fa-info"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Logged out!</b> You have been logged out sucessfully.
							</div>						
						@endif
						
						@if(Session::has('error_message'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Error!</b> {{ Session::get('error_message') }}
							</div>							
						@endif
                        
                        @if(count($errors->all())>0)                           
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<b>Error!</b> {{implode("<br />",$errors->all())}}
							</div>							   						
						@endif		
		</div>
		
		<div class="login-body">
			<br>				
			<h2>SIGN IN</h2>
			{{ Form::open() }}
				
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='username' placeholder="Username" class='input-block-level' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="password" placeholder="Password" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="submit">
					
					<input type="submit" value="Sign me in" class='btn btn-primary'>
				</div>
			{{ Form::close() }}
			<div class="forget">
				<a href="#"><span></span></a>
			</div>
		</div>
	</div>
</body>

</html>
