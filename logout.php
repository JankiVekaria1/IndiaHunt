<?php
session_start();

session_unset($_SESSION['admin_email']);
?>
<script>
	window.location="index.php";
</script>