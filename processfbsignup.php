<?php include 'connprac.php'?>

<?php 
	function fbsignup($purify){
		$purify=strip_tags($purify);
		$purify=addslashes($purify);
		$purify=trim($purify);
		$purify=htmlspecialchars($purify);
		$purify=str_replace("diva","angel", $purify);
		$purify=filter_var($purify,FILTER_SANITIZE_STRING);
return $purify;	
	}
//instead of using if(isset($_POST['submit']));we use any true value..like if(1==1) or (2==2)etc because we are using ajax and not the normal/usual Php submit method to process the form!
	if($_SERVER['REQUEST_METHOD']=="POST"){//Another true value
		$fn=fbsignup($_POST['fname']);
		$sn=fbsignup($_POST['sname']);
		$email=fbsignup($_POST['email']);
		$email=filter_var($email,FILTER_SANITIZE_EMAIL);
		$pswd=fbsignup($_POST['pswd']);
		$day=fbsignup($_POST['day']);
		$month=fbsignup($_POST['month']);
		$year=fbsignup($_POST['year']);
		@$gender=fbsignup($_POST['radio']);
		@$joinas=fbsignup($_POST['joinas']);
		$username=$fn.rand(1,99);
		$regdate=time();

	//echo $fn;
		
	if (empty($fn)) {
		echo "<script> 
		swal('Error','First name is empty!','error');
		</script>";
	}
	elseif (empty($sn)) {
		 echo "<script> 
		swal('Error','First name is empty!','error');
		</script>";
	}
	elseif ($email=="") {
		echo "<script> 
		swal('Error','Email is empty!','error');
		</script>";
	}
	/*
	elseif (filter_var($email,FILTER_VALIDATE_EMAIL)===false) {
		echo "email is not a valid email address";
	*/
	//}
	elseif ($pswd=="") {
		echo "<script> 
		swal('Error','Password is empty!','error');
		</script>";
	}
	elseif (strlen($pswd)<8) {
		echo "<script> 
		swal('Error','Password too short, must be at least, upto 8 characters!','error');
		</script>";
	}
	elseif ($day=="") {
		echo "<script> 
		swal('Error','Please kindly fill in the day of your birth!','error');
		</script>";
	}
	elseif ($day>31) {
		echo "<script> 
		swal('Error','Invalid figure!','error');
		</script>";
	}
	elseif ($month=="") {
		echo "<script> 
		swal('Error','Please kindly fill in the month of your birth!','error');
		</script>";
	}
	elseif (empty($year)) {
		echo "<script> 
		swal('Error','Please kindly fill in your year of birth!','error');
		</script>";
	}
	elseif (empty($gender)) {
		echo "<script> 
		swal('Error','Please select your gender','error');
		</script>";
	}
	
	else{
		$sql=mysqli_query($connect, "select *from signup where email='$email'");
		$numrows=mysqli_num_rows($sql);
		if($numrows>0) {
			echo "<script>
			swal('Sorry','Email already taken by another user!','error');
			</script>";
		}
	else{
		$sqlc=mysqli_query($connect, "insert into signup(`Firstname`,`Surname`,`Email`,`Password`,`Gender`,`dateofreg`,`username`)values('$fn','$sn','$email','$pswd','$gender','$regdate','$username')");
		$lastid=mysqli_insert_id($connect);

		setcookie("user1",$lastid,time()+(86400 * 30),"/");
		mysqli_query($connect, "update signup set active='online' where id='$lastid'");

		if ($sqlc) {

			echo "<script>
			swal('successful','Congratulations, Account creation was successful !','success');
			</script>";
		}
		
			else{
				echo "<script>
				swal('Error','Sorry, Account creation failed!','error');
				</script>";
			}
		//header("Location:friends.php");
		echo "<script>function jtf(){
			window.location.replace('index.php');
		}
		setTimeout(jtf,3000);</script>";
		
			}		
		}
}

?>

