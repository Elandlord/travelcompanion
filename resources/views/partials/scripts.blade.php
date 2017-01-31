<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div style="display: none" id="results"></div>
{{--<script type="text/javascript"--}}
{{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbWPLb40f0QoQrIK3T-A27E9jwURduLXw&libraries=places"></script>--}}
<script type="text/javascript">

    function searchHotelApi(waypoints) {
        for (var i = 0; i < waypoints.length; i++) {
            var searchParameters = waypoints[i]['location'];

            var service = new google.maps.places.PlacesService($('#results').get(0));
            var request = {
                query: searchParameters,
                types: ['lodging']
            };
            service.textSearch(request, searchCallback);
        }
    }

    function searchCallback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var html = "";
            var result = results[0].formatted_address.split(",");
            var location = result[1];
            var location_place = location.split(" ");
            var place = location_place.slice(-1).pop();
             $('#hotel-results').append("<h1 class='text-color-main text-center space-outside-md'>" + place + "</h1>");
            for (var i = 0; i < results.length; i++) {
                var rating = "";
                if (results[i].rating) {
                    rating = results[i].rating;
                }
                html += `<div class=\"row\">
    <div class=\"col-lm-12\">
        <div class=\"search-result row animated fadeInLeft wow\">
            <div class=\"col-xs-12 col-sm-12 col-md-3\">
                <a href=\"#\" title=\"Lorem ipsum\" class=\"thumbnail\"><img
                            src=\"http://lorempixel.com/400/200/city/\"
                            alt=\"Lorem ipsum\"/></a>
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-7\">
                <h2 style='display: inline;' class=\'text-color-accent\'>` + results[i].name + ` <img style='max-width:30px; display: inline;' class='img-responsive space-outside-left-md' src='` + results[i].icon + `'/></h2>
                <p class=\'font-weight-light\'>
                    ` + results[i].formatted_address + `
                </p>
                <p>
                    Rating: ` + rating + ` out of 5
                </p>
                <p>
                    Price for one night: <span id=\"price`+ i +`\">`+ ((Math.random() * 90) + 10).toFixed(2) +`</span>
                </p>
                <div class=\'row space-outside-md\'>
                    <div class=\'col-lg-8\'>
                        <input type=\"date\" id=\"arrival` + i + `\" name=\"date\" onclick=\"setMinToday(this.id)\" onchange=\"setMinDate(this.id, 'departure` + i + `')\" required>
                    <input type=\"date\" id=\"departure` + i + `\" name=\"date\" min=\"\" required><br>
                    Amount of people: <input type=\"number\" id=\"amount` + i + `\"><br>
                    Accountnumber: <input type=\"number\" id=\"accountnumber` + i + `\">
                    </div>
                    <div class=\'col-lg-4\'>
                        <button type=\"submit\" onclick=\"bookHotel(\'` + results[i].name + `\',\'` + results[i].formatted_address + `\',\'` + i + `\')\"
                                class=\"btn bg-accent text-color-light hover-darken-accent transition-normal\">
                            Book
                            now!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class=\"hr-orange\">`;
            }
            $('#hotel-results').append(html);
        }
    }

    function bookHotel(hotelname, adress, dateTimeId) {
        var post = {};

        var priceid = "#price" + dateTimeId;
        var accountnumberid = "accountnumber" + dateTimeId;
        var amountid = "amount" + dateTimeId;
        var arrivalid = "arrival" + dateTimeId;
        var departureid = "departure" + dateTimeId;
        post['arrival_date'] = document.getElementById(arrivalid).value;
        post['departure_date'] = document.getElementById(departureid).value;
        post['paid'] = 0; //TODO make actual payment???
        post['amount_persons'] = document.getElementById(amountid).value;
        post['bank_account_number'] = document.getElementById(accountnumberid).value;
        post['price'] = $(priceid).html();

        if(!post['arrival_date'] || !post['departure_date']){
            alert("Fill in a arrival and departure date before booking a hotel!")
        } else {
            //seperate the whole string by comma
            var adressArray = adress.split(",");

            //seperate the roadname and housenumber
            var splitRoadname = adressArray[0].split(' ');

            //the housenumber is the last index of the array
            var houseNumber = splitRoadname[splitRoadname.length - 1];

            //puzzle the roadname back together
            var roadname = "";
            for (var j = 0; j < (splitRoadname.length - 1); j++) {
                roadname += " " + splitRoadname[j];
            }

            // seperate the cityname fromm the zipcode and puzzle the zipcode back together
            var zipCode = "";
            var splitZipCode = adressArray[1].split(' ');
            for (var k = 0; k < (splitZipCode.length - 1); k++) {
                zipCode += " " + splitZipCode[k];
            }

            //the last index of the zipcode is the cityname
            var cityName = splitZipCode[splitZipCode.length - 1];

            //the last index of the entire adress array is the countryname
            var countryName = adressArray[adressArray.length - 1];

            post['hotel'] = {};
            post['hotel']['name'] = hotelname;
            post['hotel']['road_name'] = roadname.trim();
            post['hotel']['house_number'] = houseNumber.trim();
            post['hotel']['zip_code'] = zipCode.trim();
            post['city_name'] = cityName.trim();
            post['country'] = countryName.trim();

            $.getJSON("user/authenticated", function (data) {
                if(data.id) {
                    post['user_id'] = data.id;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/api/users/" + data.id + "/hotels",
                        type: 'post',
                        ContentType: 'application/json',
                        success: function (data) {
                            console.log(data);
                        },
                        data: post
                    }).done(function () {
                        alert("Succesfull booked the hotel.");
                    })
                } else {
                    alert("Please log in before booking a hotel.")
                }
            });
        }
    }

</script>

<script type="text/javascript">

    function setMinDate(id, departureid) {
        var returnDateElement = document.getElementById(id);
        var minDate = new Date(returnDateElement.value);
        minDate.setDate(minDate.getDate() + 1);
        minDateFormated = minDate.toISOString().substring(0, 10);
        var departureDatePicker =  document.getElementById(departureid);
        departureDatePicker.min = minDateFormated;
    }

    function setMinToday(id) {
        var returnDateElement = document.getElementById(id);
        var nowDate = new Date();
        var nowDateFormatted = nowDate.toISOString().substring(0, 10);
        returnDateElement.min = nowDateFormatted;
    }
</script>


<script type="text/javascript">
    // Declare location array
    var locationList = [];

    // Initialise variables for Google Maps
    var directionsService = new google.maps.DirectionsService();
    var num, map, data;
    var requestArray = [], renderArray = [];

    // A JSON Array containing routes and the destinations/stops
    var jsonArray = makeJsonObject2();

    // Add new location to Maps
    function addNewLocation() {
        // get Location from inputfrield by ID
        var location = document.getElementById("locationText").value;

        // Push Location in Array
        if(location == ""){
          alert("Je hebt geen locatie toegevoegd.")
        } else {
          locationList.push(location);
        }

        // Reset inputfield for another location
        document.getElementById("locationText").value = "";
        document.getElementById("locationText").placeholder = "Place of arrival";

        var newListItemElement = document.createElement('li');
        newListItemElement.innerHTML = `<div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
              <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                <h2 id="location_title" class='text-color-light'>` + location + `</h2>
              </div>`;

        // Get list
        var listElement = document.getElementById('list');
        listElement.append(newListItemElement);
    }

    // On Keypress change tripname
    function edValueKeyPress() {
         var tripName = document.getElementById("tripName");
         var s = tripName.value;

         var nameOfTrip = document.getElementById("location_title");
         nameOfTrip.innerText = "Trip: "+s;
     }

    // Create Json Object function
    function makeJsonObject() {
        var json = {};
        json['location'] = locationList;
        json['name'] = document.getElementById('tripName').value;
        json['departure_date'] = document.getElementById('departure_date').value;;
        json['return_date'] = document.getElementById('return_date').value;;

        return JSON.stringify(json);
    }

    // Create Json Object function
    function makeJsonObject2() {
        var json = {
            location: locationList
        }
        return json;
    }

    function saveTrip() {
        var post = {};

        if(tripName == "") {
          alert('Enter Tripname');
        } else {

          var json = makeJsonObject();

            $.getJSON("user/authenticated", function (data) {
                if(data.id) {
                    post['users_id'] = data.id;

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "api/users/" + data.id +"/routes",
                        type: "POST",
                        data: {
                            data: {json}
                        },
                        error: function (req, err) {
                            console.log('my message' + err);
                        },

                        succes: function (response) {
                            console.log($.parseJSON(response));
                        },
                    })
                }
            });


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "api/routes/1/locations",
                type: "POST",
                data: {
                    data: {json}
                },
                error: function (req, err) {
                    console.log('my message' + err);
                },
                succes: function (response) {
                    console.log($.parseJSON(response));
                },
            });

            alert("Succesfull saved the trip.");
        }
    }

    // Let's make an array of requests which will become individual polylines on the map.
    function generateRequests() {

        requestArray = [];

        for (var route in jsonArray) {

            // Somewhere to store the wayoints
            var waypts = [];

            // 'start' and 'finish' will be the routes origin and destination
            var start, finish;

            // lastpoint is used to ensure that duplicate waypoints are stripped
            var lastpoint;

            data = jsonArray[route];

            limit = data.length
            for (var waypoint = 0; waypoint < limit; waypoint++) {
                if (data[waypoint] === lastpoint) {
                    // Duplicate of of the last waypoint - don't bother
                    continue;
                }

                // Prepare the lastpoint for the next loop
                lastpoint = data[waypoint]

                // Add this to waypoint to the array for making the request
                waypts.push({
                    location: data[waypoint],
                    stopover: true
                });
            }

            searchHotelApi(waypts);

            // Grab the first waypoint for the 'start' location
            start = (waypts.shift())['location'];
            // start = document.getElementById('start').value;
            // Grab the last waypoint for use as a 'finish' location
            finish = waypts.pop();
            if (finish === undefined) {
                // Unless there was no finish location for some reason?
                // finish = start;
            } else {
                finish = finish.location;
            }

            // Let's create the Google Maps request object
            var request = {
                origin: start,
                destination: finish,
                waypoints: waypts,
                travelMode: google.maps.TravelMode.DRIVING
            };

            // and save it in our requestArray
            requestArray.push({"route": route, "request": request});
        }
        processRequests();
    }

    function processRequests() {

        // Counter to track request submission and process one at a time;
        var i = 0;

        // Used to submit the request 'i'
        function submitRequest() {
            directionsService.route(requestArray[i].request, directionResults);
        }

        // Used as callback for the above request for current 'i'
        function directionResults(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {

                // Create a unique DirectionsRenderer 'i'
                renderArray[i] = new google.maps.DirectionsRenderer();
                renderArray[i].setMap(map);

                // Use this new renderer with the result
                renderArray[i].setDirections(result);
                // and start the next request
                nextRequest();
            }

        }

        function nextRequest() {
            // Increase the counter
            i++;
            // Make sure we are still waiting for a request
            if (i >= requestArray.length) {
                // No more to do
                return;
            }
            // Submit another request
            submitRequest();
        }

        // This request is just to kick start the whole process
        submitRequest();
    }

    // Called Onload
    function init() {

        // Some basic map setup (from the API docs)
        var mapOptions = {
            center: new google.maps.LatLng(50.677965, -3.768841),
            zoom: 8,
            mapTypeControl: false,
            scrollwheel: false,
            streetViewControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    }

    // Trigger our init()
    google.maps.event.addDomListener(window, 'load', init);
</script>

<script>
    new WOW().init();
</script>
