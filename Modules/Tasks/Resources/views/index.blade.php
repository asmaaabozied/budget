@extends('layouts.dashboard.app')

{{--@extends('tasks::layouts.master')--}}

@section('style')
        <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css" />
@endsection

@section('content')
    {{-- all application will build with vuejs --}}
{{--    <div class="" styles="padding: 100px 50px">--}}
        <div id="tasks-app">  </div>
{{--    </div>--}}

@endsection

@section('scripts')
     {{ module_vite('modules/tasks/build', 'Resources/assets/js/app.js') }}
@endsection