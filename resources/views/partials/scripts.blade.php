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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbWPLb40f0QoQrIK3T-A27E9jwURduLXw&libraries=places"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#searchbar").keyup(function () {
            var searchParameters = $("#searchbar").val();
            if (searchParameters.length < 4) {
                $("#searchResults").hide();
            } else {
                var service = new google.maps.places.PlacesService($('#results').get(0));
                var request = {
                    query: searchParameters,
                    types: ['lodging']
                };
                service.textSearch(request, searchCallback);
            }
        });
    });

    function searchCallback (results, status){
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            var html = "<ul class='result-list'>";
            for (var i = 0; i < results.length; i++) {
                html += "<li><a class='searchlink' href=\"\"><b>" + results[i].name + "</b> - " + results[i].rating + "</a></li>";
            }
            html += "</ul>";
            $('#searchResults').html(html).slideDown();
        }
    }

</script>
