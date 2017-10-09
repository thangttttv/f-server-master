<header class="p-landingAgency-header">
    <div class="p-landingAgency-header--container">
        <div class="p-landingAgency-header--logo">
            <img src="{!! \URLHelper::asset('images/logo.png', 'advertiser') !!}" alt="">
        </div>
        <div class="p-landingAgency-header--menu">
            <ul class="p-landingAgency-header--menuList">
                <li class="p-landingAgency-header--menuItem"><a href="#getStarted">Get Started</a></li>
                <li class="p-landingAgency-header--menuItem"><a href="{!! URL::action('User\IndexController@faq') !!}">FAQ</a></li>
                <li class="p-landingAgency-header--menuItem"><a href="{!! URL::action('User\IndexController@index') !!}">Drivers</a></li>
                <li class="p-landingAgency-header--menuItem"><a href="{!! URL::action('User\IndexController@contact') !!}">Contact Us</a></li>
                <li class="p-landingAgency-header--menuItem__bordered"><a href="{!! URL::action('Advertiser\AuthController@getSignIn') !!}">Login</a></li>
            </ul>
        </div>
        <div class="p-landingDriver-flags c-flags">
            <a href="#"><span class="flag-icon flag-icon-th"></span></a>
            <a href="#"><span class="flag-icon flag-icon-gb"></span></a>
            <a href="#"><span class="flag-icon flag-icon-jp"></span></a>
        </div>
    </div>
</header>