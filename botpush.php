<?php



require "vendor/autoload.php";

$access_token = 'Y9u2ycTLKmjzRaqNmsXVIvtr9HIVIHdjp1cnMcDEweg4xNE+uUcO9/QZKDVq6bRZxqYX8hrwYLOiwYGfhHUFj6pJbYLEXVddaNUEk5HnoCnHpXadwfdnbRXfEoSRN1ROM8uxyB5EaghHHvA9itcVmgdB04t89/1O/w1cDnyilFU=';

$channelSecret = '75c03f392f6e53d662d6f5a8db9e421f';

$pushID = 'U7ef7a449f2a5c2057eacfc02ba2eb286';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







