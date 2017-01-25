#Locations

###URL:

  /users/{id}/routes/{id}/locations

###Method:

  `GET` | `POST` | `DELETE` | `PUT/PATCH`

###Data Params:

`POST`

    {
        "location_id": 1,
        "route_id": 1,
        "arrival_date": "1976-07-30",
        "departure_date": "1995-08-19",
        "locations":
            {
                "name": "Groningen",
                "country": "Nederland"
            }
    }

`PUT/PATCH`

    {
        "location_id": 1,
        "route_id": 1,
        "arrival_date": "1976-07-30",
        "departure_date": "1995-08-19",
        "locations":
            {
                "name": "Groningen",
                "country": "Nederland"
            }
    }

###Success Response:
  
`GET /users/{id}/routes/{id}/locations`

**Code:** 200<br>
**Content:**
    
```
[
    {
        "id": 1,
        "location_id": 1,
        "route_id": 1,
        "arrival_date": "1976-07-30",
        "departure_date": "1995-08-19",
        "locations": [
            {
                "id": 1,
                "name": "Groningen",
                "country": "Nederland"
            }
        ]
    }
]
```

`GET /users/{id}/routes/{id}/locations`

**Code:** 200<br>
**Content:**
    
```
{
    "id": 1,
    "location_id": 1,
    "route_id": 1,
    "arrival_date": "1976-07-30",
    "departure_date": "1995-08-19",
    "locations":
        {
            "id": 1,
            "name": "Groningen",
            "country": "Nederland"
        }
}
```

`POST /users/{id}/routes/{id}/locations`

**Code:** 201

`PUT/PATCH /users/{id}/routes/{id}/locations/{id}`

**Code:** 200

`DELETE /users/{id}/routes/{id}/locations/{id}`

**Code:** 200
 
###Error Response:

`GET /users/{id}/routes/{id}/locations`

**Code:** 404

`GET /users/{id}/routes/{id}/locations/{id}`

**Code:** 404

`POST /users/{id}/routes/{id}/locations`

**Code:** 404

`PUT/PATCH /users/{id}/routes/{id}/locations/{id}`

**Code:** 404

`DELETE /users/{id}/routes/{id}/locations/{id}`

**Code:** 404
