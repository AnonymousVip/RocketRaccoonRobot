<?php
function mean(){
	global $mid;
	global $cid;
	global $tok;
	global $text;

if (startsWith($text,'/mean')) {
    $word_array = explode(' ', $text);
    $word = $word_array['1'];
      $ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "https://api.urbandictionary.com/v0/define?term=$word"); 
curl_setopt($ch1, CURLOPT_POST, false); 
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 
    $output21 = curl_exec($ch1);
$json12 = json_decode($output21,true);
    curl_close($ch1);
    $list = $json12['list'];
    $des = $json12['list']['0']['definition'];
$damns = $json12['list']['0']['example'];
if ($des == true) {
$mean = "
<b>Meaning Of Word [$word] </b> =>
==========================
<b>$des
\n\n$damns</b>
==========================
<i>Extracted From => Stark Dictionary Services Pvt. Ltd.</i>";
$message_send_meaning = [
    'chat_id'=>$cid,
    'text' => $mean,
    'parse_mode'=>'HTML',
    'reply_to_message_id'=>$mid,
];

botaction("sendMessage",$message_send_meaning);
}
else{
        $not_found = [
    'chat_id'=>$cid,
    'text' => '<b>Please Give Meaning full Words dude !</b>',
    'parse_mode'=>'HTML',
    'reply_to_message_id'=>$mid,
];
botaction("sendMessage",$not_found);
}
}

}
?>