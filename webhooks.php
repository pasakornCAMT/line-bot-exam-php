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
							case 'hello':
								$messages = [
									'type' => 'text',
									'text' => 'hello from CTO Bot'
								];
								replyMessage($messages);
								break;
							case 'promotion':
								$flex = file_get_contents('./sample-flex/sample-flex.json');
								$messages = json_decode($flex);
								replyMessage($messages);
								break;
							case 'clothes selected':
								$flex = file_get_contents('./sample-flex/clothes-carousel.json');
								$messages = json_decode($flex);
								replyMessage($messages);
								break;
							case 'watches selected':
								$flex = file_get_contents('./sample-flex/watches-carousel.json');
								$messages = json_decode($flex);
								replyMessage($messages);
								break;
							case 'sneakers selected':
								$flex = file_get_contents('./sample-flex/sneakers-carousel.json');
								$messages = json_decode($flex);
								replyMessage($messages);
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
	}
}

function replyMessage($send){
	global $event, $access_token;
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
		'messages' => [$send],
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
echo "OK";
