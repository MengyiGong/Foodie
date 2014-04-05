<?php 
if (!isset ($_SESSION)) 
{
  ob_start();
  session_start();
}
require_once ('config.php'); 
//Check Login
if(empty($_SESSION['member']))
{
  echo "<script>alert('Please log in first');location='Busi_login.php';</script>";
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
              if (modifyForm.Busi_Password.value.replace(/(^\s*)|(\s*$)/g, "") == "")
              {
                alert("New Password is required!");
                modifyForm.Busi_Password.focus();   
                return (false);   
              } 
              
              if (modifyForm.Busi_Password.value != modifyForm.Pass.value)
              {
                alert("Please check that your passwords match and try again!");
                modifyForm.Pass.focus();   
                return (false);   
              }
            } 

            if (modifyForm.Busi_Phone.value == "")
            {
              alert("Contact information is required!");
              modifyForm.Busi_Phone.focus();
              return (false);
            }


            if (modifyForm.Busi_Email.value == "")
            {
              alert("Email address is required!");
              modifyForm.Busi_Email.focus();
              return (false);
            }

            if (modifyForm.Busi_Categories.value == "")
            {
              alert("Business Categories field is required!");
              modifyForm.Busi_Categories.focus();
              return (false);
            }

            if (modifyForm.Busi_City.value == "")
            {
              alert("Business City field is required!");
              modifyForm.Busi_City.focus();
              return (false);
            }

            if (modifyForm.Busi_Address.value == "")
            {
              alert("Business Address field is required!");
              modifyForm.Busi_Address.focus();
              return (false);
            }

            if (modifyForm.Busi_OpenTime.value == "")
            {
              alert("Business OpenTime field is required!");
              modifyForm.Busi_OpenTime.focus();
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
          //log out
          if(isset($_GET["tj"])&&($_GET["tj"]=="destroy"))
          {
          session_destroy();
          echo "<script>alert('Successfully logged out!');location='Busi_login.php';</script>";
          }
        ?>

        <?php
        //User information Modify
          if(isset($_GET["tj"])&&($_GET["tj"]=="modify")) 
          {
          //User Display
      $sql_1="select * from business where Busi_Username='".$_SESSION['member']."'";
            $result_1=mysql_query($sql_1) or die("Username not exists.");
            
      if(isset($_POST["submit"]))
      {
        while($rs=mysql_fetch_object($result_1))
        {
          if($_POST["Current_Password"])
          {
            $Current=md5($_POST['Current_Password']);

                    if(empty($_POST['Busi_Password']))
                      echo "<script>alert('Password is required');location='?tj=modify';</script>";
                    
                    else if($_POST['Busi_Password']!=$_POST['Pass'])
                      echo "<script>alert('Password combination not valid!');location='?tj=modify';</script>";

                    else if($rs->Busi_Password!=$Current)
                    {
                      echo "<script>alert('Current Password not correct!');location='?tj=modify';</script>";
  //                    mysql_close();
                    }
            else if(!empty($_POST['Busi_Phone'])&&!is_numeric($_POST['Busi_Phone']))
              echo "<script>alert('Please enter a valid phone number');location='?tj=modify';</script>";
                
            else if(!empty($_POST['Busi_Email'])&&!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Busi_Email']))
              echo "<script>alert('Please enter a valid email address!');location='?tj=modify';</script>";
            else
            {
              if(!empty($_FILES['Busi_Picture']['tmp_name']))
              {
 //             echo "nba";
                $file=$_FILES['Busi_Picture']['tmp_name'];
                $image= addslashes(file_get_contents($_FILES['Busi_Picture']['tmp_name']));
                $image_name= addslashes($_FILES['Busi_Picture']['name']);
        
                move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos/" . $_FILES["Busi_Picture"]["name"]);
                move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos_customer/" . $_FILES["Busi_Picture"]["name"]);
                
                $location="photos/" . $_FILES["Busi_Picture"]["name"];
                $location_customer="photos_customer/" . $_FILES["Busi_Picture"]["name"];

                $Busi_Password=md5(addslashes(strip_tags($_POST['Busi_Password'])));
                $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
                $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
                $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
                $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
                $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
                $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

                mysql_query($sql="update business set Busi_Password='$Busi_Password',Busi_Phone='$Busi_Phone',Busi_Email='$Busi_Email',Busi_Picture='$location',Busi_Categories='$Busi_Categories',Busi_City='$Busi_City',Busi_Address='$Busi_Address',Busi_OpenTime='$Busi_OpenTime' where Busi_Username='".$_SESSION['member']."'");
                mysql_query($sql="update Customer set Customer_password='$Busi_Password',Customer_email='$Busi_Email',Customer_picture='$location_customer' where Customer_user='".$_SESSION['member']."'");
                echo "<script>alert('Successfully Modified');location='member.php';</script>";
              }
              else
              {
                $Busi_Password=md5(addslashes(strip_tags($_POST['Busi_Password'])));
                $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
                $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
                $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
                $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
                $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
                $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

                mysql_query($sql="update business set Busi_Password='$Busi_Password',Busi_Phone='$Busi_Phone',Busi_Email='$Busi_Email',Busi_Categories='$Busi_Categories',Busi_City='$Busi_City',Busi_Address='$Busi_Address',Busi_OpenTime='$Busi_OpenTime' where Busi_Username='".$_SESSION['member']."'");
                mysql_query($sql="update Customer set Customer_password='$Busi_Password',Customer_email='$Busi_Email' where Customer_user='".$_SESSION['member']."'");
                echo "<script>alert('Successfully Modified');location='member.php';</script>";
              }
            }
          }
          else
          {
            if(!empty($_POST['Busi_Phone'])&&!is_numeric($_POST['Busi_Phone']))
              echo "<script>alert('Please enter a valid phone number');location='?tj=modify';</script>";
                
            else if(!empty($_POST['Busi_Email'])&&!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Busi_Email']))
              echo "<script>alert('Please enter a valid email address!');location='?tj=modify';</script>";
            else
            {
              if(!empty($_FILES['Busi_Picture']['tmp_name']))
              {
 //             echo "nba";
                $file=$_FILES['Busi_Picture']['tmp_name'];
                $image= addslashes(file_get_contents($_FILES['Busi_Picture']['tmp_name']));
                $image_name= addslashes($_FILES['Busi_Picture']['name']);
        
                move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos/" . $_FILES["Busi_Picture"]["name"]);
                 move_uploaded_file($_FILES["Busi_Picture"]["tmp_name"],"photos_customer/" . $_FILES["Busi_Picture"]["name"]);

                $location="photos/" . $_FILES["Busi_Picture"]["name"];
                $location_customer="photos_customer/" . $_FILES["Busi_Picture"]["name"];

                $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
                $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
                $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
                $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
                $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
                $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

                mysql_query($sql="update business set Busi_Phone='$Busi_Phone',Busi_Email='$Busi_Email',Busi_Picture='$location',Busi_Categories='$Busi_Categories',Busi_City='$Busi_City',Busi_Address='$Busi_Address',Busi_OpenTime='$Busi_OpenTime' where Busi_Username='".$_SESSION['member']."'");
                mysql_query($sql="update Customer set Customer_email='$Busi_Email',Customer_picture='$location_customer' where Customer_user='".$_SESSION['member']."'");
                echo "<script>alert('Successfully Modified');location='member.php';</script>";
              }
              else
              {
                $Busi_Phone=addslashes(strip_tags($_POST["Busi_Phone"]));
                $Busi_Email=addslashes(strip_tags($_POST["Busi_Email"]));
                $Busi_Categories=addslashes(strip_tags($_POST["Busi_Categories"]));
                $Busi_City=addslashes(strip_tags($_POST["Busi_City"]));
                $Busi_Address=addslashes(strip_tags($_POST["Busi_Address"]));
                $Busi_OpenTime=addslashes($_POST["Busi_OpenTime"]);

                mysql_query($sql="update business set Busi_Phone='$Busi_Phone',Busi_Email='$Busi_Email',Busi_Categories='$Busi_Categories',Busi_City='$Busi_City',Busi_Address='$Busi_Address',Busi_OpenTime='$Busi_OpenTime' where Busi_Username='".$_SESSION['member']."'");
                mysql_query($sql="update Customer set Customer_email='$Busi_Email' where Customer_user='".$_SESSION['member']."'");
                echo "<script>alert('Successfully Modified');location='member.php';</script>";
              }
            }
          } 
        }
      }       
        ?>

          <?php
          //User Display
            $sql="select * from business where Busi_Username='".$_SESSION['member']."'";
            $rs=mysql_fetch_array(mysql_query($sql));
          ?>  

          <table width="350" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
            <tr>
              <td align="center" bgcolor="#EBEBEB">Edit Profile&nbsp;&nbsp;<a href="member.php"> Back to Main Page</a></td>
            </tr>
          </table>
          
          <form id="modifyForm" name="modifyForm" method="post" action="" enctype="multipart/form-data" onSubmit="return chk_modify(this)" style="margin-top:3px; margin-bottom:3px;">
            <table width="500" height="212" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
              <tr>
                <td width="100" height="36" align="center" bgcolor="#FFFFFF">Business Name:</td>
                <td width="300" align="left" bgcolor="#FFFFFF"><? echo $rs['Busi_Name'];?></td>
              </tr>
              
              <tr>
                <td width="100" height="36" align="center" bgcolor="#FFFFFF">Username:</td>
                <td width="300" align="left" bgcolor="#FFFFFF"><? echo $rs['Busi_Username'];?></td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Current Password:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Current_Password" type="password" id="Current_Password" maxlength="20"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">New Password:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Busi_Password" type="password" id="Busi_Password" maxlength="20"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Re Enter:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Pass" type="password" id="Pass" maxlength="20"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Contact Info</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Busi_Phone" type="text" id="Busi_Phone" value="<? echo $rs['Busi_Phone'];?>" maxlength="20"/></td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Email:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Busi_Email" type="text" id="Busi_Email" value="<? echo $rs['Busi_Email'];?>" maxlength="30"/></td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Coverpage:</td>
                <td align="left" bgcolor="#FFFFFF">
                  Change:<input name="Busi_Picture" type="file" id="Busi_Picture" value=<?php echo '<p><img src="'.$rs['Busi_Picture'].'" border="0" width="0" height="0" onload="AutoResizeImage(250,250,this)"  alt="150 X 150"></p>';?>
                </td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Categories:</td>
                <td align="left" bgcolor="#FFFFFF">
                  <select class="font" id="Busi_Categories" name="Busi_Categories">
                    <option value="<? echo $rs['Busi_Categories'];?>" selected>---SELECT---</option>
                    <option value="spanish">Spanish</option>
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
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">City:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Busi_City" type="text" id="Busi_City" value="<? echo $rs['Busi_City'];?>" maxlength="30"/></td>
              </tr>

              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Address:</td>
                <td align="left" bgcolor="#FFFFFF"><input name="Busi_Address" type="text" id="Busi_Address" value="<? echo $rs['Busi_Address'];?>" maxlength="30"/></td>
              </tr>
              
              <tr>
                <td height="36" align="center" bgcolor="#FFFFFF">Open Hours:</td>
                <td align="left" bgcolor="#FFFFFF">
                  <input name="Busi_OpenTime" style="height:30px;" type="text" id="Busi_OpenTime" value="<? echo $rs['Busi_OpenTime'];?>" maxlength="30" size="30"/>
                </td>
              </tr>
              
              <tr>
                <td height="27" colspan="2" align="center" bgcolor="#FFFFFF">
                   <input type="button" name="button" id="button" value="Back" onclick="location.href='member.php'" />
                  <input type="reset" name="button" id="button" value="Undo" />
                  <input type="submit" name="submit" id="submit" value="Save Changes" /></td>
              </tr>
            </table>
          </form>
      
        <?php 
            } 
        ?>
      
      <?php
      if($_SESSION['member'])                 
      {
      ?>
        <table width="350" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
          <tr>
            <td width="327" align="center" bgcolor="#EBEBEB" class="font"><a href='?tj=destroy'>Log out</a>
              &nbsp;&nbsp;<?php echo "<a href='?tj=modify'>Edit Profile</a>";?>
              &nbsp;&nbsp;<?php echo "<a href='/F/index.php'>Home</a>";?>  
              <?php if($_SESSION['member']=="admin"){?>
            <a href="admin_index.php">Control Panel</a><?php }?></td>
          </tr>
        </table>
      
        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="3"></td>
          </tr>
        </table>
      
        <?php
        $result=mysql_query("select * from business where Busi_Username='".$_SESSION['member']."'"); 
        while($rs=mysql_fetch_array($result)){
        ?>
        <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
          <tr>
            <td bgcolor="#FFFFFF">Business Name:</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Name']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Username:</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Username']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Contact Info</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Phone']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Email</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Email']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">CoverPage</td>
            <td bgcolor="#FFFFFF">
              <?php echo '<p><img src="'.$rs['Busi_Picture'].'" border="0" width="0" height="0" onload="AutoResizeImage(250,250,this)"  alt="200 X 300"></p>';?>
            </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Categories</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Categories']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">City</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_City']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Address</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Address']); ?></td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Open Hours</td>
            <td bgcolor="#FFFFFF">
              <?php echo htmlspecialchars($rs['Busi_OpenTime']); ?>
            </td>
          </tr>
          <tr>
            <td bgcolor="#FFFFFF">Status</td>
            <td bgcolor="#FFFFFF"><?php echo htmlspecialchars($rs['Busi_Status']); ?></td>
          </tr>
        </table>

        <table width="100" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="3"></td>
          </tr>
        </table>
      
        <?php 
            } 
          }
        ?>
      
      <table width="350" height="20" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr>
          <td align="left" bgcolor="#FFFFFF">&nbsp;Copyright @2013 <a href="#" target="_self">Foodie</a> All Rights Reserved. Build V.01</td>
        </tr>
      </table>
  </body>
</html>