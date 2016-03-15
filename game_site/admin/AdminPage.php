<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/AdminPage.js"></script>
    <link href="css/AdminPage.css" type="text/css" rel="Stylesheet" />
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
                        <th><a href = "AdminPage.php">Games</a></th>
                        <th><a href = "StoreItem.php">Store Item</a></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div id="content">
        <div id="page_title_block">
            <table>
                <tr>
                    <th><div id="page_title_logo"></div></th>
                    <th><div id="page_title">Edit Game List</div></th>
                </tr>
            </table>

        </div>
        <div id="detail_block">

            <div id="create_game">
                <div id="form_block">
                    <form method = "POST" action = "bin/add_game.php" onsubmit="return check();">
                        <div  class="detail_info">Game name:</div>
                        <input type = "text" name = "game_name" placeholder="game name" id = "username_field" class="detail_info"/>
                        <br/>

                        <div  class="detail_info">Game description:</div>
                        <textarea name = "game_description" placeholder = "game description" id = "game_description_field" class="detail_info" rows="10" cols="60"></textarea>
                        <br/>

                        <input type = "submit" name="button" value = "Add Game" class="detail_info"/>
                    </form>
                </div>
            </div>

<br/>
<hr/>


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

                    <table>
                        <tr><th>
                            <table border="0" class="game_icon" >
                                <tr>
                                    <th><div class="game_icon"><img src="../public/images/game_icons/<?php echo $v['game_id']?>_large.png"  alt="icon" /></div></th>
                                </tr>
                            </table>
                        </th>

                        <th>
                            <table border="0" class="game_details" >
                                <tr>
                                    <th><div class="game_name">  <?php echo $v['game_name'] ?> </div></th>

                                </tr>
                                <tr>
                                    <th><div class="game_description"> <?php echo $v['game_description'] ?> </div></th>
                                </tr>
                            </table>
                        </th>

                       <th>
                            <table border="0" class="enter_game_block" >
                                <tr>
                            
                                <th><a href="bin/delete_game.php?data=<?php echo $v['game_id']?>"><div class="delete_game" onclick="delete_game(<?php echo $v['game_id']?>)"><img src="images/delete.png"  alt="icon" /></div></a></th>
                            
                                </tr>
                            </table>
                        </th>
                        </tr>
                    </table>

                </div>
            <?php
            }
              
            mysql_close($con);
            ?>

        </div>


<!--             <div id="create_item">
                <div id="form_block">
                    <form method = "POST" action = "../bin/sign_up.php" onsubmit="return check();">
                        <div  class="detail_info">Item Name:</div>
                        <input type = "text" name = "username" placeholder="username" id = "username_field" class="detail_info"/>
                        <br/>

                        <div  class="detail_info">Create Password:</div>
                        <input type= "password" name = "password" placeholder = "password" id = "password_field" class="detail_info"/>
                        <br/>

                        <div class="detail_info">Confirm Password:</div>
                        <input type= "password" name = "confirm_password" placeholder = "confirm password" id = "password_field" class="detail_info"/>
                        <br/>

                        <div class="detail_info">First Name:</div>
                        <input type= "text" name = "first_name" placeholder = "John" id = "first_name_field" class="detail_info"/>
                        <br/>

                        <div class="detail_info">Last Name:</div>
                        <input type= "text" name = "last_name" placeholder = "Smith" id = "last_name_field" class="detail_info"/>
                        <br/>

                        <div class="detail_info">Email address:</div>
                        <input type= "text" name = "email" placeholder = "abc@abc.com" id = "email_field" class="detail_info"/>
                        <br/>

                        <input type = "submit" name="button" value = "Sign Up" class="detail_info"/>
                    </form>
                </div>
            </div> -->


            

        </div>

    </div>


    <div id="footer"></div>
</body>

    <footer id="footer">
        <nav><p>Copyright 2015 by Group5. Made with 100% recycled pixels.</p></nav>
    </footer>

</html>