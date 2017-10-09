@extends('layouts.admin.application', ['menu' => 'admin_user_notifications'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/sortable.js', 'admin') !!}"></script>
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
    AdminUserNotifications
@stop

@section('breadcrumb')
    <li class="active">AdminUserNotifications</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <p class="text-right">
                    <a href="{!! URL::action('Admin\AdminUserNotificationController@create') !!}"
                       class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
                </p>
            </h3>
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
        </div>
        <div class="box-body scroll">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.user_id')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.category_type')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.type')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.locale')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.content')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.read')</th>
                    <th>@lang('admin.pages.admin-user-notifications.columns.sent_at')</th>
                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $models as $model )
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>
                        @if( $model->isBroadcast() )
                                <span class="badge bg-aqua">{{ $model->present()->userName }}</span>
                        @else
                        <a href="{{ action('Admin\AdminUserController@show',[$model->user_id]) }}">
                            {{ $model->present()->userName }}
                        </a>
                        @endif
                        </td>
                        <td>{{ $model->category_type }}</td>
                        <td>{{ $model->type }}</td>
                        <td>{{ $model->locale }}</td>
                        <td>{{ $model->content }}</td>
                        <td>
                            @if( !$model->isBroadcast() )
                            @if( $model->read )
                                <span class="badge bg-green">@lang('admin.pages.user-notifications.columns.read_true')</span>
                            @else
                                <span class="badge bg-red">@lang('admin.pages.user-notifications.columns.read_false')</span>
                            @endif
                            @endif
                        </td>
                        <td>{{ $model->sent_at }}</td>
                        <td>
                            <a href="{!! URL::action('Admin\AdminUserNotificationController@show', $model->id) !!}"
                               class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button"
                               data-delete-url="{!! action('Admin\AdminUserNotificationController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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