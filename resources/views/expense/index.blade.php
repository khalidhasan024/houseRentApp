@extends('template')

@section('stylesheets')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
@endsection

@section('heading')
<div class="row my-2">
        <div class="col-md-6"><h2>{{ $heading }}</h2></div>
        <div class="col-md-6"><a href="{{route('expense.create')}}" class="btn btn-secondary float-right">New Expense</a></div>
    </div>
@endsection

@section('content')

    @include('_includes/timestamp')

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


{{-- 
{% block scripts %}
    {{ parent() }}
    <script>
        function myFunction(note) {
            document.getElementById("adj_note").value = note;
            document.getElementById("collapse_area").classList.add("show");
            document.getElementById("adjust_ammount").focus();
        }
    </script>
{% endblock %} --}}