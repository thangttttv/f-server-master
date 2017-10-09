@extends('layouts.admin.application', ['menu' => 'areas'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{{ \URLHelper::asset('libs/moment/moment.min.js', 'admin') }}"></script>
<script src="{{ \URLHelper::asset('libs/datetimepicker/js/bootstrap-datetimepicker.min.js', 'admin') }}"></script>
<script src="{{ \URLHelper::asset('js/google.map.js', 'common') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{config('google.mapKey')}}&libraries=drawing&callback=initMap"
        async defer></script>
<script>
$('.datetime-field').datetimepicker({'format': 'YYYY-MM-DD HH:mm:ss'});
@php

    foreach( $cities as $key => $city ) {
        $cities[$key]->name = $city->name_en;
    }

@endphp

Boilerplate.cities = {!! $cities !!};

</script>
<script src="{!! \URLHelper::asset('js/pages/areas/edit.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
Areas
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AreaController@index') !!}"><i class="fa fa-files-o"></i> Areas</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $area->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\AreaController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\AreaController@update', [$area->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>


                <div class="box-body">
                    <div id="map" style="height: 400px; width:100%;"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('name_en')) has-error @endif">
                                <label for="name_en">@lang('admin.pages.areas.columns.name_en')</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') ? old('name_en') : $area->name_en }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group @if ($errors->has('location_data')) has-error @endif">
                                <label for="location_data">@lang('admin.pages.areas.columns.location_data')</label>
                                <textarea id="location_data" class="form-control" rows="5"  name="location_data">{{$area->location_data}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('name_local')) has-error @endif">
                                <label for="name_local">@lang('admin.pages.areas.columns.name_local')</label>
                                <input type="text" class="form-control" id="name_local" name="name_local" value="{{ old('name_local') ? old('name_local') : $area->name_local }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group @if ($errors->has('order')) has-error @endif">
                                <label for="order">@lang('admin.pages.areas.columns.order')</label>
                                <input type="text" class="form-control" id="order" name="order" value="{{ old('order') ? old('order') : $area->order }}">
                            </div>
                        </div>
                    </div>

                    @if ( $isNew )
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group @if ($errors->has('country_code')) has-error @endif">
                                    <label for="country_code">@lang('admin.pages.areas.columns.country_code')</label>
                                    <select class="form-control selectpicker" name="country_code" data-live-search="true" id="country_code" style="margin-bottom: 15px;">
                                        <option value="">SELECT</option>
                                        @foreach( $countries as $key => $country )
                                            <option value="{!! $country->code !!}" @if( (old('country_code') === $country->code ) ) selected @endif>
                                                {{ $country->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group @if ($errors->has('city_id')) has-error @endif">
                                    <label for="city_id">@lang('admin.pages.areas.columns.city_id')</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="city_id" id="city_id">
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
                    @else
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group @if ($errors->has('country_code')) has-error @endif">
                                    <label for="country_code">@lang('admin.pages.areas.columns.country_code')</label>
                                    <select class="form-control selectpicker" name="country_code" data-live-search="true" id="country_code" style="margin-bottom: 15px;">
                                        <option value="">SELECT</option>
                                        @foreach( $countries as $key => $country )
                                            <option value="{!! $country->code !!}"
                                                    @if(old('country_code') === $country->code )
                                                    selected
                                                    @elseif(!old('country_code') && $country->code === $area->country_code)
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
                                    <label for="city_id">@lang('admin.pages.areas.columns.city_id')</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="city_id" id="city_id">
                                        @foreach($cities as $city)
                                            @if(old('country_code') && old('country_code') == $city->country_code )
                                                <option value="{{ $city->id }}"
                                                        @if(old('city_id') == $city->id )
                                                        selected
                                                        @elseif($city->id === $area->city_id && !old('city_id')) selected
                                                        @endif

                                                >{{ $city->name_en }}</option>
                                            @elseif( $city->country_code == $area->country_code && !old('country_code') )
                                                <option value="{{ $city->id }}" @if($city->id === $area->city_id) selected @endif>{{ $city->name_en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                </div>
            </div>
        </form>
@stop
