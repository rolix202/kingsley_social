	<?php include 'connprac.php';

	$select=mysqli_query($connect, "select * from chatlist where user1='".$_COOKIE['user1']."' or user2='".$_COOKIE['user1']."' order by time desc");

	while($fetch=mysqli_fetch_array($select)){
		$sid=$fetch['user1'];
		$time=$fetch['time'];
		$lmessage=$fetch['lastmessage'];

		$sub=substr($lmessage, 0,30);
		$rtime=date("d/m/Y",$time);
		if($sid==$_COOKIE['user1']){
			$userfid=$fetch['user2'];
		}

		else{
			$userfid=$fetch['user1'];
							
		}

		$s=mysqli_query($connect, "select * from signup where id=$userfid");
		$rfetch=mysqli_fetch_array($s);
		$file=$rfetch['profilepix'];
		$fname=$rfetch['firstname'];
		$lname=$rfetch['surname'];

	

	echo "

						<section class='chatlist'>
							<div class='img'>
								<img src='profilepicture/$file' class='userpix'>
							</div>
							<span class='username' style='flex-direction:column;align-items:flex-start;justify-content:center;'>
								<b onclick='openchat($userfid)'>$fname $lname</b>
								<font style='color:#999;font-size:14px;'>$sub...</font>
							</span>
							<span class='time'>
								$rtime
							</span>
						</section>";

					}
						?>