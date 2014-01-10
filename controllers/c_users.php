<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }
    
    
    public function p_upload()
	{
	$picture= Upload::upload($_FILES, "/uploads/", array("jpg", "jpeg", "gif", "png","PNG","JPG","JPEG","GIF"), $this->user->user_id);
		
		$data = Array("picture" => $picture);
		
		//Resize and Save Image
	//	$imageObj = new Image('/Users/weijia/Desktop/CS50/project/p2.geohangout.biz-master/uploads/'.$picture);
	//	$imageObj->resize(300,300,'crop');
	//	$imageObj->save_image('/Users/weijia/Desktop/CS50/project/p2.geohangout.biz-master/uploads/'.$picture);		
		
		DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = '".$this->user->user_id."'");
		
		Router::redirect("/posts/users");
	}

 	# Check duplicate email
    public function signup($uniqueness=NULL) {
        
        # Set up the view
        $this->template->content = View:: instance('v_index_index');
        
        $this->template->content->uniqueness = $uniqueness;
        
        #Render the view
        echo $this->template;
    }
    
   	# check whether all the fields are filled
    public function check($blankness=NULL) {
        
        # Set up the view
        $this->template->content = View:: instance('v_index_index');
        
        $this->template->content->blankness = $blankness;
        
        #Render the view
        echo $this->template;
    }
    
    
    
    public function p_signup()
    {
    	// check whether any field is not filled
    	$firstname = $_POST['first_name'];
		$lastname = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$number= $_POST['number'];
    
    	if(empty($firstname) || empty($lastname) || empty($password) || empty($email)||empty($number))
    	{
    		Router::redirect("/users/check/blankness");
    	}
    
    	// check the uniqueness of the email
     	$q= "SELECT COUNT(*) 
        	FROM users 
        	WHERE email ='$email'";
    	$token = DB::instance(DB_NAME)->select_field($q);
    
    	if($token) 
		{
			Router::redirect("/users/signup/uniqueness");
		}
			
		else 
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				Router::redirect("/users/signup/uniqueness");
			}
			
			else
			{
     		$_POST['created'] = Time::now();
     	 	$_POST['modified'] = Time::now();
     		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']); 
     		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

	     	# Insert the new user    
		    $user_id = DB::instance(DB_NAME)->insert_row('users', $_POST);
	    
     		# Go ahead and log them in
	    	if($user_id) 
	    	{
		    	setcookie('token',$_POST['token'], strtotime('+1 year'), '/');
			}
	    	$to = $_POST['email'] ;
			$subject = "Thanks for signing up";
			$message = "Congratulations on signup.";
			$from = "hhuangweijia@gmail.com";
			$headers = "From:" . $from;
			mail($to,$subject,$message,$headers);
			
			
			#follow yourself
			$data = Array(
			"created" => Time::now(),
			"user_id" => $user_id,
			"user_id_followed" => $user_id
			);
        
        	# Do the insert
			DB::instance(DB_NAME)->insert('users_users', $data);
	    	
	    	# Send them to their profile
	    	Router::redirect('/users/profile');
	    	
	    	# Prepare the data array to be inserted
    

			# Do the insert
			DB::instance(DB_NAME)->insert('users_users', $data);
	    		    	
	    	}
    	}   	
    }
    
    
    public function login($error=NULL) 
    {    
        # set up the view
        $this->template-> content = View::instance('v_index_index');
        
        $this->template->title="Login";
        
        # Pass data to the view
	    $this->template->content->error = $error;
		
        echo $this-> template;
    }

	
	public function p_login()
	{

    	# Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
    	$_POST = DB::instance(DB_NAME)->sanitize($_POST);

    	# Hash submitted password so we can compare it against one in the db
    	$_POST['password1'] = sha1(PASSWORD_SALT.$_POST['password1']);
	
	
    	# Search the db for this email and password
    	# Retrieve the token if it's available
    	$q = "SELECT token 
        	FROM users 
        	WHERE email = '".$_POST['email1']."' 
        	AND password = '".$_POST['password1']."'";

    	$token = DB::instance(DB_NAME)->select_field($q);
	
    	# If we found a matching token in the database, it means login successful
    	if($token) 
		{
        	/* 
        	Store this token in a cookie using setcookie()
        	Important Note: *Nothing* else can echo to the page before setcookie is called
        	Not even one single white space.
        	param 1 = name of the cookie
        	param 2 = the value of the cookie
        	param 3 = when to expire
        	param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
        	*/
        	setcookie("token", $token, strtotime('+1 year'), '/');
		
        	# Send them to the main page - or whever you want them to go
        	Router::redirect("/posts/index");
    	}
    	# If login fail, pass variable $error to login page
    	else
		{
        	# Send them back to the login page
        	Router::redirect("/users/login/error");
    	}
	}

    public function logout() 
    {
    	# Generate and save a new token for next login
    	$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

    	# Create the data array we'll use with the update method
    	# In this case, we're only updating one field, so our array only has one entry
    	$data = Array("token" => $new_token);

    	# Do the update
    	DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

    	# Delete their token cookie by setting it to a date in the past - effectively logging them out
    	setcookie("token", "", strtotime('-1 year'), '/');

    	# Send them back to the main index.
    	Router::redirect("/");
    }  

    public function profile($user_name = NULL) 
    {
  		# check whether the users is loged in or not
    	if(!$this->user)
    	{
    		echo "Members only";
    		Router:redirect("/index/index");
    	}
    	else
    	{
    	
    		# Create a new View instance
    		$view = View::instance('v_users_profile');
    		$this->template-> content = View::instance('v_users_profile');
    		
    		# Pass information to the view instance
    	
    		$this->template->title = " Profile";
    		
    		$view->user_name = $user_name;
    		
    		$q="SELECT * FROM posts INNER JOIN users_posts ON posts.post_id = users_posts.post_id_followed 
    		WHERE users_posts.user_id = ".$this->user->user_id;
    		
    		
			$eventsattendings = DB::instance(DB_NAME)->select_rows($q);
    		
    		
    		# Pass data to the View
			$this->template->content->eventsattendings = $eventsattendings;



       		# Render View
    		echo $this-> template ;
    	}
    }

} # end of the class
