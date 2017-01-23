<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profieloverzicht</div>

                    <div class="panel-body" v-if="user != null">
                        <img :src="user.photo_link" class="img-responsive"/>
                        <p v-text="user.email"> </p>
                        <p v-text="user.name"> </p>
                        <p v-text="user.created_at"> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import User from '../Models/User';
    export default {

            data() {
                return {
                    user: null,
                }
            },

            mounted() {
                User.getAuthenticated((user) => this.user = user);


                    console.log(this.user);

            },



            methods:
                {
            


                },
        		
        }
</script>
