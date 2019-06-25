<?php
    function validate_username($username)
    {
        if(preg_match('/^\w{4,}$/',$username))
            return(1);
    }
    function validate_email($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
            return(1);
    }
    function validate_password($password)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if($uppercase || $lowercase || $number || $specialChars || strlen($password) < 7)
            return(1);
    }
?>