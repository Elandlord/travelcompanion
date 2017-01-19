    
<template>
	<div class='space-outside-up-sm'>
        <input type="text" style="width:250px; display:inline-block;" class="form-control" placeholder="Where do you want to go?" v-model="searchParameters">
    	<button @click="search()" style="display: inline-block; margin-bottom:3px;" class="btn bg-accent text-color-light hover-darken-accent transition-normal"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</template>

<script>
    export default {


    	data() {
		   return {
		      searchParameters: null,
		      results: null,
		   }
		},

    	methods:
    	{
    		search(){
			   axios.get('search-hotels?searchParameters=' + this.searchParameters).then((response) => {
			         // succeeded, save data to a data instance in this vue object
			         this.results = response.data;
			         Event.fire('searchResultsFound', this.results);
				 });
    		}
    	},


        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
