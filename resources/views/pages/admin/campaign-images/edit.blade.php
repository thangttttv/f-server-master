@extends('layouts.admin.application', ['menu' => 'campaign_images'] )

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
    Wrapping image
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\CampaignImageController@index') !!}"><i class="fa fa-files-o"></i>Wrapping Images</a>
    </li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $campaignImage->id }}</li>
    @endif
@stop

@section('content')
    @if( $isNew )
        <form action="{!! action('Admin\CampaignImageController@store') !!}" method="POST"
              enctype="multipart/form-data">
            @else
                <form action="{!! action('Admin\CampaignImageController@update', [$campaignImage->id]) !!}"
                      method="POST" enctype="multipart/form-data">
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
                                    @if( !empty($campaignImage->image) )
                                        <img id="image-preview" width="200"
                                             src="{!! $campaignImage->image->getThumbnailUrl(104, 76) !!}" alt=""
                                             class="margin"/>
                                    @else
                                        <img width="200" id="image-preview"
                                             src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt=""
                                             class="margin"/>
                                    @endif
                                    <div class="form-group">
                                        <label for="brand_image">@lang('admin.pages.campaign-images.columns.image_id')</label>
                                        <input type="file" id="cover-image" name="campaign_image" class="image-input"
                                               accept="image/*">
                                        <span style="color:red" id='spanFileName'></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('campaign_id')) has-error @endif">
                                        <label for="campaign_id">@lang('admin.pages.campaign-images.columns.campaign_id')</label>
                                        <br>
                                        <select id="campaign_id" class="selectpicker  form-control"
                                                name="campaign_id" data-live-search="true"
                                                title="Please select a campaign ...">
                                            @foreach ($campaigns as $campaign)
                                                <option value="{{ $campaign->id }}"
                                                        @if(old('campaign_id'))
                                                        @if(old('campaign_id') == $campaign->id)
                                                        selected
                                                        @endif
                                                @else
                                                    {{ $campaign->id==$campaignImage->campaign_id ? 'selected' : '' }}
                                                        @endif
                                                >{{ $campaign->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('advertiser_id')) has-error @endif">
                                        <label for="image_type">@lang('admin.pages.campaign-images.columns.image_type')</label>
                                        <br>
                                        @php
                                            $wrappingTypes = trans('config.wrapping_type');
                                        @endphp
                                        <select id="image_type" class="selectpicker  form-control"  name="image_type" data-live-search="true" title="Please select a Type ...">
                                            @foreach($wrappingTypes as $key => $type )
                                                <option value="{{$key}}"
                                                        @if(old('image_type'))
                                                        @if(old('image_type') == $key)
                                                        selected
                                                        @endif
                                                @else
                                                    {{ $campaignImage->image_type==$key ? 'selected' : '' }}
                                                        @endif
                                                >{{$type}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('base_revenue')) has-error @endif">
                                        <label for="base_revenue">@lang('admin.pages.campaign-images.columns.base_revenue')</label>
                                        <input type="text" class="form-control" id="base_revenue" name="base_revenue"
                                               value="{{ old('base_revenue') ? old('base_revenue') : $campaignImage->base_revenue }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('currency_code')) has-error @endif">
                                        <label for="currency_code">@lang('admin.pages.campaign-images.columns.currency_code')</label>
                                        <input type="text" class="form-control" id="currency_code" name="currency_code"
                                               value="{{ old('currency_code') ? old('currency_code') : $campaignImage->currency_code }}">
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
