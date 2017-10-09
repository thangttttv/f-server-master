@extends('layouts.admin.application', ['menu' => 'advertiser_notifications'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
AdvertiserNotifications
@stop

@section('breadcrumb')
<li class="active">AdvertiserNotifications</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\AdvertiserNotificationController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.advertiser-notifications.columns.category_type')</th>
                <th>@lang('admin.pages.advertiser-notifications.columns.type')</th>
                <th>@lang('admin.pages.advertiser-notifications.columns.locale')</th>
                <th>@lang('admin.pages.advertiser-notifications.columns.read')</th>
                <th>@lang('admin.pages.advertiser-notifications.columns.sent_at')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->category_type }}</td>
                <td>{{ $model->type }}</td>
                <td>{{ $model->locale }}</td>
                <td>{{ $model->read }}</td>
                <td>{{ $model->sent_at }}</td>

                    <td>
                        <a href="{!! action('Admin\AdvertiserNotificationController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\AdvertiserNotificationController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
</div>
@stop
