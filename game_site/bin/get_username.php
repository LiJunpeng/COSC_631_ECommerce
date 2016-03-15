<?php

session_start();

$name = $_SESSION["username"];
$id = $_SESSION["user_id"];
echo "var user_id="."'$id'";
echo ";";
echo "var username="."'$name'";


?>