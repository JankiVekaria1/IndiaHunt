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
	$business=trim($_POST['txt_business']);
	$tycon=trim($_POST['txt_tycon']);
	$dob=trim($_POST['txt_date']);
	$profile=trim($_POST['txt_profile']);
	$img=$_FILES['photo']['name'];
	$tmp_img=$_FILES['photo']['tmp_name'];
		
	move_uploaded_file($tmp_img,'business_tycon/'.$img);
		
	$submit="insert into business_tycon (city,business,tycon,dob,profile,photo) values ('$city','$business','$tycon','$dob','$profile','$img')";
		$exe=mysql_query($submit);
		if($exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Submit Successfully...");
					window.location="business_tycon.php";
				}
			</script>
            <?php
		}
	}
?>
<?php
	if(isset($_GET['did']))
	{
		$del="delete from business_tycon where id='".$_GET['did']."'";
		$del_exe=mysql_query($del);
		if($del_exe)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully..!");
					window.location="business_tycon.php";
				}
			</script>
            <?php
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" media="all" href="calendar/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="calendar/jsDatePick.min.1.3.js"></script>
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
<link rel="stylesheet" type="text/css" href="Css/style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Business Tycon - Admin Panel</title>
</head>

<body>
	<div class="main" style="height:800px;">
		<div style="line-height:100px; font-size:30px; font-family:'Comic Sans MS';">Admin Panel</div>
		<div class="m2">
			<?php
			 include "menu.php";
			?>
		</div>
		<div class="m3" style="height:700px;">
			<div style="text-align:right"; width: 1000px;> Welcome, <?php echo $_SESSION['admin_email'];?></div>
            <form name="frm12" method="post" enctype="multipart/form-data">
			<table border="0" style="width:400px;" cellpadding="4" cellspacing="4">
            	<tr>
                	<td colspan="2" style="font-weight:bold;"> Business Tycon </td>
                </tr>
                <tr>
                	<td>City </td>
                    <td> <input type="text" placeholder="Enter the city name" style="width:200px; height:20px" name="txt_city" required autocomplete="off"/> </td>
                </tr>
                <tr>
                	<td>Business Name </td>
                    <td> <input type="text" placeholder="Enter the business name" style="width:200px; height:20px" name="txt_business" required autocomplete="off" /> </td>
                </tr>
                <tr>
                	<td>Tycon Name </td>
                    <td> <input type="text" placeholder="Enter the tycon name" style="width:200px; height:20px" name="txt_tycon" required autocomplete="off" />
                    </td>
                </tr>
                <tr>
                	<td>DOB </td>
                    <td><input id="inputField" type="text" placeholder="Enter your date" style="width:200px; height:20px" name="txt_date"  required autocomplete="off" />
                    </td>
                </tr>
                <tr>
                	<td>Profile </td>
                    <td> <input type="text" placeholder="Enter your profile" style="width:200px; height:20px" name="txt_profile" required autocomplete="off"  />
                    </td>
                </tr>
                <tr>
                	<td>Photo </td>
                    <td><input type="file" name="photo" style="width:200px; height:20px;" /> </td>
                </tr>
                <tr>
                	<td><input type="submit" name="btn_submit" value="Submit" /> </td>
                </tr>
            </table>
            </form>
            <br />
             <div style="height:350px; overflow:scroll;">
            <form name="frm16" method="post">
            <table border="2" align="left">
            	<tr>
                	<td><input type="text" name="txt_search" /> </td>
                    <td><input type="submit" name="btn_search" value="Search" /> </td>
                </tr>
            </table>
            </form>
           
            <table border="2" align="center" width="100%">
            	<tr bgcolor="#FFFFFF">
                	<th>City </th>
                    <th>Business Name </th>
                    <th>Tycon Name </th>
                    <th>DOB </th>
                    <th>Profile </th>
                    <th>Photo </th>
                    <th>Delete </th>
                </tr>
                
             <?php
			 if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from business_tycon where city like '$search%'";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from business_tycon order by city asc";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='dsc')
				{
					$view="select * from business_tycon order by city desc";
					$view_exe=mysql_query($view);
				}
				else
				{
                	$view="select * from business_tycon";
					$view_exe=mysql_query($view);
				}
					while($result=mysql_fetch_array($view_exe))
					{
				?>
                	<tr>
                		<td><?php echo $result['city'];?> </td>
                    	<td><?php echo $result['business'];?> </td>
                   	 	<td><?php echo $result['tycon'];?> </td>
                    	<td><?php echo $result['dob'];?> </td>
                    	<td><?php echo $result['profile'];?> </td>
                    	<td> <img src="<?php echo 'business_tycon/'.$result['photo'];?>" height="50" width="50" alt="Not Found" /></td>
                    	<td> <a href="business_tycon.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete');">Delete</a>  </td>
                   
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
