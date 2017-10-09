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
    Notification
@stop

@section('content')
    <section class="body">
        <section class="p-notification">
            <div class="p-notification-table">
                <ul class="accordion" data-accordion>
                    @foreach($models as $model)
                        <li class="accordion-item @if ($loop->first) is-active @endif" data-accordion-item>
                            <a href="#" class="accordion-title p-notification-table__headerWrapper">
                                <div class="p-notification-table__date">
                                    2017/04/20 19:00
                                </div>
                                <div class="p-notification-table__header">
                                    Start campaign
                                </div>
                            </a>
                            <div class="accordion-content" data-tab-content>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab ex exercitationem laborum maiores omnis
                                quaerat qui tempora voluptate? Ad doloribus eligendi hic iste libero minima nemo nulla, qui ullam.
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </section>
@stop
