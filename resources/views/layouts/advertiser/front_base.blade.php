<!doctype html>
<html class="no-js p-resetPassword" lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    @yield('styles')
    <title>@yield('title', config('site.name', '') . ' | Advertiser Dashboard')</title>
</head>
<body>

@yield('content')

@include('layouts.advertiser.scripts')
@yield('scripts')

</body>
</html>
