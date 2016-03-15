         <?php

session_start();


if(!$_SESSION)
{

	if($_POST)
	{
			$db = "game_board";

			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);

			$connection = mysql_connect("localhost", "root", "12345");

			if ($connection)
			{

				$selection = mysql_select_db($db);

				if ($selection)
				{
					$query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
					$mysql_query = mysql_query($query);
					$arr=mysql_fetch_assoc($mysql_query);

					$numrows = mysql_num_rows($mysql_query);
					if ($numrows)
					{
						echo "You are logged in!";
						$_SESSION['username'] = $username;
						$_SESSION['user_id'] = $arr['user_id'];

?>
						<script type = 'text/javascript'>
						window.location.href = "../public/GameMenu.php";
						</script>
<?php

					}
					else
					{
						//echo "incorrect Info";
?>
						<script type = 'text/javascript'>
							window.location.href = "../public/index.php";
							alert("Wrong username or password");
						</script>
<?php

					}
				}
			}

	}
}
else
{
	echo "already login";
	?>
						<script type = 'text/javascript'>
						window.location.href = "../public/GameMenu.php";
						</script>
<?php
}
?>