<?php include 'connprac.php';
	
	if (1==1) {
		$firstname=$_POST['fname'];
		$surname=$_POST['sname'];
		$country=$_POST['country'];
		$state=$_POST['state'];
		$phone=$_POST['phone'];
		$uni=$_POST['uni'];

	$insdetails=mysqli_query($connect,"update signup set firstname='$firstname',surname='$surname',country='$country',state='$state',phone='$phone',university='$uni' where id='".$_COOKIE['user1']."'");
	
	if ($insdetails) {
			echo "<script>
			swal('successful','Biography successfully edited','success');
			</script>";
		}	
else{
	echo "<script>
			swal('error','Unable to edit Bio','error');
		</script>";
	}
}


?>