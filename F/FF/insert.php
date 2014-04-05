<?php
$con = mysql_connect("localhost","root","root");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("foodie", $con);

$temp1=strip_tags($_POST["title"]);
$temp2=strip_tags($_POST["comment"]);

$title=addslashes($temp1);
$comment=addslashes($temp2);

$sql="INSERT INTO review (Busi_Name, Customer_user, Revi_Title, Revi_Publish_Time, Revi_Rating, Revi_Price, Revi_Comment)
VALUES
('$_POST[businame]','$_POST[username]','$title','$_POST[date]','$_POST[rate]','$_POST[price]','$comment')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "Submit success!";
?>
</br>
</br>
<a href="restaurant.php?keyword=<?php echo $_POST["businame"];?>">back to the restaurant</a>

<?php
mysql_close($con)
?>