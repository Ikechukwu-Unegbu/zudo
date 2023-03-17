## Fetching users 
    This endpiont will fetch paginated users for the logged in channel. And all users if the person using the app is admin. All you have to do is to append the logged in user id - back end will check if it is channel or admin

    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    URL: domain.com/api/users/{channel_id}

#### Success response 
    [
        {
            "id": 11,
            "name": "Katrine Dickens Jr.",
            "email": "hartmann.jaydon@example.net",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "802.474.0822",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null,
            "wallet": {
                "id": 11,
                "user_id": 11,
                "balance": "10500.00",
                "created_at": "2022-11-25T13:57:26.000000Z",
                "updated_at": "2022-11-25T13:57:26.000000Z"
            }
        },
        {
            "id": 4,
            "name": "Elda Lockman",
            "email": "nhowe@example.org",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "(917) 333-2709",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null,
            "wallet": {
                "id": 4,
                "user_id": 4,
                "balance": "9100.00",
                "created_at": "2022-11-25T13:57:26.000000Z",
                "updated_at": "2022-11-25T15:30:53.000000Z"
            }
        },
        {
            "id": 3,
            "name": "Marlee Rice",
            "email": "user@user.com",
            "email_verified_at": "2022-11-25T06:55:02.000000Z",
            "created_at": "2022-11-25T06:55:02.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "(727) 577-8433",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "channel",
            "deleted_at": null,
            "wallet": {
                "id": 3,
                "user_id": 3,
                "balance": "10500.00",
                "created_at": "2022-11-25T13:57:26.000000Z",
                "updated_at": "2022-11-25T13:57:26.000000Z"
            }
        }
    ]


## Searching User
<img src="docasset\search.jpg"/>
    When a channel search user, the search is "channel", only users under him will be searched
    When the person is "admin" all users will be searched. Backend takes care of determining who is searching

    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    URL: domain.com/api/search/user/{view_id}

    {view_id} is placeholder for channel or admin id
**In the image above there are two input fields. One should have name attribute of keyword and the order keyid. This to enable either searching a user with his id e.g 34 or his name e.g EMeka. Only one has to be filled to make a search. Dont submit when two are filled.**

    {
        "keyword":"name to search", 
        "keyid":"user ID"
    }   

    Only one of the above variable should be searched with.


#### Response When you search with id 
    [
        {
            "id": 4,
            "name": "Elda Lockman",
            "email": "nhowe@example.org",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "(917) 333-2709",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null,
            "wallet": {
                "id": 4,
                "user_id": 4,
                "balance": "9100.00",
                "created_at": "2022-11-25T13:57:26.000000Z",
                "updated_at": "2022-11-25T15:30:53.000000Z"
            }
        }
    ]
#### Response When you search with keyword - this is iterable.... You need to loop through it

    [
            {
                "id": 1,
                "name": "Sheldon Botsford",
                "email": "superadmin@admin.com",
                "email_verified_at": "2022-11-25T06:55:02.000000Z",
                "created_at": "2022-11-25T06:55:02.000000Z",
                "updated_at": "2022-11-25T06:55:02.000000Z",
                "channel_id": null,
                "gender": null,
                "phone": "229-734-4136",
                "bvn": null,
                "avatar": null,
                "fullname": null,
                "channel_description": null,
                "access": "admin",
                "deleted_at": null,
                "wallet": {
                    "id": 1,
                    "user_id": 1,
                    "balance": "0.00",
                    "created_at": "2022-11-25T13:57:26.000000Z",
                    "updated_at": "2022-11-25T13:57:26.000000Z"
                }
            },
            {
                "id": 2,
                "name": "Sheldon Bolder",
                "email": "bolder@admin.com",
                "email_verified_at": "2022-11-25T06:55:02.000000Z",
                "created_at": "2022-11-25T06:55:02.000000Z",
                "updated_at": "2022-11-25T06:55:02.000000Z",
                "channel_id": null,
                "gender": null,
                "phone": "229-734-4136",
                "bvn": null,
                "avatar": null,
                "fullname": null,
                "channel_description": null,
                "access": "admin",
                "deleted_at": null,
                "wallet": {
                    "id": 1,
                    "user_id": 2,
                    "balance": "0.00",
                    "created_at": "2022-11-25T13:57:26.000000Z",
                    "updated_at": "2022-11-25T13:57:26.000000Z"
                }
            }
    ]


##  All User transaction - debit and credit in one endpoint
    To get all transactions of a particular user.
    trx_type is a column that indicates where a transaction is debit or credit.
    When the value of this column is 1 - then the transaction is credit
    When the value is 0 - the transaction is debit*
    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    URL: domain.com/api/get-user-trx/{user_id}

#### Response

    {
        "status": true,
        "trx": [
            {
                "id": 5,
                "customer_id": 12,
                "agent_id": "3.00",
                "trx_type": 1,
                "amount": "6000.00",
                "purpose": "contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-25T13:57:19.000000Z",
                "updated_at": "2022-11-25T13:57:19.000000Z",
                "approved": 0,
                "withdraw_type": null,
                "initiated_by": null
            },
            {
                "id": 6,
                "customer_id": 12,
                "agent_id": "3.00",
                "trx_type": 1,
                "amount": "6000.00",
                "purpose": "contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-25T13:57:19.000000Z",
                "updated_at": "2022-11-25T13:57:19.000000Z",
                "approved": 0,
                "withdraw_type": null,
                "initiated_by": null
            }
            
        ]
    }


