@extends('layouts.admin.application', ['menu' => 'payment_logs'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD',});
        $('.date-field').datetimepicker({'format': 'YYYY-MM', });

        @php

            foreach( $bankAccounts as $key => $bankAccount ) {
                $bankAccounts[$key]->name = $bankAccount->present()->bankName();
            }

        @endphp

                Boilerplate.bankAccounts = {!! $bankAccounts !!};
    </script>
    <script src="{!! \URLHelper::asset('js/pages/bank-accounts/edit.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
    PaymentLogs
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\PaymentLogController@index') !!}"><i class="fa fa-files-o"></i> PaymentLogs</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $paymentLog->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\PaymentLogController@store') !!}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{!! action('Admin\PaymentLogController@update', [$paymentLog->id]) !!}" method="POST"
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
                            @if ( $isNew )
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('user_id')) has-error @endif">
                                            <label for="user_id">@lang('admin.pages.bank-accounts.columns.user_id')</label>
                                            <select class="form-control selectpicker" name="user_id"
                                                    data-live-search="true" id="user_id" style="margin-bottom: 15px;">
                                                <option value="">SELECT</option>
                                                @foreach( $users as $key => $user )
                                                    <option value="{!! $user->id !!}"
                                                            @if( (old('user_id') == $user->id ) ) selected @endif>
                                                        {{ $user->present()->userName() .'-'. $user->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('bank_account_id')) has-error @endif">
                                            <label for="bank_account_id">@lang('admin.pages.payment-logs.columns.bank_account_id')</label>
                                            <select class="form-control selectpicker" data-live-search="true"
                                                    name="bank_account_id" id="bank_account_id">
                                                <option value="">SELECT</option>
                                                @foreach($bankAccounts as $bankAccount)
                                                    @if(old('user_id') && old('user_id') == $bankAccount->user_id )
                                                        <option value="{{ $bankAccount->id }}"
                                                                @if(old('bank_account_id') == $bankAccount->id )
                                                                selected
                                                                @endif
                                                        >{{ $bankAccount->name }}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('user_id')) has-error @endif">
                                            <label for="user_id">@lang('admin.pages.bank-accounts.columns.user_id')</label>
                                            <select class="form-control selectpicker" name="user_id"
                                                    data-live-search="true" id="user_id" style="margin-bottom: 15px;">
                                                <option value="">SELECT</option>
                                                @foreach( $users as $key => $user )
                                                    <option value="{!! $user->id !!}"
                                                            @if(old('user_id') == $user->id )
                                                            selected
                                                            @elseif(!old('user_id') && $user->id === $area->user_id)
                                                            selected
                                                            @endif
                                                    >
                                                        {{ $user->present()->userName()}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('bank_account_id')) has-error @endif">
                                            <label for="bank_account_id">@lang('admin.pages.bank-accounts.columns.bank_account_id')</label>
                                            <select class="form-control selectpicker" data-live-search="true"
                                                    name="bank_account_id" id="bank_account_id">
                                                @foreach($bankAccounts as $bankAccount)
                                                    @if(old('user_id') && old('user_id') == $bankAccount->user_id )
                                                        <option value="{{ $bankAccount->id }}"
                                                                @if(old('bank_account_id') == $bankAccount->id )
                                                                selected
                                                                @elseif($bankAccount->id === $paymentLog->bank_account_id && !old('bank_account_id')) selected
                                                                @endif

                                                        >{{ $bankAccount->name }}</option>
                                                    @elseif( $bankAccount->user_id == $area->user_id && !old('user_id') )
                                                        <option value="{{ $bankAccount->id }}"
                                                                @if($bankAccount->id === $paymentLog->bank_account_id) selected @endif>{{ $bankAccount->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('status')) has-error @endif">
                                        <label for="status">@lang('admin.pages.payment-logs.columns.status')</label>
                                        <select id="status" data-width="100%" class="selectpicker form-control"  name="status" data-live-search="true" title="Select">
                                            <option value="">SELECT</option>
                                            @foreach($statuses as $status)
                                                <option value="{{$status}}"
                                                        @if(old('status'))
                                                        @if(old('status')==$status)
                                                        selected
                                                        @endif
                                                        @else
                                                        @if($paymentLog->status == $status)
                                                        selected
                                                        @endif
                                                        @endif
                                                >{{$status}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('paid_amount')) has-error @endif">
                                        <label for="paid_amount">@lang('admin.pages.payment-logs.columns.paid_amount')</label>
                                        <input type="text" class="form-control" id="paid_amount" name="paid_amount"
                                               value="{{ old('paid_amount') ? old('paid_amount') : $paymentLog->paid_amount }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('currency_code')) has-error @endif">
                                        <label for="currency_code">@lang('admin.pages.payment-logs.columns.currency_code')</label>
                                        <input type="text" class="form-control" id="currency_code" name="currency_code"
                                               value="{{ old('currency_code') ? old('currency_code') : $paymentLog->currency_code }}">
                                    </div>
                                </div>
                            </div>

                                <div class="form-group @if ($errors->has('paid_for_month')) has-error @endif">
                                    <label for="paid_for_month">@lang('admin.pages.payment-logs.columns.paid_for_month')</label>
                                    <input type="text" class="form-control date-field" id="paid_for_month" name="paid_for_month" value="{{ old('paid_for_month') ? old('paid_for_month') : $paymentLog->paid_for_month }}">
                                </div>
                                <div class="form-group @if ($errors->has('paid_at')) has-error @endif">
                                    <label for="paid_at">@lang('admin.pages.payment-logs.columns.paid_at')</label>
                                    <input type="text" class="form-control datetime-field" id="paid_at" name="paid_at" value="{{ old('paid_at') ? old('paid_at') : $paymentLog->paid_at }}">
                                </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('note')) has-error @endif">
                                        <label for="note">@lang('admin.pages.payment-logs.columns.note')</label>
                                        <textarea name="note" class="form-control" rows="5"
                                                  placeholder="@lang('admin.pages.payment-logs.columns.note')">{{ old('note') ? old('note') : $paymentLog->note }}</textarea>
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
