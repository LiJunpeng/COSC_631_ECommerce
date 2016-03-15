

<?php

	if($_POST)
	{
		$db = "game_board";
		$connection = mysql_connect("localhost", "root", "12345");
		if ($connection)
		{
			$selection = mysql_select_db($db);

			if ($selection)
			{
				$game_name = mysql_real_escape_string($_POST['game_name']);
				$game_description = mysql_real_escape_string($_POST['game_description']);

				//$date = date_create('2000-01-01', timezone_open('Pacific/Nauru'));
				//date_timezone_set($date, timezone_open('America/Chicago'));
				//$time = date_format($date, 'Y-m-d H:i:s')
				//date_default_timezone_set("America/Belize");
				//$time = date("Y-m-d H:i:s",time());


				$query = "INSERT INTO games(game_id, game_name, game_description) VALUE('null', '$game_name', '$game_description')";  
			          
			    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
			          
			    echo "记录已经插入， mysql_insert_id() = ".mysql_insert_id();  
			          
			    mysql_close($connection);  

			}  
			
		}
	}

?>

	<script type = 'text/javascript'>
		window.location.href = "../AdminPage.php";
	</script>