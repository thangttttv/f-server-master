<header class="header">
    <section class="c-breadcrumbs">
        <i class="c-hamburger fa fa-bars"></i>
        @yield('breadcrumb')

    </section>
    <section class="c-account">
        <img class="c-account--avatar" src="{!! $authAdvertiser->getProfileImageUrl() !!}" alt="">
        <a class="c-account--name">{{ $authAdvertiser->name }}</a>
        <form id="signout" method="post" action="{!! URL::action('Advertiser\AuthController@postSignOut') !!}">{!! csrf_field(); !!}</form>
        <a class="c-account--logout" href="#" onclick="$('#signout').submit(); return false;">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
        </a>
    </section>
</header>