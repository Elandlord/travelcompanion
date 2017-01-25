<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

<!-- <script>
$(document).on('click','.vue-nav',function(e) {
    console.log("close");

    $('#expand-bootstrap-nav').hide();
});
</script> -->

<div style="display: none" id="results"></div>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbWPLb40f0QoQrIK3T-A27E9jwURduLXw&libraries=places"></script>
<script type="text/javascript">

    function searchHotelApi() {
        var searchParameters = $("#searchbar").val();
        var service = new google.maps.places.PlacesService($('#results').get(0));
        var request = {
            query: searchParameters,
            types: ['lodging']
        };
        service.textSearch(request, searchCallback);
    }

    function searchCallback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var html = "";
            console.log(results);
            for (var i = 0; i < results.length; i++) {
                var rating = "";
                if(results[i].rating){
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

                        <button type=\"submit\" onclick=\"bookHotel(\'` + results[i].name + `\',\'` + results[i].formatted_address + `\',\'`+ i +`\')\"
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
            $('#hotel-results').html(html);
        }
    }

    function bookHotel(hotelname, adress, dateTimeId) {
        var post = {};

        //TODO check id date is selected
        var arrivalid = "arrival" + dateTimeId;
        var departureid = "departure" + dateTimeId;
        post['arrival_date'] = document.getElementById(arrivalid).value;
        post['departure_date'] = document.getElementById(departureid).value;
        //seperate the whole string by comma
        var adressArray = adress.split(",");

        //seperate the roadname and housenumber
        var splitRoadname = adressArray[0].split(' ');

        //the housenumber is the last index of the array
        var houseNumber = splitRoadname[splitRoadname.length - 1];

        //puzzle the roadname back together
        var roadname = "";
        for (var j = 0; j < (splitRoadname.length - 1); j++){
            roadname += " " + splitRoadname[j];
        }

        // seperate the cityname fromm the zipcode and puzzle the zipcode back together
        var zipCode = "";
        var splitZipCode = adressArray[1].split(' ');
        for (var k = 0; k < (splitZipCode.length - 1); k++){
            zipCode += " " + splitZipCode[k];
        }

        //the last index of the zipcode is the cityname
        var cityName = splitZipCode[splitZipCode.length -1];

        //the last index of the entire adress array is the countryname
        var countryName = adressArray[adressArray.length -1];

        post['hotel'] = {};
        post['hotel']['name'] = hotelname;
        post['hotel']['road_name'] = roadname.trim();
        post['hotel']['house_number'] = houseNumber.trim();
        post['hotel']['zip_code'] = zipCode.trim();
        post['hotel']['city_name'] = cityName.trim();
        post['hotel']['country_name'] = countryName.trim();

        console.log(post);

//        post['hotels'] = ['name' => hotelname, ]
//        $.post( "url", hotel , function( data, status ) {
//            if (status){
//
//            }
//        });
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


<script>
    new WOW().init();
</script>