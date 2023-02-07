@extends('layouts.dashboard.app')

@section('content')

<!-- <div class="content-page"> -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <!-- <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.welcome') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.employee')</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.add')</li>
                            </ol>
                        </div> -->
                        <h4 class="page-title">@lang('site.leaves')</h4>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">


                        <div class="card-body">

                            @foreach($messagers as $messager)
                            <hr>
                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">

                                    <img src="{{asset('images/l/'.$messager->userTo->image)}}" width="50px"
                                        height="aut0"
                                        onerror="this.src='{{asset("assets/images/dashboard/w-user.jpg")}}'">
                                    <a>To:{{$messager->userTo->name ?? ''}}</a>
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    {{$messager->message ?? ''}}
                                </div>


                            </div>
                            @endforeach

                        </div>

                    </div>
                </div>
                <!-- Individual column searching (text inputs) Ends-->
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
</div>



@endsection

@section('scripts')


@endsection