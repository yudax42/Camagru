<?php

    class Database
    {        
        // Site admin info
        public $adminName = "Youssef";
        public $host = "camagru";

        public $fetch;
        public $from;
        // Test element if exist in database and returns 1 if success
        public function test_if_x_in_db($table,$col,$x)
        {
            global $conn;
            $query = "SELECT * FROM " . $table . " WHERE " . $col . " = :element";
            if($stmt = $conn->prepare($query))
            {
                $stmt->bindParam(":element",$par_x,PDO::PARAM_STR);
                $par_x = trim($x);
                if($stmt->execute())
                {
                    if($stmt->rowCount() == 1)
                    {
                        $this->fetch = $stmt->fetch();
                        $this->from = "test_if_x_in_db";
                        return(1);
                    }
                    else
                        return(0);
                }
                unset($stmt);
            }
            unset($conn);
        }
        //check if user exists and infos is correct to login
        public function checkuser($user,$password,$hash_algo)
        {
            if($this->test_if_x_in_db("users","username",$user))
            {

                $hashed_pass = hash($hash_algo,$password);
                if(isset($this->from,$this->fetch) && $this->from == "test_if_x_in_db")
                {
                    if($this->fetch["status"] == "not verified")
                        $this->status_err = "Your account is not verified please check your email";
                    else if($this->fetch["password"] == $hashed_pass)
                    {
                        $this->user_id = $this->fetch["id"];
                        $this->email = $this->fetch["email"];
                        return(1);
                    }
                    else
                        $this->password_err = "Password Not Valid";   
                }
            }
            else
                $this->username_err = "No account found with that username";   
        }
        // pass array with info to insert to db
        public function insert_to_db($table,$arr)
        {
            global $conn;
            $columns = array_keys($arr);
            $values  = array_values($arr);  
            $str="INSERT INTO $table (".implode(',',$columns).") VALUES ('" . implode("', '", $values) . "' )";
            $stmt = $conn->prepare($str);
            if($stmt->execute())
            {
                unset($stmt);
                unset($conn);
                return(1);
            }
  
        }
        // to update element in database
        public function update_element_in_db($table,$col,$new_value,$condition)
        {
            global $conn;
            $query = "UPDATE ". $table. " SET ". $col ." = '".  $new_value . "' WHERE " .$condition;
            $stmt = $conn->prepare($query);
            if($stmt->execute())
            {
                unset($stmt);
                unset($conn);
                return(1);
            }
  
        }
        public function fetchpost($table,$limit)
        {
            global $conn;
            $query = "SELECT username,id,image,creation_date,likes FROM " . $table ." ORDER BY creation_date DESC LIMIT ".$limit;
            if($stmt = $conn->prepare($query))
            {
                if($stmt->execute())
                {
                    $this->fetch = $stmt->fetchAll();
                    $this->from = "fetch_table";
                    return(1);
                }
            }
        }
        public function fetch_user_table($table,$username)
        {
            global $conn;
            $query = "SELECT * FROM " . $table . " WHERE username = \"" . $username . '"';
            if($stmt = $conn->prepare($query))
            {
                if($stmt->execute())
                {
                    $this->fetch = $stmt->fetchAll();
                    $this->from = "fetch_table";
                    return(1);
                }
            }
        }
        public function fetchcomments($table,$id)
        {
            global $conn;
            $query = "SELECT * FROM " . $table . " WHERE post_id = \"" . $id . '"';
            if($stmt = $conn->prepare($query))
            {
                if($stmt->execute())
                {
                    $this->fetch = $stmt->fetchAll();
                    $this->from = "fetch_comment";
                    return(1);
                }
            }
        }
    }