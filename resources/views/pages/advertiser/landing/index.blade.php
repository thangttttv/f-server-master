<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    <title>Advertiser Landing Page</title>
</head>
<body>

@include('layouts.advertiser.landing-header')

<section class="p-landingAgency-block-1">
    <div class="p-landingAgency-block-1--container">
        <div class="p-landingAgency-block-1--content">
            <p>Have <br>your brand <br>driven</p>
            <a class="p-landingAgency-block-1--content__button" href="#">Get demo</a>
        </div>
    </div>
</section>
<section class="p-landingAgency-block-2" id="getStarted">
    <div class="p-landingAgency-block-2--container">
        <div class="p-landingAgency-block-2--content">
            <h2 class="p-landingAgency-block-2--content__header">Start now !</h2>
            <p class="p-landingAgency-block-2--content__text">Our app helps you earn money as you drive! Compensate fort your
                vehicle expenses such as gas, car washes, and parking by driving with us.</p>
            <div class="p-landingAgency-block-2--content__video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/2i2khp_npdE" frameborder="0"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<section class="p-landingAgency-block-3" id="features">
    <div class="p-landingAgency-block-3--container">
        <div class="p-landingAgency-block-3--content">
            <h2 class="p-landingAgency-block-3--content__header">Featured</h2>
            <div class="p-landingAgency-block-3--content__items">
                <figure class="p-landingAgency-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/landing_agency_feature_1.png', 'advertiser') !!}" alt="">
                    <h3>Scale advertise</h3>
                    <figcaption>Our stickers are safe for your car paint</figcaption>
                </figure>
                <figure class="p-landingAgency-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/landing_agency_feature_2.png', 'advertiser') !!}" alt="">
                    <h3>Real time tracking</h3>
                    <figcaption>Drive as usual & earn money for gasoline, car wash or car parking</figcaption>
                </figure>
                <figure class="p-landingAgency-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/landing_agency_feature_3.png', 'advertiser') !!}" alt="">
                    <h3>Economical</h3>
                    <figcaption>Our stickers are safe for your car paint</figcaption>
                </figure>
                <figure class="p-landingAgency-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/landing_agency_feature_4.png', 'advertiser') !!}" alt="">
                    <h3>Analytics report</h3>
                    <figcaption>Stand out of the crowd with our great design stickers</figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>
<section class="p-landingAgency-block-4" id="clients">
    <div class="p-landingAgency-block-4--container">
        <h3 class="p-landingAgency-block-4--content__header">Our client</h3>
        <div class="p-landingAgency-block-4--content__items">
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_1.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_2.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_3.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_4.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_5.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_4.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_5.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_2.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_3.png', 'advertiser') !!}" alt="">
            </div>
            <div class="p-landingAgency-block-4--content__item">
                <img src="{!! \URLHelper::asset('images/client_1.png', 'advertiser') !!}" alt="">
            </div>
        </div>
    </div>
</section>
<section class="p-landingAgency-block-5" id="demo">
    <div class="p-landingAgency-block-5--content">
        <h3 class="p-landingAgency-block-5--content__header">Get Your Brand Out There For A Fraction Of Price </h3>
        <a class="p-landingAgency-block-5--content__button" href="#">Get demo</a>
    </div>
</section>
<footer class="p-landingAgency-footer">
    <div class="p-landingAgency-footer--content">
        <div class="p-landingAgency-footer--menu">
            <ul>
                <li><a href="{!! URL::action('User\IndexController@about') !!}">About</a></li>
                <li><a href="{!! URL::action('User\IndexController@faq') !!}">FAQ</a></li>
                <li><a href="{!! URL::action('Advertiser\LandingController@terms') !!}">Terms</a></li>
                <li><a href="{!! URL::action('User\IndexController@policy') !!}">Privacy Policy</a></li>
                <li><a href="{!! URL::action('User\IndexController@contact') !!}">Contact</a></li>
            </ul>
        </div>
        <div class="p-landingAgency-footer--divider"></div>
        <div class="p-landingAgency-footer--social">
            <a href="#"><img src="{!! \URLHelper::asset('images/social_1.png', 'advertiser') !!}" alt=""></a>
            <a href="#"><img src="{!! \URLHelper::asset('images/social_2.png', 'advertiser') !!}" alt=""></a>
        </div>
    </div>
</footer>
<script type="text/javascript" src="{!! \URLHelper::asset('js/jquery/dist/jquery.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/what-input/dist/what-input.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/foundation.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/plugins/foundation.orbit.min.js', 'advertiser') !!}"></script>
<script type="text/javascript" src="{!! \URLHelper::asset('js/app.min.js', 'advertiser') !!}"></script>
<script>
    var $root = $('html, body');
    $('a').click(function() {
        var href = $.attr(this, 'href');
        $root.animate({
            scrollTop: $(href).offset().top
        }, 500, function () {
            window.location.hash = href;
        });
        return false;
    });
</script>
</body>
</html>

