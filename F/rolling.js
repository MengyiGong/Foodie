
var speed=60
var tabLeft=document.getElementById("rolling");
var tab1=document.getElementById("play");
var tab2=document.getElementById("stop");
tab2.innerHTML=tab1.innerHTML;




function Marquee1(){
if(tabLeft.scrollLeft>=tab2.offsetWidth)
tabLeft.scrollLeft-=tab1.offsetWidth
else{
tabLeft.scrollLeft+=4;
}
}



var MyMar=setInterval(Marquee1,speed);


tabLeft.onmouseover=function() {clearInterval(MyMar)};
tabLeft.onmouseout=function() {MyMar=setInterval(Marquee1,speed)};






