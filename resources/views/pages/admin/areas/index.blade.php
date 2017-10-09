@extends('layouts.admin.application', ['menu' => 'areas'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
<script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
<script>
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
<li class="active">Areas</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\AreaController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        <div class="genre-search clearfix">

            <form action="{{ action('Admin\AreaController@index') }}" method="get">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_en">@lang('admin.pages.cities.columns.name_en')</label>
                        <input type="text" name="name_en" class="form-control" id="name_en" placeholder="@lang('admin.pages.cities.columns.name_en')" value="{{ $nameEn }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="name_local">@lang('admin.pages.countries.columns.name_local')</label>
                        <input type="text" name="name_local" class="form-control" id="name_local" placeholder="@lang('admin.pages.cities.columns.name_local')" value="{{ $nameLocal }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="country_code">@lang('admin.pages.cities.columns.country_code')</label>
                        <br>
                        <select id="country_code" class="selectpicker form-control"  name="country_code" data-live-search="true" title="All">
                            <option value="">All</option>
                        @foreach ($countries as $country)
                                <option value="{{ $country->code }}" {{ $country->code==$countryCode ? 'selected' : '' }}>
                                    {{ $country->name_en}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="city_id">@lang('admin.pages.areas.columns.city_id')</label>
                        <br>
                        <select id="city_id" class="selectpicker form-control"  name="city_id" data-live-search="true" title="All">
                            <option value="">All</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id==$cityId ? 'selected' : '' }}>
                                    {{ $city->name_en}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group">
                    <p style="text-align: center"><a href="#"  onclick="$(this).parents('form:first').submit(); return false;" class="btn btn-primary">@lang('admin.pages.common.buttons.search')</a></p>
                </div>
            </form>
        </div>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.areas.columns.country_code')</th>
                <th>@lang('admin.pages.areas.columns.city_id')</th>
                <th>@lang('admin.pages.areas.columns.name_en')</th>
                <th>@lang('admin.pages.areas.columns.name_local')</th>
                <th>@lang('admin.pages.areas.columns.order')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->present()->country() }}</td>
                <td>{{ $model->present()->city() }}</td>
                <td>{{ $model->name_en }}</td>
                <td>{{ $model->name_local }}</td>
                <td>{{ $model->order }}</td>

                    <td>
                        <a href="{!! action('Admin\AreaController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                        <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\AreaController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
