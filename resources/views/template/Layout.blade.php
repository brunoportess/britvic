<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Fonts
    ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{url(mix('css/bootstrap.css'))}}">
    <!-- STYLE -->
    <link rel="stylesheet" href="{{url(mix('css/app.css'))}}">
    <title>Teste Britvic</title>
</head>
<body>
@include('template.TopNavBar')
<div id="app" class="container pt-5">
    @yield('content')
</div>
<script src="{{url(mix('js/jquery.js'))}}"></script>
<script src="{{url(mix('js/bootstrap.js'))}}"></script>
<script src="{{url(mix('js/app.js'))}}"></script>
</body>
</html>
