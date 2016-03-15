<?php
	session_start();


	if(!$_SESSION)
	{
?>
		<script type = 'text/javascript'>
			window.location.href = "AdminLogin.html";	
		</script>

<?php
	}
	else
	{
?>
		<script type = 'text/javascript'>
			window.location.href = "AdminPage.php";
		</script>	
<?php
	}

?>