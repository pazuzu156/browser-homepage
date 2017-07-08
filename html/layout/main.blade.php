<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script> --}}
        {{-- {!! Html::script('https://code.jquery.com/jquery-3.2.1.min.js') !!} --}}
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="searchbox">
                    @yield('content')
                </div>
                <div class="copy">
                    <p>&copy; 2017 Kaleb Klein.</p>
                </div>
            </div>
        </div>
    </body>
</html>
