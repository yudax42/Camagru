<?php
    class Form extends Database
    {
        // User info
        public $username;
        public $email;
        public $password;
        // User error msg signup & login
        public $username_err;
        public $password_err;
        public $email_err;
        // User info satus in update case
        public $username_update_status;
        public $email_update_status;
        public $pass_update_status;
        // User send mail status
        public $mail_msg;
        public $mail_status;
        public $status_err;
        public $system_err;
        public $user_activation_code;
        // User verify email status
        public static $email_status;
        public static $email_msg;
        
        // Returs 1 in case username is valid
        public function validate_username($username)
        {
            //user name must be word and 4+ characters
            if(preg_match('/^\w{4,}$/',$username))
                return(1);
        }
        //Returns 1 in case email is valid
        public function validate_email($email)
        {
            //validate email address
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
                return(1);
        }
        //Returns 1 in case password is valid
        public function validate_password($password)
        {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);
            if($uppercase && $lowercase && $number && $specialChars && !(strlen($password) < 7))
                return(1);
        }
        //Returs 1 if username not empty
        public function is_not_empty_input($input)
        {
            if(!empty(trim($input)))
                return 1;
        }
        //send activation email to user
        public function sendmail($email,$username,$user_activation_code)
        {
            $base_url = "http://localhost/camagru/Views/";
            $mail_body= "
                <p> Hi ".$username.",</p>
                <p> Please Open this link to verifie your email address -> "
                . $base_url."email_verifictaion.view.php?activation_code=".$user_activation_code.
                "<p>Best Regards</p>
            ";
            if(mail($email,'email verification',$mail_body,"FROM: $this->adminName@$this->host"))
                return(1);
        }
        //verify the status of the email
        public static function verify_email($user_activation_code)
        {
            $self = new self;
            if($self->test_if_x_in_db("users","user_activation_code",$user_activation_code))
            {
                if(isset($self->from,$self->fetch) && $self->from == "test_if_x_in_db")
                {
                    if($self->fetch["status"] == "not verified")
                    {
                        $condition = "id = ". $self->fetch["id"];
                        $self->update_element_in_db("users","status","verified",$condition);
                        self::$email_msg = "Your email has sucessfuly verified, Thank's for join us!";
                        self::$email_status = 1;
                    }
                    else
                    {
                        self::$email_msg = "Your email is already verified";
                        self::$email_status = 0;
                    }
                }
            }
            else
                return 0;
        }
        //register the new user
        public function signup()
        {
            if(!$this->is_not_empty_input($this->username))
                $this->username_err = "username is empty";
            else if($this->validate_username($this->username))
            {
                if($this->test_if_x_in_db("users","username",$this->username))
                    $this->username_err = "This username is already taken.";
                else
                    $this->username = $this->username;
            }
            else
                $this->username_err = "username is not valid!";

            if(!$this->is_not_empty_input($this->email))
                $this->email_err = "Please insert an email";
            else if($this->validate_email($this->email))
            {
                if($this->test_if_x_in_db("users","email",$this->email))
                    $this->email_err = "This email is already taken.";
                else
                    $this->email = $this->email;
            }
            else
                $this->email_err = "Invalid email format";

            if(!$this->is_not_empty_input($this->password))
                $this->password_err = "Please insert an password";
            else if($this->validate_password($this->password))
                $this->password = $this->password;
            else
                $this->password_err = "Your password is weak it should be at least<br>
                - 6 characters<br>
                - One uppercase letter<br>
                - One number<br>
                - One special character .<br>";
            
            if(!$this->is_not_empty_input($this->username_err) && !$this->is_not_empty_input($this->email_err) && !$this->is_not_empty_input($this->password_err))
            {
                $this->user_activation_code = md5(rand());
                    $statment = [
                    "username" => $this->username,
                    "password" => hash("whirlpool",$this->password),
                    "email"    => $this->email,
                    "property" => "not active",
                    "user_activation_code" => $this->user_activation_code,
                    "status"    => 'not verified'
                ];
                if($this->insert_to_db("users",$statment))
                    if($this->sendmail($this->email,$this->username,$this->user_activation_code))
                    {
                        $this->mail_status = 1;
                        $this->mail_msg = 'The confirmation email have sent succesfuly';
                    }
                    else
                    {
                        $this->mail_status = 0;
                        $this->mail_msg = 'Oops!, Please Try again later';
                    }
                else
                    echo "Something went wrong. Please try again later.";
    
            }
        }
        //login the user 
        public function login()
        {
            if(!$this->is_not_empty_input($this->username))
                $this->username_err = "username is empty";
            else 
                $this->username = $this->username;
            if(!$this->is_not_empty_input($this->password))
                $this->password_err = "password is empty";
            else 
                $this->password = $this->password;
            if(!$this->is_not_empty_input($this->username_err) && !$this->is_not_empty_input($this->password_err))
            {
                if($this->checkuser($this->username,$this->password,"whirlpool"))
                {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["username"] = $this->username;
                        $_SESSION["email"] = $this->email;
                        return(1);
                }
            }
            
        }
        // update user info
        public function update_info()
        {   
            // Username
            if(isset($this->username) && isset($_SESSION["username"]))
            {
                if(!($this->username == $_SESSION["username"]))
                {
                    if(!($this->validate_username($this->username) === 1))
                    {
                        $this->username_update_status = "username not valid please try another one";
                    }
                    else if($this->test_if_x_in_db("users","username",$this->username))
                    {
                        $this->username_update_status = "username already exists please try another one";
                    }
                    else
                    {

                        $condition = "username = " . "'" . $_SESSION["username"] . "'";
                        if($this->update_element_in_db("users","username",$this->username,$condition))
                        {
                            $_SESSION["username"] = $this->username;
                            $this->username_update_status = "username updated sucessfuly";
                            header("Refresh:2");
                        }
                        else
                            $this->username_update_status = "Error Occured please try again later.";
                    }
                }
                
            }
            // Email
            if(isset($this->email) && isset($_SESSION["email"]))
            {
                if(!($this->email == $_SESSION["email"]))
                {
                    if(!($this->validate_email($this->email) === 1 ))
                    {
                        $this->email_update_status = "email not valid please try another one";
                    }
                    else if($this->test_if_x_in_db("users","email",$this->email))
                        $this->email_update_status = "email already exists please try another one";
                    else
                    {
                        $condition = "username = " . "'" . $this->username . "'";
                        if($this->update_element_in_db("users","email",$this->email,$condition))
                        {
                            $condition = "username = " . "'" . $this->username . "'";
                            $this->user_activation_code = md5(rand());
                            if($this->update_element_in_db("users","status","not verified",$condition)
                                && $this->update_element_in_db("users","user_activation_code",$this->user_activation_code,$condition)
                            )
                            {
                                $_SESSION["email"] = $this->email;
                                if($this->sendmail($this->email,$this->username,$this->user_activation_code))
                                {
                                    $this->email_update_status = "updated sucessfuly Please check your email to confirm";
                                    header("Refresh:2");
                                }
                                else
                                    $this->email_update_status = "error mail not sent";    
                                
                            }
                        }
                        else
                            $this->email_update_status = "Error Occured please try again later.";
                    }
                }
                
            }
            // Password
            if($this->password != null)
            {
                if($this->validate_password($this->password) === 1)
                {
                    $condition = "username = " . "'" . $this->username . "'";
                    if($this->update_element_in_db("users","password",hash("whirlpool",$this->password),$condition))
                    {
                            $this->pass_update_status = "Password updated sucessfuly";
                            header("Refresh:2");
                    }
                    else
                        $this->pass_update_status = "Error Occured please try again later.";
                }
                else
                    $this->pass_update_status = "Your Password is weak please retry";
            }

        }
    }