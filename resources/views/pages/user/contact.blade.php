<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    <title>Privacy Policy</title>
</head>
<body>

@include('layouts.user.landing-header')

<div class="p-contact">
    <h1 class="p-contact-header">Contact Us</h1>
    <section class="p-contact-form">
        <form action="" id="contact-form">
            <select class="c-formBox-inputSelect">
                <option name="type" value="advertiser">Advertiser</option>
                <option name="type" value="driver">Driver</option>
                <option name="type" value="others">Others</option>
            </select>
            <input type="text" class="c-formBox-inputText" name="name" placeholder="Name" required>
            <input type="text" class="c-formBox-inputText" name="company" placeholder="Company Name" required>
            <input type="email" class="c-formBox-inputText" name="email" placeholder="Email" required>
            <input type="number" class="c-formBox-inputText" name="pwd" placeholder="Tel" required>
            <input type="submit" value="Send" class="button c-formBox-button c-formBox-button__resetPassword">
        </form>
    </section>
</div>

@include('layouts.user.footer')

<script type="text/javascript" src="{!! \URLHelper::asset('js/jquery/dist/jquery.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/what-input/dist/what-input.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/foundation.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/foundation-sites/dist/js/plugins/foundation.orbit.min.js', 'advertiser') !!}"></script>
<script type="text/javascript"
        src="{!! \URLHelper::asset('js/jquery-validation/dist/jquery.validate.min.js', 'advertiser') !!}"></script>
<script type="text/javascript" src="{!! \URLHelper::asset('js/app.min.js', 'advertiser') !!}"></script>
<script>
    $("#contact-form").validate();
</script>
</body>
</html>

