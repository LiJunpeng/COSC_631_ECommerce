<?php

$q=$_GET["data"];


$item_id = explode("_",$_GET["data"])[0];
$user_id = explode("_",$_GET["data"])[1];

 	$con = mysql_connect("localhost","root","12345");

        if (!$con)
        {
            die('Fail to connect to DB' . mysql_error());
        }
        else
        {
            mysql_select_db("game_board", $con);
			$user_credit = mysql_fetch_array(mysql_query("SELECT credit FROM accounts WHERE user_id = $user_id"))[0];
			$price = mysql_fetch_array(mysql_query("SELECT credit FROM items WHERE item_id = $item_id"))[0];

			if ($user_credit > $price){
				$remain = $user_credit - $price;
				mysql_query("UPDATE accounts SET credit = '$remain' WHERE user_id = $user_id");

				mysql_query("INSERT INTO item_list(list_id, item_id, user_id) VALUE('null', '$item_id','$user_id')");          
			
				$item_name = mysql_fetch_assoc(mysql_query("SELECT item_name FROM items WHERE item_id = $item_id"))["item_name"];

				echo $item_name;

			}
			else
			{
				echo false;
			}
        }

?>
