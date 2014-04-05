<?php
 session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<meta name="keywords" content="FOODIE" />
<link rel="stylesheet" type="text/css" href="css_common.css" />
<script type="text/javascript" src="jquery.js"></script>
</head>

<body>
<?php
$word=" ";  

if (isset($_GET["keyword"])) {
   $word=$_GET["keyword"];
}

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("foodie", $con);

$sql1="SELECT avg(Revi_Rating) FROM review WHERE Busi_Name='".$word."'";
$sql2="SELECT avg(Revi_Price) FROM review WHERE Busi_Name='".$word."'";

$temp1=mysql_query($sql1,$con);
$temp2=mysql_query($sql2,$con);
						
$avg1=mysql_fetch_array($temp1);
$avg2=mysql_fetch_array($temp2);


$temp3=floor($avg1[0]);
$temp4=floor($avg2[0]);


$sql3="UPDATE business SET Busi_Rating = ".$temp3." WHERE Busi_Name='".$word."'";
$sql4="UPDATE business SET Busi_Price = ".$temp4." WHERE Busi_Name='".$word."'";

mysql_query($sql3,$con);
mysql_query($sql4,$con);

$result = mysql_query("SELECT * FROM business WHERE Busi_Name='".$word."' AND Busi_Status = 'Approved'");


while($row = mysql_fetch_array($result))
  {
  ?>
  
 <style type="text/css">@import url("css_item.css");</style>
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
     
  
<script type="text/javascript">
$(document).ready(function() {
    if(!$.browser.msie && !$.browser.safari) {
        var d = $("#thumb");
        var dh = parseInt(d.css("height").replace("px",''));
        var ih = parseInt(d.find("img").css("height").replace("px",''));
        if(dh - ih < 3) return;
        var top = Math.ceil((dh - ih) / 2);
        d.find("img").css("margin-top",top+"px");
    }

        get_membereffect(1, 1);
});
</script> 
  
<div id="body">

<div id="item_left">
    <div class="mainrail rail-border-3 item">
        <div class="rail-h-bg-shop header">
            <em>
             <p class="<?php switch ($row['Busi_Rating'])
						{
							case 0:
								echo "start start0";
								break;
							case 1:
								echo "start start1";
								break;
							case 2:
								echo "start start2";
								break;
							case 3:
								echo "start start3";
								break;
							case 4:
								echo "start start4";
								break;
							case 5:
								echo "start start5";
								break;								
					    }?>
								"></p>
                                            </em>
            <h3 class="rail-h-3"><?php echo $row['Busi_Name'] ?></h3>
        </div>

		<div class="body">
		            <ul class="field">
                                <li>
                    <table class="custom_field" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td class='key' align='left'>Rating:</td>
                            <td width="*">
                                <span class="font_1" style="font-size:16px;"><strong><?php switch ($row['Busi_Rating'])
						{
							case 0:
								echo "No rating";
								break;
							case 1:
								echo "Terrible";
								break;
							case 2:
								echo "Bad";
								break;
							case 3:
								echo "Ordinary";
								break;
							case 4:
								echo "Good";
								break;
							case 5:
								echo "Excellent";
								break;								
					    }?></strong></span>
                                                               
                                                            </td>
                        </tr>
                        <tr>
	<td  class='key' align='right'>Loacation:</td>
	<td width="*"><?php echo $row['Busi_Address']?>,<?php echo $row['Busi_City']?></td>
</tr>

                        <tr>
	<td  class='key' align='right'>Open Hour:</td>
	<td width="*"><?php echo $row['Busi_OpenTime']?></td>
</tr>

                        <tr>
	<td  class='key' align='right'>Phone:</td>
	<td width="*"><?php echo $row['Busi_Phone']?></td>
</tr>

<tr>
	<td  class='key' align='right'>Category:</td>
	<td width="*"><?php echo $row['Busi_Categories']?></td>
</tr>

<tr>
	<td  class='key' align='right'>Price Range:</td>
	<td width="*"><span class="font_2" style="font-size:16px;"><?php switch ($row['Busi_Price'])
						{
							case 1:
								echo "$";
								break;
							case 2:
								echo "$$";
								break;
							case 3:
								echo "$$$";
								break;
							case 4:
								echo "$$$$";
								break;
							case 5:
								echo "$$$$$";
								break;								
					    }?></span></td>
</tr>
                                                <tr>
                            <td class='key' align='left'>Statistics:</td>
                            <td width="*">
							
						<?php
						$sql="SELECT count(*) FROM review WHERE Busi_Name='".$row['Busi_Name']."'";
						
						$res=mysql_query($sql,$con);
						if($res){
							$count=mysql_fetch_array($res);
						}
						?>
							
                                <span class="font_2"><?php echo $count[0];?>&nbsp;</span>reviews                            </td>
                        </tr>
                                            </table>
                </li>
            </ul>

            <div class="right">
                <div class="picture" id="thumb">
                    <img src="/F/<?php echo $row['Busi_Picture'] ?>"/>
                </div>
                <ul class="log">
                                       
                                    </ul>
            </div>

            <div class="clear"></div>

                                    <div class="info">
                <em>[<a href="javascript:;" onclick="$('#content').toggle();">Show/Hide</a>]</em>
                <h3><span class="arrow-ico">Discription:</span></h3>
                <div class="content" id="content"><?php echo $row['Busi_Description']?></div>
            </div>
                    </div>
    </div>

<?php  }

 
mysql_close($con);

?>	
	
	
    <style type="text/css">@import url("css_review.css");</style>
    <a name="review" id="review"></a>

            
<div class="mainrail rail-border-3 subject reviews">
        <ul class="subtab" id="subtab">
        <li class="selected" id="tab_review">Reviews</li>

            </ul>


<?php

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("foodie", $con);


$result = mysql_query("SELECT * FROM review WHERE Busi_Name='".$word."'");


while($row = mysql_fetch_array($result))
  {
  ?>

    <div class="clear"></div>    <div id="display">

                
        <div class="review">
            <div class="member m_w_item">
                               <?php 
			
			$result2 = mysql_query("SELECT * FROM customer WHERE Customer_user='".$row['Customer_user']."'");


			while($row2 = mysql_fetch_array($result2))
			{
			?>
                 <img src="/F/<?php echo $row2['Customer_picture'] ?>" class="face" alt="" style="height: 48px; width: 48px">
								
			<?php  }
			?>
               
            </div>
            <div class="field f_w_item">

                <div class="feed">

                                        <span class="member-ico"><font color="blue"><?php echo $row['Customer_user']?></font></span>&nbsp;&nbsp;
                    
                    published on &nbsp;<?php echo $row['Revi_Publish_Time'] ?>&nbsp;
                </div>

                <div class="info">

                    <ul class="score">
                        
                        <li>Rating</li><li class="<?php switch ($row['Revi_Rating'])
						{
							case 1:
								echo "start1";
								break;
							case 2:
								echo "start2";
								break;
							case 3:
								echo "start3";
								break;
							case 4:
								echo "start4";
								break;
							case 5:
								echo "start5";
								break;								
					    }?>
						"></li>
                        
                    </ul>
					</br>
					                        <ul class="params">

                                                        <li>Price Range: <span class="font_2"><?php switch ($row['Revi_Price'])
						{
							case 1:
								echo "$";
								break;
							case 2:
								echo "$$";
								break;
							case 3:
								echo "$$$";
								break;
							case 4:
								echo "$$$$";
								break;
							case 5:
								echo "$$$$$";
								break;								
					    }?></span></li>
                                                                                    
                                                            
                        </ul>

                    <div class="clear"></div>

                                        <div style="min-height:68px;">
										<p><strong><?php echo $row['Revi_Title'] ?></strong></p>
                                        <p><?php echo $row['Revi_Comment'] ?></p>

                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>		
	
<?php  }

 
mysql_close($con);

?>	
	
        <ul class="subtab" id="subtab">
        <li class="selected" id="tab_review">Add Review</li>
		

            </ul>
		
		<div id="review_post_foo" style="margin-top:10px;">            
<div class="mainrail" id="review_foot">
			
<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("foodie", $con);


$result = mysql_query("SELECT * FROM business WHERE Busi_Name='".$word."' AND Busi_Status = 'Approved'");


while($row = mysql_fetch_array($result))
  {
  ?>
			
			<form method="post" action="comment.php">
			<input type="hidden" name="businessname" value="<?php echo $row['Busi_Name'] ?>"/>
			<input type="hidden" name="username" value="<?php echo $_SESSION['customer'] ?>"/>
         <?php if(!empty($_SESSION['customer'])){
		 echo "<p>Want to write a review? Click <input type=\"submit\" value=\"here\"/></p>
                        </div></div>" ;}
		  else{
		  	    echo "<p>Want to write a review?  <a href=\"/F/Customer_login.php\">Log In</a></p>";
		  }    
			    ?>
                
    </div>

    </div>    
</div>

</div>

<div style="position: absolute;right: -100px; top:100px;">

                <iframe src="map.php?keyword=<?php echo $word;?>" frameborder="0" scrolling="no" style="width:350px; height:350px;"></iframe>
				<div style="text-align:center;">
				<a href="direction.php?keyword=<?php echo $word;?>">Find the direction</a>
                    </div>

</div>

<?php  }

 
mysql_close($con);

?>	

<div class="clear"></div>



<div id="footer">
    
   
    <div>
         Powered by <span>Foodie</span>
		<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
    </div>
  
</div>


</body>
</html>
