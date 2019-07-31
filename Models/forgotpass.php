<?php
    session_start();
    require_once "../config/connect.php";
    include "../Class/Db.class.php";
    include "../Class/Form.class.php";
    include "../Class/User.class.php";

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
    	if(isset($_POST["forgotpass"]))
    	{
    		$email = $_POST["forgotpass"];
    		$form = new Form;
    		if($form->validate_email($email))
    		{
    			if($form->test_if_x_in_db("users","email",$email))
    			{
    				$newpass= $form->generate_pass();
    				$condition = "email = " . "'" . $email . "'";
    				if($newpass)
    				{
    					$form->update_element_in_db("users","password",hash("whirlpool",$newpass),$condition);
						if($form->pass_reini_mail($email,$newpass))
							$sucess=1;
						else
							$err = "Please try again later";
    				}
    				else
    					$err = "there is an error please try again later";
    			}
    			else
    				$err = "this email is not registred";
    		}
    		else
    			$err="email not vaild";
    	}
    }

?>
