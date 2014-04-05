<?php
if (!isset ($_SESSION)) {
  ob_start();
  session_start();
  }
require_once ('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Signup/Login Page</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<body>



<?php
if(isset($_POST["submit_admin"]))
  {
    $Busi_Username=$_POST['name'];
    $pw=md5($_POST['password']);
    $sql="select * from business where Busi_Username='".$Busi_Username."'"; 
    $result=mysql_query($sql) or die("Username not exists.");
    $num=mysql_num_rows($result);
    if($num==0){
      echo "<script>alert('User not exists, please try again.');location='admin_login.php';</script>";
      }
    while($rs=mysql_fetch_object($result))
    {
      if($rs->Busi_Password!=$pw)
      {
        echo "<script>alert('There was an error with your Username/Password combination. Please try again.');location='admin_login.php';</script>";
        mysql_close();
      }
      else 
        {
          $_SESSION['admin']=$_POST['name'];

          if($_SESSION['admin'] == "admin")
          {
            echo "<script>alert('Successfully logged in as admin user.');location='admin_index.php';</script>";
            mysql_close();
          }
          else
          {
            echo "<script>alert('Not a valid admin user or username not exists.');location='admin_login.php';</script>";
            mysql_close();
          }
        }
      }
  }
?>

<form action="" method="post" name="submit_admin" onSubmit="return Checklogin();" style="margin-bottom:0px;">
<table width="300" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="2" align="center" bgcolor="#EBEBEB" class="font">Admin Login</td>
  </tr>
    <tr>
      <td width="100" align="center" bgcolor="#FFFFFF" class="font">Username:</td>
      <td width="200" bgcolor="#FFFFFF" class="font"><input name="name" type="text" id="name"></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF" class="font">Password:</td>
      <td bgcolor="#FFFFFF" class="font"><input name="password" type="password" id="name">        </td>
    </tr>
    <tr>
      <td width="300" Colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">&nbsp&nbsp&nbsp&nbsp
    	     <input name="submit_admin" type="submit" style="width:60px;height:30px" value="Log In"/>
      </td>
    </tr>
    <tr>
      <td width="300" Colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
          <a href='Customer_login.php'>&nbsp;Back to customer login</a>
      </td>
    </tr>
    <tr>
      <td width="300" Colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
          <a href='Busi_login.php'>&nbsp;Back to business login</a>
      </td>
    </tr>
</table>
</form>
<table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="5"></td>
  </tr>
</table>

<table width="350" height="20" border="0" align="center" cellpadding="5" cellspacing="1">
  <tr>
    <td align="left" bgcolor="#FFFFFF">&nbsp;Copyright @2013 <a href="#" target="_blank">Foodie</a> All Rights Reserved. Build V.01</td>
  </tr>
</table>
</body>
</html>