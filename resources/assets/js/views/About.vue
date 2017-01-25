<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <h1 class='text-center'>Trip: Eastern Europe</h1>

                <button class="btn bg-accent text-color-light hover-darken-accent transition-normal space-outside-down-md space-outside-sides-md">Go back</button>

                <ul class="cbp_tmtimeline">
                    <li>
                        <time class="cbp_tmtime"><span>from 21/1/17 to 24/1/17</span> <span>Groningen</span></time>
                        <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                        <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                            <h2 class='text-color-light'>Hotel Villa Torlania</h2>
                            <p class='text-color-light'>Generic Road 17, DD0123 Groningen</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>from 24/1/17 to 26/1/17</span> <span>Berlin</span></time>
                        <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                        <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                            <h2 class='text-color-light'>Hotel Boiler Room</h2>
                            <p class='text-color-light'>Generic Road 17, DD0123 Berlin</p>
                        </div>
                    </li>
                    <li>
                        <time class="cbp_tmtime"><span>from 26/1/17 to 29/1/17</span> <span>Warschau</span></time>
                        <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                        <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                            <h2 class='text-color-light'>Hotel Spierdalaj Kurwa</h2>
                            <p class='text-color-light'>Generic Road 17, DD0123 Warschau</p>
                        </div>
                    </li>
                     <li>
                        <time class="cbp_tmtime"><span>30/1/17</span> <span>Return date</span></time>
                        <div class="cbp_tmicon"><i class="fa fa-home" aria-hidden="true"></i></div>
                        <div class="cbp_tmlabel bg-main-hover-lighten-xs transition-fast">
                            <h2 class='text-color-light'>Return to Groningen</h2>
                            <p class='text-color-light'></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            // axios call here.
        }
    }
</script>
