@extends('layouts.advertiser.main_base')

@section('metadata')
@stop

@section('styles')
@stop

@section('breadcrumb')
    <ul>
        <li><a href="#">Dashboard</a></li>
    </ul>
@stop

@section('scripts')
    <script>
        $("#addCampaign-form").validate();
        $('.p-addCampaign-btn--cancel').click(function () {
            $('#addCampaign-modal').foundation('close');
        });
    </script>
@stop

@section('title')
    {{ config('site.name') }} | Advertiser | Dashboard
@stop

@section('header')
    Dashboard
@stop

@section('content')
    <section class="body">
        <section class="p-dashboard">
            <div class="p-dashboard--header">
                {{--<div class="p-dashboard--brandLogo">--}}
                {{--<img src="{!! \URLHelper::asset('images/brandLogo.png', 'advertiser') !!}" alt="">--}}
                {{--</div>--}}
                <div class="p-dashboard--btnAdd">
                    <button>
                        <a href="{!! action('Advertiser\DashboardController@create') !!}">
                            <i class="fa fa-plus"></i> Add New Campaign</a>
                    </button>
                </div>
            </div>
            <div class="p-dashboard--table">
                <table>
                    <thead>
                    <tr>
                        <td>Campaign</td>
                        <td>Area</td>
                        <td>Budget</td>
                        <td>Total km</td>
                        <td>Total imp</td>
                        <td>Finish</td>
                        <td>Photo</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $models as $model )
                        <tr>
                            <td>{{ $model->name }}</td>
                            <td>
                                {{ $model->present()->areas() }}
                            </td>
                            <td>
                                @if(!empty($model->budget))
                                    {{ $model->budget }}
                                @endif
                            </td>
                            <td>
                                @if(!empty($model->userDistanceData->totalDistance))
                                    {{ $model->userDistanceData->totalDistance }} Km
                                @endif
                            </td>
                            <td>
                                @if(!empty($model->userDistanceData->totalImpression))
                                    {{ $model->userDistanceData->totalImpression }}
                                @endif
                            </td>
                            <td>
                                {{ $model->present()->endDate() }}
                            </td>
                            <td>
                                {{--@foreach ($model->images as $image)--}}
                                {{--@if(($loop->last))--}}
                                {{--{{$area->url}}--}}
                                {{--@else--}}
                                {{--{{$area->url}},--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="box-footer">
                    {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
                </div>
            </div>
        </section>
    </section>
@stop
