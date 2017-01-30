<template>
<div>

    <map-planner>
        <div style="height: 400px;" id="map-canvas"></div>
    </map-planner>

    <section class='space-outside-md'>
        <div class="container"> 
            <search-results>

            </search-results>
        </div>
    </section>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
