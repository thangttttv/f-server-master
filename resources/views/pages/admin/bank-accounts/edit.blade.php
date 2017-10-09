@extends('layouts.admin.application', ['menu' => 'bank_accounts'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss'});
    </script>
@stop

@section('title')
@stop

@section('header')
    BankAccounts
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\BankAccountController@index') !!}"><i class="fa fa-files-o"></i> BankAccounts</a>
    </li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $bankAccount->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\BankAccountController@store') !!}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{!! action('Admin\BankAccountController@update', [$bankAccount->id]) !!}" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    {!! csrf_field() !!}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">

                            </h3>
                        </div>
                        <div class="box-body">

                            <div class="col-sm-6">
                                <div class="form-group @if ($errors->has('user_id')) has-error @endif">
                                    <label for="user_id">@lang('admin.pages.bank-accounts.columns.user_id')</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="user_id"
                                            id="user_id">
                                        <option value="">SELECT</option>
                                        @foreach($users as $key => $user )
                                            <option value="{{ $user->id }}"
                                                    @if(old('user_id') == $user->id )
                                                    selected
                                                    @elseif($user->id == $bankAccount->user_id && !old('user_id')) selected
                                                    @endif

                                            >{{ $user->present()->userName() }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group @if ($errors->has('bank_id')) has-error @endif">
                                    <label for="bank_id">@lang('admin.pages.bank-accounts.columns.bank_id')</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="bank_id"
                                            id="user_id">
                                        <option value="">SELECT</option>
                                        @foreach($banks as $key => $bank )
                                            <option value="{{ $bank->id }}"
                                                    @if(old('bank_id') == $bank->id )
                                                    selected
                                                    @elseif($bank->id == $bankAccount->bank_id && !old('bank_id')) selected
                                                    @endif

                                            >{{ $bank->name }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('branch_name')) has-error @endif">
                                        <label for="branch_name">@lang('admin.pages.bank-accounts.columns.branch_name')</label>
                                        <input type="text" class="form-control" id="branch_name" name="branch_name"
                                               value="{{ old('branch_name') ? old('branch_name') : $bankAccount->branch_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('owner_name')) has-error @endif">
                                        <label for="owner_name">@lang('admin.pages.bank-accounts.columns.owner_name')</label>
                                        <input type="text" class="form-control" id="owner_name" name="owner_name"
                                               value="{{ old('owner_name') ? old('owner_name') : $bankAccount->owner_name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('account_info')) has-error @endif">
                                        <label for="account_info">@lang('admin.pages.bank-accounts.columns.account_info')</label>
                                        <input type="text" class="form-control" id="account_info" name="account_info"
                                               value="{{ old('account_info') ? old('account_info') : $bankAccount->account_info }}">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit"
                                    class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                        </div>
                    </div>
                </form>
@stop
