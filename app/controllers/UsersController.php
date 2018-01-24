<?php

class UsersController extends \BaseController {
	
	protected $layout = "admin.index";	
	
	public function __construct() {
		 $this->beforeFilter('auth.admin', array('except' => array('login', 'logout','verifyUser')));
	}	

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		
		if (Input::get('type')) {
			if (Input::get('type') == 3) {
					$users = User::orderBy('id', 'DESC')
								->where('role_id', '=', Input::get('type'))
								->where('is_active', '=', 1)
								->where('is_user_verified', '=', 1)								
								->get();
					$selected_role = Input::get('type');
			} else {
					$users = User::orderBy('id', 'DESC')
								->where('role_id', '=', Input::get('type'))
								->get();
					$selected_role = Input::get('type');				
			}
		} else {
			$users = User::orderBy('id', 'DESC')
						->get();			
			$selected_role = '';
		}				
		$query_strings = array_except( Input::query(), Paginator::getPageName());
		$roles = array('0' => 'All') + DB::table('roles')->where('is_active', '=', 'Y')->orderBy('name', 'asc')->lists('name','id');
		$this->layout->content = View::make('admin.users.index', compact('users', 'query_strings', 'roles','selected_role'));
	}

	public function emailNotVerfiefUser() {
		$users = User::where('is_email_verified', '=', 0)->where('role_id', '!=', 1)->paginate(20);
		$query_strings = array_except( Input::query(), Paginator::getPageName());
		$this->layout->content = View::make('admin.users.unverified_user', compact('users', 'query_strings'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
		$roles = array('' => 'Select')+DB::table('roles')->orderBy('id', 'asc')->whereIn('id', array(1,2,4))->lists('name','id');
		$this->layout->content = View::make('admin.users.create',compact('roles'));
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
		
		$messages = array(
            'firstname.required' => 'Name is required',
            'username.required' => 'Username is required', 
			'email.required' 	=> 'Email is required',    
            'password.required' => 'Password is required',
			'role_id.required' => 'Role is required',
        );

        $rules = array(
            'firstname' => 'required',
            'username' 	=> 'required|unique:users,username',
			//'email' 	=> 'requirednique:users,email',
			'email' 	=> 'required',
            'password' 	=> 'required|confirmed',
			'role_id' => 'required',
        );

        $validator = Validator::make($data = Input::all(), $rules, $messages);		

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		if ($data['role_id'] == 4) {
			$data['is_active'] = 0;
		}
		$data['password'] = Hash::make(Input::get('password'));
		User::create($data);

		return Redirect::route('admin.users.index')->with('success_message','User created sucessfully');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
		
		$user = User::find($id);
		$roles = array('' => 'Select')+DB::table('roles')->orderBy('id', 'asc')->whereIn('id', array(1,2))->lists('name','id');
		$this->layout->content = View::make('admin.users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
			
		$user = User::findOrFail($id);
		$messages = array(
            'firstname.required' => 'Name is required',
			'email.required' 	=> 'Email is required',    
        );

        $rules = array(
            'firstname' => 'required',
			//'email' => 'required|unique:users' . ',email,' . $id,
			'email' => 'required',
		);

        $validator = Validator::make($data = Input::all(), $rules, $messages);		

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('admin.users.index')->with('success_message','User edited sucessfully');	
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('admin.users');
	}
	
  /* Login methods */
  public function login() {
  	
    if ($this->isPostRequest()) {
      $validator = $this->getLoginValidator();
  		
      if ($validator->passes()) {     
	    $credentials = $this->getLoginCredentials();
	    $remember_me = Input::get("remember_me");
        if (Auth::attempt($credentials, ($remember_me == 'on') ? true : false)) {
        		
			if((Auth::user()->role_id) == 3)
        	{	

        		if((Auth::user()->is_email_verified) == 0)
        			{  
        			  Auth::logout();
        			  return Redirect::back()->withErrors([
        			  "password" => ["Your email is not activated yet. Please check your inbox and verify your email."]
       				 ]); }
        		if((Auth::user()->is_user_verified) == 0)
        			{  
        				 Auth::logout();
        				return Redirect::back()->withErrors([
        			  "password" => ["Your account is awaiting activation"]
       				 ]); }
        		return Redirect::to('/')->with('message', 'You are now logged in!');
        	}
        	else
        	{
			  return Redirect::to('admin')->with('message', 'You are now logged in!');
        	}
        	}
  		
        return Redirect::back()->withErrors([
          "password" => ["Invalid Credentials"]
        ]);
      } else {
        return Redirect::back()
          ->withInput()
          ->withErrors($validator);
      }
  }
   	return View::make("admin.users.login");
  }	
  
  protected function isPostRequest()
  {
    return Input::server("REQUEST_METHOD") == "POST";
  }  
  
  protected function getLoginValidator()
  {
    return Validator::make(Input::all(), [
      "username" => "required",
      "password" => "required"
    ]);
  }  

  protected function getLoginCredentials()
  {
    return [
      "username"	=> Input::get("username"),
      "password"	=> Input::get("password"),
      "is_active"	=> 1
    ];
  }  
  
  /* logging out admin */
  public function logout() {
  	$role_id = Auth::user()->role_id;
  		Auth::logout();
  		if($role_id == 3)
			return Redirect::to('/')->with('message', 'You are now logged out!');
		else
			 return Redirect::to('admin/login')->with('message', 'You are now logged out!');
  }  
  /* Login methods */
  
  /* reset user password by super admin */
  public function resetPassword($id) {
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
			
		$user = User::findOrFail($id);
		$this->layout->content = View::make('admin.users.reset_password',compact('user'));
  }
  
  /* change new password of the user */
  public function changeNewPassword() {
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
		
		$messages = array(
			'password.required' 	=> 'Password is required',
		  );
		  
		$rules = array(
			'password' 					=> 'required|confirmed'
		  );		
		
		$validator = Validator::make($data = Input::all(), $rules, $messages);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}	
		
		$data['password'] = Hash::make(Input::get('password'));
		User::where('id', '=', Input::get('id'))->update($data);			
		return Redirect::to('admin/users')->with('success_message','Password changed sucessfully');  
  }
  
	/* change user status */
	public function changeStatus($status, $id) {
		$flag = ($status == 'd')?0 : 1;
		User::where('id', '=', $id)->update(array('is_user_verified' => $flag));
		return Redirect::route('admin.users.index')->with('success_message','Status changed sucessfully');		
	}
	
	/* delete user */
	public function delete($id) {	
		if (Auth::user()->role_id != 1) {
			echo "You do not have permission to view this content!!";
			exit;
		}
			
		$user = User::find( $id );
		$user->delete();
		return Redirect::to('admin/users')->with('success_message','User deleted sucessfully.');			
	}  


	//redirects to sign_up page
	public function signUpUser12()
	{
	  if ($this->isPostRequest()) {
      $messages = array('firstname.required' => 'First name is required',
      					'lastname.required' => 'Last name is required',
      					'email.required' => 'Email is required',
      					'username.required' => 'Username is required',
      					'username.unique' => 'This username is already taken',
      					'email.unique' => 'This email is already used',
      					'password.required' => 'Password is required',
      					'password.confirmed' => 'Password didnot matched'

      	);
      $rules = array('firstname' => 'required',
      				 'lastname'  => 'required',
      				 'email' => 'required|unique:users',
      				 'username' => 'required|unique:users',
      				 'password' => 'required|confirmed|min:6'	
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
		$data['password'] =Hash::make('password');
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
        $message->to(Input::get('email'), Input::get('firstname').' '.Input::get('lastname'))->subject('Email Verification');
    		});
		//crates new entry on user table sends email for verification	
        return Redirect::to('/sign_up')->with('message', 'Your account has been created. Check email to verify it!');
        }
		return View::make('signup');
	}

	//confirms email as verified
	public function verifyUser()
	{

		//$email = Input::get('email');
		$token = Input::get('token');
		$token[0] = "";
		$user = User::where('confirmation_code','=', $token)->get();
		$data['is_email_verified'] = 1;
		$data['confirmation_code'] = '';
		$user[0]->update($data);
		if($user[0]->role_id == 3)
			return Redirect::to('/')->with('message', 'Your account has been activated. Please wait until admin approves!');
		else 
			return Redirect::to('admin')->with('message', 'Your account has been activated. Please wait until admin approves!');
	}
	public function verifyUserByAdmin()
	{
			$users = User::orderBy('id', 'DESC')
						->where('is_user_verified','=',0)
						->where('role_id','=',3)
						->paginate(20);
		$query_strings = array_except( Input::query(), Paginator::getPageName());
		$this->layout->content = View::make('admin.users.verify_user',compact('users','query_strings'));
	}
	
	public function testController() {
		
		$this->layout->content = View::make('admin.users.test_controller');
	}
}
