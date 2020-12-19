<?php
function paste(){
	global $mid;
	global $cid;
	global $tok;
	global $text;
	global $reply_message;
	global $reply_message_text;

if (startsWith($text,'/paste')) {
    if ($reply_message) {
$paste = [
'content'=> $reply_message_text
];
  $curl3 = curl_init();
    curl_setopt($curl3, CURLOPT_URL,"https://nekobin.com/api/documents");
    curl_setopt($curl3, CURLOPT_POST, 1);
    curl_setopt($curl3, CURLOPT_POSTFIELDS, $paste);
    curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl3, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl3, CURLOPT_SSL_VERIFYPEER, 0);
$response3 = curl_exec($curl3);
$json = json_decode($response3,true);
    $key = $json['result']['key'];
    $urrl = "https://nekobin.com/$key";
    $raw = "https://nekobin.com/raw/$key";
    $textt = "Pasted Successfully To Nekobin!! \n<b>Paste Url</b> : $urrl\n<b>Raw Url</b> :$raw";
    $send_paste = [
        'chat_id'=>$cid,
        'text'=>$textt,
        'parse_mode'=>'HTML',
        'reply_to_message_id'=>$mid,
        'disable_web_page_preview'=>'True',
    ];
    botaction("sendMessage",$send_paste);
}
else{
    $reply_error = [
        'chat_id'=>$cid,
        'text'=>'Whadya Want To Paste????',
        'reply_to_message_id'=>$mid
    ];
    botaction("sendMessage",$reply_error);
}
}

}
paste();
?>