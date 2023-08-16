<?php include 'connprac.php' ;

	if (1==1) {
		$sender=$_COOKIE['user1'];
		$receiver=$_GET['usaid'];

		/*$chkreq=mysql_query($connect,"select *from friends where sender='".$_COOKIE['user1']."' and receiver='$receiver'");
		$numrows=mysqli_num_rows($chkreq);

			if ($numrows>0) {
				echo "You have sent a friend request to this user before";
			}
			*/
	$insreq=mysqli_query($connect,"insert into friends(sender,receiver,status)values('$sender','$receiver','pending')");

	if ($insreq) {
			echo "Friend request sent";
		}	
		else{
			echo "Unable to send friend request ";
		}
	}
	

?>