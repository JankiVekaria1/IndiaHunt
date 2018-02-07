<?php
session_start();
include "config.php";

if(!isset($_SESSION['admin_email']))
{
	?>
    <script>
		window.location="index.php";
	</script>
    <?php 
}

if(isset($_POST['btn_changepass']))
{
	$email=$_SESSION['admin_email'];
	$oldpass=trim(md5($_POST['txt_opsw']));
	$newpass=trim(md5($_POST['txt_npsw']));
	$repass=trim(md5($_POST['txt_cpsw']));
	
	$query_old="select * from admin_login where email='$email' and password='$oldpass'";
	
	$exe=mysql_query($query_old);
	
	$num_exe=mysql_num_rows($exe);
	
	if($num_exe==1)
	{
		if($newpass==$repass)
		{
			$update="update admin_login set password='$newpass' where email='$email'";
			$exe_update=mysql_query($update);
			if($exe_update)
			{
				?>
                <script>
					windoe.onload=function()
					{
						alert('password has been changed..');
						window.location="change_password.php";
					}
				</script>
                <?php 
			}
		}
		else
		{
			?>
            <script>
				window.onload=function()
				{
					alert('password does not match.');
					window.location="change_password.php";
				}
			</script>
            <?php 
		}
	}
	else
	{
		?>
        <script>
			window.onload=function()
			{
				alert('old password is incorrect.');
				window.location="change_password.php";
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
<title> Change Password - Admin Panel</title>
</head>

<body>
	<form name="frm9" method="post">
	<div class="main">
		<div style="line-height:100px; font-size:30px; font-family:'Comic Sans MS';">Admin Panel</div>
		<div class="m2">
			<?php
            	include "menu.php";
			?>
   		</div>
		<div class="m3">
			<div style="text-align:right"; width: 1000px;> Welcome,<?php echo $_SESSION['admin_email'];?></div>
			<table border="0" style="width:400px;">
			<tr>
				<td colspan="2" style="font-weight:bold"> Change Password </td> 
			</tr>
			<tr>	
				<td colspan="2"> Old Password: </td>
				<td> <input type="text" style="width:200px; height:20px;" name="txt_opsw" required autocomplete="off" />
				</td>
			</tr>
			<tr>	
				<td colspan="2"> New Password: </td>
				<td> <input type="text" style="width:200px; height:20px;" name="txt_npsw" required autocomplete="off"/>
				</td>
			</tr>
			<tr>	
				<td colspan="2"> Confirm Password: </td>
				<td> <input type="text" style="width:200px; height:20px;" name="txt_cpsw" required autocomplete="off"/>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" style="width:150px; height:20px;" value="Change Password" name="btn_changepass" />
				</td>
			</tr>
			</table>
            
         </div>
		<div class="footer">
			<div style="width:1000px; text-align:center;">
				&copy; Copyright 2016. All Rights Reserved.
			</div>
		</div>
	</div>
    </form>
    
</body>
</html>