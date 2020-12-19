<?php
function ping(){
	global $mid;
	global $cid;
	global $tok;
	global $text;
	if (startsWith($text,'/ping')) {
    $ping_message = [
        'chat_id'=>$cid,
        'text'=>'Pinging',
        'reply_to_message_id'=>$mid
    ];
    $edit_id = (int)$mid+1;
    $start_time = microtime(true);
    // botaction("sendMessage",$ping_message);

    $url2 = "https://api.telegram.org/bot$tok/sendMessage";
    $curld2 = curl_init();
    curl_setopt($curld2, CURLOPT_POST, true);
    curl_setopt($curld2, CURLOPT_POSTFIELDS, $ping_message);
    curl_setopt($curld2, CURLOPT_URL, $url2);
    curl_setopt($curld2, CURLOPT_RETURNTRANSFER, true);
    $output2 = curl_exec($curld2);
    curl_close($curld2);
    $damn = json_decode($output2,true);
    $editing_id = $damn['result']['message_id'];
    $end_time = microtime(true); 
    $ping_time = ($end_time - $start_time)*1000; 
    $ping_time = number_format((float)$ping_time, 3, '.', '')." ms";
    $ping_message_to_send = "                              
█▀█ █▀█ █▄░█ █▀▀
█▀▀ █▄█ █░▀█ █▄█
<b>Time Taken</b> => <code>$ping_time</code>";
    $ping_edit_message=[
        'chat_id'=>$cid,
        'message_id'=>$editing_id,
        'text'=>"$ping_message_to_send",
        'parse_mode'=>'HTML'
    ];
    botaction("editMessageText",$ping_edit_message);
 print_r($dadel);
}
}
?>