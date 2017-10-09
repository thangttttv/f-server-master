@extends('layouts.admin.application', ['menu' => 'campaigns'] )

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
    Campaigns
@stop

@section('breadcrumb')
    <li class="active">Campaigns</li>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="genre-search clearfix">

                <form action="{{ action('Admin\CampaignController@index') }}" method="get">
                    <div class="col-lg-1">
                        <label>Filter by</label>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <select id="advertiser_id" class="selectpicker form-control" name="advertiser_id"
                                    onchange="$(this).parents('form:first').submit(); return false;"
                                    data-live-search="true"
                                    title="@lang('admin.pages.campaigns.columns.advertiser_id')">
                                <option value="">--</option>
                                @foreach ($advertisers as $advertiser)

                                    <option value="{{ $advertiser->id }}" {{ $advertiser->id==$advertiserId ? 'selected' : '' }}>
                                        {{ $advertiser->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <select id="status" class="selectpicker form-control" name="status"
                                    onchange="$(this).parents('form:first').submit(); return false;"
                                    data-live-search="true" title="@lang('admin.pages.campaigns.columns.status')">
                                <option value="">--</option>
                                @foreach ($statuses as $statusItem)
                                    <option value="{{ $statusItem }}" {{ $statusItem==$status ? 'selected' : '' }}>
                                        {{ $statusItem }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <select id="country_code" class="selectpicker form-control" name="country_code"
                                    onchange="$(this).parents('form:first').submit(); return false;"
                                    data-live-search="true" title="@lang('admin.pages.campaigns.columns.country_code')">
                                <option value="">--</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->code }}" {{ $country->code==$countryCode ? 'selected' : '' }}>
                                        {{ $country->name_en }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group">
                            <select id="city_id" class="selectpicker form-control" name="city_id"
                                    onchange="$(this).parents('form:first').submit(); return false;"
                                    data-live-search="true" title="@lang('admin.pages.campaigns.columns.city_id')">
                                <option value="">--</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ $city->id==$cityId ? 'selected' : '' }}>
                                        {{ $city->name_en }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <input class="form-control" style="border-radius: 10px;"
                               onkeydown="if (event.keyCode == 13) { this.form.submit(); return false; }" type="text"
                               name="name" placeholder="Search"/>
                    </div>
                    <div class="col-lg-12  pull-right text-right" style="margin-bottom: 10px">
                        <div class="col-lg-1">
                            <h3 class="box-title pull-right" style="padding-top: 20px">
                                <p class="text-right">
                                    <a href="{!! action('Admin\CampaignController@create') !!}"
                                       class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.create')</a>
                                </p>
                            </h3>
                        </div>
                        <div class="col-lg-8">
                            {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, $params, 10, 'shared.pagination') !!}
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>@lang('admin.pages.campaigns.columns.status')</th>
                    <th style="width:300px;">@lang('admin.pages.campaigns.columns.name')</th>
                    <th>@lang('admin.pages.campaigns.columns.advertiser_id')</th>
                    <th>@lang('admin.pages.campaigns.columns.budget')</th>
                    <th>@lang('admin.pages.campaigns.columns.spend')</th>
                    <th>@lang('admin.pages.campaigns.columns.start_date')</th>
                    <th>@lang('admin.pages.campaigns.columns.end_date')</th>
                    <th>@lang('admin.pages.campaigns.columns.country_code')</th>

                    <th style="width: 40px">&nbsp;</th>
                </tr>
                @foreach( $models as $model )
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->status }}</td>
                        <td><a href="{{action('Admin\CampaignController@show', $model->id)}}"
                               title="{{ $model->name }}"> {{ $model->name }}</a></td>
                        <td>
                            @if(!empty($model->advertiser))
                                <a href="{{action('Admin\AdvertiserController@show', $model->id)}}"
                                   title="{{ $model->present()->advertiserName() }}">
                                    {{ $model->present()->advertiserName() }}
                                </a>
                            @else
                                {{ $model->present()->advertiserName() }}
                            @endif
                        </td>
                        <td>{{ strtoupper($model->budget_currency_code) . " " . $model->budget }}</td>
                        <td>@if(!empty($model->userDistanceData->totalEarning))
                                {{ strtoupper($model->budget_currency_code) . " " . $model->userDistanceData->totalEarning }}
                            @else
                                {{ strtoupper($model->budget_currency_code) . " " }} 0.0
                            @endif</td>
                        <td>
                            @if(!empty($model->start_date))
                                {{$model->start_date->formatLocalized('%d %B %Y')}}
                            @endif
                        </td>
                        <td>
                            @if(!empty($model->end_date))
                                {{$model->end_date->formatLocalized('%d %B %Y')}}
                            @endif
                        </td>
                        <td>
                            {{$model->present()->country()}}
                        </td>

                        <td>
                            <a href="{!! action('Admin\CampaignController@show', $model->id) !!}"
                               class="btn btn-block btn-primary btn-sm">@lang('admin.pages.common.buttons.edit')</a>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button"
                               data-delete-url="{!! action('Admin\CampaignController@destroy', $model->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
