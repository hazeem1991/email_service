# Email Micro Service

### Getting Started
This Microservice  for sending emails on the . env file tow mail providers are defined 
you can add as you want but you should add the source code How ? let me tell you

### Installing
to install this microservice system need to have only docker docker-compose 
```$xslt
git clone https://github.com/hazeem1991/emai_service.git
```
after Cloning move to this folder ``./emaildock``and run this command 
```
docker-compose up --build -d mysql workspace php-fpm nginx
```
and then run the bash.sh file  
#### API endpoints
* add provider account `email_provider/add`
* edit provider account `email_provider/edit/1`
* list provider accounts `email_provider/`
* list the email log `logs/`
* list the sent messages `messages/`
* list the sent messages `messages/add`  
more will be on the api.json file that describe the api  
#### Front-end App
http://localhost or  the ip that the machine bind  with  
will serve the vue js app to view logs , list messages and add new messages
#### Artisan Command  
system can send message by command  
```
artisan sendmail 'sender@mail.com' 'recipent@mail.com' 'Subject' 'Body'  
```
 ## How it work ?
 this microservice will run a job each time you add a new message  
 this job will take providers account and sort them by priority that provided during creation  
 and start trying to send the message  
 - when successes will set the message status as sent  
 - when error wil try the next provider  
 - when all fails the job will fail  
 ## Is it Extendable  ?
 it is so easy to extend because the code for sending is following the solid principle  
 to add a new type off providers you just add it to the `.env` file   
  in this key MAIL_PROVIDERS secreted by `,` comma  
  and in this folder `App\Http\Libraries\EmailSenders` create a folder for the new sender 
  and implement the `Miler` and `MailerResult` interfaces  
  add the new provider to the factory `MailerFactory`  
  and now the new factory will work 
  #### More Info
  for more information please contact me at my email hazeem.arian@gmail.com  
  or [Hazem Arian](https://www.linkedin.com/in/hazem-arian-467b4183/) - Linkedin Profile
  
  
  
 
