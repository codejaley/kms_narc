<section>
    <div class="container bg_green">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">


                <!-- REGISTRATION FORM -->
                <div class="text-center" style="padding:50px 0">
                    <div class="logo">Reset your password</div>
                    <!-- Main Form -->
                    <div class="login-form-1">
			
								@if(Session::has('message'))
								  <div class="alert alert-info alert-dismissable">
									<i class="fa fa-info"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
									Link has been sent to email.Click on link to continue reset!
								  </div>            
								@endif
								
								@if(Session::has('error_message'))
								  <div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
									<b>Error!</b> {{ Session::get('error_message') }}
								  </div>              
								@endif
											
											@if(count($errors->all())>0)                           
								  <div class="alert alert-danger alert-dismissable">
									<i class="fa fa-ban"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
									<b>Error!</b> {{implode("<br />",$errors->all())}}
								  </div>                            
								@endif    				
					
						<form action="{{ action('RemindersController@postReset') }}" method="POST">
                            <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                                <div class="login-group">
                                    
									<div class="form-group">
                                        <label for="reg_password_confirm" class="sr-only">Email</label>
										 {{ Form::text('email', null, array('class'=>'form-control','placeholder' => 'Email')) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_password_confirm" class="sr-only">Password</label>
                                         {{ Form::password('password', null, array('class'=>'form-control','placeholder' => 'Password')) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_password_confirm" class="sr-only">Password Confirmation</label>
                                         {{ Form::password('password_confirmation', null, array('class'=>'form-control','placeholder' => 'ReEnter your password')) }}
                                    </div>
                                     {{ Form::hidden('token', $token) }}
                                </div>
                                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                            </div>
                       {{ Form::close() }}
                    </div>
                    <!-- end:Main Form -->
                </div>

            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class=" side-box">
                    <h2>About NARC</h2>
                    <hr>
                    <p>
                        Nepal Agricultural Research Council (NARC) organized one day rice transplanting ceremony on Asar 15, 2072
                    </p>
                    <p>
                        Honourable Minister of Agriculture Development Mr. Hari Prasad Parajuli was the special guest of the ceremony
                    </p>
                    <p>

                        Honourable Member of Planning Commission Dr. Bharatendu Mishra was the chief guest and Director of Planning and Coordination, Dr. MN Paudel chaired at inaugural function.
                    </p>


                </div>
            </div>

        </div>

    </div>
</section>