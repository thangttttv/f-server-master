@extends('layouts.admin.application', ['menu' => 'campaigns'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
    <script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
    <script>
        $('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD', 'allowInputToggle': true});

        @php

            foreach( $cities as $key => $city ) {
                $cities[$key]->name = $city->name_en;
            }

            foreach( $areas as $key => $area ) {
                $areas[$key]->name = $area->name_en;
            }


        @endphp

                Boilerplate.cities = {!! $cities !!};
        Boilerplate.areas = {!! $areas !!};

    </script>
    <script src="{!! \URLHelper::asset('js/pages/campaigns/edit.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
    Campaigns
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\CampaignController@index') !!}"><i class="fa fa-files-o"></i> Campaigns</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $campaign->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\CampaignController@store') !!}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{!! action('Admin\CampaignController@update', [$campaign->id]) !!}" method="POST"
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
                                        <div class="form-group @if ($errors->has('country_code')) has-error @endif">
                                            <label for="country_code">@lang('admin.pages.campaigns.columns.country_code')</label>
                                            <select class="form-control selectpicker" name="country_code"
                                                    data-live-search="true" id="country_code"
                                                    style="margin-bottom: 15px;">
                                                <option value="">SELECT</option>
                                                @foreach( $countries as $key => $country )
                                                    <option value="{!! $country->code !!}"
                                                            @if( (old('country_code') === $country->code ) ) selected @endif>
                                                        {{ $country->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('city_id')) has-error @endif">
                                            <label for="city_id">@lang('admin.pages.campaigns.columns.city_id')</label>
                                            <select class="form-control selectpicker" data-live-search="true"
                                                    name="city_id" id="city_id">
                                                <option value="">SELECT</option>
                                                @foreach($cities as $city)
                                                    @if(old('country_code') && old('country_code') == $city->country_code )
                                                        <option value="{{ $city->id }}"
                                                                @if(old('city_id') == $city->id )
                                                                selected
                                                                @endif
                                                        >{{ $city->name_en }}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if ($errors->has('area_id')) has-error @endif">
                                            <label for="area_id">@lang('admin.pages.campaigns.columns.area_id')</label>
                                            <select class="form-control selectpicker" multiple data-live-search="true"
                                                    name="area_id[]" id="area_id">
                                                @foreach($areas as $area)
                                                    @if(old('city_id') && old('city_id') == $area->city_id )
                                                        <option value="{{ $area->id }}"
                                                                @if(old('city_id') && old('city_id') == $area->city_id )

                                                                @if(old('area_id') && sizeof(old('area_id')) > 0 )
                                                                @foreach(old('area_id') as $index => $tc )
                                                                @if($tc == $area->id)
                                                                selected
                                                                @endif
                                                                @endforeach

                                                                @endif
                                                                @endif
                                                        >{{ $area->name_en }}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('country_code')) has-error @endif">
                                            <label for="country_code">@lang('admin.pages.campaigns.columns.country_code')</label>
                                            <select class="form-control selectpicker" name="country_code"
                                                    data-live-search="true" id="country_code"
                                                    style="margin-bottom: 15px;">
                                                <option value="">SELECT</option>
                                                @foreach( $countries as $key => $country )
                                                    <option value="{!! $country->code !!}"
                                                            @if(old('country_code') === $country->code )
                                                            selected
                                                            @elseif(!old('country_code') && $country->code === $campaign->country_code)
                                                            selected
                                                            @endif
                                                    >
                                                        {{ $country->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if ($errors->has('city_id')) has-error @endif">
                                            <label for="city_id">@lang('admin.pages.campaigns.columns.city_id')</label>
                                            <select class="form-control selectpicker" data-live-search="true"
                                                    name="city_id" id="city_id">
                                                @foreach($cities as $city)
                                                    @if(old('country_code') && old('country_code') == $city->country_code )
                                                        <option value="{{ $city->id }}"
                                                                @if(old('city_id') == $city->id )
                                                                selected
                                                                @elseif($city->id === $campaign->city_id && !old('city_id')) selected
                                                                @endif

                                                        >{{ $city->name_en }}</option>
                                                    @elseif( $city->country_code == $campaign->country_code && !old('country_code') )
                                                        <option value="{{ $city->id }}"
                                                                @if($city->id === $campaign->city_id) selected @endif>{{ $city->name_en }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if ($errors->has('area_id')) has-error @endif">
                                            <label for="area_id">@lang('admin.pages.campaigns.columns.area_id')</label>
                                            <select class="form-control selectpicker" multiple data-live-search="true"
                                                    name="area_id[]" id="area_id">

                                                @foreach( $areas as $key => $area )
                                                    @if($campaign->city_id == $area->city_id)
                                                        <option value="{{ $area->id }}"
                                                                @if(old('city_id') && old('city_id') == $area->city_id )

                                                                @if(old('area_id') && sizeof(old('area_id')) > 0 )
                                                                @foreach(old('area_id') as $index => $tc )
                                                                @if($tc == $area->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                @else

                                                                @foreach($campaign->areas as $index => $tc )
                                                                {{$tc->id}}
                                                                @if($tc->id == $area->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                                @elseif(!old('city_id'))
                                                                @foreach($campaign->areas as $index => $tc )
                                                                {{$tc->id}}
                                                                @if($tc->id == $area->id)
                                                                selected
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                        >{{ $area->name_en }}</option>

                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group @if ($errors->has('advertiser_id')) has-error @endif">
                                <label for="advertiser_id">@lang('admin.pages.campaigns.columns.advertiser_id')</label>
                                <br>
                                <select id="advertiser_id" class="selectpicker  form-control" name="advertiser_id"
                                        data-live-search="true" title="Please select a advertiser ...">
                                    @foreach ($advertisers as $advertiser)
                                        <option value="{{ $advertiser->id }}" {{ old('advertiser_id') ? 'selected' : '' }}
                                                {{ $advertiser->id==$campaign->advertiser_id ? 'selected' : '' }}>{{ $advertiser->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('name')) has-error @endif">
                                        <label for="name">@lang('admin.pages.campaigns.columns.name')</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name') ? old('name') : $campaign->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('description')) has-error @endif">
                                        <label for="description">@lang('admin.pages.campaigns.columns.description')</label>
                                        <textarea name="description" class="form-control" rows="5"
                                                  placeholder="@lang('admin.pages.campaigns.columns.description')">{{ old('description') ? old('description') : $campaign->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group @if ($errors->has('start_date')) has-error @endif">
                                        <label for="start_date">@lang('admin.pages.campaigns.columns.start_date')</label>
                                        <input type="text" class="form-control datetime-field" id="start_date"
                                               name="start_date"
                                               value="{{ old('start_date') ? old('start_date') : $campaign->start_date }}">
                                        <span class="add-on"><i class="icon-th"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group @if ($errors->has('budget_currency_code')) has-error @endif">
                                        <label for="budget_currency_code">@lang('admin.pages.campaigns.columns.budget_currency_code')</label>
                                        <select id="budget_currency_code" class="selectpicker  form-control"  name="budget_currency_code" data-live-search="true" title="Please select a currency ...">
                                            @foreach ($currencyList as $key => $currency)
                                                <option value="{{ $key }}" {{ old('budget_currency_code') ? 'selected' : '' }}
                                                        {{ $key==$campaign->budget_currency_code ? 'selected' : '' }}>{{ $currency['code'] }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group @if ($errors->has('budget')) has-error @endif">
                                        <label for="budget">@lang('admin.pages.campaigns.columns.budget')</label>
                                        <input type="text" class="form-control" id="budget" name="budget"
                                               value="{{ old('budget') ? old('budget') : $campaign->budget }}">
                                    </div>
                                </div>
                            </div>
                            @php
                                $wrappingTypes = trans('config.wrapping_type');
                            @endphp
                            <div class="row">
                                <label class="col-sm-2 control-label" for="budget">Wrapping option</label>
                                <div class="col-md-10">
                                    <div class="col-md-12" style="color: red">
                                        <label class="col-sm-2 control-label">Type</label>
                                        <label class="col-sm-4 control-label">Earning rate</label>
                                        <label class="col-sm-2 control-label"></label>
                                        <label class="col-sm-2 control-label">Image</label>
                                    </div>
                                    @foreach($wrappingTypes as $typeKey => $wrappingType)

                                        <div class="col-md-12">
                                            <label class="col-sm-2 control-label" for="budget">{{$wrappingType}}</label>
                                            <div class="col-sm-2">

                                                <input type="text" class="form-control" id="{{$typeKey}}"
                                                       name="wrapping_base_{{$typeKey}}"
                                                       value="@foreach($campaign->wrappingImages as $wrappingImage)@if($wrappingImage->image_type == $typeKey){{$wrappingImage->base_revenue}}@endif @endforeach"/>

                                            </div>
                                            <div class="col-sm-4">
                                                <img width="200"
                                                     src="@foreach($campaign->wrappingImages as $wrappingImage)@if($wrappingImage->image_type == $typeKey){{!empty($wrappingImage->image)?$wrappingImage->image->url:''}}@endif @endforeach" alt=""
                                                     class="margin image-preview-{{$typeKey}}"/>

                                            </div>
                                            <div class="col-sm-4">
                                                <input type="file" id="cover-image-{{$typeKey}}"
                                                       name="wrapping_image_{{$typeKey}}" data-key="{{$typeKey}}"
                                                       onchange="imageValidate(this)"
                                                       accept="image/*">

                                                <span style="color:red" class='warning-image-{{$typeKey}}'></span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if( !empty($campaign->brandImage) )
                                <img id="image-preview" width="200"
                                     src="{!! $campaign->brandImage->getThumbnailUrl(104, 76) !!}" alt=""
                                     class="margin"/>
                            @else
                                <img width="200" id="image-preview"
                                     src="{!! \URLHelper::asset('img/no_image.jpg', 'common') !!}" alt=""
                                     class="margin"/>
                            @endif


                            <div class="form-group">
                                <label for="brand_image">@lang('admin.pages.campaigns.columns.brand_image_id')</label>
                                <input type="file" id="cover-image" name="brand_image" class="image-input"
                                       accept="image/*">
                                <span style="color:red" id='spanFileName'></span>
                            </div>

                        </div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                    </div>
                </form>
@stop
