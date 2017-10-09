@extends('layouts.admin.application', ['menu' => 'countries'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
@stop

@section('header')
    Countries
@stop

@section('breadcrumb')
    <li class="active">Countries</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">
                <p class="text-right">
                    <a href="{!! URL::action('Admin\CountryController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
                </p>
            </h3>
            <div class="genre-search clearfix">

                <form action="{{ action('Admin\CountryController@index') }}" method="get">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name_en">@lang('admin.pages.countries.columns.name_en')</label>
                            <input type="text" name="name_en" class="form-control" id="name_en" placeholder="@lang('admin.pages.countries.columns.name_en')" value="{{ $nameEn }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name_local">@lang('admin.pages.countries.columns.name_local')</label>
                            <input type="text" name="name_local" class="form-control" id="name_local" placeholder="@lang('admin.pages.countries.columns.name_local')" value="{{ $nameLocal}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="country_code">@lang('admin.pages.countries.columns.code')</label>
                            <input type="text" name="country_code" class="form-control" id="code" placeholder="@lang('admin.pages.countries.columns.code')" value="{{ $countryCode }}">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <p style="text-align: center"><a href="#"  onclick="$(this).parents('form:first').submit(); return false;" class="btn btn-primary">@lang('admin.pages.common.buttons.search')</a></p>
                    </div>
                </form>
            </div>
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, $params, 10, 'shared.pagination') !!}
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('admin.pages.countries.columns.code')</th>
                    <th>@lang('admin.pages.countries.columns.name_en')</th>
                    <th>@lang('admin.pages.countries.columns.name_local')</th>
                    <th>@lang('admin.pages.countries.columns.flag_image_id')</th>
                    <th>@lang('admin.pages.countries.columns.order')</th>

                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $models as $model )
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->code }}</td>
                        <td>{{ $model->name_en }}</td>
                        <td>{{ $model->name_local }}</td>
                        <td>@if( !empty($model->flagImage) )
                                <img width="52" src="{!! $model->flagImage->getThumbnailUrl(104, 76) !!}" alt="" class="margin" />
                            @endif</td>

                        <td>{{ $model->order }}</td>

                        <td>
                            <a href="{!! URL::action('Admin\CountryController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\CountryController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        <div class="box-footer">
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, $params, 10, 'shared.pagination') !!}
        </div>
    </div>
@stop