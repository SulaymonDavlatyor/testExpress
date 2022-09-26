Telegram api 
Used to send messages to contacts as User (not bot ) by sending list of messages and contact's nickanme ( @some_contact) to certain api route.  
Route is /api/telegram. 
Send -  ['message' => [ 'row' , 'of' , 'messages'] , 'peer' => '@some_contact' ];
But first you need to login . To do that , you need to go to https://my.telegram.org/auth.  There you will get api_id and api_hash . 
In order to login , you need to make a request  
{ 
api_id: ,
api_hash: ,
phone_number: 
} 
After that  you will get a code in telegram.  You need to create custom header 'TelegramToken' and put your code there , thats it , now you can write messages through this api to your friends or anybody else as user
