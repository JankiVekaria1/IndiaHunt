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
	$cat=($_POST['ddl_cat']);
	$subc=trim(($_POST['txt_subcategory']));
	$query_sub="select subcategory from add_subcategory where subcategory='$subc'";
	$exe_sub=mysql_query($query_sub);
	
	$num_sub=mysql_num_rows($exe_sub);
	
	if($num_sub==1)
	{
		?>
        <script>
			window.onload=function()
			{
				alert('Subcategory is already exists');
				window.location="add_subcategory.php";
			}
		</script>
        <?php
	}
	else
	{
		$submit= "insert into add_subcategory (cat,subc) values ('$cat','$subc')";
		$exe=mysql_query($submit);
		if($exe)
		{
		?>
    		<script>
			window.onload=function()
			{
				alert("Submit Successfully...!");
				window.location="add_subcategory.php";
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
		$del="delete from add_subcategory where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully...");
					window.location="add_subcategory.php";
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
<title> Add Subcategory - Admin Panel</title>
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
            <form name="frm8" method="post">
			<table border="0" style="width:400px;">
				<tr>
					<td colspan="2" style="font-weight:bold"> Add Sub Category </td> 
				</tr>
				<tr>
					<td colspan="2">Category </td>
					<td>
                    <?php
						$query_cat="select category from add_category";
						$exe_cat=mysql_query($query_cat);
					?>
						<select name="ddl_cat" style="width:200px; height:20px;" >
							<option value="">-Select Category-</option>
                            <?php
							while($res_cat=mysql_fetch_array($exe_cat))
							{
								?>
                                <option value="<?php echo $res_cat['category'];?>"><?php echo $res_cat['category'];?></option>
                                <?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2"> Sub category </td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_subcategory" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" style="width:80px; height:20px;" value="submit" name="btn_submit" required />
					</td>
				</tr>
			</table>
            </form>
            <br/>
            <div style="height:200px; overflow:scroll;">
            <form name="frm_search" method="post">
    	<table border="2" align="left">
        	<tr>
            	<td><input type="text" name="txt_search" /> </td>
                <td><input type="submit" name="btn_search" value="Search" /> </td>
            </tr>
        </table>
    </form>
            <table border="2" align="center" width="100%">
            	<tr bgcolor="#999999">
                	<th>cat </th>
                    <th>subc </th>
                    <th>Delete </th>
                </tr>
                <?php
				if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from add_subcategory where cat like '$search%' ";
					$exe_view=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from add_subcategory order by cat asc";
					$exe_view=mysql_query($view);
				}	
				else if($_GET['ord']=='dsc')
				{
					$view="select * from add_subcategory order by cat desc";
					$exe_view=mysql_query($view);
				}
				else
				{
					$view="select * from add_subcategory";
					$exe_view=mysql_query($view);
				}
		
			while($result=mysql_fetch_array($exe_view))
			{
			?>
            <tr>
            	<td> <?php echo $result['cat'];?></td>
                <td> <?php echo $result['subc'];?></td>
                <td> <a href="add_subcategory.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete..?')">Delete </a></td>
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
