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
if(isset($_GET['did']))
	{
		$del="delete from post_resume where id='".$_GET['did']."'";
		$exe_del=mysql_query($del);
		if($exe_del)
		{
			?>
            <script>
				window.onload=function()
				{
					alert("Delete Successfully..!");
					window.location="view_resume.php";
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
<title> View_Resume </title>
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
			<div style="height:200px; overflow:scroll;">
            <h2>View Resume Detail</h2>
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
                	<th>Job_t</th>
                    <th>Name </th>
                    <th>Address </th>
                    <th>Mobile</th>
                    <th>Email </th>
                    <th>Qualification </th>
                    <th>Functional_A </th>
                    <th>Expr </th>
                    <th>Salary </th>
                    <th>Skill</th>
                    <th>CV </th>
                    <th>Delete </th>
                </tr>
                <?php
				if(isset($_POST['btn_search']))
				{
					$search=trim($_POST['txt_search']);
					$view="select * from post_resume where Job_t like '$search%'";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='asc')
				{
					$view="select * from post_resume order by Job_t asc";
					$view_exe=mysql_query($view);
				}
				else if($_GET['ord']=='dsc')
				{
					$view="select * from post_resume order by Job_t desc";
					$view_exe=mysql_query($view);
				}
				else
				{
					$view="select * from post_resume";
					$view_exe=mysql_query($view);
				}
					while($result=mysql_fetch_array($view_exe))
					{
				?>
                <tr>
                	<td> <?php echo $result['Job_t'];?> </td>
                    <td> <?php echo $result['Name'];?> </td>
                    <td> <?php echo $result['Address'];?> </td>
                    <td> <?php echo $result['Mobile'];?> </td>
                    <td> <?php echo $result['Email'];?> </td>
                    <td> <?php echo $result['Qualification'];?> </td>
                    <td> <?php echo $result['Functional_A'];?> </td>
                    <td> <?php echo $result['Expr'];?> </td>
                    <td> <?php echo $result['Salary'];?> </td>
                    <td> <?php echo $result['Skill'];?> </td>
                    <td><a href="download.php?filename=<?php echo $result['CV'];?>"> <?php echo $result['CV'];?></a></td>
                    <td> <a href="view_resume.php?did=<?php echo $result['id'];?>" onClick="return confirm('Are U Sure To Delete..?');">delete</a> </td>
                   
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
