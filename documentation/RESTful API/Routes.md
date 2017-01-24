#Routes

###URL:

  /users/{id}/routes/{id}

###Method:

  `GET` | `POST` | `DELETE` | `PUT/PATCH`

###Data Params:

`POST`

	{
		"user_id": "user id",
		"departure_date": "when the user will start their trip",
		"return_date": "when the user returns from their trip"
	}

`PUT/PATCH`

	{
		"user_id": "user id",
		"departure_date": "when the user will start their trip",
		"return_date": "when the user returns from their trip"
	}

###Success Response:
  
`GET /users/{id}/routes`

**Content:**
    
```
        [
            {
                "id": 1,
                "user_id": 1,
                "departure_date": "1982-06-02",
                "return_date": "1989-10-23"
            }
        ]
```

`GET /users/{id}/routes/{id}`

**Code:** 200<br>
**Content:**
    
```
	    {
            "user_id": 1,
            "departure_date": "1982-06-02",
            "return_date": "1989-10-23"
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
