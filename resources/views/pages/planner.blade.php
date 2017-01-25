  @extends('master')

  @section('title')
  Planner
  @stop

  @section('content')


  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4bbyifwfej8H4k5dCeTIV_tyFMfK8H4c&sensor=false"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<!-- Style to put some height on the map -->
<style type="text/css">
    #map-canvas { height: 500px };
</style>

<!-- Remove <br> when going online -->
<br>
<br>

<div id="maps_interface" class="bg-main space-inside-xs">
  <div class="row">
    <div class="container">
      <div class="col-lg-12">
        <div class="col-lg-3">
          <input class="form-control" id="start" type="text" placeholder="Vertrek" />
        </div>

        <div class="col-lg-3">
          <input class="form-control" id="locationText" type="text" placeholder="Bestemming" />
        </div>
        <button class="btn bg-accent text-color-light hover-darken-accent transition-normal" id="addNewLocation" onclick="addNewLocation();">Voeg Bestemming toe</button>
        <button class="btn bg-accent text-color-light hover-darken-accent transition-normal" onclick="generateRequests();"type="button" name="button">Maak Trip</button>
      </div>
    </div>
  </div>
</div>

<div id="google_maps">
  <div class="row">
    <div class="container">
      <div class="col-lg-9">

      </div>

      <div class="col-lg-3">
        <h3>Locaties</h3>

        <!-- <ul id="list" class="cbp_tmtimeline">
            <li>
                <time class="cbp_tmtime"><span>from 21/1/17 to 24/1/17</span> <span>Groningen</span></time>
                <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                    <h2 class='text-color-light'>Hotel Villa Torlania</h2>
                    <p class='text-color-light'>Generic Road 17, DD0123 Groningen</p>
                </div>
            </li>
            <li>
                <time class="cbp_tmtime"><span>from 24/1/17 to 26/1/17</span> <span>Berlin</span></time>
                <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                    <h2 class='text-color-light'>Hotel Boiler Room</h2>
                    <p class='text-color-light'>Generic Road 17, DD0123 Berlin</p>
                </div>
            </li>
            <li>
                <time class="cbp_tmtime"><span>from 26/1/17 to 29/1/17</span> <span>Warschau</span></time>
                <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                    <h2 class='text-color-light'>Hotel Spierdalaj Kurwa</h2>
                    <p class='text-color-light'>Generic Road 17, DD0123 Warschau</p>
                </div>
            </li>
             <li>
                <time class="cbp_tmtime"><span>30/1/17</span> <span>Return date</span></time>
                <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                    <h2 class='text-color-light'>Return to Groningen</h2>
                    <p class='text-color-light'></p>
                </div>
            </li>
        </ul> -->
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
// Declare location array
var locations = [];

// Button bindings
var locationButton = document.getElementById("addNewLocation");
locationButton.onclick = addNewLocation;

// Add new location to Maps
function addNewLocation() {
  // get Location from inputfrield by ID
  var location = document.getElementById("locationText").value;

  // Push Location in Array
  locations.push(location);

  // Reset inputfield for another location
  document.getElementById("locationText").value = "";

  // Create Li element
  var node = document.createElement("LI");

  // Create tekst for element
  var textnode = document.createTextNode(location);

  //Append element
  node.appendChild(textnode);

  document.getElementById("list").appendChild(node);

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

// A JSON Array containing some people/routes and the destinations/stops
var jsonArray = makeJsonObject();

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
    console.log('iets');
    console.log(map);
}

    // Get the ball rolling and trigger our init() on 'load'
    google.maps.event.addDomListener(window, 'load', init);
</script>

<div id="map-canvas">

</div>

@stop
