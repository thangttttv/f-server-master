@extends('layouts.advertiser.main_base')

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
@stop

@section('title')
    {{ config('site.name') }} | Advertiser | Dashboard
@stop

@section('header')
    Report
@stop

@section('content')
    <section class="body">
        <section class="p-report">
            <div class="p-report--table">
                <table>
                    <thead>
                    <tr>
                        <td>Campaign</td>
                        <td>Area(AD-Group)</td>
                        <td>Cost</td>
                        <td>IMP</td>
                        <td>Finish Date</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $models as $model )
                        <tr>
                            <td><a href="{!! URL::action('Advertiser\ReportController@detail', ['campaignId'=>$model->id]) !!}">{{ $model->name }}</a></td>
                            <td>
                                {{ $model->present()->areas() }}
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
