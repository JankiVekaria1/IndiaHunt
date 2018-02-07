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
	$title=trim($_POST['txt_title']);
	$query_title="select title from add_news where title='$title'";
	$exe_title=mysql_query($query_title);
	$num_title=mysql_num_rows($exe_title);
	if($num_title==1)
	{
		?>
        <script>
			window.onload=function()
			{
				alert('Title is already exists');
				window.location="add_news.php";
			}
		</script>
        <?php
	}
	else
	{
		$submit= "insert into add_news (title,description) values ('$title','$description')";
		$exe=mysql_query($submit);
		if($exe)
		{
		?>
    		<script>
			window.onload=function()
			{
				alert("Submit Successfully...!");
				window.location="add_news.php";
			}
			</script>
       	 <?php
		}
	}
	$description=trim($_POST['descr']);
	
	
}
?>
<?php
	if(isset($_GET['did']))
	{
		$del="delete from add_news where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully..");
					window.location="add_news.php";
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
<title> Add News</title>
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
			<div style="text-align:right"; width: 1000px;> Welcome, <?php echo $_SESSION['admin_email'];?></div>
            <form name="frm6" method="post">
			<table border="0" style="width:400px">
				<tr>
					<td colspan="2" style="font-weight:bold"> Add News </td>
				</tr>
				<tr>
					<td> Title	</td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_title" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td valign="top"> Description </td>
					<td>
						<textarea name="description" cols="26" rows="6" required ></textarea>
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
                <td><input type="submit" name="btn_search" value="Search" </td></td>
            </tr>
        </table>
    </form>
        	<table border="2" align="center" width="100%">
        	<tr bgcolor="#33FFFF">
            	<th>title</th>
                <th>description </th>
                <th>Delete </th>
             </tr>
            <?php
			if(isset($_POST['btn_search']))
			{
				$search=trim($_POST['txt_search']);
				$view="select * from add_news where title like '$search%'";
				$exe_view=mysql_query($view);
			}
			else if($_GET['ord']=='asc')
			{
				$view="select * from add_news order by title asc";
				$exe_view=mysql_query($view);
			}
			else if($_GET['ord']=='dsc')
			{
				$view="select * from add_news order by title desc";
				$exe_view=mysql_query($view);
			}
			else
			{
				$view="select * from add_news";
				$exe_view=mysql_query($view);
			}
			while($result=mysql_fetch_array($exe_view))
			{
			?>
            <tr>
            	<td> <?php echo $result['title'];?></td>
                <td> <?php echo $result['description'];?></td>
                <td> <a href="add_news.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete..?');"> Delete </a></td>
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
