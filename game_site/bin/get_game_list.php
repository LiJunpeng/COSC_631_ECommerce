


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
    echo $v['goods_name']."---".$v['goods_number']."---".$v['shop_price']."";
}
  
mysql_close($con);
?>