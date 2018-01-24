<section>
    <div class="container bg_green">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">


                <!-- REGISTRATION FORM -->
                <div class="text-center" style="padding:50px 0">
                    <div class="logo">Register your account</div>
                    <!-- Main Form -->
                    <div class="login-form-1">
			
								@if(Session::has('message'))
								  <div class="alert alert-info alert-dismissable">
									<i class="fa fa-info"></i>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
									Your account has been created. Check email to verify it!
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
					
						 {{ Form::open(array('id' => 'register-form','class' => 'text-left')) }}
                            <div class="login-form-main-message"></div>
                            <div class="main-login-form">
                                <div class="login-group">
                                    <div class="form-group">
                                        <label for="reg_username" class="sr-only">First Name</label>
                                        {{ Form::text('firstname', null, array('class'=>'form-control', 'placeholder' => 'First Name')) }}										
                                    </div>
                                    
									<div class="form-group">
                                        <label for="reg_password" class="sr-only">Last Name</label>
                                        {{ Form::text('lastname', null, array('class'=>'form-control','placeholder' => 'Last Name')) }}
                                    </div>
                                    
									<div class="form-group">
                                        <label for="reg_password_confirm" class="sr-only">Email</label>
										 {{ Form::text('email', null, array('class'=>'form-control','placeholder' => 'Email')) }}
                                    </div>

                                    <div class="form-group">
                                        <label for="reg_email" class="sr-only">Username</label>
										{{ Form::text('username', null, array('class'=>'form-control', 'placeholder' => 'Username')) }}
                                    </div>
									
									<div class="form-group">
                                        <label for="reg_password" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="reg_password" name="password" placeholder="password">
                                    </div>	
									
									<div class="form-group">
                                        <label for="reg_password" class="sr-only">Password</label>
                                        <input type="password" class="form-control" id="reg_password" name="password_confirmation" placeholder="Confirm password">
                                    </div>																		
									
<?php /*?>									<div class="form-group">
                                        <label for="reg_email" class="sr-only">Password</label>
										{{ Form::password('password', null, array('id' => 'reg_password','class'=>'form-control', 'placeholder' => 'Confirm Password')) }}
                                    </div>	<?php */?>								
									
	<?php /*?>								<div class="form-group">
                                        <label for="reg_email" class="sr-only">Confirm Password</label>
										{{ Form::password('password_confirmation', null, array('class'=>'form-control', 'placeholder' => 'Confirm Password')) }}
                                    </div>	  <?php */?>   
											

                                    <div class="form-group login-group-checkbox">
                                        <input type="checkbox" class="" id="reg_agree" name="reg_agree" >
                                        <label for="reg_agree">I agree with <a href="#">terms</a></label>
                                    </div>
                                </div>
                                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                            </div>
                            <div class="etc-login-form">
                                <p>Already have an account? <a href="{{ Request::root() }}">Login here</a></p>

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
                    <p>The NARC Knowledgebase system is an intelligent collection of Agricultural resources under the Nepal Agricultural Research Council . The main aim is to provide its huge collection of resources to public so that it will be beneficial for the purpose of research,knowledge gaining and references in the respective fields.</p>


                </div>
            </div>

        </div>

    </div>
</section>