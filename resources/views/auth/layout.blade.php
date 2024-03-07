<!DOCTYPE html>
<html>

    <head>
        <title>My Awesome Login Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
        <link rel="stylesheet" href="{{ asset("admin/dist/css/auth.css") }}">
    </head>
    <body>
        <div class="container h-100">
            <div class="overlay-snipper">
                <div class="snipper-image" role="alert">
                    <img src="{{ asset('/picture/done.gif') }}">
                </div>
            </div>
            <div class="d-flex justify-content-center h-100">
                @yield("content")
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="{{asset("admin/dist/js/auth.js")}}" type="text/javascript"></script>
    </body>
</html>
