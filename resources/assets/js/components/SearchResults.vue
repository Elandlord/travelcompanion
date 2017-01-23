<template>
	<div>

        <div class='container text-center space-outside-md'' v-if="loading">
        <i class='fa fa-cog fa-spin fa-5x fa-fw text-color-accent'></i>
        <p class='text-color-accent space-outside-md font-md'>Searching</p>
    </div>

    <div class="jumbotron" v-if="foundResults">
        <div class="container">

            <div class='right'>
                <p  v-text="weather.temperature()" style="display: inline;"></p>

                C

                <img :src="weather.icon()" style="display: inline; width: 70px;" />
            </div>

            <div class='left'>

                <h2 v-text="weather.cityName()" style="display: inline;"></h2>, <h2 v-text="weather.country()" style="display: inline;"></h2>

                <p class='text-color-accent space-outside-xs' v-text="weather.weatherType()"></p>

                <p class='space-outside-xs' v-text="weather.dressingAdvice()"></p>

            </div>

        </div>
    </div>

        <div id="hotel-results"></div>
    </div>


</template>

<script>

    export default {

        data(){
            return{
                searchResults: "",
                loading: false,
                weather: null,
                foundResults: false,
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        created(){

            Event.listen('searching', () => {
               this.loading = true;
            });


            Event.listen('weatherFound', (weather) => {
                this.loading = false;
                this.weather = weather;
                this.foundResults = true;
            });


        	Event.listen('searchResultsFound', (searchResults) => {
               this.loading = false;
			   this.setSearchResults(searchResults);
			});
        },


        methods:
        {
	    	/**
			 * setter for searchResults
			 * @param {[type]} searchResults [description]
			 */
			setSearchResults(searchResults) {
			   this.searchResults = searchResults;
			},
        }
    }




</script>
