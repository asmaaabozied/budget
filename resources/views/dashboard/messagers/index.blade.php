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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">@lang('site.leaves')</a>
                                </li>
                                <li class="breadcrumb-item active"> @lang('site.add')</li>
                            </ol>
                        </div>
                        <h4 class="page-title">@lang('site.leaves')</h4>
                    </div>
                </div>

            </div>

            <div class="row">
                <!-- Individual column searching (text inputs) Starts-->
                <div class="col-sm-12">
                    <div class="card">


                        <div class="card-body">


                            <div class="row">

                                <div class="col-md-6 form-group col-12 p-2">
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-fy13yr" focusable="false"
                                        aria-hidden="true" viewBox="0 0 24 24" data-testid="EmailOutlineIcon">
                                        <path
                                            d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z">
                                        </path>
                                    </svg>


                                    <a>@lang('site.inbox')</a>
                                </div>

                                <div class="col-md-6 form-group col-12 p-2">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-6952u1" focusable="false"
                                        aria-hidden="true" viewBox="0 0 24 24" data-testid="SendOutlineIcon">
                                        <path
                                            d="M4 6.03L11.5 9.25L4 8.25L4 6.03M11.5 14.75L4 17.97V15.75L11.5 14.75M2 3L2 10L17 12L2 14L2 21L23 12L2 3Z">
                                        </path>
                                    </svg>
                                    <a href="{{route('dashboard.send')}}">@lang('site.send')</a>
                                </div>
                                <div class="col-md-6 form-group col-12 p-2">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-fy13yr" focusable="false"
                                        aria-hidden="true" viewBox="0 0 24 24" data-testid="EmailOutlineIcon">
                                        <path
                                            d="M22 6C22 4.9 21.1 4 20 4H4C2.9 4 2 4.9 2 6V18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6M20 6L12 11L4 6H20M20 18H4V8L12 13L20 8V18Z">
                                        </path>
                                    </svg>

                                    <a>@lang('site.outbox')</a>

                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                </div>


                                <div class="col-md-6 form-group col-12 p-2">
                                    <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-6952u1" focusable="false"
                                        aria-hidden="true" viewBox="0 0 24 24" data-testid="DeleteOutlineIcon">
                                        <path
                                            d="M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19M8,9H16V19H8V9M15.5,4L14.5,3H9.5L8.5,4H5V6H19V4H15.5Z">
                                        </path>
                                    </svg>
                                    <a>@lang('site.trash')</a>

                                </div>


                            </div>


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