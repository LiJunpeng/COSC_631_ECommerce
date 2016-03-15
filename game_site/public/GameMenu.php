<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/GameMenu.js"></script>
    <link href="css/GameMenu.css" type="text/css" rel="Stylesheet" />
    <link href="css/Frame.css" type="text/css" rel="Stylesheet" />
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
                    <th><div id="page_title_logo" style="background-image:url('images/game_menu_logo.png')"></div></th>
                    <th><div id="page_title">Game Menu</div></th>
                </tr>
            </table>

        </div>
        <div id="detail_block">


            <?php
            $con = mysql_connect("localhost","root","12345");

            if (!$con)
              {
              die('Fail to connect to DB' . mysql_error());
              }
              else
              {
                mysql_select_db("game_board", $con);
                $result = mysql_query("SELECT * FROM games");
                while($row = mysql_fetch_array($result))
                {
                    $rows[]=$row;
                }
              }
              
            foreach($rows as $key=>$v){
            ?>
                <div class="game_block" id="">

                    <table border="0" class="game_icon" >
                        <tr>
                            <th><div class="game_icon"><img src="../public/images/game_icons/<?php echo $v['game_id']?>_large.png"  alt="icon" /></div></th>
                        </tr>
                    </table>

                    <table border="0" class="game_details" >
                        <tr>
                            <th><div class="game_name">  <?php echo $v['game_name'] ?> </div></th>

                        </tr>
                        <tr>
                            <th><div class="game_description"> <?php echo $v['game_description'] ?> </div></th>
                        </tr>
                    </table>
                    <table border="0" class="enter_game_block" >
                        <tr>
                            
                        <?php
                        if($v['game_id'] == 1){
                        ?>
                        <th><div class="enter_game" onclick="document.location.href = '../game_tic_tac/public/tic_tac_toe.php'"><img src="../public/images/enter_game.png"  alt="icon" /></div></th>
                        <?php
                        }
                        else{
                        ?>
                        <th><div class="enter_game" onclick="enter_game(<?php echo $v['game_id']?>)"><img src="../public/images/enter_game.png"  alt="icon" /></div></th>
                        <?php
                        }
                        ?>
                    
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