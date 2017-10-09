@extends('layouts.advertiser.base', ['noFrame' => true, 'bodyClasses' => ''])

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script>
        $("#login-form").validate({
            rules: {
                password: {
                    minlength: 6
                },
                password_confirmation: {
                    equalTo: "input[name=password]",
                    minlength: 6
                }
            }
        });
    </script>
@stop

@section('title')
    {{ config('site.name') }} | Reset Password
@stop

@section('header')
    Password Reset
@stop

@section('content')
    @include('layouts.user.messagebox')
    <form action="{!! action('User\PasswordController@postResetPassword') !!}" method="post">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" class="c-formBox-inputText" name="email" placeholder="Email" required>
        <input type="text" class="c-formBox-inputText" name="password" placeholder="New Password" required>
        <input type="text" class="c-formBox-inputText" name="password_confirmation" placeholder="Confirm New Password" required>
        <input type="submit" value="@lang('user.pages.auth.buttons.reset')" class="button c-formBox-button c-formBox-button__resetPassword">
    </form>
@stop
