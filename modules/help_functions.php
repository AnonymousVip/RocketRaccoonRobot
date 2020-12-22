<?php
function is_reason(){
	global $text;
	$reason= explode(' ',$text);
	if(count($reason)>=2){
		array_shift($reason);
		echo $reason = implode(' ',$reason);
		return $reason;
	}
	else{
		return false;
	}
}
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
?>

