
<template>
	<div class='space-outside-up-sm'>
        <input id="searchbar" type="text" style="width:250px; display:inline-block;" class="form-control" placeholder="Where do you want to go?" v-model="searchParameters">
    	<button @click="search()" onclick="searchHotelApi()" style="display: inline-block; margin-bottom:3px;" class="btn bg-accent text-color-light hover-darken-accent transition-normal"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
</template>

<script>
    import Weather from '../Models/Weather';
    export default {


    	data() {
		   return {
		      searchParameters: null,
		   }
		},

    	methods:
    	{
    		search(){
                Event.fire('searching');
                Weather.search(this.searchParameters, weather => Event.fire('weatherFound', weather) );
    		}

    	},


        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
