<?php include 'connprac.php';?>
	<?php
	if(1==1) {
		$em=$_POST['surem'];
		$pswd=$_POST['pswd'];
		
		$sql=mysqli_query($connect, "select *from signup where password='$pswd' and email='$em'");

		$nm=mysqli_num_rows($sql);
	
	if ($nm<1) {

		echo "<script>
		swal('Error','Incorrect user details! Please check user details and try again','error');
		</script>";
		//echo "<script>alert('login failed');</script>";
		}

	else{

			$fnm=mysqli_fetch_array($sql);
			$idx=$fnm['id'];
			setcookie("user1",$idx,time()+(86400 * 30),"/");
			mysqli_query($connect, "update signup set active='online' where email='$em'");
			//header("Location: indexfrndprac.php");
			echo "<script>
			swal('Successful','Your login was successful','success');
			function jtf(){
			window.location.replace('index.php');
		}
		setTimeout(jtf,3000);</script>";

		}	
}

?>

