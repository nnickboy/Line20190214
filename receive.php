<?php
//nnick
  $json_str = file_get_contents('php://input'); //接收request的body
  $json_obj = json_decode($json_str);

  $myfile = fopen("log.txt","w+") or die("Unable to open file"); //設定一個log.txt來印訊息
  fwrite($myfile, "\xEF\xBB\xBF".$json_str); //在字串前面加上\xEF\xBB\xBF轉成utf8格式

    $sender_userid = $json_obj->events[0]->source->userId; //取得訊息發送者的id
    $sender_txt = $json_obj->events[0]->message->text; //取得訊息內容
    $sender_replyToken = $json_obj->events[0]->replyToken; //取得訊息的replyToken
 
	/*quick replies
	$response = array (
		"replyToken" => $sender_replyToken,
		"messages" => array (
			array (
				"type" => "text",
				"text" => "請試用quick replies功能",
				"quickReply" => array (
					"items" => array (
						array (
							"type" => "action",
							"imageUrl" => "https://sporzfy.com/chtuser1/apple.png",
							"action" => array (
								"type" => "message",
								"label"=> "Apple",
								"text" => "這是一個Apple"
							)
						),
						array (
			    "type" => "action",
			    "imageUrl" => "https://sporzfy.com/chtuser1/placeholder.png",
			    "action" => array (
				"type" => "location",
				"label"=> "請選擇位置"
			    )
			),
			array (
			    "type" => "action",
			    "imageUrl" => "https://sporzfy.com/chtuser1/camera.png",
			    "action" => array (
				"type" => "camera",
				"label"=> "啟動相機"
			    )
			),
			array (
			    "type" => "action",
			    "imageUrl" => "https://sporzfy.com/chtuser1/picture.png",
			    "action" => array (
				"type" => "cameraRoll",
				"label"=> "啟動相簿"
			    )
						)
					)
				)	
			)
		)
	);*/

       $response = array (
        //"to" => "Ud91c4d2039ede38a258409f1d06164e5",//$sender_userid,
        "replyToken" => $sender_replyToken,
        "messages" => array (
            //array (
            //    "type" => "text",
            //    "text" => "Hello. You say". $sender_txt
            //),
            array (
                "type" => "template",
                "altText" => "this is a buttons template",
                "template" => array (
                                  "type" => "buttons",
                                  "thumbnailImageUrl" => "https://www.w3schools.com/css/paris.jpg",
                                  "title" => "Menu",
                                  "text" => "Please select",
                                  "actions" => array (
                                                  array (
                                                    "type" => "postback",
                                                    "label" => "買四季春",
                                                    //"data" => "action=buy&itemid=123"
                                                    "text" => "buy",
                                                    "data" => "buy=買四季春"
                                                  ),
                                                  array (
                                                    "type" => "message",
                                                    "label" => "買綠茶",
                                                    "text" => "line://app/1646547872-OL5gppqx"
                                                  ),
                                                  array (
                                                    "type" => "datetimepicker",
                                                    "label" => "Select date",
                                                    "data" => "storeId=12345",
                                                    "mode" => "datetime",
                                                    "initial" => "2017-12-25t00:00",
                                                    "max" => "2018-01-24t23:59",
                                                    "min" => "2017-12-25t00:00"
                                                  )
                                            )
                                  )
                )
        )
    );

/* flex
$msg_json = '{
                "type": "bubble",
                "hero": {
                  "type": "image",
                  "url": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS9HTfJiHWjVp8D8V0Z9lvl38KxtzF7qpjCMpMBl-G_ZezJhpf6",
		  "size": "full",
                  "aspectRatio": "20:13",
                  "aspectMode": "cover",
                  "action": {
                    "type": "uri",
                    "label": "Line",
                    "uri": "https://linecorp.com/"
                  }
                },
                "body": {
                  "type": "box",
                  "layout": "vertical",
                  "contents": [
                    {
                      "type": "text",
                      "text": "Brown Cafe",
                      "size": "xl",
                      "weight": "bold"
                    },
                    {
                      "type": "box",
                      "layout": "baseline",
                      "margin": "md",
                      "contents": [
                        {
                          "type": "icon",
                          "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png",
                          "size": "sm"
                        },
                        {
                          "type": "icon",
                          "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png",
                          "size": "sm"
                        },
                        {
                          "type": "icon",
                          "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png",
                          "size": "sm"
                        },
                        {
                          "type": "icon",
                          "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gold_star_28.png",
                          "size": "sm"
                        },
                        {
                          "type": "icon",
                          "url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/review_gray_star_28.png",
                          "size": "sm"
                        },
                        {
                          "type": "text",
                          "text": "4.0",
                          "flex": 0,
                          "margin": "md",
                          "size": "sm",
                          "color": "#999999"
                        }
                      ]
                    },
                    {
                      "type": "box",
                      "layout": "vertical",
                      "spacing": "sm",
                      "margin": "lg",
                      "contents": [
                        {
                          "type": "box",
                          "layout": "baseline",
                          "spacing": "sm",
                          "contents": [
                            {
                              "type": "text",
                              "text": "Place",
                              "flex": 1,
                              "size": "sm",
                              "color": "#AAAAAA"
                            },
                            {
                              "type": "text",
                              "text": "Here , 前鎮區, Kaohsiung, TW",
                              "flex": 5,
                              "size": "sm",
                              "color": "#0C29C8",
                              "wrap": true
                            }
                          ]
                        },
                        {
                          "type": "box",
                          "layout": "baseline",
                          "spacing": "sm",
                          "contents": [
                            {
                              "type": "text",
                              "text": "Time",
                              "flex": 1,
                              "size": "sm",
                              "color": "#AAAAAA"
                            },
                            {
                              "type": "text",
                              "text": "10:00 - 22:00",
                              "flex": 5,
                              "size": "sm",
                              "color": "#E83B3B",
                              "wrap": true
                            }
                          ]
                        }
                      ]
                    }
                  ]
                },
                "footer": {
                  "type": "box",
                  "layout": "vertical",
                  "flex": 0,
                  "spacing": "sm",
                  "contents": [
                    {
                      "type": "button",
                      "action": {
                        "type": "uri",
                        "label": "CALL",
                        "uri": "https://linecorp.com"
                      },
                      "height": "sm",
                      "style": "link"
                    },
                    {
                      "type": "button",
                      "action": {
                        "type": "uri",
                        "label": "WEBSITE",
                        "uri": "https://linecorp.com"
                      },
                      "height": "sm",
                      "style": "link"
                    },
                    {
                      "type": "spacer",
                      "size": "sm"
                    }
                  ]
                }
              }';
  	$response = array (
		"replyToken" => $sender_replyToken,
		"messages" => array (
			array (
				"type" => "flex",
				"altText" => "This is a Flex Message",
				"contents" => json_decode($msg_json)
			)
		)
  	);
  */
    fwrite($myfile, "\xEF\xBB\xBF".json_encode($response)); //在字串前面加上\xEF\xBB\xBF轉成utf8格式
    $header[] = "Content-Type: application/json";
    $header[] = "Authorization: Bearer fYSTcNaZ/hxGDOrKXK/dclPnVzHGIctM9jHPoSiW8oDXqI2nr7GnjmLE5ts43Er2QI/xjJl68eiYPG7WG243f0q2GCA8+9G0IzHRG9IpCH5uACf5vMJ2TQ4KOUJhnsgTHEBJRKW1rIaFYI2GpiznKQdB04t89/1O/w1cDnyilFU=";
    $ch = curl_init("https://api.line.me/v2/bot/message/reply");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));                                                                  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);                                                                                                   
    $result = curl_exec($ch);
    curl_close($ch);
?>
