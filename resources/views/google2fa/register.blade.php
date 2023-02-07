@extends('layouts.dashboard.app')

@section('content')
<section class="dashboard-section body-collapse account show-employee step crypto deposit-money text-center">
    <div class="overlay pt-120">
        <div class="container-fruid">
            <!-- start main -->
            <div class="main-content google-auth">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" card mt-30">
                                <h4>@lang('otp.setup_title')</h4>
                            <div class="card-body text-center">
                                <div class="bg-light text-danger p-2 w-100">
                                   <h5>  @lang('otp.tip_msg') </h5>
                                </div>
                                <h4> @lang('otp.follwo_steps') </h4>
                                <div class=" p-2">
                                   <span class="p-2" > 1 -    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en&gl=US" target="_blank"> @lang('otp.download_google_app') </a> .  </span> <br>
                                    <span class="p-2" > 2 -   @lang('otp.setup_p') .  </span> <br>
                                    <span class="p-2" > 3  -   @lang('otp.open_app') .  </span> <br>
                                    <span class="p-2" > 4  -   @lang('otp.insert_code') .  </span> <br>
                                    <span class="p-2" > 5  -   @lang('otp.click_complete') .  </span> <br>
                                </div>
                                <div class="text-center">
                                    {!! $data['qr_image'] !!}
                                </div>

                                @include('google2fa.partials.otp-code',['registerPage' => true])

                                <a href="{{route('dashboard.welcome')}}">
                                    <button class="mb-5 btn btn-air-primary btn-primary m-4">  @lang('otp.back_to_home')   </button>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection