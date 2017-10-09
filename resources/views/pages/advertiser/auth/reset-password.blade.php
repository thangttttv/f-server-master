@extends('layouts.advertiser.base')

@section('metadata')
@stop

@section('styles')
@stop

@section('scripts')
    <script>
        $("#login-form").validate({
            rules: {
                pwd: "required",
                pwdConfirm: {
                    equalTo: "input[name=pwd]",
                    minlength: 6
                }
            }
        });
    </script>
@stop

@section('title')
    {{ config('site.name') }} | Advertiser | Dashboard
@stop

@section('header')
    Login
@stop

@section('content')
    <div class="p-resetPassword-wrapper">
        <section class="p-resetPassword-form c-formBox">
            <div class="c-formBox-header">
                <div class="c-logo">FLARE</div>
                <h5 class="p-resetPassword-title">Login</h5>
            </div>
            <form action="" id="login-form">
                <input type="email" class="c-formBox-inputText" name="email" placeholder="Email" required>
                <input type="password" class="c-formBox-inputText" name="pwd" placeholder="Password" required>
                <input type="submit" value="Login" class="button c-formBox-button c-formBox-button__resetPassword">
            </form>
        </section>
    </div>
@stop
