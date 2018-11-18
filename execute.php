<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";
$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
if(strpos($text, "/start") === 0 || $text=="ciao")
{
	$response = "Ciao $firstname, benvenuto!";
}
elseif($text=="il mio nome")
{
	$response = "Stefano";
}
elseif($text=="il mio paese")
{
	$response = "Feltre";
}
elseif($text=="/webcam")
{
	$keyboard = ['inline_keyboard' => [[['text' =>  'web avena', 'url' => 'http://www.arifeltre.it/webcam/avena.jpg'],['text' =>  'web buse', 'url' => 'http://www.arifeltre.it/Cam9/webcam.jpg']]]];
        $response = "scegli la webcam";
	
}
elseif($text=="il mio cognome")
{
	$response = "Zanella";
}
else
{
	$response = "ovvero";
}
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
// imposto la inline keyboard
//$keyboard = ['inline_keyboard' => [[['text' =>  'web avena', 'url' => 'http://www.arifeltre.it/webcam/avena.jpg'],['text' =>  'web buse', 'url' => 'http://www.arifeltre.it/Cam9/webcam.jpg']]]];
if($text=="/webcam")
{
	$parameters["reply_markup"] = json_encode($keyboard, true);
}

echo json_encode($parameters);
