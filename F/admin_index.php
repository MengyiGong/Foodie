<?php
if (!isset ($_SESSION)) {
  ob_start();
  session_start();
  }
require_once ('config.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta content="text/html; charset=utf-8" />
    <title>Admin Control Page</title>
    <link href="style.css" rel="stylesheet" type="text/css" />

    <script language="javascript">
          function check_modify(EditForm){
 /*           if (EditForm.Busi_Password.value.replace(/(^\s*)|(\s*$)/g, "") == ""){
              alert("Password is required！");
              EditForm.Busi_Password.focus();   
              return (false);   
            } 
            
            if (EditForm.Busi_Password.value != EditForm.pass.value){
              alert("Please check that your passwords match and try again！");
              EditForm.pass.focus();   
              return (false);   
            } 
*/
            if (EditForm.Busi_Phone.value == "")
            {
              alert("Contact information is required!");
              EditForm.Busi_Phone.focus();
              return (false);
            }


            if (EditForm.Busi_Email.value == "")
            {
              alert("Email address is required!");
              EditForm.Busi_Email.focus();
              return (false);
            }

            if (EditForm.Busi_Categories.value == "")
            {
              alert("Business Categories field is required!");
              EditForm.Busi_Categories.focus();
              return (false);
            }

            if (EditForm.Busi_City.value == "")
            {
              alert("Business City field is required!");
              EditForm.Busi_City.focus();
              return (false);
            }

            if (EditForm.Busi_Address.value == "")
            {
              alert("Business Address field is required!");
              EditForm.Busi_Address.focus();
              return (false);
            }

            if (EditForm.Busi_OpenTime.value == "")
            {
              alert("Business OpenTime field is required!");
              EditForm.Busi_OpenTime.focus();
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
    
    <?php
    //Must be admin user
    if(!isset($_SESSION['admin'])||($_SESSION['admin'] != "admin")){
    echo "<script>alert('Please login as an admin user first');location='admin_login.php';</script>";
    }
    //Pages Display
    $sql="select * from business order by id asc";
    $result=mysql_query($sql);
    $total=mysql_num_rows($result);
    $page=isset($_GET['page'])?intval($_GET['page']):1;  
    $info_num=2; 
    $pagenum=ceil($total/$info_num); 
      
    If($page>$pagenum || $page == 0)
    {
       Echo "Error : Can Not Found The page .";
       Exit;
    }
    $offset=($page-1)*$info_num; 
    $info=mysql_query("select * from business order by id desc limit $offset,$info_num"); 
  ?>
  <?php
    //User Delete
    if(isset($_GET["tj"])&&($_GET["tj"]=="del")){
    mysql_query($sql="delete from business where Busi_Username='".$_GET['member']."'");
    echo "<script>alert('Successfully Deleted');location='admin_index.php';</script>";
    }
  ?>
  <?php
  //log out
  if(isset($_GET["tj"])&&($_GET["tj"]=="destroy")){
  session_destroy();
  echo "<script>alert('Successfully logged out!');location='admin_login.php';</script>";}
  ?>
  <?php
    //User Information Edit
    if(isset($_GET["tj"])&&($_GET["tj"]=="modify")){
    $sql="select * from business where Busi_Username='".$_GET['member']."'";
    $rs=mysql_fetch_array(mysql_query($sql));
    
    //Submit Modification
    if(isset($_POST["submit"]))
    {
/*    if(empty($_POST['Busi_Username']))
        echo "<script>alert('Username is required');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
      
      else if(empty($_POST['Busi_Password']))
        echo "<script>alert('Password is required');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
      
      else if($_POST['Busi_Password']!=$_POST['pass'])
        echo "<script>alert('Please check that your passwords match and try again!');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
*/              
      if(!empty($_POST['Busi_Phone'])&&!is_numeric($_POST['Busi_Phone']))
        echo "<script>alert('Please enter a valid phone number');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
      
      else if(!empty($_POST['Busi_Email'])&&!preg_match("/([0-9a-zA-Z]+)([@])([0-9a-zA-Z]+)(.)([0-9a-zA-Z]+)/",$_POST['Busi_Email']))
        echo "<script>alert('Please enter a valid email address!');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
 /*     
      else if(!empty($_POST['Busi_OpenTime'])&&!ereg("^[0-9]*$",$_POST['Busi_OpenTime']))
        echo "<script>alert('Opentime must be valid');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
      
      else if(!empty($_POST['Busi_ClosTime'])&&!ereg("^[0-9]*$",$_POST['Busi_CloseTime']))
        echo "<script>alert('Close time must be valid');location='?tj=modify&member=".$rs['Busi_Username']."';</script>";
*/      
      else
      { 
        mysql_query($sql="update business set Busi_Phone='".$_POST['Busi_Phone']."',Busi_Email='".$_POST['Busi_Email']."',Busi_Categories='".$_POST['Busi_Categories']."',Busi_City='".$_POST['Busi_City']."',Busi_Address='".$_POST['Busi_Address']."',Busi_OpenTime='".$_POST['Busi_OpenTime']."',Busi_Status='".$_POST['Busi_Status']."' where Busi_Username='".$_GET['member']."'");
        mysql_query($sql="update Customer set Customer_email='".$_POST['Busi_Email']."' where Customer_user='".$_GET['member']."'");
        echo "<script>alert('Successfully Modified');location='admin_index.php?tj=modify&member=".$rs['Busi_Username']."';</script>";
      }
    }
  ?>
  </head>
  <body>
  <form id="EditForm" name="EditForm" method="post" action="" onSubmit="return check_modify(this)" style="margin-top:3px; margin-bottom:3px;">
  <table width="500" height="239" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td height="26" colspan="2" align="center" bgcolor="#EBEBEB">Modify&nbsp;<? echo $rs['Busi_Username']; ?>&nbsp;information</td>
      </tr>
    <tr>
      <td width="59" height="26" align="center" bgcolor="#FFFFFF">Business Name：</td>
      <td width="268" align="left" bgcolor="#FFFFFF"><? echo $rs['Busi_Name'];?></td>
    </tr>
    <tr>
      <td width="59" height="26" align="center" bgcolor="#FFFFFF">User Name：</td>
      <td width="268" align="left" bgcolor="#FFFFFF"><? echo $rs['Busi_Username'];?></td>
    </tr>
    <tr>
      <td height="33" align="center" bgcolor="#FFFFFF">Contact Info：</td>
      <td align="left" bgcolor="#FFFFFF"><input name="Busi_Phone" type="text" id="Busi_Phone" value="<? echo $rs['Busi_Phone'];?>" maxlength="20"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Email：</td>
      <td align="left" bgcolor="#FFFFFF"><input name="Busi_Email" type="text" id="Busi_Email" value="<? echo $rs['Busi_Email'];?>" maxlength="30"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Coverpage：</td>
      <td align="left" bgcolor="#FFFFFF"><input name="Busi_Picture" type="text" id="Busi_Picture" value="<? echo $rs['Busi_Picture'];?>" maxlength="30"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Categories：</td>
      <td align="left" bgcolor="#FFFFFF">
        <select class="font" id="Busi_Categories" name="Busi_Categories">
          <option value="<? echo $rs['Busi_Categories'];?>" selected>---SELECT---</option>
          <option value="Spanish">Spanish</option>
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
      </td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">City：</td>
      <td align="left" bgcolor="#FFFFFF"><input name="Busi_City" type="text" id="Busi_City" value="<? echo $rs['Busi_City'];?>" maxlength="30"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Address：</td>
      <td align="left" bgcolor="#FFFFFF"><input name="Busi_Address" type="text" id="Busi_Address" value="<? echo $rs['Busi_Address'];?>" maxlength="30"/></td>
    </tr>
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Open Hours：</td>
      <td align="left" bgcolor="#FFFFFF">
        <input name="Busi_OpenTime" type="text" id="Busi_OpenTime" value="<? echo $rs['Busi_OpenTime'];?>" maxlength="30" size="5"/>
      </td>
    </tr>
    
    <tr>
      <td height="36" align="center" bgcolor="#FFFFFF">Status：</td>
      <td align="left" bgcolor="#FFFFFF">
        <?php
          if ($rs['Busi_Status'] == "Processing")
          {
        ?>
          <input name="Busi_Status" type="radio" id="Current_Status" value="<? echo $rs['Busi_Status'];?>" maxlength="30" CHECKED/>Processing
          <input name="Busi_Status" type="radio" id="Processing_Status" value="Approved" maxlength="30"/>Approved
        <?php
          }
          else
          {
        ?>
          <input name="Busi_Status" type="radio" id="Current_Status" value="<? echo $rs['Busi_Status'];?>" maxlength="30" CHECKED/>Approved
          <input name="Busi_Status" type="radio" id="Processing_Status" value="Processing" maxlength="30"/>Processing
        <?php
          }
        ?>
      </td>
    </tr>

    <tr>
      <td height="27" colspan="2" align="center" bgcolor="#FFFFFF">
        <input type="button" name="button" id="button" value="Back" onclick="location.href='admin_index.php'" />
        <input type="reset" name="button" id="button" value="Undo" />
        <input type="submit" name="submit" id="submit" value="Submit" /></td>
      </tr>
  </table>
  </form>
  <?php } ?>
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td align="center" bgcolor="#FFFFFF"><?php echo "In Total, ".$total."members, you can mange them below";?>
      </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFFFFF"><a href='?tj=destroy'>Log out</a>
      </td>
    </tr>
  </table>
   
  <?php while($rs=mysql_fetch_array($info)){ ?>
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"></td>
    </tr>
    <tr>
      <td width="200" align="center" bgcolor="#FFFFFF">Business Name:</td>
      <td width="300" bgcolor="#FFFFFF"><?php echo $rs['Busi_Name']; ?></td>
    </tr>
    <tr>
      <td width="200" align="center" bgcolor="#FFFFFF">User Name:</td>
      <td width="300" bgcolor="#FFFFFF"><?php echo $rs['Busi_Username']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Contact Info</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_Phone']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Email</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_Email']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Coverpage</td>
      <td bgcolor="#FFFFFF"><?php echo '<p><img src="'.$rs['Busi_Picture'].'" border="0" width="0" height="0" onload="AutoResizeImage(150,150,this)"  alt="150 X 150"></p>';?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Categories</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_Categories']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">City</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_City']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Address</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_Address']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Open Hours</td>
      <td bgcolor="#FFFFFF">
        <?php echo $rs['Busi_OpenTime']; ?>
      </td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Status</td>
      <td bgcolor="#FFFFFF"><?php echo $rs['Busi_Status']; ?></td>
    </tr>
    <tr>
      <td align="center" bgcolor="#FFFFFF">Management</td>
      <td bgcolor="#FFFFFF"><?php echo "<a href='?tj=modify&member=".$rs['Busi_Username']."'>Modify</a>&nbsp&nbsp";?>
    <?php echo "<a href='?tj=del&member=".$rs['Busi_Username']."'>Delete</a>" ?>  </td>
    </tr>
  </table>
  <?php } ?>
    <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#B3B3B3">
        <tr>
          <td align="center" bgcolor="#FFFFFF"><?php
    if( $page > 1 )
      {
        echo "<a href='admin_index.php?page=".($page-1)."'>Previous</a>&nbsp";
    }else{
      echo "First Page&nbsp&nbsp";
    }
    for($i=1;$i<=$pagenum;$i++){
         $show=($i!=$page)?"<a href='admin_index.php?page=".$i."'>".$i."</a>":"$i";
         Echo $show." ";
    }
    if( $page<$pagenum)
      {
        echo "<a href='admin_index.php?page=".($page+1)."'>Next Page</a>";
    }else
    {
      echo "Last Page";
       }
  ?></td>
  </tr>
  </table>

  <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td height="5"></td>
    </tr>
    <tr>
      <td align="center"><a href='?tj=destroy'>Log out</a>
      </td>
    </tr>
  </table>

  <table width="350" height="20" border="0" align="center" cellpadding="5" cellspacing="1">
    <tr>
      <td align="left" bgcolor="#B3B3B3">&nbsp;Copyright @2013 <a href="#" target="_blank">Foodie</a> All Rights Reserved. Build V.01</td>
    </tr>
  </table>
  </body>
</html>