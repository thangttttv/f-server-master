@extends('layouts.advertiser.main_base')

@section('metadata')
@stop

@section('styles')
    <style>
        select#dynamic_select {
            width: 200px;
            background-color: black;
            color: #ffffff;
            height: 55px;
        }
    </style>
@stop

@section('scripts')
    <script src="{{ \URLHelper::asset('js/google.map.js', 'advertiser') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{config('google.mapKey')}}&libraries=drawing&callback=initMap"
            async defer></script>
    <script>
        $(function(){
            $('#dynamic_select').on('change', function () {
                var url = $(this).val(); // get selected value
                if (url) { // require a URL
                    window.location = url; // redirect
                }
                return false;
            });
        });
    </script>
@stop

@section('title')
    {{ config('site.name') }} | Advertiser | Dashboard
@stop

@section('header')
    Driver
@stop

@section('content')
    <section class="body">
        <div class="c-dropdown p-driver--dropdown">
            <ul class="dropdown menu" data-dropdown-menu>
                <select id="dynamic_select">
                    <option value="">--</option>
                    @foreach($campaigns as $cp)
                        <option value="{{ action('Advertiser\DriverController@index') }}?campaign_id={{$cp->id}}"
                        {{ $cp->id ==  $campaign->id ? 'selected' : ''}}>
                            {{$cp->name}}</option>
                    @endforeach
                </select>
            </ul>
        </div>
        <div class="c-summary-flexRow p-driver--summary">
            <div class="c-summary-flexCol">
                <div class="c-summary-flexCol--box">
                    <div class="c-summary-flexCol--box__number">
                        {{ !empty($campaign->totalCampaignUser) ? $campaign->totalCampaignUser : 0 }}
                        </div>
                    <div class="c-summary-flexCol--box__text">Drivers</div>
                </div>
            </div>
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
                        {{ !empty($campaign->userDistanceService->totalDistance) ? $campaign->userDistanceService->totalDistance : 0 }}
                    </div>
                    <div class="c-summary-flexCol--box__text">Total km</div>
                </div>
            </div>
            <div class="c-summary-flexCol">
                <div class="c-summary-flexCol--box">
                    <div class="c-summary-flexCol--box__number">
                        {{ !empty($campaign->userDistanceService->totalEarning) ? $campaign->userDistanceService->totalEarning : 0 }}
                        {{ strtoupper($campaign->budget_currency_code) }}
                    </div>
                    <div class="c-summary-flexCol--box__text">Total cost</div>
                </div>
            </div>
        </div>
        <div class="c-map p-driver--map">
            <div id="map" style="height: 400px; width:100%;"></div>
        </div>
        <textarea style="display: none;" id="user-locations">{{ json_encode($userLocations) }}</textarea>
        <textarea style="display: none;" id="area-locations">{{ json_encode($areaLocationData) }}</textarea>
    </section>
@stop
