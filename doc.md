# More On The endpoints


## Get User info by email - requires no authentication

     Make a get call to the url domain.com/api/userinfo/{keyword}/{key}
     This endpoint can be used to get info of the user who want to log in to 
     determin if they are admin or channel

     NB: if you are searching with email set {keyword} to "email", if you are searching 
     with id set {keyword} to "id"

     Where the key is the value.



    valid response should look like

    {
        "id": 20,
        "name": "Vincent",
        "email": "admin@admin.com",
        "email_verified_at": null,
        "created_at": "2022-10-11T00:50:17.000000Z",
        "updated_at": "2022-10-11T00:50:17.000000Z",
        "channel_id": null,
        "gender": null,
        "phone": null,
        "bvn": null,
        "avatar": null,
        "fullname": "Vincent",
        "channel_description": "New Market Road extend to Barracks Junction",
        "access": "channel",
        "deleted_at": null
    }


## Get user info by User ID


## Get User(contributor, channel, admin) Wallet balance
    Just make a GET api call to 
    domain.com/api/user/wallet/{id} Where the {id} parameter is user's ID or primary key value 

    Response :
    {
        "id": 2,
        "user_id": 5,
        "balance": "0.00",
        "created_at": "2022-10-12T13:56:47.000000Z",
        "updated_at": "2022-10-12T13:56:47.000000Z"
    }


## Enter Debit/Withdrawal Request 

    Make a POST request to domain.com/api/debit/reg/{agentid}
    where {agentid} is the id of the agent making the request.
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

    {
        "amount":"3400",
        "customer":"22",
        "method":"cash",
        "purpose":"not a must"
    }
    NB: when the agent enters "customer" value - make a call to get the name of this customer and display his name or "not found"

#### Success response
    You will get back the full details of what you entered if everything went fine
    {
        "amount": "3400",
        "customer_id": "22",
        "approved": 0,
        "staff_id": "24",
        "updated_at": "2022-11-21T14:01:03.000000Z",
        "created_at": "2022-11-21T14:01:03.000000Z",
        "id": 94
    }

#### Error responses 
    1. Assuming  there is a missing field then you will get a respons like:
    {
        "status": false,
        "message": "validation error",
        "errors": {
            "method": [
                "The method field is required."
            ]
        }
    }



## Updating Debit/Withdrawal Request

    To update a debit request that have not been approved, make a POST request to domain.com/api/debit/update/reg/{requestId}/{agentid}
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

     {
        "amount":"3400",
        "customer":"22",
        "method":"cash",
        "purpose":"not a must"
    }
    NB: when the agent enters "customer" value - make a call to get the name of this customer and display his name or "not found"

### Success Response 
    {
        "id": 94,
        "amount": "5200",
        "type": "transfer",
        "approved": 0,
        "customer_id": "22",
        "description": null,
        "staff_id": "24",
        "created_at": "2022-11-21T14:01:03.000000Z",
        "updated_at": "2022-11-21T14:40:00.000000Z"
    }

#### Error responses 
    1. Assuming  there is a missing field then you will get a respons like:
    {
        "status": false,
        "message": "validation error",
        "errors": {
            "method": [
                "The xyz field is required."
            ]
        }
    }



## Admin Approving Withdrawal/Debit Request
    *When channel register that a user want to withdraw, it enters in a "request table" where it awaits admin approval. When Admin approve it enters into transaction table as debit.*

    

## Channel Adding Credit/Contribution
    Make a POST request to domain.com/api/credit/post/{agent_id}
    where {agentid} is the id of the agent making the request.
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

    {
        "amount":"2000", 
        "customer":"2", 
        "purpose":"optional"
    }

#### Missing Input Response

    {
        "status": false,
        "message": "validation error",
        "errors": {
            "customer": [
                "The customer field is required."
            ]
        }
    }   

#### Success response 
    {
        "amount": "5000",
        "customer_id": 22,
        "agent_id": 24,
        "purpose": "Contribution",
        "trx_type": 1,
        "updated_at": "2022-11-23T12:32:11.000000Z",
        "created_at": "2022-11-23T12:32:11.000000Z",
        "id": 268
    }



## Updating Contribution/Credit Record 
    Make a POST request to domain.com/api/update/credit/{cred_id}/{channel_id}
    where {channel_id} is the id of the agent/channel making the request
    and {cred_id} is the record ID.
    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',

    {
        "amount":"2000", 
        "customer":"2", 
        "purpose":"optional"
    }

#### Missing input error response 
      {
        "status": false,
        "message": "validation error",
        "errors": {
            "customer": [
                "The customer field is required."
            ]
        }
    }   
#### Success Response 
    It return both the edited credit record and wallet balance
    {
        "credit": {
            "id": 268,
            "customer_id": "22",
            "agent_id": "24.00",
            "trx_type": 1,
            "amount": "1000",
            "purpose": "purpose",
            "sync": "0",
            "deleted_at": null,
            "created_at": "2022-11-23T12:32:11.000000Z",
            "updated_at": "2022-11-23T13:37:23.000000Z",
            "approved": 0,
            "withdraw_type": null,
            "initiated_by": null
        },
        "wallet": {
            "id": 18,
            "user_id": 22,
            "balance": 58000,
            "created_at": "2022-10-12T13:56:48.000000Z",
            "updated_at": "2022-11-23T13:37:22.000000Z"
        }
    }

    

## (a) Get channel credits/contributions (b) get channel credits between two dates

    Make a GET API request to domain.com/api/transactions/channel/credits/{channelid}
    domain.com/api/transactions/channel/credits/{channelid}?start_date={start_date}?end_date={end_date}


    {
        "current_page": 1,
        "data": [
            {
                "id": 221,
                "customer_id": 9,
                "agent_id": "22.00",
                "trx_type": 1,
                "amount": "900.00",
                "purpose": "Contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-16T12:11:12.000000Z",
                "updated_at": "2022-11-16T12:11:12.000000Z",
                "approved": 1,
                "withdraw_type": "cash",
                "initiated_by": null
            },
            {
                "id": 217,
                "customer_id": 8,
                "agent_id": "22.00",
                "trx_type": 1,
                "amount": "900.00",
                "purpose": "Contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-16T12:11:12.000000Z",
                "updated_at": "2022-11-16T12:11:12.000000Z",
                "approved": 1,
                "withdraw_type": "cash",
                "initiated_by": null
            },
            {
                "id": 216,
                "customer_id": 7,
                "agent_id": "22.00",
                "trx_type": 1,
                "amount": "900.00",
                "purpose": "Contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-16T12:11:12.000000Z",
                "updated_at": "2022-11-16T12:11:12.000000Z",
                "approved": 1,
                "withdraw_type": "cash",
                "initiated_by": null
            },
            {
                "id": 215,
                "customer_id": 7,
                "agent_id": "22.00",
                "trx_type": 1,
                "amount": "900.00",
                "purpose": "Contribution",
                "sync": "0",
                "deleted_at": null,
                "created_at": "2022-11-16T12:11:12.000000Z",
                "updated_at": "2022-11-16T12:11:12.000000Z",
                "approved": 1,
                "withdraw_type": "cash",
                "initiated_by": null
            }
        ],
        "first_page_url": "http://localhost:1200/api/transactions/channel/22?page=1",
        "from": 1,
        "last_page": 3,
        "last_page_url": "http://localhost:1200/api/transactions/channel/22?page=3",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:1200/api/transactions/channel/22?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": "http://localhost:1200/api/transactions/channel/22?page=2",
                "label": "2",
                "active": false
            },
            {
                "url": "http://localhost:1200/api/transactions/channel/22?page=3",
                "label": "3",
                "active": false
            },
            {
                "url": "http://localhost:1200/api/transactions/channel/22?page=2",
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": "http://localhost:1200/api/transactions/channel/22?page=2",
        "path": "http://localhost:1200/api/transactions/channel/22",
        "per_page": 50,
        "prev_page_url": null,
        "to": 50,
        "total": 120
    }

### More Details 
    The response from this endpoint is paginated. per_page tells you number of items per page,
    prev_page_url tells you url of previous page and there is next_page_url
    Total tells you total of everything





## (a) Get channel debits (b) get channel debits between two dates

    Make a GET API request to domain.com/api/transactions/channel/{channelid}
    domain.com/api/transactions/channel/debits/{channelid}?start_date={start_date}?end_date={end_date}

#### The response is just same as that of the last endpoint above it.


## Update Credit/Contribution trnsaction record 

    Make a POST call to domain.com/api/update/credit/{id}
        where the {id} parameter is that of the the exact tranction to update

     Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    Body:
        {
            "amount": " amount involved in the record",
            "customer": " customer id - the customer the record belongs to",
            "purpose":"put a placeholder here eg. updating contribution"
        }


Channels/agents cannot update a record after after 11.59pm that day they entered it.
