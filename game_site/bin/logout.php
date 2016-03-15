<?php
session_start();

if($_SESSION)
{
	session_destroy();


?>

<script type="text/javascript">
alert("logout");
window.location.href = "../public/index.php";
</script>

<?php
}
?>