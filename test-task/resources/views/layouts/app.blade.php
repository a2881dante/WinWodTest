<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>{{_('Тестовое')}}</title>
</head>
<body>

<div class="row justify-content-center content" style="margin: 15px -15px 0px;">
    <div class="col-10" style="padding: 0px 0px 25px;">

        @yield("contents")

    </div>
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>