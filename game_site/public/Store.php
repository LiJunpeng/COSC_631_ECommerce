<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/store.js"></script>
    <link href="css/store.css" type="text/css" rel="Stylesheet" />
    <link href="css/Frame.css" type="text/css" rel="Stylesheet" />
</head>
<body onload="loadContent()">

    <div id="cover_layer"></div>
    <div id="warning_window">
        <div id="warning_message">Confirm your purchase</div>
        <div id="yes_button" onclick=" buy_item (item_id, user_id)">Yes</div>
        <div id="no_button" onclick="cancelWarning()">No</div>
    </div>

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
                    <th><div id="page_title_logo" style="background-image:url('images/store_logo.png')"></div></th>
                    <th><div id="page_title">Game Store</div></th>
                </tr>
            </table>

        </div>



        <div id="detail_block">

            <?php
               $user_id = $_SESSION["user_id"];
            ?>


            <table id="content_wrapper">
                <tr>
                    <th>
                        
                        <div id="inventory_block" >
                        <div id="inventory_title">Inventory</div>
                            <?php
                            $con = mysql_connect("localhost","root","12345");

                                if (!$con)
                                {
                                    die('Fail to connect to DB' . mysql_error());
                                }
                                else
                                {
                                    mysql_select_db("game_board", $con);
                                    $result = mysql_query("SELECT * FROM items");
                                    while($row = mysql_fetch_array($result))
                                    {
                                        $item_rows[]=$row;
                                    }

                                    $result = mysql_query("SELECT * FROM item_list WHERE user_id = $user_id");
                                    while($row = mysql_fetch_array($result))
                                    {
                                        $inventory_rows[]=$row;
                                    }
                                }

                                foreach($inventory_rows as $key=>$v){
                            ?>
                            <div class="inventory_item_block" >
                                <table class="inventory_item_details">
                                    <tr>
                                        <td><div class="inventory_item_icon"><img src="../public/images/items/<?php echo $v['item_id']?>_large.png"  alt="icon" /></div></td>
                                        <td><div class="inventory_item_name"><?php $id = $v['item_id']; echo mysql_fetch_assoc(mysql_query("SELECT item_name FROM items WHERE item_id = $id"))["item_name"]?></div></td>
                                    </tr>
                                </table>
                            </div>

                            <?php
                                }
                            ?>
                    </div>


                    </th>


                    <th>
                        
                        <div id="store_block" >
                        <div id="store_title">Store</div>
                        <?php

                          
                        foreach($item_rows as $key=>$v){
                        ?>
                       
                            <div class="store_item">

                                <table class="item_icon_block" >
                                    <tr>
                                        <th><div class="item_icon"><img src="../public/images/items/<?php echo $v['item_id']?>_large.png"  alt="icon" /></div></th>
                                    </tr>
                                </table>

                                <table  class="item_details_block" >
                                    <tr>
                                        <th><div class="item_name">  <?php echo $v['item_name'] ?> </div></th>

                                    </tr>
                                    <tr>
                                        <th><div class="item_description"> <?php echo $v['item_description'] ?> </div></th>
                                    </tr>
                                </table>

                                <table  class="buy_block" >
                                    <tr>
                                        <th><div class="buy_item" onclick="confirmBuy(<?php echo $v['item_id']?>,<?php echo $user_id ?>)"><img src="../public/images/buy_item.png"  alt="icon" /></div></th>
                                    </tr>
                                </table>

                            </div>

                        <?php    
                            }
                            mysql_close($con);
                        ?>

                        </div>
                    </th>
                </tr>
            </table>



        </div>

    </div>





    <div id="footer"></div>
</body>
</html>