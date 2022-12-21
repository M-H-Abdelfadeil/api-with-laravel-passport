<p align="center"><img src="data-readme/logo.jpeg" alt="Logo"></p>


## Album Task Require 

- PHP 8.1

## Album Task Run 

- git clone https://github.com/M-H-Abdelfadeil/api-with-laravel-passport.git
- copy file .env.example to .env 
- create database and set data server , database name in file  .env
- composer install 
- php artisan key:generate
- php artisan migrate
- php artisan storage:link
- php artisan serve 


## Tools  

- PHP 
- Laravel 
- Laravel passport


## Routes
| Action       | Route                                       | METHOD         | Data                     | Auth             | Response Data          |
|--------------|---------------------------------------------|----------------|--------------------------|------------------|------------------------|
| Register     | {{URL}}/api/v1/register                     | POST           | name ,  email , password | NO               | token , user data      |
| Login        | {{URL}}/api/v1/login                        | POST           | email , password         | NO               | token , user data      |
| get posts    | {{URL}}/api/v1/posts                        | GET            |                          | bearer {{TOKEN}} | posts data             |
| create post  | {{URL}}/api/v1/posts                        | POST           | title ,  description     | bearer {{TOKEN}} | post data              |
| update post  | {{URL}}/api/v1/posts/{post_id}              | PATCH \|\| PUT | title , description      | bearer {{TOKEN}} | post data after update |
| delete post  | {{URL}}/api/v1/posts/{post_id}              | DELETE         |                          | bearer {{TOKEN}} |                        |
| get trashed  | {{URL}}/api/v1/posts/trashed                | GET            |                          | bearer {{TOKEN}} | posts trashed data     |
| restore      | {{URL}}/api/v1/posts/restore/{post_id}      | POST           |                          | bearer {{TOKEN}} |                        |
| force delete | {{URL}}/api/v1/posts/force-delete/{post_id} | DELETE         |                          | bearer {{TOKEN}} |                        |


## DOCS (Route Details)
 
https://documenter.getpostman.com/view/14176662/2s8Z6u3uSB
