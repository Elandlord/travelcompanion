<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">
        <title>@yield('title') || TravelCompanion</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

        @include('partials.styles')

      
    </head>

    <body>
        <div id="app">
            @include ('layouts.header-vue')

            <section class="section">
                <div class="container">
                    <router-view></router-view>
                </div>
            </section>

  @yield('content')

        </div>

        <script src="/js/app.js"></script>


        @include('partials.footer')

        @include('partials.scripts')

    </body>

</html>
