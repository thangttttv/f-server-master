<header class="p-landingDriver-header">
    <div class="p-landingDriver-header--container">
        <div class="p-landingDriver-header--logo">
            <img src="{!! \URLHelper::asset('images/logo.png', 'advertiser') !!}" alt="">
        </div>
        <div class="p-landingDriver-header--menu">
            <ul class="p-landingDriver-header--menuList">
                <li class="p-landingDriver-header--menuItem"><a href="#start">Get Started</a></li>
                <li class="p-landingDriver-header--menuItem"><a href="{!! URL::action('User\IndexController@faq') !!}">FAQ</a></li>
                <li class="p-landingDriver-header--menuItem"><a href="{!! URL::action('User\IndexController@contact') !!}">Contact Us</a></li>
                <li class="p-landingDriver-header--menuItem"><a href="{!! URL::action('Advertiser\LandingController@index') !!}">Advertisers</a></li>
            </ul>
        </div>
        <div class="p-landingDriver-flags c-flags">
            <a href="#"><span class="flag-icon flag-icon-th"></span></a>
            <a href="#"><span class="flag-icon flag-icon-gb"></span></a>
            <a href="#"><span class="flag-icon flag-icon-jp"></span></a>
        </div>
    </div>
</header>