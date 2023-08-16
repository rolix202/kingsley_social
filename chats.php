<?php include 'fetchalldetails.php';

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