#Hotels

###URL:

  /users/{id}/routes/{id}/hotels

###Method:

  `GET` | `POST` | `DELETE` | `PUT/PATCH`

###Data Params:

`POST`

    {
        "route_id": 1,
        "arrival_date": "1989-06-05",
        "departure_date": "1984-08-19",
        "price": "58",
        "amount_persons": "1",
        "paid": 1,
        "bank_account_number": "5275225665733200",
        "hotels": {
            "location_id": "1",
            "description": "Ratione illum quam et odio rerum. Nihil corrupti tempora consequatur repellat in impedit. Voluptatibus deleniti natus sit vel magnam odit recusandae.",
            "name": "Ashtyn Nitzsche DVM Hotel",
            "road_name": "Shyanne Manor",
            "house_number": "281",
            "phone_number": "(393) 290-2391",
            "email_address": "rosie90@example.org",
            "zip_code": "00163"
        }
    }

`PUT/PATCH`

    {
        "route_id": 1,
        "arrival_date": "1989-06-05",
        "departure_date": "1984-08-19",
        "price": "58",
        "amount_persons": "1",
        "paid": 1,
        "bank_account_number": "5275225665733200",
        "hotels": {
            "location_id": "1",
            "description": "Ratione illum quam et odio rerum. Nihil corrupti tempora consequatur repellat in impedit. Voluptatibus deleniti natus sit vel magnam odit recusandae.",
            "name": "Ashtyn Nitzsche DVM Hotel",
            "road_name": "Shyanne Manor",
            "house_number": "281",
            "phone_number": "(393) 290-2391",
            "email_address": "rosie90@example.org",
            "zip_code": "00163"
        }
    }

###Success Response:
  
`GET /users/{id}/routes/{id}/hotels`

**Code:** 200<br>
**Content:**


```
[
    {
        "id": 1,
        "route_id": 1,
        "hotel_id": 1,
        "arrival_date": "1989-06-05",
        "departure_date": "1984-08-19",
        "price": "58",
        "amount_persons": "1",
        "paid": 1,
        "bank_account_number": "5275225665733200",
        "hotels": [
            {
                "id": 1,
                "location_id": "1",
                "description": "Ratione illum quam et odio rerum. Nihil corrupti tempora consequatur repellat in impedit. Voluptatibus deleniti natus sit vel magnam odit recusandae.",
                "name": "Ashtyn Nitzsche DVM Hotel",
                "road_name": "Shyanne Manor",
                "house_number": "281",
                "phone_number": "(393) 290-2391",
                "email_address": "rosie90@example.org",
                "zip_code": "00163"
            }
        ]
    }
]
```

`GET /users/{id}/routes/{id}/hotels/{id}`

**Code:** 200<br>
**Content:**


```
{
    "id": 1,
    "route_id": 1,
    "hotel_id": 1,
    "arrival_date": "1989-06-05",
    "departure_date": "1984-08-19",
    "price": "58",
    "amount_persons": "1",
    "paid": 1,
    "bank_account_number": "5275225665733200",
    "hotels": {
        "id": 1,
        "location_id": "1",
        "description": "Ratione illum quam et odio rerum. Nihil corrupti tempora consequatur repellat in impedit. Voluptatibus deleniti natus sit vel magnam odit recusandae.",
        "name": "Ashtyn Nitzsche DVM Hotel",
        "road_name": "Shyanne Manor",
        "house_number": "281",
        "phone_number": "(393) 290-2391",
        "email_address": "rosie90@example.org",
        "zip_code": "00163"
    }
}
```

`POST /users/{id}/routes/{id}/hotels`

**Code:** 201

`PUT/PATCH /users/{id}/routes/{id}/hotels/{id}`

**Code:** 200

`DELETE /users/{id}/routes/{id}/hotels/{id}`

**Code:** 200
 
###Error Response:

`GET /users/{id}/routes/{id}/hotels`

**Code:** 404

`GET /users/{id}/routes/{id}/hotels/{id}`

**Code:** 404

`POST /users/{id}/routes/{id}/hotels`

**Code:** 404

`PUT/PATCH /users/{id}/routes/{id}/hotels/{id}`

**Code:** 404

`DELETE /users/{id}/routes/{id}/hotels/{id}`

**Code:** 404
