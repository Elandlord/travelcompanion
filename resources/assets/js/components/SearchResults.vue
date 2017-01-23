<template>
    <div>
        <p style='font-size:20px;'>
            {{ searchResults }}
        </p>

        <div id="hotel-results"></div>
    </div>


</template>

<script>
    export default {

    	data(){
		   return{
		      searchResults: "",
              loading: false,
		   }
		},

        mounted() {
            console.log('Component mounted.')
        },

        created(){

            Event.listen('searching', () => {
               this.loading = true;
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
