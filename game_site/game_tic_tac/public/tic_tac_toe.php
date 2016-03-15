<?php
session_start();
error_log('================username:'.$_SESSION["username"]);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="css/GameMenu.css" type="text/css" rel="Stylesheet" />
    <link href="css/Frame.css" type="text/css" rel="Stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type = "text/javascript"src = "app.js" >	</script>

</head>

<body>

  <body onload="loadContent()">

    <nav>
        <div id="account_tool">
            <div id="username"><a href="account.php"><?php session_start();echo $_SESSION["username"]; ?></a> </div>
            <div id="logout"><a href = " ../../bin/logout.php">Logout</a></div>
        </div>
    </nav> 

    <div id="header">
        <div id="banner">
            <div id="banner_title">Tic Tac Toe</div>
        </div>
        <div id="main_menu_block">
            <div id="main_menu">
            </div>
        </div>
    </div>


<!-- <p id="test2">This is another paragraph.</p>
 -->
<!-- <p>Input field: <input type="text" id="test3" value="Mickey Mouse"></p>
 -->

<center><h1 id="command">Wait!</h1></center>

<TABLE BORDER CELLPADDING="50" bordercolor="green" bgcolor= "yellow" align="center" id="myTable">
	
<TR>
<TD id="rowcol1"></TD>
<TD id="rowcol2"></TD>
<TD id= "rowcol3"></TD>
</TR>
<TR>
<TD id = "rowcol4"></TD>
<TD id = "rowcol5"></TD>
<TD id = "rowcol6"></TD>
</TR>
<TR>
<TD id="rowcol7"></TD>
<TD id = "rowcol8"></TD>
<TD id ="rowcol9"></TD>
</TR>
</TABLE>

<center> <button class="btn" onclick="myFunction()">Finish The Game!</button><center>

<p id="demo"></p>

<form id="sampleForm" name="sampleForm" method="post" action="../../public/Record.php?action=DoThis">
<input type="hidden" name="score" id="score" value="">
<input type="hidden" name="game_id" id="game_id" value="">
</form>

<script>
function myFunction() {

	var game_status = document.getElementById('command').innerHTML;
    alert(game_status);
    if (game_status=="You are winner!"){

        document.sampleForm.score.value = 100;
        document.sampleForm.game_id.value = 1;
        document.forms["sampleForm"].submit();
    	//document.location = "MyPage.php?action=DoThis";

    }
    else if(game_status=="You are looser!"){
    	//document.location = "MyPage.php?action=DoThis";
         //document.sampleForm.total.value = 100;
         document.sampleForm.score.value = -100;
         document.sampleForm.game_id.value = 1;
         document.forms["sampleForm"].submit();
    }
    else{
        document.sampleForm.score.value = -100;
        document.sampleForm.game_id.value = 1;
        document.forms["sampleForm"].submit();
    }
}

function createCallback(conn, i ){
  return function(){
    //alert('you clicked' + i);
    var msg = {};
    msg.type="position_click"
    msg.position = i;
    var json = JSON.stringify(msg);
    conn.send(json);
  }
}
</script>


<!-- <button id="btn1">Set Text</button>
<button id="btn2">Set HTML</button>
<button id="btn3">Set Value</button> -->

</body>
</html>