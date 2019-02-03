<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'Y9u2ycTLKmjzRaqNmsXVIvtr9HIVIHdjp1cnMcDEweg4xNE+uUcO9/QZKDVq6bRZxqYX8hrwYLOiwYGfhHUFj6pJbYLEXVddaNUEk5HnoCnHpXadwfdnbRXfEoSRN1ROM8uxyB5EaghHHvA9itcVmgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		switch ($event['type']) {
			case 'message':
				switch ($event['message']['type']) {
					case 'text':
						switch ($event['message']['text']) {
							case 'switch1':
								$messages2 = [
									'type' => 'text',
									'text' => 'hello fromn swich case'
								];
								break;
							case 'switch2':
								# code...
								break;
							default:
								# code...
								break;
						}
						break;
					case 'sticker':
						# code...
						break;
					default:
					error_log("Unsupported message type: " . $event['type']);
						break;
				}
				break;
			default:
				error_log("Unsupported event type: " . $event['type']);
				break;
		}
		// Reply only when message sent is in 'text' format
		//if ($event['type'] == 'message' && $event['message']['text'] == 'profile') {
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages2],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		//}
		if ($event['type'] == 'message' && $event['message']['text'] == 'flex') {
			// Get text sent
			$text = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$flex = '
			{
				"type": "flex",
				"altText": "Flex Message",
				"contents": {
				  "type": "bubble",
				  "header": {
					"type": "box",
					"layout": "horizontal",
					"contents": [
					  {
						"type": "text",
						"text": "NEWS DIGEST",
						"size": "sm",
						"weight": "bold",
						"color": "#AAAAAA"
					  }
					]
				  },
				  "hero": {
					"type": "image",
					"url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/01_4_news.png",
					"size": "full",
					"aspectRatio": "20:13",
					"aspectMode": "cover",
					"action": {
					  "type": "uri",
					  "label": "Action",
					  "uri": "https://linecorp.com/"
					}
				  },
				  "body": {
					"type": "box",
					"layout": "horizontal",
					"spacing": "md",
					"contents": [
					  {
						"type": "box",
						"layout": "vertical",
						"flex": 1,
						"contents": [
						  {
							"type": "image",
							"url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/02_1_news_thumbnail_1.png",
							"gravity": "bottom",
							"size": "sm",
							"aspectRatio": "4:3",
							"aspectMode": "cover"
						  },
						  {
							"type": "image",
							"url": "https://scdn.line-apps.com/n/channel_devcenter/img/fx/02_1_news_thumbnail_2.png",
							"margin": "md",
							"size": "sm",
							"aspectRatio": "4:3",
							"aspectMode": "cover"
						  }
						]
					  },
					  {
						"type": "box",
						"layout": "vertical",
						"flex": 2,
						"contents": [
						  {
							"type": "text",
							"text": "7 Things to Know for Today",
							"flex": 1,
							"size": "xs",
							"gravity": "top"
						  },
						  {
							"type": "separator"
						  },
						  {
							"type": "text",
							"text": "Hay fever goes wild",
							"flex": 2,
							"size": "xs",
							"gravity": "center"
						  },
						  {
							"type": "separator"
						  },
						  {
							"type": "text",
							"text": "LINE Pay Begins Barcode Payment Service",
							"flex": 2,
							"size": "xs",
							"gravity": "center"
						  },
						  {
							"type": "separator"
						  },
						  {
							"type": "text",
							"text": "LINE Adds LINE Wallet",
							"flex": 1,
							"size": "xs",
							"gravity": "bottom"
						  }
						]
					  }
					]
				  },
				  "footer": {
					"type": "box",
					"layout": "horizontal",
					"contents": [
					  {
						"type": "button",
						"action": {
						  "type": "uri",
						  "label": "More",
						  "uri": "https://linecorp.com"
						}
					  }
					]
				  }
				}
			  }
			';
			$contents = [
				'type' => 'bubble',
				'body' => [
					'type'=> 'box',
					'layout' => 'horizontal',
					'contents' => [
						[
							'type'=> 'text',
							'text'=> 'Hello,'
						],
						[
							'type'=> 'text',
							'text'=> 'World!'
						]
					]
				]
			];
			// $messages = [
			// 	'type' => 'flex',
			// 	'altText' => 'This is a Flex Message',
			// 	'contents' => $contents
			// ];

			$messages = json_decode($flex);


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}

function replyMessage(){

}
echo "OK";
