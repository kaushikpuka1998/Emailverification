<?php
	$con = mysqli_connect("localhost","root","","emailcheck");
	if(!$con){
		die("Database could not connect ".mysqli_connect_error());
	}
	else{
		if(isset($_GET['email']) && isset($_GET['code']))
		{
				$email = $_GET['email'];
				$code = $_GET['code'];

				$sql = "SELECT * FROM users WHERE email= '$email' AND code ='$code'";
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_array($result);

				$v_name = $row['name'];
				$v_email = $row['email'];
				$v_pass = $row['pass'];
				$v_code = $row['code'];


				if($code == $v_code)
				{
					$q = "INSERT INTO verified_user(v_name,v_email,v_pass) VALUES('$v_name','$v_email','$v_pass')";

					mysqli_query($con,"DELETE FROM users WHERE email='$email' AND code = '$code'");

					if(mysqli_querry($con,$q))
					{
						header("location:profile.php");
					}else
					{
						echo"Something Went Wrong";
					}
				}else
				{
					echo "Code Doesn't Match";
				}
		}
		


	}
?>
