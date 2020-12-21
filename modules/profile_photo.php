<?php
function sendProfilePhoto(){
	global $reply_message;
	global $tok;
	global $reply_message_user_id;
	global $reply_message_user_fname;
	global $cid;
	global $mid;
	global $text;
if(startsWith($text,'/dp')){
	if ($reply_message) {
		$profile_photos =json_decode(file_get_contents("https://api.telegram.org/bot$tok/getUserProfilePhotos?user_id=$reply_message_user_id"),true);
		if($profile_photos['result']['total_count'] > 10){
			$count = "10";
		}
		else{
		$count = $profile_photos['result']['total_count'];
		}
		if($count == '0'){
			botaction("sendMessage",['chat_id'=>$cid,'text'=>"$reply_message_user_fname Has No Profile Photos!!",'reply_to_message_id'=>$mid]);
		}
		else{
		$out = '';
		for ($i=0; $i <$count ; $i++) { 
			$fid = $profile_photos['result']['photos'][$i]['0']['file_id'];
			$dams =   array("type"=>"photo","media"=>"$fid");
			$dams = ''.json_encode($dams).',';
			 $out .= $dams;
			 $i++;
		}
		$out = rtrim($out,',');
		echo $out ="[$out]";
		$dade = [
			'chat_id'=>$cid,
			'media'=>$out
		];
		botaction("sendMediaGroup",$dade);
		print_r($dadel);

		}
	}
	else{
		botaction("sendMessage",['chat_id'=>$cid,'text'=>'Reply to A Message To Get The Profile Photos of That User','reply_to_message_id'=>$mid]);
	}
}
}