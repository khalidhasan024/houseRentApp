@extends('template')

@section('heading')
    <div class="row my-2">
        <div class="col">
            <h2>{{ $heading }}</h2>
        </div>
        <div class="col">
                <div class="float-right">
                    @section('navigation')
                        <a href="{{route('tenant.next')}}" class="btn btn-secondary">Next Tenants</a>
                        <a href="{{route('tenant.previous')}}" class="btn btn-secondary">Previous Tenants</a>
                    @show
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
                <th>Active from</th>
                <th>#</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{$tenant->name}}</td>
                    <td>{{$tenant->flat->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($tenant->period->date_from)->format('F Y')}}</td>
                    <td><a href="#" class="btn btn-secondary btn-sm">Details</a></td>
                    <td><a href="#" class="btn btn-secondary btn-sm">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

