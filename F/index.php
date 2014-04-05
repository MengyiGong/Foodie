<?php
 session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
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
        

		
  
</div>



<div id="body">
    <div id="rolling">
          <div class="show">
              <div id="play" class="pic">
                       <div class="block">
                              <div class="img"><img src="/images/sample1.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
                    
                        <div class="block">
                              <div class="img"><img src="/images/sample2.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
                        <div class="block">
                              <div class="img"><img src="/images/sample3.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
                    
                        <div class="block">
                              <div class="img"><img src="/images/sample4.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>

						<div class="block">
                              <div class="img"><img src="/images/sample5.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
					
						<div class="block">
                              <div class="img"><img src="/images/sample6.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
					
						<div class="block">
                              <div class="img"><img src="/images/sample7.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
					
						<div class="block">
                              <div class="img"><img src="/images/sample8.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
					
						<div class="block">
                              <div class="img"><img src="/images/sample9.jpg" style="height:90px; width:150px"></div>
                              <div class="clear"></div>
                        </div>
              </div>
              <div id="stop" class="pic"></div>
          </div>
    </div>


<script type="text/javascript" src="/F/rolling.js"></script>
    <div class="index_1">
	    
        <div class="ixf_left">
       
            <div class="ix_foo">
                <div class="ix_finer"></div>
		
                <div class="ix_left1_body" id="subject1" style="height:435px;_height:245px;">
			
                <div class="tabtab" style="height:435px;">
			   <iframe id="iframe1" frameborder="0" scrolling="no" height=435px width=707px; src="tab.html"> 
		
           </iframe>
                </div>
			
			
                </div>
               
                <div class="ix_left1_bottom"></div>
            </div>
     

		

           
            <div class="ix_foo">
                <div class="ix_review">
                    
                </div>
                <div class="ix_left1_body" style="height:325px;">
			
                   
			   <iframe id="iframe3" frameborder="0" scrolling="no" height=325px width=707px; src="hot.php"> 
		
           </iframe>
                  
                </div>
                <div class="ix_left1_bottom">
		    </div>
			
            </div>
			
        
        </div>
        <div class="ixf_right">
            
        
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:220px;">
                    <img src="/F/img/ad1.jpg" alt="McDonald" height=220px width=240px>
					
                </div>
                <div class="ix_right_bottom"></div>
            </div>
        
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:195px;">
                   <img src="/F/img/ad2.jpg" alt="KFC" height=195px width=240px>
             
                </div>
                <div class="ix_right_bottom"></div>
            </div>
      
     
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body" style="height:400px; overflow:auto; overflow-x:hidden;">
                <img src="/F/img/ad3.jpg" alt="burger king" height=400px width=240px>
                    
                </div>
                <div class="ix_right_bottom"></div>
            </div>
       
        </div>
        <div class="clear"></div>
    </div>

    <div class="index_1">
        <div class="ixf_left">
        
            <div class="ix_foo">
                <div class="ix_picture">
                    
                </div>
                <div class="ix_left1_body" style="height:200px;">
			   <iframe id="iframe4" frameborder="0" scrolling="no" height=325px width=707px; src="new.php"> 
		
           </iframe>
                </div>
                <div class="ix_left1_bottom"></div>
            </div>
       
        </div>
        <div class="ixf_right">
     
            <div class="ix_foo">
                <div class="ix_right_top"></div>
                <div class="ix_right_body">
                   
                    <div class="ix_tag" style="height:212px;">
                        <img src="/F/img/ad4.jpg" alt="domino" height=192px width=220px>
                    </div>
                </div>
                <div class="ix_right_bottom"></div>
            </div>
     
        </div>
   
    </div>


</div>



<div id="footer">
    
   
    <div>
         Powered by <span>Foodie</span>
		<br />Designed by:Hao Wu, Fangzhou Yan, Mengyi Gong, Junxiao Yi
    </div>
  
</div>

</body>
</html>