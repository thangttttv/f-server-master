@extends('layouts.admin.application', ['menu' => 'area_weight_logs'] )

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
AreaWeightLogs
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\AreaWeightLogController@index') !!}"><i class="fa fa-files-o"></i> AreaWeightLogs</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $areaWeightLog->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\AreaWeightLogController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\AreaWeightLogController@update', [$areaWeightLog->id]) !!}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
    @endif
            {!! csrf_field() !!}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">

                    </h3>
                </div>
                <div class="box-body">
                    
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">@lang('admin.pages.common.buttons.save')</button>
                </div>
            </div>
        </form>
@stop
