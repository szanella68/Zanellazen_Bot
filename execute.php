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
 
$query = isset($update['callback_query']) ? $update['callback_query'] : "";
$queryid =  isset($query['id']) ? $query['id'] : "";
$queryUserId =  isset($query['from']['id']) ? $query['from']['id'] : "";
$queryusername =  isset($query['from']['username']) ? $query['from']['username'] : "";
$querydata =  isset($query['data']) ? $query['data'] : "";
$querymsgid =  isset($query['message']['message_id']) ? $query['message']['message_id'] : "";

$inlinequery = isset($update['inlinequery']) ? $update['inlinequery'] : "";
$inlineid =  isset($inlinequery['id']) ? $inlinequery['id'] : "";
$inlineUserId =  isset($inlinequery['from']['id']) ? $inlinequery['from']['id'] : "";
$inlinequerydata =  isset($inlinequery['query']) ? $inlinequery['query'] : "";
//$parameters = '';


header("Content-Type: application/json");

$text = trim($text);
$text = strtolower($text);


if(strpos($text, "/start") === 0 || $text=="ciao" || $text=="gino" )
{	
	//$response = "Ciao , benvenuto! Vai con /help per elenco opzioni";
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
	$keyboard = ['inline_keyboard' => [[['text' =>  'stefanocf', 'callback_data' => 'ZNLSFN68M06D530E'],
					    ['text' =>  'silviacf', 'callback_data' => 'DRGSLV71H57D530D'],
					    ['text' =>  'matteocf', 'callback_data' => 'ZNLMTT99B26D530W'],
					    ['text' =>  'nicolacf', 'callback_data' => 'ZNLNCL03E08D530R']]]];
        $response = "seleziona il nome per avere il codice fiscale";
}
elseif(strpos($text, "/datanascita") === 0)
{ 
	$keyboard = ['inline_keyboard' => [[['text' =>  'stefanodn','callback_data' => '06-08-1968'],
					    ['text' =>  'silviadn', 'callback_data' => '17-06-1971'],
					    ['text' =>  'matteodn', 'callback_data' => '26-02-1999'],
					    ['text' =>  'nicoladn', 'callback_data' => '08-05-2003']]]];
        $response = "seleziona il nome per avere la data di nascita";
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
	
}
else 
{
	 $response = "scelta neutra";
}

//if(isset($message))
//{ if(isset($text)) { $response = "testo not nul"; } else { $response = "testo is null"; } }
//else {  $response = "message is null"; }

 if($querydata == "ZNLSFN68M06D530E"){
   $response = "querydata stefanocf  ZNLSFN68M06D530E";
 }

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
if(strpos($text, "/codfiscale") === 0 || strpos($text, "/datanascita") === 0 || strpos($text, "/webcam") === 0)
{
$parameters["reply_markup"] = json_encode($keyboard, true);
}
echo json_encode($parameters);
