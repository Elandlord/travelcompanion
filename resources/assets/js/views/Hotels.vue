<template>
    <div class="container">
        <div class="row animated fadeInLeft wow" v-if="user != null" >
            <div class='col-lg-12'>
                <div class='text-center' v-if="user != null">
                    <h2 style='display: inline;''>Hotel overview from: </h2>
                    <h2 class='text-thin' style='display: inline;' v-text="user.name"></h2>
                </div>

                <ul v-if="user != null" class='list-group space-outside-up-md animated fadeInLeft wow' id="hotelslist">
                    <li v-for="hotel in user.hotels" class="list-group-item">

                        <h3>{{ hotel.pivot.arrival_date }} t/m {{ hotel.pivot.departure_date }}</h3>
                        <h3>{{ hotel.name }}</h3>
                        <p>{{ hotel.road_name }} {{ hotel.house_number }}</p>
                        
                        <button @click="hotelOverview(hotel)" class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-xs">View</button>
                        
                    </li>
                </ul>

            </div>
        </div>
        <div class="row animated fadeInLeft wow" v-if="hotel != null" >
            <div class='col-lg-10 space-outside-sm'>
                <h1 class='text-color-accent'>{{ hotel.name }}</h1>
            </div>
            <div class='col-lg-2 space-outside-sm'>
                <button @click="initialSettings()" class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-xs">Go back</button>
            </div>
            <div class='col-lg-4 col-xs-12 col-sm-12'>
                <img src="http://lorempixel.com/400/200/city/" class='img-responsive' />
            </div>
            <div class='col-lg-8 col-xs-12 col-sm-12'>
                <p>Road name: {{ hotel.road_name }}</p>
                <p>House number: {{ hotel.house_number}}</p>
                <p>Zip code: {{ hotel.zip_code }}</p>
                <p>Phone number: {{ hotel.phone_number }}</p>
                <p>Email address: {{ hotel.email_address }}</p>
                <br/>
                <h3>You're staying here from {{ hotel.pivot.arrival_date }} untill {{ hotel.pivot.departure_date }}</h3>
                <h3>Total costs: {{ hotel.pivot.price }}</h3>
                <h3>Amount of persons: {{ hotel.pivot.amount_persons }}</h3>

                <h3 style='color: red;' v-if="hotel.pivot.paid == 0">NOT PAID</h3>
                <h3 style='color: green' v-if="hotel.pivot.paid == 1">PAID by {{ hotel.pivot.bank_account_number }}</h3>

            </div> 
            <div class='col-lg-12 space-outside-sm'>
                <p>{{ hotel.description }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import Hotel from '../Models/Hotel';
import User from '../Models/User';
    export default {

            data() {
                return {
                    hotel: null,
                    user: null,
                }
            },

            created() {
                this.initialSettings();
            },

            methods: {

                initialSettings(){
                    this.hotel = null;

                    User.getAuthenticated((user) => {
                        user.with('hotels', (hotel) => {
                            return new Hotel(hotel);
                        });

                        setTimeout(() => {
                            this.user = user;
                        }, 1000);

                    });
                },

        	   hotelOverview(hotelData){
                    this.user = null;

                    setTimeout(() => {
                        this.hotel = hotelData;
                        console.log(this.hotel);
                    }, 1000);
               }
            }
        }
</script>
