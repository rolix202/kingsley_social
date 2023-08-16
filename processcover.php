<?php include 'connprac.php';
$filename=$_FILES['uploadpics']['name'];
$filesize=$_FILES['uploadpics']['size'];
$filetype=pathinfo($_FILES['uploadpics']['name'], PATHINFO_EXTENSION);
$rand=mt_rand().mt_rand();
$folder="coverphoto/";
$filenamecomple=$rand.$filename;
$destination=$folder.$rand.$_FILES['uploadpics']['name'];
if (file_exists($folder.$rand.$filename)) {
	# code...
	echo "FIle already exist";
}elseif($filetype!='jpg' && $filetype!='jpeg' && $filetype!='png' && $filetype!='PNG' && $filetype!='JPG' 
	&& $filetype!='JPEG'){
	echo "FIle Type not supported";
 }else{

if(move_uploaded_file($_FILES['uploadpics']['tmp_name'], $destination)){
	//update query
	//echo $_COOKIE['user1'];
mysqli_query($connect,"update signup set coverpage='$filenamecomple' where id='".$_COOKIE['user1']."'");
echo "<script>alert('File Cover Uploaded successfully');//window.location.replace('editprofile.php');</script>";

}else {
echo "<script>alert('File was not uploaded');</script>";
}

}


?>