#Users

###URL:

  /users/{id}

###Method:

  `GET` | `POST` | `DELETE` | `PUT/PATCH`

###Data Params:

`POST`

```
{
    "name": "name of the user",
    "email": "email address of the user",
    "password": "password of the user"
}
```

`PUT/PATCH`

```
{
    "name": "name of the user",
    "email": "email address of the user",
    "password": "password of the user"
}
```

###Success Response:
  
  `GET /users`

**Code:** 200<br>
**Content:**

```
[
    {
        "id": 1,
        "name": "Ruben",
        "email": "ruben@hanze.nl",
        "created_at": "2017-01-23 13:44:46",
        "updated_at": "2017-01-23 13:44:46",
        "photo_link": "http://lorempixel.com/640/480/?64903",
        "admin": null
    },
]
```

`GET /users/{id}`

**Code:** 200<br>
**Content:**

```
{
    "id": 1,
    "name": "Ruben",
    "email": "ruben@hanze.nl",
    "created_at": "2017-01-23 13:44:46",
    "updated_at": "2017-01-23 13:44:46",
    "photo_link": "http://lorempixel.com/640/480/?64903",
    "admin": null
}
```

`POST /users`

**Code:** 201

`PUT/PATCH /users/{id}`

**Code:** 200

`DELETE /users/{id}`

**Code:** 200
 
###Error Response:

`GET /users`

**Code:** 404

`GET /users/{id}`

**Code:** 404

`POST /users`

**Code:** 404

`PUT/PATCH /users/{id}`

**Code:** 404

`DELETE /users/{id}`

**Code:** 404
