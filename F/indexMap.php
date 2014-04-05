<?php
    session_start();//get the user login info
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=7" />
     <meta charset="utf-8">
    <title>Foodie Searcher</title>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
    <script src="foodieLocation.js"></script>


    <meta name="description" content="" />
    <link rel="stylesheet" type="text/css" href="/F/css_common.css" />
    <script type="text/javascript"></script>

    <style type="text/css">
            #map-canvas {  
                height:600px;
                margin-top:10px;
            }
    </style>
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
                              echo "Welcome </span>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"Customer.php\">".$_SESSION['customer']."</a>";
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
            <form method="get" action="/F/routeMap.php">
                <input type="hidden" name="act" value="search" />
                <input type="hidden" name="ordersort" value="addtime" />
                <input type="hidden" name="ordertype" value="desc" />
                <input type="hidden" name="searchsubmit" value="yes" />&nbsp;
                <input type="image" src="/F/img/search.png" class="btn" title="Search" />&nbsp;
            </form>
        </div>
    </div>

    <div id="body">
        <div class="ix_foo">
            <div id="map-canvas" title="google map"></div>
        </div>
    </div>

    <div id="adv_1_content" style="display:none;">
        <div class="ix_foo"></div>
    </div>
    <div id="footer">
        <div>
             Powered by <span>Foodie</span>
            <br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
        </div>
    </div>
</body>
</html>