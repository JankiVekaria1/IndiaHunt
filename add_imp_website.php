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
	$category=trim($_POST['txt_category']);
	$url=trim($_POST['txt_url']);
	
	$web="select category,url from add_imp_website where category='$category' and url='$url'";
	$exe_web=mysql_query($web);
	$num_web=mysql_num_rows($exe_web);
	
	if($num_web==1)
	{
		?>
        <script>
			window.onload=function()
			{
				alert("Web is already exists");
				window.location="add_imp_website.php";
			}
		</script>
        <?php
	}
	else
	{
		$submit= "insert into add_imp_website (category,url) values ('$category','$url')";
		$exe=mysql_query($submit);
		if($exe)
		{
			?>
     	   <script>
				window.onload=function()
				{
					alert("Submit Successfully...!");
					window.location="add_imp_website.php";
				}
			</script>
       	 <?php
		}
	}
}
?>
<?php
	if(isset($_GET['did']))
	{
		$del="delete from add_imp_website where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully..");
					window.location="add_imp_website.php";
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
<title> Add Imp Website</title>
</head>

<body>
	<div class="main">
		<div style="line-height:100px; font-size:30px; font-family:'Comic Sans MS';">Admin Panel</div>
		<div class="m2">
			<?php
				include "menu.php";
			?>
		</div>
        <div class="m3">
			<div style="text-align:right"; width: 1000px;> Welcome, <?php echo $_SESSION['admin_email'];?></div>
            <form name="frm5" method="post">
			<table border="0" style="width:400px;">
				<tr>
					<td colspan="2" style="font-weight:bold">Add Imp Website </td>
				</tr>
				<tr>
					<td> Category </td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_category" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td> URL </td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_url" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" style="width:80px; height:20px;" name="btn_submit" value="submit" />
					</td>
				</tr>
			</table>
            </form>
              <BR/>
              <div style="height:200px; overflow:scroll;">
              <form name="frm_search" method="post">
    	<table border="2" align="left">
        	<tr>
            	<td><input type="text" name="txt_search" /> </td>
                <td><input type="submit" name="btn_search" value="Search"</td> </td>
            </tr>
        </table>
    </form>
        	<table border="2" align="center" width="100%">
        	<tr bgcolor="#33FFFF">
            	<th>category</th>
                <th>url </th>
                <th>Delete </th>
            </tr>
            <?php
			if(isset($_POST['btn_search']))
			{
				$search=trim($_POST['txt_search']);
				$view="select * from add_imp_website where category like '$search%'";
				$exe_view=mysql_query($view);
			}
			else if($_GET['ord']=='asc')
			{
				$view="select * from add_imp_website order by category asc";
				$exe_view=mysql_query($view);
			}
			else if($_GET['ord']=='dsc')
			{
				$view="select * from add_imp_website order by category desc";
				$exe_view=mysql_query($view);
			}
			else
			{
				$view="select * from add_imp_website";
				$exe_view=mysql_query($view);
			}
			while($result=mysql_fetch_array($exe_view))
			{
			?>
            <tr>
            	<td> <?php echo $result['category'];?></td>
                <td> <?php echo $result['url'];?></td>
                <td> <a href="add_imp_website.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are u Sure To Delete..?');">Delete</a></td>
            </tr>
            <?php
			}
			?>
        </table>
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
