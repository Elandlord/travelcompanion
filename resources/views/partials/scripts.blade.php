<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/wow.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>
    new WOW().init();
</script>
ma 23/1 om  13.30 uur
<script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $(function () {
            $('#datetimepicker1').datetimepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    });
</script>

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
                html += `<div class=\"row\">
    <div class=\"col-lm-12\">
        <i v-if=\"loading\" class=\'fa fa-cog fa-spin fa-3x fa-fw\'></i>
        <div class=\"search-result row\">
            <div class=\"col-xs-12 col-sm-12 col-md-3\">
                <a href=\"#\" title=\"Lorem ipsum\" class=\"thumbnail\"><img
                            src=\"https://exp.cdn-hotels.com/hotels/11000000/10980000/10977200/10977169/10977169_80_z.jpg\"
                            alt=\"Lorem ipsum\"/></a>
            </div>
            <div class=\"col-xs-12 col-sm-12 col-md-7\">
                <h3 class=\'text-color-accent\'>` + results[i].name + `</h3>
                <p class=\'font-weight-light\'>
                    ` + results[i].formatted_address + `
                </p>
                <div class=\'row space-outside-md\'>
                    <div class=\'col-lg-8\'>
                        <div class=\'input-group date\' id=\'datetimepicker1\'>
                            <input type=\'text\' class=\"form-control\"/>
                            <span class=\"input-group-addon\">
                                            <span class=\"glyphicon glyphicon-calendar\"></span>
                                        </span>
                        </div>
                    </div>
                    <div class=\'col-lg-4\'>
                        <button type=\"submit\"
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

</script>


