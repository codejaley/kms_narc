<?php
class RegisterController extends \BaseController {
	
	protected $layout = "frontend.home-layout";
	
	/* signup new user */
	public function signUpUser() {
		View::share("page_title", "NARC :: Knowledgebase Managament System");
		 if ($this->isPostRequest()) {
		 	      $messages = array('firstname.required' => 'First name is required',
									'lastname.required' => 'Last name is required',
									'email.required' => 'Email is required',
									'username.required' => 'Username is required',
									'username.unique' => 'This username is already taken',
									'email.unique' => 'This email is already used',
									'password.required' => 'Password is required',
									'password.confirmed' => 'Password didnot matched',
									"reg_agree.required" => 'You need to accept the terms');
				  $rules = array('firstname' => 'required',
								 'lastname'  => 'required',
								 'email' => 'required|unique:users',
								 'username' => 'required|unique:users',
								 'password' => 'required|confirmed|min:6',
								 'reg_agree' => 'required'	
								);	
								
				  $validator = Validator::make($data = Input::all(), $rules, $messages);
				  if ($validator->fails())
					{
						return Redirect::back()->withErrors($validator)->withInput();
					}	
					
				$data['role_id'] = 3;
				$data['is_email_verified'] =0;
				$data['is_user_verified'] =0;
				$data['middlename'] = '';
				$data['profileid'] = 'hello';
				$data['password_confirmation'] = Hash::make('password');
				$data['is_active'] = 1 ;
				$password = Input::get('password');
				$data['password'] =Hash::make($password);
				$alphanum = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
				$special  = '~!@#$%^&*(){}[],./?';
				$alphabet = $alphanum . $special;
				$len = 12; // length of password
				$random = openssl_random_pseudo_bytes($len);
				$alphabet_length = strlen($alphabet);
				$confirmation_code = '';
				for ($i = 0; $i < $len; ++$i) {
					$confirmation_code .= $alphabet[ord($random[$i]) % $alphabet_length];
				}
				$data['confirmation_code'] = $confirmation_code;
		
				$user = User::create($data);
				Mail::send('emails.auth.email_verification', array('firstname'=>Input::get('firstname'),'token' => $user->confirmation_code), function($message){
				$message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'))->subject('Complete your NARC Registration');
					});
				//crates new entry on user table sends email for verification	
				return Redirect::to('/')->with('message', 'Your account has been created. Check email to verify it!');																								
		 }
		$this->layout->content = View::make('frontend.register');
	}	
	
	  protected function isPostRequest()
	  {
		return Input::server("REQUEST_METHOD") == "POST";
	  }  	

	  public function forgetPassword() {
	  	View::share("page_title", "NARC :: Knowledgebase Managament System");
		$this->layout->content = View::make('frontend.password_remind');
	  }

	  public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);
		View::share("page_title", "NARC :: Knowledgebase Managament System");
		$this->layout->content = View::make('frontend.password_reset')->with('token', $token);
		//return View::make('password_reset')->with('token', $token);
	}
	
}