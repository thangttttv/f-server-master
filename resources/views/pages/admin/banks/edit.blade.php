@extends('layouts.admin.application', ['menu' => 'banks'] )

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
Banks
@stop

@section('breadcrumb')
    <li><a href="{!! action('Admin\BankController@index') !!}"><i class="fa fa-files-o"></i> Banks</a></li>
    @if( $isNew )
        <li class="active">New</li>
    @else
        <li class="active">{{ $bank->id }}</li>
    @endif
@stop

@section('content')

    @if( $isNew )
        <form action="{!! action('Admin\BankController@store') !!}" method="POST" enctype="multipart/form-data">
    @else
        <form action="{!! action('Admin\BankController@update', [$bank->id]) !!}" method="POST" enctype="multipart/form-data">
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
                                <label for="name">@lang('admin.pages.banks.columns.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') ? old('name') : $bank->name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('description')) has-error @endif">
                                <label for="description">@lang('admin.pages.banks.columns.description')</label>
                                <textarea name="description" class="form-control" rows="5" placeholder="@lang('admin.pages.banks.columns.description')">{{ old('description') ? old('description') : $bank->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group @if ($errors->has('order')) has-error @endif">
                                <label for="order">@lang('admin.pages.banks.columns.order')</label>
                                <input type="text" class="form-control" id="order" name="order" value="{{ old('order') ? old('order') : $bank->order }}">
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
