@extends('layouts.dashboard.app')

@section('content')



<!-- <div class="content-page"> -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.users')</a></li>
                            <li class="breadcrumb-item active"> @lang('site.edit') </li>
                        </ol>
                    </div>
                    <h4 class="page-title">@lang('site.users')</h4>
                </div>
            </div>

        </div>


        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <input id="type" hidden type="text" name="type" value="Admin" required>

                        <div class="bg-secondary-lighten card-header d-flex justify-content-between">
                            <h5>@lang('site.edit') </h5>
                            <div class="text-end  group-btn-top">
                                <div class="form-group d-flex form-group justify-content-between">
                                    <button type="button" class="btn btn-pill btn-outline-primary btn-air-primary"
                                        onclick="history.back();">
                                        <!--<i class="fa fa-backward"></i>-->
                                        @lang('site.back')
                                    </button>
                                    <button type="submit" class="btn btn-air-primary btn-pill btn-primary"><i
                                            class="fa fa-magic"></i>
                                        @lang('site.edit')</button>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            <!--<h4 class="card-title">@lang('site.users')</h4>-->
                            @include('partials._errors')


                            <!--<form action="{{ route('dashboard.users.update', $user->id) }}"-->
                            <!--      method="post"-->
                            <!--      enctype="multipart/form-data">-->

                            <!--    {{ csrf_field() }}-->
                            <!--    {{ method_field('put') }}-->
                            <!--    <input id="type" hidden type="text" name="type" value="Admin"-->
                            <!--           required>-->
                            <div class="row form-group">
                                <!--<label for="name"-->
                                <!--       class="col-sm-3 col-form-label input-label">@lang('site.image')</label>-->
                                <div class="col-sm-12">


                                    <label>@lang('site.image')</label>
                                    <img src="{{asset('images/employee/'.$user->image)}}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalss" width="100px" height="100px" class="d-block"
                                         onerror="this.src='{{asset('images/employee/1671111127.png')}}'"
                                    >




                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalss" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">@lang('site.image')</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="border-5">
                                                <tr>
                                                    <th>
                                                        <img name="soso"
                                                            src="{{asset('images/employee/'.$user->image)}}" alt=""
                                                            width="400px" height="aut0">

                                                    </th>
                                                </tr>


                                            </table>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">@lang('site.Cancel')</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  End Of Modal -->
                            <div class="row">
                                <!--<div class="col-md-6">-->
                                @if (auth()->user()->hasRole('Super Admin'))

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.name')<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                                        required>
                                </div>
                                @endif

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.phone')<span class="text-danger">*</span></label>
                                    <div id="result">
                                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}"
                                            id="mobilephone" maxlength="10" size="10" required>

                                    </div>
                                </div>


                                <!--</div>-->
                                <!--<div class="col-md-6">-->
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.address')<span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control" value="{{ $user->address }}"
                                        required>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.email')<span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.password')</label>
                                    <input type="password" name="password" class="form-control">
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.password_confirmation')</label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>



                                <div class="col-md-6 form-group col-12 p-2">

                                        <label>@lang('site.type')</label>
                                        <div class="select-area d-flex align-items-center">
                                            <select class="form-control" name="type">
                                                <option>@lang('site.select')</option>

                                                <option value="fulltime" @if($user->type=='fulltime')
                                                selected @endif>
                                                    @lang('site.fulltime') </option>
                                                <option value="parttime" @if($user->type=='parttime')
                                                selected @endif>
                                                    @lang('site.parttime') </option>

                                            </select>
                                        </div>
                                </div>



                                <!--</div>-->
                                <!--</div>-->

                                <!--<h4 class="card-title mt-4">@lang('site.image')</h4>-->

                                <!--<div class="row">-->
                                <!--    <div class="col-md-6">-->
                                <div class="col-md-6 form-group col-12 p-2">


                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">


                                </div>
                                @if (auth()->user()->hasPermission('read_roles'))
                                <div class="col-md-6 form-group col-12 p-2">
                                    <label>@lang('site.roles')</label>
                                    <select name="roles[]" class="form-control select2">
                                        <option disabled selected>@lang('site.select')</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                {{--                                                                            @if (auth()->user()->hasRole('Super Admin'))--}}
                                {{--                                            <div class="col-md-6 form-group col-12 p-2">--}}
                                {{--                                                <label>@lang('site.shops')</label>--}}
                                {{--                                                <select name="shop_id" class="form-control select2"--}}
                                {{--                                                >--}}
                                {{--                                                <option disabled selected>@lang('site.select')</option>--}}
                                {{--                                                    @foreach (\App\Models\Shop::get() as $shop)--}}
                                {{--                                                        <option--}}
                                {{--                                                            value="{{ $shop->id }}"
                                {{ $user->shop_id == $shop->id ? 'selected' : '' }}>--}}
                                {{--                                                            {{ $shop->name }}--}}
                                {{--                                                        </option>--}}
                                {{--                                                    @endforeach--}}
                                {{--                                                </select>--}}
                                {{--                                            </div>--}}
                                {{--                                        @endif--}}

                            </div>

                            <!--</div>-->


                            <!--<div class="text-end mt-4">-->
                            <!--    <div class="col-md-6 form-group col-12 p-2">-->
                            <!--        <button type="button" class="btn btn-warning mr-1"-->
                            <!--                onclick="history.back();">-->
                            <!--            <i class="fa fa-backward"></i> @lang('site.back')-->
                            <!--        </button>-->
                            <!--        <button type="submit" class="btn btn-primary"><i-->
                            <!--                class="fa fa-plus"></i>-->
                            <!--            @lang('site.edit')</button>-->
                            <!--    </div>-->
                            <!--</div>-->
                    </form>
                </div>
            </div>
        </div>
        <!-- Individual column searching (text inputs) Ends-->
    </div>
</div>
<!-- Container-fluid Ends-->
</div>




@endsection