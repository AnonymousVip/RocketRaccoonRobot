<?php
function get_key_word_and_trigger(){
	global $texts;
	global $reply_message;
        $mess_arr = explode(' ',$texts);
        array_shift($mess_arr);
        $keyword = strtolower(array_shift($mess_arr));
        $reply = implode(' ',$mess_arr);
 	if($keyword and $reply)
	{
		$krray = "$keyword,$reply";
	return "$krray";
	}
	elseif($reply_message)
	{
		$krray ="$keyword";
	return "$krray";
	}
	else
	{
	return false;
	}
}

function get_keyword(){
	global $text;
	$mess_arr = explode(' ',$text);
    array_shift($mess_arr);
    $keyword = strtolower(implode('_',$mess_arr));
    if($keyword)
    {
    	return $keyword;
    }
    else
    {
    	return false;
    }
}
function add_filter(){
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_id;
	global $cid;
	global $fid;
	global $mid;
	global $texts;
	global $tok;
	global $gname;

	$key_trig = get_key_word_and_trigger();
	if(!is_user_admin($cid,$fid))
	{
		$reply = "Only Admins Can Clear A Note!!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!$key_trig)
	{
		$reply = "Thats Not The Correct Method Of Adding A Filter !!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else{
		$key_trig =explode(',', $key_trig);
		$key_word = $key_trig['0'];
		$trigger = $key_trig['1'];
		if($reply_message)
		{
	    $frwd_reply_msgs = json_decode(file_get_contents("https://api.telegram.org/bot$tok/copyMessage?from_chat_id=$cid&chat_id=-1001464778576&message_id=$reply_message_id"),true);
	    $filter_id = $frwd_reply_msgs['result']['message_id'];
	    file_get_contents('http://rocket-raccoon-robot.tk/Database/'.$cid.'/add_filter.php?kw='.rawurlencode($key_word).'&r='.$filter_id.'');
	    $done_added = [
	        'chat_id'=>$cid,
	        'text'=>"Added Filter $key_word in $gname",
	        'parse_mode'=>'HTML',
	        'reply_to_message_id'=>$mid,
	   ];
	   botaction("sendMessage",$done_added);

		}
		else{
			echo rawurlencode($key_word);
			$sm = json_decode(file_get_contents('https://api.telegram.org/bot'.$tok.'/sendMessage?chat_id=-1001464778576&text='.rawurlencode($trigger).''),true);
		    $sid = $sm['result']['message_id'];    
		    file_get_contents('http://rocket-raccoon-robot.tk/Database/'.$cid.'/add_filter.php?kw='.rawurlencode($key_word).'&r='.$sid.'');
		    $add_filter_success = [
		    'chat_id'=>$cid,
		    'text'=>"Added Filter <code>$key_word</code> in <b>$gname</b>",
		    'parse_mode'=>'HTML',
		    'reply_to_message_id'=>$mid,
		    ];  
		    botaction("sendMessage",$add_filter_success);

		}
	}
}
function send_filter(){
	global $text;
	global $cid;
	global $mid;
	global $filters;
	global $message_dump;
	foreach ($filters as $fkw => $fri) {
    $text_array = explode(' ', $text);
    if(in_array($fkw, array_map('strtolower', $text_array))){
        $reply_filter_id = $filters["$fri"];
        $send_filter_msg = [
            'from_chat_id'=>$message_dump,
            'chat_id'=>$cid,
            'message_id'=>$fri,
            'reply_to_message_id'=>$mid,
        ];
        botaction("copyMessage",$send_filter_msg);
    }

}
}

function remove_filter(){
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_id;
	global $cid;
	global $fid;
	global $mid;
	global $text;
	global $tok;
	global $gname;
	global $filters;
	echo $remove_filter_name = get_keyword();
	$remove_filter_id = $filters[''.str_replace("_"," ",$remove_filter_name).''];
if($remove_filter_name)
{
	if(!is_user_admin($cid,$fid))
	{
		$reply = "Only Admins Can Execute This Command!!";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	elseif(!array_key_exists($remove_filter_name,$filters))
	{
		$reply = "There Is No Filter By That Name!! How Am I Meant To Stop It 👀";
		botaction("sendMessage",['chat_id'=>$cid,'text'=>$reply,'reply_to_message_id'=>$mid]);
	}
	else{
		$remove_filter_name = str_replace('_',' ',$remove_filter_name);
		file_get_contents('http://rocket-raccoon-robot.tk/Database/'.$cid.'/remove_filter.php?kw='.rawurlencode($remove_filter_name).'&id='.$remove_filter_id.'');
		botaction("sendMessage",['chat_id'=>$cid,'text'=>"Ok! I Will Stop Replying To <code>$remove_filter_name</code> in <b>$gname</b>",'parse_mode'=>'HTML','reply_to_message_id'=>$mid]);
	}
}
else{
	botaction("sendMessage",['chat_id'=>$cid,'text'=>"Please Give Me A Filter Name So That I Am Able To delete It!!",'reply_to_message_id'=>$mid]);
}

}
?>

