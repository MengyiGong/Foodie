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
<script language="javascript">
function chk(theForm){
  if (theForm.Busi_Username.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
    alert("Username is required！");
    theForm.Busi_Username.focus();   
    return (false);   
  }  

  if (theForm.Busi_Name.value.replace(/(^\s*)|(\s*$)/g, "") == "")
  {
    alert("Business Name is required!");
    theForm.Busi_Name.focus();
    return (false);
  }

  if (theForm.Busi_Password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
    alert("Password is required！");
    theForm.Busi_Password.focus();   
    return (false);   
  } 
  
  if (theForm.Busi_Password.value != theForm.pass.value){
    alert("Please check that your passwords match and try again！");
    theForm.pass.focus();   
    return (false);   
  } 

  if (theForm.Busi_Email.value == "")
  {
    alert("Email address is required!");
    theForm.Busi_Email.focus();
    return (false);
  }

  if (theForm.Busi_Categories.value == "")
  {
    alert("Business Categories field is required!");
    theForm.Busi_Categories.focus();
    return (false);
  }

  if (theForm.Busi_City.value == "")
  {
    alert("Business City field is required!");
    theForm.Busi_City.focus();
    return (false);
  }

   if (theForm.Busi_Address.value == "")
  {
    alert("Business Address field is required!");
    theForm.Busi_Address.focus();
    return (false);
  }

  if (theForm.Busi_OpenTime.value == "")
  {
    alert("Business OpenTime field is required!");
    theForm.Busi_OpenTime.focus();
    return (false);
  }

}

function customer_chk(CustomerForm){
  if (CustomerForm.Customer_user.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
    alert("Username is required！");
    CustomerForm.Customer_user.focus();   
    return (false);   
  }  

  if (CustomerForm.Customer_password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
    alert("Password is required！");
    CustomerForm.Customer_password.focus();   
    return (false);   
  } 
  
  if (CustomerForm.Customer_password.value != CustomerForm.Customer_pass.value){
    alert("Please check that your passwords match and try again！");
    CustomerForm.pass.focus();   
    return (false);   
  } 

  if (CustomerForm.Customer_email.value == "")
  {
    alert("Email address is required!");
    CustomerForm.Customer_email.focus();
    return (false);
  }

}
</script>
    <?php
    if(isset($_POST["submit"])){
          if(empty($_POST['Busi_Username']))
            echo "<script>alert('Username is required');location='?tj=register';</script>";
          
          else if(empty($_POST['Busi_Password']))
            echo "<script>alert('Password is required');location='?tj=register';</script>";
          
          else if($_POST['Busi_Password']!=$_POST['pass'])
            echo "<script>alert('Please check that your passwords match and try again!');location='?tj=register';</script>";
          
          else if(!empty($_POST['Busi_Phone'])&&!is_numeric($_POST['Busi_Phone']))
            echo "<script>alert('Please enter a valid phone number');location='?tj=register';</script>";
          
          else if(!empty($_POST['Busi_Email'])&&!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Busi_Email']))
            echo "<script>alert('Please enter a valid email address!');location='?tj=register';</script>";
          
/*          else if(!empty($_POST['Busi_OpenTime'])&&!preg_match("/^[0-9]*$/",$_POST['Busi_OpenTime']))
            echo "<script>alert('Opentime must be valid');location='?tj=register';</script>";
          
          else if(!empty($_POST['Busi_ClosTime'])&&!preg_match("/^[0-9]*$/",$_POST['Busi_CloseTime']))
            echo "<script>alert('Close time must be valid');location='?tj=register';</script>";
*/          
          else
          {
            //check if user exists in business table
            $checkuser = strip_tags($_POST['Busi_Username']);
            $checkresult = mysql_query("SELECT * FROM business where Busi_Username = '$checkuser'");
            $check_rows = mysql_num_rows($checkresult);
            
            //check if user exists in Customer table
            $checkuser_1 = strip_tags($_POST['Busi_Username']);
            $checkresult_1 = mysql_query("SELECT * FROM Customer where Customer_user = '$checkuser_1'");
            $check_rows_1 = mysql_num_rows($checkresult_1);
            
            if ($check_rows || $check_rows_1)
            {
              echo "<script>alert('Username exists already!');location='?tj=register';</script>";
            }

            $_SESSION['member']=addslashes(strip_tags($_POST['Busi_Username']));
            //insert into business table
            if(!empty($_FILES['Busi_Picture']['tmp_name']))
            {
//             echo "nba";
              $file=$_FILES['Busi_Picture']['tmp_name'];
              $image= addslashes(file_get_contents($_FILES['Busi_Picture']['tmp_name']));
//              $image_name= addslashes($_FILES['Busi_Picture']['name']);
              $image_name=addslashes(strip_tags($_POST["Busi_Name"]));
      
              move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos/" . $image_name);
              move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos_customer/" . $image_name);
              
              $location="/F/photos/" . $_FILES["Busi_Picture"]["name"];
              $location_customer="/F/photos_customer/" . $_FILES["Busi_Picture"]["name"];
  //            $caption=$_POST['caption'];
//OpenHours thing
              $Busi_Name=addslashes(strip_tags($_POST["Busi_Name"]));
              $Busi_Username=addslashes(strip_tags($_POST["Busi_Username"]));
              $Busi_Password=md5(addslashes(strip_tags($_POST["Busi_Password"])));
              $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
              $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
              $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
              $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
              $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
              $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

              
              $sql="insert into business(Busi_Name, Busi_Username, Busi_Password, Busi_Phone, Busi_Email, Busi_Picture, Busi_Categories, Busi_City, Busi_Address, Busi_OpenTime) values('$Busi_Name','$Busi_Username','$Busi_Password','$Busi_Phone','$Busi_Email','$location','$Busi_Categories','$Busi_City','$Busi_Address','$Busi_OpenTime')";
              $result=mysql_query($sql)or die(mysql_error());
              
              //insert into Customer table
              $sql_1="insert into Customer(Customer_user, Customer_password, Customer_email, Customer_picture) values('$Busi_Username','$Busi_Password','$Busi_Email','$location_customer')";
              $result_1=mysql_query($sql_1)or die(mysql_error());

              if($result && $result_1)
                  echo "<script>alert('Congrats, you can now access to your account!');location='member.php';</script>";
              else
              {
                echo "<script>alert('Signup Failed');location='Busi_login.php';</script>";
                mysql_close();
              }
            }
            else
            {
              $Busi_Name=addslashes(strip_tags($_POST["Busi_Name"]));
              $Busi_Username=addslashes(strip_tags($_POST["Busi_Username"]));
              $Busi_Password=md5(addslashes(strip_tags($_POST["Busi_Password"])));
              $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
              $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
              $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
              $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
              $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
              $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

              $sql="insert into business(Busi_Name, Busi_Username, Busi_Password, Busi_Phone, Busi_Email, Busi_Categories, Busi_City, Busi_Address, Busi_OpenTime) values('$Busi_Name','$Busi_Username','$Busi_Password','$Busi_Phone','$Busi_Email','$Busi_Categories','$Busi_City','$Busi_Address','$Busi_OpenTime')";
              $result=mysql_query($sql)or die(mysql_error());
              
              //insert into Customer table
              $sql_1="insert into Customer(Customer_user, Customer_password, Customer_email) values('$Busi_Username','$Busi_Password','$Busi_Email')";
              $result_1=mysql_query($sql_1)or die(mysql_error());

              if($result && $result_1)
                  echo "<script>alert('Congrats, you can now access to your account!');location='member.php';</script>";
              else
              {
                echo "<script>alert('Signup Failed');location='Busi_login.php';</script>";
                mysql_close();
              }
            }
        }
    }
  if(isset($_POST["submit3"])){
      if(empty($_POST['Customer_user']))
        echo "<script>alert('Username is required');location='?tj=customer_register';</script>";
      
      else if(empty($_POST['Customer_password']))
        echo "<script>alert('Password is required');location='?tj=customer_register';</script>";
      
      else if($_POST['Customer_password']!=$_POST['Customer_pass'])
        echo "<script>alert('Please check that your passwords match and try again!');location='?tj=customer_register';</script>";
      
      else if(!empty($_POST['Customer_email'])&&!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Customer_email']))
        echo "<script>alert('Please enter a valid email address!');location='?tj=customer_register';</script>";
      
      else{
          $checkcustomer = $_POST['Customer_user'];
          $checkcustomerresult = mysql_query("SELECT * FROM Customer where Customer_user = '$checkcustomer'");
          $checkcustomer_rows = mysql_num_rows($checkcustomerresult);
          if ($checkcustomer_rows)
          {
            echo "<script>alert('Username exists already!');location='?tj=customer_register';</script>";
          }

          $_SESSION['customer']=addslashes(strip_tags($_POST["Customer_user"]));

          if(!empty($_FILES['Customer_picture']['tmp_name']))
          {
//             echo "nba";
              $file=$_FILES['Customer_picture']['tmp_name'];
              $image= addslashes(file_get_contents($_FILES['Customer_picture']['tmp_name']));
 //             $image_name= addslashes($_FILES['Customer_picture']['name']);
              $image_name=addslashes(strip_tags($_POST["Customer_user"]));
      
              move_uploaded_file($_FILES["Customer_picture"]["tmp_name"],"photos_customer/" . $_FILES["Customer_picture"]["name"]);
              
              $location="photos_customer/" . $_FILES["Customer_picture"]["name"];
              $Customer_user=addslashes(strip_tags($_POST["Customer_user"]));
              $Customer_password=md5(addslashes(strip_tags($_POST["Customer_password"])));
              $Customer_email=addslashes(strip_tags($_POST["Customer_email"]));
  //            $caption=$_POST['caption'];
               $sql_customer="insert into Customer(Customer_user, Customer_password, Customer_email,Customer_picture) values('$Customer_user','$Customer_password','$Customer_email','$location')";
                $result_customer=mysql_query($sql_customer)or die(mysql_error());
                if($result_customer)
                echo "<script>alert('Congrats, you can now access to your account!');location='Customer.php';</script>";
                else
                {
                  echo "<script>alert('Signup Failed');location='Busi_login.php?tj=customer_register';</script>";
                  mysql_close();
                }
          }
          else
          {
            $Customer_user=addslashes(strip_tags($_POST["Customer_user"]));
            $Customer_password=md5(addslashes(strip_tags($_POST["Customer_password"])));
            $Customer_email=addslashes(strip_tags($_POST["Customer_email"]));

            $sql_customer="insert into Customer(Customer_user, Customer_password, Customer_email) values('$Customer_user','$Customer_password','$Customer_email')";
            $result_customer=mysql_query($sql_customer)or die(mysql_error());
            if($result_customer)
            echo "<script>alert('Congrats, you can now access to your account!');location='Customer.php';</script>";
            else
            {
              echo "<script>alert('Signup Failed');location='Busi_login.php?tj=customer_register';</script>";
              mysql_close();
            }
          }
        }
      }
  ?>
</head>
<body>
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
        
	
<?php if(isset($_GET['tj'])&&($_GET['tj'] == 'register')){ ?>
<form id="theForm" name="theForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" align="center" bgcolor="#EBEBEB">Business Signup&nbsp;&nbsp;"*" is required</td>
    </tr>
    <tr>
      <td width="100" align="right" bgcolor="#FFFFFF">Business Name:</td>
      <td width="400" bgcolor="#FFFFFF"><input name="Busi_Name" type="text" id="Busi_Name" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(Type your business name here)
      </td>
    </tr>
    <tr>
      <td width="100" align="right" bgcolor="#FFFFFF">Username:</td>
      <td width="400" bgcolor="#FFFFFF"><input name="Busi_Username" type="text" id="Busi_Username" size="20" maxlength="20" />
    <font color="#FF0000"> *</font>(Letters or numbers)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Password:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_Password" type="password" id="Busi_Password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(Letters or numbers)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Re enter:</td>
      <td bgcolor="#FFFFFF"><input name="pass" type="password" id="pass" size="20" />
      <font color="#FF0000"> *</font>(Type your password again)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Contact Info:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_Phone" type="text" id="Busi_Phone" size="20"/>
        <font color="#FF0000"> *</font>(must be digits)
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Email:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_Email" type="text" id="Busi_Email" size="20"/>
        <font color="#FF0000"> *</font>(must be a valid email address)
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Coverpage:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_Picture" type="file" id="Busi_Picture" size="20"/></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Categories:</td>
      <td bgcolor="#FFFFFF">
        <select class="font" id="Busi_Categories" name="Busi_Categories">
          <option value="spanish" selected>Spanish</option>
          <option value="chinese">Chinese</option>
          <option value="japanese">Japanese</option>
          <option value="korean">Korean</option>
          <option value="thai">Thai</option>
          <option value="mexican">Mexican</option>
          <option value="italian">Italian</option>
          <option value="american">American</option>
          <option value="french">French</option>
          <option value="latinamerican">Latin American</option>
          <option value="cuban">Cuban</option>
        </select>
        <font color="#FF0000"> *</font>
      </td>
    </tr>
      <tr>
      <td align="right" bgcolor="#FFFFFF">City:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_City" type="text" id="Busi_City" size="20"/>
        <font color="#FF0000"> *</font>
      </td>
    </tr>
     <tr>
      <td align="right" bgcolor="#FFFFFF">Address:</td>
      <td bgcolor="#FFFFFF"><input name="Busi_Address" type="text" id="Busi_Address" size="20"/>
        <font color="#FF0000"> *</font>
      </td>
    </tr>
      <tr>
      <td align="right" bgcolor="#FFFFFF">Open Hours:</td>
      <td bgcolor="#FFFFFF">
       <input style="height: 50px;" name="Busi_OpenTime" type="text" id="Busi_OpenTime" size="30"/>
        <font color="#FF0000"> *</font>
      </td>

    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="reset" name="button" id="button" value="Reset" />
      <input type="submit" name="submit" id="submit" value="Create Account" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF">
          Already a member?&nbsp;<a href=Busi_login.php>&nbsp;Log in here</a>
      </td>
    </tr>
  </table>
</form>
<?php
} 
 if(isset($_GET['tj'])&&($_GET['tj'] == 'customer_register')){ ?>
<form id="CustomerForm" name="CustomerForm" method="post" action="" enctype="multipart/form-data" onSubmit="return customer_chk(this)" runat="server" style="margin-bottom:0px;">
  <table width="800" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" align="center" bgcolor="#EBEBEB">Customer Signup&nbsp;&nbsp;"*" is required</td>
    </tr>
    <tr>
      <td width="80" align="right" bgcolor="#FFFFFF">Username:</td>
      <td width="420" bgcolor="#FFFFFF"><input name="Customer_user" type="text" id="Customer_user" size="20" maxlength="20" />
    <font color="#FF0000"> *</font>(Letters or numbers)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Password:</td>
      <td bgcolor="#FFFFFF"><input name="Customer_password" type="password" id="Customer_password" size="20" maxlength="20" />
      <font color="#FF0000"> *</font>(Letters or numbers)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Re enter:</td>
      <td bgcolor="#FFFFFF"><input name="Customer_pass" type="password" id="Customer_pass" size="20" />
      <font color="#FF0000"> *</font>(Type your password again)</td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF">Email:</td>
      <td bgcolor="#FFFFFF"><input name="Customer_email" type="text" id="Customer_email" size="20"/>
        <font color="#FF0000"> *</font>(Please enter a valid email address)
      </td>
    </tr>
     <tr>
      <td align="right" bgcolor="#FFFFFF">Coverpage:</td>
      <td bgcolor="#FFFFFF"><input name="Customer_picture" type="file" id="Customer_picture" size="20"/></td>
    </tr
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF"><input type="reset" name="button" id="button" value="Reset" />
      <input type="submit" name="submit3" id="submit3" value="Create Account" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF">
          Already a member?&nbsp;<a href=Customer_login.php>&nbsp;Log in here</a>
      </td>
    </tr>
  </table>
</form>
<?php
} 
 else if(!isset($_GET['tj'])){
?>
<?php
if(!empty($_SESSION['member']))
{
  echo "<script>alert('Already Signed in, please log out first');location='member.php';</script>";
}
if(isset($_POST["submit2"])){
$name=$_POST['name'];
$pw=md5($_POST['password']);
$sql="select * from business where Busi_Username='".$name."'"; 
$result=mysql_query($sql) or die("Username not exists.");
$num=mysql_num_rows($result);
if($num==0){
  echo "<script>alert('User not exists, please try again.');location='Busi_login.php';</script>";
  }
  while($rs=mysql_fetch_object($result))
  {
    if($rs->Busi_Password!=$pw)
    {
      echo "<script>alert('There was an error with your Username/Password combination. Please try again.');location='Busi_login.php';</script>";
      mysql_close();
    }
    else 
      {
        $_SESSION['member']=addslashes(strip_tags($_POST['name']));
          if($_SESSION['member']== "admin")
          {
            header("Location:admin_index.php");
            mysql_close();
          }
          else
          {
            echo "<script>alert('Successfully Logged in! You can now access to your account!');location='member.php';</script>";
//         header("Location:member.php");
            mysql_close();
          }
      }
    }
}
?>
<form action="" method="post" name="regform" onSubmit="return Checklogin();" style="margin-bottom:0px;">
<table width="800" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
  <tr>
    <td colspan="2" align="center" bgcolor="#EBEBEB" class="font">Business Login</td>
  </tr>
    <tr>
      <td width="100" align="center" bgcolor="#FFFFFF" class="font">Username:</td>
      <td width="300" bgcolor="#FFFFFF" class="font"><input name="name" type="text" id="name"></td>
    </tr>
    <tr>
      <td align="center" valign="top" bgcolor="#FFFFFF" class="font">Password:</td>
      <td bgcolor="#FFFFFF" class="font"><input name="password" type="password" id="name">        </td>
    </tr>
    <tr>
    <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF" class="font">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit2" type="submit" value="Log In"/>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <a href='Customer_login.php'>Customer login here</a></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
      <a href='Busi_login.php?tj=register'>&nbspNew Business? Signup Here...</a></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF" class="font">
      <a href='Busi_login.php?tj=customer_register'>&nbspNew Customer? Signup Here...</a></td>
  </tr>
</table>
</form>
<?php } ?>
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