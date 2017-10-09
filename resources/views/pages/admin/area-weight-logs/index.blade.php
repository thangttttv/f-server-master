@extends('layouts.admin.application', ['menu' => 'area_weight_logs'] )

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
AreaWeightLogs
@stop

@section('breadcrumb')
<li class="active">AreaWeightLogs</li>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            <p class="text-right">

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
                <th>@lang('admin.pages.area-weight-logs.columns.active_to')</th>

                <th style="width: 40px">&nbsp;</th>
            </tr>
            @foreach( $models as $model )
                <tr>
                    <td>{{ $model->id }}</td>
                    <td>{{ $model->day_of_week }}</td>
                    <td>{{ $model->start_time }}</td>
                    <td>{{ $model->end_time }}</td>
                    <td>{{ $model->weight }}</td>
                    <td>{{ $model->active_to }}</td>

                </tr>
            @endforeach
        </table>
    </div>
    <div class="box-footer">
        {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
    </div>
</div>
@stop
