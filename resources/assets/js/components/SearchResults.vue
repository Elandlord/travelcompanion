<template>
	<div>
		<p style='font-size:20px;'>
            {{ searchResults }}
        </p>

        <i v-if="loading" class='fa fa-cog fa-spin fa-3x fa-fw'></i>
<!-- 				
                <div class="search-result row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <a href="#" title="Lorem ipsum" class="thumbnail"><img src="https://exp.cdn-hotels.com/hotels/11000000/10980000/10977200/10977169/10977169_80_z.jpg" alt="Lorem ipsum" /></a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-2">
                        <ul class="meta-search font-md">
                            <li><i class="glyphicon glyphicon-calendar"></i> <span>11-1-2017</span></li>
                            <li><i class="glyphicon glyphicon-time"></i> <span>9:00 AM to 6:00PM</span></li>
                            <li><i class="glyphicon glyphicon-tags"></i> <span>Rome</span></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <h3 class='text-color-accent'>Hotel Villa Torlonia</h3> 
                          <p class='font-weight-light'>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis finibus molestie nunc. Donec vitae nibh velit. Nunc vulputate congue tincidunt. Quisque volutpat rutrum volutpat. Praesent ut varius mi. Donec a arcu ultrices leo porttitor cursus. Praesent consequat congue velit, a tristique dui mollis vel. Maecenas at molestie ipsum. Nullam mollis, nunc vel condimentum suscipit, lectus augue dignissim metus, vitae blandit nibh neque vel nulla. Integer ut urna vehicula, fermentum dolor volutpat, tincidunt mi. Nunc molestie mi quis aliquet ornare.
                            </p>
                            <br/>
                            <p>

    Pellentesque et arcu venenatis, semper quam eget, fringilla orci. Aliquam a eros ut purus luctus tempus. Integer velit felis, aliquet non sollicitudin eu, malesuada quis nisi. Nunc sed efficitur elit. Pellentesque ornare, elit et maximus accumsan, erat nulla imperdiet mi, sit amet venenatis neque sapien id nisl. Aliquam ultricies vel magna a sodales. Etiam vestibulum porta enim eget maximus. Aenean sed odio consectetur, suscipit ante vel, vestibulum felis.</p>

                        <div class='row space-outside-md'>
                                <div class='col-lg-8'>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                 </div>
                                <div class='col-lg-4'>
                                <button type="submit" class="btn bg-accent text-color-light hover-darken-accent transition-normal">Book now!</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

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
