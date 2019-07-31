<?php

    class User extends Form
    {
        public function __construct($arg)
        {
            if(isset($arg["username"])) $this->username =  $arg["username"];
            if(isset($arg["email"])) $this->email = $arg["email"];
            if(isset($arg["password"])) $this->password = $arg["password"];
        }
    }