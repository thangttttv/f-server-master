@extends('layouts.admin.application', ['menu' => 'area_weights'] )

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
AreaWeights
@stop

@section('breadcrumb')
<li class="active">AreaWeights</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">
                <a href="{!! action('Admin\AreaWeightController@create') !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
            </p>
        </h3>
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 10px">ID</th>
                <th>@lang('admin.pages.area-weights.columns.day_of_week')</th>
                <th>@lang('admin.pages.area-weights.columns.start_time')</th>
                <th>@lang('admin.pages.area-weights.columns.end_time')</th>
                <th>@lang('admin.pages.area-weights.columns.weight')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                <td>{{ $model->present()->dayOfWeek() }}</td>
                <td>{{ $model->start_time }}</td>
                <td>{{ $model->end_time }}</td>
                <td>{{ $model->weight }}</td>

                    <td>
                        <a href="{!! action('Admin\AreaWeightController@show', $model->id) !!}" class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
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
