<?php
function pin(){
	global $cid;
	global $fid;
	global $mid;
	global $reply_message;
	global $reply_message_id;
	if(!is_user_admin($cid,$fid))
	{
		$reply = "Only Admins Can Execute This Command";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!is_user_admin($cid,'1428124129'))
	{
		$reply = "I Am Not Admin !!!! \o/";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif (!can_bot($cid,'can_pin_messages')) 
	{
		$reply = "I Am Not Given The Rights To Pin And Un-Pin Messages";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!can_user($cid,$fid,'can_pin_messages'))
	{
		$reply = "You Aren't Given The Rights To Pin And Un-Pin Messages!!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!$reply_message)
	{
		$reply = "Reply To A Message To Pin It!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else{
		botaction("pinChatMessage",['chat_id'=>$cid,'message_id'=>$reply_message_id,]);
	}
}
?>