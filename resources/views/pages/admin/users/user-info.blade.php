<div class="profile-sidebar" style="overflow: hidden">
    <div class="profile-userpic text-center">
        <img class="" width="80" src="{!! $user->present()->profileImage() !!}" alt="">
    </div>
    <div class="profile-usertitle">
        <div class="profile-usertitle-name  text-center">
            {{ $user->present()->name }}
        </div>
        <div class="profile-usertitle-job  text-center">
            {{ $user->email }}
        </div>
    </div>
    <div class="profile-userbuttons">
        <div class="col-sm-6 driver-image">
            @if( !empty($user->driverLicenceImage) )
                <img id="driver-preview" width="200" src="{!! $user->driverLicenceImage->getThumbnailUrl(104, 76) !!}"
                     alt="" class="margin"/>

            @endif
            <p class=" text-center">driver licence image</p>
        </div>
        <div class="col-sm-6 car-image">
            @if( !empty($user->car) )
                <img id="car-preview" width="200" src="{!! $user->present()->carImage() !!}" alt="" class="margin"/>

            @endif
            <p class=" text-center">Car image</p>
        </div>
    </div>
</div>