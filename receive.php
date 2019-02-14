<?php
//nnick
  $json_str = file_get_contents('php://input'); //接收request的body
  $json_obj = json_decode($json_str);

  $myfile = fopen("log.txt","w+") or die("Unable to open file"); //設定一個log.txt來印訊息
  fwrite($myfile, "\xEF\xBB\xBF".$json_str); //在字串前面加上\xEF\xBB\xBF轉成utf8格式

    $sender_userid = $json_obj->events[0]->source->userId; //取得訊息發送者的id
    $sender_txt = $json_obj->events[0]->message->text; //取得訊息內容
  
    $response = array (
        "to" => "Ud91c4d2039ede38a258409f1d06164e5",//$sender_userid,
        "messages" => array (
            array (
                "type" => "text",
                "text" => "Hello. You say". $sender_txt
            )
        )
    );
  
    fwrite($myfile, "\xEF\xBB\xBF".json_encode($response)); //在字串前面加上\xEF\xBB\xBF轉成utf8格式
    $header[] = "Content-Type: application/json";
    $header[] = "Authorization: Bearer fYSTcNaZ/hxGDOrKXK/dclPnVzHGIctM9jHPoSiW8oDXqI2nr7GnjmLE5ts43Er2QI/xjJl68eiYPG7WG243f0q2GCA8+9G0IzHRG9IpCH5uACf5vMJ2TQ4KOUJhnsgTHEBJRKW1rIaFYI2GpiznKQdB04t89/1O/w1cDnyilFU=";
    $ch = curl_init("https://api.line.me/v2/bot/message/push");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                                                   
    $result = curl_exec($ch);
    curl_close($ch);
?>
