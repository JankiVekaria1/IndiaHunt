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
?>
<?php 
if(isset($_POST['btn_submit']))
{
	$city=trim($_POST['txt_city']);
	$status=$_POST['rbt'];
	$query_city="select city from add_city where city='$city'";
	$exe_city=mysql_query($query_city);
	$num_city=mysql_num_rows($exe_city);
	
	if($num_city==1)
	{
		?>
        <script>
			window.onload=function()
			{
				alert('City is already exists');
				window.location="add_city.php";
			}
		</script>
        <?php
	}
	else
	{
		$submit= "insert into add_city (city,status) values ('$city','$status')";
		$exe=mysql_query($submit);
		if($exe)
		{
			?>
      		  <script>
				window.onload=function()
				{
					alert("Submit Successfully..");
					window.location="add_city.php";
				}
				</script>
        	<?php
		}
	}
	$status=($_POST['rbt']);

}
?>
<?php
	if(isset($_GET['did']))
	{
		$del="delete from add_city where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully..");
					window.location="add_city.php";
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
<title>  Add City - Admin Panel</title>
</head>

<body>
	
	<div class="main" style="height:800px;">
		<div style="line-height:100px; font-size:30px; font-family:'Comic Sans MS';">Admin Panel</div>
		<div class="m2">
			<?php
			include "menu.php";
			?>
		</div>
		<div class="m3">
			<div style="text-align:right"; width: 1000px;> Welcome,<?php echo $_SESSION['admin_email'];?></div>
			<form name="frm3" method="post">			
			<table border="0" style="width:400px;" cellpadding="4" cellspacing="4" >
			<tr>
				<td colspan="2" style="font-weight:bold;"> Add City </td>
			</tr>
				
			<tr>
				<td>
					City Name
				</td>
				<td>
					<input type="text" style="width:200px; height:20px" name="txt_city" required autocomplete="off"/>
				</td>
			</tr>
			<tr>
				<td>
					Status
				</td>
				<td>
					<input type="radio" name="rbt" value="Active" />Active
					<input type="radio" name="rbt" value="Deactive" />Deactive
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="btn_submit" value="submit" style="width:80px; height:20px;"  />
				</td>
			</tr>
			</table>
            
            </form>
            <BR/>
            <div style="height:200px; overflow:scroll;">
            <form name="frm_search" method="post">
    	<table border="2" align="left">
        	<tr>
            	<td> <input type="text" name="txt_search" /> </td>
                <td> <input type="submit" name="btn_search" value="Search" /></td>
            </tr>
        </table>
    </form>
        	<table border="2" align="center" width="100%">
        	<tr bgcolor="#33FFFF">
            	<th>city</th>
                <th>status </th>
                <th>Delete </th>
            </tr>
            <?php
				if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from add_city where city like '$search%'";
					$exe_view=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from add_city order by city asc";
					$exe_view=mysql_query($view);
				}
				else if($_GET['ord']=='dsc')
				{
					$view="select * from add_city order by city desc";
					$exe_view=mysql_query($view);
				}
				else
				{
					$view="select * from add_city";
					$exe_view=mysql_query($view);
				}
				while($result=mysql_fetch_array($exe_view))
				{
				?>
            	<tr>
            		<td> <?php echo $result['city'];?></td>
                	<td> <?php echo $result['status'];?></td>
                	<td> <a href="add_city.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete...?');">Delete </a></td>
            	</tr>
            	<?php
				}
				?>
        	</table>
                  </div>	   
		<div class="footer">
			<div style="width:1000px; text-align:center;">
				&copy; Copyright 2016. All Rights Reserved.
			</div>
		</div>
	</div>
    
    
</body>
</html>
