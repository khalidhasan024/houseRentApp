@extends('template')

@section('heading')
    @include('_includes/timestamp')
@endsection

@section('content')
<table class="table table-light table-striped table-sm">
        <thead class="thead-light">
            <tr>
                <th>Date</th>
                <th>Note</th>
                <th>Ammount</th>
                <th>#</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                
            <tr>
                <td>{{ \Carbon\Carbon::parse($expense->created_at)->format('d-m-Y')}}</td>
                <td>{{$expense->note}}</td>
                <td>{{$expense->ammount + $expense->adjustments->sum('ammount')}}</td>
                <td><a href="{{route('expense.show',$expense->id)}}" class="btn btn-secondary btn-sm" >Details</a></td>
                <td><a href="{{route('expense.edit',$expense->id)}}" class="btn btn-secondary btn-sm" >Adjust</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
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