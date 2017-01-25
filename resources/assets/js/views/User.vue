<template>
    <div class="container">
        <div class="row animated fadeInLeft wow">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Profieloverzicht</div>

                    <div class="panel-body text-center" v-if="user != null">
                        <h2 v-text="user.name" class='space-outside-md'> </h2>

                        <img :src="user.photo_link" style='margin:0 auto;' class="img-responsive circular"/>
                        <p class='font-md space-outside-sm' v-text="user.email"> </p>
                        <p class='font-md' v-text="user.created_at"> </p>
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

            },



            methods:
                {
            


                },
        		
        }
</script>
