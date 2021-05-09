<?php
$user_ip=$_SERVER['REMOTE_ADDR'];
$conn = mysqli_connect('localhost','root','','shield');

$check_ip = mysqli_query($conn,"SELECT * FROM `useripadd` WHERE `userip` = '$user_ip'");
if(mysqli_num_rows($check_ip)>=1)
{
	$user=[];
	while($row=mysqli_fetch_row($check_ip)){
		$temp=[];
		array_push($temp,$row[0]);
		array_push($temp,$row[1]);
		array_push($temp,$row[2]);
		array_push($user,$temp);
	}
	$id=$user[0][0];
	$count=$user[0][2];
	if(isset($_SESSION['ipcount'])){
	}else{	
		$r=mysqli_query($conn,"UPDATE `useripadd` SET `count`=$count+1 WHERE _id=$id");
		$_SESSION['ipcount']=1;
	}
}
else
{
	  $query="INSERT INTO `useripadd`(`userip`, `count`) VALUES ('$user_ip',1)";
	  mysqli_query($conn,$query) or die(mysqli_error($conn));
	  $_SESSION['ipcount']=1;

}


?>
</body>
<script src="./JS/scroll.js"></script>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="./JS/init.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>