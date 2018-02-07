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
		$city=$_POST['txt_city'];
		$school=$_POST['txt_sch_name'];
		$address=$_POST['address'];
		$contact=$_POST['txt_contact'];
		$img=$_FILES['photo']['name'];
		$tmp_img=$_FILES['photo']['tmp_name'];
		
		move_uploaded_file($tmp_img,'school/'.$img);
		
		$sch="select city,school,address,contact from add_school_college where city='$city' and school='$school' and address='$address' and contact='$contact'";
		$exe_sch=mysql_query($sch);
		$num_sch=mysql_num_rows($exe_sch);
		
		if($num_sch==1)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Sch is already exists.");
					window.location="add_school_college.php";
				}
			</script>
            <?php
		}
		else
		{
			$submit="insert into add_school_college (city,school,address,contact,photo) values ('$city','$school','$address','$contact','$img')";
			$exe=mysql_query($submit);
			if($exe)
			{
				?>
        		<script>
					window.onload=function()
					{
						alert("Submit Successfully...");
						window.location="add_school_college.php";
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
		$del="delete from add_school_college where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully...");
					window.location="add_school_college.php";
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
<title> Add School College - Admin Panel </title>
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
            <form name="frm7" method="post" enctype="multipart/form-data">
			<table border="0" style="width:400px">
				<tr>
					<td colspan="2" style="font-weight:bold"> Add School/College </td>
				</tr>
				<tr>
					<td colspan="2"> City	</td>
					<td> 
						<input type="text" style="width:200px; height:20px;" name="txt_city" required autocomplete="off" />
					</td>
				</tr>
				<tr>
					<td colspan="2"> School Name </td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_sch_name" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td colspan="2"> Address </td>
					<td>
						<textarea name="address" cols="25" rows="4" >
						</textarea>
					</td>
				</tr>
				<tr>	
					<td colspan="2"> Contact </td>
					<td>
						<input type="text" style="width:200px; height:20px;" name="txt_contact" required autocomplete="off"/>
					</td>
				</tr>
				<tr>
					<td colspan="2"> Photo	</td>
					<td> 
						<input type="file" name="photo" style="width:200px; height:20px;" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" style="width:80px; height:20px;" name="btn_submit" value="submit" />
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
                        <td><input type="submit" name="btn_search" value="Search" ></td>
                    </tr>
                </table>
            </form>
            <table border="2" align="center" width="100%">
            	<tr bgcolor="#99FF00">
                	<th>city </th>
                    <th>school </th>
                    <th>address </th>
                    <th>contact </th>
                    <th>photo </th>
                    <th>delete </th>
                </tr>
                <?php
				if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from add_school_college where city like '$search%'";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from add_school_college order by city asc";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='dsc')
				{
					$view="select * from add_school_college order by city desc";
					$view_exe=mysql_query($view);
				}
				else
				{
					$view="select * from add_school_college";
					$view_exe=mysql_query($view);
				}
					while($result=mysql_fetch_array($view_exe))
					{
				?>
                <tr>
                	<td> <?php echo $result['city'];?> </td>
                    <td> <?php echo $result['school'];?> </td>
                    <td> <?php echo $result['address'];?> </td>
                    <td> <?php echo $result['contact'];?> </td>
                    <td> <img src="<?php echo 'school/'.$result['photo'];?>" height="50" width="50" alt="Not Found" /></td>
                    <td> <a href="add_school_college.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete..?');">delete</a> </td>
                   
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