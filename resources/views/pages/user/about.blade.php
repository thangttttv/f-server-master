<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    <title>About Us</title>
</head>
<body>

@include('layouts.user.landing-header')

<div class="p-aboutUs">
    <h1 class="p-aboutUs-header">About us</h1>
    <section class="p-aboutUs-desc">We are a car wrapping advertising company <br> We will utilize technology
        to provide an unprecedented advertising system
    </section>
    <section class="p-aboutUs-banner">
        <img src="{!! \URLHelper::asset('images/about-banner.jpg', 'advertiser') !!}" style="width: 100%" alt="">
    </section>
    <div class="p-aboutUs-container">
        <figure class="p-aboutUs-office">
            <div class="p-aboutUs-officeMap"><img src="{!! \URLHelper::asset('images/map.jpg', 'advertiser') !!}" alt="">
            </div>
            <div class="p-aboutUs-officeInfo">
                <p class="p-aboutUs-officeInfoLocation">Japan ( Head office)</p>
                <p class="p-aboutUs-officeInfoName">Flare Inc.</p>
                <p class="p-aboutUs-officeInfoDetail">246 Times Square Building 10th FL, Room 10/04, Sukhumvit 12-14 RD.,
                    Klongtoey Llongtoey, Bangkok 10110</p>
            </div>
        </figure>
        <figure class="p-aboutUs-office">
            <div class="p-aboutUs-officeMap"><img src="{!! \URLHelper::asset('images/map.jpg', 'advertiser') !!}" alt="">
            </div>
            <div class="p-aboutUs-officeInfo">
                <p class="p-aboutUs-officeInfoLocation">Japan ( Head office)</p>
                <p class="p-aboutUs-officeInfoName">Flare Inc.</p>
                <p class="p-aboutUs-officeInfoDetail">246 Times Square Building 10th FL, Room 10/04, Sukhumvit 12-14 RD.,
                    Klongtoey Llongtoey, Bangkok 10110</p>
            </div>
        </figure>
        <figure class="p-aboutUs-office">
            <div class="p-aboutUs-officeMap"><img src="{!! \URLHelper::asset('images/map.jpg', 'advertiser') !!}" alt="">
            </div>
            <div class="p-aboutUs-officeInfo">
                <p class="p-aboutUs-officeInfoLocation">Japan ( Head office)</p>
                <p class="p-aboutUs-officeInfoName">Flare Inc.</p>
                <p class="p-aboutUs-officeInfoDetail">246 Times Square Building 10th FL, Room 10/04, Sukhumvit 12-14 RD.,
                    Klongtoey Llongtoey, Bangkok 10110</p>
            </div>
        </figure>
    </div>
</div>

@include('layouts.user.footer')

<script type="text/javascript" src="{!! \URLHelper::asset('js/jquery/dist/jquery.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/what-input/dist/what-input.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/foundation.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/plugins/foundation.orbit.min.js', 'advertiser') !!}"></script>
<script type="text/javascript" src="{!! \URLHelper::asset('js/app.min.js', 'advertiser') !!}"></script>

</body>
</html>

