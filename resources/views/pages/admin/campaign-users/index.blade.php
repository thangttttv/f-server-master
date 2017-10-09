@extends('layouts.admin.application', ['menu' => 'campaign_users'] )

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
    Campaign drivers
@stop

@section('breadcrumb')
    <li class="active">Campaign drivers</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="genre-search clearfix">

                <form action="{{ action('Admin\CampaignUserController@index') }}" method="get">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="country_code">@lang('admin.pages.campaign-users.columns.campaign')</label>
                            <br>
                            <select id="campaign_id" class="selectpicker form-control" name="campaign_id"
                                    data-live-search="true" title="All">
                                <option value="">All</option>
                                @foreach ($campaigns as $campaign)

                                    <option value="{{ $campaign->id }}" {{ $campaign->id==$campaignId ? 'selected' : '' }}>
                                        {{ $campaign->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="country_code">@lang('admin.pages.campaign-users.columns.user')</label>
                            <br>
                            <select id="user_id" class="selectpicker form-control" name="user_id"
                                    data-live-search="true" title="All">
                                <option value="">All</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id==$userId ? 'selected' : '' }}>
                                        {{ $user->present()->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="type">@lang('admin.pages.campaign-users.columns.status')</label>
                            <select id="status" data-width="100%" class="selectpicker form-control" name="status"
                                    data-live-search="true" title="Select">
                                <option value="">Select</option>
                                @foreach($statuses as $st)
                                    <option value="{{$st}}"
                                            @if(old('status'))
                                                @if(old('status')==$st)
                                                selected
                                                @endif
                                            @else
                                            @if($st == $status)
                                            selected
                                            @endif
                                            @endif
                                    >{{$st}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <p style="text-align: center"><a href="#"
                                                         onclick="$(this).parents('form:first').submit(); return false;"
                                                         class="btn btn-primary">@lang('admin.pages.common.buttons.search')</a>
                        </p>
                    </div>
                </form>
            </div>
            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('admin.pages.campaign-users.columns.status')</th>
                    <th>@lang('admin.pages.campaign-users.columns.campaign')</th>
                    <th>@lang('admin.pages.campaign-users.columns.user')</th>
                    <th>@lang('admin.pages.campaign-users.columns.created_at')</th>

                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $models as $model )
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->status }}</td>
                        <td>{{ $model->present()->campaignName() }}</td>
                        <td><a href="#" class="load-user-info" data-toggle="modal" data-target="#user-info-ajax"
                               data-user-url="{!! action('Admin\UserController@loadUserAjax', $model->user_id) !!}">{{ $model->present()->userName() }}</a>
                        </td>
                        <td>{{ $model->created_at }}</td>
                        <td>
                            @if($model->status == 'pending')

                                <a href="#" class="btn btn-block btn-danger btn-sm approve-button"
                                   data-approve-url="{!! action('Admin\CampaignUserController@approve', $model->id) !!}">@lang('admin.pages.common.buttons.approve')</a>
                            @endif
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

<div id="user-info-ajax" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">@lang('admin.pages.campaign-users.columns.user_info')</h4>
            </div>
            <div class="modal-body" id="content-user-info"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                        data-dismiss="modal">@lang('admin.pages.common.buttons.close')</button>
            </div>
        </div>

    </div>
</div>
