<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">

        </script>
        <style type="text/css">
            @import url('https://fonts.googleapis.com/css?family=PT+Sans|Raleway');
            body, html {
                height: 100vh;
                margin: 0;
                background-color: #333;
                color: #ddd;
                font-family: 'PT Sans', Helvetica, sans-serif;
            }

            .container {
                align-items: center;
                display: flex;
                justify-content: center;
                height: 100vh;
            }

            .container > .content {
                width: 50%;
            }

            .container > .content > .searchbox,
            .container > .content > .searchbox > form > input {
                width: 100%;
            }

            .container > .content > .searchbox > form > input {
                border-top: none;
                border-left: none;
                border-right: none;
                border-bottom: 2px solid blue;
                background-color: transparent;
                padding: 5px;
                font-size: 16px;
                font-family: 'PT Sans';
                color: #ddd;
            }

            .container > .content > .copy > p {
                text-align: center;
            }
        </style>
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