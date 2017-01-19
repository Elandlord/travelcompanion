<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width">
        <title>@yield('title') || TravelCompanion</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">
        
        @include('partials.styles')

        <script>
            window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
                ]); ?>
        </script>
    </head>

    <body>


    	@include('partials.navigation')   

    	@yield('content')	

        @include('partials.footer')

        @include('partials.scripts')

    </body>

</html>
