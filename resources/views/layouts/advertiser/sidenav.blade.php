<aside class="sideNav">
    <i class="sideNav-close fa fa-arrow-left"></i>
    <div class="c-logo">FLARE</div>
    <section class="c-sideMenu">
        <ul>
            <li class="c-sideMenu--item c-sideMenu--item__dashboard @if($menu == 'dashboard') c-sideMenu--item__active @endif">
                <a href="{!! URL::action('Advertiser\DashboardController@index') !!}">Dashboard</a>
            </li>
            <li class="c-sideMenu--item c-sideMenu--item__driver @if($menu == 'driver') c-sideMenu--item__active @endif" >
                <a href="{!! URL::action('Advertiser\DriverController@index') !!}">Driver</a>
            </li>
            <li class="c-sideMenu--item c-sideMenu--item__report @if($menu == 'report') c-sideMenu--item__active @endif">
                <a href="{!! URL::action('Advertiser\ReportController@index') !!}">Report</a>
            </li>
            <li class="c-sideMenu--item c-sideMenu--item__notification @if($menu == 'notification') c-sideMenu--item__active @endif">
                <a href="{!! URL::action('Advertiser\NotificationController@index') !!}">Notification</a>
            </li>
        </ul>
    </section>
</aside>