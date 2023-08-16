<?php include 'fetchalldetails.php';

$frndid=$_GET['getuser'];

$selfrnd=mysqli_query($connect, "select * from signup where id='$frndid'");
$frndfetch=mysqli_fetch_array($selfrnd);
$selfname=$frndfetch['firstname'];
$selsname=$frndfetch['surname'];
$pprof=$frndfetch['profilepix'];

?>

<div class="chattop">
				<div class="chattop1">
					<img src="profilepicture/<?php echo $pprof; ?>">
					&nbsp; &nbsp;
					<span> <?php echo "$selfname $selsname"; ?></span>
					<i class=""></i>
				</div>
			</div>
			<div class="chatcenter">
				<?php

				$selchat=mysqli_query($connect, "select * from chats where (senderid='$frndid' and receiverid='".$_COOKIE['user1']."') or (receiverid='$frndid' and senderid='".$_COOKIE['user1']."')");
				$numchat=mysqli_num_rows($selchat);

				if($numchat<1){
					echo "You have no chat with $selfname $selsname";
				}
				else{
					while($fetchnchat=mysqli_fetch_array($selchat)){
						$sid=$fetchnchat['senderid'];
						$rid=$fetchnchat['receiverid'];
						$messagechat=$fetchnchat['message'];
						$timechat=$fetchnchat['time'];
						$realt=date("h:m:a", $timechat);

						if($sid==$_COOKIE['user1']){
							$flex1="sender";
						}

						else{
							$flex1="receiver";
							
						}

						echo "
							<div class='$flex1 environ'>
					<div class='msgs'>
						$messagechat
					</div>
					<span>
						$realt
					</span>	
				</div>

							";

					}
				}

				?>

			</div>	

			<div class="chatbottom"> 
				<div class="chatbottom1">
					<form class="chatform" action="processchat.php" method="post">
						<input type="hidden" name="frnd" value="<?php echo "$frndid" ?>">
						<input type="text" name="msg" placeholder="Write Message" id="msg">
						<input type="submit" name="send" value="SEND" id="subbut">
					</form>
				</div>
			</div>


			<script type="text/javascript">
				$(document).ready(function(){
					$('.chatform').on('submit',function(dc){
						dc.preventDefault();
						$.ajax({
						url:"processchat.php",
						type:"post",
						data:new FormData(this),
						contentType:false,
						processData:false,
						cache:false,
						beforeSend:function(){

						},
						success:function(){
								
								openchat(<?php echo $frndid; ?>);
								chathistory();	
							
						},
						error:function(){

						}
						});
					});
				});
			</script>