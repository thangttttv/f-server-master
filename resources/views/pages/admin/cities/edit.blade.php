@extends('layouts.admin.application', ['menu' => 'cities'] )

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
    Cities
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\CityController@index') !!}"><i class="fa fa-files-o"></i> Cities</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $city->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\CityController@store') !!}" method="POST" enctype="multipart/form-data">
            @else
                <form action="{!! action('Admin\CityController@update', [$city->id]) !!}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                    {!! csrf_field() !!}
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">

                            </h3>
                        </div>
                        <div class="box-body">

                            <div class="form-group required @if ($errors->has('name_en')) has-error @endif">
                                <label for="name_en">@lang('admin.pages.cities.columns.name_en')</label>
                                <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') ? old('name_en') : $city->name_en }}">
                            </div>

                            <div class="form-group required @if ($errors->has('name_local')) has-error @endif">
                                <label for="name_local">@lang('admin.pages.cities.columns.name_local')</label>
                                <input type="text" class="form-control" id="name_local" name="name_local" value="{{ old('name_local') ? old('name_local') : $city->name_local }}">
                            </div>

                            <div class="form-group required @if ($errors->has('country_code')) has-error @endif">
                                <label for="country_code">@lang('admin.pages.cities.columns.country_code')</label>
                                <br>
                                <select id="country_code" class="selectpicker  form-control"  name="country_code" data-live-search="true" title="Please select a country ...">
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}" {{ old('country_code') ? 'selected' : '' }}
                                                {{ $country->code==$city->country_code ? 'selected' : '' }}>{{ $country->name_en . '-' .$country->name_local}}</option>
                                    @endforeach

                                </select>
                            </div>


                            <div class="form-group required @if ($errors->has('order')) has-error @endif">
                                <label for="order">@lang('admin.pages.cities.columns.order')</label>
                                <input type="text" class="form-control" id="order" name="order" value="{{ old('order') ? old('order') : $city->order }}">
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                        </div>
                    </div>
                </form>
@stop
