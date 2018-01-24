<section>
    <div class="container bg_green">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">

				
	
				
                <!-- LOGIN FORM -->
                <div class="text-center" style="padding:50px 0">
                    <div class="logo">Sign in to access our Knowledgebase </div>
                    <!-- Main Form -->
                    <div class="login-form-1">
                        
						@if(Session::has('message'))
							<div class="alert alert-info alert-dismissable">
								<i class="fa fa-info"></i>
								{{ Session::get('message') }}
							</div>						
						@endif
						
						@if(Session::has('error_message'))
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<b>Error!</b> {{ Session::get('error_message') }}
							</div>							
						@endif
						
						@if(count($errors->all())>0)                           
							<div class="alert alert-danger alert-dismissable">
								<i class="fa fa-ban"></i>
								<b>Error!</b> {{implode("<br />",$errors->all())}}
							</div>							   						
						@endif							
						
						{{ Form::open(array('action' => 'UsersController@login', 'id' => 'login-form','class' => 'text-left')) }}
                            <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                                <div class="login-group">
                                    <div class="form-group">
                                        <label for="lg_username" class="sr-only">Username</label>
                                        <input type="text" required class="form-control" id="lg_username" name="username" placeholder="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="lg_password" class="sr-only">Password</label>
                                        <input type="password" required class="form-control" id="lg_password" name="password" placeholder="password">
                                    </div>
                                    <div class="form-group login-group-checkbox">
                                        <input type="checkbox" id="lg_remember" name="remember_me">
                                        <label for="lg_remember">Remember me</label>
                                    </div>
                                </div>
                                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="etc-login-form">
                                <p>Forgot your password? <a href="{{ Request::root() }}/forget_password">Click here</a></p>
                                <p>New user? <a href="{{ Request::root() }}/register">Create new account</a></p>

                            </div>
                       {{ Form::close() }}
                    </div>
                    <!-- end:Main Form -->
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class=" side-box">
                    <h2>About NARC Knowledgebase System</h2>
                    <hr>
                    <p>
                       The NARC Knowledgebase system is an intelligent collection of Agricultural resources under the Nepal Agricultural Research Council . The main aim is to provide its huge collection of resources to public so that it will be beneficial for the purpose of research,knowledge gaining and references in the respective fields.
                    </p>


                </div>
            </div>

        </div>

    </div>
</section>