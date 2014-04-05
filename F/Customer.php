<?php 
if (!isset ($_SESSION)) {
  ob_start();
  session_start();
  }
require_once ('config.php'); 
//check user login
if(empty($_SESSION['customer'])){
	echo "<script>alert('Please log in first');location='Customer_login.php';</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Main Page</title>
<link href="style.css" rel="stylesheet" type="text/css" />
  <script language="javascript">
          function chk_modify(modifyForm)
          {
            if (modifyForm.Current_Password.value.replace(/(^\s*)|(\s*$)/g, ""))
            {
              if (modifyForm.Customer_password.value.replace(/(^\s*)|(\s*$)/g, "") == "")
              {
                alert("New Password is requiredï¼");
                modifyForm.Customer_password.focus();   
                return (false);   
              } 
              
              if (modifyForm.Customer_password.value != modifyForm.Pass.value)
              {
                alert("Please check that your passwords match and try againï¼");
                modifyForm.Pass.focus();   
                return (false);   
              }
            } 

            if (modifyForm.Customer_email.value == "")
            {
              alert("Email address is required!");
              modifyForm.Customer_email.focus();
              return (false);
            }
          }
          function AutoResizeImage(maxWidth, maxHeight, objImg) {
            var img = new Image();
            img.src = objImg.src;
            var hRatio;
            var wRatio;
            var Ratio = 1;
            var w = img.width;
            var h = img.height;
            wRatio = maxWidth / w;
            hRatio = maxHeight / h;

            if (maxWidth == 0 && maxHeight == 0) {
                Ratio = 1;
            } 
            else if (maxWidth == 0) { //
                if (hRatio < 1)
                    Ratio = hRatio;
            } 
            else if (maxHeight == 0) {
                if (wRatio < 1)
                    Ratio = wRatio;
            } 
            else if (wRatio < 1 || hRatio < 1) {
                Ratio = (wRatio <= hRatio ? wRatio : hRatio);
            }
            if (Ratio < 1) {
                w = w * Ratio;
                h = h * Ratio;
            }
            objImg.height = h;
            objImg.width = w;
        }
      </script>
</head>
<body>
<?php
//Log out
if(isset($_GET["tj"])&&($_GET["tj"]=="destroy")){
session_destroy();
echo "<script>alert('Successfully logged out!');location='Customer_login.php';</script>";}
?>

        <?php
        //User information Modify
          if(isset($_GET["tj"])&&($_GET["tj"]=="modify")) 
          {

          //User Display
            $sql_1="select * from Customer where Customer_user='".$_SESSION['customer']."'";
            $result_1=mysql_query($sql_1) or die("Username not exists.");
            if(isset($_POST['Current_Password']))
			       {
				      $Current=md5($_POST['Current_Password']);
			       }

            if(isset($_POST["submit"]))
            {
              while($rs=mysql_fetch_object($result_1))
              {
                if($_POST['Current_Password'])
                {
                  if(empty($_POST['Customer_password']))
                    echo "<script>alert('Password is required');location='?tj=modify';</script>";
                  
                  else if($_POST['Customer_password']!=$_POST['Pass'])
                    echo "<script>alert('Password combination not valid!');location='?tj=modify';</script>";

                  else if($rs->Customer_password!=$Current)
                  {
                    echo "<script>alert('Current Password not correct!');location='?tj=modify';</script>";
 //                   mysql_close();
                  }
          				  else if(!empty($_POST['Customer_email'])&&(!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Customer_email'])))
          				  echo "<script>alert('Please enter a valid email address!');location='?tj=modify';</script>";
          				  else
          				  {
                      $Customer_password=md5(addslashes(strip_tags($_POST["Customer_password"])));
                      $Customer_email=addslashes(strip_tags($_POST["Customer_email"]));

            					mysql_query($sql="update Customer set Customer_password='$Customer_password',Customer_email='$Customer_email' where Customer_user='".$_SESSION['customer']."'");
            					mysql_query($sql="update business set Busi_Password='$Customer_password',Busi_Email='Customer_email' where Busi_Username='".$_SESSION['customer']."'");
            					echo "<script>alert('Successfully Modified');location='Customer.php?tj=modify';</script>";
          				  }
          				}
          				else
          				{
          					if(!empty($_POST['Customer_email'])&&(!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Customer_email'])))
          					   echo "<script>alert('Please enter a valid email address!');location='?tj=modify';</script>";
          				  else
        				    {
                      if(!empty($_FILES['Customer_picture']['tmp_name']))
                      {
            //             echo "nba";
                          $file=$_FILES['Customer_picture']['tmp_name'];
                          $image= addslashes(file_get_contents($_FILES['Customer_picture']['tmp_name']));
                          $image_name= addslashes($_FILES['Customer_picture']['name']);
                  
                          move_uploaded_file($_FILES["Customer_picture"]["tmp_name"],"photos_customer/" . $_FILES["Customer_picture"]["name"]);
                          move_uploaded_file($_FILES["Customer_picture"]["tmp_name"],"photos/" . $_FILES["Customer_picture"]["name"]);
                          
                          $location="photos_customer/" . $_FILES["Customer_picture"]["name"];
                          $location_business="photos/" . $_FILES["Customer_picture"]["name"];

                          mysql_query($sql="update Customer set Customer_email='".$_POST['Customer_email']."',Customer_picture='$location' where Customer_user='".$_SESSION['customer']."'");
                          mysql_query($sql="update business set Busi_Email='".$_POST['Customer_email']."',Busi_Picture='$location_business' where Busi_Username='".$_SESSION['customer']."'");
                          echo "<script>alert('Successfully Modified');location='Customer.php';</script>";
                      }
                      else
                      {
              					  mysql_query($sql="update Customer set Customer_email='".$_POST['Customer_email']."' where Customer_user='".$_SESSION['customer']."'");
              					  mysql_query($sql="update business set Busi_Email='".$_POST['Customer_email']."' where Busi_Username='".$_SESSION['customer']."'");
              					  echo "<script>alert('Successfully Modified');location='Customer.php';</script>";
        				      } 
                    }
                  }
              } 
            } 
        ?>

          <?php
          //User Display
            $sql="select * from Customer where Customer_user='".$_SESSION['customer']."'";
            $rs=mysql_fetch_array(mysql_query($sql));
          ?>  

          <table width="350" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
            <tr>
              <td align="center" bgcolor="#EBEBEB">Edit Profile&nbsp;&nbsp;<a href="Customer.php"> Back to Main Page</a></td>
            </tr>
          </table>
          
          <form id="modifyForm" name="modifyForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk_modify(this)" style="margin-top:3px; margin-bottom:3px;">
            <table width="500" height="212" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">              
              <tr>
                <td width="100" height="36" align="center" bgcolor="#FFFFFF">Username:</td>
                <td width="300" align="left" bgcolor="#FFFFFF"><? echo $rs['Customer_user'];?></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Email:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Customer_email" type="text" id="Customer_email" maxlength="32" value="<? echo $rs['Customer_email'];?>"/></td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Current Password:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Current_Password" type="password" id="Current_Password" maxlength="20"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">New Password:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Customer_password" type="password" id="Customer_password" maxlength="20"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Re Enter:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Pass" type="password" id="Pass" maxlength="20"/></td>
              </tr>
              
               <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Coverpage:</td>
                <td align="left" bgcolor="#FFFFFF">
                  Change:<input name="Customer_picture" type="file" id="Customer_picture" value=<?php echo '<p><img src="'.$rs['Customer_picture'].'" border="0" width="0" height="0" onload="AutoResizeImage(250,250,this)"  alt="150 X 150"></p>';?>
                </td>
              </tr>

              <tr>
                <td height="27" colspan="2" align="center" bgcolor="#FFFFFF"><input type="reset" name="button" id="button" value="Reset" />
                  <input type="submit" name="submit" id="submit" value="Save Changes" /></td>
              </tr>
            </table>
          </form>
      
        <?php 
            } 
        ?>


<?php
if($_SESSION['customer'])                 
{?>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td width="327" align="center" bgcolor="#EBEBEB" class="font"><a href='?tj=destroy'>Log out</a>
      &nbsp;&nbsp;<?php echo "<a href='?tj=modify'>Edit Profile</a>";?>
      &nbsp;&nbsp;<?php echo "<a href='/F/index.php'>Back</a>";?>
		<?php if($_SESSION['customer']=="admin"){?>
            <a href="admin_index.php">Control Panel</a><?php }?>  
    </td>
  </tr>
</table>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="3"></td>
  </tr>
</table>
<?php
$result=mysql_query("select * from Customer where Customer_user='".$_SESSION['customer']."'"); 
while($rs=mysql_fetch_array($result)){
?>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td bgcolor="#FFFFFF">User name:</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Customer_user']); ?></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">Email Address</td>
    <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Customer_email']); ?></td>
  </tr>
  <tr>
            <td bgcolor="#FFFFFF">CoverPage</td>
            <td bgcolor="#FFFFFF">
              <?php echo '<p><img src="'.$rs['Customer_picture'].'" border="0" width="0" height="0" onload="AutoResizeImage(250,250,this)"  alt="200 X 300"></p>';?>
            </td>
          </tr>
</table>

<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="3"></td>
  </tr>
</table>
<?php } 
}
?>
<table width="350" height="20" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td align="left" bgcolor="#FFFFFF">&nbsp;Copyright @2013 <a href="#" target="_blank">Foodie</a> All Rights Reserved. Build V.01</td>
  </tr>
</table>
</body>
</html>
