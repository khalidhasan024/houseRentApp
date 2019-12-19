@extends('template')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@endsection

@section('heading')
    @include('_includes/timestamp')
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-ui.js')}}"></script>
    <script src="{{asset('js/jquery.ui.monthpicker.js')}}"></script>
    <script>
        jQuery(".month_picker").monthpicker({
            changeYear: true,
            stepYears: 2,
            showOn:     "both",
            buttonImage: "{{asset('img/calendar.png')}}",
            buttonImageOnly: false,
            dateFormat: 'MM, yy',
            showButtonPanel: true
        });
    </script>
@endsection