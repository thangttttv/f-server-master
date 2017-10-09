<div class="wrapper">
@include('layouts.admin.header')
@include('layouts.admin.side_menu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('header', 'Dashboard')
                <small>@yield('subheader', 'Dashboard')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{!! action('Admin\IndexController@index') !!}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                @yield('breadcrumb')
            </ol>
        </section>

        <section class="content">
        @include('layouts.admin.messagebox')
        @yield('content')
        </section>
    </div>

@include('layouts.admin.footer')
@include('layouts.admin.control_side_bar')
</div>
<div id="image-from-server" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('admin.pages.common.labels.image_lib_title')</h4>
            </div>
            <div class="modal-body" id="content-images"></div>
            <div class="modal-footer">
                <button data-dismiss="modal" id="select-image-btn" class="choose-btn btn btn-default hidden" onclick="chooseImage(); return false;">@lang('admin.pages.common.buttons.add')</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('admin.pages.common.buttons.close')</button>
            </div>
        </div>

    </div>
</div>
