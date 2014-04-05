<!DOCTYPE html>
<html>
<head>
<style type="text/css">#cate_left{ float: left; width: 305px; }
.itemfiner { background:#FFFDF4; }
.itemlist { clear:both; padding:7px 0 5px 0px; border-bottom:1px dashed #ccc; line-height:18px; margin:0; }
.itemlist .item { float:left; width:515px; } 
.itemlist .item .info { float:left; margin:0 0 5px 0; width:325px; }
.itemlist .item .info h3 { margin:0 5px 0 0; display:inline; font-size:12px; }
.itemlist .item .info h3 a { color:#CC3300; }
.itemlist .item .info p { line-height:30px; margin:2px 0;}
.itemlist .item .info ul { list-style:none; padding:0;margin:0; }
.itemlist .item .info li { padding:1px 0; }
.itemlist .item .stat { float:right; width:85px; padding:0; margin:0; list-style:none; }
.itemlist .item .stat li { padding:1px 0; line-height:15px; height:15px; }
.itemlist .pic { float:left; width:105px; height:80px; margin:5px 12px 5px 0; }
.itemlist .pic div { border:1px solid #ccc; height:80px; text-align:center; background:#EEE;  }
.itemlist .pic div img { vertical-align: middle; max-width:100px; max-height:75px; _width:expression(this.width > 100 ? 100 : true); 
    _height:expression(this.height > 75 ? 75 : true); }
.itemlist .pic div b { display:inline-block; height:100%; vertical-align:middle; }
.itemlist .pic p { padding:0;margin:0; }
.start0 { background:url('img/review_start.gif') no-repeat 0 -1px;  width:58px; height:10px; }
.start1 { background:url('img/review_start.gif') no-repeat 0 -15px; width:58px; height:10px; }
.start2 { background:url('img/review_start.gif') no-repeat 0 -29px; width:58px; height:10px; }
.start3 { background:url('img/review_start.gif') no-repeat 0 -43px; width:58px; height:10px; }
.start4 { background:url('img/review_start.gif') no-repeat 0 -57px; width:58px; height:10px; }
.start5 { background:url('img/review_start.gif') no-repeat 0 -71px; width:58px; height:10px; }
.font { font-size:12px; font-weight:normal; margin:0; padding:0; }
.font_1 { color: #FF0000; padding: 0 1px; }
.font_2 { color: #FF6600; padding: 0 1px; }
.font_3 { color: #969696; padding: 0 1px; }
.font_4 { color: #969696; padding: 0 1px; font: 10px Helvetica,Arial,Tahoma,sans-serif; }
.font_5 { color: #0033FF; padding: 0 1px; }
.line_1 { border-bottom: 2px solid #FF8000; }
.line_2 { border-bottom: 1px dashed #ccc; height: 1px; } 
* { word-wrap: break-word; word-break: break-all;}
body { margin: 0px; font: 12px Helvetica,Arial,sans-serif; }
form, img { margin: 0; border: 0; }
a { color: #3A3A3A; text-decoration: none; }
a:hover { color: #FF6600; text-decoration: underline; }
.t_input { padding: 3px 2px;border-style:solid;border-width: 1px;border-color:#7C7C7C #C3C3C3 #DDD;
    vertical-align:middle;-moz-border-radius:3px;-webkit-border-radius:3px;}
.f_input { border:1px solid #BBBBBB;padding:3px;  vertical-align:middle; }
textarea { font-size:12px; border-style:solid;border-width: 1px;border-color:#7C7C7C #C3C3C3 #DDD;vertical-align:middle;
    overflow:auto;-moz-border-radius:3px;-webkit-border-radius:3px; }
button { border:1px solid #B8CACB;color:#333333;cursor:pointer;font-weight:bold;padding:4px 10px;font-size:12px;
    overflow:visible;text-shadow:0 1px 0 #FFFFFF;-moz-border-radius:3px;-webkit-border-radius:3px;*padding:7px 10px 2px 10px;}
button.button:active,button.button:hover { border-color:#85A5A7;background:#efefef }
.seccode { float:left;width:80px;position:relative;top:-3px; }
.clear { clear: both; }
.none { display:none; }
.wrap { width: 98%; text-align: left; margin: 0 auto; }
.float_left { float: left; }
.float_right { float: right; }
.text_right { text-align: right; }
.text_center { text-align: center; margin-bottom: 10px; }
.messageborder { line-height:30px; margin:5px; padding:0 10px; background:#F7F7F7; color:#666; }
.messageborder a { color:#FF6600; }
.formtip { margin:5px 0 2px; color:#808080; }
.formmessage { padding:5px; }

</style>
</head>

<body>
	<?php
	$word="Spaish";  

	if (isset($_GET["keyword"])) {
	   $word=$_GET["keyword"];
	}
	$con = mysql_connect("localhost","root","root");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  mysql_select_db("foodie", $con);
      $sql = "select * from business where Busi_Status=\"Approved\" order by Busi_Rating desc limit 0, 3";
     
      $result = mysql_query($sql);
	  if(!empty($result)){
      while ( $row = mysql_fetch_array($result) ){ 
   ?><div class="itemlist">
        <div class="pic">
            <div id="item_pic_1"><img src="<?php echo $row['Busi_Picture'];?>" /><b></b></div>
        </div>
        <div class="item">
            <div class="info">
                <div>
                    <h3 id="item_name_1"><a href="/F/FF/restaurant.php?keyword=<?php echo $row['Busi_Name'];?>" target="_blank"><?php echo $row['Busi_Name'];?>&nbsp;</a></h3>
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

<?php  }}

mysql_close($con);
?>

               </div>
            </div>


    <div class="clear"></div>

</div>
</body>
</html>
