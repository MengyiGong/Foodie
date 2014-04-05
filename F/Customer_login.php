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
<link rel="stylesheet" type="text/css" href="/F/css_common.css" />

<body>
  <?php
    if(isset($_POST["submit_customer"]))
    {
      $Customer_name=$_POST['name'];
      $pw=md5($_POST['password']);
      $sql="select * from Customer where Customer_user='".$Customer_name."'"; 
      $result=mysql_query($sql) or die("Username not exists.");
      $num=mysql_num_rows($result);
      
      if($num==0)
      {
        echo "<script>alert('User not exists, please try again.');location='Customer_login.php';</script>";
      }
      
      while($rs=mysql_fetch_object($result))
      {
        if($rs->Customer_password!=$pw)
        {
          echo "<script>alert('There was an error with your Username/Password combination. Please try again.');location='Customer_login.php';</script>";
          mysql_close();
        }
        else 
        {
          $_SESSION['customer']=$_POST['name'];
		  if($_SESSION['customer']== "admin")
          {
            header("Location:admin_index.php");
            mysql_close();
          }
		  else
          {
            echo "<script>alert('Successfully Logged in! You can now access to your account!');location='/F/index.php';</script>";
 //          header("Location:Customer.php");
            mysql_close();
          }
        }
        }
    }
  ?>
  <style type="text/css">@import url("/F/css_index.css");</style>
  <div id="header">
      <div class="mainmenu">
          <div class="logo">
              <a href="#"><img src="/F/img/1.jpg" alt="Foodie" title="Foodie"></a>
          </div>
          <div class="charmenu">
              <div id="login_0">
                  <span class="arrow-ico">
  					<?php
				
  					  if(!isset($_SESSION['customer'])){
  						  echo "<a href=\"/F/Customer_login.php\">Login</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"/F/Busi_login.php?tj=customer_register\">Register</a>";
  					  }
  					  else{
  					  	  echo "Welcome </span>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"/F/Customer.php\">".$_SESSION['customer']."</a>";
  					  }
  					  ?>
					
              </div>
         
          </div>
          <div class="clear"></div>
      </div>
  
    
    
  		<nav> 
  		<ul class="tabmenu">
  		<li><a href="/F/index.php" >Home</a></li> 
  		<li><a href="/F/news.php" >News</a></li> 
  		<li><a href="/F/indexMap.php" >Map</a></li> 
  		<li><a href="coupon.php" >Coupon</a></li> 
  		<li><a href="/F/FF/category.php" >Find your favourite</a></li> 
  		<ul> 
  		</nav> 
        
    <form action="" method="post" name="submit_customer" onSubmit="return Checklogin();" style="margin-bottom:0px;">
      <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
        <tr>
          <td colspan="2" align="center" bgcolor="#EBEBEB" class="font">Customer Login</td>
        </tr>
        
        <tr>
          <td width="65" align="center" bgcolor="#FFFFFF" class="font">Username:</td>
          <td width="262" bgcolor="#FFFFFF" class="font"><input name="name" type="text" id="name"></td>
        </tr>
        
        <tr>
          <td align="center" valign="top" bgcolor="#FFFFFF" class="font">Password:</td>
          <td bgcolor="#FFFFFF" class="font"><input name="password" type="password" id="name">        </td>
        </tr>
        
        <tr>
          <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF" class="font">&nbsp;&nbsp;&nbsp;&nbsp;
          	<input name="submit_customer" type="submit" value="Log In"/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href='Busi_login.php'>Business login here</a>
            <!-- <a href='admin_login.php'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Admin login here</a> -->
          </td>
        </tr>
        
        <tr>
          <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
            <a href='Busi_login.php?tj=register'>&nbsp;New Business? Signup Here...</a></td>
        </tr>
        
        <tr>
          <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
            <a href='Busi_login.php?tj=customer_register'>&nbsp;New Customer? Signup Here...</a></td>
        </tr>
      </table>
    </form>
    <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="5"></td>
      </tr>
    </table>

	<div id="footer">
    
   
	    <div>
	         Powered by <span>Foodie</span>
			<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
	    </div>
  
	</div>
  </body>
</html>