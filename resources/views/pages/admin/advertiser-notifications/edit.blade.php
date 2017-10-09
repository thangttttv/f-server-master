@extends('layouts.admin.application', ['menu' => 'advertiser_notifications'] )

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
AdvertiserNotifications
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AdvertiserNotificationController@index') !!}"><i class="fa fa-files-o"></i> AdvertiserNotifications</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $advertiserNotification->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\AdvertiserNotificationController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\AdvertiserNotificationController@update', [$advertiserNotification->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>
                <div class="box-body">

                    @if( $isNew )
                        <div class="form-group @if ($errors->has('advertiser_id')) has-error @endif">
                            <label for="advertiser_id">@lang('admin.pages.advertiser-notifications.columns.advertiser_id')</label>
                            <br>
                            <select id="advertiser_id" class="selectpicker  form-control" name="advertiser_id"
                                    data-live-search="true" title="Please select a advertiser ...">
                                <option value="0">All</option>
                                @foreach ($advertisers as $advertiser)
                                    <option value="{{ $advertiser->id }}" {{ old('advertiser_id') ? 'selected' : '' }} >{{ $advertiser->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="form-group">
                            <p>{{ $advertiserNotification->present()->name }}</p>
                            <input type="hidden" name="user_id" value="{{ $advertiserNotification->user_id  }}">
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('category_type')) has-error @endif">
                                <label for="category_type">@lang('admin.pages.advertiser-notifications.columns.category_type')</label>
                                <input type="text" class="form-control" id="category_type" name="category_type" value="{{ old('category_type') ? old('category_type') : $advertiserNotification->category_type }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('type')) has-error @endif">
                                <label for="type">@lang('admin.pages.advertiser-notifications.columns.type')</label>
                                <input type="text" class="form-control" id="type" name="type" value="{{ old('type') ? old('type') : $advertiserNotification->type }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('data')) has-error @endif">
                                <label for="data">@lang('admin.pages.advertiser-notifications.columns.data')</label>
                                {{ $advertiserNotification->data }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('content')) has-error @endif">
                                <label for="content">@lang('admin.pages.advertiser-notifications.columns.content')</label>
                                <textarea name="content" class="form-control" rows="5" placeholder="@lang('admin.pages.advertiser-notifications.columns.content')">{{ old('content') ? old('content') : $advertiserNotification->content }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('locale')) has-error @endif">
                                <label for="locale">@lang('admin.pages.advertiser-notifications.columns.locale')</label>
                                <input type="text" class="form-control" id="locale" name="locale" value="{{ old('locale') ? old('locale') : $advertiserNotification->locale }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  @if ($errors->has('sent_at')) has-error @endif">
                                <label for="sent_at">@lang('admin.pages.advertiser-notifications.columns.sent_at')</label>
                                <div class="input-group date datetime-field ">
                                    <input type="text" class="form-control" name="sent_at"
                                         value="{{ old('sent_at') ? old('sent_at') : $advertiserNotification->sent_at }}">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                </div>
            </div>
        </form>
@stop
