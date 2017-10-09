<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    <title>Driver Landing Page</title>
</head>
<body>

@include('layouts.user.landing-header')

<section class="c-countDown p-landingDriver-countDown">
    <div id="time_countdown" class="time-count-container">

        <div class="time_item">
            <div class="time-box">
                <div class="time-box-inner dash days_dash animated" data-animation="rollIn" data-animation-delay="300">
                                <span class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                                </span>
                    <span class="time-name">Days</span>
                </div>
            </div>
        </div>

        <div class="time_item">
            <div class="time-box">
                <div class="time-box-inner dash hours_dash animated" data-animation="rollIn" data-animation-delay="600">
                                <span class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                                </span>
                    <span class="time-name">Hours</span>
                </div>
            </div>
        </div>

        <div class="time_item">
            <div class="time-box">
                <div class="time-box-inner dash minutes_dash animated" data-animation="rollIn" data-animation-delay="900">
                                <span class="time-number">
                                <span class="digit">0</span>
                                <span class="digit">0</span>
                                </span>
                    <span class="time-name">Minutes</span>
                </div>
            </div>
        </div>

        <div class="time_item">
            <div class="time-box">
                <div class="time-box-inner dash seconds_dash animated" data-animation="rollIn" data-animation-delay="1200">
                                <span class="time-number">
									<span class="digit">0</span>
                                <span class="digit">0</span>
                                </span>
                    <span class="time-name">Seconds</span>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="p-landingDriver-block-1">
    <div class="p-landingDriver-block-1--container">
        <div class="p-landingDriver-block-1--text">
            <p class="p-landingDriver-block-1--text__header">Wrap.<br>Drive.<br>Earn money.</p>
            <p class="p-landingDriver-block-1--text__content">Download The Flare App Now!</p>
            <div class="p-landingDriver-block-1--download">
                <div class="p-landingDriver-block-1--download__code">
                    <img src="{!! \URLHelper::asset('images/img_code.jpg', 'advertiser') !!}" alt="">
                </div>
                <div class="p-landingDriver-block-1--download__store">
                    <div><img src="{!! \URLHelper::asset('images/download_appstore.png', 'advertiser') !!}" alt=""></div>
                    <div><img src="{!! \URLHelper::asset('images/download_googleplay.png', 'advertiser') !!}" alt=""></div>
                </div>
            </div>
        </div>
        <div class="p-landingDriver-block-1--img"></div>
    </div>
</section>
<section class="p-landingDriver-block-2" id="start">
    <div class="p-landingDriver-block-2--container">
        <div class="p-landingDriver-block-2--content">
            <h2 class="p-landingDriver-block-2--content__header">Start now !</h2>
            <p class="p-landingDriver-block-2--content__text">Our app helps you earn money as you drive! Compensate fort your
                vehicle expenses such as gas, car washes, and parking by driving with us.</p>
            <div class="p-landingDriver-block-2--content__video">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/2i2khp_npdE" frameborder="0"
                        allowfullscreen></iframe>
            </div>
        </div>
    </div>
</section>
<section class="p-landingDriver-block-3" id="flareIs">
    <div class="p-landingDriver-block-3--container">
        <div class="p-landingDriver-block-3--content">
            <h2 class="p-landingDriver-block-3--content__header">Flare is</h2>
            <div class="p-landingDriver-block-3--content__items">
                <figure class="p-landingDriver-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/flare_is_1.png', 'advertiser') !!}" alt="">
                    <h3>Save your car</h3>
                    <figcaption>Our stickers are safe for your car paint</figcaption>
                </figure>
                <figure class="p-landingDriver-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/flare_is_2.png', 'advertiser') !!}" alt="">
                    <h3>Earn money</h3>
                    <figcaption>Drive as usual & earn money for gasoline, car wash or car parking</figcaption>
                </figure>
                <figure class="p-landingDriver-block-3--content__item">
                    <img src="{!! \URLHelper::asset('images/flare_is_3.png', 'advertiser') !!}" alt="">
                    <h3>Great design</h3>
                    <figcaption>Stand out of the crowd with our great design stickers</figcaption>
                </figure>
            </div>
        </div>
    </div>
</section>
<section class="p-landingDriver-block-4" id="how">
    <div class="p-landingDriver-block-4--container">
        <h3 class="p-landingDriver-block-4--content__header">How Flare Works</h3>
        <div class="p-landingDriver-block-4--content">
            <div class="p-landingDriver-block-4--img"></div>
            <div class="p-landingDriver-block-4--text">
                <figure class="p-landingDriver-block-4--text__box1">
                    <div class="p-landingDriver-block-4--text__box1__header">Register your car</div>
                    <div class="p-landingDriver-block-4--text__box1__content">
                        <p>Download Flare app & register your car. It is
                            completely safe and we guarantee data confidentiality.</p>
                        <p class="p-landingDriver-block-4--text__box1__download">
                            <img src="{!! \URLHelper::asset('images/download_appstore.png', 'advertiser') !!}" alt="">
                            <img src="{!! \URLHelper::asset('images/download_googleplay.png', 'advertiser') !!}" alt="">
                        </p>
                    </div>
                </figure>
                <figure class="p-landingDriver-block-4--text__box2">
                    <div class="p-landingDriver-block-4--text__box2__header">Choose a campaign</div>
                    <div class="p-landingDriver-block-4--text__box2__content">
                        <p>Select the campaign that fits your brand or design preferences of earning expectations. <br>
                            Choose type of stickers and place them anywhere you want!The more stickers you install, the more
                            money we pay! <br>
                            Your applied application need to meet all the conditions for the campaign to be approved
                        </p>
                    </div>
                </figure>
                <figure class="p-landingDriver-block-4--text__box3">
                    <div class="p-landingDriver-block-4--text__box3__header">Drive & earn money</div>
                    <div class="p-landingDriver-block-4--text__box3__content">
                        <p>
                            Simply drive as usual and earn per each mile of your trip: Our application will calculate your
                            driven miles and add points to your account. <br>
                            Don't forget to launch the app each time before you start driving!
                        </p>
                    </div>
                </figure>
            </div>
        </div>
    </div>
</section>
<section class="p-landingDriver-block-5">
    <div class="orbit" role="region" aria-label="" data-orbit>
        <ul class="orbit-container">
            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
            <li class="is-active orbit-slide">
                <img class="orbit-image" src="{!! \URLHelper::asset('images/slide_image.jpg', 'advertiser') !!}" alt="">
            </li>
            <li class="orbit-slide">
                <img class="orbit-image" src="{!! \URLHelper::asset('images/slide_image.jpg', 'advertiser') !!}" alt="">
            </li>
            <li class="orbit-slide">
                <img class="orbit-image" src="{!! \URLHelper::asset('images/slide_image.jpg', 'advertiser') !!}" alt="">
            </li>
        </ul>
    </div>
</section>
<section class="p-landingDriver-block-6">
    <div class="p-landingDriver-block-6--container">
        <div class="p-landingDriver-block-6--content">
            <h3 class="p-landingDriver-block-6--header">Download The Flare App Now</h3>
            <div class="p-landingDriver-block-6--download">
                <div class="p-landingDriver-block-6--download__code">
                    <img src="{!! \URLHelper::asset('images/img_code.jpg', 'advertiser') !!}" alt="">
                </div>
                <div class="p-landingDriver-block-6--download__store">
                    <div><img src="{!! \URLHelper::asset('images/download_appstore.png', 'advertiser') !!}" alt=""></div>
                    <div><img src="{!! \URLHelper::asset('images/download_googleplay.png', 'advertiser') !!}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="p-landingDriver-footer">
    <div class="p-landingDriver-footer--content">
        <div class="p-landingDriver-footer--menu">
            <ul>
                <li><a href="{!! URL::action('User\IndexController@about') !!}">About</a></li>
                <li><a href="{!! URL::action('User\IndexController@faq') !!}">FAQ</a></li>
                <li><a href="{!! URL::action('User\IndexController@terms') !!}">Terms</a></li>
                <li><a href="{!! URL::action('User\IndexController@policy') !!}">Privacy Policy</a></li>
                <li><a href="{!! URL::action('User\IndexController@contact') !!}">Contact</a></li>
            </ul>
        </div>
        <div class="p-landingDriver-footer--divider"></div>
        <div class="p-landingDriver-footer--social">
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
    $('a').click(function () {
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

