<?php
    require_once "../Models/forgotpass.php";
    include("header.view.php");
?>

<head>
	<style>
		h3
		{
			margin-bottom: 10px;
		}
		input
		{
		    padding: 10px;
		    width: 77%;
		    border: 1px solid #eee;
		    border-radius: 5px;
		}
		button	
		{
		    padding: 10px;
		    width: 12%;
		    border-radius: 5px;
		    background: #00dd9e;
		    border: none;
		    color: #fff;
		    font-size: 13px;
		    margin-left: 11px;
		}
		.btn_success
		{
			font-size: 13px;
		}
	</style>
</head>

<body>
	<div class="succes_mail_box animated zoomInDown">
		<h3>Please enter your mail</h3>
		<?php if(isset($err)) echo "<div class='btn_danger animated shake'>". $err . "</div>";?>
		<?php if(isset($sucess)) echo "<div class='btn_success animated flash'>". "Please check your mail to have the new password" . "</div>";?>
		<form action="#" method="POST">
			<input type="email" name="forgotpass">
			<button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		</form>
	</div>
</body>
</html>