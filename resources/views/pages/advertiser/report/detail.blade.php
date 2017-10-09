@extends('layouts.advertiser.main_base')

@section('metadata')
@stop

@section('styles')
@stop

@section('title')
    {{ config('site.name') }} | Advertiser | Dashboard
@stop

@section('header')
    Driver
@stop

@section('content')
    <section class="body">
        <section class="p-report">
            <div class="c-summary-flexRow p-report--summary">
                <div class="c-summary-flexCol">
                    <div class="c-summary-flexCol--box">
                        <div class="c-summary-flexCol--box__number">
                            {{ !empty($campaign->userDistanceService->totalImpression) ? $campaign->userDistanceService->totalImpression : 0 }}</div>
                        <div class="c-summary-flexCol--box__text">Total Impression</div>
                    </div>
                </div>
                <div class="c-summary-flexCol">
                    <div class="c-summary-flexCol--box">
                        <div class="c-summary-flexCol--box__number">
                            {{ !empty($campaign->userDistanceService->totalEarning) ? $campaign->userDistanceService->totalEarning : 0 }}
                            {{ strtoupper($campaign->budget_currency_code) }}</div>
                        <div class="c-summary-flexCol--box__text">Total Cost</div>
                    </div>
                </div>
                <div class="c-summary-flexCol">
                    <div class="c-summary-flexCol--box">
                        <div class="c-summary-flexCol--box__number">{{ $campaign->totalCampaignUser }}</div>
                        <div class="c-summary-flexCol--box__text">Total car</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="c-lineChart">
            <div class="ct-chart"></div>
        </section>
    </section>
@stop

@section('scripts')
    <script type="text/javascript"
            src="{!! \URLHelper::asset('js/chartist/dist/chartist.min.js', 'advertiser') !!}"></script>

    <script>

        var dateList = {!! $graphData['dateData'] !!};
        var series = {!! $graphData['valueData'] !!};

        new Chartist.Line('.ct-chart', {
            labels: dateList,
            series: [series]
        }, {
            low: 0,
            showArea: true,
            width: '100%',
            height: '400px'
        });
    </script>
@stop
