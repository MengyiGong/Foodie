<?php
 session_start();?>
<html>
<head>
<title>Foodie</title>
<link rel="stylesheet" type="text/css" href="/F/css_common.css" />

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
		<br>
		<h2 align="center">Coupons</h2>
		<br>
		<img src="/F/img/cp1.jpg">
		<img src="/F/img/cp2.jpg">
<div id="footer">
    
   
    <div>
         Powered by <span>Foodie</span>
		<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
    </div>
  
</div>

</body>
</html>