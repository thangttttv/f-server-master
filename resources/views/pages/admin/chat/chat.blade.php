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

            <input type="hidden" id="user_id" value="{{ !empty($user) ? $user->id : 0}}"/>
            <input type="hidden" id="campaign_id" value="{{ !empty($campaign) ? $campaign->id : 0 }}"/>
            <input type="hidden" id="campaign_name" value="{{ !empty($campaign) ? $campaign->name : '' }}"/>
            <input type="hidden" id="user_name" value="{{ !empty($user) ? $user->present()->userName : ''}}"/>
            <input type="hidden" id="user_email" value="{{ !empty($user) ? $user->present()->email : ''}}"/>
            <input type="hidden" id="user_avatar"  value="{!! !empty($user) ? $user->getProfileImageUrl() : '' !!}"/>
            <div class="box-body scroll">
                <div id="chat" class="panel-collapse collapse in">
                    <div>
                        <div class="portlet-body chat-widget" id="chat-messages" style="overflow-y: auto; width: auto; max-height:700px">
                        </div>
                    </div>
                    <div class="portlet-footer">
                        <form role="form" method="POST" id="chat-form" action="{{action('Admin\ImageController@store')}}">
                            <div class="form-group">
                                <div class="col-lg-10" style="height: 150px; overflow-y: scroll">
                                <textarea id="chat-box" class="form-control" placeholder="Enter message..."></textarea>
                                    <div class="image-box" style="display: none">
                                        <img width="200" id="image-preview" src="" alt="" class="margin" />
                                        <div id='_progress' class='progress'></div>
                                    </div>

                                </div>
                                <div class="col-lg-2">

                                    <label class="upload btn btn-default">
                                        <input type="file" id="image-chat" name="message_image" class="image-chat image-firebase" accept="image/*">
                                        Image
                                    </label>
                                    <button style="width: 61px" type="button" class="btn btn-default text-firebase">Text</button>
                                <span style="color:red" id='spanFileName'></span>
                            </div>
                            </div>
                            <div class="form-group">
                                <p class="pull-left"><small>To enter new line press <strong>alt</strong>+<strong>enter</strong></small></p>
                                <button id="send-button" type="button" onclick="return newChatMessage()" class="btn btn-default pull-right">Send</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="conversation">
            <h4>List conversation</h4>
            <ol id="conversations">
            </ol>
        </div>
    </div>


@stop
