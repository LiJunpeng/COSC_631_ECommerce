<?php
	session_start();


	if(!$_SESSION)
	{
?>
		<script type = 'text/javascript'>
			window.location.href = "Login.html";	
		</script>

<?php
	}
	else
	{
?>
		<script type = 'text/javascript'>
			window.location.href = "GameMenu.php";
		</script>	
<?php
	}

?>