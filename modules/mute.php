<?php
function mute(){
	global $mid;
	global $cid;
	global $tok;
	global $text;
	global $reply_message;
	global $reply_message_user_id;
	global $reply_message_user_uname;
	global $reply_message_user_fname;
	global $admin_array;
	global $status;
	global $stato;
	global $can_send_messages;


if(startsWith($text,'/mute')){
  if (!in_array('1428124129', $admin_array)) {
      $i_am_not = [
          'chat_id'=>$cid,
          'text'=>'I am Not Admin To Mute And Unmute Members !!',
          'reply_to_message_id'=>$mid
      ];
      botaction("sendMessage",$i_am_not);
  }
  else{
      $res = str_replace("/mute", "", $text);
      if ($res == '') {
          $mute  = "<b>Silence Now...🤫🤫\n<a href='t.me/$reply_message_user_uname'>$reply_message_user_fname</a> Is Muted...🤐🔇</b>";
      }
      else{
          $mute = "<b>Silence Now...\n<a href='t.me/$reply_message_user_uname'>$reply_message_user_fname</a> Is Muted...🤐🔇\nReason => <i>$res</i></b>";
      }
      if ($reply_message) {
          if (in_array($reply_message_user_id, $admin_array)) {
      $no_cant = [
          'chat_id'=>$cid,
          'reply_to_message_id'=>$mid,
          'parse_mode'=>'HTML',
          'text'=>"<b> How High Are You To Mute An Admin</b>"
      ];
          botaction("sendMessage",$no_cant);
  }
  elseif($reply_message_user_id == '1428124129'){
      $no_cant_ever = [
          'chat_id'=>$cid,
          'reply_to_message_id'=>$mid,
          'parse_mode'=>'HTML',
          'text'=>"<b>Have U became So Big To Mute Me??? Just Be In Your Limits</b>"
      ];
          botaction("sendMessage",$no_cant);
  }
          elseif($status == 'creator' || $status == 'administrator'){
          if (is_null($can_send_messages) or $can_send_messages == '1') { # code
              $muting_member = [
              'chat_id'=>$cid,
              'user_id'=>$reply_message_user_id,
              'can_send_messages'=>'False'
          ];
          botaction("restrictChatMember",$muting_member);
          $mute_message = [
          'chat_id'=>$cid,
          'reply_to_message_id'=>$mid,
          'parse_mode'=>'HTML',
          'disable_web_page_preview'=>'True',
          'text'=>"$mute"
          ];
          botaction("sendMessage",$mute_message);
  }
          else{
              $user_is_muted = [
              'chat_id'=>$cid,
              'text' => "<b>There Is already a Cheese Burger 🍔 in his Mouth 😁.. \n[<i>User Is Already Muted</i>]</b>",
              'parse_mode'=>'HTML',
              'reply_to_message_id'=>$mid,
                  ];
              botaction("sendMessage",$user_is_muted);
                          }

          }


          else{
          $who1 = [
              'chat_id'=>$cid,
              'reply_to_message_id'=>$mid,
              'caption'=>"<b>Who The Hell Are You !! Only Admins Are Allowed To Perform This Action..\nWant A Infinity Snap ??🤜</b>",
              'parse_mode'=>'HTML',
              'video'=>'https://s2.gifyu.com/images/ezgif.com-gif-maker93d51c6b80ca89ad.gif',
          ];
          botaction("sendVideo",$who1);
          }   

  }
  else{
      $no_reply = [
              'chat_id'=>$cid,
              'reply_to_message_id'=>$mid,
              'parse_mode'=>'HTML',
              'text'=>"<b>Is He A user??? Reply To A User's Message To Mute Him</b>"
          ];
          botaction("sendMessage",$no_reply);
  }
  }
}
}
mute();
?>