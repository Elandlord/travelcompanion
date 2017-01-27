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
            console.log(results);
            for (var i = 0; i < results.length; i++) {
                var rating = "";
                if (results[i].rating) {
                    rating = " - " + results[i].rating;
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
                <h3 class=\'text-color-accent\'>` + results[i].name + rating + `</h3>
                <p class=\'font-weight-light\'>
                    ` + results[i].formatted_address + `
                </p>
                <div class=\'row space-outside-md\'>
                    <div class=\'col-lg-8\'>
                        <input type=\"date\" id=\"arrival` + i + `\" name="date" onclick="setMinToday()" onchange=\"setMinDate()\" required>
                    <input type=\"date\" id=\"departure` + i + `\" name=\"date\" min=\"\" required>
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
            $('#hotel-results').append(html + "<hr class='hr-solid'>");
        }
    }

    function bookHotel(hotelname, adress, dateTimeId) {
        var post = {};


        var arrivalid = "arrival" + dateTimeId;
        var departureid = "departure" + dateTimeId;
        post['arrival_date'] = document.getElementById(arrivalid).value;
        post['departure_date'] = document.getElementById(departureid).value;

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
            post['hotel']['city_name'] = cityName.trim();
            post['hotel']['country_name'] = countryName.trim();

            console.log(post);

            $.post("/api/users/{userid}/hotels", post, function (data, statusText, xhr) {
                if (xhr.status == 404) {
                    alert("booking failed");
                }
            });
        }
    }

</script>

<script type="text/javascript">

    function setMinDate() {
        var returnDateElements = document.getElementsByName('date');
        var minDate = new Date(returnDateElements[0].value);
        minDate.setDate(minDate.getDate() + 1);
        minDateFormated = minDate.toISOString().substring(0, 10);
        returnDateElements[1].min = minDateFormated;
    }

    function setMinToday() {
        var returnDateElements = document.getElementsByName('date');
        var nowDate = new Date();
        var nowDateFormatted = nowDate.toISOString().substring(0, 10);
        returnDateElements[0].min = nowDateFormatted;
    }
</script>

<script type="text/javascript">
    function setMinDate() {
        var returnDateElements = document.getElementsByName('date');
        var minDate = new Date(returnDateElements[0].value);
        minDate.setDate(minDate.getDate() + 1);
        minDateFormated = minDate.toISOString().substring(0, 10)
        returnDateElements[1].min = minDateFormated;
    }
</script>


<script type="text/javascript">
    // Declare location array
    var locations = [];

    //Current date
    var date = new Date();
    var month = date.getUTCMonth() + 1;
    var day = date.getUTCDate();
    var year = date.getUTCFullYear();

    var newdate = day + "/" + month + "/" + year;

    // Button bindings
    var locationButton = document.getElementById("addNewLocation");
    locationButton.onclick = addNewLocation;

    //Show Date in Location list
    // document.getElementById('location_title').innerHTML=newdate;

    // Add new location to Maps
    function addNewLocation() {
        // get Location from inputfrield by ID
        var location = document.getElementById("locationText").value;

        // Push Location in Array
        locations.push(location);

        // Reset inputfield for another location
        document.getElementById("locationText").value = "";
        document.getElementById("locationText").placeholder = " Bestemming";

        var newListItemElement = document.createElement('li');
        newListItemElement.innerHTML = `<div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
              <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                <h2 id="location_title" class='text-color-light'>` + location + `</h2>
              </div>`;

        var location_title = document.getElementsByClassName('location_title');

        // Get list
        var listElement = document.getElementById('list');
        listElement.append(newListItemElement);

    }

    // Create Json Object function
    function makeJsonObject() {
        var json = {
            location: locations
        }
        return json;
    }

    // Initialise some variables
    var directionsService = new google.maps.DirectionsService();
    var num, map, data;
    var requestArray = [], renderArray = [];

    // A JSON Array containing routes and the destinations/stops
    var jsonArray = makeJsonObject();

    function saveTrip() {
        var json = makeJsonObject();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "api/users/1/routes",
            type: "POST",
            data: {
                data: {json: json}
            },
            error: function (req, err) {
                console.log('my message' + err);
            },
            succes: function (response) {
                console.log($.parseJSON(response));
            },
        });
    }

    // 16 Standard Colours for navigation polylines
    // var colourArray = ['navy', 'grey', 'fuchsia', 'black', 'white', 'lime', 'maroon', 'purple', 'aqua', 'red', 'green', 'silver', 'olive', 'blue', 'yellow', 'teal'];

    // Let's make an array of requests which will become individual polylines on the map.
    function generateRequests() {

        requestArray = [];

        for (var route in jsonArray) {
            // This now deals with one of the people / routes

            // Somewhere to store the wayoints
            var waypts = [];

            // 'start' and 'finish' will be the routes origin and destination
            var start, finish

            // lastpoint is used to ensure that duplicate waypoints are stripped
            var lastpoint

            data = jsonArray[route]

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
            start = (waypts.shift()).location;
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

                // Some unique options from the colorArray so we can see the routes
                // renderArray[i].setOptions({
                //     preserveViewport: true,
                //     suppressInfoWindows: true,
                //     polylineOptions: {
                //         strokeWeight: 4,
                //         strokeOpacity: 0.8,
                //         strokeColor: colourArray[i]
                //     },
                //     markerOptions:{
                //         icon:{
                //             path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
                //             scale: 3,
                //             strokeColor: colourArray[i]
                //         }
                //     }
                // });

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
