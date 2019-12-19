@extends('template')

@section('heading')
    <div class="row my-2">
        <div class="col">
            <h2>{{ $heading }}</h2>
        </div>
        <div class="col">
                <div class="float-right">
                    <a href="{{route('tenant.index')}}" class="btn btn-secondary">Current Tenants</a>
                    <a href="{{route('tenant.next')}}" class="btn btn-secondary">Next Tenants</a>
                </div>
        </div>
    </div>
@endsection

@section('content')
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Flat Name</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{$tenant->name}}</td>
                    <td>{{$tenant->flat->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($tenant->period->date_from)->format('F Y')}} -->
                    {{ \Carbon\Carbon::parse($tenant->period->date_to)->format('F Y')}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

