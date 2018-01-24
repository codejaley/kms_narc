<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>Agrifood Consulting - Password_reset</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="/admin_root/css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="/admin_rootcss/bootstrap-responsive.min.css">
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
		<h1><a href="#"><img src="/admin_root/img/agrifood-logo.png" alt="" class='retina-ready' width="59" height="49">Agrifood Consulting</a></h1>
		<div class="login-body">
			<h2>Password Reset</h2>
			<!-- Login error messages starts -->
				<div class="col-md-12">				
				<!-- error message starts -->
						@if (Session::has('error'))
						<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-info"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
								<b>Error!</b> {{ Session::get('error') }}
							</div>							 
						@elseif (Session::has('status'))
							<div class="alert alert-info alert-dismissable">
								<i class="fa fa-info"></i>
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
								<b>Success!</b>  {{ Session::get('status') }}
							</div>							
						@endif						

           			</div>			
			<!-- Login error message ends -->	
			<form action="{{ action('RemindersController@postRemind') }}" method="POST">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='email' placeholder="Email address" required ="required" class='input-block-level' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div class="submit">
					<input type="submit" value="Submit" class='btn btn-primary'>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
