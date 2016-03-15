
        <?php

            $q=$_GET["data"];


            $user_id = explode("_",$_GET["data"])[0];
            $score = explode("_",$_GET["data"])[1];

            $game_id = 2;

        $con = mysql_connect("localhost","root","12345");

            if (!$con)
            {
                die('Fail to connect to DB' . mysql_error());
            }
            else
            {//UPDATE accounts SET credit = '$remain' WHERE user_id = $user_id
                //if($r == 1)
                //{
                    $result1 = mysql_query("SELECT win FROM records WHERE user_name = $username");
                    $win = mysql_fetch_array($result1)[0];
                    $win ++;
                //}




                mysql_select_db("game_board", $con);
                $result = mysql_query($query = "UPDATE records(record_id, user_id, game_id, score, win, lose) VALUE('null', '$user_id', '$game_id', '$score', '$win', 'null')");


            //     $result = mysql_query("SELECT * FROM item_list WHERE user_id = $user_id");
            //     while($row = mysql_fetch_array($result))
            //     {
            //         $inventory_rows[]=$row;
            //     }
            }

            // foreach($inventory_rows as $key=>$v){
        ?>