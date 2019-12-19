@extends('tenant.index')

@section('navigation')
    <a href="{{route('tenant.index')}}" class="btn btn-secondary">Current Tenants</a>
    <a href="{{route('tenant.previous')}}" class="btn btn-secondary">Previous Tenants</a>
@endsection