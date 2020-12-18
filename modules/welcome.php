<?php
function welcome(){
	global $new_member;
	global $fname;
	global $mid;
	global $cid;
	global $nid;

	if ($new_member) {
		if ($nid == '1428124129') {
			$thnks_for_adding = [
		        'chat_id' => ''.$cid.'',
		        'text' => "$fname Thanks For Adding Me In The Group !! 👍👍",
		        'reply_to_message_id'=>''.$mid.'',
			];
			echo "Yup";
			botaction("sendMessage",$thnks_for_adding);
		}
	else{
		echo "Hmm";
		$welcome_msgs = [
			'chat_id'=>$cid,
			'text'=>'Hey! '.$fname.' How Are You ??',
			'reply_to_message_id'=>$mid
		];
		botaction("sendMessage",$welcome_msgs);
	}

	
	}
}
?>