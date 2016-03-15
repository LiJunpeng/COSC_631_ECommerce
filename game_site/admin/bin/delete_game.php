<?php
$q=$_GET["data"];


		$db = "game_board";
		$connection = mysql_connect("localhost", "root", "12345");
		if ($connection)
		{
			$selection = mysql_select_db($db);

			if ($selection)
			{

				$query = "DELETE FROM games WHERE game_id = $q";  
			          
			    $result = mysql_query($query) or die("Error in query: $query. ".mysql_error());  
			            
			          
			    mysql_close($connection);  

			}  
			
		}
	

?>
	<script type = 'text/javascript'>
		window.location.href = "../AdminPage.php";
	</script>
