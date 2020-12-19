<?php
error_reporting(0);
$tok = '1428124129:AAHLK6rHmSQp8LoyIm5jYfw9QcxUviVFFg8';
function botaction($method, $data){
	global $tok;
	global $dadel;
	global $dueto;
    $url = "https://api.telegram.org/bot$tok/$method";
    $curld = curl_init();
    curl_setopt($curld, CURLOPT_POST, true);
    curl_setopt($curld, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curld, CURLOPT_URL, $url);
    curl_setopt($curld, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($curld);
    curl_close($curld);
    $dadel = json_decode($output,true);
    $dueto = $dadel['description'];
    return $output;
}
function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}
$update = file_get_contents('php://input');
$update = json_decode($update, true);


$mid = $update['message']['message_id'];
$cid = $update['message']['chat']['id'];
$uid = $update['message']['chat']['id'];
$cname = $update['message']['chat']['username'];
$fid = $update['message']['from']['id'];
$fname = $update['message']['from']['first_name'];
$lname = $update['message']['from']['last_name'];
$uname = $update['message']['from']['username'];
$typ = $update['message']['chat']['type'];
$text = $update['message']['text'];
$fullname = ''.$fname.' '.$lname.'';

##################NEW MEMBER DATA ################
$new_member = $update['message']['new_chat_member'];
$gname = $update['message']['chat']['title'];
$nid = $update['message']['new_chat_member']['id'];
$nfname = $update['message']['new_chat_member']['first_name'];
$nlname = $update['message']['new_chat_member']['last_name'];
$nuname = $update['message']['new_chat_member']['username'];
$nfullname = ''.$nfname.' '.$nlname.'';
#################################################
$lfname = $update['message']['left_chat_member']['first_name'];
$llname = $update['message']['left_chat_member']['last_name'];
$luname = $update['message']['left_chat_member']['username'];
$reply_message = $update['message']['reply_to_message'];
$reply_message_id = $update['message']['reply_to_message']['message_id'];
$reply_message_user_id = $update['message']['reply_to_message']['from']['id'];
$reply_message_text = $update['message']['reply_to_message']['text'];
$reply_message_user_fname = $update['message']['reply_to_message']['from']['first_name'];
$reply_message_user_lname = $update['message']['reply_to_message']['from']['last_name'];
$reply_message_user_uname = $update['message']['reply_to_message']['from']['username'];
#######################################################################################
###########################CALL BACK DATA##############################################
$callback = $update['callback_query'];
$callback_id = $update['callback_query']['id'];
$callback_from_id = $update['callback_query']['from']['id'];
$callback_from_uname = $update['callback_query']['from']['username'];
$callback_from_fname = $update['callback_query']['from']['first_name'];
$callback_from_lname = $update['callback_query']['from']['last_name'];
$callback_user_data = $update['callback_query']['data'];
$callback_message_id = $update['callback_query']['message']['id'];
$cbid = $update['callback_query']['message']['chat']['id'];
$cbmid = $update['callback_query']['message']['message_id'];
$thug_chat_id = '';
$chat_id = (string)$cid;
$thug_chat_id = "-1001291062558";
$message_dump = "-1001464778576";
########################################NEEDED VARIABLES#######################
    $admin_json=[
        'chat_id'=>$cid
    ];
    $curl232 = curl_init();
    curl_setopt($curl232, CURLOPT_URL,"https://api.telegram.org/bot$tok/getChatAdministrators?");
    curl_setopt($curl232, CURLOPT_POST, 1);
    curl_setopt($curl232, CURLOPT_POSTFIELDS, $admin_json);
    curl_setopt($curl232, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl232, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl232, CURLOPT_SSL_VERIFYPEER, 0);
 $resp22 = curl_exec($curl232);
    $adms = json_decode($resp22,true);
 $total = count($adms['result']);
 $array_admin = '';
    for ($i=0; $i < $total ; $i++) { 
        $ddams = $adms['result'][$i]['user']['id'];
        $admin_id_list =  "$ddams,";
        $array_admin .= $admin_id_list;
    }
$admin_array = explode(',', $array_admin);

###############################################################################
#####################USER PERMISSION##################################################################
      $ch12 = curl_init();
curl_setopt($ch12, CURLOPT_URL, "https://api.telegram.org/bot$tok/getChatMember?chat_id=$cid&user_id=$reply_message_user_id"); 
curl_setopt($ch12, CURLOPT_POST, false); 
curl_setopt($ch12, CURLOPT_RETURNTRANSFER, 1); 
    $output212 = curl_exec($ch12);
$json122 = json_decode($output212,true);
    curl_close($ch122);
$can_send_messages =  $json122['result']['can_send_messages'];
$can_send_media_messages = $json122['result']['can_send_media_messages'];
$can_send_other_messages = $json122['result']['can_send_other_messages'];
$can_add_web_page_previews = $json122['result']['can_add_web_page_previews'];
$stato = $json122['result']['status'];
##########################################################################################

#####################################CHECK ADMIN #########################################
$admi = curl_init();
curl_setopt($admi, CURLOPT_URL, "https://api.telegram.org/bot$tok/getChatMember?chat_id=$cid&user_id=$fid"); 
curl_setopt($admi, CURLOPT_POST, false); 
curl_setopt($admi, CURLOPT_RETURNTRANSFER, 1); 
    $output2121 = curl_exec($admi);
$json1221 = json_decode($output2121,true);
    curl_close($admi);
$status = $json1221['result']['status'];
#########################################################################################
include 'modules/welcome.php';
include 'modules/ping.php';
include 'modules/logo.php';
include 'modules/dictionary.php';
include 'modules/paste.php';
include 'modules/mute.php';



$PM_START_TEXT = "<b>Hey !!</b> <a href='t.me/$uname'>$fname</a> <b>Nice To Meet You,
Well I am Rocket An Avenger For Your Group!! I Work For Everyone As The Avengers Work!!
Just Add Me In The Group And Boom I Will Always Help You As An Avenger!!</b>

<b> Click /help to Know More!! Click On Add To Group To Add Me Into Your Group </b>

<b>Have A Good Day !!</b>

<b>Cheers ✌️✌️</b>,
<b>Rocket Raccoon!!</b>
";
$ROCKET_IMAGE  = "https://snworksceo.imgix.net/car/614a86c8-405f-4fd8-b60d-93998c769661.sized-1000x1000.jpg?w=1000";
$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => '➕ Add Me To Your Group', 'url' => 't.me/RocketRaccoonRobot/?startgroup=true']
        ]
    ]
];
$encodedKeyboard = json_encode($keyboard);
if(startsWith($text,'/start')){
	if ($typ == 'private') {
		$send_start_message = [
			'chat_id'=>$cid,
			'photo'=>$ROCKET_IMAGE,
			'caption'=>$PM_START_TEXT,
			'parse_mode'=>'HTML',
			'reply_markup' => $encodedKeyboard,
			'reply_to_message_id'=>$mid
		];
		botaction("sendPhoto",$send_start_message);
		file_put_contents("php://stderr", "Bot Started By $fname");
	}
	else{
		$send_alive_message = [
			'chat_id'=>$cid,
			'text'=>'<b>I am Alive Dude !!</b>',
			'parse_mode'=>'HTML',
			'reply_to_message_id'=>$mid
		];
		botaction("sendMessage",$send_alive_message);
	}
}
welcome();
ping();
logo();
mean();
echo "HI";
