<?php
	$con = mysqli_connect("localhost","root","","emailcheck");
	if(!$con){
		die("Database could not connect ".mysqli_connect_error());
	}
	else{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = md5($_POST['pass']);
		$code=substr(md5(mt_rand()), 0,15);


		$sql = "INSERT INTO users(name,email,pass,code) VALUES ('$name','$email','$password','$code')";	

		if(mysqli_query($con,$sql))
		{
			$to=$email;
			$subject="Activation Link Click to Verify";
			$from="Verification@neet.com";

			$body = "<h3>Your Activation Code is :" .$code."<br>Please Click On the below to verify your Email <br><a href='http://localhost/Emailverification/verify.php?email=".$email."&code=".$code."'>http://localhost/Emailverification/verify.php?email=".$email."&code=".$code."</a></h3>";

			$headers = "From:".$from."\r\n";
			$headers  .="MIME-Version:1.0"."\r\n";
			$headers  .="Content-type:text/html; charset = UTF-8";

			if(mail($to, $subject, $body, $headers))
			{
				echo "An Activation Link has been Sent  to Your Registered Email ID,Please Verify Your Email";
			}
			else
			{
				echo "Something Went Wrong";
			}
			
		}
	}
?>
