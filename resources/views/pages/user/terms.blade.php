<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('layouts.advertiser.metadata')
    @include('layouts.advertiser.styles')
    <title>Terms and Conditions</title>
</head>
<body>

@include('layouts.user.landing-header')

<div class="p-policy">
    <h1 class="p-policy-header">Terms</h1>
    <section class="p-policy-content">
        <p>GENERAL TERMS AND CONDITIONS </p>
        <p>Our drivers need to meet a few criteria.</p>
        <p>Owns any kind of vehicles or have permission to apply the advertisement.</p>
        <p>You can apply for a campaign only for vehicles registered in the Flare application. If a third party drives, it becomes a rule violation.
            Also, if false registration information is discovered, you may cancel the campaign and suspend your account.</p>
        <p>Not allow to remove the sticker until end of campaign. Be sure to follow the instructions from Flare when sticking and peel off the
            stickers.</p>
        <p>Keep the advertisement clean and shine at all times. To inform us should there be any damage to the advertisement (eg accident, scratch,
            flew off)</p>
        <p>We are not responsible for any damage including traffic accidents during the campaign.</p>
        <p>You can take part only in one campaign at a time.</p>
        <p>Points earned within Flare can not be transferred to a third party.</p>
        <p>We may ask you to submit photos of speedometer during campaign.</p>
        <p>Please report to info@flare.run immediately if any troubles such as traffic accident during the campaign occurred.</p>
        <p>Please try to drive safely.</p>
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
<script type="text/javascript" src="{!! \URLHelper::asset('js/app.min.js', 'advertiser') !!}"></script>

</body>
</html>

