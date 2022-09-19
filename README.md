Setting Up this app in new environment
Step 1: Clone the repo and run "composer install" to set up dependencies. 
Step 2: Create your data base and connect to it
Step 3: Run userseed on the terminal to seed the database with users
Step 4: Navigate to user table in the dabase, on the "access" column make two or tree users "agents" DO THIS WITH USERS WITH ID 2 AND 3- MAKE THEM AGENTS - TRANSACTION SEED DEPEND ON THOSE ID, make another two users "admin" 
Step 5: Run settingseeder
Step 6: Run transactionseeder

Login.



1. Admin can now create new agents and see existing ones
1a. The next is to activate the action buttons

2. Admin db notification generated

4. Deposit/Withdrawal table ready

Login guide

    User  
    -Login Url: https://domainname/login 
    -Rgister Url: https://domainname/register 

    Channel
    -Login Url: https://domainname/channel/login 
    -Rgister Url: https://domainname/channel/register 

    Admin
    -Login Url: https://domainname/admin/login 
    -Rgister Url: https://domainname/admin/register 

 Domingo Api Docs

    To Register an Admin
    - Make a post request to this endpoint
    url: 'https://domainname/api/admin/register',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Body:
        {
            "name": " ",
            "username": " ",
            "email": " ", 
            "password": " ",
            "password_confirmation": " "
        }

    To Register A Channel
    - Make a post request to this endpoint
    url: 'https://domainname/api/channel/register',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Body:
        {
            "name": " ",
            "username": " ",
            "email": " ", 
            "password": " ",
            "password_confirmation": " "
        }

    To Login as an Admin
    - Make a post request to this endpoint
    url: 'https://domainname/api/admin/login',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Body:
        {
            "email": " ", 
            "password": " ",
        }

    To Login as a Channel
    - Make a post request to this endpoint
    url: 'https://domainname/api/channel/login',
    Headers: 'Accept: application/json',
    Body:
        {
            "email": " ", 
            "password": " ",
        }

    To Logout
    - Make a post request to this endpoint
    url: 'https://domainname/api/logout'
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --AuthenticatedUserToken',

    
    Forgot Password
    - Make a post request to this endpoint
    url: 'https://domainname/api/forgot-password',
    Headers: 'Accept: application/json',
    Method: 'POST',
    Body:
        {
            "email": " ",
        }

    To Reset Password
    - Make a post request to this endpoint
    url: 'https://domainname/api/reset-password',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Body:
        {
            "token": " ",
            "email": " ",
            "password": " ",
            "password_confirmation": " " 
        }

    For Admin to Create new Channel
    - Make a post request to this endpoint
    url: 'https://domainname/api/admin/channel/create',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --AuthenticatedUserToken',
    Body:
        {
            "name": " ",
            "username": " ",
            "email": " ",
            "mobile": " ",
            "gender": " ",
            "password": " ",
            "password_confirmation": " ",
            "description": " ",
        }


    For Admin to Read all Channels
    - Make a get request to this endpoint
    url: 'https://domainname/api/admin/channels',
    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --AuthenticatedUserToken',


    Configure MAIL_MAILER in .env file to let Forget Password & Reset Password to work
