<?php include 'connprac.php';

	if (1==1) {
		$senderid=$_GET['usaid'];
		//$receiver=$_POST[''];

		$upd=mysqli_query($connect,"update friends set status='accepted'where sender='$senderid' and receiver='".$_COOKIE['user1']."'");

		if ($upd) {
			echo "Friend request accepted";
		}
		else{echo "Error confirming request";}
	}

?>