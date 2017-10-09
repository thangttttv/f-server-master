@extends('layouts.admin.application', ['menu' => 'campaign_users'] )

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
CampaignUsers
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\CampaignUserController@index') !!}"><i class="fa fa-files-o"></i> CampaignUsers</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $campaignUser->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\CampaignUserController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\CampaignUserController@update', [$campaignUser->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('status')) has-error @endif">
                                <label for="status">@lang('admin.pages.campaign-users.columns.status')</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ old('status') ? old('status') : $campaignUser->status }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="finished_at">@lang('admin.pages.campaign-users.columns.finished_at')</label>
                                <div class="input-group date datetime-field">
                                    <input type="text" class="form-control" name="finished_at"
                                         value="{{ old('finished_at') ? old('finished_at') : $campaignUser->finished_at }}">
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
