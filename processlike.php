<?php include 'connprac.php'; 

if (1==1) {
	$postid=$_POST['likedpost'];
	$liker=$_COOKIE['user1'];
	$u=$_POST['ll'];
	$date=time();

	$s=mysqli_query($connect, "select * from likes where postid='$postid' and liker='".$_COOKIE['user1']."'");

	if(mysqli_num_rows($s)>0){
		$del=mysqli_query($connect, "delete from likes where postid='$postid' and liker='".$_COOKIE['user1']."'");
	}

	else{

	$inslike=mysqli_query($connect,"insert into likes(postid,liker,date)values('$postid','$liker','$date')");

	if($u==$liker){
	$not=mysqli_query($connect, "insert into notification(userid,time,description,other)values('$u','$date','liked your post','you')");

}
else{
$not=mysqli_query($connect, "insert into notification(userid,time,description,other)values('$u','$date','liked your post','$liker')");
}


	if ($inslike) {
		echo "Post liked";
	}
	else{
		echo "Unable to like post";
	}
}

}

?>