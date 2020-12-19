<?php
function logo(){
	global $mid;
	global $cid;
	global $tok;
	global $text;
if (startsWith($text,'/logo')) {
        ########LINKSIND##########
    $font_genarate_text1 = str_replace('/logo', "", $text);
    $font_genarate_text = str_replace(' ', "", $font_genarate_text1);
    if ($font_genarate_text == '') {
        $send_error = [
            'chat_id'=>$cid,
            'reply_to_message_id'=>$mid,
            'parse_mode'=>'HTML',
            'text'=>"<b>Please Give Me Some Text For Generating Dude..</b>"
        ];
        botaction("sendMessage",$send_error);
 }
 else{
$font_list = array("https://www.linksind.net/tigerzindahai/spyder.php?name=$font_genarate_text&back=style2.jpg","https://linksind.net/arjunreddy/spyder.php?name=$font_genarate_text&back=style1.jpg","https://www.linksind.net/robo/spyder.php?name=$font_genarate_text&back=5.jpg","https://linksind.net/maari/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/cskjersey/spyder.php?name=$font_genarate_text&back=style1.jpg","https://www.linksind.net/padmavati/spyder.php?name=$font_genarate_text&back=style6.jpg","http://moviefontgenerator.com/krack/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/dhonicdp/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/radheshyam/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/kohlijersey/spyder.php?name=$font_genarate_text&back=style1.jpg","https://linksind.net/gangleader/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/baitikochichusthey/spyder.php?name=$font_genarate_text&back=default.jpg","https://linksind.net/adipurush/spyder.php?name=$font_genarate_text&back=default.jpg","
https://linksind.net/rrr/spyder.php?name=$font_genarate_text&back=style1.jpg");

        $font = $font_list[mt_rand(0,13)];

        $send_photo = [
        'chat_id' => ''.$cid.'',
        'caption' => '<b>Your Logo Is Generated Successfully....</b>',
        'parse_mode' => 'HTML',
        'reply_to_message_id'=>''.$mid.'',
        'photo'=>"$font"
    ];
    botaction("sendPhoto",$send_photo);
    }
 }

}
?>