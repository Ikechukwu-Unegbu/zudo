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

## Login guide

    ### User  
    -Login Url: https://domainname/login 
    -Rgister Url: https://domainname/register 

    ### Channel
    -Login Url: https://domainname/channel/login 
    -Rgister Url: https://domainname/channel/register 

    ### Admin
    -Login Url: https://domainname/admin/login 
    -Rgister Url: https://domainname/admin/register 

 # Domingo Api Docs

   ## To Register an Admin
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
    Success Response: 
        {
            "message": "Admin Created Successfully",
            "user": {
                "name": "Emmanuel",
                "fullname": "Emmanuel Ade",
                "email": "emmanuel@gmail.com",
                "access": "admin",
                "updated_at": "2022-09-20T17:58:06.000000Z",
                "created_at": "2022-09-20T17:58:06.000000Z",
                "id": 1
            },
            "token": "11|OyTkILfqOpXMc8rwsopWffwSVUPlBPCIhCu3AU7B"
        }
    Validation Response:
        {
            "status": false,
            "message": "validation error",
            "errors": {
                "name": [
                    "The name field is required."
                ],
                "username": [
                    "The username field is required.",
                    "The username has already been taken."
                ],
                "email": [
                    "The username field is required.",
                    "The email has already been taken."
                ],
                "password": [
                    "The password field is required."
                ],
                "password_confirmation": [
                    "The password confirmation field is required."
                ]
            }
        }

    ## To Register A Channel
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
    Success Response:
    {
            "message": "Channel Created Successfully",
            "user": {
                "name": "Emmanuel",
                "fullname": "Emmanuel Ade",
                "email": "ade@gmail.com",
                "access": "channel",
                "updated_at": "2022-09-20T18:04:07.000000Z",
                "created_at": "2022-09-20T18:04:07.000000Z",
                "id": 2
            },
            "token": "12|tYhES63D73mjdnj1UHa1dX2AOPo5KBjfWOuhzsr6"
    }
    
    Validation Response:
        {
            "status": false,
            "message": "validation error",
            "errors": {
                "name": [
                    "The name field is required."
                ],
                "username": [
                    "The username field is required.",
                    "The username has already been taken."
                ],
                "email": [
                    "The username field is required.",
                    "The email has already been taken."
                ],
                "password": [
                    "The password field is required."
                ],
                "password_confirmation": [
                    "The password confirmation field is required."
                ]
            }
        }

##    To Login as an Admin
    - Make a post request to this endpoint
    url: 'https://domainname/api/admin/login',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Body:
        {
            "email": " ", 
            "password": " ",
        }

    Success Response:
    {
        "status": true,
        "message": "User Logged In Successfully",
        "username": "Emmanuel",
        "access": "admin",
        "token": "13|51CChbhQJCADG7HfGN1GyrL9SL4wLNrrU0Jn9vcL"
    }

    Validation Response:
        {
            "status": false,
            "message": "validation error",
            "errors": {
                "email": [
                    "The email field is required."
                ],
                "password": [
                    "The password field is required."
                ]
            }
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
    
    Success Response:
        {
            "status": true,
            "message": "User Logged In Successfully",
            "username": "Emmanuel",
            "access": "channel",
            "token": "13|51CChbhQJCADG7HfGN1GyrL9SL4wLNrrU0Jn9vcL"
        }
        
    Validation Response:
        {
            "status": false,
            "message": "validation error",
            "errors": {
                "email": [
                    "The email field is required."
                ],
                "password": [
                    "The password field is required."
                ]
            }
        }

 ##   To Logout
    - Make a post request to this endpoint
    url: 'https://domainname/api/logout'
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    Success Response: 
        {
            "message": "User Logged out Successfully"
        }

    
   ## Forgot Password
    - Make a post request to this endpoint
    url: 'https://domainname/api/forgot-password',
    Headers: 'Accept: application/json',
    Method: 'POST',
    Body:
        {
            "email": " ",
        }

    Success Response:
        {
            "status": "We have emailed your password reset link!"
        }

    Validation Response: 
        {
            "message": "The email field is required.",
            "errors": {
                "email": [
                    "The email field is required."
                ]
            }
        }

##    To Reset Password
    - Make a post request to this endpoint
    url: 'https://domainname/api/reset-password',
    Method: 'POST',
    Headers: 'Accept: application/json',

    Token Response From Mail = "http:/domainname/reset-password/81b76e1c3b6d5f97688230479498137753ad0605fa1810e3d8cbb85af19912a8?email=adegmail.com";

    Body:
        {
            "token": "81b76e1c3b6d5f97688230479498137753ad0605fa1810e3d8cbb85af19912a8",
            "email": " ",
            "password": " ",
            "password_confirmation": " " 
        }


    Success Response:
        {
            "message": "Password reset Successfully"
        }

    Validation Response:
        {
            "message": "The token field is required. (and 2 more errors)",
            "errors": {
                "token": [
                    "The token field is required."
                ],
                "email": [
                    "The email field is required."
                ],
                "password": [
                    "The password field is required."
                ]
            }
        }

##    For Admin to Create new Channel
    - Make a post request to this endpoint
    url: 'https://domainname/api/admin/channel/create',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    Body:
        {
            "name": " ",
            "username": " ",
            "email": " ",
            "mobile": " ",
            "gender": "Male or Female",
            "password": " ",
            "password_confirmation": " ",
            "description": " ",
        }

    Success Response:
        {
            "message": "Channel Created Successfully",
            "user": {
                "fullname": "Channel",
                "name": "channel",
                "email": "channel@gmail.com",
                "phone": "09009090909",
                "gender": "Male",
                "channel_description": "Channel",
                "access": "channel",
                "updated_at": "2022-09-20T18:25:09.000000Z",
                "created_at": "2022-09-20T18:25:09.000000Z",
                "id": 3
            },
            "token": "15|fvW6k088pNnkqWC6AM66wBWjT448TDPoEczWuCnA"
        }

    Validation Response: 
        {
            "status": false,
            "message": "validation error",
            "errors": {
                "name": [
                    "The name field is required."
                ],
                "username": [
                    "The username field is required."
                ],
                "email": [
                    "The email field is required."
                ],
                "mobile": [
                    "The mobile field is required."
                ],
                "gender": [
                    "The gender field is required."
                ],
                "password": [
                    "The password field is required."
                ],
                "password_confirmation": [
                    "The password confirmation field is required."
                ],
                "description": [
                    "The description field is required."
                ]
            }
        }


##    For Admin to Read all Channels
    - Make a get request to this endpoint
    url: 'https://domainname/api/admin/channels',
    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

    Success Response:
        {
            "channels": [
                {
                    "id": 3,
                    "name": "channel",
                    "email": "channel@gmail.com",
                    "email_verified_at": null,
                    "created_at": "2022-09-20T18:25:09.000000Z",
                    "updated_at": "2022-09-20T18:25:09.000000Z",
                    "channel_id": null,
                    "gender": "male",
                    "phone": "09009090909",
                    "bvn": null,
                    "avatar": null,
                    "fullname": "Channel",
                    "channel_description": "Channel",
                    "access": "channel",
                    "deleted_at": null
                },
                {
                    "id": 2,
                    "name": "Emmanuel",
                    "email": "emmanuel@gmail.com",
                    "email_verified_at": null,
                    "created_at": "2022-09-20T18:04:07.000000Z",
                    "updated_at": "2022-09-20T18:04:07.000000Z",
                    "channel_id": null,
                    "gender": null,
                    "phone": null,
                    "bvn": null,
                    "avatar": null,
                    "fullname": "Emmanuel Ade",
                    "channel_description": null,
                    "access": "channel",
                    "deleted_at": null
                }
            ]
        }

 ##   User Assigned to Channel
    - Make a get request to this endpoint
    url: 'https://domainname/api/channel/user/assign',
    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    Response: 
        {
            "id": 16,
            "name": "Doe",
            "email": "janedoe@gmail.com",
            "email_verified_at": null,
            "created_at": "2022-09-24T02:34:15.000000Z",
            "updated_at": "2022-09-24T02:34:15.000000Z",
            "channel_id": 6,
            "gender": null,
            "phone": "09099009900",
            "bvn": null,
            "avatar": "null",
            "fullname": "Jane Doe",
            "channel_description": null,
            "access": "user",
            "deleted_at": null
        }

   ## For Channel to get Contribution
    - Make a get request to this endpoint
    url: 'https://domainname/api/channel/deposit',
    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    Response: 
        {
            "id": 196,
            "customer_id": 16,
            "agent_id": "6.00",
            "trx_type": 1,
            "amount": "80.00",
            "purpose": "contribution",
            "sync": "0",
            "deleted_at": null,
            "created_at": "2022-09-24T03:03:12.000000Z",
            "updated_at": "2022-09-24T03:03:12.000000Z",
            "approved": 0,
            "withdraw_type": null,
            "initiated_by": null
        }
    
## For Channel to create contribution/debit for user Assigned to the channel
    - Make a post request to this endpoint
    url: 'https://domainname/api/channel/deposit/create',
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

    NB: use this URL  ([url => 'https://domainname/api/channel/user/assign', Method => GET]) to select the id of the user while selecting user to make deposit/contribution.

    Body:
        {
            "amount": " ",
            "userId": " ",
            "purpose": " "
        }

    
    Validation Response:
        "status": false,
        "message": "validation error",
        "errors": {
            "amount": [
                "The amount field is required."
            ],
            "userId": [
                "The user id field is required.",
                "The user id must be an integer."
            ]
        }

    Success Response: 
        {
            "message": "Contribution/Debit Created Successfully",
            "amount": "100000",
            "user": "Jane Doe",
            "purpose": "Contribution"
        }


    Configure MAIL_MAILER in .env file to let Forget Password & Reset Password to work
