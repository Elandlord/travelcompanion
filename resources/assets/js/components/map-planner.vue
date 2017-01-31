
<template>
    <div id="map-planner">
        <div id="maps_interface" class="space-inside-xs">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control space-outside-sm" id="tripName" onKeyPress="edValueKeyPress()" onKeyUp="edValueKeyPress()" type="text" name="" value="" placeholder="Name of your trip" required/>
                        <input v-model="searchParameters" class="form-control" id="locationText" type="text" placeholder="Place of departure" required/>
                        <input type="date" id="departure_date" name="date" class="form-control space-outside-sm" onchange="setMinDate()" required>
                        <input type="date" id="return_date" name="date" class="form-control" min="" required>
                        <button class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-sm" @click="addToLocations()" id="addNewLocation" onclick="addNewLocation();">Add destination</button>
                        <button class="btn bg-accent text-color-light hover-darken-accent transition-normal" @click="searchWeather()" onclick="generateRequests();" type="button" name="button">Show trip</button>
                        <button class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-sm" onclick="saveTrip();">Save trip</button>
                    </div>
                </div>
            </div>

        <div class='container text-center space-outside-md' v-if="loading">
            <i class='fa fa-cog fa-spin fa-5x fa-fw text-color-accent'></i>
            <p class='text-color-accent space-outside-md font-md '>Searching</p>
        </div>

        <div id="google_maps">
            <div class='container space-outside-md'>
                <div class="col-xs-12">
                    <h1 class='space-outside-sm text-center text-color-accent'>Trip overzicht</h1>
                    <ul id="list" class="cbp_tmtimeline">
                        <li class="list_item">
                            <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                            <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                                <h2 id="location_title" class='text-color-light'>Trip name</h2>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 ">
                        <slot></slot>
                    </div>
                </div>
                </div>
            </div>

    </div>
</div>
</template>

<script>
    import Weather from '../Models/Weather';
    export default {
        data() {
		   return {
		      searchParameters: null,
		      locations:[],
              loading: false,
		   }
		},

        created(){
            Event.listen('searching', () => {
               this.loading = true;
            });

            Event.listen('weatherFound', (weather) => {
                this.loading = false;
            });
        },

    	methods:
    	{
    	    squash(arr){
                var tmp = [];
                for(var i = 0; i < arr.length; i++){
                    if(tmp.indexOf(arr[i]) == -1){
                        tmp.push(arr[i]);
                    }
                }
                return tmp;
            },

    	    addToLocations(){
    	        this.locations.push(this.searchParameters);
    	    },
    		searchWeather(){
    		    Event.fire('searching');
    		    //var uniqueLocations = this.squash(locations);
            var uniqueLocations = this.locations;
    		    for(var j = 0; j < uniqueLocations.length; j++){
    		        Weather.search(uniqueLocations[j], weather => Event.fire('weatherFound', weather) );
    		    }
    		}


    	},
        mounted() {
            console.log('Component map-planner mounted.')
        }
    }
</script>
