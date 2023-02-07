
                        <form role="form" method="POST" action="/2fa/validate">
                            {!! csrf_field() !!}
                                    @if($registerPage)
                                        <div class="login-card text-center" style="min-height: auto" > <div>
                                    @else
                                        <div class="login-card text-center"> <div>
                                    @endif
                                    <div class="text-center">
                                        @if(!$registerPage)
                                            <a class="logo-login text-center">
                                                <img class="img-fluid for-light" width="200px"  height="100px" src="{{asset('dashboardstyle/assets/images/logo.png')}}"
                                            alt="{{ __('otp.title') }}"></a>
                                        @endif
                                        <div class="login-main text-center">

                                            @if(!$registerPage)   <h4 class="pb-4"> {{ __('otp.title') }} </h4> @endif

                                            <input type="hidden" class="form-control" name="first-time-secret" value="{{ isset($data['secret']) ? $data['secret'] : ''}}">
                                            <input type="hidden" class="form-control" name="disable-two-factor" value="{{ isset($data['disable']) ? true : false }}">

                                            <label class="col-form-label"> @lang('otp.verification_code')</label>
                                            <input class="form-control" type="number" required="" placeholder="" name="totp">

                                            @if ($errors->has('totp'))
                                                <span class="help-block text-danger">
                                                    <strong>{{ $errors->first('totp') }}</strong>
                                                </span>
                                            @endif

                                            <button type="submit" class="btn btn-primary  btn-block w-100 mt-4">
                                                <i class="fa fa-btn fa-mobile"></i>
                                                @lang('otp.validate')
                                            </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </form>