<?php
function check_for_notes()
{
	global $reply_message;
	global $reply_message_user_id;
	global $cid;
	global $fid;
	switch ($cid){
	case(!is_user_admin($cid,$fid)):
		$reply = "Only Admins Can Execute This Command!!";
		return $reply;
	case(!$reply_message):
		$reply = "Reply To A Message To Add A Note!!";
		return $reply;
	default:
		return null;
	}

}
function get_note_name(){
	global $text;
	$text_array = explode(' ', $text);
	if(count($text_array)>=2){
		$note_name = rawurlencode($text_array['1']);
		return $note_name;
	}
	else{
		return null;
	}
}
function save(){
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $gname;
	$reply = check_for_notes();
	if($reply)
	{
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else
	{
		$note_name = get_note_name();
		if($note_name)
		{
			 $frwd_reply_msg = json_decode(file_get_contents("https://api.telegram.org/bot$tok/copyMessage?from_chat_id=$cid&chat_id=-1001464778576&message_id=$reply_message_id"),true);
			$note_id = $frwd_reply_msg['result']['message_id'];
			file_get_contents("http://rocket-raccoon-robot.tk/Database/$cid/add_note.php?name=$note_name&id=$note_id");
			$note_added_msg = "Done! Added <code>$note_name</code> in $gname... \n Get that With <code>#$note_name</code>";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$note_added_msg,'parse_mode'=>'HTML','reply_to_message_id'=>$mid]);
		}
		else
		{
			botaction("sendMessage",['chat_id'=>$cid,'text'=>"Note Name Is Missing !!",'reply_to_message_id'=>$mid]);
		}
	}
}
function hash_get(){
	global $text;
	global $notes_list;
	global $cid;
	global $mid;
if(array_key_exists(str_replace('#', '', $text), $notes_list))
{
	$tt = str_replace('#', '', $text);
	$reply_note = $notes_list["$tt"];
	$send_note_msg = [
	'from_chat_id'=>'-1001464778576',
	'chat_id'=>$cid,
	'message_id'=>$reply_note,
	'reply_to_message_id'=>$mid
	];
	botaction("copyMessage",$send_note_msg);
}

}

function clear(){
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $gname;
	global $notes_list;
	$remove_note_name = get_note_name();
	$remove_note_id = $notes_list["$remove_note_name"];
if($remove_note_name)
{
	if(!is_user_admin($cid,$fid))
	{
		$reply = "Only Admins Can Clear A Note!!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!array_key_exists($remove_note_name,$notes_list))
	{
		$reply = "There Is No Note By That Name!! How Am I Meant To Delete It 👀";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else{
		file_get_contents("http://rocket-raccoon-robot.tk/Database/$cid/remove_note.php?name=$remove_note_name&id=$remove_note_id");
		botaction("sendMessage",['chat_id'=>$cid,'text'=>"Removed <code>$remove_note_name</code> in $gname",'parse_mode'=>'HTML','reply_to_message_id'=>$mid]);
	}
}
else{
	botaction("sendMessage",['chat_id'=>$cid,'text'=>"Please Give Me A Note Name So That I Am Able To delete It!!",'reply_to_message_id'=>$mid]);
}

}

function get_all_notes(){
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $gname;
	global $notes_list;
	$note = '';
    foreach($notes_list as $key => $value) {
        $not = "- <code>$key</code>\n";
        $note .= $not;
    }
    $note_message = "Notes In <b>$gname</b> :\n$note\nYou Can Retreive Them By <code>#{note_name}</code>";
    if($note == '')
    {
        $no_notes_dude = [
            'chat_id'=>$cid,
			'text'=>"There Are No Notes In <b>$gname</b>",
			'parse_mode'=>'HTML',
            'reply_to_message_id'=>$mid
        ];
	botaction("sendMessage",['chat_id'=>$cid,'text'=>"There are No Notes In $gname..",'reply_to_message_id'=>$mid]);
    }
    else
    {
    	botaction("sendMessage",['chat_id'=>$cid,'text'=>"$note_message",'parse_mode'=>'HTML','reply_to_message_id'=>$mid]);
    }
}
?>
