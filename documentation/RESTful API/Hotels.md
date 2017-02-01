#Hotels

###URL:

  /users/{id}/hotels

###Method:

  `GET` | `POST` | `DELETE` | `PUT/PATCH`

###Data Params:

`POST`

    {
        "city_name":"Hoogeveen",
        "country":"Netherlands",
        "user_id":1,
        "arrival_date":"2017-01-30",
        "departure_date":"2017-01-31",
        "price":"48.71",
        "amount_persons": "2",
        "paid":0,
        "bank_account_number":"1111111",
        "hotel": {
            "name":"Hotel Hoogeveen",
            "road_name":"Mathijsenstraat",
            "house_number":"1",
            "zip_code":"7909 AP"
        }
    }

`PUT/PATCH`

    {
        "city_name":"Hoogeveen",
        "country":"Netherlands",
        "user_id":1,
        "arrival_date":"2017-01-30",
        "departure_date":"2017-01-31",
        "price":"48.71",
        "amount_persons": "2",
        "paid":0,
        "bank_account_number":"1111111",
        "hotel": {
            "name":"Hotel Hoogeveen",
            "road_name":"Mathijsenstraat",
            "house_number":"1",
            "zip_code":"7909 AP"
        }
    }

###Success Response:
  
`GET /users/{id}/hotels`

**Code:** 200<br>
**Content:**


```
[
    {
        "id": 1,
        "users_id": 1,
        "hotel_id": 1,
        "arrival_date": "1989-06-05",
        "departure_date": "1984-08-19",
        "price": "58",
        "amount_persons": "1",
        "paid": 1,
        "hotels": [
            {
                "id": 1,
                "location_id": "1",
                "name": "Ashtyn Nitzsche DVM Hotel",
                "road_name": "Shyanne Manor",
                "house_number": "281",
                "zip_code": "00163"
            }
        ]
    }
]
```

`GET /users/{id}/hotels/{id}`

**Code:** 200<br>
**Content:**


```
{
    "id": 1,
    "users_id": 1,
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
        "name": "Ashtyn Nitzsche DVM Hotel",
        "road_name": "Shyanne Manor",
        "house_number": "281",
        "zip_code": "00163"
    }
}
```

`POST /users/{id}/hotels`

**Code:** 201

`PUT/PATCH /users/{id}/hotels/{id}`

**Code:** 200

`DELETE /users/{id}/hotels/{id}`

**Code:** 200
 
###Error Response:

`GET /users/{id}/hotels`

**Code:** 404

`GET /users/{id}/hotels/{id}`

**Code:** 404

`POST /users/{id}/hotels`

**Code:** 404

`PUT/PATCH /users/{id}/hotels/{id}`

**Code:** 404

`DELETE /users/{id}/hotels/{id}`

**Code:** 404
