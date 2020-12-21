<?php
function check(){
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	if($reply_message == false){
		$reply = "Reply To A Message To Mute Him!!";
		return $reply;
	}
	if($reply_message_user_id == '1428124129'){
		$reply = "Mute Myself ! 😏..Shut Up You Fool!!";
	return $reply;
	}
	if(is_user_admin($cid,$reply_message_user_id)){
		$reply = "How High Are You To Mute An Admin!!";
		return $reply;
	}
	if(!is_user_admin($cid,$fid)){
		$reply = "Only Admins Can Execute This Command!!";
		return $reply;
	}
	return null;
}
function mute(){
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
$check = json_decode(file_get_contents("https://api.telegram.org/bot$tok/getChatMember?chat_id=$cid&user_id=$reply_message_user_id"),true);
print_r($check);
if(startsWith($text,'/mute')){
$reply =  check();
if($reply){
botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
}
else{
    if (is_null($check['result']['can_send_messages']) or $check['result']['can_send_messages'] == '1') {
        botaction("restrictChatMember",['chat_id'=>$cid,'user_id'=>$reply_message_user_id,'can_send_messages'=>'False']);
}
else{
botaction("sendMessage",['chat_id'=>$cid,'text'=>"This User Is Already Muted!!",'reply_to_message_id'=>$mid]);
}	
}
}
}
mute();
// $__module_name__ = "Muting";
?>