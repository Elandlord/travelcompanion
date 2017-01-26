<template>
    <div class="container">
        <div class="row animated fadeInLeft wow">
            <div class='col-lg-12'>
                <div class='text-center' v-if="user != null"><h2 style='display: inline;''>Trip overview from: </h2><h2 class='text-thin' style='display: inline;' v-text="user.name"></h2></div>
                   
                <ul v-if="user != null" class='list-group space-outside-up-md animated fadeInLeft wow' id="routeslist">
                  <li v-for="route in user.routes" class="list-group-item">


                        <h3>{{ route.name }}</h3>
                         from {{ route.departure_date }}
                         to {{ route.return_date }}
                        

                        <button @click="tripOverview(route)" class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-down-md space-outside-sides-md">View</button>
                  </li>
                </ul>


                <div v-if="locations != null" class="animated fadeInLeft wow">

                    <button @click="initialSettings()" class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-down-md space-outside-sides-md">Go back</button>

                    <ul class='cbp_tmtimeline' id="locationslist">

                        <li v-for="location in locations">
                           <time class="cbp_tmtime"><span>from {{ location.pivot.arrival_date }} to {{ location.pivot.departure_date }}</span> <span>{{ location.name }}</span></time>
                            <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                            <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                                <h2 class='text-color-light'>HOTEL HIER INLADEN</h2>
                                <p class='text-color-light'>ANDERS BOEKEN</p>
                            </div>
                        </li>
                        <li>
                        <time class="cbp_tmtime"><span></span> <span>End of trip</span></time>
                            <div class="cbp_tmicon">:(</div>
                            <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                                <h2 class='text-color-light'></h2>
                                <p class='text-color-light'></p>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../Models/User';
import Route from '../Models/Route';
import Location from '../Models/Location';
    export default {

            data() {
                return {
                    user: null,
                    route: null,
                    locations: null,
                }
            },

            created() {
                this.initialSettings();
            },



            methods: {

                // ---- setters and getters 


                // ---- component functions

                initialSettings(){
                    this.locations = null;
                    // User.with('routes', (route) => {
                    //     return new Route(route);
                    // }).getAuthenticated((user) => {
                    //     this.user = user;
                    // });



                    User.getAuthenticated((user) => {
                        user.with('routes', (route) => {
                            return new Route(route);
                        });

                        setTimeout(() => {
                            this.user = user;
                        }, 500);

                    });
                },

                tripOverview(route){
                    route = new Route(route);

                    this.user = null;

                    route.with('locations', (location) => {
                        return new Location(location);
                    });

                    setTimeout(() => {
                        this.locations = route.locations;
                        console.log(this.locations);
                    },500);
                    
                }
            },
    		
        }
</script>
