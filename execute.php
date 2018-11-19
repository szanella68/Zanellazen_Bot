<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit; 
}
$message = isset($update['message']) ? $update['message'] : "";
$query = isset($update['callback_query']) ? $update['callback_query'] : "";
$querymessage = isset($query['message']['text']) ? $query['message']['text'] : "";
$queryid =  isset($query['id']) ? $query['id'] : "";
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
$parameters = '';
	$parameters["method"] = "answerCallbackQuery";
	$parameters = array('callback_query_id' => $queryid);
	echo json_encode($parameters);
$parameters = '';

if(strpos($text, "/start") === 0 || $text=="ciao" || $text=="gino" )
{	
	$response = "Ciao , benvenuto! Vai con /help per elenco opzioni";
	
}
elseif(strpos($text, "/elenco") === 0)
{
	$response = "Stefano Zanella, Silvia Darugna, Matteo Zanella, Nicola Zanella";
}
elseif(strpos($text, "/help") === 0)
{
	$response = "/help per questo help, /elenco per l'elenco famigliari, /codfiscale  per il codice fiscale,
	/datanascita per le date di nascita, /webcam per l'elenco webcam,";
}
elseif(strpos($text, "/codfiscale") === 0)
{ 
	$keyboard = ['inline_keyboard' => [[['text' =>  'stefano', 'callback_data' => 'ZNLSFN68M06D530E'],
					    ['text' =>  'silvia', 'callback_data' => 'DRGSLV71H57D530D'],
					    ['text' =>  'matteo', 'callback_data' => 'ZNLMTT99B26D530W'],
					    ['text' =>  'nicola', 'callback_data' => 'ZNLNCL03E08D530R']]]];
        $response = "seleziona il nome per avere il codice fiscale";
	$parameters["reply_markup"] = json_encode($keyboard, true);
}
elseif(strpos($text, "/datanascita") === 0)
{ 
	$keyboard = ['inline_keyboard' => [[['text' =>  'stefano','callback_data' => '06-08-1968'],
					    ['text' =>  'silvia', 'callback_data' => '17-06-1971'],
					    ['text' =>  'matteo', 'callback_data' => '26-02-1999'],
					    ['text' =>  'nicola', 'callback_data' => '08-05-2003']]]];
        $response = "seleziona il nome per avere la data di nascita";
	$parameters["reply_markup"] = json_encode($keyboard, true);
}
elseif(strpos($text, "stefano") === 0)
{ 
		$response = "ZNLSFN68M06D530E";
}
elseif(strpos($text, "silvia") === 0)
{
	$response = "DRGSLV71H57D530D";
}
elseif(strpos($text, "matteo") === 0)
{
	$response = "ZNLMTT99B26D530W";
}
elseif(strpos($text, "nicola") === 0)
{
	$response = "ZNLNCL03E08D530R";
}
elseif(strpos($text, "/xxxx") === 0)
{	
	$response = "IW3GIM";
}
elseif(strpos($text, "/yyyy") === 0)
{
	$response = "xxxx";
}
elseif(strpos($text, "/zzzz") === 0)
{
	$response = "IZ3FLG";
}
elseif(strpos($text, "/webcam") === 0)
{
	$keyboard = ['inline_keyboard' => [[['text' =>  'telva', 'url' => 'http://www.arifeltre.it/Cam6/webcam.jpg'],
					    ['text' =>  'pedavena', 'url' => 'http://www.arifeltre.it/Cam/webcam.jpg'],
					    ['text' =>  'avena', 'url' => 'http://www.arifeltre.it/Cam8/webcam.jpg'],
					    ['text' =>  'piste avena', 'url' => 'http://www.arifeltre.it/webcam/avena.jpg'],
					    ['text' =>  'buse', 'url' => 'http://www.arifeltre.it/Cam9/webcam.jpg'],
					    ['text' =>  'tomatico', 'url' => 'http://www.arifeltre.it/Cam1/webcam.jpg'],
					    ['text' =>  'fiere', 'url' => 'http://www.arifeltre.it/Cam4/image/camera1.jpg']]]];
        $response = "scegli la webcam";
	$parameters["reply_markup"] = json_encode($keyboard, true);
}
else 
{
	$response = "$$$";
}
if ($response == "$$$")
{}
else
{
$response = strtolower($text);
$parameters = array('chat_id' => $chatId, "text" => $response);	
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
}
