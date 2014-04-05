<?php
 session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="x-ua-compatible" content="ie=7" />
<title>Find your favorite</title>
<meta name="keywords" content="FOODIE" />
<link rel="stylesheet" type="text/css" href="css_common.css" />
</head>
<body><style type="text/css">@import url("css_item.css");</style>
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
			    <div class="search">
        <form method="get" action="category.php">
        <select name="type">
          <option value="restaurant"selected="selected">Name</option>
          <option value="category">Category</option>
		  <option value="location">City</option>
        </select>
        &nbsp;
        <input type="text" name="keyword" value="" class="input" x-webkit-speech="x-webkit-speech" />&nbsp;
        <input type="submit" value="Submit" /></br>&nbsp;
        </form>
    </div>
        

<div id="body">
	<div id="list_left">
    <div class="catefoot">
    </div>

    <div class="mainrail">
                
<?php
$word="default";  

if (isset($_GET["keyword"])) {
   $word=addslashes(strip_tags($_GET["keyword"]));
}

$type="default";

if (isset($_GET["type"])) {
   $type=$_GET["type"];
}

$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
if( isset($_GET['page']) ){
   $page = intval( $_GET['page'] );
}
else{
   $page = 1;
} 
$page_size = 3; 
mysql_select_db("foodie", $con);




if($type=="default"){
$sql = "select count(*) from business WHERE Busi_Status = 'Approved'";
}
else if($type=="restaurant"){
$sql = "select count(*) from business where Busi_Name='".$word."' AND Busi_Status = 'Approved'";
}

else if($type=="category"){
$sql = "select count(*) from business where Busi_Categories='".$word."' AND Busi_Status = 'Approved'";
}
else if($type=="location"){
$sql = "select count(*) from business where Busi_City='".$word."' AND Busi_Status = 'Approved'";
}

$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$amount = $row[0]; 
if( $amount ){
   if( $amount < $page_size ){ $page_count = 1; }              
   if( $amount % $page_size ){                              
       $page_count = (int)($amount / $page_size) + 1;          
   }else{
       $page_count = $amount / $page_size;                 
   }
}
else{
   $page_count = 0;
}


$page_string = '';
if( $page == 1 ){
   $page_string .= '<< | < | ';
}
else{
   $page_string .= '<a href=?page=1&type='.$type.'&keyword='.$word.'><<</a> | <a href=?page='.($page-1).'&type='.$type.'&keyword='.$word.'><</a> | ';
} 
if( ($page == $page_count) || ($page_count == 0) ){
   $page_string .= '> | >>';
}
else{
   $page_string .= '<a href=?page='.($page+1).'&type='.$type.'&keyword='.$word.'>></a> | <a href=?page='.$page_count.'&type='.$type.'&keyword='.$word.'>>></a>';
}

echo $page_string;

   if($type=="default"){
   $sql = "select * from business where Busi_Status = 'Approved' limit ". ($page-1)*$page_size .", $page_size";
   }
   else if($type=="restaurant"){
   $sql = "select * from business where Busi_Name='".$word."' and Busi_Status = 'Approved' limit ". ($page-1)*$page_size .", $page_size";
   }

   else if($type=="category"){
   $sql = "select * from business where Busi_Categories='".$word."' and Busi_Status = 'Approved' limit ". ($page-1)*$page_size .", $page_size";
   }
   else if($type=="location"){
   $sql = "select * from business where Busi_City='".$word."' and Busi_Status = 'Approved' limit ". ($page-1)*$page_size .", $page_size";
   }

   $result = mysql_query($sql);
   
   while ( $row = mysql_fetch_array($result) ){ 
?>

<div class="itemlist">
        <div class="pic">
            <div id="item_pic"><img src="/F/<?php echo $row['Busi_Picture'];?>" /><b></b></div>
        </div>
        <div class="item">
            <div class="info">
                <div>
                    <h3 id="item_name"><a href="restaurant.php?keyword=<?php echo $row['Busi_Name'];?>"><?php echo $row['Busi_Name'];?>&nbsp;</a></h3>
                </div>
                <table class="custom_field_list" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            
Category:<span class="font_1" style="font-size:16px;"><?php echo $row['Busi_Categories'];?></span></br>
Price Range:<span class="font_2" style="font-size:16px;"><?php switch ($row['Busi_Price'])
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
					    }?></span>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div class="stat">
                                <li class="<?php switch ($row['Busi_Rating'])
						{
							case 0:
								echo "start0";
								break;
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
					    }?>"></li>
						
						
						
						<?php
						$sql="SELECT count(*) FROM review WHERE Busi_Name='".$row['Busi_Name']."'";
						
						$res=mysql_query($sql,$con);
						if($res){
							$count=mysql_fetch_array($res);
						}
						?>
						
								<li><span class="font_2"><?php echo $count[0];?></span> reviews</li>
            </div>
        </div>
		    <div class="clear"></div>
    </div> 

<?php  }

mysql_close($con);
?>

               </div>
            </div>


    <div class="clear"></div>

</div>

<div id="footer">
    
   
    <div>
         Powered by <span>Foodie</span>
		<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
    </div>
  
</div>
</body>
</html>