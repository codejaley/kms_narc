<?php
	$data_title = Constant::where('title', '=','site_title')->get();
?>
<header class="top-hearder">

   <div class="container">
       <div class="row">
			   <h1 class="heading-top">{{ $data_title[0]->content_english }}</h1>
			   <div class="pull-right login-box">
					<ul>
					@if(Auth::check())
					<li>Welcome , {{ Auth::user()->firstname }} you are logged.</li>
					<li>&nbsp;</li>
					<li><a href="{{ Request::root() }}/admin"><i class="fa fa-dashboard"></i> Your Dashboard</a></li>
					<li class="logged-out"><a href="{{ Request::root() }}/logout"> <i class="fa fa-lock"></i>
							   Log Out</a></li>
					@else
						   <li class="signup"><a href="{{ Request::root() }}/register"><i class="fa fa-user-plus"></i>
								Create an Account
				
						   </a></li>
					@endif	   
					</ul>				
			   </div>
       </div>
		<div class="row">    
		
				 <!-- Navigation starts	-->
			<nav class="navbar navbar-inverse navbar-fix ed-top custom_navigation" role="navigation">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
                            <div class="pull-left nep-gov"><a class="navbar-brand" href="{{ Request::root() }}"><img src="{{Request::root()}}/images/nep-gov-87X73.png" class="img-responsive" alt=""></a></div> 
                            <div class="pull-right narc-logo"><a href="{{ Request::root() }}"><img src="/images/logo.png" class="img-responsive narc-logo" alt="narc logo"></a></div>
                    </div>
                        
					
					<!-- Collect the nav links, forms, and other content for toggling -->
						<?php /*?><?php if(Auth::check()) {?><?php */?>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-right navi-center">
								<li>
									<a href="{{ Request::root() }}" class="active"><i class="fa fa-home"></i>
										Home</a>
								</li>
								<li>
									<a href="{{ Request::root() }}/page/about"><i class="fa fa-info-circle"></i>
										About Us</a>
								</li>
								<li>
									<a href="{{ Request::root() }}/page/contact"><i class="fa fa-phone"></i>
										Contact</a>
								</li>
			
							</ul>
						</div>
					<!-- /.navbar-collapse -->
					<?php /*?><?php } ?><?php */?>
				</div>
				<!-- /.container -->
			</nav>		 
				 
				 <!-- Navigation ends --> 	
			
			</div>
   </div>

</header>