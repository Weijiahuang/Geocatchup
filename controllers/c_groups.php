<?php
class groups_controller extends base_controller {

    public function __construct() {
       parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
        if(!$this->user) {
            die("Members only. <a href='/index/index'>Login</a>");
        }
    }
	
	public function grouping()
	{	
		// get group category from the user
	    $group= $_POST['group'];
	    $user_id_followed = $_POST['user_id_followed'];
		$data = Array("users_users.group" => $group);
		
		//Resize and Save Image
	//	$imageObj = new Image('/Users/weijia/Desktop/CS50/project/p2.geohangout.biz-master/uploads/'.$picture);
	//	$imageObj->resize(300,300,'crop');
	//	$imageObj->save_image('/Users/weijia/Desktop/CS50/project/p2.geohangout.biz-master/uploads/'.$picture);		
		
		// update the group category of the followers
		DB::instance(DB_NAME)->update("users_users", $data, 'WHERE users_users.user_id_followed = '.$this->user->user_id.' AND users_users.user_id = '.$user_id_followed);
		
		Router::redirect('/posts/followers');
	}
	
	public function friends()
	{	
		$this->template->content = View::instance('v_groups_friends');
    	
    	$q ='SELECT *
    		FROM users';
    	
    	$users = DB::instance(DB_NAME) -> select_rows($q);
    		
    	$q = "SELECT *
    		FROM users_users
    		WHERE users_users.user_id = ".$this->user->user_id;
    		
      // Identify my followers
     	
    	$f = "SELECT * FROM users_users WHERE user_id_followed = ".$this->user->user_id;		
		
		$followers = DB::instance(DB_NAME)->select_array($f, 'user_id');
    	
       // Identify who among my fowllowers are in my friends group	
    	$g ="SELECT *
    		FROM users_users
    		WHERE users_users.group = 'Friends' AND users_users.user_id_followed = ".$this->user->user_id;
    	
    	$group = DB::instance(DB_NAME)->select_array($g,'user_id');
    	
    	//find the people who have connection with me   	   		    		
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
       	       	
    	$this->template->content->connections = $connections;
    	$this->template->content->followers = $followers;
    	$this->template->content->group = $group;
    	$this-> template-> content-> users = $users;
    	
    	echo  $this->template;
	}
	
	public function family()
	{
		
		$this->template->content = View::instance('v_groups_friends');
    	
    	$q ='SELECT *
    		FROM users';
    	
    	$users = DB::instance(DB_NAME) -> select_rows($q);
    		
    	$q = "SELECT *
    		FROM users_users
    		WHERE users_users.user_id = ".$this->user->user_id;
    		
       // Identify my followers
     	
    	$f = "SELECT * FROM users_users WHERE user_id_followed = ".$this->user->user_id;		
		
		$followers = DB::instance(DB_NAME)->select_array($f, 'user_id');
    	
	  // Identify who among my fowllowers are in my family group
    	$g ="SELECT *
    		FROM users_users
    		WHERE users_users.group = 'Family' AND users_users.user_id_followed = ".$this->user->user_id;
    	
    	$group = DB::instance(DB_NAME)->select_array($g,'user_id');
    	
    	//find the people who have connection with me   		    		
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
       	
    	$this->template->content->connections = $connections;
    	$this->template->content->followers = $followers;
    	$this->template->content->group = $group;
    	$this-> template-> content-> users = $users;
    	
    	echo  $this->template;
	}
	
	public function acquaintances()
	{
		
		$this->template->content = View::instance('v_groups_friends');
    	
    	$q ='SELECT *
    		FROM users';
    	
    	$users = DB::instance(DB_NAME) -> select_rows($q);
    		
    	$q = "SELECT *
    		FROM users_users
    		WHERE users_users.user_id = ".$this->user->user_id;
    		
       // Identify my followers
     	
    	$f = "SELECT * FROM users_users WHERE user_id_followed = ".$this->user->user_id;		
		
		$followers = DB::instance(DB_NAME)->select_array($f, 'user_id');
    	
       // Identify who among my fowllowers are in my acquaintances group	
    	$g ="SELECT *
    		FROM users_users
    		WHERE users_users.group = 'Acquaintances' AND users_users.user_id_followed = ".$this->user->user_id;
    	
    	$group = DB::instance(DB_NAME)->select_array($g,'user_id');
    	
    	//find the people who have connection with me   		    		
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
       	
    	$this->template->content->connections = $connections;
    	$this->template->content->followers = $followers;
    	$this->template->content->group = $group;
    	$this-> template-> content-> users = $users;
    	
    	echo  $this->template;
	}
	
	public function all() 
    {
    	$this->template->content = View::instance('v_groups_all');
    	
    	$q ='SELECT *
    		FROM users';
    	
    	$users = DB::instance(DB_NAME)->select_rows($q);
    		
    	$q = "SELECT *
    		FROM users_users
    		WHERE user_id = ".$this->user->user_id;
    	
    	//find the people who have connection with me	
    	$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		$f = "SELECT * FROM users_users WHERE user_id_followed = ".$this->user->user_id;		
		
		//select all my followers
		$followers = DB::instance(DB_NAME)->select_array($f, 'user_id');
		
    	$this->template->content->connections = $connections;
    	$this->template->content->followers = $followers;
    	$this-> template-> content-> users = $users;
    	
    	echo  $this->template;
    }    
}
?>