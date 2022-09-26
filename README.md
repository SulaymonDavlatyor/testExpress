Telegram api 

Used to send messages to contacts as User (not as bot ) by sending list of messages and contact's nickanme ( @some_contact) to certain api route.  
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

What would I change here ? 
I would make 2fa auth in a better way, add queues, and probably research more about Telegram MTProtocol in order to prevent errors of find better ways to accomplish my goals. 

P.S At the moment I think that this service was meant to work with telegram bot. But when I started, there were no words about bot in technical requirements , so I thought that it was about sending message as user.  Just wanted to mention that this one sends messages as user. If its crucial, I can remake it to send messages as bot.
