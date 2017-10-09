@extends('layouts.admin.application', ['menu' => 'bank_accounts'] )

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
BankAccounts
@stop

@section('breadcrumb')
<li class="active">BankAccounts</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\BankAccountController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.bank-accounts.columns.user_id')</th>
                <th>@lang('admin.pages.bank-accounts.columns.bank_id')</th>
                <th>@lang('admin.pages.bank-accounts.columns.branch_name')</th>
                <th>@lang('admin.pages.bank-accounts.columns.owner_name')</th>
                <th>@lang('admin.pages.bank-accounts.columns.account_info')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->present()->userName() }}</td>
                <td>{{ $model->present()->bankName() }}</td>
                <td>{{ $model->branch_name }}</td>
                <td>{{ $model->owner_name }}</td>
                <td>{{ $model->account_info }}</td>

                    <td>
                        <a href="{!! action('Admin\BankAccountController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\BankAccountController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
