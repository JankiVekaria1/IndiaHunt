<?php
session_start();
include "config.php";

if(isset($_POST['btn_login']))
{
	$email=trim($_POST['txt_email']);
	$pass=trim(md5(mysql_real_escape_string($_POST['txt_pass'])));
	
	
	$query_login="select * from admin_login where email='$email' and password='$pass'";
	$exe_login=mysql_query($query_login);
	
	$num_login=mysql_num_rows($exe_login);
	
	if($num_login==1)
	{
		$_SESSION['admin_email']=$email;
		?>
        <script>
			window.location="dashboard.php";
		</script>
        <?php
	}
	else
	{
		?>
        <script>
			window.onload=function()
			{
				alert('Email or Password is incorrect');
				window.location="index.php";
			}
		</script>
        <?php
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link rel="stylesheet" type="text/css" href="Css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Admin Login - Admin Panel </title>
</head>
<body>
	<div class="main">
		<div style="line-height:100px; font-size:30px; font-family:'Comic Sans MS';">Admin Panel</div>
		<div class="m1">
			<div style="text-align:center; width:1000px; font-size:28px;">Admin Login</div>
			<div class="m11">
			<fieldset style="border-radius:20px; background-color:#CCCCFF;">	
				<legend>Admin Login</legend>
                <form name="frm_admin_login" method="post">
				<table border="0" style="width:350px; margin-left:100px;" cellspacing="4" cellpadding="4">
					<tr>
						<td>
							Email :
						</td>
						<td>
							<input type="email" style="width:220px; height:22px;" name="txt_email" required autocomplete="off"/>
						</td>
					</tr>
					<tr>
						<td>Password :</td>
						<td>
                        	<input type="password" name="txt_pass" style="width:220px; height:22px;" maxlength="18" required/>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="btn_login" value="Login" style="width:80px; height:28px;"/>
						</td>
					</tr>
				</table>
                </form>
				</fieldset>
			</div>
		</div>
		<div class="footer">
			<div style="width:1000px; text-align:center;">
				&copy; Copyright 2016. All Rights Reserved.
			</div>
		</div>
	</div>
</body>
</html>