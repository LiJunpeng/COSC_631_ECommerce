




<?php

session_start();


if(!$_SESSION)
{
	if($_POST)
	{
		$db = "game_board";
		$connection = mysql_connect("localhost", "root", "12345");
		if ($connection)
		{
			$selection = mysql_select_db($db);

			if ($selection)
			{
				$username = mysql_real_escape_string($_POST['username']);
				$password = mysql_real_escape_string($_POST['password']);
				$first_name = mysql_real_escape_string($_POST['first_name']);
				$last_name = mysql_real_escape_string($_POST['last_name']);
				$email = mysql_real_escape_string($_POST['email']);
				$credit = 0;

				//$date = date_create('2000-01-01', timezone_open('Pacific/Nauru'));
				//date_timezone_set($date, timezone_open('America/Chicago'));
				//$time = date_format($date, 'Y-m-d H:i:s')
				date_default_timezone_set("America/Belize");
				$time = date("Y-m-d H:i:s",time());


				$query = "INSERT INTO accounts(user_id, username, password, first_name, last_name, email, credit, sign_up_time) VALUE('null', '$username', '$password', '$first_name', '$last_name', '$email', '$credit', '$time')";  
			          
			    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
			          
			    echo "记录已经插入， mysql_insert_id() = ".mysql_insert_id();  
			          
			    mysql_close($connection);  
?>
						<script type = 'text/javascript'>
						window.location.href = "../public/index.php";
						</script>
<?php
			}  
			
		}
	}
}
else
{
	echo "already login";
}
?>