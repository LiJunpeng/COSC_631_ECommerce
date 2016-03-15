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


    <div id="content" style="height:600px;">
        
        <h1>Under construction</h1>

    </div>


    <div id="footer"></div>
</body>

    <footer id="footer">
        <nav><p>Copyright 2015 by Group5. Made with 100% recycled pixels.</p></nav>
    </footer>

</html>