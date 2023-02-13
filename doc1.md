## Fetching users 
    This endpiont will fetch paginated users for the logged in channel. And all users if the person using the app is admin. All you have to do is to append the logged in user id - back end will check if it is channel or admin

    Method: 'GET',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    URL: domain.com/api/users/{channel_id}

#### Success response 
    {
    "current_page": 1,
    "data": [
        {
            "id": 10,
            "name": "Cora Veum",
            "email": "unique64@example.org",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "+1 (229) 484-0122",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null
        },
        {
            "id": 9,
            "name": "Mrs. Maude Ondricka",
            "email": "lynch.francesco@example.net",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "1-463-398-4206",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null
        }

     
    ],
    "first_page_url": "http://localhost:9600/api/users/2?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:9600/api/users/2?page=1",
    "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "http://localhost:9600/api/users/2?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:9600/api/users/2",
    "per_page": 20,
    "prev_page_url": null,
    "to": 7,
    "total": 7
    }

#### Empty response 

    {
        "current_page": 1,
        "data": [],
        "first_page_url": "http://localhost:9600/api/users/3?page=1",
        "from": null,
        "last_page": 1,
        "last_page_url": "http://localhost:9600/api/users/3?page=1",
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:9600/api/users/3?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "next_page_url": null,
        "path": "http://localhost:9600/api/users/3",
        "per_page": 20,
        "prev_page_url": null,
        "to": null,
        "total": 0
    }



## Searching User
    When a channel search user, the search is "channel", only users under him will be searched
    When the person is "admin" all users will be searched. Backend takes care of determining who is searching

    Method: 'POST',
    Headers: 'Accept: application/json',
    Headers: 'Authorization: Bearer --Token',
    URL: domain.com/api/search/user/{view_id}

    {view_id} is placeholder for channel or admin id

    {
        "keyword":"name to search", 
        "keyid":"user ID"
    }   

    Only one of the above variable should be searched with.


#### Response When you search with id 
    [
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
            "deleted_at": null
        }
    ]

#### Response When you search with keyword

    [
        {
            "id": 9,
            "name": "Mrs. Maude Ondricka",
            "email": "lynch.francesco@example.net",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:14.000000Z",
            "channel_id": 2,
            "gender": null,
            "phone": "1-463-398-4206",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null
        },
        {
            "id": 13,
            "name": "Mr. Nicola Gaylord DVM",
            "email": "hschoen@example.org",
            "email_verified_at": "2022-11-25T06:55:03.000000Z",
            "created_at": "2022-11-25T06:55:03.000000Z",
            "updated_at": "2022-11-25T07:51:15.000000Z",
            "channel_id": 16,
            "gender": null,
            "phone": "+1-916-838-7367",
            "bvn": null,
            "avatar": null,
            "fullname": null,
            "channel_description": null,
            "access": "user",
            "deleted_at": null
        }
    ]
