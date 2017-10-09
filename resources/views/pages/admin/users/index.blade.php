@extends('layouts.admin.application',['menu' => 'users'] )

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script src="{!! \URLHelper::asset('js/sortable.js', 'admin') !!}"></script>
    <script src="{!! \URLHelper::asset('js/delete_item.js', 'admin') !!}"></script>
@stop

@section('title')
    {{ config('site.name') }} | Admin | Admin Users
@stop

@section('header')
    Users
@stop

@section('content')
    <div class="box box-primary">
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
                    <th>@lang('admin.pages.users.columns.drivers_licence_image_id')</th>
                    <th style="width: 40px"></th>
                </tr>
                @foreach( $users as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->present()->userName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if( !empty($user->driverLicenceImage) )
                                <img id="image-preview" width="200" src="{!! $user->driverLicenceImage->getThumbnailUrl(104, 76) !!}" alt="" class="margin" />
                            @endif
                        </td>

                        <td>
                            <a href="#" class="btn btn-block btn-danger btn-sm delete-button" data-delete-url="{!! action('Admin\UserController@destroy', $user->id) !!}">@lang('admin.pages.common.buttons.delete')</a>
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
