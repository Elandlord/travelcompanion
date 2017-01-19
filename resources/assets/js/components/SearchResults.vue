<template>
	<div>
		<p style='font-size:20px;'>
		{{ searchResults }}
		</p>
	</div>
</template>

<script>
    export default {

    	data(){
		   return{
		      searchResults: "",
		   }
		},

        mounted() {
            console.log('Component mounted.')
        },

        created(){
        	Event.listen('searchResultsFound', (searchResults) => {
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
