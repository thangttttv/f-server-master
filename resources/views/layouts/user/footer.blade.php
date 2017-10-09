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