@extends('layouts.admin.application',['menu' => 'chats'] )

@section('metadata')
@stop

@section('styles')
    <link rel="stylesheet" href="{!! \URLHelper::asset('css/app.css', 'admin') !!}">
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/sortable.js', 'admin') !!}"></script>
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
    <script src="https://cdn.firebase.com/js/client/2.1.1/firebase.js"></script>
    @if(!empty($authUser))
        @include('layouts.admin.firebase-js')
    @endif
@stop

@section('title')
    {{ config('site.name') }} | Admin | Chat
@stop

@section('header')
    Chat
@stop

@section('content')
    <div class="box box-primary">

        <div class="list-user">
            <div class="box-header with-border">
                {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
            </div>

            <div class="box-body scroll">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th class="sortable"
                            data-key="name">@lang('admin.pages.users.columns.name')  @if( $order=="name") @if( $direction=='asc')
                                <i class="fa fa-sort-amount-asc"></i> @else <i
                                        class="fa fa-sort-amount-desc"></i> @endif @endif</th>
                        <th>@lang('admin.pages.users.columns.email')</th>
                    </tr>
                    @foreach( $users as $user )
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->present()->userName }}</td>
                            <td><a href="{!! URL::action('Admin\ChatController@chat', [$user->id , 0]) !!}" >{{ $user->email }}</a></td>

                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="box-footer">
                {!! \PaginationHelper::render($offset, $limit, $count, $baseUrl, []) !!}
            </div>
        </div>
        <div class="conversation">

            <h4>List conversation</h4>
            <ol id="conversations">
            </ol>
        </div>

    </div>
@stop
