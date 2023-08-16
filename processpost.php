<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/sweetalert.css">
<script type="text/javascript" src="javascript/sweetalert-dev.js"></script>

</head>
<body>



<?php include 'connprac.php';
	if (isset($_POST['sharepost'])) {
		$userid=$_COOKIE['user1'];
		$msg=$_POST['mypost'];
		@$feeling=$_POST['feelings'];
		$date=time();
		$vv=$_POST['videopost'];
		$inspost=mysqli_query($connect,"insert into post(userid,message,time,mood,video)values('$userid','$msg','$date','$feeling','$vv')");
		$lastid=mysqli_insert_id($connect);
		



		foreach($_FILES['uploadphoto']['name'] as $m => $values) {

			$filename=basename($_FILES['uploadphoto']['name'][$m]);
			$filetype=basename($_FILES['uploadphoto']['type'][$m]);
			$filename=str_replace(" ", "", $filename);
			$folder="postimages/";
			$rand=mt_rand().mt_rand();
			$tmp=$_FILES['uploadphoto']['tmp_name'][$m];


			$move=move_uploaded_file($tmp, $folder.$rand.$filename);

			if($move){
			$insertfile=mysqli_query($connect, "insert into postfile(postid,filename,userid,date,filetype)values('$lastid','$rand$filename','".$_COOKIE['user1']."','".time()."','$filetype')");

			}


		}


		foreach($_FILES['uploadvideo']['name'] as $m => $values) {

			$filename=basename($_FILES['uploadphoto']['name'][$m]);
			$filename2=str_replace(" ", "", $filename);
			

			$filetype=basename($_FILES['uploadvideo']['type'][$m]);
			$folder="postvideo/";
			$rand=mt_rand().mt_rand();
			$tmp=$_FILES['uploadvideo']['tmp_name'][$m];


			$move=move_uploaded_file($tmp, $folder.$rand.$filename2.'.'.$filetype);

			if($move){
			$insertfile=mysqli_query($connect, "insert into postfile(postid,filename,userid,date,filetype)values('$lastid','$rand$filename2','".$_COOKIE['user1']."','".time()."','$filetype')");

			}


		}

		// foreach($_FILES['uploadvideo']['name'] as $m => $values) {

		// 	$filename=basename($_FILES['uploadvideo']['name'][$m]);
		// 	$filename2="mywebvideos";
		// 	$filetype=basename($_FILES['uploadvideo']['type'][$m]);
		// 	$folder="postvideo/";
		// 	$rand=mt_rand().mt_rand();
		// 	$tmp=$_FILES['uploadvideo']['tmp_name'][$m];


		// 	$move=move_uploaded_file($tmp, $folder.$rand.$filename2);

		// 	if($move){
		// 	$insertfile=mysqli_query($connect, "insert into postfile(postid,filename,userid,date,filetype)values('$lastid','$rand$filename2','".$_COOKIE['user1']."','".time()."','$filetype')");

		// 	}


		// }


		//$filename=basename($_FILES['uploadphoto']);

	}
header("Location:index.php");

?>



</body>
</html>