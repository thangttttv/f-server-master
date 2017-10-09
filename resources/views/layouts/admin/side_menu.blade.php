<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! $authUser->getProfileImageUrl() !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $authUser->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            <li @if( $menu=='dashboard') class="active" @endif ><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
            @if( $authUser->hasRole(\App\Models\AdminUserRole::ROLE_SUPER_USER) )
            <li @if( $menu=='admin_users') class="active" @endif ><a href="{!! URL::action('Admin\AdminUserController@index') !!}"><i class="fa fa-user-secret"></i> <span>Admin Users</span></a></li>
            <li @if( $menu=='users') class="active" @endif ><a href="{!! URL::action('Admin\UserController@index') !!}"><i class="fa fa-users"></i> <span>Users</span></a></li>
            <li @if( $menu=='site_configurations') class="active" @endif ><a href="{!! URL::action('Admin\SiteConfigurationController@index') !!}"><i class="fa fa-cogs"></i> <span>Site Configurations</span></a></li>
            @endif

            <li @if( $menu=='user_notifications') class="active" @endif ><a href="{!! URL::action('Admin\UserNotificationController@index') !!}"><i class="fa fa-bell"></i> <span>UserNotifications</span></a></li>
            <li @if( $menu=='admin_user_notification') class="active" @endif ><a href="{!! URL::action('Admin\AdminUserNotificationController@index') !!}"><i class="fa fa-bell-o"></i> <span>AdminUserNotifications</span></a></li>
            <li @if( $menu=='advertiser_notification') class="active" @endif ><a href="{!! action('Admin\AdvertiserNotificationController@index') !!}"><i class="fa fa-bell"></i> <span>AdvertiserNotifications</span></a></li>
            <li @if( $menu=='images') class="active" @endif ><a href="{!! URL::action('Admin\ImageController@index') !!}"><i class="fa fa-file-image-o"></i> <span>Images</span></a></li>
            <li @if( $menu=='countries') class="active" @endif ><a href="{!! action('Admin\CountryController@index') !!}"><i class="fa fa-users"></i> <span>Countries</span></a></li>
            <li @if( $menu=='cities') class="active" @endif ><a href="{!! action('Admin\CityController@index') !!}"><i class="fa fa-users"></i> <span>Cities</span></a></li>
            <li @if( $menu=='advertisers') class="active" @endif ><a href="{!! action('Admin\AdvertiserController@index') !!}"><i class="fa fa-users"></i> <span>Advertisers</span></a></li>
            <li @if( $menu=='areas') class="active" @endif ><a href="{!! action('Admin\AreaController@index') !!}"><i class="fa fa-users"></i> <span>Areas</span></a></li>
            <li @if( $menu=='oauth_clients') class="active" @endif ><a href="{!! action('Admin\OauthClientController@index') !!}"><i class="fa fa-users"></i> <span>OauthClients</span></a></li>
            <li @if( $menu=='campaigns') class="active" @endif ><a href="{!! action('Admin\CampaignController@index') !!}"><i class="fa fa-users"></i> <span>Campaigns</span></a></li>
            <li @if( $menu=='area_weights') class="active" @endif ><a href="{!! action('Admin\AreaWeightController@index') !!}"><i class="fa fa-users"></i> <span>AreaWeights</span></a></li>
            <li @if( $menu=='area_weight_logs') class="active" @endif ><a href="{!! action('Admin\AreaWeightLogController@index') !!}"><i class="fa fa-users"></i> <span>AreaWeightLogs</span></a></li>
            <li @if( $menu=='payment_log') class="active" @endif ><a href="{!! action('Admin\PaymentLogController@index') !!}"><i class="fa fa-users"></i> <span>PaymentLogs</span></a></li>
            <li @if( $menu=='bank') class="active" @endif ><a href="{!! action('Admin\BankController@index') !!}"><i class="fa fa-users"></i> <span>Banks</span></a></li>
            <li @if( $menu=='bank_account') class="active" @endif ><a href="{!! action('Admin\BankAccountController@index') !!}"><i class="fa fa-users"></i> <span>BankAccounts</span></a></li>
            <li @if( $menu=='campaign_users') class="active" @endif ><a href="{!! action('Admin\CampaignUserController@index') !!}"><i class="fa fa-users"></i> <span>Campaign drivers</span></a></li>
            <li @if( $menu=='chats') class="active" @endif ><a href="{!! action('Admin\ChatController@index') !!}"><i class="fa fa-users"></i> <span>Messages</span></a></li>

            <!-- %%SIDEMENU%% -->
        </ul>
    </section>
</aside>
