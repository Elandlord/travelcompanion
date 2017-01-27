  @extends('master')

  @section('title')
  Planner
  @stop

  @section('content')


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4bbyifwfej8H4k5dCeTIV_tyFMfK8H4c&sensor=false"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
  function setMinDate() {
  var returnDateElements = document.getElementsByName('date');
  var minDate = new Date(returnDateElements[0].value);
  minDate.setDate(minDate.getDate() + 1);
  minDateFormated = minDate.toISOString().substring(0, 10)
  returnDateElements[1].min = minDateFormated;
  }
  </script>

<div id="maps_interface" class="bg-main space-inside-xs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <input class="form-control" type="text" name="" value="" placeholder="Trip Naam" required/>
          <input class="form-control" id="locationText" type="text" placeholder="Vertrek" required/>
          <input type="date" name="date" class="form-control" onchange="setMinDate()" required>
          <input type="date" name="date" class="form-control" min="" required>
          <button class="btn btn-block bg-accent text-color-light hover-darken-accent transition-normal" id="addNewLocation" onclick="addNewLocation();">Voeg Bestemming toe</button>
          <button class="btn btn-block bg-accent text-color-light hover-darken-accent transition-normal" onclick="generateRequests();"type="button" name="button">Toon trip</button>
          <button class="btn btn-block bg-accent text-color-light hover-darken-accent transition-normal" onclick="saveTrip();">Bewaar je trip</button>
        </div>
    </div>
  </div>
</div>

<div id="google_maps">
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12">
        <h3>Locaties</h3>

        <ul id="list" class="cbp_tmtimeline">
          <li class="list_item">
            <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
            <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
              <h2 id="location_title" class='text-color-light'>Trip Naam</h2>
            </div>
          </li>
        </ul>
      </div>

      <div class="col-xs-12">
        <div style="height: 400px;" id="map-canvas">
        </div>
      </div>
    </div>
  </div>
</div>

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
    location : locations
  }
  return json;
}

// Initialise some variables
var directionsService = new google.maps.DirectionsService();
var num, map, data;
var requestArray = [], renderArray = [];

// A JSON Array containing routes and the destinations/stops
var jsonArray = makeJsonObject();

function saveTrip(){
  var json = makeJsonObject();

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "api/users/1/routes",
    type: "POST",
    data: {
      data: {json:json}
    },
    error: function(req, err){ console.log('my message' + err); },
    succes:function(response){
      console.log($.parseJSON(response));
    },
  });
}

// 16 Standard Colours for navigation polylines
// var colourArray = ['navy', 'grey', 'fuchsia', 'black', 'white', 'lime', 'maroon', 'purple', 'aqua', 'red', 'green', 'silver', 'olive', 'blue', 'yellow', 'teal'];

// Let's make an array of requests which will become individual polylines on the map.
function generateRequests(){

    requestArray = [];

    for (var route in jsonArray){
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
            if (data[waypoint] === lastpoint){
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

        // Grab the first waypoint for the 'start' location
        start = (waypts.shift()).location;
        // start = document.getElementById('start').value;
        // Grab the last waypoint for use as a 'finish' location
        finish = waypts.pop();
        if(finish === undefined){
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

function processRequests(){

    // Counter to track request submission and process one at a time;
    var i = 0;

    // Used to submit the request 'i'
    function submitRequest(){
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

    function nextRequest(){
        // Increase the counter
        i++;
        // Make sure we are still waiting for a request
        if(i >= requestArray.length){
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


@stop
