@extends('template')

@section('stylesheets')
    <link rel="stylesheet" href="/css/jquery-ui.css">
@endsection

@section('heading')
<div class="row my-2">
        <div class="col-lg-6">
            <h2>{{ $heading }}</h2>   
        </div>
    <div class="col-lg-6">
        {{-- <form action="index" method="POST" class="float-left">
            {{csrf_field()}}
            <input type="text" name="" id="" class="month_picker px-4" value="">
            <input class="btn btn-sm btn-secondary" formaction="{{route('electricity.show')}}" type="submit" value="Go">
        </form> --}}
            <a href="{{route('electricity.create')}}" class="btn btn-secondary float-right">New Bill Entry</a>
    </div>
</div>
@endsection

@section('content')
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>Flat name</th>
                <th>Per Unit price</th>
                <th>Month-start reading</th>
                <th>Month-end reading</th>
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($flats as $flat)
                <tr>
                    <td>{{$flat->name}}</td>
                    <td>{{$flat->bill->unit_bill ?? ''}}</td>
                    <td>{{$flat->electricity->start_reading ?? ''}}</td>
                    <td>{{$flat->electricity->end_reading ?? ''}}</td>
                    <td>{{isset($flat->bill->unit_bill) && isset($flat->electricity->start_reading) && isset($flat->electricity->end_reading) ? ($flat->electricity->end_reading-$flat->electricity->start_reading)*$flat->bill->unit_bill : ''}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    
<script src="/js/jquery-ui.js"></script>
<script src="/js/jquery.ui.monthpicker.js"></script>
<script>
        jQuery(".month_picker").monthpicker({
            changeYear: true,
            stepYears: 2,
            showOn:     "both",
            buttonImage: "/img/calendar.png",
            buttonImageOnly: false,
            dateFormat: 'MM, yy',
            showButtonPanel: true
		});
    </script>
@endsection