<html>
<head>
<style> 
body,div,ul,li,p{margin:0;padding:0;}
body{color:#666;font:12px/1.5 Arial;}
ul{list-style-type:none;}
#star{position:relative;width:200px;}
#star ul,#star span{float:left;display:inline;height:19px;line-height:19px;}
#star ul{margin:0 10px;}
#star li{float:left;width:24px;cursor:pointer;text-indent:-9999px;background:url(images/star.png) no-repeat;}
#star strong{color:#f60;}
#star li.on{background-position:0 -28px;}
#star p{position:absolute;top:20px;width:100px;height:60px;display:none;padding:7px 10px 0;}
#star p em{color:#f60;display:block;font-style:normal;}
</style>

<script type="text/javascript">
            function myCheck()
            {
			Obj1=document.getElementById("rate");
			Obj2=document.getElementById("price");
			  if((Obj1.value=="")||(Obj2.value==""))
				{
					alert("Please fill the required fields");
					Obj1.focus();
					Obj2.focus();
					return false;
				}
				else return true;
            }
        </script>
</head>
<body>

<form method="post" name="frm_review" id="frm_review" action="insert.php" onSubmit="return myCheck()">
                <input type="hidden" name="businame" value="<?php echo $_POST["businessname"] ?>">
				<input type="hidden" name="username" value="<?php echo $_POST["username"] ?>">
                <table width="100%" cellspacing="0" cellpadding="0" class="item_table">
                                        <tbody>

                    <tr>
                        <td align="right">Title:</td>
                        <td><input type="text" name="title" class="t_input" size="40" ></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top">
                            Comment:<br>
                        </td>
                        <td>
                            <textarea name="comment" style="width:400px;height:120px;padding:5px;" ></textarea>
                           
                        </td>
                    </tr>
                            

                    <tr>
                        <td width="100" align="right" valign="top"><span class="font_1">*</span>Rate:</td>
                        <td width="*">
                            <div style="width:100%;">

<script type="text/javascript"> 
window.onload = function ()
{
	var oStar = document.getElementById("star");
	var aLi = oStar.getElementsByTagName("li");
	var oUl = oStar.getElementsByTagName("ul")[0];
	var oSpan = oStar.getElementsByTagName("span")[1];
	var oP = oStar.getElementsByTagName("p")[0];
	var i = iScore = iStar = 0;

	
	for (i = 1; i <= aLi.length; i++)
	{
		aLi[i - 1].index = i;
		aLi[i - 1].onmouseover = function ()
		{
			fnPoint(this.index);
			oP.style.display = "block";
			oP.style.left = oUl.offsetLeft + this.index * this.offsetWidth - 104 + "px";
		};
		aLi[i - 1].onmouseout = function ()
		{
			fnPoint();
			oP.style.display = "none"
		};
		aLi[i - 1].onclick = function ()
		{
			iStar = this.index;
			oP.style.display = "none";
			oSpan.innerHTML = "<strong>" + (this.index) + " star</strong> "
		}
	}
	function fnPoint(iArg)
	{
		iScore = iArg || iStar;
		for (i = 0; i < aLi.length; i++) aLi[i].className = i < iScore ? "on" : "";	
		document.getElementById("rate").value = iScore;
	}
};
</script>

                            <div id="star">
    <span></span>
    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
    </ul>
    <span></span>
    <p></p>
</div>
<input type="hidden" id="rate" name="rate"/>
                       
                            
                            </div>
                        </td>
                    </tr>


							<tr>
                        <td align="right"><span class="font_1">*</span>Price Range:</td>
                                                <td width="*">
                            <div style="width:100%;">
                            
                            <select name="price" id="price">
                                <option value="">-Please select-</option>
                                <option value="1">$</option>
                                <option value="2">$$</option>
                                <option value="3">$$$</option>
                                <option value="4">$$$$</option>
								<option value="5">$$$$$</option>
                            </select>
                           
                            
                            </div>
                        </td>
                    </tr>
	
<input type="hidden" id="date" name="date"/>
	
<script type="text/javascript">

var d=new Date()
var day=d.getDate()
var month=d.getMonth() + 1
var year=d.getFullYear()

document.getElementById("date").value= year + "/" + month + "/" + day;

</script>

                                        
                    
                                    </tbody></table>
                <div class="text_center" id="op_foot">
                    <button type="submit" class="button" style="position: relative; left: 400px" >Submit</button>&nbsp;&nbsp;
                    <button type="reset" class="button" style="position: relative; left: 400px" >Reset</button>
                    
                </div>
                </form>
				
</body>
</html>				