<?php
function is_user_admin($chatid,$userid){
global $tok;
$JSON = json_decode(file_get_contents("https://api.telegram.org/bot1428124129:AAHLK6rHmSQp8LoyIm5jYfw9QcxUviVFFg8/getChatMember?chat_id=$chatid&user_id=$userid"),TRUE);
$status = $JSON['result']['status'];
if($userid == '777000' or $userid == '1087968824' or $status == 'creator' or $status == 'administrator'){
	return true;
}
else{
	return false;
}
}

function can_bot($chatid,$permission){
$JSON = json_decode(file_get_contents("https://api.telegram.org/bot1428124129:AAHLK6rHmSQp8LoyIm5jYfw9QcxUviVFFg8/getChatMember?chat_id=$chatid&user_id=1428124129"),TRUE);
if($JSON['result']["$permission"]){
	return true;
}
else{
	return false;
}

}

function can_user($chatid,$userid,$permission){
$JSON = json_decode(file_get_contents("https://api.telegram.org/bot1428124129:AAHLK6rHmSQp8LoyIm5jYfw9QcxUviVFFg8/getChatMember?chat_id=$chatid&user_id=$userid"),TRUE);
if(is_null($JSON['result']["$permission"]) or $JSON['result']["$permission"]){
	return true;
}
else{
	return false;
}

}
function check(){
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
switch ($cid){
	case(!is_user_admin($cid,1428124129)):
		$reply = "\o/ I An Not Admin!! Alexa Play Tera Baap Aaya 😏";
		return $reply;
	
	case(!can_bot($cid,'can_restrict_members')):
		$reply = "I am Not Given The Right To Mute And Unmute People!!";
		return $reply;
	
	case($reply_message == false):
		$reply = "Reply To A Message To Mute Him!!";
		return $reply;
	
	case($reply_message_user_id == '1428124129'):
		$reply = "Mute Myself ! 😏..Shut Up You Fool!!";
	return $reply;
	
	case(is_user_admin($cid,$reply_message_user_id)):
		$reply = "How High Are You To Mute An Admin!!";
		return $reply;
	
	case(!is_user_admin($cid,$fid)):
		$reply = "Only Admins Can Execute This Command!!";
		return $reply;
	default:
	return null;
}
}
function mute(){
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $reply_message_user_fname;
	$reply =  check();
	if($reply){

	botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);

	}
	else{

	    if (can_user($cid,$reply_message_user_id,'can_send_messages')) {
	        botaction("restrictChatMember",['chat_id'=>$cid,'user_id'=>$reply_message_user_id,'can_send_messages'=>'False']);
	        botaction("sendMessage",['chat_id'=>$cid,'text'=>"Thats More Than Your Limits \n Muted $reply_message_user_fname Successfully!!",'reply_to_message_id'=>$mid]);
	}

	else{

	botaction("sendMessage",['chat_id'=>$cid,'text'=>"This User Is Already Muted!!",'reply_to_message_id'=>$mid]);

	}	

	}

}


function check_unmute(){
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $reply_message_user_fname;

switch ($cid){
	case(!is_user_admin($cid,1428124129)):
		$reply = "\o/ I An Not Admin!! Alexa Play Tera Baap Aaya 😏";
		return $reply;
	
	case(!can_bot($cid,'can_restrict_members')):
		$reply = "I am Not Given The Right To Mute And Unmute People!!";
		return $reply;
	
	case($reply_message == false):
		$reply = "Reply To A Message To Un-Mute Him!!";
		return $reply;
	case(!is_user_admin($cid,$fid)):
		$reply = "Only Admins Can Execute This Command!!";
		return $reply;
	case (can_user($cid,$reply_message_user_id,'can_send_messages') and can_user($cid,$reply_message_user_id,'can_send_media_messages') and can_user($cid,$reply_message_user_id,'can_send_other_messages') and can_user($cid,$reply_message_user_id,'can_add_web_page_previews')):
	$reply = "This User Already Has The Right To Speak!!";
	return $reply;
	default:
	return null;
}
}

function unmute(){
		global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $reply_message_user_fname;

	$reply = check_unmute();
	if($reply){
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else{
		$unmuting_member = [
			'chat_id'=>$cid,
			'user_id'=>$reply_message_user_id,
			'can_send_messages'=>'True',
			'can_invite_users'=>'True',
			'can_pin_messages'=>'True',
			'can_send_polls'=>'True',
			'can_change_info'=>'True',
			'can_send_media_messages'=>'True',
			'can_send_other_messages'=>'True',
			'can_add_web_page_previews'=>'True',
		];
	        botaction("restrictChatMember",$unmuting_member);
	botaction("sendMessage",['chat_id'=>$cid,'text'=>"Unmuted Successfully!!",'reply_to_message_id'=>$mid]);

	}
}
// $__module_name__ = "Muting";
?>
