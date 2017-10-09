@extends('layouts.advertiser.main_base')

@section('metadata')
@stop

@section('styles')
@stop

@section('breadcrumb')
    <ul>
        <li><a href="#">Dashboard</a></li>
        <li><a href="#">Add new campaign</a></li>
    </ul>
@stop

@section('scripts')
    <script>
        $(function () {
            $("#addCampaign-form").validate();
            $('.p-addCampaign-btn--cancel').click(function () {
                $('#addCampaign-modal').foundation('close');
            });

            $('#date').fdatepicker();
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
        <div class="c-formBox-header">
            <div class="c-logo">FLARE</div>
        </div>
        <form action="{!! action('Advertiser\DashboardController@store') !!}" method="post" id="addCampaign-form">
            {!! csrf_field() !!}
            <div class="p-addCampaign-row">
                <div class="p-addCampaign-label">
                    <label for="name">Campaign name:</label>
                </div>
                <div class="p-addCampaign-input">
                    <input type="text" name="name" id="name" required>
                </div>
            </div>
            <div class="p-addCampaign-row">
                <div class="p-addCampaign-label">
                    <label for="budget">Budget:</label>
                </div>
                <div class="p-addCampaign-input">
                    <input type="number" name="budget" id="budget" required>
                </div>
            </div>
            <div class="p-addCampaign-row">
                <div class="p-addCampaign-label">
                    <label for="date">Start Date:</label>
                </div>
                <div class="p-addCampaign-input">
                    <input type="text" name="date" id="date" required>
                </div>
            </div>
            <div class="p-addCampaign-row">
                <a class="p-addCampaign-btn--cancel" href="{!! action('Advertiser\DashboardController@index') !!}">Cancel</a>
                <input class="p-addCampaign-btn--add" type="submit" value="Add">
            </div>
        </form>
    </section>
@stop
