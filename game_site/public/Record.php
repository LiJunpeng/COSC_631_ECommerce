<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/Record.js"></script>
    <link href="css/Record.css" type="text/css" rel="Stylesheet" />
    <link href="css/Frame.css" type="text/css" rel="Stylesheet" />

    <!--script type="text/javascript" src="../bin/get_username.php?action=test"></script-->
</head>
<body onload="loadContent()">

    <nav>
        <div id="account_tool">
            <div id="logout"><a href = "../bin/logout.php">Logout</a></div>
            <div id="username"><a href="account.php"><?php session_start();echo $_SESSION["username"]; ?></a> </div>
        </div>
    </nav> 

    <div id="header">
        <div id="banner">
            <div id="banner_title">Game Website</div>
        </div>
        <div id="main_menu_block">
            <div id="main_menu">
                <table>
                    <tr>
                        <th><a href = "GameMenu.php">Game Menu</a></th>
                        <th><a href = "Record.php">Record</a></th>
                        <th><a href = "Store.php">Store</a></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div id="content">
        <div id="page_title_block">
            <table>
                <tr>
                    <th><div id="page_title_logo" style="background-image:url('images/record_logo.png');"></div></th>
                    <th><div id="page_title">Record</div></th>
                </tr>
            </table>
        </div>

        <div id="detail_block">

            <div id="overall_block">


            <?php
                session_start();

               $user_id = $_SESSION["user_id"];
               $user_name = $_SESSION["username"];
               //error_log('====Record=username:'.$_SESSION["username"]);
              // error_log('====game_id'.$_POST["game_id"]);
               //error_log('====score'.$_POST["score"]);
               //=========Maryam's code==================
               if($_POST["game_id"]==1 && $_POST["score"]){

                $game_id = $_POST["game_id"];
                $score = $_POST["score"];
                   $conn = new mysqli("localhost", "root", "12345", "game_board");
                   if ($conn->connect_error) {
                         die("Connection failed: " . $conn->connect_error);
                    } 

                $sql = "INSERT INTO records (user_id, game_id, score, win, lose) VALUES ('$user_id', '$game_id',
                    '$score', '1','0')";

                     if ($conn->query($sql) === TRUE) {
                        //echo "New record created successfully";
                    } else {
                       // echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    $conn->close();
                }
               else{
                    //error_log('====Record=username:'.$_POST);
                }

            ?>

                <table id="identity"  style="display:inline-block">
                    <tr>
                        <th rowspan = "3"><div id="avatar" style="background-image:url('../public/images/avatars/<?php echo $user_id ?>.png')"></div></th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th><div id="account_name"><?php echo $user_name ?></div></th>
                    </tr>
                </table>

                <?php 

                    //$total_score;

                    $con = mysql_connect("localhost","root","12345");

                    if (!$con)
                    {
                        die('Fail to connect to DB' . mysql_error());
                    }
                    else
                    {
                        mysql_select_db("game_board", $con);
                        $result = mysql_query("SELECT * FROM records WHERE user_id = $user_id");
                        while($row = mysql_fetch_array($result))
                        {
                            $rows[]=$row;
                            $total_score += $row["score"];
                            $total_wins += $row["win"];
                            $total_lose += $row["lose"];
                        }

                        if ($total_lose == 0)
                        {
                            $overall_wl = $total_wins;
                        }
                        else if ($total_wins == 0)
                        {
                            $overall_wl = 0;
                        }
                        else
                        {
                            $overall_wl = $total_wins / $total_lose;
                        }

                    }
                ?>

                <table id="overall_record"  style="display:inline-block">
                    <tr>
                        <th>Total Score:</th>
                        <th><div id="total_score"><?php echo $total_score ?></div></th>
                        <th>Total Wins:</th>
                        <th><div id="total_wins"><?php echo $total_wins ?></div></th>
                    </tr>
                    <tr>
                        <th>Games Played:</th>
                        <th><div id="game_played"><?php echo $total_wins + $total_lose ?></div></th>
                        <th>Overall Win/Lose:</th>
                        <th><div id="overall_wl"><?php echo $overall_wl ?></div></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                </table>
            </div>


            <?php            
                foreach($rows as $key=>$v)
                {
                    $id = $v["game_id"];
                    $name = mysql_fetch_assoc(mysql_query("SELECT game_name FROM games WHERE game_id = $id"));
            ?>

            <div class="game_record_block">

                <table class="game_info"  style="display:inline-block">
                    <tr>
                        <th rowspan = "3"><div class="game_icon"><img src="../public/images/game_icons/<?php echo $v['game_id'] ?>.png"  alt="icon" /></div></th>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <th><div class="game_name"><?php echo $name["game_name"] ?></div></th>
                    </tr>
                </table>



                <table class="game_record"  style="display:inline-block">
                    <tr>
                        <th class="info_detail">Game Score:</th>
                        <th><div class="total_score"><?php echo $v['score'] ?> </div></th>
                        <th>Wins:</th>
                        <th><div class="total_wins"><?php echo $v['win'] ?></div></th>
                    </tr>
                    <tr>
                        <th>Games Played:</th>
                        <th><div class="game_played"><?php echo $v['win']+$v['lose'] ?></div></th>
                        <th>Overall Win/Lose:</th>
                        <th><div class="overall_wl"><?php if ($v['lose'] == 0){echo $v['win'];}else if ($v['win'] == 0){echo $v['lose'];}else{echo $v['win'] / $v['lose'];} ?></div></th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>

                </table>
            </div>
            <?php
                }
                  
                mysql_close($con);
            ?>

            
        </div>

    </div>


    <div id="footer"></div>
</body>
</html>