
<template>
    <div id="map-planner">
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
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component map-planner mounted.')
        }
    }
</script>
