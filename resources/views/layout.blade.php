<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>TwelfthMan Image Library SPA Test</title>

    <!-- Styles -->
    <link href="css/bootstrap.min.css" media="all" rel="stylesheet" />
    <link href="css/app.css" media="all" rel="stylesheet" />
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="row heading-row">
                <h1>My Library</h1>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            @yield('content')
        </div>
    </div>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
</body>
</html>
