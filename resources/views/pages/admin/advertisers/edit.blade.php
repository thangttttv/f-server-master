@extends('layouts.admin.application', ['menu' => 'advertisers'] )

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
Advertisers
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AdvertiserController@index') !!}"><i class="fa fa-files-o"></i> Advertisers</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $advertiser->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\AdvertiserController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\AdvertiserController@update', [$advertiser->id]) !!}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                <label for="name">@lang('admin.pages.advertisers.columns.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ? old('name') : $advertiser->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                <label for="email">@lang('admin.pages.advertisers.columns.email')</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ? old('email') : $advertiser->email }}">
                            </div>
                        </div>
                    </div>
                    @if( $isNew )
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                <label for="password">@lang('admin.pages.advertisers.columns.password')</label>
                                <input type="text" class="form-control" id="password" name="password" value="{{ old('password') ? old('password') : $advertiser->password }}">
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('locale')) has-error @endif">
                                <label for="locale">@lang('admin.pages.advertisers.columns.locale')</label>
                                <input type="text" class="form-control" id="locale" name="locale" value="{{ old('locale') ? old('locale') : $advertiser->locale }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                @if( !empty($advertiser->profileImage) )
                                    <img id="image-preview"  style="max-width: 500px; width: 100%;" src="{!! $advertiser->profileImage->getThumbnailUrl(200, 120) !!}" alt="" class="margin image-preview" />
                                    <input type="hidden" id="current-image" value="{!! $advertiser->profileImage->getThumbnailUrl(200, 120) !!}">
                                @else
                                    <img id="image-preview" style="max-width: 500px; width: 100%;" src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt="" class="margin image-preview" />
                                    <input type="hidden" id="current-image" value="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}">
                                @endif

                                    <input type="file" class="image-input" style="display: none;"  id="image" name="profile_image" accept="image/*">
                                    <span style="color:red" id='spanFileName'></span>
                                    <p class="help-block" style="font-weight: bolder;">
                                        @lang('admin.pages.advertisers.columns.profile_image_id')
                                        <label for="image" class="btn btn-info btn-lg" style="font-weight: 100;  margin-left: 10px; cursor: pointer;">@lang('admin.pages.common.buttons.computer_image')</label>
                                        <button type="button" class="btn btn-info btn-lg load-image" data-toggle="modal" data-target="#image-from-server">@lang('admin.pages.common.buttons.serve_image')</button>
                                        <button type="button" class="btn btn-info btn-lg clear-image">@lang('admin.pages.common.buttons.clear')</button>
                                    </p>
                                    <input type="hidden" value="{{ $advertiser->image_id }}" id="image_id" name="image_id"/>
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
