@extends('layouts.admin.application', ['menu' => 'payment_logs'] )

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
PaymentLogs
@stop

@section('breadcrumb')
<li class="active">PaymentLogs</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\PaymentLogController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.payment-logs.columns.status')</th>
                <th>@lang('admin.pages.payment-logs.columns.paid_amount')</th>
                <th>@lang('admin.pages.payment-logs.columns.paid_for_month')</th>
                <th>@lang('admin.pages.payment-logs.columns.currency_code')</th>
                <th>@lang('admin.pages.payment-logs.columns.paid_at')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->status }}</td>
                <td>{{ $model->paid_amount }}</td>
                <td>{{ $model->paid_for_month }}</td>
                <td>{{ $model->currency_code }}</td>
                <td>{{ $model->paid_at }}</td>

                    <td>
                        <a href="{!! action('Admin\PaymentLogController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\PaymentLogController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
