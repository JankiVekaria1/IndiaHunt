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
// insert code start 
 
if(isset($_POST['btn_Submit']))
{
	$category=trim($_POST['txt_Category']);
	
	$query_cat="select category from add_category where category='$category'";
	$exe_cat=mysql_query($query_cat);
	
	$num_cat=mysql_num_rows($exe_cat);
	
	if($num_cat==1)
	{
		?>
        <script>
			window.onload=function()
			{
				alert('Category is already exists');
				window.location="add_category.php";
			}
		</script>
        <?php
	}
	else
	{
	
		$submit= "insert into add_category (category) values ('$category')";
		$exe=mysql_query($submit);
		if($exe)
		{
		?>
        <script>
			window.onload=function()
			{
				alert("Category has been added");
				window.location="add_category.php";
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
		$del="delete from add_category where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully...");
					window.location="add_category.php";
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
<title>Add Category - Admin Panel</title>
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
		<form name="frm2" method="post">
        <table border="0" style="width:300px;" cellpadding="4" cellspacing="4" >
		
			<tr>
				<td colspan="2" style="font-weight:bold;">Add Category</td>
			</tr>
			<tr>
				<td> Category </td>
				<td> 
					<input type="text" style="width:200px; height:20px;" name="txt_Category" required autocomplete="off"/>
				</td>
			</tr>
			<tr>
				<td colspan="2"> 
					<input type="Submit" name="btn_Submit" value="Submit" style="width:80px; height:28px;" />
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
                    <td><input type="submit" name="btn_search" value="Search"</td></td>
                </tr>
            </table>
         </form>

        <table border="2" align="center" width="100%">
        	<tr bgcolor="#33FFFF">
            	<th>Category </th>
                <th>Delete</th>
            </tr>
            <?php
				if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from add_category where category like '$search%'";
					$exe_view=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from add_category order by category asc";
					$exe_view=mysql_query($view);
				}
				else if($_GET['ord']=='dsc')
				{
					$view="select * from add_category order by category desc";
					$exe_view=mysql_query($view);
				}
				else
				{
				$view="select * from add_category";
				$exe_view=mysql_query($view);
				}
			while($result=mysql_fetch_array($exe_view))
			{
			?>
            <tr>
            	<td> <?php echo $result['category'];?></td>
                <td> <a href="add_category.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete..?');"> Delete </a> </td>
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
